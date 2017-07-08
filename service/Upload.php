<?php
namespace Service;
/**
 +-----------------------------------------------------------------------------
 * 文件上传类
 +-----------------------------------------------------------------------------
 * @author 刘广财
 +-----------------------------------------------------------------------------
 */
class Upload{
  # 定义上传文件夹
  protected static $folder = ROOT_PATH.'public'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR;
  # 暴露到web的路径
  protected static $web_folder = '/upload/';
  # 定义允许后缀名
  protected static $suffix = ['.gif','.jpg','.jpeg','.bmp','.png','.swf'];
  # 文件后缀名
  protected static $file_name;
  # 上传的临时文件
  protected static $tmp_file;
  # 错误号
  public static $error;
  # 错误信息
  public static $message;
  # 上传后的文件名
  protected static $upload_file = [];


  # 处理图片
  public static function upload_one($file)
  {
    # 判断上传的目录是否存在
    if(!file_exists(self::$folder)){
      self::$error = 1;
      self::$message = '上传目标文件夹不存在';
      return false;
    }
    # 获取要上传的临时文件名称
    self::$tmp_file = $file['tmp_name'];
    # 判断临时文件是否存在
    if(!file_exists(self::$tmp_file)){
      self::$error = 2;
      self::$message = '上传的临时文件不存在';
      return false;
    }
    # 获取文件后缀名
    $suffix = substr($file['name'],strrpos($file['name'],'.'));
    # 判断是否为合法文件
    if(in_array($suffix,self::$suffix)){
      self::$upload_file[0] = getRandomString(15);
      # 上传文件
      move_uploaded_file(self::$tmp_file,self::$folder.self::$upload_file[0].$suffix);
      return self::$web_folder.self::$upload_file[0].$suffix;
    }else{
      self::$error = 3;
      self::$message = '文件类型错误';
      return false;
    }
  }
  # =============处理图片数组============
  public static function uploads_array($file)
  {
    # 判断上传的目录是否存在
    if(!file_exists(self::$folder)){
      self::$error = 1;
      self::$message = '上传目标文件夹不存在';
      return false;
    }
    $picname=[];
    foreach ($file['tmp_name'] as $key => $value) {
      # 获取要上传的临时文件名称
      self::$tmp_file = $value;
      # 判断临时文件是否存在
      if(!file_exists(self::$tmp_file)){
        self::$error = 2;
        self::$message = '上传的临时文件不存在';
        return false;
      }
      foreach ($file['name'] as $k => $v) {
             #找出对应的图片
            if ($key==$k) {
              # 获取文件后缀名
              $suffix = substr($v,strrpos($v,'.'));
              # 判断是否为合法文件
              if(in_array($suffix,self::$suffix)){
                self::$upload_file[0] = getRandomString(15);
                # 上传文件
                move_uploaded_file(self::$tmp_file,self::$folder.self::$upload_file[0].$suffix);
                $picname[]= self::$web_folder.self::$upload_file[0].$suffix;
              }else{
                self::$error = 3;
                self::$message = '文件类型错误';
                return false;
              }
          }
      }
   }
      return $picname;
  }
}