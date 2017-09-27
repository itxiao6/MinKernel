<?php
namespace Service;
use Itxiao6\Upload\File;
use Config;

/**
 * 文件上传类
 * Class Upload
 * @package Service
 */
class Upload
{
    /**
     * 错误信息
     * @var
     */
    protected static $errors = false;
    /**
     * 上传类
     * @var bool
     */
    protected static $upload = false;
    /**
     * 装饰者
     * @param $name
     * @param $arguments
     * @return array|bool
     */
    public static function __callStatic($name, $arguments)
    {
        if(self::$upload===false){
            # 初始化驱动
            self::$upload = self::getDriver();
        }
        # 使用驱动方法
        self::$upload -> $name(...$arguments);
    }
    # 获取驱动
    protected static function getDriver()
    {
        # 存储类型
        $type = Config::where(['type'=>7,'name'=>'type']) -> value('value');
        # 参数
        $param = [];
        if($type == 'local'){
            # 上传文件夹
            $param['directory'] = ROOT_PATH.'public/upload/';
        }
        # 返回接口
        return File::getInterface($type,$param);
    }

    /**
     * 获取当前文件储存驱动
     * @return mixed
     */
    public static function get_driver()
    {
        return self::$storage;
    }

    /**
     * 获取上传错误信息
     * @return null
     */
    public static function get_error()
    {
        return self::$errors;
    }
}