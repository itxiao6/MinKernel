<?php
namespace App\Home\Controller;
use Service\Log;
use Kernel\Controller;

/**
* 端中间件
*/
class Base extends Controller{

	function __construct(){
		// 调用父类的构造方法
    	parent::__construct();
	}
}
