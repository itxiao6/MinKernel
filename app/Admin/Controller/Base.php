<?php
namespace App\Admin\Controller;
use Kernel\Controller;
use Service\File;

/**
* 后台中间件
*/
class Base extends Controller{
	# 定义公共数组
	protected static $public_data = [];
	# 定义导航
	protected static $nav_data = ROOT_PATH.'app'.DIRECTORY_SEPARATOR.APP_NAME.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'Public'.DIRECTORY_SEPARATOR.'nav.html';
	# 定义导航html
	protected static $nav_html = '';
	# 定义二级导航
	protected static $two_nav_data = [];
	# 定义二级导航html
	protected static $two_nav_html = '';
	# 定义表单
	protected static $form = [];
	# 定义布局文件
	protected static $layout = ROOT_PATH.'app'.DIRECTORY_SEPARATOR.APP_NAME.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'Public'.DIRECTORY_SEPARATOR.'public.html';
	# 定义布局html
	protected static $layout_html = '';
	# 定义页面标题
	protected static $title = 'test';
	# 定义页面内容
	protected static $content_html = '';
	# 定义页面类型(1=列表,2=表单,3=统计)
	protected static $page_type = 1;
	# 构造函数
	function __construct(){
		// 调用父类的构造方法
    	parent::__construct();
    	
	}
	# 解析二级导航
	protected static function analyze_two_nav(){
		self::$two_nav_html = '<li><a href="javascript:void(0)">用户管理</a></li><li class="active">用户列表</li>';
	}
	# 解析导航
	protected static function analyze_nav(){
		self::$nav_html = file_get_contents(self::$nav_data);
	}
	# 构建表单
	public function create_form($action,$class,$name,$id){
		$form = '<form action="'.$action.'" class="'.$class.'" name="'.$name.'" id="'.$id.'" >';



		return $form.'</form>';
	}

	# 解析内容
	protected static function analyze_content(){
		// self::$content_html = file_get_contents(ROOT_PATH.'app'.DIRECTORY_SEPARATOR.APP_NAME.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'Public'.DIRECTORY_SEPARATOR.'content.html');
	}
	# 构造表单
	public function _display(){
		# 获取内容
		self::analyze_content();
		# 获取公共内容
    	self::$layout_html = file_get_contents(self::$layout);
    	# 解析导航
    	self::analyze_nav();
    	# 解析二级导航
    	self::analyze_two_nav();
    	# 匹配标题
    	self::$layout_html = preg_replace('!\{\{\$title\}\}!',self::$title,self::$layout_html);
    	# 替换导航
    	self::$layout_html = preg_replace('!\{\{\$nav_html\}\}!',self::$nav_html,self::$layout_html);
    	# 替换内容
    	self::$layout_html = preg_replace('!\{\{\$content_html\}\}!',self::$content_html,self::$layout_html);
    	# 替换二级导航
    	self::$layout_html = preg_replace('!\{\{\$two_nav_html\}\}!',self::$two_nav_html,self::$layout_html);
    	echo(self::$layout_html);die();
	}
}
