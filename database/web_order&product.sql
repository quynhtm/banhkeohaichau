/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : banhkeohaichau

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-04-04 16:34:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for web_order
-- ----------------------------
DROP TABLE IF EXISTS `web_order`;
CREATE TABLE `web_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_customer_name` varchar(255) DEFAULT NULL COMMENT 'Tên khách hàng',
  `order_customer_phone` varchar(255) DEFAULT NULL,
  `order_customer_email` varchar(255) DEFAULT NULL,
  `order_customer_address` varchar(255) DEFAULT NULL,
  `order_customer_note` varchar(255) DEFAULT NULL,
  `order_product_id` varchar(255) DEFAULT NULL COMMENT 'Chuỗi các id sản phẩm: 1,2,3',
  `order_total_money` int(11) DEFAULT '0' COMMENT 'Tổng tiền đơn hàng',
  `order_total_buy` int(11) DEFAULT '0' COMMENT 'số lượng mua',
  `order_money_ship` int(11) DEFAULT '0' COMMENT 'tiền ship',
  `order_is_cod` int(5) DEFAULT '0' COMMENT 'trạng thái vận chuyển: 0:chưa vận chuyển,1:gán cho COD,2:đang chuyển hàng,3:đã giao hàng,4:hoàn trả hàng',
  `order_user_shipper_id` int(11) DEFAULT '0' COMMENT 'Người phụ trách đơn hàng',
  `order_user_shipper_name` varchar(255) DEFAULT NULL,
  `order_user_shop_id` int(11) DEFAULT '0',
  `order_user_shop_name` varchar(255) DEFAULT NULL,
  `order_status` tinyint(5) DEFAULT '1' COMMENT '0:đơn hàng bị xóa1: đơn hàng mới, 2: đơn hàng đã xác nhận, 3:đơn hàng hoàn thành,4: đơn hàng bị hủy',
  `order_type` tinyint(5) DEFAULT '0' COMMENT '0:đơn hàng đặt từ site, 1: dh đặt trong hệ thống bán hàng',
  `order_note` tinytext COMMENT 'note đơn hàng',
  `order_time_pay` int(11) DEFAULT '0' COMMENT 'thời gian thanh toán, hoàn thành',
  `order_time_creater` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_order
-- ----------------------------
INSERT INTO `web_order` VALUES ('11', 'Nguyễn tien huan', '0902868001', 'nguyentienhuanl@gmail.com', '98-108 cmt8, p.7, q.3, hcm', 'Ngay 18/01/2016 ngay nhan hang', '634', '0', '1', '15000', '0', '0', null, '32', 'Công ty CP Gilos', '1', '0', null, '0', '1484617031');
INSERT INTO `web_order` VALUES ('12', 'Nguyễn tien huan', '0902868001', 'nguyentienhuanl@gmail.com', '98-108 cmt8, p.7, q.3, hcm', 'Ngay 18/01/2016 ngay nhan hang', '634', '0', '1', '15000', '0', '0', null, '32', 'Công ty CP Gilos', '1', '0', null, '0', '1484617048');
INSERT INTO `web_order` VALUES ('13', 'Nguyễn thị thu ', '0972179586', '', 'Số nha51 thôn bến Trung, xã Bắc hồng , huyện Đông Anh Hà nội', '', '658', '0', '1', '15000', '0', '0', null, '63', 'Sữa non T470', '1', '0', null, '0', '1485356198');
INSERT INTO `web_order` VALUES ('14', 'Lê Hằng', '0932366081', '', '521 kim mã', 'Giao hàng h hành chính', '802', '0', '8', '15000', '0', '0', null, '74', 'Đồ Gia Dụng ', '1', '0', null, '0', '1486874186');
INSERT INTO `web_order` VALUES ('15', 'Hải Nam', '0913922986', 'nguyenduypt86@gmail.com', '483 Nguyễn Khang Cầu giấy Hà Nội', 'Test đơn nhận mail.', '865', '0', '1', '15000', '0', '0', null, '55', 'Siêu thị gia đình', '1', '0', null, '0', '1487303589');
INSERT INTO `web_order` VALUES ('16', 'Hải Nam', '0913922986', 'nguyenduypt86@gmail.com', '483 Nguyễn Khang Cầu giấy Hà Nội', 'Testing...', '865', '0', '1', '15000', '0', '0', null, '55', 'Siêu thị gia đình', '1', '0', null, '0', '1487304103');

-- ----------------------------
-- Table structure for web_order_item
-- ----------------------------
DROP TABLE IF EXISTS `web_order_item`;
CREATE TABLE `web_order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT '0' COMMENT 'ID đơn hàng',
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price_sell` int(11) DEFAULT NULL,
  `product_price_input` int(11) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  `product_category_name` varchar(255) DEFAULT NULL,
  `product_type_price` tinyint(5) DEFAULT '1' COMMENT 'kiểu hiển thị tiền của SP: 1: hiên thị giá, 2: liên hệ shop',
  `product_province` tinyint(11) DEFAULT NULL COMMENT 'tỉnh thành của sản phẩm',
  `product_provider` int(10) DEFAULT NULL COMMENT 'ID nhà cung cấp',
  `number_buy` int(10) DEFAULT '0' COMMENT 'Số lượng đặt mua',
  PRIMARY KEY (`order_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_order_item
-- ----------------------------
INSERT INTO `web_order_item` VALUES ('2', '11', '718', 'Pharysol điều trị viêm họng viêm thanh quản, amidan dứt điểm', '185000', null, '1474445490-pharysol-moi.png', '196', 'Thực phẩm chức năng', '1', null, null, '1');
INSERT INTO `web_order_item` VALUES ('5', '11', '619', 'Xi nước đánh giày thể thao GoldCare - GC 2006 Sport', '55000', null, '05-30-17-20-06-2016-gc2006-sporttrang-01.jpg', '139', 'Giày dép, túi sách Nam', '1', null, null, '1');
INSERT INTO `web_order_item` VALUES ('6', '11', '634', 'Cây xỏ giày GoldCare - GC7003', '20000', null, '01-45-43-21-06-2016-dsc6901.jpg', '139', 'Giày dép, túi sách Nam', '1', null, null, '2');
INSERT INTO `web_order_item` VALUES ('7', '12', '632', 'Xi nước đánh giày GoldCare - GC 2002', '55000', null, '11-45-07-21-06-2016-gc2002den-1.jpg', '139', 'Giày dép, túi sách Nam', '1', null, null, '3');
INSERT INTO `web_order_item` VALUES ('8', '12', '626', 'Xi sáp đánh giày GoldCare - GC 5003', '39000', null, '10-41-36-21-06-2016-gc-5003.jpg', '119', 'Phụ kiện thời trang Nam', '1', null, null, '1');
INSERT INTO `web_order_item` VALUES ('9', '13', '634', 'Cây xỏ giày GoldCare - GC7003', '20000', null, '01-45-43-21-06-2016-dsc6901.jpg', '139', 'Giày dép, túi sách Nam', '1', null, null, '1');
INSERT INTO `web_order_item` VALUES ('10', '13', '634', 'Cây xỏ giày GoldCare - GC7003', '20000', null, '01-45-43-21-06-2016-dsc6901.jpg', '139', 'Giày dép, túi sách Nam', '1', null, null, '1');
INSERT INTO `web_order_item` VALUES ('11', '13', '634', 'Cây xỏ giày GoldCare - GC7003', '20000', null, '01-45-43-21-06-2016-dsc6901.jpg', '139', 'Giày dép, túi sách Nam', '1', null, null, '2');
INSERT INTO `web_order_item` VALUES ('12', '14', '634', 'Cây xỏ giày GoldCare - GC7003', '20000', null, '01-45-43-21-06-2016-dsc6901.jpg', '139', 'Giày dép, túi sách Nam', '1', null, null, '2');
INSERT INTO `web_order_item` VALUES ('13', '14', '658', 'T470 Pedia 400g', '200000', null, '02-15-32-29-06-2016-125034041210531068957195315420058n.jpg', '174', 'Sữa & Bột', '1', null, null, '2');
INSERT INTO `web_order_item` VALUES ('14', '14', '802', 'HŨ THỦY TINH KOVA-STARLOCK 2.1L', '95000', null, '1476951578-img8770.png', '92', 'Vật dụng nhà bếp', '1', null, null, '2');
INSERT INTO `web_order_item` VALUES ('15', '14', '865', 'SỮA BỘT DEVONDALE FULL CREAM: (Nguyên kem)', '320000', null, '1486827801-image.jpg', '196', 'Thực phẩm chức năng', '1', null, null, '1');
INSERT INTO `web_order_item` VALUES ('16', '14', '865', 'SỮA BỘT DEVONDALE FULL CREAM: (Nguyên kem)', '320000', null, '1486827801-image.jpg', '196', 'Thực phẩm chức năng', '1', null, null, '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_product
-- ----------------------------
INSERT INTO `web_product` VALUES ('1', '', 'sản phẩm test', '1', '500000', '600000', '400000', '0', '1', '<p>m&ocirc; tả ngắn</p>\r\n', '<p>th&ocirc;ng tin chi tiết</p>\r\n\r\n<p><img alt=\"sản phẩm test\" src=\"http://localhost/banhkeohaichau/uploads/thumbs/product/1/600x600/1491273324-573cb4258e810763aa000001.jpg\" /></p>\r\n\r\n<p><img alt=\"sản phẩm test\" src=\"http://localhost/banhkeohaichau/uploads/thumbs/product/1/600x600/1491273770-9572042c1a3f27.jpg\" /></p>\r\n', 'thông tin khuyến mại', '1491273324-573cb4258e810763aa000001.jpg', '1491273324-573cb4258e810763aa000001.jpg', 'a:3:{i:0;s:39:\"1491273324-573cb4258e810763aa000001.jpg\";i:1;s:29:\"1491273770-9572042c1a3f27.jpg\";i:2;s:39:\"1491273770-57355c1302b01f7898000001.jpg\";}', '100', '0', '1', '4', 'Hàng đức', '0', '0', '1', '0', '1', '1', '1', '2', 'admin', '1491272625', '2', 'admin', '1491275505');
