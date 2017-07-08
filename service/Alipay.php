<?php
namespace Service;
use Payment\Common\PayException;
use Payment\Client\Charge;
use Payment\NotifyContext;
use Payment\Client\Transfer;
use Payment\Config;
/**
* 支付宝
*/
class Alipay{
    /**
     * 创建订单
     * @param $data 下单数据
     * @param string $channel 支付接口
     * @return mixed 进行支付的url
     */
	public static function create($data,$channel='ali_wap')
    {
		# 默认配置
		$default = [
			'amount'=>0.01,
			'timeout_express'=>(time()+1800),
			'body'=>'测试商品',
			'subject'=>'订单名称',
			'return_param'=>'buy'
		];
		# 合并配置
		$data = array_merge($default,$data);
		# 读取支付宝配置
		$config = C('all','alipay');
		# 默认手机站支付
		$channel;
		# 支付的数据
		$payData = [
			# 商品信息
		    'body' => $data['body'],
		    # 订单名称
		    'subject' => $data['subject'],
		    # 商家支付订单号
		    'order_no' => $data['order_no'],
		    # 订单过期时间
		    'timeout_express' => $data['timeout_express'],
		    # 订单总额
		    'amount' => $data['amount'],
		    # 支付成功返回页面
		    'return_param' => $data['return_param'],
		    # 商品类型1=商品0=虚拟货币
		    'goods_type' => 1,
		    'store_id' => '',// 没有就不设置
		];
		try {
			# 下单
		    $payUrl = Charge::run($channel, $config, $payData);
		} catch (PayException $e) {
		    // 打印错误
		    echo($e -> errorMessage());
		    exit();
		}
		# 返回下单结果的支付url
		return $payUrl;
	}
    /**
     * 支付宝异步回调
     * @param \Closure $fun 回调方法
     */
	public static function callback($fun)
    {
		#实例化
		$result = new NotifyContext;
		#填写需要参数
		$data = C('all','alipay');
		unset($data['merchant_private_key']);
		unset($data['charset']);
		unset($data['gatewayUrl']);
		# 校验信息
		$result -> initNotify('ali_charge',$data);
		# 接受返回信息
		$information = $result -> getNotifyData();
		# 判断支付状态
		if($information['trade_status']=='TRADE_SUCCESS'){
			if($fun($information)){
				exit('success');
			}else{
				exit('fail');
			}
		}else{
			exit('fail');
		}
		
	}
    /**
     * 点对点转账
     * @param array $data
     * @return bool|mixed
     */
	public static function querys($data = [])
    {
		$aliConfig = C('all','alipay');
		$default = [
		    'trans_no' => time(),
		    'payee_type' => 'ALIPAY_LOGONID',
		    'payee_account' => '15538147923',
		    'amount' => '0.1',
		    'remark' => '支付宝单笔企业转账',
		    'payer_show_name' => '曹操',
		];
		# 合并配置
		$data = array_merge($default,$data);
		# 验证最低金额
		if($data['amount'] < 0.1){
			return false;
		}
		try {
		    $ret = Transfer::run(Config::ALI_TRANSFER, $aliConfig, $data);
		} catch (PayException $e) {
		    echo $e->errorMessage();
		    exit;
		}
        $res = json_encode($ret, JSON_UNESCAPED_UNICODE);
		return json_decode($res);
	}
}