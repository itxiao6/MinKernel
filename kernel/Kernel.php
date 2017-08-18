<?php
namespace Kernel;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Service\Session;
use Service\Route;
use Service\Http;
use DebugBar\StandardDebugBar;
//
use DebugBar\DebugBar;
use DebugBar\DataCollector\ExceptionsCollector;
use DebugBar\DataCollector\MemoryCollector;
use DebugBar\DataCollector\MessagesCollector;
use DebugBar\DataCollector\PhpInfoCollector;
use DebugBar\DataCollector\RequestDataCollector;
use DebugBar\DataCollector\TimeDataCollector;
use DebugBar\DataCollector\LocalizationCollector;
use DebugBar\DataCollector\DataCollector;
use DebugBar\DataCollector\ConfigCollector;
use DebugBar\DataCollector\AggregatedCollector;
/**
* 框架核心类
*/
class Kernel
{
    /**
     * 启动框架
     */
    public static function start()
    {
        # 设置协议头
        header("Content-Type:text/html;charset=utf-8");

        # 加载公用函数库
        require(ROOT_PATH.'common'.DIRECTORY_SEPARATOR.'functions.php');
        # 判断是否下载了composer包
        if ( file_exists(ROOT_PATH.'vendor'.DIRECTORY_SEPARATOR.'autoload.php') ) {

            # 引用Composer自动加载规则
            require(ROOT_PATH.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
        }else{

            # 退出程序并提示
            exit('请在项目根目录执行:composer install');
        }
        # 判断是否为调试模式
        if( DE_BUG === TRUE ){
            # 屏蔽所有notice 和 warning 级别的错误
            error_reporting(E_ALL^E_NOTICE^E_WARNING);
            $whoops = new Run;
            $whoops->pushHandler(new PrettyPageHandler);
            $whoops->register();
            # 禁止所有页面缓存
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
            header('Cache-Control: no-cache, must-revalidate');
            header('Pragma: no-cache');
        }else{
            # 屏蔽所有错误
            error_reporting(0);
        }

        # 设置时区
        date_default_timezone_set(C('default_timezone','sys'));
        # 判断是否开启了debugbar
        if( C('debugbar','sys') ) {
            # 定义全局变量
            global $debugbar;
            global $debugbarRenderer;
            global $database;

            # 启动DEBUGBAR
            $debugbar = new DebugBar();
            $debugbar->addCollector(new PhpInfoCollector());
            $debugbar->addCollector(new TimeDataCollector());
            $debugbar->addCollector(new MessagesCollector('Request'));
            $debugbar->addCollector(new MessagesCollector('Session'));
            $debugbar->addCollector(new MessagesCollector('Database'));
            $debugbar->addCollector(new MessagesCollector('Application'));
            $debugbar->addCollector(new MessagesCollector('View'));
            $debugbar->addCollector(new ExceptionsCollector());

            $debugbarRenderer = $debugbar->getJavascriptRenderer();
        }

        # 定义请求常量
        define('REQUEST_METHOD',$_SERVER['REQUEST_METHOD']);
        # 是否为GET 请求
        define('IS_GET',REQUEST_METHOD =='GET' ? true : false);
        # 是否为POST 请求
        define('IS_POST',REQUEST_METHOD =='POST' ? true : false);
        # 是否为PUT 请求
        define('IS_PUT',REQUEST_METHOD =='PUT' ? true : false);
        # 是否为SSL(Https) 请求
        define('IS_SSL',Http::IS_SSL()     ==true ? true : false);
        # 是否为DELETE 请求
        define('IS_DELETE',REQUEST_METHOD =='DELETE' ? true : false);
        # 是否为WECHAT 请求
        define('IS_WECHAT',Http::IS_WECHAT()     ==true ? true : false);
        # 是否为Model 请求
        define('IS_MOBILE',Http::IS_MOBILE()     ==true ? true : false);
        # 是否为AJAX 请求
        define('IS_AJAX', Http::IS_AJAX() == true ? true : false);
        # 数据缓存目录
        define('CACHE_DATA',ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR);
        # 日志文件缓存路径
        define('CACHE_LOG',ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR);
        # 会话文件缓存路径
        define('CACHE_SESSION',ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR.'session'.DIRECTORY_SEPARATOR);
        # 上传文件临时目录
        define('UPLOAD_TMP_DIR',ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR);
        # 模板编译缓存目录
        define('CACHE_VIEW',ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR);
        # 是否为CCG 请求
        define('IS_CGI',(0 === strpos(PHP_SAPI,'cgi') || false !== strpos(PHP_SAPI,'fcgi')) ? 1 : 0 );
        # 是否为WEN 环境
        define('IS_WIN',strstr(PHP_OS, 'WIN') ? 1 : 0 );
        # 是否为SLI 环境
        define('IS_CLI',PHP_SAPI=='cli'? 1   :   0);
        # 定义数据库链接状态为全局变量
        global $database;
        # 定义全局数据库链接为未连接
        $database = false;

        # 设置SessionCookie名称
        session_name('MiniKernelSession');

        # 修改session文件的储存位置
        session_save_path(CACHE_SESSION);
        
        # 设置图片上传临时目录
        ini_set('upload_tmp_dir', UPLOAD_TMP_DIR);

        # 设置session有效期
        // session_set_cookie_params( C('session_lifetime','sys') );

        # 判断session存储方式
        if(env('session_save') == 'redis'){
            ini_set("session.save_handler", "redis");
            ini_set("session.save_path", "tcp://".C('host','redis').":".C('port','redis'));
        }

        # 启动session
        session_start();


        # 获取API模式传入的参数
        $param_arr = getopt('U:');
        # 判断是否为API模式
        if($param_arr['U']){
            $_SERVER['REDIRECT_URL'] = $param_arr['U'];
            $_SERVER['PHP_SELF'] = $param_arr['U'];
            $_SERVER['QUERY_STRING'] = $param_arr['U'];
        }
        # 加载路由
        Route::init();
    }
}