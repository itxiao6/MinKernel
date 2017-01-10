<?php
namespace App\Admin\Controller;
use Kernel\Controller;
use Service\Log;

/**
* 后台中间件
*/
class Base extends Controller{
	
	function __construct(){
		// 调用父类的构造方法
    	parent::__construct();
	    
	}
}
