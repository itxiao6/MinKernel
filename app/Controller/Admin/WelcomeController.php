<?php
namespace App\Controller\Admin;
use Service\Mail;
use Service\Log;
/**
* 初始欢迎页
*/

class WelcomeController extends Base{
  public function index(){
	echo "hello world";
  }
}
