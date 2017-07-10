<?php
namespace App\Home\Controller;
use Kernel\Controller;
/**
* 首页控制器
*/

class Index extends Controller{
  # 首页操作
  public function index($request){
      dump(I('name'));die();
      dd($request -> session());
		# 渲染模板
	 $this -> display();
  }
}