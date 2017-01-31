<?php
namespace Service;
/**
 * 日志处理类
 */
class Log {
    // log储存表
    CONST TABLE = 'log';
    // log写入目录
    CONST LOG_PATH = ROOT_PATH.'runtime/log';
    /**
    * 数据库存储初始化
    */
    protected static function init(){
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
        // 查询系统表
        $result = (Array) DB('information_schema.TABLES')
            ->where(['table_name'=>self::TABLE,'TABLE_SCHEMA'=>C('read','database')['database']])
            ->first();
        // 判断session表是否已经创建
        if( count($result) < 1 ){
            // 如果不存在 则进行创建
            DB::schema()->create(self::TABLE, function($table){
                $table->integer('id',11);
                $table->char('type',50) -> nullable('type');
                $table->char('message',50) -> nullable('message');
                $table->char('sql',255) -> nullable('sql');
                $table->char('ip',200);
                $table->char('url',255);
                $table->char('time',50);
            });
        }
    }
    /**
     * [write_database 写入数据库log]
     * @param  [String] $message [log消息]
     * @param  [String] $type    [log类型]
     * @param  [String] $sql     [log sql]
     * @return [Bool]          [是否写入成功]
     */
    protected static function write_database($message,$type,$sql) {
        // 初始化log类
        self::init();
        // 写入数据
        return DB(self::TABLE) -> insert([
                'type'=>$type,
                'message'=>$message,
                'sql'=>$sql,
                'ip'=>get_client_ip(),
                'url'=>$_SERVER['REQUEST_URI'],
                'time'=>time()
            ]);
    }
    // log文件写入
    /**
     * [write_file 写入文件log]
     * @param  [String] $message [log消息]
     * @param  [String] $type    [log类型]
     * @param  [String] $sql     [log sql]
     * @return [Bool]          [是否写入成功]
     */
    protected static function write_file($message,$type,$sql) {
        // 判断模板编译目录是否存在并且有写入的权限
        if( (!file_exists(self::LOG_PATH)) or (!is_writable(self::LOG_PATH)) ){
            throw new \Exception("Log目录目录不存在或没写入有权限");
        }
        // 获取今天的日志
        if(file_exists(self::LOG_PATH.date('Y_m_d').log)){
            // 累加写入
            $data = file_get_contents(date('Y_m_d.log'))."\n";
        }else{
            // 新建写入
            $data = '';
        }
        // 组合Log信息
        $data .= 'message:'.$message."\n";
        $data .= 'type:'.$type."\n";
        $data .= 'sql:'.$sql."\n";
        $data .= 'ip:'.get_client_ip()."\n";
        $data .= 'url:'.$_SERVER['REQUEST_URI']."\n";
        $data .= 'time:'.time();
        // 写入文件并返回结果
        return file_put_contents(self::LOG_PATH.'/'.date('Y_m_d').'.log',$data);
    }
    /**
     * [write 写入log]
     * @param  [String] $message [log消息]
     * @param  [String] $type    [log类型]
     * @param  [String] $sql     [log sql]
     * @return [Bool]          [是否写入成功]
     */
    public static function write($message,$type='',$sql=''){
        // 获取要写入的类型
        if(C('log','sys')=='database'){
            // 数据库写入
            self::write_database($message,$type,$sql);
        }else{
            // 文件写入
            self::write_file($message,$type,$sql);
        }
    }
}