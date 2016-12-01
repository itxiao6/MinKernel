<?php
namespace App\Controller\Admin;
use Service\Mail;
use Service\Log;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;
/**
* 用户管理管理
*/

class UserController extends Base{
  public function index(){
    // 获取数据
  	$data = M('users') -> get() -> toArray();
    // 渲染模板
    $this -> display('Admin.User.lists',['data'=>$data,'one'=>$one]);
  }
  public function add(){
    // 获取数据
  	$data = M('users') -> get() -> toArray();
    // 渲染模板
  	$this -> display('Admin.User.add',['data'=>$data]);
  }
  public function insert(){
  	// 获取模型
  	$users = M('users');
    $users -> username = $_POST['username'];
    $users -> password = $_POST['password'];
    $users -> email = $_POST['email'];
    $users -> phone = $_POST['phone'];
  	$users -> truename = $_POST['truename'];
  	$users -> number_id = $_POST['number_id'];
  	$users -> header_url = $_POST['header_url'];
  	// 执行添加
  	if( $users -> save() ){
  		redirect('/Admin/User/add.html?status=success&message=添加成功&description=用户添加成功');
  	}else{
  		redirect('/Admin/User/add.html?status=danger&message=添加失败&description=用户添加失败');
  	}
  }
  public function edit(){
    // 获取数据
  	$data = M('users') -> find($_GET['id']) -> toArray();
    // 渲染模板
  	$this -> display('Admin.User.edit',['data'=>$data]);
  }
  public function save(){
  	// 执行修改
  	if( M('users') -> where(['id'=>$_GET['id']]) -> update($_POST) ){
  		redirect('/Admin/User/edit.html?status=success&message=修改成功&description=用户修改成功&id='.$_GET['id']);
  	}else{
  		redirect('/Admin/User/edit.html?status=danger&message=修改失败&description=用户修改失败&id='.$_GET['id']);
  	}
  }
  public function delete(){
  	if( M('users') -> where(['id'=>$_GET['id']]) -> delete() ){
  		redirect('/Admin/User/lists.html?status=success&message=删除成功&description=用户删除成功');
  	}
  }
}