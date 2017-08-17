<?php
namespace App\Admin\Controller;
use Kernel\Controller;

/**
* 后台中间件
*/
class Base extends Controller{
	# 构造函数
	function __init(){
	    # 后台鉴权中间件
//		$this -> addMiddleware(\Middleware\Admin::class);
	}
}
