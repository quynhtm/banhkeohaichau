/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : banhkeohaichau

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-04-06 08:54:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for web_product
-- ----------------------------
DROP TABLE IF EXISTS `web_product`;
CREATE TABLE `web_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_type_price` tinyint(5) DEFAULT '1' COMMENT 'Kiểu hiển thị giá bán: 1:hiển thị giá số, 2: hiển thị giá liên hệ',
  `product_price_sell` int(11) DEFAULT '0' COMMENT 'Giá bán',
  `product_price_market` int(11) DEFAULT '0' COMMENT 'Giá thị trường',
  `product_price_input` int(11) DEFAULT '0' COMMENT 'giá nhập',
  `product_price_provider_sell` int(11) DEFAULT '0' COMMENT 'Giá nhà cung cấp bán',
  `product_is_hot` tinyint(5) DEFAULT '0' COMMENT '0: SP bthuong,1:sản phẩm nổi bật,2:sản phẩm giảm giá....',
  `product_sort_desc` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'mô tả ngắn',
  `product_content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'nội dung sản phẩm',
  `product_selloff` varchar(255) DEFAULT NULL COMMENT 'text thông báo thông tin giảm giá, sp dinh kèm, khuyến mại...',
  `product_image` varchar(255) DEFAULT NULL COMMENT 'ảnh SP chính ',
  `product_image_hover` varchar(255) DEFAULT NULL COMMENT 'ảnh khi hover chuột vào SP',
  `product_image_other` longtext COMMENT 'danh sach ảnh khác',
  `product_order` int(10) DEFAULT '100' COMMENT 'sắp xếp hiển thị sản phẩm ở trang list',
  `provider_id` int(11) DEFAULT '0' COMMENT 'ID nhà cung cấp',
  `depart_id` int(12) DEFAULT '0',
  `category_id` int(11) DEFAULT '0',
  `category_name` varchar(255) DEFAULT NULL,
  `quality_input` int(11) DEFAULT '0' COMMENT 'Số lượng nhập hàng',
  `quality_out` int(11) DEFAULT '0' COMMENT 'Số lượng đã xuất',
  `product_status` tinyint(5) DEFAULT '1' COMMENT '0:ẩn, 1:hiện,',
  `province_id` int(10) DEFAULT '0' COMMENT 'Tỉnh thành ',
  `is_block` tinyint(5) DEFAULT '1' COMMENT '0: bị khóa, 1: không bị khóa',
  `is_shop` tinyint(5) DEFAULT '0' COMMENT '0: sp của shop thường, 1: sản phẩm của shop vip',
  `is_sale` tinyint(2) DEFAULT '1' COMMENT '0: hết hàng: 1 còn hàng',
  `user_id_creater` int(11) DEFAULT '0' COMMENT 'Id user shop',
  `user_name_creater` varchar(255) DEFAULT NULL COMMENT 'Tên shop tạo sản phẩm',
  `time_created` int(11) DEFAULT NULL,
  `user_id_update` int(11) DEFAULT '0',
  `user_name_update` varchar(255) DEFAULT NULL,
  `time_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_product
-- ----------------------------
INSERT INTO `web_product` VALUES ('1', '', 'sản phẩm test', '1', '500000', '600000', '400000', '0', '1', '<p>m&ocirc; tả ngắn</p>\r\n', '<p>th&ocirc;ng tin chi tiết</p>\r\n\r\n<p><img alt=\"sản phẩm test\" src=\"http://localhost/banhkeohaichau/uploads/thumbs/product/1/600x600/1491273324-573cb4258e810763aa000001.jpg\" /></p>\r\n\r\n<p><img alt=\"sản phẩm test\" src=\"http://localhost/banhkeohaichau/uploads/thumbs/product/1/600x600/1491273770-9572042c1a3f27.jpg\" /></p>\r\n', 'thông tin khuyến mại', '1491273324-573cb4258e810763aa000001.jpg', '1491273324-573cb4258e810763aa000001.jpg', 'a:3:{i:0;s:39:\"1491273324-573cb4258e810763aa000001.jpg\";i:1;s:29:\"1491273770-9572042c1a3f27.jpg\";i:2;s:39:\"1491273770-57355c1302b01f7898000001.jpg\";}', '100', '0', '1', '4', 'Hàng đức', '0', '0', '1', '0', '1', '1', '1', '2', 'admin', '1491272625', '2', 'admin', '1491275505');
INSERT INTO `web_product` VALUES ('2', '', 'Sản phẩm 2', '1', '350000', '450000', '300000', '0', '1', '<p>m&ocirc; tả ngắn</p>\r\n', '<p>chi tiết</p>\r\n', '', '1491359509-57355c1302b01f7898000001.jpg', '1491359509-57355c1302b01f7898000001.jpg', 'a:1:{i:0;s:39:\"1491359509-57355c1302b01f7898000001.jpg\";}', '100', '0', '1', '4', 'Hàng đức', '0', '0', '1', '0', '1', '1', '1', '2', 'admin', '1491359509', '2', 'admin', '1491359512');
