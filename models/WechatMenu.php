<?php
namespace App\Model;
use Kernel\Model;

/**
 * 微信菜单管理配置
 * Class WechatMenu
 * @package App\Model
 */
class WechatMenu extends Model
{
    //--
    //-- 表的结构 `wechat_menu`
    //--
    //
    //CREATE TABLE `wechat_menu` (
    //`id` int(11) NOT NULL COMMENT '数据ID',
    //`name` varchar(50) NOT NULL COMMENT '按钮名称',
    //`event` varchar(50) DEFAULT NULL COMMENT '事件类型',
    //`val` varchar(255) DEFAULT NULL COMMENT '值',
    //`key` varchar(255) DEFAULT NULL COMMENT 'click等点击类型必须',
    //`pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级',
    //`created_at` varchar(50) NOT NULL COMMENT '创建时间',
    //`updated_at` varchar(50) NOT NULL COMMENT '最后更新时间',
    //`deleted_at` varchar(50) DEFAULT NULL COMMENT '数据删除时间'
    //) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信菜单管理';
    //
    //--
    //-- 转存表中的数据 `wechat_menu`
    //--
    //
    //INSERT INTO `wechat_menu` (`id`, `name`, `event`, `val`, `key`, `pid`, `created_at`, `updated_at`, `deleted_at`) VALUES
    //(1, '个人中心', NULL, NULL, '', 0, '1505109121', '1505109121', NULL),
    //(2, '我的订单', 'view', 'http://www.taobao.com', '', 1, '1505109171', '1505109171', NULL),
    //(3, '我的钱包', 'view', 'http://www.tianmao.com', '', 1, '1505109195', '1505109195', NULL),
    //(4, '进入商城', 'view', 'http://www.tianmao.com', '', 0, '1505109220', '1505109220', NULL);
    /**
     * 事件类型
     */
    CONST TYPE = ['链接'=>'view','点击'=>'click'];
    /**
     * 表名
     * @var string
     */
    protected $table = 'wechat_menu';
    /**
     * 关联子级导航
     * @return mixed
     */
    public function son()
    {
        return $this -> hasMany(self::class,'pid','id');
    }
}