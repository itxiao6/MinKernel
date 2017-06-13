<?php
$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb66de5b8f7b93011&redirect_uri=http://'.$_SERVER['HTTP_HOST'].'/2.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
header('Location:'.$url);
// $result = file_get_contents($url);
// var_dump($result);