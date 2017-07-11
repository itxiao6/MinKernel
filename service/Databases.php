<?php
namespace Service;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;
// 文档参考 https://laravel.com/api/5.4/Illuminate/Database/Schema/Blueprint.html
class Databases{
    public static function __init(){
        # 获取全局的数据库连接
        global $database;
        # 判断数据库是否已经连接
        if ( $database === false ) {
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
    public static function init(){
        self::__init();
        // 建表
        DB::schema()->create('users', function($table)
        {
            $table->increments('id');
            $table->string('username', 40);
            $table->string('email')->unique();
            $table->timestamps();
        });
    }
}
