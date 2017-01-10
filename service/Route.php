<?php
namespace Service;
use Service\Log;
// 路由类
class Route{
	// 解析路由
	public static function init(){
		// 过滤url
		$_SERVER['REDIRECT_URL'] = rtrim($_SERVER['REDIRECT_URL'],'.html').'.html';
		// 获取路由信息
		$route_url = ltrim(rtrim(substr($_SERVER['REDIRECT_URL'],0,strripos($_SERVER['REDIRECT_URL'],'.html')),'/'),'/');
		// 获取GET参数
		$get_parameter = ltrim(substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'],'?')),'?');
		// 判断访问的是否为首页
		if($route_url!=''){
			// 获取控制器名称
			$route = explode('/',$route_url);
		}
		// 加载默认配置
		if(count($route)==2){

			// 加载部分配置
			$route[2] = C('default_a_name','app');
		}else if(count($route)==1){

			$route[1] = C('default_c_name','app');
			$route[2] = C('default_a_name','app');
		}else if(count($route)==0){

			// 加载部分配置
			$route[0] = C('default_m_name','app');
			$route[1] = C('default_c_name','app');
			$route[2] = C('default_a_name','app');
		}

		// 获取全局视图路径
		global $view_path;

		// 定义视图模板路径
		$view_path = [ROOT_PATH.'app/'.$route[0].'/View'];

		// 判断控制器文件是否存在
		if(file_exists(ROOT_PATH.'app/'.$route[0].'/Controller/'.$route[1].'.php')){
			// 获取控制器名称
			$name = 'App\\'.$route[0].'\Controller\\'.$route[1];

			// 实例化控制器
			$controller = new $name;

			// 判断控制器内操作是否存在
			if(method_exists($controller,$route[2])){

				// 实例化控制器
				$controller -> $route[2]();

			}else{

				echo '控制器内的操作找不到';
			}
		}else{
			echo '控制器找不到';
		}
	}
}