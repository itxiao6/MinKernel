<?php
use iamdual\Upload;
/**
* 文件上传类
*/
class Upload{
    // 上传参数的配置
    protected static $config = [
        'fileSuffix' => ['png','jpg','jpeg','gif'],
        'fileType' => ["image/png", "image/jpeg"],
        'maxSize' => 5, // 上传文件最大的尺寸 单位为 M
        'uploadPath' => 'upload/files', // 文件上传路径
    ];
    // 本次上传文件的文件名
    protected static $reandFileName;
    // 本次上传的错误信息
    protected static $error;

    /**
     * @param  [要上传的文件]
     * @param  Array|可选的配置参数
     * @return [Bool]是否上传成功
     */
    public static function upload_one($file,Array $config=[]){
        // 判断是是否修改了 配置
        if(count($config) > 0){
            // 修改配置
            self::$config = $config;
        }
        // 判断要上传的文件是否存在
        if (isset($file)) {
            // 实例化文件上传类
            $upload = new Upload($file);
            // 设置允许上传的文件后缀名
            $upload->allowed_extensions(self::config['fileSuffix']);
            // 设置文件类型
            $upload->allowed_types(self::config['fileType']);
            // 设置文件上传最大的尺寸
            $upload->max_size(self::config['maxSize']);
            // 获取随机文件名
            self::reandFileName = self::getRandFileName();
            // 设置新文件名
            $upload->new_name(self::reandFileName);
            // 设置上传路径
            $upload->path(self::config['uploadPath']);
            // 执行文件上传并判断是否成功
            if (! $upload->upload()) {
                // 获取错误信息
                self::$error = $upload->error();
                // 上传失败返回假
                return false;
            }else{
                // 上传成功返回真
                return true;
            }
        }
    }
    /**
     * @return [String] 随机获取的文件名
     */
    protected static function getRandFileName(){
        // 声明要使用的变量
        $fileName = '';
        // 先累加时间为文件名的开头
        $fileName .= time();
        // 循环获得文件名
        for($i=0; $i < 5; $i++){
            $fileName = rand(0,9);
        }
        // 返回结果
        return $fileName;
    }

}

