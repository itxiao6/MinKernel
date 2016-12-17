<?php
namespace App\Controller\Admin;
use Kernel\Controller;
/**
* 后台权限管理中间件
*/

class Base extends Controller{
  public function __construct(){
    // 调用父类的构造方法
    parent::__construct();
    // 权限验证
    if( empty($_SESSION['admin']['user']) ){
      // 重定向
      redirect('/Admin/Login.html');
    }
  }
}