<?php
namespace Service;
/**
 +-----------------------------------------------------------------------------
 * 文件上传类
 +-----------------------------------------------------------------------------
 * @author Administrator
 +-----------------------------------------------------------------------------
 */
class Local_Upload{
  # 处理图片
  public static function upload($file){
    $file_path = $file['tmp_name'];
    $file_type = $file['type'];
    # 获取文件名后缀
    $file_name = substr($file['name'],strrpos($file['name'],'.'));
    # 判断是否为合法文件
    if(in_array($file_name, array('.gif','.jpg','.jpeg','.bmp','.png','.swf'))){
      $upload_name = self::get_rand_file_name();
      # 上传文件
      move_uploaded_file($file['tmp_name'],ROOT_PATH.'public/upload/'.$upload_name.$file_name);
      return '/upload/'.$upload_name.$file_name;
    }else{
      return false;
    }
  }
  # 获取随机文件名
  protected static function get_rand_file_name(){
    $str = '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY';
    for ($i=0; $i < 40; $i++) {
      $string .= $str[rand(0,52)];
    }
    return $string.time();
  }
}