<?php
namespace Service;
use Qiniu\Qiniu as Qiniua;

/**
 * 七牛云存储
 * Class Qiniu
 * @package Service
 */
class Qiniu
{
    /**
     * 连接实例
     * @var \Qiniu\Client
     */
    protected static $client;

    /**
     * 构造方法
     * Qiniu constructor.
     */
    public function __construct()
    {
        self::$client = Qiniua::create([
            'access_key' => C('accessKey','qiniu'),
            'secret_key' => C('secretKey','qiniu'),
            'bucket'     => C('Bucket_Name','qiniu')
        ]);
    }

    /**
     * 上传一个文件
     * @param $file 文件
     * @return mixed 成功的 url
     */
    public function upload($file){
        $result = self::$client -> uploadFile(if_array($file)?$file['tmp_name']:$file);
        return $result -> data['url'];
    }

    /**
     * 上传多个文件
     * @param $files 文件数组
     * @return array
     */
    public function uploads($files){
        $result = [];
        foreach ($files['tmp_name'] as $file){
            $result = $this -> upload($file) -> data['url'];
        }
        return $result;
    }
}