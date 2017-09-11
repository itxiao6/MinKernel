<?php
namespace App\Admin\Controller;
use Kernel\Controller;
use App\Model\Menu;
/**
 * 后台基础类
 * Class Base
 * @package App\Admin\Controller
 */
class Base extends Controller{
	# 构造函数
	function __init(){
	    # 判断是否已经登陆过
        if($_SESSION['admin']['user']['id']<1){
            # 重定向到登陆页面
            redirect('/Auth/login.html');
        }
        # 获取后台导航
        $this -> assign('menu_list',Menu::where(['pid'=>0]) -> remember(3600*24) -> get());
	    # 权限验证
        $this -> AuthCache();

	}
	# 权限检查
	public function AuthCache(){
	    $controller = CONTROLLER_NAME;
        $action = ACTION_NAME;

    }
}
