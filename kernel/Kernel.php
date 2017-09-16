<?php
namespace Kernel;
use Service\Timeer;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Service\Session;
use Itxiao6\Route\Route;
use Itxiao6\Route\Http;
use Itxiao6\Route\Resources;
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
    protected static $class = [];
    /**
     * 类的映射
     */
    public static function auto_load($class){
        if(count(self::$class)==0){
            # 加载配置文件
            self::$class = C('all','class');
        }
        # 判断类是否存在
        if(isset(self::$class[$class])){
            # 获取类文件名
            $class_name = str_replace('\\','_',CLASS_PATH.self::$class[$class].'.php');
            # 判断缓存文件是否存在
            if(!file_exists($class_name)){
                # 写入文件
                file_put_contents($class_name,'<?php class '.$class.' extends '.self::$class[$class].'{ }');
            }
            # 引入映射类
            require($class_name);
        }
    }
    /**
     * 启动框架
     */
    public static function start()
    {
        # 判断环境变量配置文件是否存在
        if(file_exists(ROOT_PATH.'.env')){
            # 自定义配置
            $f= fopen(ROOT_PATH.'.env',"r");
        }else{
            # 惯例配置
            $f= fopen(ROOT_PATH.'env.example',"r");
        }
        # 循环行
        while (!feof($f))
        {
            $line = fgets($f);
            # 替换单个空格
            $line = preg_replace('! !','',$line);
            # 替换连续空格
            $line = preg_replace('! +!','',$line);
            # 替换制表符或空格
            $line = preg_replace('!\s+!','',$line);
            if((!strstr($line,'#')) && $line!=''){
                # 设置环境变量
                putenv(rtrim($line,'\n'));
            }
        }
        # 关闭文件
        fclose($f);
        # 设置协议头
        header("Content-Type:text/html;charset=utf-8");

        # 判断是否下载了composer包
        if ( file_exists(ROOT_PATH.'vendor'.DIRECTORY_SEPARATOR.'autoload.php') ) {

            # 引用Composer自动加载规则
            require(ROOT_PATH.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
        }else{

            # 退出程序并提示
            exit('请在项目根目录执行:composer install');
        }

        # 加载公用函数库
        require(ROOT_PATH.'common'.DIRECTORY_SEPARATOR.'functions.php');

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
            $debugbar->addCollector(new MessagesCollector('Time'));
            $debugbar->addCollector(new MessagesCollector('Request'));
            $debugbar->addCollector(new MessagesCollector('Session'));
            $debugbar->addCollector(new MessagesCollector('Database'));
            $debugbar->addCollector(new MessagesCollector('Application'));
            $debugbar->addCollector(new MessagesCollector('View'));
            $debugbar->addCollector(new ExceptionsCollector());

            $debugbarRenderer = $debugbar->getJavascriptRenderer();
        }
        # 注册类映射方法
        spl_autoload_register('Kernel\Kernel::auto_load');

        # 定义请求常量
        define('REQUEST_METHOD',Http::REQUEST_METHOD());
        # 是否为GET 请求
        define('IS_GET',Http::IS_GET());
        # 是否为POST 请求
        define('IS_POST',Http::IS_POST());
        # 是否为PUT 请求
        define('IS_PUT',Http::IS_PUT());
        # 是否为SSL(Https) 请求
        define('IS_SSL',Http::IS_SSL());
        # 是否为DELETE 请求
        define('IS_DELETE',Http::IS_DELETE());
        # 是否为WECHAT 请求
        define('IS_WECHAT',Http::IS_WECHAT());
        # 是否为Model 请求
        define('IS_MOBILE',Http::IS_MOBILE());
        # 是否为AJAX 请求
        define('IS_AJAX', Http::IS_AJAX());
        # 是否为CCG 请求
        define('IS_CGI',Http::IS_CGI());
        # 是否为SLI 环境
        define('IS_CLI',Http::IS_CLI());
        # 判断缓存主目录是否存在
        if(!is_dir(ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR)){
            # 递归创建目录
            mkdir(ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR,0777,true);
        }
        # 数据缓存目录
        define('CACHE_DATA',ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR);
        # 检查目录是否存在
        if(!is_dir(CACHE_DATA)){
            # 递归创建目录
            mkdir(CACHE_DATA,0777,true);
        }
        # 类映射缓存目录
        define('CLASS_PATH',ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR);
        # 检查目录是否存在
        if(!is_dir(CLASS_PATH)){
            # 递归创建目录
            mkdir(CLASS_PATH,0777,true);
        }
        # 日志文件缓存路径
        define('CACHE_LOG',ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR);
        # 检查目录是否存在
        if(!is_dir(CACHE_LOG)){
            # 递归创建目录
            mkdir(CACHE_LOG,0777,true);
        }
        # 会话文件缓存路径
        define('CACHE_SESSION',ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR.'session'.DIRECTORY_SEPARATOR);
        # 检查目录是否存在
        if(!is_dir(CACHE_SESSION)){
            # 递归创建目录
            mkdir(CACHE_SESSION,0777,true);
        }
        # 上传文件临时目录
        define('UPLOAD_TMP_DIR',ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR);
        # 检查目录是否存在
        if(!is_dir(UPLOAD_TMP_DIR)){
            # 递归创建目录
            mkdir(UPLOAD_TMP_DIR,0777,true);
        }
        # 模板编译缓存目录
        define('CACHE_VIEW',ROOT_PATH.'runtime'.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR);
        # 检查目录是否存在
        if(!is_dir(CACHE_VIEW)){
            # 递归创建目录
            mkdir(CACHE_VIEW,0777,true);
        }
        # 是否为WEN 环境
        define('IS_WIN',strstr(PHP_OS, 'WIN') ? 1 : 0 );
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
        # 设置url 分隔符
        Route::set_key_word(C('url_split','sys'));
        # 设置资源路由
        Resources::set_folder(C('all','abstract'));
        # 加载路由
        Route::init(function($app,$controller,$action){
            C('view_path','sys',['app' => ROOT_PATH.'app'.DIRECTORY_SEPARATOR.$app.DIRECTORY_SEPARATOR.'View','message'=>ROOT_PATH.'message']);
            # 应用名
            define('APP_NAME',$app);
            # 控制器名
            define('CONTROLLER_NAME',$controller);
            # 操作名
            define('ACTION_NAME',$action);
        });
    }
}