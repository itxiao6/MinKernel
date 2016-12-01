<?php
namespace App\Controller\Admin;
use Kernel\Controller;
use Service\Mail;
use Service\Log;
// 验证码
use Gregwar\Captcha\CaptchaBuilder as Verification;

/**
* 前台测试控制器
*/

class LoginController extends Controller{
  public function index(){
    $this -> display('Admin.Public.Login');
  }
  // 执行登录
  public function login(){
      // 验证验证码
      if( empty($_SESSION['admin']['code']) or $_SESSION['admin']['code']!=$_POST['code'] ){
          $this -> ajaxReturn(['status'=>3,'message'=>'验证码错误']);
      }
      // 验证账号密码
      if( $user = M('admin')->where(['username'=>$_POST['username'],'password'=>md5($_POST['password'])])->first()->toArray() ){
          // 记录登录信息
          $_SESSION['admin']['user'] = $user;
          $this -> ajaxReturn(['status'=>0,'message'=>'登录成功']);
      }else{
          $this -> ajaxReturn(['status'=>1,'message'=>'登录失败']);
      }
  }
  public function get_code(){
      //生成验证码图片的Builder对象，配置相应属性
      $builder = new Verification;
      //可以设置图片宽高及字体
      $builder->build($width = 100, $height = 40, $font = null);
      //获取验证码的内容
      $phrase = $builder->getPhrase();
      //把内容存入session
      $_SESSION['admin']['code'] = $phrase;
      //生成图片
      header("Cache-Control: no-cache, must-revalidate");
      header('Content-Type: image/jpeg');
      $builder->output();
  }
}