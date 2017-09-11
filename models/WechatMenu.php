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