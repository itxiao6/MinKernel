<?php
namespace App\Admin\Controller;
use Kernel\Controller;

/**
 * 微信管理
 */

class Wechat extends Base{
    # 菜单管理
    public function menu()
    {
        #渲染模板
        $this -> display();
    }
    # 配置管理
    public function config()
    {
        #渲染模板
        $this -> display();
    }
}
