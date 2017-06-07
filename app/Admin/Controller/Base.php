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
		// 调用父类的构造方法
    	parent::__construct();
    	
	}
}
