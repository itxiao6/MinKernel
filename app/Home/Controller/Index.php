<?php
namespace App\Home\Controller;
use Kernel\Controller;
/**
* 首页控制器
*/

class Index extends Base {
  # 首页操作
  public function index($request){
      phpinfo();die();
    # 渲染模板
    $this -> display();
  }
}