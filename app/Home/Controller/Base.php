<?php
namespace App\Home\Controller;
use Kernel\Controller;

/**
* 前台中间件
*/
class Base extends Controller{

	function __construct(){
		# 调用父类的构造方法
    	parent::__construct();
	}
}
