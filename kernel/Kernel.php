<?php
namespace Kernel;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Service\Session;
use Service\Route;
use DebugBar\StandardDebugBar;
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

        // 设置协议头
        header("Content-Type:text/html;charset=utf-8");

        // 判断是否下载了composer包
        if (file_exists(ROOT_PATH.'vendor/autoload.php')) {

            // 引用Composer自动加载规则
            require(ROOT_PATH.'vendor/autoload.php');
        }else{

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
            register_shutdown_function(function(){send_http_status(500);});
            set_error_handler(function(){send_http_status(500);});
            set_exception_handler(function(){send_http_status(500);});
            error_reporting(0);
        }
        // 加载公用函数库
        require(ROOT_PATH.'common/functions.php');
        // 定义全局变量
        global $debugbar;
        global $debugbarRenderer;
        global $database;

        // 启动DEBUGBAR
        $debugbar = new StandardDebugBar();
        $debugbarRenderer = $debugbar->getJavascriptRenderer();

        // 定义请求常量
        define('REQUEST_METHOD',$_SERVER['REQUEST_METHOD']);
        define('IS_GET',        REQUEST_METHOD =='GET' ? true : false);
        define('IS_POST',       REQUEST_METHOD =='POST' ? true : false);
        define('IS_PUT',        REQUEST_METHOD =='PUT' ? true : false);
        define('IS_DELETE',     REQUEST_METHOD =='DELETE' ? true : false);
        define('IS_WECHAT',     isweixin()     ==true ? true : false);

        // 定义全局数据库链接为未连接
        $database = false;

        // 设置SessionCookie名称
        session_name('MiniKernelSession');

        // 启动session
        if( C('session','sys') == 'database' ){

            // 启动数据库储存方式的session
            new Session;

        }else{

            // 修改session文件的储存位置
            session_save_path(ROOT_PATH.'runtime/session/');
        }

        // 设置session有效期
        session_set_cookie_params( C('session_lifetime','sys') );

        // 启动session
        session_start();

        // 判断是否为API模式
        $param_arr = getopt('U:');
        if($param_arr['U']){
            $_SERVER['REDIRECT_URL'] = $param_arr['U'];
        }
        // 加载路由
        Route::init();
	}
}