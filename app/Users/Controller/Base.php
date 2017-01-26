<?php
namespace App\Users\Controller;
use Kernel\Controller;

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
