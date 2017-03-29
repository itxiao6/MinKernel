<?php
namespace App\Admin\Controller;
/**
* 后台首页控制器
*/

class Index extends Base{
  public function index(){
  	# 渲染模板
     $this -> display();
  }
}
