<?php
namespace Service;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;
/**
* session管理类
*/
class Session{
	// session 有效期
	public $lifetime;
	// 数据库存储表名
	public $table = 'session';
	/**
	* 构造函数
	*/
	public function __construct(){
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
		// 获取session 有效时间
		$this -> lifetime = C('session_lifetime','sys');
		// 查询系统表
		$result = (Array) DB::table('information_schema.TABLES')
			->where(['table_name'=>$this -> table,'TABLE_SCHEMA'=>C('read','database')['database']])
			->first();
		// 判断session表是否已经创建
		if( count($result) < 1 ){
			// 如果不存在 则进行创建
			DB::schema()->create($this -> table, function($table){
			    $table->char('id',30)->primary('id');
			    $table->text('data');
			    $table->char('ip',50);
			    $table->string('last_visit',50);
			});
		}
		// 接管session
		session_set_save_handler(
			[&$this, 'open'],  // 在运行session_start()时执行
			[&$this, 'close'],  // 在脚本执行完成 或 调用session_write_close() 或 session_destroy()时被执行，即在所有session操作完后被执行
			[&$this, 'read'],  // 在运行session_start()时执行，因为在session_start时，会去read当前session数据
			[&$this, 'write'],  // 此方法在脚本结束和使用session_write_close()强制提交SESSION数据时执行
			[&$this, 'destroy'], // 在运行session_destroy()时执行
			[&$this, 'gc']   // 执行概率由session.gc_probability 和 session.gc_divisor的值决定，时机是在open，read之后，session_start会相继执行open，read和gc
		);
	}
	/**
	* session_set_save_handler open方法
	*
	* @param $savePath
	* @param $sessionName
	* @return true
	*/
	public function open($savePath, $sessionName) {
		return true;
	}
	/**
	* session_set_save_handler close方法
	*
	* @return bool
	*/
	public function close(){
		return $this->gc();
	}
	/**
	* 读取session_id
	*
	* session_set_save_handler read方法
	* @return string 读取session_id
	*/
	public function read($sessionId) {
		$result = (Array) DB::table($this -> table) -> find($sessionId);
		if(count($result) == 4){
			return $result['data'];
		}else{
			return null;
		}
	}
	/**
	* 写入session_id 的值
	*
	* @param $sessionId 会话ID
	* @param $data 值
	* @return mixed query 执行结果
	*/
	public function write($sessionId,$data) {
		$sessionData = array(
			'id' => (String) $sessionId,
			'data' => (String) $data,
			'ip' => (String) $_SERVER["REMOTE_ADDR"],
			'last_visit' => (Int) time(),
		);
		$res = (Array) DB::table($this -> table) -> find($sessionId);
		if(count($res) == 4){
			unset($sessionData['id']);
			return (Bool) DB::table($this -> table) -> where(['id'=>$sessionId]) ->update($sessionData);
		}else{
			return (Bool) DB::table($this -> table)->insert($sessionData);
		}
	}
	/**
	* 删除指定的session_id
	*
	* @param string $sessionId 会话ID
	* @return bool
	*/
	public function destroy($sessionId){
		return (Bool) DB::table($this -> table)->where('id', '=',$session_id)->delete();

	}
	/**
	* 删除过期的 session
	*
	* @return bool
	*/
	public function gc($lifetime='1') {
		return (Bool) DB::table($this -> table)->where('last_visit', '<',time() - $this -> lifetime)->delete();
	}
}