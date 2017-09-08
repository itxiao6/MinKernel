<?php
namespace Service;
use Itxiao6\Upload\Storage\FileSystem;
use Itxiao6\Upload\Storage\QiniuSystem;
use Itxiao6\Upload\File;
use Itxiao6\Upload\Validation\Size;

/**
 * 文件上传类
 * Class Upload
 * @package Service
 */
class Upload
{
    /**
     * 储存
     * @var bool
     */
    protected static $storage = false;
    /**
     * 错误信息
     * @var
     */
    protected static $errors = null;

    protected static function __init()
    {
        if(self::$storage==false){
            switch (C('type','storage')){
                case 'local':
                    self::$storage = new FileSystem(ROOT_PATH.'public/upload','http://test/upload/');
                    break;
                case 'qiniu':
                    $storage = new QiniuSystem(
                        C('accessKey','qiniu'),
                        C('secretKey','qiniu'),
                        C('Bucket_Name','qiniu'),
                        C('Bucket_Host','qiniu'));
                    break;
            }
        }
    }

    /**
     * 修饰者
     * @param $name
     * @param $arguments
     */
    public static function __callStatic($name, $arguments)
    {
        switch($name){
            case 'upload':
                self::upload_file(...$arguments);
                break;
            case 'uploads':
                self::upload_files(...$arguments);
                break;
            default:
                break;
        }
        // TODO: Implement __callStatic() method.
    }

    /**
     * 上传多个文件
     * @param array $file_field
     * @param null $validations
     * @return array
     */
    protected static function upload_files($file_field = [],$validations = null){
        $result = [];
        foreach ($file_field as $key=>$item){
            $result[] = self::upload_file($item,$validations[$key]);
        }
        return $result;
    }

    /**
     * 上传一个文件
     * @param string $file_field
     * @param null $validations
     * @return bool
     */
    protected static function upload_file($file_field,$validations = null){
        # 初始化文件上传系统
        $file = new File($file_field, self::$storage);
        # 随机生成文件名
        $new_filename = uniqid();
        # 设置文件名
        $file->setName($new_filename);
        # 添加验证规则
        $file->addValidations(array(
            $validations == null?
            new Size('5M'):
            $validations
        ));
        // 尝试上传文件
        try {
            // 成功!
            $file->upload();
        } catch (\Exception $e) {
            // 失败!
            $errors = $file->getErrors();
        }
        if($errors==null){
            return $file -> getWebUrl();
        }else{
            self::$errors = $errors;
            return false;
        }
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