/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_tin

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-04-17 15:35:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for web_customer
-- ----------------------------
DROP TABLE IF EXISTS `web_customer`;
CREATE TABLE `web_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(250) DEFAULT NULL COMMENT 'Tên shop, cửa hàng hiển thị',
  `customer_password` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `customer_email` longtext,
  `customer_show_email` tinyint(2) DEFAULT '0' COMMENT '0: không hiển thị email, 1: có hiển thị',
  `customer_gender` tinyint(2) DEFAULT '0' COMMENT '0:nữ:1nam',
  `customer_birthday` varchar(50) DEFAULT NULL,
  `customer_province_id` int(10) DEFAULT NULL COMMENT 'tinh thanh',
  `customer_district_id` int(11) DEFAULT NULL,
  `customer_about` text COMMENT 'gioi thieu shop',
  `customer_status` tinyint(1) DEFAULT '0' COMMENT '0-an, 1-hoat dong, 2-khoa',
  `customer_time_login` int(12) DEFAULT NULL,
  `customer_time_logout` int(12) DEFAULT NULL,
  `customer_time_created` int(12) DEFAULT NULL COMMENT 'Ngày tạo',
  `customer_time_active` int(12) DEFAULT '0' COMMENT 'Ngày active',
  `is_customer` tinyint(1) DEFAULT '0' COMMENT '0-thuong, 1-vip',
  `is_login` tinyint(1) DEFAULT '0' COMMENT '0:not login, 1:login',
  `customer_id_facebook` varchar(255) DEFAULT NULL,
  `customer_id_google` varchar(255) DEFAULT NULL,
  `customer_up_item` int(11) DEFAULT '0' COMMENT 'số lượt dang tin',
  `customer_number_ontop_in_day` int(6) DEFAULT '0' COMMENT 'Số lượng ontop tin trong 1 ngày',
  `customer_number_share` int(12) DEFAULT '0' COMMENT 'lươt share',
  `customer_date_ontop` varchar(50) NOT NULL DEFAULT '0' COMMENT 'Ngày ontop tin đăng',
  `time_start_vip` int(12) DEFAULT NULL COMMENT 'Ngày bắt đầu vip',
  `time_end_vip` int(12) DEFAULT NULL COMMENT 'Ngày hết hạn vip',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_customer
-- ----------------------------
INSERT INTO `web_customer` VALUES ('1', 'Trương Mạnh Quỳnh', '99afcc19f7ced142819fb2d355ff7b63', '0938413368', 'Việt Hưng - Long Biên - Hà Nội', 'manhquynh1984@gmail.com', '0', '0', '', '22', '2', '', '1', '1480063953', '1480069302', '1478594509', '1', '1', '0', null, null, '4', '1', '0', '25-11-2016', '0', '0');
