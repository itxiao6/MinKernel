<?php
namespace App\Model;
use Kernel\Model;

/**
 * 微信配置表
 * Class WechatConfig
 * @package App\Model
 */
class WechatConfig extends Model
{
    /**
     * 表名
     * @var string
     */
    protected $table = 'wechat_config';

    /**
     * 获取指定配置项
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        return self::where(['name'=>$key]) -> value('value');
    }

}