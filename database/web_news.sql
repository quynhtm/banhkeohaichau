/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : banhkeohaichau

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-03-29 16:30:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for web_news
-- ----------------------------
DROP TABLE IF EXISTS `web_news`;
CREATE TABLE `web_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) DEFAULT NULL,
  `news_desc_sort` text,
  `news_content` text,
  `news_image` varchar(255) DEFAULT NULL COMMENT 'ảnh đại diện của bài viết',
  `news_image_other` varchar(255) DEFAULT NULL COMMENT 'Lưu ảnh của bài viết',
  `news_type` tinyint(5) DEFAULT '1' COMMENT 'Kiểu tin',
  `news_category` int(11) DEFAULT NULL,
  `news_status` tinyint(5) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `news_create` int(11) DEFAULT NULL,
  `news_user_create` varchar(255) DEFAULT NULL,
  `news_update` int(11) DEFAULT NULL,
  `news_user_update` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_news
-- ----------------------------
INSERT INTO `web_news` VALUES ('3', 'test thử tin tức', '', '<p>sadasd</p>\r\n', '1490775913-573cb4258e810763aa000001.jpg', 'a:1:{i:0;s:39:\"1490775913-573cb4258e810763aa000001.jpg\";}', '1', '3', '1', '', '', '', '1490775913', null, '1490775918', 'admin');
INSERT INTO `web_news` VALUES ('4', 'bài thứ 2', '', '<p>&aacute;dasd<br />\r\n&nbsp;</p>\r\n', '1490776027-57355c1302b01f7898000001.jpg', 'a:1:{i:0;s:39:\"1490776027-57355c1302b01f7898000001.jpg\";}', '1', '3', '1', '', '', '', '1490776027', null, '1490776031', 'admin');
INSERT INTO `web_news` VALUES ('15', 'thử xem ok chưa', '', '<p>&aacute;dasdasd<br />\r\n&aacute;dasdasd</p>\r\n', '1490779473-1323299717367536732369379167136563154391026n.jpg', 'a:1:{i:0;s:59:\"1490779473-1323299717367536732369379167136563154391026n.jpg\";}', '1', '3', '1', '', '', '', '1490779473', 'admin', '1490779731', 'admin');
