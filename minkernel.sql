-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-09-18 16:34:59
-- 服务器版本： 5.6.32-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minkernel`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT '管理员' COMMENT '管理员昵称',
  `headurl` varchar(255) NOT NULL DEFAULT '/assets/avatars/user.jpg' COMMENT '管理员头像',
  `roles` varchar(255) NOT NULL COMMENT '角色ID以逗号分割，超级管理员为-1',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nickname`, `headurl`, `roles`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '$2y$10$UIxhIMqETYR.ux5wKgm5ueAjeo0DR8YGq132mWLpigORC6hontK4a', '管理员', '/assets/avatars/user.jpg', '-1', '1503453690', '1503563338', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_node`
--

CREATE TABLE `admin_node` (
  `id` int(11) NOT NULL COMMENT '数据ID',
  `name` varchar(50) NOT NULL COMMENT '结点名称',
  `level` int(11) NOT NULL COMMENT '级别',
  `controller_name` varchar(50) NOT NULL COMMENT '控制器名称',
  `action_name` varchar(50) NOT NULL COMMENT '操作名称',
  `created_at` varchar(50) NOT NULL COMMENT '数据创建时间',
  `updated_at` varchar(50) NOT NULL COMMENT '数据最后修改时间',
  `deleted_at` varchar(50) DEFAULT NULL COMMENT '数据删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台权限结点管理';

--
-- 转存表中的数据 `admin_node`
--

INSERT INTO `admin_node` (`id`, `name`, `level`, `controller_name`, `action_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '添加文章', 2, 'Word', 'add', '1497495611', '1497495611', NULL),
(2, '删除文章', 2, 'Word', 'delete', '1497495611', '1497495611', NULL),
(3, '修改文章', 2, 'Word', 'edit', '1497495611', '1497495611', NULL),
(4, '浏览文章', 2, 'Index', 'index', '1497495611', '1497495611', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_right`
--

CREATE TABLE `admin_right` (
  `id` int(11) NOT NULL COMMENT '数据ID',
  `name` varchar(50) NOT NULL COMMENT '权限名称',
  `node` varchar(255) NOT NULL COMMENT '对应的结点,以逗号分割',
  `created_at` varchar(50) NOT NULL COMMENT '创建时间',
  `updated_at` varchar(50) NOT NULL COMMENT '最后更新时间',
  `deleted_at` varchar(50) DEFAULT NULL COMMENT '数据删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限表';

--
-- 转存表中的数据 `admin_right`
--

INSERT INTO `admin_right` (`id`, `name`, `node`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '文章管理', '1,2,3,4', '1497495611', '1497495611', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(11) NOT NULL COMMENT '数据ID',
  `name` varchar(50) NOT NULL COMMENT '角色名称',
  `right` varchar(255) NOT NULL COMMENT '所拥有的权利',
  `created_at` varchar(50) NOT NULL COMMENT '角色创建时间',
  `updated_at` varchar(50) NOT NULL COMMENT '最后更新时间',
  `deleted_at` varchar(50) DEFAULT NULL COMMENT '数据删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员角色';

--
-- 转存表中的数据 `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `right`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '文章管理员', '1', '1505187539', '1505187539', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '键',
  `value` text NOT NULL COMMENT '值',
  `description` varchar(50) NOT NULL COMMENT '中文描述',
  `type` int(1) DEFAULT NULL COMMENT '类型',
  `created_at` varchar(50) NOT NULL COMMENT '创建时间',
  `updated_at` varchar(50) NOT NULL COMMENT '最后更新时间',
  `deleted_at` varchar(50) DEFAULT NULL COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='配置表';

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '导航名称',
  `controller` varchar(50) DEFAULT NULL COMMENT '控制器名称',
  `action` varchar(50) DEFAULT NULL COMMENT '操作名称',
  `icon` varchar(50) NOT NULL DEFAULT 'fa-list-alt' COMMENT '图标',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `href` varchar(50) DEFAULT NULL COMMENT '导航链接',
  `created_at` varchar(50) NOT NULL COMMENT '数据创建时间',
  `updated_at` varchar(50) NOT NULL COMMENT '数据最后更新时间',
  `deleted_at` varchar(50) DEFAULT NULL COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台导航表';

--
-- 转存表中的数据 `menu`
--

INSERT INTO `menu` (`id`, `title`, `controller`, `action`, `icon`, `pid`, `href`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '微信管理', 'Wechat', NULL, '&#xe641;', 0, '', '1504598389', '1504598389', NULL),
(2, '微信菜单管理', 'Wechat', 'menu', '&#xe641;', 1, '/Wechat/menu.html', '1504598389', '1504598389', NULL),
(3, '微信参数配置', 'Wechat', 'config', '&#xe641;', 1, '/Wechat/config.html', '1504598389', '1504598389', NULL),
(4, '权限管理', 'Jurisdiction', NULL, '&#xe641;', 0, NULL, '1504598389', '1504598389', NULL),
(5, '角色管理', 'Jurisdiction', 'type', '&#xe641;', 4, '/Jurisdiction/type.html', '1504598389', '1504598389', NULL),
(6, '结点管理', 'Jurisdiction', 'node', '&#xe641;', 4, '/Jurisdiction/node.html', '1504598389', '1504598389', NULL),
(7, '用户管理', 'Jurisdiction', 'user', '&#xe641;', 4, '/Jurisdiction/user.html', '1504598389', '1504598389', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `wechat_config`
--

CREATE TABLE `wechat_config` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '键',
  `value` text NOT NULL COMMENT '值',
  `description` varchar(50) NOT NULL COMMENT '配置描述',
  `created_at` varchar(50) NOT NULL COMMENT '创建时间',
  `updated_at` varchar(50) NOT NULL COMMENT '最后修改时间',
  `deleted_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信配置表';

--
-- 转存表中的数据 `wechat_config`
--

INSERT INTO `wechat_config` (`id`, `name`, `value`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'appid', 'wx072e1d963d683cc0', '公众平台appid', '1505111110', '1505111110', NULL),
(2, 'secret', '038bf5dd19eee518b8d4aa1b348764d5', '公众平台secret', '1505111110', '1505111110', NULL),
(3, 'open_appid', 'wx072e1d963d683cc0', '开放平台appid', '1505111264', '1505111264', NULL),
(4, 'open_secret', '038bf5dd19eee518b8d4aa1b348764d5', '开放平台secret', '1505111283', '1505111283', NULL),
(5, 'pay_key', '4d18db80e353e526ad6d42a62aaa29be', '公众平台支付key', '1505111350', '1505111350', NULL),
(6, 'open_pay_key', '4d18db80e353e526ad6d42a62aaa29be', '开放平台支付key', '1505111378', '1505111378', NULL),
(7, 'mchid', '1486144422', '公众平台商户号', '1505111406', '1505111406', NULL),
(8, 'open_mchid', '1486144422', '开放平台商户号', '1486144422', '1486144422', NULL),
(9, 'notify_url', 'http://host.com/Wechat/callback.html', '消息回调地址', '1505111499', '1505111499', NULL),
(10, 'pay_notify', 'http://host.com/Wechat/pay_callback.html', '支付回调', '1505111556', '1505111556', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `wechat_menu`
--

CREATE TABLE `wechat_menu` (
  `id` int(11) NOT NULL COMMENT '数据ID',
  `name` varchar(50) NOT NULL COMMENT '按钮名称',
  `event` varchar(50) DEFAULT NULL COMMENT '事件类型',
  `val` varchar(255) DEFAULT NULL COMMENT '值',
  `key` varchar(255) DEFAULT NULL COMMENT 'click等点击类型必须',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级',
  `created_at` varchar(50) NOT NULL COMMENT '创建时间',
  `updated_at` varchar(50) NOT NULL COMMENT '最后更新时间',
  `deleted_at` varchar(50) DEFAULT NULL COMMENT '数据删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信菜单管理';

--
-- 转存表中的数据 `wechat_menu`
--

INSERT INTO `wechat_menu` (`id`, `name`, `event`, `val`, `key`, `pid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '个人中心', '', NULL, NULL, 0, '1505109121', '1505109121', NULL),
(5, '我的钱包', 'view', 'http://www.tianmao.com', NULL, 2, '1505109195', '1505109195', NULL),
(6, '企业官网', NULL, NULL, NULL, 0, '1497495611', '1497495611', NULL),
(7, '我的订单', 'view', 'http://www.taobao.com', NULL, 2, '1505109171', '1505109171', NULL),
(8, '进入商城', 'view', 'http://www.tianmao.com', NULL, 0, '1505109220', '1505109220', NULL),
(9, '百度', 'view', 'http://www.baidu.com', '', 6, '1497495611', '1497495611', NULL),
(10, '腾讯', 'view', 'http://www.qq.com', NULL, 6, '1497495611', '1497495611', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_node`
--
ALTER TABLE `admin_node`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_right`
--
ALTER TABLE `admin_right`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wechat_config`
--
ALTER TABLE `wechat_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wechat_menu`
--
ALTER TABLE `wechat_menu`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `admin_node`
--
ALTER TABLE `admin_node`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '数据ID', AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `admin_right`
--
ALTER TABLE `admin_right`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '数据ID', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '数据ID', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `wechat_config`
--
ALTER TABLE `wechat_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- 使用表AUTO_INCREMENT `wechat_menu`
--
ALTER TABLE `wechat_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '数据ID', AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
