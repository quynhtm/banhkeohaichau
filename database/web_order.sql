/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : banhkeohaichau

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-04-05 10:26:16
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
  `order_status` tinyint(5) DEFAULT '1' COMMENT '1: đơn hàng mới, 2: đơn hàng đã xác nhận, 3:đơn hàng hoàn thành,4: đơn hàng bị hủy',
  `order_type` tinyint(5) DEFAULT '0' COMMENT '0:đơn hàng đặt từ site, 1: dh đặt trong hệ thống bán hàng',
  `order_note` tinytext COMMENT 'note đơn hàng',
  `order_time_pay` int(11) DEFAULT '0' COMMENT 'thời gian thanh toán, hoàn thành',
  `order_time_creater` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_order
-- ----------------------------
INSERT INTO `web_order` VALUES ('11', 'Nguyễn tien huan', '0902868001', 'nguyentienhuanl@gmail.com', '98-108 cmt8, p.7, q.3, hcm', 'Ngay 18/01/2016 ngay nhan hang', '634', '0', '1', '15000', '0', '0', null, '32', 'Công ty CP Gilos', '1', '1', null, '0', '1484617031');
INSERT INTO `web_order` VALUES ('12', 'Nguyễn tien huan', '0902868001', 'nguyentienhuanl@gmail.com', '98-108 cmt8, p.7, q.3, hcm', 'Ngay 18/01/2016 ngay nhan hang', '634', '0', '1', '15000', '1', '0', null, '32', 'Công ty CP Gilos', '2', '1', null, '0', '1484617048');
INSERT INTO `web_order` VALUES ('13', 'Nguyễn thị thu ', '0972179586', '', 'Số nha51 thôn bến Trung, xã Bắc hồng , huyện Đông Anh Hà nội', '', '658', '0', '1', '15000', '2', '0', null, '63', 'Sữa non T470', '3', '0', null, '0', '1485356198');
INSERT INTO `web_order` VALUES ('14', 'Lê Hằng', '0932366081', '', '521 kim mã', 'Giao hàng h hành chính', '802', '0', '8', '15000', '3', '0', null, '74', 'Đồ Gia Dụng ', '4', '0', null, '0', '1486874186');
INSERT INTO `web_order` VALUES ('15', 'Hải Nam', '0913922986', 'nguyenduypt86@gmail.com', '483 Nguyễn Khang Cầu giấy Hà Nội', 'Test đơn nhận mail.', '865', '0', '1', '15000', '4', '0', null, '55', 'Siêu thị gia đình', '1', '0', null, '0', '1487303589');
INSERT INTO `web_order` VALUES ('16', 'Hải Nam', '0913922986', 'nguyenduypt86@gmail.com', '483 Nguyễn Khang Cầu giấy Hà Nội', 'Testing...', '865', '0', '1', '15000', '0', '0', null, '55', 'Siêu thị gia đình', '1', '0', null, '0', '1487304103');
