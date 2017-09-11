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
	    # 权限验证
        $this -> AuthCache();
	    if($_SESSION['admin']['user']['id']<1){
	        redirect('/Auth/login.html');
        }
        # 获取后台导航
        $this -> assign('menu_list',Menu::where(['pid'=>0]) -> remember(3600*24) -> get());
	}
	# 权限检查
	public function AuthCache(){
	    $controller = CONTROLLER_NAME;
        $action = ACTION_NAME;

    }
}
