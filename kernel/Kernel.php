<?php
namespace Kernel;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Service\Session;
use Service\Route;
/**
* 框架核心类
*/
class Kernel{
    /**
     * 启动框架
     */
	public static function start(){
        //将时区设置为中国
        date_default_timezone_set("PRC");
        // 判断是否下载了composer包
        if (file_exists(ROOT_PATH.'vendor/autoload.php')) {
            // 引用Composer自动加载规则
            require(ROOT_PATH.'vendor/autoload.php');
        }else{
            // 设置协议头
            header("Content-Type:text/html;charset=utf-8");
            // 退出程序并提示
            exit('请在项目根目录执行:composer install');
        }
        // 判断是否为调试模式
        if( DE_BUG===TRUE ){
            // 屏蔽所有notice 和 warning 级别的错误
            error_reporting(E_ALL^E_NOTICE^E_WARNING);
            $whoops = new Run;
            $whoops->pushHandler(new PrettyPageHandler);
            $whoops->register();
            // 禁止所有页面缓存
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
            header('Cache-Control: no-cache, must-revalidate');
            header('Pragma: no-cache');
        }else{
            // 屏蔽所有错误
            error_reporting(0);
        }
        // 加载公用函数库
        require(ROOT_PATH.'common/functions.php');
        // 定义全局数据库连接
        global $database;
        $database = false;
        // 设置SessionCookie名称
        session_name('MiniKernelSession');
        // 设置session有效期
        session_set_cookie_params( C('session_lifetime','sys') );
        // 启动session
        if( C('session','sys') == 'database' ){
            // 启动数据库储存方式的session
            new Session;
        }else{
            // 修改session文件的储存位置
            session_save_path(ROOT_PATH.'runtime/session/');
        }
        // 启动session
        session_start();
        // 加载路由
        Route::init();
	}
}