<?php
namespace App\Controller\Admin;
use Service\Mail;
use Service\Log;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;
/**
* 地区分类管理
*/

class AddressController extends Base{
  public function index(){
  	$data = M('address') -> select('*',DB::raw('CONCAT(path,",",id) a')) -> orderBy('a') -> get() -> toArray();
  	$one = M('address') -> where(['pid'=>'0']) -> get() -> toArray();
  	// 处理
  	foreach($data as $key => $value){
  		$data[$key]['name'] = '|'.str_repeat('|----',substr_count($value['path'],',')).$value['name'];
  	}
    $this -> display('Admin.Address.lists',['data'=>$data,'one'=>$one]);
  }
  public function add(){
  	$data = M('address') -> get() -> toArray();
  	// 处理
  	foreach($data as $key => $value){
  		$data[$key]['name'] = '|'.str_repeat('----',substr_count($value['path'],',')).$value['name'];
  	}
  	$this -> display('Admin.Address.add',['data'=>$data]);
  }
  public function insert(){
  	// 判断要添加的地区分类是否为根地区
  	if($_POST['pid']=='0'){
  		// path 也为空
  		$_POST['path'] = '0';
  	}else{
  		// 获取父级path
  		$_POST['path'] = M('address') -> select('*',DB::raw('CONCAT(path,",",id) ppath')) -> find($_POST['pid']) -> toArray()['ppath'];
  	}
  	// 获取模型
  	$address = M('address');
  	$address -> pid = $_POST['pid'];
  	$address -> path = $_POST['path'];
  	$address -> name = $_POST['name'];
  	// 执行添加
  	if( $address -> save() ){
  		redirect('/Admin/Address/add.html?status=success&message=添加成功&description=地区分类添加成功');
  	}else{
  		redirect('/Admin/Address/add.html?status=danger&message=添加失败&description=地区分类添加失败');
  	}
  }
  public function edit(){
  	$address = M('address') -> select('*',DB::raw('CONCAT(path,",",id) a')) -> orderBy('a') -> get() -> toArray();
  	// 处理
  	foreach($address as $key => $value){
  		$address[$key]['name'] = '|'.str_repeat('----',substr_count($value['path'],',')).$value['name'];
  	}
  	$data = M('address') -> find($_GET['id']) -> toArray();
  	$this -> display('Admin.Address.edit',['data'=>$data,'address'=>$address]);
  }
  public function save(){
  	// 判断要添加的地区分类是否为根地区
  	if($_POST['pid']=='0'){
  		// path 也为空
  		$_POST['path'] = '0';
  	}else{
  		// 获取父级path
  		$_POST['path'] = M('address') -> select('*',DB::raw('CONCAT(path,",",id) ppath')) -> find($_POST['pid']) -> toArray()['ppath'];
  	}
  	// 获取模型
  	$address = M('address');
  	// 执行修改
  	if( $address -> where(['id'=>$_GET['id']]) -> update($_POST) ){
  		redirect('/Admin/Address/edit.html?status=success&message=修改成功&description=地区分类修改成功&id='.$_GET['id']);
  	}else{
  		redirect('/Admin/Address/edit.html?status=danger&message=修改失败&description=地区分类修改失败&id='.$_GET['id']);
  	}
  }
  public function delete(){
  	if( M('address') -> where(['pid'=>$_GET['id']]) -> first() ){
  		redirect('/Admin/Address/lists.html?status=danger&message=删除失败&description=此地区存在子地区');
  	}
  	if( M('address') -> where(['id'=>$_GET['id']]) -> delete() ){
  		redirect('/Admin/Address/lists.html?status=success&message=删除成功&description=地区分类删除成功');
  	}
  }
  public function show(){
  	$data = M('address') -> where(['pid'=>$_GET['id']]) -> select('*',DB::raw('CONCAT(path,",",id) a')) -> orderBy('a') -> get() -> toArray();
  	$pdata = M('address') -> find($_GET['id']) -> toArray();
  	// 处理
  	foreach($data as $key => $value){
  		$data[$key]['name'] = '|'.str_repeat('|----',substr_count($value['path'],',')).$value['name'];
  	}
    $this -> display('Admin.Address.show',['data'=>$data,'pdata'=>$pdata]);
  }
}