<?php
function http($url){
	$ch = curl_init();
	//设置选项，包括URL
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	//执行并获取HTML文档内容
	$output = curl_exec($ch);
	//释放curl句柄
	curl_close($ch);
	return $output;
}
$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxb66de5b8f7b93011&secret=e05a8b1c00d2abd93b92142214242276&code='.$_GET['code'].'&grant_type=authorization_code';
	$output = http($url);
	$result = json_decode($output,true);
// 获取用户的access_token


// 获取用户信息
$url2 = "https://api.weixin.qq.com/sns/userinfo?access_token=".$result['access_token']."&openid=".$result['openid']."&lang=zh_CN ";
$userinfo_json = http($url2);
$userinfo = json_decode($userinfo_json,true);
var_dump($userinfo);die();