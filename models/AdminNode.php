<?php
namespace App\Model;
use Kernel\Model;

/**
 * 后台权限结点
 * Class AdminNode
 * @package App\Model
 */
class AdminNode extends Model
{
    /**
     * 权限级别
     */
    CONST LEVEL = [1=>'控制器',2=>'操作'];
    /**
     * 表名
     * @var string
     */
    protected $table = 'admin_node';

}