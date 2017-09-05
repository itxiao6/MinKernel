<?php
namespace App\Model;
use Kernel\Model;

/**
 * 配置模型
 * Class Config
 * @package App\Model
 */
class Config extends Model
{
    /**
     * 配置类型
     */
    CONST TYPE = [1=>'系统配置',2=>'微信配置',3=>'支付宝配置',4=>'七牛配置',5=>'阿里OSS配置'];
    /**
     * 表名
     * @var string
     */
    protected $table = 'config';

}