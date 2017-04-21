<?php
return [
	# 微信的appid
	'app_id'=>'2017041506737880',
	# 商户私钥，您的原始格式RSA私钥
	'merchant_private_key'=>'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDDI6d306Q8fIfCOaTXyiUeJHkrIvYISRcc73s3vF1ZT7XN8RNPwJxo8pWaJMmvyTn9N4HQ632qJBVHf8sxHi/fEsraprwCtzvzQETrNRwVxLO5jVmRGi60j8Ue1efIlzPXV9je9mkjzOmdssymZkh2QhUrCmZYI/FCEa3/cNMW0QIDAQAB',
	# 异步通知地址
	'notify_url'=>'http://wechat.ssjzedu.com/Home/Alipay/callback.html',
	# 同步跳转
	'return_url'=>"http://mitsein.com/alipay.trade.wap.pay-PHP-UTF-8/return_url.php",
	# 编码格式
	'charset'=>'UTF-8',
	# 签名方式
	'sign_type' => 'RSA',
	# 支付宝网关
	'gatewayUrl'=>"https://openapi.alipay.com/gateway.do",
	# 支付宝私钥文件
	'rsa_private_key' => ROOT_PATH.'pem/siyao.txt',
	# 支付宝公钥
	'ali_public_key' => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBSKg5gKsBLgrSJ8ftpdX3j1qbSa++Q/UL2oXP9UIvG6V9Nt8AAhFFLb6MHSuGerMRcAEMNnoXy3uTZr7d2zfCl1hmh8lCxhbEbi5GUZqbammNzGqt9BK+esYjUUCHNrAiIdzXF1EZSLlBd9OKytvfgxyFJ4ePbZN2Gq7Fz+lOLwIDAQAB"

];
	// # 应用ID
	// public static $app_id = '2017041506737880';
	// # 商户私钥，您的原始格式RSA私钥
	// public static $merchant_private_key = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDDI6d306Q8fIfCOaTXyiUeJHkrIvYISRcc73s3vF1ZT7XN8RNPwJxo8pWaJMmvyTn9N4HQ632qJBVHf8sxHi/fEsraprwCtzvzQETrNRwVxLO5jVmRGi60j8Ue1efIlzPXV9je9mkjzOmdssymZkh2QhUrCmZYI/FCEa3/cNMW0QIDAQAB';
	// # 异步通知地址
	// public static $notify_url = 'http://wechat.ssjzedu.com/Home/Alipay/callback.html';
	// # 同步跳转
	// public static $return_url =  "http://mitsein.com/alipay.trade.wap.pay-PHP-UTF-8/return_url.php";
	// # 编码类型
	// public static $charset = "UTF-8";
	// # 签名方式
	// public static $sign_type = "RSA";
	// # 支付宝网关
	// public static $gatewayUrl = "https://openapi.alipay.com/gateway.do";
	// # 支付宝私钥文件
	// public static $rsa_private_key = ROOT_PATH.'pem/siyao.txt';
	// # 支付宝公钥
	// public static $ali_public_key = "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBSKg5gKsBLgrSJ8ftpdX3j1qbSa++Q/UL2oXP9UIvG6V9Nt8AAhFFLb6MHSuGerMRcAEMNnoXy3uTZr7d2zfCl1hmh8lCxhbEbi5GUZqbammNzGqt9BK+esYjUUCHNrAiIdzXF1EZSLlBd9OKytvfgxyFJ4ePbZN2Gq7Fz+lOLwIDAQAB";
	// # 创建订单
	// public static function create($body,$subject,$order_no,$timeout_express,$amount,$return_param){
	// 	# 读取支付宝配置
	// 	$config = ['app_id' => self::$app_id,'merchant_private_key' =>self::$merchant_private_key,'notify_url' =>self::$notify_url,'return_url' =>self::$return_url,'charset' =>self::$charset,'sign_type'=>self::$sign_type,'gatewayUrl' => self::$gatewayUrl,'ali_public_key' =>self::$ali_public_key,'rsa_private_key'=>self::$rsa_private_key];