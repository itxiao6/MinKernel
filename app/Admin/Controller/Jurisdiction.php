<?php
namespace App\Admin\Controller;
use Kernel\Controller;

/**
 * 权限管理
 */

class Jurisdiction extends Base{
    # 结点管理
    public function node()
    {
        #渲染模板
        $this -> display();
    }
    # 类型管理
    public function type()
    {
        #渲染模板
        $this -> display();
    }
    # 用户管理
    public function user()
    {
        # 渲染模板
        $this -> display();
    }
}