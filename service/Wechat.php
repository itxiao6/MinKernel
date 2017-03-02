<?php
namespace Service;
use Doctrine\Common\Cache\FilesystemCache;
use Thenbsp\Wechat\Wechat\AccessToken;
use Thenbsp\Wechat\Wechat\Jsapi;
use Thenbsp\Wechat\Wechat\Qrcode;
use Thenbsp\Wechat\Wechat\ServerIp;
use Thenbsp\Wechat\Wechat\ShortUrl;
use Thenbsp\Wechat\OAuth\Client;
use Thenbsp\Wechat\Bridge\Util;
use Thenbsp\Wechat\OAuth\Qrcode;
use Thenbsp\Wechat\Payment\Unifiedorder;
use Thenbsp\Wechat\Payment\Notify;
use Thenbsp\Wechat\Payment\Coupon\Cash;
use Thenbsp\Wechat\Message\Template\Template;
use Thenbsp\Wechat\Message\Template\Sender;
/**
*
*/
class Wechat{
	// appid
	public static $appid = '';
	// appsecret
	public static $appsecret = '';
	// mch_id
	public static $mch_id = '';
	// key
	public static $key = '';
	// 缓存Dricer
	protected static $cacheDriver = false;
	// AccessToken
	protected static $accessToken = false;
	// 定义JSAPI
	protected static $jsapi = false;
	// 二维码票据
	protected static $qrcode = false;
	// 微信服务器IP
	protected static $serverIp = false;
	// 用户授权
	protected static $client = false;
	// 用户的网页授权AccessToken
	protected static $user_accessToken = false;
	// 二维码登录授权
	protected static $qr_accessToken = false;
	// 用户信息
	protected static $userinfo = false;
	// 二维码登录
	protected static $qr_loginclient = false;
	// 统一下单接口
	protected static $unifiedorder = false;
	// 微信公众号支付配置
	protected static $chooseWXPayConfig = false;



	// 获取accessToken
	public static function get_access_token(){
		if(self::$cacheDriver==false){
			self::$cacheDriver = new FilesystemCache(CACHE_DATA);
		}
		// 初始化AccessToken
		self::$accessToken = new AccessToken(self::$appid, self::$appsecret);
		// 设置缓存
		self::$accessToken->setCache(self::$cacheDriver);
		// 返回字符串类型的AccessToken
		return self::$accessToken->getTokenString();
	}
	// 获取JSapi
	protected static function get_jsapi($api,$debug==false){
		// 判断是否已经获取过accessToken
		if(self::$accessToken==false){
			// 获取accessToken
			self::get_access_token();
		}
		// 初始化jsapi
		self::$jsapi = new Jsapi(self::$accessToken);
		// 缓存jsapi票据
		self::$jsapi->setCache(self::$cacheDriver);
		// 注入API权限
		self::$jsapi ->addApi($api);
		// 判断是否开启了调试模式
		if($debug){
			self::$jsapi->enableDebug();
		}
	}
	// 获取JSAPI配置
	public static function get_jsapi_config($is_array=false,$api='',$debug=false){
		// 判断是否已经获取过JSAPI
		if(self::$jsapi==false){
			// 获取accessToken
			self::get_jsapi($api,$debug);
		}
		// 返回JSAPI json字符串
		return self::$jsapi->getConfig(($is_array==true)?true:false);
	}
	// 获取带参数的二维码
	public static function get_Qrcode($param,$out_time=0){
		// 判断是否已经获取过accessToken
		if(self::$accessToken==false){
			// 获取accessToken
			self::get_access_token();
		}
		// 缓存二维码票据
		self::$qrcode->setCache(self::$cacheDriver);
		// 判断是否使用了有效期(没有有效期则是永久二维码)
		if($out_time==0){
			self::$qrcode->getForever($param);
		}
	}
	// 获取微信服务器IP
	public static function get_Wechat_Server_IP(){
		// 判断是否已经获取过accessToken
		if(self::$accessToken==false){
			// 获取accessToken
			self::get_access_token();
		}
		// 初始化微信服务器IP列表接口
		self::$serverIp = new ServerIp(self::$accessToken);
		// 缓存接口
		self::$serverIp->setCache(self::$cacheDriver);
		// 返回微信服务器ip列表
		return self::$serverIp->getIps();
	}
	// 生成短连接
	public static function toShort($url){
		// 判断是否已经获取过accessToken
		if(self::$accessToken==false){
			// 获取accessToken
			self::get_access_token();
		}
		// 初始化短连接接口
		self::$shortUrl = new ShortUrl(self::$accessToken);
		// 缓存短连接
		self::$shortUrl->setCache(self::$cacheDriver);
		// 返回短连接
		return self::$shortUrl->toShort($url);
	}
	// 获取用户授权信息
	public static function get_Web_user_Access_Token($callBack){
		// 判断是否已经生成过了
		if($user_accessToken != false){
			// 直接返回
			return self::$user_accessToken;
		}
		// 实例化授权类
		self::$client = new Client(self::$appid, self::$appsecret);

		// 指定授权成功跳转页面
		$client->setRedirectUri($callBack);

		// 判断是否为微信的回调
		if( !isset($_GET['code']) ){
		    header('Location: '.self::$client->getAuthorizeUrl());
		}
		// 获取用户AccessToken
		self::$user_accessToken = $client->getAccessToken($_GET['code']);
		// 返回用户授权(可toArray())
		return self::$user_accessToken;
	}
	// 获取用户信息
	public static function get_user_info($callBack){
		if($user_accessToken==false){
			self::get_Web_user_Access_Token($callBack);
		}
		// 判断accessToken是否有效
		if(!self::$user_accessToken->isValid()){
			// 刷新accessToken
			self::$user_accessToken->refresh();
		}
		// 获取用户信息
		self::$userinfo = self::$user_accessToken->getUser();.
		// 过滤微信特殊表情符号(不过滤html)
		self::$userinfo['nickname'] = Util::filterNickname(self::$userinfo['nickname']);
		// 返回用户信息(可以toArray)
		return self::$userinfo;
	}
	// 二维码登录
	public static function qrcode_login(){
		// 判断是否已经生成过了
		if($qr_accessToken != false){
			// 直接返回
			return self::$qr_accessToken;
		}
		self::$qr_loginclient = new Qrcode(self::$appid,self::$appsecret);

		if( !isset($_GET['code']) ) {
		    header('Location: '.self::$qr_loginclient->getAuthorizeUrl());
		}
		// 获取二维码登录的AccessToken
		self::$qr_accessToken = self::$qr_loginclient->getAccessToken($_GET['code']);
		// 返回二维码登录的AccessToken(可toArray())
		return self::$qr_accessToken;
	}
	// 获取二维码登录用户信息
	public static function get_qr_login_info($callBack=''){
		if($qr_accessToken==false){
			self::get_Web_user_Access_Token($callBack);
		}
		// 判断accessToken是否有效
		if(!self::$qr_accessToken->isValid()){
			// 刷新accessToken
			self::$qr_accessToken->refresh();
		}
		// 获取用户信息
		self::$userinfo = self::$qr_accessToken->getUser();.
		// 过滤微信特殊表情符号(不过滤html)
		self::$userinfo['nickname'] = Util::filterNickname(self::$userinfo['nickname']);
		// 返回用户信息(可以toArray)
		return self::$userinfo;
	}
	// 统一下单
	public static function Unifiedorder($data = []){
		// 初始化下单接口
		self::$unifiedorder = new Unifiedorder(self::$appid,self::$mch_id,self::key);
		// 循环设置订单信息
		foreach ($data as $key => $value) {
			// 设置订单内容
			self::$unifiedorder->set($key,$value);
		}
		try {
		    $response = self::$unifiedorder->getResponse();
		} catch (\Exception $e) {
		    exit($e->getMessage());
		}
		// 返回下单结果
		return $response;
	}
	// 生成 ChooseWXPay 配置文件
	public static function ChooseWXPay($data=[]){
		// 判断是否已经下单
		if(self::$unifiedorder==false){
			// 下单
			self::Unifiedorder($data);
		}
		// 获取配置
		return self::$chooseWXPayConfig = new PayChoose(self::$unifiedorder);
		/*
			<button type="button" onclick="WXPayment()"> 支付 ￥<?php echo ($unifiedorder['total_fee']/100); ?> 元</button>
		 */

		/*
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script>
		//
		// 注入 Jsapi 配置
		//
		wx.config(<?php echo $jsapi; ?>);

		//
		// 点击支付按款
		//
		var WXPayment = function() {

		    var config = <?php echo $config; ?>;

		    config.success = function() {
		        alert('支付成功！');
		    }

		    config.cancel = function() {
		        alert('用户取消成功！');
		    }

		    wx.chooseWXPay(config);
		}
		</script>*/
	}
	public static function notitfy($callBack = function(){return false;}){
		// 初始化回调通知类
		$notify = new Notify();
		// 验证通知
		if( $notify->containsKey('out_trade_no') ) {
		    // 失败时必需返回，否则微信服务器将重复提交通知
		    $notify->fail('Invalid Request');
		}

		// 在这里处理你的业务逻辑，比如修改订单状态
		// $notify['out_trade_no'] 为订单号

		// 调用回调方法
		$callBack($notify);.

		// 返回成功标识
		$notify->success('OK');
	}
	public static function Cash($openid,$money,$cert,$sslKey,$num=1,$send_name="",$action_name='恭喜发财',$description='红包可立即提现',$wishing='恭喜发财'){
		// 判断要发送的红包金额是否小于1元
		if($money < 1){
			// 发送的红包金额不能小于1元
			return false;
		}
		// 初始化红包类
		self::$cash = new Cash(self::$appid, self::$mch_id, self::$key);

		// 现金红包必需设置证书
		self::$cash->setSSLCert($cert,$sslKey);

		// 设置红包信息
		self::$cash->set('send_name',     $send_name);// 发送者名称(一般都为公众号名称)
		self::$cash->set('act_name',      $action_name);// 活动名称
		self::$cash->set('remark',        $description);// 活动描述
		self::$cash->set('wishing',       $wishing);// 祝福语
		self::$cash->set('re_openid',     $openid);// 要发送给谁
		self::$cash->set('total_amount',  $money*100); // 发多少
		self::$cash->set('total_num',     $num); // 发几个
		self::$cash->set('mch_billno',    date('YmdHis').mt_rand(10000, 99999));

		try {
		    $response = self::$cash->getResponse();
		} catch (\Exception $e) {
		    exit($e->getMessage());
		}
		// 返回发放结果
		return $response->toArray();
	}
	public static function Template($Template_id,$url,$openid,$data){
		// 判断是否已经获取过accessToken
		if(self::$accessToken==false){
			// 获取accessToken
			self::get_access_token();
		}
		// 定义一个模板
		$template = new Template($Template_id);

		// 模板参数，每一个模板 ID 都对应一组参数
		foreach ($data as $key => $value) {
			$template -> add($key,$value);
		}

		// 跳转链接
		$template->setUrl($url);
		// 发给谁
		$template->setOpenid($openid);
		// 实例化模板消息发送类
		$sender = new Sender(self::$accessToken);

		try {
		    $msgid = $sender->send($template);
		} catch (\Exception $e) {
		    exit($e->getMessage());
		}
		// 返回发送结果
		return $msgid;
	}

}