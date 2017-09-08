<?php
namespace App\Model;
use Kernel\Model;

/**
 * 后台用户模型
 * Class Config
 * @package App\Model
 */
class Admin extends Model
{
    //--
    //-- 表的结构 `admin`
    //--
    //
    //CREATE TABLE `admin` (
    //`id` int(11) UNSIGNED NOT NULL,
    //`username` varchar(255) DEFAULT NULL,
    //`password` varchar(255) DEFAULT NULL,
    //`created_at` varchar(255) DEFAULT NULL,
    //`updated_at` varchar(255) DEFAULT NULL,
    //`deleted_at` varchar(255) DEFAULT NULL
    //) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    //--
    //-- 转存表中的数据 `admin`
    //--
    //
    //INSERT INTO `admin` (`id`, `username`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
    //(1, 'admin', '$2y$10$UIxhIMqETYR.ux5wKgm5ueAjeo0DR8YGq132mWLpigORC6hontK4a', '1503453690', '1503563338', NULL);

    /**
     * 表名
     * @var string
     */
    protected $table = 'admin';

}