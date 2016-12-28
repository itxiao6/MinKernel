<?php
namespace Config;
use Service\Route;

// 前台测试路由
Route::get('/','Home\WelcomeController@lists');
