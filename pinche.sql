/*
Navicat MariaDB Data Transfer

Source Server         : 192.168.3.250_3306
Source Server Version : 100028
Source Host           : 192.168.1.250:3306
Source Database       : pinche

Target Server Type    : MariaDB
Target Server Version : 100028
File Encoding         : 65001

Date: 2016-12-16 17:28:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '数据id',
  `name` varchar(50) DEFAULT NULL COMMENT '地区名称',
  `pid` int(11) DEFAULT NULL COMMENT '父级id',
  `path` varchar(255) DEFAULT NULL COMMENT '上下级关系',
  `description` varchar(255) DEFAULT NULL COMMENT '地区描述',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('1', '河南', '0', '0', null, '2016-12-15 09:00:15', '2016-12-15 09:00:15');
INSERT INTO `address` VALUES ('2', '周口', '1', '0,1', null, '2016-12-15 09:00:31', '2016-12-15 09:00:31');
INSERT INTO `address` VALUES ('3', '商水', '2', '0,1,2', null, '2016-12-15 09:00:43', '2016-12-15 09:00:43');
INSERT INTO `address` VALUES ('4', '大武', '3', '0,1,2,3', null, '2016-12-15 09:00:54', '2016-12-15 09:00:54');
INSERT INTO `address` VALUES ('5', '北京', '0', '0', null, '2016-12-15 09:01:02', '2016-12-15 09:01:02');
INSERT INTO `address` VALUES ('6', '昌平区', '5', '0,5', null, '2016-12-15 09:01:14', '2016-12-15 09:01:14');
INSERT INTO `address` VALUES ('7', '回龙观', '6', '0,5,6', null, '2016-12-15 09:01:23', '2016-12-15 09:01:23');

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '后台用户id',
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `permissions` varchar(255) DEFAULT NULL COMMENT '权限分配(每个操作的技能id)权限为-1则是超级管理员以逗号分割',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'itxiao6', 'a46da1ad6aac4605b22621068816e21c', '-1', null, null);

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '车辆id',
  `line` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL COMMENT '行驶证',
  `status` int(11) DEFAULT '0' COMMENT '状态:0=未审核,1=正常,2=行驶中,3=返程,4=不接单,-1冻结',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES ('4', '3', '1', 'http://oi9n5eegf.bkt.clouddn.com/14818750503184426934', '-1', '2016-12-16 08:27:47', '2016-12-16 07:57:35');

-- ----------------------------
-- Table structure for code
-- ----------------------------
DROP TABLE IF EXISTS `code`;
CREATE TABLE `code` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '数据id',
  `type` int(11) DEFAULT NULL COMMENT '验证码类型:1=邮箱注册验证码,2=手机注册验证码',
  `code` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of code
-- ----------------------------

-- ----------------------------
-- Table structure for lines
-- ----------------------------
DROP TABLE IF EXISTS `lines`;
CREATE TABLE `lines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` int(11) DEFAULT NULL COMMENT '出发地id',
  `end` int(11) DEFAULT NULL COMMENT '目的地',
  `status` int(11) DEFAULT '0' COMMENT '路线状态:0=审核中,1=正常运营,2=已经停运',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lines
-- ----------------------------
INSERT INTO `lines` VALUES ('3', '7', '4', '1', '2016-12-15 09:39:38', '2016-12-15 09:30:14');
INSERT INTO `lines` VALUES ('4', '5', '3', '1', '2016-12-15 09:36:26', '2016-12-15 09:36:26');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sql` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` char(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` char(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=344 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('1', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-15 08:55:13');
INSERT INTO `log` VALUES ('2', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-15 08:55:13');
INSERT INTO `log` VALUES ('3', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-15 08:55:30');
INSERT INTO `log` VALUES ('4', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-15 08:55:31');
INSERT INTO `log` VALUES ('5', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-15 08:55:40');
INSERT INTO `log` VALUES ('6', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-15 08:55:42');
INSERT INTO `log` VALUES ('7', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-15 08:57:30');
INSERT INTO `log` VALUES ('8', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-15 08:57:32');
INSERT INTO `log` VALUES ('9', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 08:57:36');
INSERT INTO `log` VALUES ('10', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 08:57:42');
INSERT INTO `log` VALUES ('11', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 08:58:16');
INSERT INTO `log` VALUES ('12', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:00:15');
INSERT INTO `log` VALUES ('13', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E5%9C%B0%E5%8C%BA%E5%88%86%E7%B1%BB%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:00:15');
INSERT INTO `log` VALUES ('14', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-15 09:00:19');
INSERT INTO `log` VALUES ('15', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-15 09:00:24');
INSERT INTO `log` VALUES ('16', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:00:25');
INSERT INTO `log` VALUES ('17', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:00:31');
INSERT INTO `log` VALUES ('18', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E5%9C%B0%E5%8C%BA%E5%88%86%E7%B1%BB%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:00:31');
INSERT INTO `log` VALUES ('19', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-15 09:00:33');
INSERT INTO `log` VALUES ('20', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:00:36');
INSERT INTO `log` VALUES ('21', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:00:43');
INSERT INTO `log` VALUES ('22', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E5%9C%B0%E5%8C%BA%E5%88%86%E7%B1%BB%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:00:43');
INSERT INTO `log` VALUES ('23', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:00:46');
INSERT INTO `log` VALUES ('24', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:00:54');
INSERT INTO `log` VALUES ('25', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E5%9C%B0%E5%8C%BA%E5%88%86%E7%B1%BB%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:00:54');
INSERT INTO `log` VALUES ('26', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:00:56');
INSERT INTO `log` VALUES ('27', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:01:02');
INSERT INTO `log` VALUES ('28', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E5%9C%B0%E5%8C%BA%E5%88%86%E7%B1%BB%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:01:02');
INSERT INTO `log` VALUES ('29', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:01:04');
INSERT INTO `log` VALUES ('30', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:01:14');
INSERT INTO `log` VALUES ('31', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E5%9C%B0%E5%8C%BA%E5%88%86%E7%B1%BB%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:01:14');
INSERT INTO `log` VALUES ('32', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:01:16');
INSERT INTO `log` VALUES ('33', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-15 09:01:23');
INSERT INTO `log` VALUES ('34', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E5%9C%B0%E5%8C%BA%E5%88%86%E7%B1%BB%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:01:23');
INSERT INTO `log` VALUES ('35', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-15 09:01:25');
INSERT INTO `log` VALUES ('36', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-15 09:03:10');
INSERT INTO `log` VALUES ('37', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-15 09:03:13');
INSERT INTO `log` VALUES ('38', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-15 09:03:14');
INSERT INTO `log` VALUES ('39', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-15 09:03:18');
INSERT INTO `log` VALUES ('40', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/lists.html', '2016-12-15 09:05:21');
INSERT INTO `log` VALUES ('41', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/add.html', '2016-12-15 09:05:25');
INSERT INTO `log` VALUES ('42', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/add.html', '2016-12-15 09:17:40');
INSERT INTO `log` VALUES ('43', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:17:42');
INSERT INTO `log` VALUES ('44', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html', '2016-12-15 09:17:44');
INSERT INTO `log` VALUES ('45', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:17:46');
INSERT INTO `log` VALUES ('46', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:21:46');
INSERT INTO `log` VALUES ('47', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-15 09:21:46');
INSERT INTO `log` VALUES ('48', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-15 09:21:46');
INSERT INTO `log` VALUES ('49', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-15 09:22:00');
INSERT INTO `log` VALUES ('50', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-15 09:22:01');
INSERT INTO `log` VALUES ('51', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:22:11');
INSERT INTO `log` VALUES ('52', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:22:22');
INSERT INTO `log` VALUES ('53', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:23:37');
INSERT INTO `log` VALUES ('54', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html', '2016-12-15 09:23:40');
INSERT INTO `log` VALUES ('55', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html', '2016-12-15 09:24:14');
INSERT INTO `log` VALUES ('56', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html', '2016-12-15 09:24:42');
INSERT INTO `log` VALUES ('57', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html', '2016-12-15 09:25:05');
INSERT INTO `log` VALUES ('58', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%B7%AF%E7%BA%BF%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:25:05');
INSERT INTO `log` VALUES ('59', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%B7%AF%E7%BA%BF%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:25:19');
INSERT INTO `log` VALUES ('60', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:25:22');
INSERT INTO `log` VALUES ('61', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:26:09');
INSERT INTO `log` VALUES ('62', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html', '2016-12-15 09:26:11');
INSERT INTO `log` VALUES ('63', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html', '2016-12-15 09:26:15');
INSERT INTO `log` VALUES ('64', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%B7%AF%E7%BA%BF%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:26:15');
INSERT INTO `log` VALUES ('65', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%B7%AF%E7%BA%BF%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:29:47');
INSERT INTO `log` VALUES ('66', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E5%A4%B1%E8%B4%A5&description=%E5%87%BA%E5%8F%91%E5%9C%B0%E5%92%8C%E7%9B%AE%E7%9A%84%E5%9C%B0%E4%B8%8D%E8%83%BD%E7%9B%B8%E5%90%8C', '2016-12-15 09:29:47');
INSERT INTO `log` VALUES ('67', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E5%A4%B1%E8%B4%A5&description=%E5%87%BA%E5%8F%91%E5%9C%B0%E5%92%8C%E7%9B%AE%E7%9A%84%E5%9C%B0%E4%B8%8D%E8%83%BD%E7%9B%B8%E5%90%8C', '2016-12-15 09:29:57');
INSERT INTO `log` VALUES ('68', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=danger&message=%E6%B7%BB%E5%8A%A0%E5%A4%B1%E8%B4%A5&description=%E5%87%BA%E5%8F%91%E5%9C%B0%E5%92%8C%E7%9B%AE%E7%9A%84%E5%9C%B0%E4%B8%8D%E8%83%BD%E7%9B%B8%E5%90%8C', '2016-12-15 09:29:57');
INSERT INTO `log` VALUES ('69', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=danger&message=%E6%B7%BB%E5%8A%A0%E5%A4%B1%E8%B4%A5&description=%E5%87%BA%E5%8F%91%E5%9C%B0%E5%92%8C%E7%9B%AE%E7%9A%84%E5%9C%B0%E4%B8%8D%E8%83%BD%E7%9B%B8%E5%90%8C', '2016-12-15 09:30:06');
INSERT INTO `log` VALUES ('70', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=danger&message=%E6%B7%BB%E5%8A%A0%E5%A4%B1%E8%B4%A5&description=%E5%87%BA%E5%8F%91%E5%9C%B0%E5%92%8C%E7%9B%AE%E7%9A%84%E5%9C%B0%E4%B8%8D%E8%83%BD%E7%9B%B8%E5%90%8C', '2016-12-15 09:30:06');
INSERT INTO `log` VALUES ('71', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=danger&message=%E6%B7%BB%E5%8A%A0%E5%A4%B1%E8%B4%A5&description=%E5%87%BA%E5%8F%91%E5%9C%B0%E5%92%8C%E7%9B%AE%E7%9A%84%E5%9C%B0%E4%B8%8D%E8%83%BD%E7%9B%B8%E5%90%8C', '2016-12-15 09:30:14');
INSERT INTO `log` VALUES ('72', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%B7%AF%E7%BA%BF%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:30:14');
INSERT INTO `log` VALUES ('73', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:30:30');
INSERT INTO `log` VALUES ('74', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:32:54');
INSERT INTO `log` VALUES ('75', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:32:56');
INSERT INTO `log` VALUES ('76', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:33:07');
INSERT INTO `log` VALUES ('77', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:33:33');
INSERT INTO `log` VALUES ('78', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=', '2016-12-15 09:33:34');
INSERT INTO `log` VALUES ('79', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=', '2016-12-15 09:33:48');
INSERT INTO `log` VALUES ('80', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=', '2016-12-15 09:33:49');
INSERT INTO `log` VALUES ('81', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=', '2016-12-15 09:33:50');
INSERT INTO `log` VALUES ('82', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=', '2016-12-15 09:33:53');
INSERT INTO `log` VALUES ('83', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=', '2016-12-15 09:33:54');
INSERT INTO `log` VALUES ('84', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=', '2016-12-15 09:35:01');
INSERT INTO `log` VALUES ('85', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:35:04');
INSERT INTO `log` VALUES ('86', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=', '2016-12-15 09:35:05');
INSERT INTO `log` VALUES ('87', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=', '2016-12-15 09:35:06');
INSERT INTO `log` VALUES ('88', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=', '2016-12-15 09:35:07');
INSERT INTO `log` VALUES ('89', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:35:09');
INSERT INTO `log` VALUES ('90', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:35:22');
INSERT INTO `log` VALUES ('91', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=', '2016-12-15 09:35:41');
INSERT INTO `log` VALUES ('92', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:35:42');
INSERT INTO `log` VALUES ('93', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:35:43');
INSERT INTO `log` VALUES ('94', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:35:44');
INSERT INTO `log` VALUES ('95', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:35:57');
INSERT INTO `log` VALUES ('96', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:35:58');
INSERT INTO `log` VALUES ('97', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:36:00');
INSERT INTO `log` VALUES ('98', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:36:01');
INSERT INTO `log` VALUES ('99', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:36:02');
INSERT INTO `log` VALUES ('100', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:36:03');
INSERT INTO `log` VALUES ('101', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:36:03');
INSERT INTO `log` VALUES ('102', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:36:04');
INSERT INTO `log` VALUES ('103', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:36:20');
INSERT INTO `log` VALUES ('104', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html', '2016-12-15 09:36:21');
INSERT INTO `log` VALUES ('105', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html', '2016-12-15 09:36:26');
INSERT INTO `log` VALUES ('106', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%B7%AF%E7%BA%BF%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-15 09:36:26');
INSERT INTO `log` VALUES ('107', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:36:29');
INSERT INTO `log` VALUES ('108', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:36:46');
INSERT INTO `log` VALUES ('109', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=4', '2016-12-15 09:36:49');
INSERT INTO `log` VALUES ('110', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=4', '2016-12-15 09:36:51');
INSERT INTO `log` VALUES ('111', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=4', '2016-12-15 09:36:52');
INSERT INTO `log` VALUES ('112', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=4', '2016-12-15 09:36:54');
INSERT INTO `log` VALUES ('113', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=4', '2016-12-15 09:37:12');
INSERT INTO `log` VALUES ('114', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=4', '2016-12-15 09:37:17');
INSERT INTO `log` VALUES ('115', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=4', '2016-12-15 09:37:43');
INSERT INTO `log` VALUES ('116', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=4', '2016-12-15 09:39:23');
INSERT INTO `log` VALUES ('117', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:39:27');
INSERT INTO `log` VALUES ('118', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:39:28');
INSERT INTO `log` VALUES ('119', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=3', '2016-12-15 09:39:38');
INSERT INTO `log` VALUES ('120', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?status=success&message=%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&description=%E8%B7%AF%E7%BA%BF%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&id=3', '2016-12-15 09:39:38');
INSERT INTO `log` VALUES ('121', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:39:40');
INSERT INTO `log` VALUES ('122', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:40:51');
INSERT INTO `log` VALUES ('123', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:40:57');
INSERT INTO `log` VALUES ('124', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:40:59');
INSERT INTO `log` VALUES ('125', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html', '2016-12-15 09:41:01');
INSERT INTO `log` VALUES ('126', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:41:04');
INSERT INTO `log` VALUES ('127', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:49:42');
INSERT INTO `log` VALUES ('128', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:50:25');
INSERT INTO `log` VALUES ('129', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-15 09:51:21');
INSERT INTO `log` VALUES ('130', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-15 09:51:26');
INSERT INTO `log` VALUES ('131', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-15 09:51:29');
INSERT INTO `log` VALUES ('132', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-15 09:53:00');
INSERT INTO `log` VALUES ('133', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-15 09:53:00');
INSERT INTO `log` VALUES ('134', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-15 09:53:00');
INSERT INTO `log` VALUES ('135', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.009947299208392213', '2016-12-15 09:53:13');
INSERT INTO `log` VALUES ('136', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-15 09:53:19');
INSERT INTO `log` VALUES ('137', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-15 09:53:20');
INSERT INTO `log` VALUES ('138', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-15 09:53:23');
INSERT INTO `log` VALUES ('139', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 00:12:09');
INSERT INTO `log` VALUES ('140', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 00:12:10');
INSERT INTO `log` VALUES ('141', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 00:12:23');
INSERT INTO `log` VALUES ('142', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-16 00:12:25');
INSERT INTO `log` VALUES ('143', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 00:12:32');
INSERT INTO `log` VALUES ('144', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:12:35');
INSERT INTO `log` VALUES ('145', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:18:26');
INSERT INTO `log` VALUES ('146', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:18:39');
INSERT INTO `log` VALUES ('147', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:18:52');
INSERT INTO `log` VALUES ('148', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:22:38');
INSERT INTO `log` VALUES ('149', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:30:58');
INSERT INTO `log` VALUES ('150', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-16 00:31:00');
INSERT INTO `log` VALUES ('151', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/add.html', '2016-12-16 00:31:02');
INSERT INTO `log` VALUES ('152', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-16 00:31:05');
INSERT INTO `log` VALUES ('153', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/show.html?id=1', '2016-12-16 00:31:07');
INSERT INTO `log` VALUES ('154', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/lists.html', '2016-12-16 00:31:09');
INSERT INTO `log` VALUES ('155', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/add.html', '2016-12-16 00:31:11');
INSERT INTO `log` VALUES ('156', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/lists.html', '2016-12-16 00:31:14');
INSERT INTO `log` VALUES ('157', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-16 00:31:16');
INSERT INTO `log` VALUES ('158', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/add.html', '2016-12-16 00:31:19');
INSERT INTO `log` VALUES ('159', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/lists.html', '2016-12-16 00:31:21');
INSERT INTO `log` VALUES ('160', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 00:32:16');
INSERT INTO `log` VALUES ('161', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:32:18');
INSERT INTO `log` VALUES ('162', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 00:32:20');
INSERT INTO `log` VALUES ('163', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:32:21');
INSERT INTO `log` VALUES ('164', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:40:51');
INSERT INTO `log` VALUES ('165', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:41:28');
INSERT INTO `log` VALUES ('166', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:42:12');
INSERT INTO `log` VALUES ('167', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 00:42:12');
INSERT INTO `log` VALUES ('168', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 00:42:12');
INSERT INTO `log` VALUES ('169', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 00:42:24');
INSERT INTO `log` VALUES ('170', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-16 00:42:26');
INSERT INTO `log` VALUES ('171', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:42:31');
INSERT INTO `log` VALUES ('172', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:42:38');
INSERT INTO `log` VALUES ('173', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 00:43:48');
INSERT INTO `log` VALUES ('174', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 01:12:56');
INSERT INTO `log` VALUES ('175', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 01:12:57');
INSERT INTO `log` VALUES ('176', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 01:12:57');
INSERT INTO `log` VALUES ('177', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 01:37:35');
INSERT INTO `log` VALUES ('178', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 01:37:37');
INSERT INTO `log` VALUES ('179', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 01:37:37');
INSERT INTO `log` VALUES ('180', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 01:37:37');
INSERT INTO `log` VALUES ('181', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 01:37:40');
INSERT INTO `log` VALUES ('182', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 01:37:40');
INSERT INTO `log` VALUES ('183', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 01:45:15');
INSERT INTO `log` VALUES ('184', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 01:45:15');
INSERT INTO `log` VALUES ('185', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 01:45:25');
INSERT INTO `log` VALUES ('186', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.13483835155742874', '2016-12-16 01:45:27');
INSERT INTO `log` VALUES ('187', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.8205175613045224', '2016-12-16 01:45:30');
INSERT INTO `log` VALUES ('188', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.8421182742729989', '2016-12-16 01:45:34');
INSERT INTO `log` VALUES ('189', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 01:45:42');
INSERT INTO `log` VALUES ('190', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-16 01:45:44');
INSERT INTO `log` VALUES ('191', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 01:45:50');
INSERT INTO `log` VALUES ('192', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 01:45:52');
INSERT INTO `log` VALUES ('193', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 01:46:00');
INSERT INTO `log` VALUES ('194', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 01:57:18');
INSERT INTO `log` VALUES ('195', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 01:59:15');
INSERT INTO `log` VALUES ('196', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 01:59:38');
INSERT INTO `log` VALUES ('197', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 02:00:52');
INSERT INTO `log` VALUES ('198', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 02:00:55');
INSERT INTO `log` VALUES ('199', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 02:01:45');
INSERT INTO `log` VALUES ('200', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 02:01:46');
INSERT INTO `log` VALUES ('201', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 02:01:48');
INSERT INTO `log` VALUES ('202', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 02:01:49');
INSERT INTO `log` VALUES ('203', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 02:01:55');
INSERT INTO `log` VALUES ('204', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 02:49:24');
INSERT INTO `log` VALUES ('205', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 02:49:24');
INSERT INTO `log` VALUES ('206', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 02:49:24');
INSERT INTO `log` VALUES ('207', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 05:49:01');
INSERT INTO `log` VALUES ('208', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 05:49:02');
INSERT INTO `log` VALUES ('209', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 06:38:06');
INSERT INTO `log` VALUES ('210', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 06:38:06');
INSERT INTO `log` VALUES ('211', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 06:38:20');
INSERT INTO `log` VALUES ('212', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-16 06:38:21');
INSERT INTO `log` VALUES ('213', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 06:38:27');
INSERT INTO `log` VALUES ('214', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 06:38:29');
INSERT INTO `log` VALUES ('215', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 06:38:31');
INSERT INTO `log` VALUES ('216', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 06:38:35');
INSERT INTO `log` VALUES ('217', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 06:57:49');
INSERT INTO `log` VALUES ('218', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 06:58:41');
INSERT INTO `log` VALUES ('219', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 06:58:47');
INSERT INTO `log` VALUES ('220', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 06:59:06');
INSERT INTO `log` VALUES ('221', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 06:59:18');
INSERT INTO `log` VALUES ('222', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:03:32');
INSERT INTO `log` VALUES ('223', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:04:09');
INSERT INTO `log` VALUES ('224', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:04:30');
INSERT INTO `log` VALUES ('225', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:04:47');
INSERT INTO `log` VALUES ('226', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:06:14');
INSERT INTO `log` VALUES ('227', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:08:27');
INSERT INTO `log` VALUES ('228', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 07:08:27');
INSERT INTO `log` VALUES ('229', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:08:33');
INSERT INTO `log` VALUES ('230', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 07:08:33');
INSERT INTO `log` VALUES ('231', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 07:08:33');
INSERT INTO `log` VALUES ('232', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 07:08:46');
INSERT INTO `log` VALUES ('233', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-16 07:08:48');
INSERT INTO `log` VALUES ('234', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 07:08:50');
INSERT INTO `log` VALUES ('235', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 07:08:53');
INSERT INTO `log` VALUES ('236', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 07:11:13');
INSERT INTO `log` VALUES ('237', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 07:14:29');
INSERT INTO `log` VALUES ('238', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 07:16:25');
INSERT INTO `log` VALUES ('239', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 07:18:30');
INSERT INTO `log` VALUES ('240', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 07:51:08');
INSERT INTO `log` VALUES ('241', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 07:51:08');
INSERT INTO `log` VALUES ('242', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 07:51:08');
INSERT INTO `log` VALUES ('243', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 07:51:25');
INSERT INTO `log` VALUES ('244', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.7574348084219238', '2016-12-16 07:51:28');
INSERT INTO `log` VALUES ('245', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.15243428340640341', '2016-12-16 07:51:29');
INSERT INTO `log` VALUES ('246', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.5493610024696471', '2016-12-16 07:51:30');
INSERT INTO `log` VALUES ('247', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.13325479143435004', '2016-12-16 07:51:31');
INSERT INTO `log` VALUES ('248', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.49725220529568825', '2016-12-16 07:51:34');
INSERT INTO `log` VALUES ('249', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.5979149062711719', '2016-12-16 07:51:36');
INSERT INTO `log` VALUES ('250', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.2996714912282683', '2016-12-16 07:51:37');
INSERT INTO `log` VALUES ('251', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.9773855516039378', '2016-12-16 07:51:38');
INSERT INTO `log` VALUES ('252', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.9646637161063125', '2016-12-16 07:51:39');
INSERT INTO `log` VALUES ('253', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.9871671203483654', '2016-12-16 07:51:40');
INSERT INTO `log` VALUES ('254', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.48119611095497894', '2016-12-16 07:51:41');
INSERT INTO `log` VALUES ('255', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.14786724373854976', '2016-12-16 07:51:42');
INSERT INTO `log` VALUES ('256', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 07:51:50');
INSERT INTO `log` VALUES ('257', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-16 07:51:52');
INSERT INTO `log` VALUES ('258', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 07:51:56');
INSERT INTO `log` VALUES ('259', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 07:51:58');
INSERT INTO `log` VALUES ('260', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 07:52:09');
INSERT INTO `log` VALUES ('261', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 07:52:22');
INSERT INTO `log` VALUES ('262', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 07:52:36');
INSERT INTO `log` VALUES ('263', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:52:42');
INSERT INTO `log` VALUES ('264', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:55:08');
INSERT INTO `log` VALUES ('265', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:56:07');
INSERT INTO `log` VALUES ('266', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:56:34');
INSERT INTO `log` VALUES ('267', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:56:47');
INSERT INTO `log` VALUES ('268', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:56:53');
INSERT INTO `log` VALUES ('269', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:57:30');
INSERT INTO `log` VALUES ('270', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html?status=success&message=%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E6%B7%BB%E5%8A%A0%E6%88%90%E5%8A%9F', '2016-12-16 07:57:35');
INSERT INTO `log` VALUES ('271', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:12:00');
INSERT INTO `log` VALUES ('272', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Line/edit.html?id=4', '2016-12-16 08:12:01');
INSERT INTO `log` VALUES ('273', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:12:08');
INSERT INTO `log` VALUES ('274', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:12:24');
INSERT INTO `log` VALUES ('275', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/edit.html?id=4', '2016-12-16 08:12:25');
INSERT INTO `log` VALUES ('276', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/edit.html?id=4', '2016-12-16 08:12:53');
INSERT INTO `log` VALUES ('277', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/edit.html?id=4', '2016-12-16 08:14:38');
INSERT INTO `log` VALUES ('278', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/edit.html?id=4', '2016-12-16 08:14:42');
INSERT INTO `log` VALUES ('279', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/edit.html?id=4', '2016-12-16 08:15:25');
INSERT INTO `log` VALUES ('280', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/edit.html?status=success&message=%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&id=4', '2016-12-16 08:15:25');
INSERT INTO `log` VALUES ('281', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/edit.html?status=success&message=%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&id=4', '2016-12-16 08:15:30');
INSERT INTO `log` VALUES ('282', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:15:44');
INSERT INTO `log` VALUES ('283', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:23:42');
INSERT INTO `log` VALUES ('284', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 08:23:42');
INSERT INTO `log` VALUES ('285', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html', '2016-12-16 08:23:42');
INSERT INTO `log` VALUES ('286', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.5937533718665369', '2016-12-16 08:23:52');
INSERT INTO `log` VALUES ('287', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.18491912199108995', '2016-12-16 08:23:53');
INSERT INTO `log` VALUES ('288', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 08:24:01');
INSERT INTO `log` VALUES ('289', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.6018924692486882', '2016-12-16 08:24:03');
INSERT INTO `log` VALUES ('290', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Code.html?id=0.805545973756282', '2016-12-16 08:24:04');
INSERT INTO `log` VALUES ('291', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Login.html', '2016-12-16 08:24:10');
INSERT INTO `log` VALUES ('292', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-16 08:24:12');
INSERT INTO `log` VALUES ('293', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:24:14');
INSERT INTO `log` VALUES ('294', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:24:16');
INSERT INTO `log` VALUES ('295', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:24:35');
INSERT INTO `log` VALUES ('296', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:24:58');
INSERT INTO `log` VALUES ('297', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:27:39');
INSERT INTO `log` VALUES ('298', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:27:40');
INSERT INTO `log` VALUES ('299', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/edit.html?id=4', '2016-12-16 08:27:42');
INSERT INTO `log` VALUES ('300', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/edit.html?id=4', '2016-12-16 08:27:47');
INSERT INTO `log` VALUES ('301', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/edit.html?status=success&message=%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&description=%E8%BD%A6%E8%BE%86%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&id=4', '2016-12-16 08:27:47');
INSERT INTO `log` VALUES ('302', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:27:49');
INSERT INTO `log` VALUES ('303', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:27:51');
INSERT INTO `log` VALUES ('304', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:27:55');
INSERT INTO `log` VALUES ('305', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:29:45');
INSERT INTO `log` VALUES ('306', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/lists.html', '2016-12-16 08:29:48');
INSERT INTO `log` VALUES ('307', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/lists.html', '2016-12-16 08:29:51');
INSERT INTO `log` VALUES ('308', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/add.html', '2016-12-16 08:29:55');
INSERT INTO `log` VALUES ('309', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/add.html', '2016-12-16 08:34:41');
INSERT INTO `log` VALUES ('310', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:34:46');
INSERT INTO `log` VALUES ('311', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 08:34:48');
INSERT INTO `log` VALUES ('312', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/add.html', '2016-12-16 08:36:02');
INSERT INTO `log` VALUES ('313', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/lists.html', '2016-12-16 08:36:04');
INSERT INTO `log` VALUES ('314', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/edit.html?id=1', '2016-12-16 08:36:06');
INSERT INTO `log` VALUES ('315', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/lists.html', '2016-12-16 08:36:08');
INSERT INTO `log` VALUES ('316', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Address/show.html?id=1', '2016-12-16 08:36:09');
INSERT INTO `log` VALUES ('317', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/lists.html', '2016-12-16 08:36:11');
INSERT INTO `log` VALUES ('318', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/lists.html', '2016-12-16 08:36:30');
INSERT INTO `log` VALUES ('319', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:36:31');
INSERT INTO `log` VALUES ('320', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:36:35');
INSERT INTO `log` VALUES ('321', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/lists.html', '2016-12-16 08:36:37');
INSERT INTO `log` VALUES ('322', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:36:38');
INSERT INTO `log` VALUES ('323', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:38:02');
INSERT INTO `log` VALUES ('324', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:38:04');
INSERT INTO `log` VALUES ('325', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:38:10');
INSERT INTO `log` VALUES ('326', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:39:03');
INSERT INTO `log` VALUES ('327', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:39:20');
INSERT INTO `log` VALUES ('328', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:39:47');
INSERT INTO `log` VALUES ('329', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:40:24');
INSERT INTO `log` VALUES ('330', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:40:26');
INSERT INTO `log` VALUES ('331', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:40:27');
INSERT INTO `log` VALUES ('332', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:40:41');
INSERT INTO `log` VALUES ('333', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:40:42');
INSERT INTO `log` VALUES ('334', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?id=1', '2016-12-16 08:40:54');
INSERT INTO `log` VALUES ('335', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?status=success&message=%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&description=%E7%94%A8%E6%88%B7%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&id=1', '2016-12-16 08:40:55');
INSERT INTO `log` VALUES ('336', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?status=success&message=%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&description=%E7%94%A8%E6%88%B7%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&id=1', '2016-12-16 08:43:16');
INSERT INTO `log` VALUES ('337', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?status=success&message=%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&description=%E7%94%A8%E6%88%B7%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&id=1', '2016-12-16 08:43:23');
INSERT INTO `log` VALUES ('338', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?status=success&message=%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&description=%E7%94%A8%E6%88%B7%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&id=1', '2016-12-16 08:43:23');
INSERT INTO `log` VALUES ('339', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?status=success&message=%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&description=%E7%94%A8%E6%88%B7%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&id=1', '2016-12-16 08:43:33');
INSERT INTO `log` VALUES ('340', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?status=success&message=%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&description=%E7%94%A8%E6%88%B7%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&id=1', '2016-12-16 08:44:03');
INSERT INTO `log` VALUES ('341', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Welcome/index.html', '2016-12-16 08:44:21');
INSERT INTO `log` VALUES ('342', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/User/edit.html?status=success&message=%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&description=%E7%94%A8%E6%88%B7%E4%BF%AE%E6%94%B9%E6%88%90%E5%8A%9F&id=1', '2016-12-16 08:44:24');
INSERT INTO `log` VALUES ('343', '访问日志', 'WEB访问日志', '', '192.168.1.109', '/Admin/Cart/lists.html', '2016-12-16 08:44:29');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `line` int(11) NOT NULL COMMENT '路线',
  `uid` int(11) NOT NULL COMMENT '司机id',
  `num` int(11) NOT NULL COMMENT '乘车人数',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '订单状态:0=订单生成,1=已付款,2=已上车,3=已到达,4=已评价,',
  `passenger` varchar(255) NOT NULL COMMENT '乘客信息(姓名:xxx,手机号:xxxxxxxxxxx)',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for session
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `ip` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_visit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of session
-- ----------------------------
INSERT INTO `session` VALUES ('9ou0jkthbsf684r5mn3qnk8q57', 'admin|a:2:{s:4:\"code\";s:5:\"ju7bn\";s:4:\"user\";a:6:{s:2:\"id\";i:1;s:8:\"username\";s:7:\"itxiao6\";s:8:\"password\";s:32:\"a46da1ad6aac4605b22621068816e21c\";s:11:\"permissions\";N;s:10:\"updated_at\";N;s:10:\"created_at\";N;}}', '192.168.1.109', '1481876144');
INSERT INTO `session` VALUES ('sutjsvalgfiusv764a4ss4vn10', 'admin|a:2:{s:4:\"code\";s:5:\"bi522\";s:4:\"user\";a:6:{s:2:\"id\";i:1;s:8:\"username\";s:7:\"itxiao6\";s:8:\"password\";s:32:\"a46da1ad6aac4605b22621068816e21c\";s:11:\"permissions\";N;s:10:\"updated_at\";N;s:10:\"created_at\";N;}}', '192.168.1.109', '1481877869');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(50) DEFAULT NULL COMMENT '用户名',
  `password` varchar(50) DEFAULT NULL COMMENT '用户密码',
  `phone` varchar(11) DEFAULT NULL COMMENT '手机号',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `name` varchar(50) DEFAULT NULL COMMENT '用户名称',
  `truename` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `number` varchar(30) DEFAULT NULL COMMENT '身份证号',
  `money` float DEFAULT '0',
  `license` varchar(255) DEFAULT NULL COMMENT '驾照照片',
  `status` int(11) DEFAULT '2' COMMENT '用户状态:0=司机(未审核),1=司机(已审核)2=司机(已冻结),3=正常用户(乘客),',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `header_url` varchar(255) DEFAULT NULL COMMENT '用户头像',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'itxiao6', 'a46da1ad6aac4605b22621068816e21c', '15538147923', '843161352@qq.com', 'itxiao6', '刘广财', '412723199809253814', null, null, '2', '2016-12-16 08:43:23', null, null);
