<?php
namespace App\Admin\Controller;
use Kernel\Controller;

/**
* 后台中间件
*/
class Base extends Controller{
    # 后台导航
    protected $menu = [
        [
            'name'=>'微信管理',
            'icon'=>'fa-list-alt',
            'controller'=>'Wechat',
            'son'=>[
                [
                    'name'=>'微信菜单管理',
                    'href'=>'/Wechat/menu.html',
                    'action'=>'menu',
                ],
                [
                    'name'=>'微信参数配置',
                    'href'=>'/Wechat/config.html',
                    'action'=>'config',
                ],
            ]
        ],
        [
            'name'=>'权限管理',
            'icon'=>'fa-pencil-square-o',
            'controller'=>'Jurisdiction',
            'son'=>[
                [
                    'name'=>'角色管理',
                    'href'=>'/Jurisdiction/type.html',
                    'action'=>'type',
                ],
                [
                    'name'=>'结点管理',
                    'href'=>'/Jurisdiction/node.html',
                    'action'=>'node',
                ],
                [
                    'name'=>'用户管理',
                    'href'=>'/Jurisdiction/user.html',
                    'action'=>'user',
                ],
            ]
        ],
    ];
	# 构造函数
	function __init(){
        $this -> assign('menu_list',$this -> menu);
	}
}
