<?php
namespace Service;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;
/**
* 缓存信息类
*/
class Cache{
	// 检查数据库连接
	public static function checkDatabase(){
		// 获取全局的数据库连接
		global $database;
		// 判断数据库是否已经连接
		if ( $database === false ) {
			// 连接数据库
            $database = new DB;
            // 载入数据库配置
            $database->addConnection(C('all','database'));
            // 设置全局静态可访问
            $database->setAsGlobal();
            // 启动Eloquent
            $database -> bootEloquent();
		}
	}

	/**
	 * 获取值
	 * 
	 * 
	 * 
	 **/
    public static function get($key,$default=null){
    	Cache::checkDatabase();
    	// 获取数据
    	$data = DB::table('cache') -> where(['name'=>$key]) -> where('out_time','>',time()) -> first();
    	return $data!=null ? $data -> value : $default;
    }
	/**
	 * 设置值
	 * 
	 * 缓存key
	 * 缓存值
	 * 缓存有效期
	 * 
	 **/
    public static function set($key,$value,$time){
    	Cache::checkDatabase();
    	$cache = M('cache');
    	$cache -> name = $key;
    	$cache -> value = $value;
    	$cache -> out_time = time() + $time;
    	if($cache -> save()){
    		return $value;
    	}else{
    		return false;
    	}
    }

}