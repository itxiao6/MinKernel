<?php
namespace App\Home\Controller;
use Service\Log;
use Kernel\Controller;

/**
* 微信端中间件
*/
class Base extends Controller{

	function __construct(){
		// 调用父类的构造方法
    	parent::__construct();
    	if($_SESSION['home']['user']==null){
    		echo '<script>alert("请先登录");location="/Home/Login/index.html"</script>';
    	}
    	// 调取前台导航条
    	if($nav_data = M('nav') -> get()){
    		$nav_data = $nav_data -> toArray();
		}
		$this -> assign('nav_data',$nav_data);
	}
}
