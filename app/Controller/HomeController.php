<?php
namespace App\Controller;
use Kernel\Controller;
use Service\Mail;
use Service\Log;
// 验证码
use Gregwar\Captcha\CaptchaBuilder as Verification;

/**
* 前台测试控制器
*/

class HomeController extends Controller{
  public function home(){
    // dd(M('address') -> get() -> toArray());
    // $this -> display('Home.Welcome');
    $this -> display('Home.home');
  }

  public function get_code(){
      //生成验证码图片的Builder对象，配置相应属性
      $builder = new Verification;
      //可以设置图片宽高及字体
      $builder->build($width = 100, $height = 40, $font = null);
      //获取验证码的内容
      $phrase = $builder->getPhrase();

      //把内容存入session
      $phrase;
      //生成图片
      header("Cache-Control: no-cache, must-revalidate");
      header('Content-Type: image/jpeg');
      $builder->output();
  }
}