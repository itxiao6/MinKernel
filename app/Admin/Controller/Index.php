<?php
namespace App\Admin\Controller;
use Service\Log;

/**
* 后台测试控制器
*/

class Index extends Base{
  public function index(){
     $this -> redirect("Welcome/index");
  }
}
