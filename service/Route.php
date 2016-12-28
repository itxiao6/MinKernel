<?php
namespace Service;
use Service\Log;
/**
 * 路由类
 * @method static Route get(string $route, Callable $callback)
 * @method static Route post(string $route, Callable $callback)
 * @method static Route put(string $route, Callable $callback)
 * @method static Route delete(string $route, Callable $callback)
 * @method static Route options(string $route, Callable $callback)
 * @method static Route head(string $route, Callable $callback)
 * @method static Route controller(string $route, Callable $callback)
 */
class Route{

  protected static $halts = false;
  // 路由url
  protected static $routes = array();
  // 请求类型
  protected static $methods = array();
  // 控制器方法
  protected static $callbacks = array();
  // 匹配模式
  protected static $patterns = array(
      ':any' => '[^/]+',
      ':num' => '[0-9]+',
      ':all' => '.*'
  );
  // 匹配不到路由的错误回调
  protected static $error_callback;

	/**
   * 重写路由url取值
   */
  public static function __callstatic($method, $params){
    // 设置找不到路由的异常错误提示错误
    self::$error_callback = function() {
      // 记录访问日志
      Log::write('找不到路由','访问日志','');
      // 抛出异常
      throw new \Exception("路由无匹配项 404 Not Found");
    };
    // 请求的url地址
    $uri = '/'.$params[0];
    // 指定的控制器类和方法
    $callback = $params[1];
    // 累加路由url
    array_push(self::$routes, $uri);
    // 累加请求类型
    array_push(self::$methods, strtoupper($method));
    // 累加要调用的控制器和方法名
    array_push(self::$callbacks, $callback);
  }
  /**
   * Runs the callback for the given request
   */
  public static function dispatch(){


    // 获取请求的url
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // 获取请求类型
    $method = $_SERVER['REQUEST_METHOD'];

    // 获取请求匹配模式
    $searches = array_keys(static::$patterns);

    // 获取从新排序的匹配模式
    $replaces = array_values(static::$patterns);

    $found_route = false;

    // 匹配删除正斜线
    self::$routes = preg_replace('/\/+/', '/', self::$routes);

    // 判断是否存在控制器匹配模式
    if(in_array('CONTROLLER',self::$methods)){

      // 循环路由
      foreach (self::$routes as $key => $value) {
        // 判断请求的是否是要访问的uri
        if($value==$uri && self::$methods[$key]=='CONTROLLER'){
          // 获取控制器名字
          $ControolerName = 'App\Controller\\'.self::$callbacks[$key];
          // 实例化控制器
          $controller = new $ControolerName;
          // 判断要调用的方法是否存在
          if(method_exists($controller,$_GET['a'])){
            // 方法名
            $str = $_GET['a'];
            // 调用要调用的方法
            $controller -> $str();
            // 退出循环
            break;
          }else{
            // 抛出异常
            throw new \Exception($ControolerName."下的".$str.'方法不存在');
          }
        }
      }

    }
    if (in_array($uri, self::$routes)) {
      // Check if route is defined without regex
      $route_pos = array_keys(self::$routes, $uri);
      foreach ($route_pos as $route) {
        // Using an ANY option to match both GET and POST requests
        if (self::$methods[$route] == $method || self::$methods[$route] == 'ANY') {
          $found_route = true;

          // If route is not an object
          if (!is_object(self::$callbacks[$route])) {

            // Grab all parts based on a / separator
            $parts = explode('/',self::$callbacks[$route]);

            // Collect the last index of the array
            $last = end($parts);

            // Grab the controller name and method call
            $segments = explode('@',$last);
            // 累加命名空间前缀
            $segments[0] = 'App\Controller\\'.$segments[0];
            // 判断控制器是否存在
            if (class_exists($segments[0])) {
              // 实例化控制器
              $controller = new $segments[0]();
            }else{
              // 使用的控制器不存在
              throw new \Exception('控制器'.$segments[0].'没有找到');
            }

            // Call method
            $controller->{$segments[1]}();

            if (self::$halts) return;
          } else {
            // Call closure
            call_user_func(self::$callbacks[$route]);

            if (self::$halts) return;
          }
        }
      }
    }else{
      
      // if(){
      // 控制器模式




      // }
      // Check if defined with regex
      $pos = 0;
      foreach (self::$routes as $route) {
        if (strpos($route, ':') !== false) {
          $route = str_replace($searches, $replaces, $route);
        }

        if (preg_match('#^' . $route . '$#', $uri, $matched)) {
          if (self::$methods[$pos] == $method || self::$methods[$pos] == 'ANY') {
            $found_route = true;

            // Remove $matched[0] as [1] is the first parameter.
            array_shift($matched);

            if (!is_object(self::$callbacks[$pos])) {

              // Grab all parts based on a / separator
              $parts = explode('/',self::$callbacks[$pos]);

              // Collect the last index of the array
              $last = end($parts);

              // Grab the controller name and method call
              $segments = explode('@',$last);

              // Instanitate controller
              // 累加命名空间前缀
              $segments[0] = 'App\Controller\\'.$segments[0];
              // 判断控制器是否存在
              if (class_exists($segments[0])) {
                // 实例化控制器
                $controller = new $segments[0]();
              }else{
                // 使用的控制器不存在
                throw new \Exception('控制器'.$segments[0].'没有找到');
              }

              // Fix multi parameters
              if(!method_exists($controller, $segments[1])) {
                echo "controller and action not found";
              } else {
                call_user_func_array(array($controller, $segments[1]), $matched);
              }

              if (self::$halts) return;
            } else {
              call_user_func_array(self::$callbacks[$pos], $matched);

              if (self::$halts) return;
            }
          }
        }
        $pos++;
      }
    }

    // Run the error callback if the route was not found
    if ($found_route == false) {
      if (!self::$error_callback) {
        self::$error_callback = function() {
          header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
          echo '404';
        };
      } else {
        if (is_string(self::$error_callback)) {
          self::get($_SERVER['REQUEST_URI'], self::$error_callback);
          self::$error_callback = null;
          self::dispatch();
          return ;
        }
      }
      call_user_func(self::$error_callback);
    }
  }
    /**
   * Defines callback if route is not found
  */
  public static function error($callback) {
    self::$error_callback = $callback;
  }

  public static function haltOnMatch($flag = true) {
    self::$halts = $flag;
  }

}