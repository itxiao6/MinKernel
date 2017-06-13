<?php
namespace App\Home\Controller;
use Kernel\Controller;
/**
* 首页控制器
*/

class Index extends Controller{
  # 首页操作
  public function index(){
		# 渲染模板
	 $this -> display();
  }
}