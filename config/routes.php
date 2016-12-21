<?php
namespace Config;
use Service\Route;
// 前台首页
Route::get('/','Home\HomeController@home');



// 初始化欢迎页
Route::get('/Admin/Welcome/index.html','Admin\WelcomeController@index');

Route::dispatch();
