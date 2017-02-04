<?php
namespace Service;
use Service\Log;
use Kernel\Controller;
// 路由类
class Route{
	// 解析路由
	public static function init(){
		// 过滤url
		$_SERVER['REDIRECT_URL'] = preg_replace('!\.php$|\.html$|\.jsp$|\.aspx$|\.asp$!','',$_SERVER['REDIRECT_URL']);
		// 替换开头的/
		$route_url = preg_replace('!^/!','',$_SERVER['REDIRECT_URL']);

		// 判断访问的是否为首页
		if($route_url != ''){
			// 获取控制器名称
			$route = explode('/',$route_url);
		}else{
			// 定义路由信息为空
			$route = [];
		}
		// 判断参数是否非法
		if(count($route) > 3){
			throw new \Exception('URL参数非法:'.$_SERVER['REDIRECT_URL']);
		}

		// 判断A是否为空
		if(count($route)==3 && $route[2]==''){$route[2] = C('default_a_name','app');}

		// 判断传了几个URL
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
			// 指定模块找不到
			throw new \Exception('找不到 '.$route[0].' 模块');
		}

		// 定义视图模板路径
		$view_path = [ROOT_PATH.'app/'.$route[0].'/View',ROOT_PATH.'template/'];

		// 判断控制器文件是否存在
		if(file_exists(ROOT_PATH.'app/'.$route[0].'/Controller/'.$route[1].'.php')){
			// 获取控制器名称
			$className = 'App\\'.$route[0].'\Controller\\'.$route[1];

			// 实例化控制器
			$controller = new $className;
			// 定义display和魔术方法列表(不能作为操作名)
			$magic = ['__construct','display','__destruct','__call','__callStatic','__get','__set','__isset','__unset','__sleep','__wakeup','__toString','__invoke','__set_state','__clone','__debugInfo'];
			// 判断控制器内操作是否存在
			if(method_exists($controller,$route[2]) && (!in_array($route[2],$magic))){

				// 实例化控制器
				$controller -> $route[2]();

			}else{
				// 判断是否 存在此模板
				if(file_exists(ROOT_PATH.'app/'.$route[0].'/View/'.$route[1].'/'.$route[2].'.html')){
					// 渲染模板
					$controller -> display();
				}

				// 指定操作名找不到
				throw new \Exception('找不到 '.$route[2].' 操作');
			}
		}else{
			// 判断是否 存在此模板
			if(file_exists(ROOT_PATH.'app/'.$route[0].'/View/'.$route[1].'/'.$route[2].'.html')){
				// 实例化控制器父类
				$controller = new Controller;
				// 渲染模板
				$controller -> display();
			}
			// 指定控制器找不到
			throw new \Exception('找不到 '.$route[1].' 控制器');
		}
	}
}