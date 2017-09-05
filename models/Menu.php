<?php
namespace App\Model;
use Kernel\Model;

/**
 * 配置模型
 * Class Config
 * @package App\Model
 */
class Menu extends Model
{
    //--
    //-- 表的结构 `menu`
    //--
    //
    //CREATE TABLE `menu` (
    //`id` int(11) NOT NULL,
    //`name` varchar(50) NOT NULL COMMENT '导航名称',
    //`controller` varchar(50) DEFAULT NULL COMMENT '控制器名称',
    //`action` varchar(50) DEFAULT NULL COMMENT '操作名称',
    //`icon` varchar(50) NOT NULL DEFAULT 'fa-list-alt' COMMENT '图标',
    //`pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
    //`created_at` varchar(50) NOT NULL COMMENT '数据创建时间',
    //`updated_at` varchar(50) NOT NULL COMMENT '数据最后更新时间',
    //`deleted_at` varchar(50) DEFAULT NULL COMMENT '删除时间'
    //) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台导航表';
    # 数据
    //INSERT INTO `menu` (`id`, `name`, `controller`, `action`, `icon`, `pid`, `href`, `created_at`, `updated_at`, `deleted_at`) VALUES
    //(1, '微信管理', 'Wechat', NULL, 'fa-list-alt', 0, '', '1504598389', '1504598389', NULL),
    //(2, '微信菜单管理', 'Wechat', 'menu', 'fa-list-alt', 1, '/Wechat/menu.html', '1504598389', '1504598389', NULL),
    //(3, '微信参数配置', 'Wechat', 'config', 'fa-list-alt', 1, '/Wechat/config.html', '1504598389', '1504598389', NULL),
    //(4, '权限管理', 'Jurisdiction', NULL, 'fa-list-alt', 0, NULL, '1504598389', '1504598389', NULL),
    //(5, '角色管理', 'Jurisdiction', 'type', 'fa-list-alt', 4, '/Jurisdiction/type.html', '1504598389', '1504598389', NULL),
    //(6, '结点管理', 'Jurisdiction', 'node', 'fa-list-alt', 4, '/Jurisdiction/node.html', '1504598389', '1504598389', NULL),
    //(7, '用户管理', 'Jurisdiction', 'user', 'fa-list-alt', 4, '/Jurisdiction/user.html', '1504598389', '1504598389', NULL);

    /**
     * 表名
     * @var string
     */
    protected $table = 'menu';

    /**
     * 关联子级导航
     * @return \Itxiao6\Database\Eloquent\Relations\HasMany
     */
    public function son()
    {
        return $this -> hasMany(self::class,'pid','id');
    }

}