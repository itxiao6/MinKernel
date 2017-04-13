<?php
namespace App\Home\Controller;
use Service\Upload;
/**
* 首页控制器
*/

class Index extends Base{
  # 首页操作
  public function index(){
  	if(IS_POST){
  		# 上传文件
  		dump(Upload::upload_one($_FILES['file']));
      dump(Upload::$error);
      dump(Upload::$message);
  		die();
  	}else{
  		# 渲染模板
    	$this -> display();
  	}
  }
}