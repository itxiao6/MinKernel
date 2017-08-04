<?php
namespace App\Model;
use App\Model\Bid;
use Kernel\Model;
/**
 * 用户模型
 */
class User extends Model
{
    /**
     * 这是模型的表定义
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * 这里是表主键的定义
     *
     * @var string
     */
    protected $primaryKey = 'id';

}
