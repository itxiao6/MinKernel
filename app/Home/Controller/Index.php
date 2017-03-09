<?php
namespace App\Home\Controller;
use Illuminate\Database\Capsule\Manager as DB;
use Service\Wechat;
/**
* 初始欢迎页
*/

class Index extends Base{
  
  public function test(){
    echo 111;
  }
  public function index(){
    
  }

  public function infos(){
    // dump(1110);die;
    $this -> display('Index.info');
  }

}