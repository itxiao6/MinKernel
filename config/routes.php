<?php
namespace Config;
use Service\Route;
// 前台首页
Route::get('/','HomeController@home');


Route::dispatch();