<?php
namespace App\Admin\Controller;
use Kernel\Controller;
use Service\Hash;

/**
 * 后台鉴权控制器
 */
class Auth extends Controller
{
    # 后台登录方法
    public function login()
    {
        if (IS_POST) {
            # 获取用户的信息
            if($admin = M('admin') -> where(['username' => $_POST['username']])->first()){
                # 判断密码是否正确
                if(Hash::check($_POST['password'],$admin -> password)){
                    $_SESSION['admin']['user'] = $admin->toArray();
                    $this->ajaxReturn(['status' => 1,'message'=>'登录成功','url'=>'/Index/index.html']);
                }else{
                    $this->ajaxReturn(['status' => 2,'message'=>'密码错误']);
                }
            }else{
                $this->ajaxReturn(['status' => 4,'message'=>'账号不存在']);
            }
        }else{
            $this -> display();
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
    # 清除缓存
    public function clear(){

    }
}