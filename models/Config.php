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
    //--
    //-- 表的结构 `config`
    //--
    //
    //CREATE TABLE `config` (
    //`id` int(11) NOT NULL,
    //`name` varchar(50) NOT NULL COMMENT '键',
    //`value` text NOT NULL COMMENT '值',
    //`description` varchar(50) NOT NULL COMMENT '中文描述',
    //`type` int(1) NOT NULL COMMENT '类型',
    //`created_at` varchar(50) NOT NULL COMMENT '创建时间',
    //`updated_at` varchar(50) NOT NULL COMMENT '最后更新时间',
    //`deleted_at` varchar(50) DEFAULT NULL COMMENT '删除时间'
    //) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='配置表';
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