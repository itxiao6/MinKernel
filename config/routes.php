<?php
namespace Config;
use Service\Route;
// 前台首页
Route::get('/','Home\HomeController@home');





Route::dispatch();