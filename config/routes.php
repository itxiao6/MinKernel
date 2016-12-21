<?php
namespace Config;
use Service\Route;
// 前台首页
Route::get('/aa','Home\HomeController@home');
// 控制器路由
Route::controller('/aaa','Home\HomeController');
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
Route::get('/Admin/User/edit.html','Admin\UserController@edit');
// 执行用户修改
Route::post('/Admin/User/edit.html','Admin\UserController@save');
// 用户删除
Route::post('/Admin/User/delete.html','Admin\UserController@delete');


// 路线列表
Route::get('/Admin/Line/lists.html','Admin\LineController@index');
// 路线添加
Route::get('/Admin/Line/add.html','Admin\LineController@add');
// 执行路线添加
Route::post('/Admin/Line/add.html','Admin\LineController@insert');
// 路线修改
Route::get('/Admin/Line/edit.html','Admin\LineController@edit');
// 执行路线修改
Route::post('/Admin/Line/edit.html','Admin\LineController@save');
// 路线删除
Route::post('/Admin/Line/delete.html','Admin\LineController@delete');


// 车辆列表
Route::get('/Admin/Cart/lists.html','Admin\CartController@index');
// 车辆添加
Route::get('/Admin/Cart/add.html','Admin\CartController@add');
// 执行路车辆加
Route::post('/Admin/Cart/add.html','Admin\CartController@insert');
// 车辆修改
Route::get('/Admin/Cart/edit.html','Admin\CartController@edit');
// 执行车辆修改
Route::post('/Admin/Cart/edit.html','Admin\CartController@save');
// 车辆删除
Route::post('/Admin/Cart/delete.html','Admin\CartController@delete');
















// 初始化欢迎页
Route::get('/Admin/Welcome/index.html','Admin\WelcomeController@index');

Route::dispatch();
