<?php
namespace Service;
# 引入父类
use Illuminate\Database\Capsule\Manager;

/**
 * DB 类
 * Class DB
 * @package Service
 */
class DB extends Manager{
    /**
     * 检测是否链接了数据库
     * @param $func
     * @param $arguments
     */
    public static function __callStatic($func,$arguments){
        # 获取全局的数据库连接
        global $database;
        # 判断数据库是否已经连接
        if ( $database === false || $database == null) {
            # 连接数据库
            $database = new DB;
            # 载入数据库配置
            $database->addConnection(C('all','database'));
            # 设置全局静态可访问
            $database->setAsGlobal();
            # 启动Eloquent
            $database -> bootEloquent();
            # 判断是否开启LOG日志
            if(C('database_log','sys')){
                DB::connection()->enableQueryLog();
            }
        }
    }
}