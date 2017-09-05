<?php
namespace App\Admin\Controller;
use Kernel\Controller;
use App\Model\Menu;
use Service\Timeer;

/**
* 后台中间件
*/
class Base extends Controller{
	# 构造函数
	function __init(){
	    # 获取后台导航
        $this -> assign('menu_list',Menu::where(['pid'=>0]) -> remember(3600*24) -> get());
	}
}
