<?php
namespace Service;

/**
* 微信小工具类
*/
class Wechat{
	// 签名用的noncestr
	public static $noncestr;
	// 签名用的jsapi_ticket
	public static $jsapi_ticket;
	// 签名用的timestamp
	public static $timestamp;
	// 签名用的url
	public static $url;
	// 获取 ACCESS_TOKEN
	public static function get_ACCESS_TOKEN(){
		// 获取缓存数据
		$result = Cache::get('ACCESS_TOKEN');
		// 判断是否存在缓存
		if($result!=null){
			return $result;
		}
		// 接口url地址
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.C('appid','wechat').'&secret='.C('secret','wechat');
		// 如果没有缓存则获取access_token
		$data = json_decode(file_get_contents($url),true);
		// 返回缓存过的数据
    	return Cache::set('ACCESS_TOKEN',$data['access_token'],$data['expires_in']);

	}
	// 获取微信服务器ip列表
	public static function get_Wechat_Ip(){
		// 接口url
		$url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token='.self::get_ACCESS_TOKEN();
		// 获取微信服务器ip列表
		$data = json_decode(file_get_contents($url),true);
		// 返回微信服务器的Server_IP_lists
    	return $data['ip_list'];
	}

}