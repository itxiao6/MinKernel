<?php
namespace Service;

/**
 * 缓存类
 * Class Cache
 * @package Service
 */
class Cache{
    /**
     * 缓存驱动
     * @var bool
     */
    protected static $cacheDriver = false;

    /**
     * 获取当前的缓存驱动
     * @return mixed
     */
    public static function getDriver(){
        return self::$cacheDriver;
    }

    /**
     * 设置当前的缓存驱动
     * @param $Driver 驱动
     */
    public static function setDriver($Driver){
        self::$cacheDriver = $Driver;
    }

    /**
     * 缓存一个值
     * @return mixed
     */
    public static function set(){
        return self::$cacheDriver -> save(...func_get_args());
    }

    /**
     * 获取一个缓存
     * @return mixed
     */
    public static function get(){
        return self::$cacheDriver -> fetch(...func_get_args());
    }

    /**
     * 移除一个缓存
     * @return mixed
     */
    public static function remove(){
        return self::$cacheDriver -> delete(...func_get_args());
    }

    /**
     * 装饰者模式实现者
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::$cacheDriver -> $name(...$arguments);
    }
}