<?php
namespace Service;
/**
* 表单构造器
*/
class Form{
	
	// function __construct(argument)
	// {
		# code...
	// }
	# 定义表头
	protected static $form_header = '';
	# 定义表尾
	protected static $form_footer = '';
	# 定义输入框的内容
	protected static $input_text = '';
	# 定义表单验证的js
	protected static $form_check = '';
	# 创建input
	public static function input($name,$type,$class,$id){

	}
	# 创建多行输入框
	public static function textarea($name){
		
	}
}