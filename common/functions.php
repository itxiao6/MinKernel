<?php


// 获取excel表文件
function get_excel($data,$filename='数据表'){
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename='.$filename.'.xlsx');
    header('Cache-Control: max-age=0');
    // 默认跳过第一行表头
    // 更多使用请查看 src\Excel 注释
    \YExcel\Excel::put('php://output', $data);
    exit();
}

// 请求获取url
function get_url(){
    if(isset($_SERVER['REQUEST_URI'])){
        $uri=$_SERVER['REQUEST_URI'];
    }else{
        if(isset($_SERVER['argv'])){
            $uri=$_SERVER['PHP_SELF'].'?'.$_SERVER['argv'][0];
        }else{
            $uri=$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
        }
    }
    return$uri;
}

/**
* [get_page 获取分页]
* @param [Int] $num [一页条数]
* @param [String] $type [返回类型]
* @return [Object] $this [本对象]
*/
function get_page($num,$object,$type='Array',$where=[]){
    // 获取get url
    if(count($where)<=0){$where = $_GET;}
    // 定义where_url
    $where_url = '';
    // 循环链接 条件连续字符串
    foreach ($where as $key => $value) {
        if($key!='page'){
            $where_url .= $key.'='.$value.'&';
        }
    }
    // 判断当前页数不能为空
    if($_GET['page'] < 1){$_GET['page'] = 1;}else{$_GET['page']+=0;}

    // 数据集合(对象)
    $data['data'] = $object -> skip($num * ($_GET['page']-1))->take($num * ($_GET['page'])) -> get();
    // dump($object);

    // 数据总条数
    $data['total'] = $object -> count();

    // 当前页数据
    $data['to'] = $data['data'] -> count();

    // 当前页数
    $data['from'] = ($_GET['page'] < 1?1:$_GET['page']);

    // 总页数
    $data['last_page'] = ceil($data['total'] / $num);

    // 判断是否已经到达末页了
    if($_GET['page'] < $data['last_page']){

        // 下一页链接地址
        $data['next_page_url'] = '?'.$where_url.'page='.($_GET['page'] + 1);

    }else{

        // 空链接
        $data['next_page_url'] = null;

    }
    // 判断是否已经是首页
    if($_GET['page'] > 1){

        // 上一页链接地址
        $data['prev_page_url'] = '?'.$where_url.'page='.($_GET['page'] - 1);

    }else{

        // 空链接
        $data['prev_page_url'] = null;

    }


    // 判断要返回的数据类型
    if($type=='Array'){

      // 转换数据为数组
      $data['data'] = $data['data'] -> toArray();

      // 返回数组格式的数据
      return $data;

    }else if($type=='Object'){

      // 返回对象形式的数据
      return $data;

    }
}

/**
 * 数组转换成XML
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
// 判断是否为微信访问
function isweixin() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_agent, 'MicroMessenger') === false) {
        return false;
    } else {
        return true;
    }
}

/**
 * 对象类型数据转换成数组
 * @param Object $array ： 要转换的对象
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
    // 判断参数是否数组
    if(is_array($params)){
        $url_params = '?';
        foreach ($params as $key => $value) {
            $url_params .= $key.'='.$value.'&';
        }
        rtrim($url_params,'&');
    }else{
        $url_params = $params;
    }
    // 判断是否要跳转到首页
    if($Model==''){
        return '/'.$url_params;
    }
    // 拆分参数
    $data = explode('/',$Model);
    // 判断是否完整
    if(count($data)==2){
        return '/'.APP_NAME.'/'.$data[0].'/'.$data[1].'.html'.$url_params;
    }else if(count($data)==1){
        return '/'.APP_NAME.'/'.CONTROLLER_NAME.'/'.$data[0].'.html'.$url_params;
    }else if(count($data)==3){
        return '/'.$data[0].'/'.$data[1].'/'.$data[2].'.html'.$url_params;
    }
}


/**
 * 模拟提交参数，支持https提交 可用于各类api请求
 * @param string $url ： 提交的地址
 * @param array $data :POST数组
 * @param string $method : POST/GET，默认GET方式
 * @return mixed
 */
function http($url, $data='', $method='GET'){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        exit(curl_error($ch));
    }

    curl_close($ch);
    // 返回结果集
    return $result;
}
/**
 * [env 读取环境配置]
 * @param  [String] $param   [读取的项目]
 * @param  [String] $default [默认值]
 * @return [String]          [返回的值]
 */
function env($param,$default){
    global $env;
    // 判断配置文件是否加载过
    if(!isset($env)){
        // 判断指定文件是否存在
        if(file_exists(ROOT_PATH.'env.php')){
            $env = require(ROOT_PATH.'env.php');
        }else{
            return false;
        }
    }
    // 是否读取全部配置
    if($param=='all'){
        // 判断操作是读还是写
        if($value != 'defaultValue'){
            // 修改值并返回
            return $env = $value;
        }else{
            // 返回要取得的值
            return $env;
        }
    }else{
        // 判断是否存在环境配置项
        if( isset($env[$param]) ){
            // 返回读取到的值
            return $env[$param];
        }else{
            // 返回默认值
            return $default;
        }
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
    // 判断配置文件是否加载过
    if(!isset($config[$type])){
        // 判断配置文件是否存在
        if(file_exists(ROOT_PATH.'config/'.$type.'.php')){
            $config[$type] = require(ROOT_PATH.'config/'.$type.'.php');
        }else{
            return false;
        }
    }

    // 是否读取全部配置
    if($key=='all'){
        // 判断操作是读还是写
        if($value != 'defaultValue'){
            // 修改值并返回
            return $config[$type] = $value;
        }else{
            // 返回要取得的值
            return $config[$type];
        }
    }else{
        // 判断操作是读还是写
        if($value != 'defaultValue'){
            // 修改值并返回
            return $config[$type][$key] = $value;
        }else{
            // 返回要取得的值
            return $config[$type][$key];
        }
    }
}
/**
 * [L 读取 / 获取 语言]
 * @param [String] $key   [字段](如果为all则会返回本类型节点所有相)
 * @param [String] $type  [语言类型]
 * @param [String] $value [要动态修改的值]
 * @return  [<语言项的值>]
 */
function L($key,$type='zh_en',$value='defaultValue'){
	global $language;
	// 判断配置文件是否加载过
	if(!isset($language[$type])){
		$language[$type] = require(ROOT_PATH.'common/language/'.$type.'.php');
	}
	// 是否读取全部配置
	if($key=='all'){
		// 判断操作是读还是写
		if($value != 'defaultValue'){
			// 修改值并返回
			return $language[$type] = $value;
		}else{
			// 返回要取得的值
			return $language[$type];
		}
	}else{
		// 判断操作是读还是写
		if($value != 'defaultValue'){
			// 修改值并返回
			return $language[$type][$key] = $value;
		}else{
			// 返回要取得的值
			return $language[$type][$key];
		}
	}
}
/**
 * URL重定向
 * @param string $url 重定向的URL地址
 * @return void
 */
function redirect($url) {
    header('Location:'.$url);
    exit();
}
/**
 * 使用DB基类
 * @param string $table 表名
 * @return void
 */
function DB($table) {
    // 获取全局的数据库连接
    global $database;
    // 判断数据库是否已经连接
    if ( $database === false ) {
      // 连接数据库
      $database = new Illuminate\Database\Capsule\Manager;
      // 载入数据库配置
      $database->addConnection(C('all','database'));
      // 设置全局静态可访问
      $database->setAsGlobal();
      // 启动Eloquent
      $database -> bootEloquent();
      // 判断是否开启LOG日志
      if(C('database_log','sys')){
        Illuminate\Database\Capsule\Manager::connection()->enableQueryLog();
      }
    }
    return Illuminate\Database\Capsule\Manager::table($table);
}
// 获取数据库操作sql日志
function DB_LOG(){
    // 获取全局的数据库连接
    global $database;
    if($database===false){
        return false;
    }
    // 判断是否开启了DB_log
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
    // 获取要实例化的模型名字
    $class = 'App\Model\\'.ucfirst($tableName);
    // 判断是否定义了模型文件
    if( class_exists((String) $class) ){
        // 实例化类
        $object = new $class;
        // 判断是否修改的主键
        if($key!='id'){
            $object -> setKey($key);
        }
        // 设置表名
        $object -> setTable($tableName);
        // 返回模型
        return $object;
    }
    // 判断是否制定了表名
    if($tableName==''){
        // 直接返回一个没有指定过表名的Model
        return new Kernel\Model;
    }
    // 根据表名实例化Model
    $model = new Kernel\Model($tableName);
    // 判断是否修改了Model的默认的主键
    if($key!='id'){
        // 修改Model的主键
        $model -> setKey($key);
    }
    // 返回实例化后的Model
    return $model;
}
/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
// function dump($var, $echo=true, $label=null, $strict=true) {
//     $label = ($label === null) ? '' : rtrim($label) . ' ';
//     if (!$strict) {
//         if (ini_get('html_errors')) {
//             $output = print_r($var, true);
//             $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
//         } else {
//             $output = $label . print_r($var, true);
//         }
//     } else {
//         ob_start();
//         var_dump($var);
//         $output = ob_get_clean();
//         if (!extension_loaded('xdebug')) {
//             $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
//             $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
//         }
//     }
//     if ($echo) {
//         echo($output);
//         return null;
//     }else{
//         return $output;
//     }
// }

/**
 * 判断是否SSL协议
 * @return boolean
 */
function IS_SSL() {
    if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
        return true;
    }elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
        return true;
    }
    return false;
}
/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}
/**
 * 发送HTTP状态
 * @param integer $code 状态码
 * @return void
 */
function send_http_status($code) {
    static $_status = array(
            // Informational 1xx
            100 => 'Continue',
            101 => 'Switching Protocols',
            // Success 2xx
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            // Redirection 3xx
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Moved Temporarily ',  // 1.1
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            // 306 is deprecated but reserved
            307 => 'Temporary Redirect',
            // Client Error 4xx
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            // Server Error 5xx
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            509 => 'Bandwidth Limit Exceeded'
    );
    if(isset($_status[$code])) {
        header('HTTP/1.1 '.$code.' '.$_status[$code]);
        // 确保FastCGI模式下正常
        header('Status:'.$code.' '.$_status[$code]);
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
	if(strpos($name,'/')){ // 指定修饰符
		list($name,$type) 	=	explode('/',$name,2);
	}elseif(C('var_auto_string','sys')){ // 默认强制转换为字符串
        $type   =   's';
    }
    if(strpos($name,'.')) { // 指定参数来源
        list($method,$name) =   explode('.',$name,2);
    }else{ // 默认为自动判断
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
    if(''==$name) { // 获取全部变量
        $data       =   $input;
        $filters    =   isset($filter)?$filter:C('default_filter');
        if($filters) {
            if(is_string($filters)){
                $filters    =   explode(',',$filters);
            }
            foreach($filters as $filter){
                $data   =   array_map_recursive($filter,$data); // 参数过滤
            }
        }
    }elseif(isset($input[$name])) { // 取值操作
        $data       =   $input[$name];
        $filters    =   isset($filter)?$filter:C('default_filter');
        if($filters) {
            if(is_string($filters)){
                if(0 === strpos($filters,'/')){
                    if(1 !== preg_match($filters,(string)$data)){
                        // 支持正则验证
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
                        $data   =   is_array($data) ? array_map_recursive($filter,$data) : $filter($data); // 参数过滤
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
        		case 'a':	// 数组
        			$data 	=	(array)$data;
        			break;
        		case 'd':	// 数字
        			$data 	=	(int)$data;
        			break;
        		case 'f':	// 浮点
        			$data 	=	(float)$data;
        			break;
        		case 'b':	// 布尔
        			$data 	=	(boolean)$data;
        			break;
                case 's':   // 字符串
                default:
                    $data   =   (string)$data;
        	}
        }
    }else{ // 变量默认值
        $data       =    isset($default)?$default:null;
    }
    is_array($data) && array_walk_recursive($data,'kernel_filter');
    // 判断内容是否为数组
    if(!is_array($data)){
        kernel_filter($data);
        return $data;
    }
    return $data;
}
function kernel_filter(&$value){
	// TODO 其他安全过滤
    $value = htmlspecialchars($value);
	// 过滤查询特殊字符
    if(preg_match('/^(EXP|NEQ|GT|EGT|LT|ELT|OR|XOR|LIKE|NOTLIKE|NOT BETWEEN|NOTBETWEEN|BETWEEN|NOTIN|NOT IN|IN)$/i',$value)){
        $value .= ' ';
    }
}