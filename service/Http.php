<?php
namespace Service;
/**
 * Class Http
 * @package Service
 */
class Http{
    /**
     * [get_url 请求获取url]
     * @param [Bool] $is_page_get [是否分页]
     * @return [Object] $this [本对象]
     */
    public static function get_url($is_preg_get=true)
    {
        if(isset($_SERVER['REQUEST_URI'])){
            $uri=$_SERVER['REQUEST_URI'];
        }else{
            if(isset($_SERVER['argv'])){
                $uri=$_SERVER['PHP_SELF'].'?'.$_SERVER['argv'][0];
            }else{
                $uri=$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
            }
        }
        # 判断是否带get参数
        if($is_preg_get && strpos($uri,'?')!=false){
            # 过滤get参数
            $uri = substr($uri,0,strpos($uri,'?'));
        }
        return$uri;
    }
    /**
     * [ isWechat 数组转换成XML ]
     * @return Bool 是否为微信打开
     */
    public static function IS_WECHAT()
    {
        return !(false === strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger'));
    }

    /**
     * 是否为POST 请求
     * @return bool
     */
    public static function IS_POST(){
        return IS_POST;
    }

    /**
     * 是否为GET 请求
     * @return bool
     */
    public static function IS_GET(){
        return IS_GET;
    }
    /**
     * getClientIp 获取客户端ip
     * @return String 访问者的ip
     */
    public static function getClientIp()
    {
        $headers = function_exists('apache_request_headers')
            ? apache_request_headers()
            : $_SERVER;

        return isset($headers['REMOTE_ADDR']) ? $headers['REMOTE_ADDR'] : '0.0.0.0';
    }
    /**
     * 模拟提交参数，支持https提交 可用于各类api请求
     * @param string $url ： 提交的地址
     * @param array $data :POST数组
     * @param string $method : POST/GET，默认GET方式
     * @return mixed
     */
    public static function send($url, $data='', $method='GET'){
        if($method=='GET'){
            $param = '?';
            foreach ($data as $key => $value) {
                $param .= $key.'='.$value.'&';
            }
            $param = rtrim($param,'&');
            return file_get_contents($url.$param);
        }
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
        # 返回结果集
        return $result;
    }
    /**
     * 判断是否SSL协议
     * @return boolean
     */
    public static function IS_SSL() {
        if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
            return true;
        }elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
            return true;
        }
        return false;
    }
    /**
     * 发送HTTP状态
     * @param integer $code 状态码
     * @return void
     */
    public static function send_http_status($code) {
        static $_status = array(
            # Informational 1xx
            100 => 'Continue',
            101 => 'Switching Protocols',
            # Success 2xx
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            # Redirection 3xx
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Moved Temporarily ',  # 1.1
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            # 306 is deprecated but reserved
            307 => 'Temporary Redirect',
            # Client Error 4xx
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
            # Server Error 5xx
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
            # 确保FastCGI模式下正常
            header('Status:'.$code.' '.$_status[$code]);
        }
    }
    /**
     * 判断是手机还是PC
     * true 为 手机  false 为PC
     */
    public static function IS_MOBILE(){
        $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
        $mobile_browser = '0';
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
            $mobile_browser++;
        if ((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false))
            $mobile_browser++;
        if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
            $mobile_browser++;
        if (isset($_SERVER['HTTP_PROFILE']))
            $mobile_browser++;
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-'
        );
        if (in_array($mobile_ua, $mobile_agents))
            $mobile_browser++;
        if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
            $mobile_browser++;
        // Pre-final check to reset everything if the user is on Windows
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
            $mobile_browser = 0;
        // But WP7 is also Windows, with a slightly different characteristic
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
            $mobile_browser++;
        if ($mobile_browser > 0)
            return true;
        else
            return false;
    }

}