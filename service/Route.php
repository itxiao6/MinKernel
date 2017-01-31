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
		// 判断A是否为空
		if(count($route)==2){
			
			// 加载部分配置
			$route[2] = C('default_a_name','app');

		// 判断CA是否为空
		}else if(count($route)==1){

			$route[1] = C('default_c_name','app');
			$route[2] = C('default_a_name','app');
		
		// 判断是否MAC都为空
		}else if(count($route)==0){
			
			// 判断是否存在Host绑定
			if(empty(C($_SERVER['HTTP_HOST'],'host'))){
			
				// 加载默认的模块
				$route[0] = C('default_m_name','app');
			
			}else{
			
				// 加载Host绑定的模块
				$route[0] = C($_SERVER['HTTP_HOST'],'host');
			
			}
			
			// 加载部分配置
			$route[1] = C('default_c_name','app');
			$route[2] = C('default_a_name','app');
		}
		// 定义应用名称
		define('APP_NAME',$route[0]);

		// 定义控制器名称
		define('CONTROLLER_NAME',$route[1]);

		// 定义操作名称
		define('ACTION_NAME',$route[2]);

		// 获取全局视图路径
		global $view_path;
		
		// 判断模块是否存在
		if(!file_exists(ROOT_PATH.'app/'.$route[0])){
			echo $route[0].'模块找不到';
		}

		// 定义视图模板路径
		$view_path = [ROOT_PATH.'app/'.$route[0].'/View',ROOT_PATH.'template/'];

		// 判断控制器文件是否存在
		if(file_exists(ROOT_PATH.'app/'.$route[0].'/Controller/'.$route[1].'.php')){
			// 获取控制器名称
			$className = 'App\\'.$route[0].'\Controller\\'.$route[1];

			// 实例化控制器
			$controller = new $className;

			// 判断控制器内操作是否存在
			if(method_exists($controller,$route[2])){

				// 实例化控制器
				$controller -> $route[2]();

			}else{

				// 指定操作名找不到
				throw new \Exception($route[2].'操作 找不到');
			}
		}else{
			// 指定控制器找不到
			throw new \Exception($route[1].'控制器找不到');
		}
	}
}