<?php
namespace Service;
use Throwable;

/**
 * 接管异常类
 * Class Exception
 * @package Service
 */
class Exception extends \Exception
{
    protected $message;
    protected $code;
    protected $file;
    protected $line;

    public function __construct($message = "", $code = 0, Throwable $previous = null,$file=null,$line=null)
    {
        parent::__construct($message, $code, $previous);
        $this -> set_file($file);
        $this -> set_line($line);

    }

    /**
     * 抛出异常
     * @param string $message 消息
     * @param int $code 错误代码
     * @param Throwable|null $previous 内容
     * @param null $file 文件
     * @param null $line 行号
     * @throws Exception
     */
    public static function __throw($message = "", $code = 0, Throwable $previous = null,$file=null,$line=null)
    {
        throw new self($message,$code,$previous,$file,$line);
    }

    /**
     * 设置错误文件
     * @param null $file
     * @return $this|bool
     */
    public function set_file($file = null)
    {
        if($file == null){
            return false;
        }
        $this -> file = $file;
        return $this;
    }

    /**
     * 设置错误行
     * @param null $line
     * @return $this|bool
     */
    public function set_line($line = null)
    {
        if($line == null){
            return false;
        }
        $this -> line = $line;
        return $this;
    }
    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this -> $name;
    }
    public function __set($name, $value)
    {
        $this -> $name = $value;
        // TODO: Implement __set() method.
    }
}