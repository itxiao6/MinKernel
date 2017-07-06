<?php
namespace Service;
use Service\Log;
use Kernel\Controller;
use Exception;
use Illuminate\Http\Request;
# 路由类
class Route{
	# 虚拟目录
	public static function abstract_path($uri){
		# 处理虚拟目录
		foreach (C('all','abstract') as $key => $value) {
			# 判断是否存在此文件
			if($uri!='' && $uri!='/' && file_exists($value.$uri)){
				# 获取文件类型
				$fileType = substr(strrchr($value.$uri,"."),1);
				# 判断文件类型是否为css
				if($fileType == 'css'){
					header('Content-Type:text/css;charset=utf-8');
				# 判断文件类型是否为js文件
				}else if($fileType=='js'){
					header('Content-Type:text/js;charset=utf-8');
				}
				// 输入文件内容
				exit(file_get_contents($value.$uri));
			}
		}
	}
	# 解析路由
	public static function init(){
		# 获取url
		$uri = get_url(true);

		# 定义请求URL
		define('REQUEST_URI',get_url(false));

		# 处理虚拟目录
		self::abstract_path($uri);

		# 过滤url
		$route_url = preg_replace('!\.php$|\.html$|\.jsp$|\.aspx$|\.asp$|\.htm$!i','',$uri);

		# 替换开头的/
		$route_url = preg_replace('!^/!','',$route_url);

		# 判断访问的是否为首页
		if($route_url != ''){
			# 解析URL
			$route = explode('/',$route_url);
		}else{
			# 定义路由信息为空
			$route = [];
		}

		# 判断参数是否大于等于4
		if(count($route) >= 4){
			# 解析多余参数(伪静态)
			for($i=3;$i <= count($route);$i++){
				# 判断值是否存在
				if(isset($route[$i+1])){
					# 解析到GET里面
					$_GET[$route[$i]] = $route[$i+1];
					# 跳过已经取过的值
					$i++;
				}
			}
		}
		# 保证 $_REQUEST能够取到值
		$_REQUEST = array_merge($_POST,$_GET,$_COOKIE);
		# 过滤空参数
		foreach ($route as $key => $value){
			# 判断路由结果是否为空
			if($value==''){
				# 删除此路由
				unset($route[$key]);
			}
		}
		# 判断A是否为空
		if(count($route)==3 && $route[2]==''){
			$route[2] = C('default_a_name','app');
		}
		# 判断传了几个URL
		if(count($route)==2){
			# 加载部分配置
			$route[2] = C('default_a_name','app');

		# 判断CA是否为空
		}else if(count($route)==1){
			$route[1] = C('default_c_name','app');
			$route[2] = C('default_a_name','app');
		# 判断是否 M A C都为空
		}else if(count($route)==0){
			# 判断是否存在Host绑定
			if(empty(C($_SERVER['HTTP_HOST'],'host'))){
				# 加载默认的模块
				$route[0] = C('default_m_name','app');

			}else{
				# 加载Host绑定的模块
				$route[0] = C($_SERVER['HTTP_HOST'],'host');

			}
			# 加载部分配置
			$route[1] = C('default_c_name','app');
			$route[2] = C('default_a_name','app');
		}
		# 定义应用名称
		define('APP_NAME',$route[0]);

		# 定义控制器名称
		define('CONTROLLER_NAME',$route[1]);

		# 定义操作名称
		define('ACTION_NAME',$route[2]);

		# 判断模块是否存在
		if(!file_exists(ROOT_PATH.'app'.DIRECTORY_SEPARATOR.APP_NAME)){
			# 指定模块找不到
			throw new Exception('找不到 '.APP_NAME.' 模块');
		}

		# 定义应用视图模板路径
		C('view_path','sys',['app' => ROOT_PATH.'app'.DIRECTORY_SEPARATOR.$route[0].DIRECTORY_SEPARATOR.'View','message'=>C('view_path','sys')['message']]);

		# 获取类名
		$className = 'App\\'.$route[0].'\Controller\\'.CONTROLLER_NAME;

		# 获取操作名
		$actionNane = $route[2];

		# 判断控制器文件是否存在
		if(file_exists(ROOT_PATH.'app'.DIRECTORY_SEPARATOR.APP_NAME.DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.CONTROLLER_NAME.'.php') && class_exists($className)){
			# 实例化控制器
			$controller = new $className;

			# 定义display和魔术方法列表(不能作为操作名)
			$magic = ['__init','__construct','display','__destruct','__call','__callStatic','__get','__set','__isset','__unset','__sleep','__wakeup','__toString','__invoke','__set_state','__clone','__debugInfo'];

			# 判断控制器内操作是否存在
			if(method_exists($controller,$actionNane) && (!in_array($actionNane,$magic))){
				# 实例化请求类
				$require = new Request($_REQUEST,$_COOKIE,$_FILES,$_SERVER);
				# 实例化控制器
				$controller -> $actionNane($require);

			}else{
				# 判断是否 存在此模板
				if(file_exists(ROOT_PATH.'app'.DIRECTORY_SEPARATOR.APP_NAME.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.CONTROLLER_NAME.DIRECTORY_SEPARATOR.$actionNane.'.html')){
					# 渲染模板
					$controller -> display();
					exit();
				}

				# 指定操作名找不到
				throw new Exception('找不到 '.$actionNane.' 操作');
			}
		}else{
			# 判断是否 存在此模板
			if(file_exists(ROOT_PATH.'app'.DIRECTORY_SEPARATOR.APP_NAME.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.CONTROLLER_NAME.DIRECTORY_SEPARATOR.$actionNane.'.html')){
				# 实例化控制器父类
				$controller = new Controller;
				# 渲染模板
				$controller -> display();
			}else{
				# 指定控制器找不到
				throw new Exception('找不到 '.CONTROLLER_NAME.' 控制器');
			}
		}
	}
}