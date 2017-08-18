<?php
namespace Service;
use Itxiao6\Database\Capsule\Manager;
use Illuminate\Container\Container;

/**
 * 数据库类
 * Class DB
 * @package Service
 */
class DB extends Manager
{
    /**
     * 数据库链接
     */
    public static function connection_databases(){
        # 获取全局的数据库连接
        global $database;
        # 判断数据库是否已经连接
        if ( $database === false || $database == null) {
            # 连接数据库
            $database = new Manager;
            # 载入数据库配置
            $database->addConnection(C('all','database'));
            # 设置全局静态可访问
            $database->setAsGlobal();
            # 启动Eloquent
            $database -> bootEloquent();
            # 判断是否开启LOG日志
            if(C('database_log','sys')){
                Manager::connection()->enableQueryLog();
            }
        }
    }
    /**
     * Dynamically pass methods to the default connection.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        self::connection_databases();
        return static::connection()->$method(...$parameters);
    }
    /**
     * Create a new database capsule manager.
     *
     * @param  \Illuminate\Container\Container|null  $container
     * @return void
     */
    public function __construct(Container $container = null)
    {
        self::connection_databases();
        $this->setupContainer($container ?: new Container);

        // Once we have the container setup, we will setup the default configuration
        // options in the container "config" binding. This will make the database
        // manager work correctly out of the box without extreme configuration.
        $this->setupDefaultConfiguration();

        $this->setupManager();
    }
    public static function table($table, $connection = null)
    {
        self::connection_databases();
        return parent::table($table, $connection);
    }
    public static function schema($connection = null)
    {
        self::connection_databases();
        return parent::schema($connection);
    }
}