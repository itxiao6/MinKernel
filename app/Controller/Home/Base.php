<?php
namespace App\Controller\Home;
use Kernel\Controller;
use Service\Log;

/**
* 微信端中间件
*/
class Base extends Controller{
	
	function __construct(){
		// 调用父类的构造方法
    	parent::__construct();
    	// 记录访问日志
	    
	}
}
