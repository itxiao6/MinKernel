<?php
namespace App\Admin\Controller;
use App\Model\AdminNode;
use App\Model\AdminRight;
use App\Model\AdminRoles;
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
        C('debugbar','sys',false);
	    # 判断是否已经登陆过
        if($_SESSION['admin']['user']['id']<1){
            # 重定向到登陆页面
            redirect('/Auth/login.html');
        }
        # 获取后台导航
        $this -> assign('menu_list',Menu::where(['pid'=>0])
//            -> remember(3600*24)
            -> get());
	    # 权限验证
        if(!$this -> AuthCache()){
            $this -> error('权限不足');
        }

	}
	# 权限检查
	public function AuthCache(){
        # 获取控制器
        $controller = CONTROLLER_NAME;
        # 获取操作
        $action = ACTION_NAME;

	    # 判断是否为超级管理员
        if($_SESSION['admin']['user']['roles']=='-1'){
            return true;
        }

        # 获取用户的角色
        $roles = AdminRoles::where(['id'=>$_SESSION['admin']['user']['roles']]) -> first();
        # 获取权限
        $right = explode(',',$roles -> right);
        # 获取结点
        $admin_right = AdminRight::whereIn('id',$right) -> pluck('node','id');
        # 获取结点
        if(AdminNode::where(['controller_name'=>$controller,'action'=>$action]) -> whereIn('id',$admin_right) -> first()){
            return true;
        }else{
            return false;
        }
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
