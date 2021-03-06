<?php
namespace Service;
use Doctrine\Common\Cache\RedisCache;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Cache\MemcacheCache;
use Redis;
use Memcached;
/**
 * 缓存类
 * Class Cache
 * @package Service
 */
class Cache
{
    /**
     * 缓存驱动
     * @var bool
     */
    protected static $cacheDriver = false;

    /**
     * 缓存驱动初始化
     */
    public static function __init()
    {
        # 判断驱动是否初始化过
        if(self::$cacheDriver==false){
            # 选择缓存类型
            switch(C('type','cache')){
                case 'redis' :
                    # redis驱动初始化
                    # 实例化系统Redis 扩展
                    $redis = new Redis();
                    # 链接redis
                    $redis -> connect(C('host','redis'), C('port','redis'));
                    # 实例化缓存驱动
                    $redis_driver = new RedisCache;
                    # 设置缓存驱动的链接
                    $redis_driver -> setRedis($redis);
                    # 设置缓缓存驱动到Cache类
                    self::setDriver($redis_driver);
                    break;
                case 'file' :
                    # file驱动初始化
                    # 实例化文件缓存驱动
                    $redis_driver = new FilesystemCache(CACHE_DATA);
                    # 设置驱动到Cache 类
                    self::setDriver($redis_driver);
                    break;
                case 'memcached' :
                    # Memcached 驱动初始化
                    # 实例化系统Memcached 扩展
                    $memcached = new Memcached();
                    # 链接Memcached
                    $memcached -> connect(C('host','memcached'), C('port','memcached'));
                    # 实例化缓存驱动
                    $memcached_driver = new MemcacheCache;
                    # 设置缓存驱动的链接
                    $memcached_driver -> setMemcached($memcached);
                    # 设置缓缓存驱动到Cache类
                    self::setDriver($memcached_driver);
                    break;
                default:
                    break;
            }

        }
    }
    /**
     * 获取当前的缓存驱动
     * @return mixed
     */
    public static function getDriver()
    {
        self::__init();
        return self::$cacheDriver;
    }

    /**
     * 设置当前的缓存驱动
     * @param $Driver 驱动
     */
    public static function setDriver($Driver)
    {
        self::$cacheDriver = $Driver;
    }

    /**
     * 缓存一个值
     * @return mixed
     */
    public static function set()
    {
        self::__init();
        return self::$cacheDriver -> save(...func_get_args());
    }

    /**
     * 获取一个缓存
     * @return mixed
     */
    public static function get()
    {
        self::__init();
        return self::$cacheDriver -> fetch(...func_get_args());
    }

    /**
     * 移除一个缓存
     * @return mixed
     */
    public static function remove()
    {
        self::__init();
        return self::$cacheDriver -> delete(...func_get_args());
    }
    /**
     * 记住数据
     * @param String $key 键
     * @param \Closure $callback 闭包函数
     * @param Int $timeout 过期时间
     * @return mixed
     */
    public static function remember($key,$callback,$timeout)
    {
        # 获取数据
        $result = self::get($key);
        # 判断是否存在数据
        if(!$result){
            # 调用闭包
            $result = $callback();
            # 缓存数据
            self::set($key,$result,$timeout);
        }
        # 返回数据
        return $result;
    }

    /**
     * 装饰者模式实现者
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        self::__init();
        return self::$cacheDriver -> $name(...$arguments);
    }
    /**
     * 装饰者模式实现者
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments){
        self::__init();
        return self::$cacheDriver -> $name(...$arguments);
    }
}