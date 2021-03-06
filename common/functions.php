<?php
/**
* [get_excel 获取excel表文件]
* @param [Array] $data [是否分页]
* @param [String] $data [数据表名]
* @return [Object] $this [文件]
*/
function get_excel($data,$filename='数据表'){
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename='.$filename.'.xlsx');
    header('Cache-Control: max-age=0');
    # 默认跳过第一行表头
    # 更多使用请查看 src\Excel 注释
    \YExcel\Excel::put('php://output', $data);
    exit();
}

/**
 * 缓存函数
 * @param String $key 键
 * @param String $fun 数据
 * @param int $outTime 过期时间
 * @return mixed 结果
 */
function cache($key,$fun='',$outTime = -1)
{
    # 判断是否开启了缓存
    if(C('cache_time','sys') == - 1){
        return $fun();
    }
    # 判断缓存是否存在
//    if(!($data = unserialize(\Service\Redis::get($key)))){
        # 获取新的数据
        $data = $fun();
        # 缓存
//        \Service\Redis::set($key,serialize($data),$outTime == -1 ? C('cache_time','sys') : $outTime);
        # 返回缓存过后的结果
        return $data;
//    }else{
        # 返回缓存
//        return $data;
//    }
}
/**
* [function_dump 打印函数定义的文件名和位置]
* @param [String] $funcname [函数名]
* @return [String] 函数信息
*/
function function_dump($funcname) {
      try {
          if(is_array($funcname)) {
              $func = new \ReflectionMethod($funcname[0], $funcname[1]);
              $funcname = $funcname[1];
          } else {
              $func = new \ReflectionFunction($funcname);
          }
      } catch (\ReflectionException $e) {
          echo $e->getMessage();
          return;
      }
      $start = $func->getStartLine() - 1;
      $end =  $func->getEndLine() - 1;
      $filename = $func->getFileName();
      return "function $funcname defined by $filename($start - $end)\n";
}

/**
* [get_page 获取分页]
* @param [Int] $num [一页条数]
* @param [String] $type [返回类型]
* @return [Object] $this [本对象]
*/
function get_page($num,$object,$type='Array',$where=[]){
    # 匹配掉uri里的路径
    $uri = substr($_SERVER['REQUEST_URI'],0,strrpos($_SERVER['REQUEST_URI'],'?'));
    unset($_GET[preg_replace('!\.!','_',$uri)]);
    # 获取get url
    if(count($where)<=0){$where = $_GET;}
    # 定义where_url
    $where_url = '';
    # 循环链接 条件连续字符串
    foreach ($where as $key => $value) {
        if($key!='page'){
            $where_url .= $key.'='.$value.'&';
        }
    }

    # 条件url
    $data['where_url'] = $where_url;

    # 判断当前页数不能为空
    if($_GET['page'] < 1){$_GET['page'] = 1;}else{$_GET['page']+=0;}

    if ($type === 'Array'){
        #数据总条数
        $data['total'] = count($object);
        #取出固定位置的数据
        $data['data'] = array_slice($object,$num * ($_GET['page']-1),$num);
        #当前页的数据
        $data['to'] = count($data['data']);
    }else{
        # 数据总条数
        $data['total'] = $object -> count();
        # 数据集合(对象)
        $data['data'] = $object -> skip($num * ($_GET['page']-1))->take($num) -> get();
        # 当前页数据
        $data['to'] = $data['data'] -> count();
    }

    # 当前页数
    $data['from'] = ($_GET['page'] < 1?1:$_GET['page']);

    # 总页数
    $data['last_page'] = sprintf('%d',ceil($data['total'] / $num));

    # 判断是否已经到达末页了
    if($_GET['page'] < $data['last_page']){
        # 下一页链接地址
        $data['next_page_url'] = '?'.$where_url.'page='.($_GET['page'] + 1);

    }else{
        # 空链接
        $data['next_page_url'] = null;

    }
    # 判断是否已经是首页
    if($_GET['page'] > 1){
        # 上一页链接地址
        $data['prev_page_url'] = '?'.$where_url.'page='.($_GET['page'] - 1);

    }else{
        # 空链接
        $data['prev_page_url'] = null;

    }


    # 判断要返回的数据类型
    if($type=='Array'){
      # 返回数组格式的数据
      return $data;

    }else if($type=='Object'){
      # 返回对象形式的数据
      return $data;

    }
}

/**
 * [ arrayToXml 数组转换成XML ]
 * @param $arr  Array 要转换的数组
 * @return String 转换后的数组
 */
function arrayToXml($arr){
    $xml = "<xml>";
    foreach ($arr as $key=>$val){
        if(is_array($val)){
            $xml.="<".$key.">".arrayToXml($val)."</".$key.">";
        }else{
            $xml.="<".$key.">".$val."</".$key.">";
        }
    }
    $xml.="</xml>";
    return $xml;
}


/**
 * [ getTimestamp 获取时间戳 ]
 * @return String 时间戳
 */
function getTimestamp()
{
    return (string) time();
}
/**
 * [ getCurrentUrl 获取当前URL ]
 * @return String 当前的URL
 */
function getCurrentUrl()
{
    $protocol = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443))
        ? 'https://' : 'http://';

    return $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}




/**
 * [ getRandomString 获取随机字符串 ]
 * @param $length  Int 字符串的长度
 * @return String 随机字符
 */
function getRandomString($length = 10)
{
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    return substr(str_shuffle(str_repeat($pool, ceil($length / strlen($pool)))), 0, $length);
}

/**
 * [ filterNickname 原昵称 ]
 * @param $nickname  String 昵称
 * @return String 过滤后的昵称
 */
function filterNickname($nickname)
{
    $pattern = array(
        '/\xEE[\x80-\xBF][\x80-\xBF]/',
        '/\xEF[\x81-\x83][\x80-\xBF]/',
        '/[\x{1F600}-\x{1F64F}]/u',
        '/[\x{1F300}-\x{1F5FF}]/u',
        '/[\x{1F680}-\x{1F6FF}]/u',
        '/[\x{2600}-\x{26FF}]/u',
        '/[\x{2700}-\x{27BF}]/u',
        '/[\x{20E3}]/u'
    );

    $nickname = preg_replace($pattern, '', $nickname);

    return trim($nickname);
}

/**
 * 对象类型数据转换成数组
 * @param Object $array 要转换的对象
 * @return Array 转换后的数据
 */
function ObjectToArray($array) {
    if(is_object($array)) {
        $array = (array)$array;
     } if(is_array($array)) {
         foreach($array as $key=>$value) {
             $array[$key] = ObjectToArray($value);
             }
     }
     return $array;
}

/**
 * 生成URL
 * @param 要生成的URL模块 $Model
 * @param URL的参数 $params
 * @return String 生成后的URL
 */
function U($Model='',$params='') {
    # 判断参数是否数组
    if(is_array($params)){
        $url_params = '?';
        foreach ($params as $key => $value) {
            $url_params .= $key.'='.$value.'&';
        }
        rtrim($url_params,'&');
    }else{
        $url_params = $params;
    }
    # 判断是否要跳转到首页
    if($Model==''){
        return '/'.$url_params;
    }
    # 拆分参数
    $data = explode('/',$Model);
    # 判断是否完整
    if(count($data)==2){
        return '/'.APP_NAME.'/'.$data[0].'/'.$data[1].'.html'.$url_params;
    }else if(count($data)==1){
        return '/'.APP_NAME.'/'.CONTROLLER_NAME.'/'.$data[0].'.html'.$url_params;
    }else if(count($data)==3){
        return '/'.$data[0].'/'.$data[1].'/'.$data[2].'.html'.$url_params;
    }
}
/**
 * [C 读取 / 获取 配置]
 * @param [String] $key   [字段](如果为all则会返回本类型节点所有相)
 * @param [String] $type  [配置类型]
 * @param [String] $value [要动态修改的值]
 * @return  [<配置项的值>]
 */
function C($key,$type='app',$value='defaultValue'){
    global $config;
    # 判断配置文件是否加载过
    if(!isset($config[$type])){
        # 判断配置文件是否存在
        if(file_exists(ROOT_PATH.'config/'.$type.'.php')){
            $config[$type] = require(ROOT_PATH.'config/'.$type.'.php');
        }else{
            return false;
        }
    }

    # 是否读取全部配置
    if($key=='all'){
        # 判断操作是读还是写
        if($value != 'defaultValue'){
            # 修改值并返回
            return $config[$type] = $value;
        }else{
            # 返回要取得的值
            return $config[$type];
        }
    }else{
        # 判断操作是读还是写
        if($value != 'defaultValue'){
            # 修改值并返回
            return $config[$type][$key] = $value;
        }else{
            # 返回要取得的值
            return $config[$type][$key];
        }
    }
}
/**
 * URL重定向
 * @param string $url 重定向的URL地址
 * @return void
 */
function redirect($url) {
    // exit('<script>window.location="'.$url.'";</script>');
    header('Location:'.$url);
    exit();
}
# 获取数据库操作sql日志
function DB_LOG(){
    # 获取全局的数据库连接
    global $database;
    if($database===false){
        return false;
    }
    # 判断是否开启了DB_log
    if(C('database_log','sys')){
        return \Illuminate\Database\Capsule\Manager::getQueryLog();
    }else{
        throw new \Exception('未开启DB_log');
    }
}
/**
 * [M 创建一个虚拟的Model]
 * @param [String] $tableName [Model的表名]
 * @param [String] $key [Model 主键]
 */
function M($tableName='',$key='id'){
    # 判断是否制定了表名
    if($tableName==''){
        # 直接返回一个没有指定过表名的Model
        return new Kernel\Model;
    }
    # 根据表名实例化Model
    $model = new Kernel\Model($tableName);
    # 判断是否修改了Model的默认的主键
    if($key!='id'){
        # 修改Model的主键
        $model -> setKey($key);
    }
    # 返回实例化后的Model
    return $model;
}
/**
 * [D 实例化模型如果没有模型则 创建一个虚拟的Model]
 * @param [String] $tableName [Model的表名]
 * @param [String] $key [Model 主键]
 */
function D($tableName='',$key='id'){
    # 获取要实例化的模型名字
    $class = 'App\Model\\'.ucfirst($tableName);
    # 判断是否定义了模型文件
    if( class_exists((String) $class) ){
        # 实例化类
        $object = new $class;
        # 判断是否修改的主键
        if($key!='id'){
            $object -> setKey($key);
        }
        if($tableName!=''){
            # 设置表名
            $object -> setTable($tableName);
        }
        # 返回模型
        return $object;
    }else{
        return M($tableName,$key);
    }
}


/**
 * 获取输入参数 支持过滤和默认值
 * 使用方法:
 * <code>
 * I('id',0); 获取id参数 自动判断get或者post
 * I('post.name','','htmlspecialchars'); 获取$_POST['name']
 * I('get.'); 获取$_GET
 * </code>
 * @param string $name 变量的名称 支持指定类型
 * @param mixed $default 不存在的时候默认值
 * @param mixed $filter 参数过滤方法
 * @param mixed $datas 要获取的额外数据源
 * @return mixed
 */
function I($name,$default='',$filter=null,$datas=null) {
	static $_PUT	=	null;
	if(strpos($name,'/')){ # 指定修饰符
		list($name,$type) 	=	explode('/',$name,2);
	}elseif(C('var_auto_string','sys')){ # 默认强制转换为字符串
        $type   =   's';
    }
    if(strpos($name,'.')) { # 指定参数来源
        list($method,$name) =   explode('.',$name,2);
    }else{ # 默认为自动判断
        $method =   'param';
    }
    switch(strtolower($method)) {
        case 'get'     :
        	$input =& $_GET;
        	break;
        case 'post'    :
        	$input =& $_POST;
        	break;
        case 'put'     :
        	if(is_null($_PUT)){
            	parse_str(file_get_contents('php://input'), $_PUT);
        	}
        	$input 	=	$_PUT;
        	break;
        case 'param'   :
            switch($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $input  =  $_POST;
                    break;
                case 'PUT':
                	if(is_null($_PUT)){
                    	parse_str(file_get_contents('php://input'), $_PUT);
                	}
                	$input 	=	$_PUT;
                    break;
                default:
                    $input  =  $_GET;
            }
            break;
        case 'request' :
        	$input =& $_REQUEST;
        	break;
        case 'session' :
        	$input =& $_SESSION;
        	break;
        case 'cookie'  :
        	$input =& $_COOKIE;
        	break;
        case 'server'  :
        	$input =& $_SERVER;
        	break;
        case 'globals' :
        	$input =& $GLOBALS;
        	break;
        case 'data'    :
        	$input =& $datas;
        	break;
        default:
            return null;
    }
    if(''==$name) { # 获取全部变量
        $data       =   $input;
        $filters    =   isset($filter)?$filter:C('default_filter');
        if($filters) {
            if(is_string($filters)){
                $filters    =   explode(',',$filters);
            }
            foreach($filters as $filter){
                $data   =   array_map_recursive($filter,$data); # 参数过滤
            }
        }
    }elseif(isset($input[$name])) { # 取值操作
        $data       =   $input[$name];
        $filters    =   isset($filter)?$filter:C('default_filter');
        if($filters) {
            if(is_string($filters)){
                if(0 === strpos($filters,'/')){
                    if(1 !== preg_match($filters,(string)$data)){
                        # 支持正则验证
                        return   isset($default) ? $default : null;
                    }
                }else{
                    $filters    =   explode(',',$filters);
                }
            }elseif(is_int($filters)){
                $filters    =   array($filters);
            }
            if(is_array($filters)){
                foreach($filters as $filter){
                    if(function_exists($filter)) {
                        $data   =   is_array($data) ? array_map_recursive($filter,$data) : $filter($data); # 参数过滤
                    }else{
                        $data   =   filter_var($data,is_int($filter) ? $filter : filter_id($filter));
                        if(false === $data) {
                            return   isset($default) ? $default : null;
                        }
                    }
                }
            }
        }
        if(!empty($type)){
        	switch(strtolower($type)){
        		case 'a':	# 数组
        			$data 	=	(array)$data;
        			break;
        		case 'd':	# 数字
        			$data 	=	(int)$data;
        			break;
        		case 'f':	# 浮点
        			$data 	=	(float)$data;
        			break;
        		case 'b':	# 布尔
        			$data 	=	(boolean)$data;
        			break;
                case 's':   # 字符串
                default:
                    $data   =   (string)$data;
        	}
        }
    }else{ # 变量默认值
        $data       =    isset($default)?$default:null;
    }
    is_array($data) && array_walk_recursive($data,'kernel_filter');
    # 判断内容是否为数组
    if(!is_array($data)){
        kernel_filter($data);
        return $data;
    }
    return $data;
}
function kernel_filter(&$value){
	# TODO 其他安全过滤
    $value = htmlspecialchars($value);
	# 过滤查询特殊字符
    if(preg_match('/^(EXP|NEQ|GT|EGT|LT|ELT|OR|XOR|LIKE|NOTLIKE|NOT BETWEEN|NOTBETWEEN|BETWEEN|NOTIN|NOT IN|IN)$/i',$value)){
        $value .= ' ';
    }
}

//随机生成唯一订单号
function getOrderNum(){
    $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    return (String) $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));

}