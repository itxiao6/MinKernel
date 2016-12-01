<?php
namespace Config;
use Service\Route;
// 前台首页
Route::get('/','HomeController@home');
// 登录表单
Route::get('/Admin/Login.html','Admin\LoginController@index');
// 后台登录操作
Route::post('/Admin/Login.html','Admin\LoginController@login');
// 获取验证码
Route::get('/Admin/Code.html','Admin\LoginController@get_code');



// 地区列表
Route::get('/Admin/Address/lists.html','Admin\AddressController@index');
// 地区添加
Route::get('/Admin/Address/add.html','Admin\AddressController@add');
// 地区执行添加
Route::post('/Admin/Address/add.html','Admin\AddressController@insert');
// 地区修改
Route::get('/Admin/Address/edit.html','Admin\AddressController@edit');
// 查看子分类
Route::get('/Admin/Address/show.html','Admin\AddressController@show');
// 地区修改
Route::post('/Admin/Address/edit.html','Admin\AddressController@save');
// 地区删除
Route::get('/Admin/Address/delete.html','Admin\AddressController@delete');





// 用户列表
Route::get('/Admin/User/lists.html','Admin\UserController@index');
// 用户添加
Route::get('/Admin/User/add.html','Admin\UserController@add');
// 执行用户添加
Route::post('/Admin/User/add.html','Admin\UserController@insert');
// 用户修改
Route::get('/Admin/User/edit.html','Admin\UserController@index');
// 执行用户修改
Route::post('/Admin/User/edit.html','Admin\UserController@save');
// 用户删除
Route::post('/Admin/User/delete.html','Admin\UserController@delete');
















// 初始化欢迎页
Route::get('/Admin/Welcome/index.html','Admin\WelcomeController@index');

Route::dispatch();