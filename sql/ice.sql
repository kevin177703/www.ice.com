/*
Navicat MySQL Data Transfer

Source Server         : 43.240.51.2-测试机
Source Server Version : 50537
Source Host           : 43.240.51.2:3306
Source Database       : ice

Target Server Type    : MYSQL
Target Server Version : 50537
File Encoding         : 65001

Date: 2015-05-15 16:05:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `kv_admin`
-- ----------------------------
DROP TABLE IF EXISTS `kv_admin`;
CREATE TABLE `kv_admin` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'uid',
  `username` varchar(32) NOT NULL COMMENT '帐号',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `registertime` int(11) DEFAULT NULL,
  `logintime` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `errorcount` smallint(2) DEFAULT '0' COMMENT '登录错误次数',
  `errortime` int(11) DEFAULT '0' COMMENT '登录错误日期',
  `status` char(1) NOT NULL DEFAULT 'Y' COMMENT '状态,Y启用，N禁用',
  `hide` char(1) NOT NULL DEFAULT 'N' COMMENT '是否已删除，Y已删除，N未删除',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员';

-- ----------------------------
-- Records of kv_admin
-- ----------------------------
INSERT INTO `kv_admin` VALUES ('1', 'admin', '62c8ad0a15d9d1ca38d5dee762a16e01', '1429165876', '1431495817', '0', '0', 'Y', 'N');
INSERT INTO `kv_admin` VALUES ('2', 'kevin', '62c8ad0a15d9d1ca38d5dee762a16e01', '1429165876', '1427348581', '0', '0', 'Y', 'N');

-- ----------------------------
-- Table structure for `kv_admin_menu`
-- ----------------------------
DROP TABLE IF EXISTS `kv_admin_menu`;
CREATE TABLE `kv_admin_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT '菜单名称',
  `url` varchar(100) DEFAULT NULL COMMENT '菜单链接',
  `icon` varchar(50) DEFAULT NULL COMMENT '图标样式',
  `parent_id` int(10) DEFAULT '0' COMMENT '父类id',
  `sort` smallint(4) DEFAULT '0' COMMENT '从大到小',
  `status` char(1) DEFAULT 'Y' COMMENT 'Y启用，N关闭',
  `hide` char(1) DEFAULT 'N' COMMENT '是否已删除，Y已删除，N未删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of kv_admin_menu
-- ----------------------------
INSERT INTO `kv_admin_menu` VALUES ('1', '系统设置', '', 'icon-nav', '0', '20', 'Y', 'N');
INSERT INTO `kv_admin_menu` VALUES ('2', '菜单设置', '/admin/setting-menu.html', 'icon-nav', '1', '99', 'Y', 'N');
INSERT INTO `kv_admin_menu` VALUES ('3', '客户管理', '', 'icon-nav', '0', '99', 'Y', 'N');
INSERT INTO `kv_admin_menu` VALUES ('4', '客户列表', '/admin/users-list.html', 'icon-users', '3', '99', 'Y', 'N');
INSERT INTO `kv_admin_menu` VALUES ('5', '订单管理', '', 'icon-nav', '0', '97', 'Y', 'N');
INSERT INTO `kv_admin_menu` VALUES ('6', '订单列表', '/admin/order-list.html', 'icon-nav', '5', '99', 'Y', 'N');
INSERT INTO `kv_admin_menu` VALUES ('7', '商品管理', '', 'icon-nav', '0', '95', 'Y', 'N');
INSERT INTO `kv_admin_menu` VALUES ('8', '商品列表', '/admin/product-list.html', 'icon-nav', '7', '99', 'Y', 'N');
INSERT INTO `kv_admin_menu` VALUES ('9', '客户留言', '/admin/users-message.html', 'icon-nav', '3', '97', 'Y', 'N');
INSERT INTO `kv_admin_menu` VALUES ('10', '商品类型', '/admin/product-type.html', 'icon-nav', '7', '97', 'Y', 'N');

-- ----------------------------
-- Table structure for `kv_order`
-- ----------------------------
DROP TABLE IF EXISTS `kv_order`;
CREATE TABLE `kv_order` (
  `id` varchar(32) NOT NULL COMMENT '订单编号',
  `product_id` int(11) NOT NULL COMMENT '商品id',
  `product_name` varchar(200) NOT NULL COMMENT '商品名称',
  `user_id` int(11) DEFAULT NULL COMMENT '购买人id',
  `user_name` varchar(32) NOT NULL DEFAULT '游客' COMMENT '购买人帐号',
  `user_email` varchar(100) NOT NULL COMMENT '购买人联系邮件',
  `price` float(10,2) NOT NULL COMMENT '购买物品单价',
  `total` int(10) NOT NULL COMMENT '购买数量',
  `total_price` float(10,2) NOT NULL COMMENT '购买总价',
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1处理中，2确认中，3发货中，4完成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kv_order
-- ----------------------------

-- ----------------------------
-- Table structure for `kv_product`
-- ----------------------------
DROP TABLE IF EXISTS `kv_product`;
CREATE TABLE `kv_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL COMMENT '商品名称',
  `describe` text NOT NULL COMMENT '商品描述',
  `image_big` varchar(200) NOT NULL COMMENT '大缩略图',
  `image_small` varchar(200) NOT NULL COMMENT '小缩略图',
  `price` float(10,2) NOT NULL COMMENT '价格',
  `rebate` float(6,4) NOT NULL COMMENT '折扣 %',
  `stock` int(11) NOT NULL COMMENT '库存',
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1正常，2下架',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of kv_product
-- ----------------------------

-- ----------------------------
-- Table structure for `kv_product_type`
-- ----------------------------
DROP TABLE IF EXISTS `kv_product_type`;
CREATE TABLE `kv_product_type` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '分类名称 ',
  `parent_id` smallint(5) NOT NULL DEFAULT '0' COMMENT '父类id',
  `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序，从大到小',
  `status` char(1) NOT NULL DEFAULT 'Y' COMMENT '状态Y启用，N不启用',
  `hide` char(1) NOT NULL DEFAULT 'N' COMMENT '是否已删除N否,Y已删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kv_product_type
-- ----------------------------
INSERT INTO `kv_product_type` VALUES ('1', 'STIMULATION & EUPHORIA', '0', '99', 'Y', 'N');
INSERT INTO `kv_product_type` VALUES ('2', 'test2', '1', '99', 'Y', 'N');

-- ----------------------------
-- Table structure for `kv_users`
-- ----------------------------
DROP TABLE IF EXISTS `kv_users`;
CREATE TABLE `kv_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '登录帐号',
  `nickname` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL COMMENT '密码',
  `email` varchar(50) DEFAULT NULL COMMENT '电子邮件',
  `registertime` int(11) DEFAULT NULL COMMENT '注册时间',
  `registerip` varchar(20) DEFAULT NULL COMMENT '注册ip',
  `logintime` int(11) DEFAULT NULL COMMENT '登录时间',
  `loginip` varchar(20) DEFAULT NULL COMMENT '登录ip',
  `logincount` int(11) DEFAULT '0' COMMENT '登录次数',
  `status` char(1) NOT NULL DEFAULT 'Y' COMMENT '帐号状态N冻结，Y正常',
  `hide` char(1) NOT NULL DEFAULT 'N' COMMENT '是否已删除，Y已删除，N未删除',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of kv_users
-- ----------------------------
INSERT INTO `kv_users` VALUES ('6', 'kevin1', 'k1', '6d2b6ecb82dda37e2660c1c72956845f', '131233@163.com', '1421566200', '127.0.0.1', '1421566200', null, '0', 'Y', 'N');
INSERT INTO `kv_users` VALUES ('7', 'kevin2', 'k2', '1bb0c90ea5967d9037d6472a5370af23', '132@163.com', '1423721076', null, '1423721076', null, '0', 'Y', 'N');
INSERT INTO `kv_users` VALUES ('8', 'kevin3', 'k3', 'd652b5831cba5961756c51fdec5aec11', '1234@163.com', '1424761732', null, '1424761732', null, '0', 'Y', 'N');

-- ----------------------------
-- Table structure for `kv_users_message`
-- ----------------------------
DROP TABLE IF EXISTS `kv_users_message`;
CREATE TABLE `kv_users_message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT '0' COMMENT '留言客户id',
  `username` varchar(30) DEFAULT '游客' COMMENT '留言人帐号',
  `email` varchar(150) NOT NULL COMMENT 'email',
  `content` text NOT NULL COMMENT '留言内容',
  `addtime` int(11) NOT NULL COMMENT '留言时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kv_users_message
-- ----------------------------
