<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
/**
* 用户表数据模型
*/
class User extends Model
{
	protected $table = "users";
	
	// 模型自定义的模型初始化操作
	protected function init(){

	}
}