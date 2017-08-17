<?php
$redis = new \Redis();
$redis -> connect('127.0.0.1', 6379);
return [
	# 微信的公众平台的appid
	'appid'=>'wx7920eeb86e010ad8',
	# 微信开放平台的的appid
	'open_appid'=>'',
	# 公众号的secret
	'secret'=>'84a6438c8150f7539ae43da9396ec366',
    # 开放平台引用秘钥
	'open_secret'=>'',
	# 微信公众号商户平台付key
	'pay_key'=>'4d18db80e353e526ad6d42a62aaa29be',
	# 微信开放商户平台key
	'open_pay_key'=>'',
	# 微信公众商户平台商户id
	'mchid' => '1486144422',
	# 微信开放平台商户id
	'open_mchid' => '',
	#通知回调地址
	'notify_url'=>'',
    # 缓存驱动
    'cache_type'=>\Doctrine\Common\Cache\RedisCache::class,
    # 驱动参数
    'driver_param'=> $redis,

];
