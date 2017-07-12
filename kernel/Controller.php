<?php
namespace Kernel;
use Service\View;
use Service\Log;
/**

* 控制器父类

*/
class Controller{

  # 视图对象
  protected $view;

  # 视图实例
  protected $viewObject;

  # 视图数据
  protected $viewData = [];

  # 邮件对象
  protected $mail;

  # 本请求是否渲染了模板
  protected $is_display = false;

  public function __construct(){
    # 判断初始化函数属否定义
    if(method_exists($this,'__init')){
      $this -> __init();
    }
  }

  /** 渲染模板
   * @param  [String] 要渲染的模板名
   * @param  [Array] 要分配到模板引擎的变量
   * @return [渲染好的模板]
   */
  public function display($view='default',Array $data = []){
    # 获取视图实例
    $this -> viewObject = View::getView();
    # 判断是否传入的模板名称
    if($view=='default'){$view = CONTROLLER_NAME.'.'.ACTION_NAME;}
    # 判断是否传了要分配的值
    if(count($data) > 0){
      # 分配模板的数组合并
      $this -> assign($data);
    }
    # 判断模板是否存在
    if(!$this -> viewObject -> exists($view)){
      throw new \Exception('找不到 '.$view.' 模板');
    }
    # 设置本请求渲染了模板
    $this -> is_display = true;
    # 渲染模板并输出
    echo $this -> viewObject -> make($view,$this -> viewData);
  }

  /** 分配变量值
   * @param  [String] 键名
   * @param  [data] 数据(可选)
   * @return [Object] 本对象(用于连贯操作)
   */
  protected function assign($key,$data = []){
    # 判断传的是否为数组
    if( is_array($key) ){
      $this -> viewData = array_merge($this -> viewData, $key);
    }else{
      $this -> viewData = array_merge($this -> viewData,[$key => $data]);
    }
    # 返回本对象
    return $this;
  }

  /**
   * Ajax方式返回数据到客户端
   * @access protected
   * @param mixed $data 要返回的数据
   * @param String $type AJAX返回数据格式
   * @param int $json_option 传递给json_encode的option参数
   * @return void
   */
  protected function ajaxReturn($data,$type='',$json_option=0) {
      if(empty($type)) $type  =   C('default_ajax_return','sys');
      switch (strtoupper($type)){
          case 'JSON' :
              # 返回JSON数据格式到客户端 包含状态信息
              header('Content-Type:application/json; charset=utf-8');
              exit(json_encode($data,$json_option));
          case 'XML'  :
              # 返回xml格式数据
              header('Content-Type:text/xml; charset=utf-8');
              exit(xml_encode($data));
          case 'JSONP':
              # 返回JSON数据格式到客户端 包含状态信息
              header('Content-Type:application/json; charset=utf-8');
              $handler  =   $_GET['jsonpCallback'];
              exit($handler.'('.json_encode($data,$json_option).');');
          case 'EVAL' :
              # 返回可执行的js脚本
              header('Content-Type:text/html; charset=utf-8');
              exit($data);
          default     :
              # 用于扩展其他返回格式数据
              Hook::listen('ajax_return',$data);
      }
  }
  /**
     * Action跳转(URL重定向） 支持指定模块和延时跳转
     * @access protected
     * @param string $url 跳转的URL表达式
     * @param String $params 其它URL参数
     * @return void
     */
    protected function redirect($url,$params='') {
        redirect(U($url,$params));
    }
    public function success($message,$url='history.go(-1);',$timeout=1000){
      $this -> assign('message',$message);
      $this -> assign('url',$url);
      $this -> assign('timeout',$timeout);
      $this -> display('success');
      exit();
    }
    public function error($message,$url='history.go(-1);',$timeout=1000){
      $this -> assign('message',$message);
      $this -> assign('url',$url);
      $this -> assign('timeout',$timeout);
      $this -> display('error');
      exit();
    }
  # 析构方法
  public function __destruct(){
  	# 获取全局变量
  	global $debugbar;
    global $debugbarRenderer;
    global $database;
    if($database && is_array(DB_LOG())){
    	# 遍历sql
	    foreach (DB_LOG() as $key => $value) {
	    	$debugbar["Database"]->addMessage('语句:'.$value['query'].' 耗时:'.$value['time'].' 参数:'.json_encode($value['bindings']));
	    }
    }
    # 判断是否开启了 debugbar
    if(C('debugbar','sys') && $this -> is_display){
      echo preg_replace('!\/vendor\/maximebf\/debugbar\/src\/DebugBar\/!','/',$debugbarRenderer->renderHead());
    }
    # 判断是否开启了 debugbar
    if(C('debugbar','sys') && $this -> is_display){
      echo $debugbarRenderer->render();
    }
    # 写入Log
    # Log::write(APP_NAME.'访问Log','访问log',json_encode(DB_LOG()));
    $view = $this->view;
    if ( $view instanceof View ) {
      extract($view->data);
      require $view->view;
    }
  }

}