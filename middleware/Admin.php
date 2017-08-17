<?php
namespace Middleware;

# 后台权限验证中间件
class Admin
{
    # 主方法
    public static function handle()
    {
        # 判断是否登录过了
        if($_SESSION['admin']['id'] < 1){
            redirect('/Auth/login.html');
        }else{

        }

    }
}