<?php
namespace Kernel;
use Nette\Mail\SmtpMailer;
use Service\View;
/**

* 控制器父类

*/
class Controller{
  
  // 视图对象
  protected $view;

  // 视图实例
  protected $viewObject;

  // 视图数据
  protected $viewData = [];
  
  // 邮件对象
  protected $mail;

  public function __construct(){
    // 获取视图实例
    $this -> viewObject = View::getView();
  }

  /** 渲染模板
   * @param  [String] 要渲染的模板名
   * @param  [Array] 要分配到模板引擎的变量
   * @return [渲染好的模板]
   */
  protected function display($view='default',Array $data = []){
    // 判断是否传入的模板名称
    if($view=='default'){$view = CONTROLLER_NAME.'.'.ACTION_NAME;}
    // 判断是否传了要分配的值
    if(count($data) > 0){
      // 分配模板的数组合并
      $this -> assign($data);
    }
    // 渲染模板并输出
    exit( $this -> viewObject -> make($view,$this -> viewData));
  }

  /** 分配变量值
   * @param  [String] 键名
   * @param  [data] 数据(可选)
   * @return [Object] 本对象(用于连贯操作)
   */
  protected function assign($key,$data = []){
    // 判断传的是否为数组
    if( is_array($key) ){
      $this -> viewData = array_merge($this -> viewData, $key);
    }else{
      $this -> viewData = array_merge($this -> viewData,[$key => $data]);
    }
    // 返回本对象
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
              // 返回JSON数据格式到客户端 包含状态信息
              header('Content-Type:application/json; charset=utf-8');
              exit(json_encode($data,$json_option));
          case 'XML'  :
              // 返回xml格式数据
              header('Content-Type:text/xml; charset=utf-8');
              exit(xml_encode($data));
          case 'JSONP':
              // 返回JSON数据格式到客户端 包含状态信息
              header('Content-Type:application/json; charset=utf-8');
              $handler  =   isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
              exit($handler.'('.json_encode($data,$json_option).');');  
          case 'EVAL' :
              // 返回可执行的js脚本
              header('Content-Type:text/html; charset=utf-8');
              exit($data);            
          default     :
              // 用于扩展其他返回格式数据
              Hook::listen('ajax_return',$data);
      }
  }
  // 成功跳转
  protected function success(){
    $this -> display('success');
  }
  // 失败跳转
  protected function error(){
    $this -> display('error');
  }
  // 输出信息
  protected function info(){
    $this -> display('info');
  }
  // 析构方法
  public function __destruct(){
    $view = $this->view;
    if ( $view instanceof View ) {
      extract($view->data);
      require $view->view;
    }
  }

}