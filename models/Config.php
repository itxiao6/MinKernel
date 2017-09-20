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
    CONST TYPE = [
        1=>'系统配置',
        2=>'微信配置',
        3=>'支付宝配置',
        4=>'七牛配置',
        5=>'阿里OSS配置',
        6=>'redis',
        7=>'存储配置',
        8=>'缓存配置',
    ];
    /**
     * 表名
     * @var string
     */
    protected $table = 'config';
    # 设置七牛配置
    public static function set_qiniu_config($name,$value = null)
    {
        if(is_array($name)){
            foreach($name as $key=>$val){
                self::set_qiniu_config($key,$val);
            }
        }else{
            if($old_value = self::where(['type'=>4,'name'=>$name]) -> first()){
                if($old_value -> value == $value){
                    return true;
                }
                self::where(['type'=>4,'name'=>$name]) -> update(['value'=>$value]);
            }else{
                self::insert(['type'=>4,'name'=>$name,'value'=>$value,'created_at'=>time(),'updated_at'=>time()]);
            }
        }
    }
    # 设置阿里oss配置
    public static function set_alioss_config($name,$value = null)
    {
        if(is_array($name)){
            foreach($name as $key=>$val){
                self::set_alioss_config($key,$val);
            }
        }else{
            if($old_value = self::where(['type'=>5,'name'=>$name]) -> first()){
                if($old_value -> value == $value){
                    return true;
                }
                self::where(['type'=>5,'name'=>$name]) -> update(['value'=>$value]);
            }else{
                self::insert(['type'=>5,'name'=>$name,'value'=>$value,'created_at'=>time(),'updated_at'=>time()]);
            }
        }
    }
    # redis 配置
    public static function set_redis_config($name,$value = null)
    {
        if(is_array($name)){
            foreach($name as $key=>$val){
                self::set_redis_config($key,$val);
            }
        }else{
            if($old_value = self::where(['type'=>6,'name'=>$name]) -> first()){
                if($old_value -> value == $value){
                    return true;
                }
                self::where(['type'=>6,'name'=>$name]) -> update(['value'=>$value]);
            }else{
                self::insert(['type'=>6,'name'=>$name,'value'=>$value,'created_at'=>time(),'updated_at'=>time()]);
            }
        }
    }
    # 存储驱动设置
    public static function set_storage_config($name,$value = null)
    {
        if(is_array($name)){
            foreach($name as $key=>$val){
                self::set_storage_config($key,$val);
            }
        }else{
            if($old_value = self::where(['type'=>7,'name'=>$name]) -> first()){
                if($old_value -> value == $value){
                    return true;
                }
                self::where(['type'=>7,'name'=>$name]) -> update(['value'=>$value]);
            }else{
                self::insert(['type'=>7,'name'=>$name,'value'=>$value,'created_at'=>time(),'updated_at'=>time()]);
            }
        }
    }
    # 缓存驱动设置
    public static function set_cache_config($name,$value = null)
    {
        if(is_array($name)){
            foreach($name as $key=>$val){
                self::set_cache_config($key,$val);
            }
        }else{
            if($old_value = self::where(['type'=>8,'name'=>$name]) -> first()){
                if($old_value -> value == $value){
                    return true;
                }
                self::where(['type'=>8,'name'=>$name]) -> update(['value'=>$value]);
            }else{
                self::insert(['type'=>8,'name'=>$name,'value'=>$value,'created_at'=>time(),'updated_at'=>time()]);
            }
        }
    }

}