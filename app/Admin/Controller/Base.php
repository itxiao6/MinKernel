<?php
namespace App\Admin\Controller;
use Kernel\Controller;
use App\Model\Menu;
use Service\File;

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
    public function clear_cache()
    {
        # 清空数据缓存
        File::remove_dir(CACHE_DATA);
        # 清空类映射缓存
        File::remove_dir(CLASS_PATH);
        # 清空日志
        File::remove_dir(CACHE_LOG);
        # 清空回话文件
        File::remove_dir(CACHE_SESSION);
        # 清空模板编译缓存
        File::remove_dir(CACHE_VIEW);
        # 提示完成
        $this -> success('清空缓存完成');
    }
}
