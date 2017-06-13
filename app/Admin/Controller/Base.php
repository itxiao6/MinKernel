<?php
namespace App\Admin\Controller;
use Kernel\Controller;
use Service\File;

/**
* 后台中间件
*/
class Base extends Controller{
	# 构造函数
	function __construct(){
		# 判断用户是否已经登录
		// if($_SESSION['admin']['user']['id'] < 1){
		// 	redirect('/Admin/Auth/login.html');
		// }
		// 调用父类的构造方法
    	parent::__construct();
    	
	}
}
