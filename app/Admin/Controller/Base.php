<?php
namespace App\Admin\Controller;
use Service\Log;
use Kernel\Controller;

/**
* 后台中间件
*/
class Base extends Controller{

	function __construct(){
		// 调用父类的构造方法
    	parent::__construct();
    	// 判断是否已经登录
    	if($_SESSION['admin']['user']['id'] < 1){
    		$this -> redirect('Login/index');
    	}
	}
}
