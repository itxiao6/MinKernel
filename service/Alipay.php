<?php
namespace Service;
use Payment\Common\PayException;
use Payment\Client\Charge;
use Payment\NotifyContext;
/**
* 支付宝
*/
class Alipay{
	# 创建订单
	public static function create($data,$channel='ali_wap'){
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
	public static function callback($fun){
		#实例化
		$result = new NotifyContext;
		#填写需要参数
		$data = ['app_id'=>C('app_id','alipay'),'notify_url'=>C('notify_url','alipay'),'return_url'=>C('return_url','alipay'),'sign_type'=>C('sign_type','alipay'),'ali_public_key'=>C('ali_public_key','alipay'),'rsa_private_key'=>C('rsa_private_key','alipay')];
		// $data = C('all','alipay');
		# 校验信息
		$result -> initNotify('ali_charge',$data);
	      
		# 接受返回信息
		$information = $result -> getNotifyData();
		# 判断支付状态
		if($information['trade_status']=='TRADE_SUCCESS'){
			$fun($information);
			
		}
		exit('success');
	}
}