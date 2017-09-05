<?php
namespace App\Admin\Controller;
use Kernel\Controller;
use App\Model\Menu;

/**
* 后台中间件
*/
class Base extends Controller{
	# 构造函数
	function __init(){
	    # 获取后台导航
        $this -> assign('menu_list',Menu::where(['pid'=>0]) -> get());
	}
}
