<?php
namespace App\Admin\Controller;
use Kernel\Controller;
/**
 * 后台鉴权控制器
 */
class Auth extends Controller
{
    # 后台登录方法
    public function login($request)
    {
        if (IS_POST) {
            # 登录
            if ($admin = M('admin')->where(['username' => $request->input('username'), 'password' => md5($request->input('password'))])->first()) {
                $_SESSION['admin'] = $admin->toArray();
                $this->ajaxReturn(['status' => 1,'message'=>'登录成功','url'=>'/Index/index.html']);
            } else {
                $this->ajaxReturn(['status' => 0,'message'=>'登录失败']);
            }
        } else {
            $this->display();
        }
    }


    #修改管理员密码
    public function updatePassword()
    {
        if (IS_POST) {
            if(M('admin')->where(['id'=>$_SESSION['admin']['id'],'password'=>md5($_POST['oldpwd'])])->first()){
                M('admin') -> where(['id'=>$_SESSION['admin']['id']]) -> update(['password'=>md5($_POST['pwd'])]);
                $_SESSION['admin'] = '';
                echo '<script>alert("密码修改成功,重新登陆");location="/Auth/login.html"</script>';
            }else{
                exit('<script>alert("原始密码不正确");history.go(-1)</script>');
            }
        }else{
            $this->display();
        }
    }

    #退出
    public function logout()
    {
        $_SESSION['admin'] = null;
        redirect('/Auth/login.html');
    }
}