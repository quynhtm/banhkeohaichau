/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : banhkeohaichau

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2017-04-10 21:54:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for group_user
-- ----------------------------
DROP TABLE IF EXISTS `group_user`;
CREATE TABLE `group_user` (
  `group_user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id nhom nguoi dung',
  `group_user_name` varchar(50) NOT NULL COMMENT 'Ten nhom nguoi dung',
  `group_user_status` int(1) NOT NULL DEFAULT '1' COMMENT '1 : hiá»‡n , 0 : áº©n',
  `group_user_type` int(1) NOT NULL DEFAULT '1' COMMENT '1:admin;2:shop',
  PRIMARY KEY (`group_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group_user
-- ----------------------------
INSERT INTO `group_user` VALUES ('1', 'Quyền Boss', '1', '1');
INSERT INTO `group_user` VALUES ('2', 'Root', '1', '1');
INSERT INTO `group_user` VALUES ('3', 'Quyền Admin site', '1', '1');
INSERT INTO `group_user` VALUES ('4', 'Quyền quản lý bài viết', '1', '1');

-- ----------------------------
-- Table structure for group_user_permission
-- ----------------------------
DROP TABLE IF EXISTS `group_user_permission`;
CREATE TABLE `group_user_permission` (
  `group_user_id` int(11) NOT NULL COMMENT 'id nhÃ³m',
  `permission_id` int(11) NOT NULL COMMENT 'id quyÃ¨n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group_user_permission
-- ----------------------------
INSERT INTO `group_user_permission` VALUES ('2', '2');
INSERT INTO `group_user_permission` VALUES ('1', '1');
INSERT INTO `group_user_permission` VALUES ('3', '2');
INSERT INTO `group_user_permission` VALUES ('4', '13');
INSERT INTO `group_user_permission` VALUES ('4', '14');
INSERT INTO `group_user_permission` VALUES ('4', '18');
INSERT INTO `group_user_permission` VALUES ('4', '19');
INSERT INTO `group_user_permission` VALUES ('4', '28');
INSERT INTO `group_user_permission` VALUES ('4', '29');

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_code` varchar(50) NOT NULL COMMENT 'MÃ£ quyá»n',
  `permission_name` varchar(50) NOT NULL COMMENT 'TÃªn quyá»n',
  `permission_status` int(1) NOT NULL DEFAULT '1' COMMENT '1:hiá»‡n , 0:áº©n',
  `permission_group_name` varchar(255) DEFAULT NULL COMMENT 'group ten controller',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES ('1', 'is_boss', 'Boss', '1', 'Boss');
INSERT INTO `permission` VALUES ('2', 'root', 'Quản trị Site', '1', 'Quản trị Site');
INSERT INTO `permission` VALUES ('3', 'user_create', 'Tạo user Admin', '1', 'Tài khoản Admin');
INSERT INTO `permission` VALUES ('4', 'user_edit', 'Sửa user Admin', '1', 'Tài khoản Admin');
INSERT INTO `permission` VALUES ('5', 'user_change_pass', 'Thay đổi user Admin', '1', 'Tài khoản Admin');
INSERT INTO `permission` VALUES ('6', 'user_remove', 'Xóa user Admin', '1', 'Tài khoản Admin');
INSERT INTO `permission` VALUES ('7', 'group_user_view', 'Xem nhóm quyền', '1', 'Nhóm quyền');
INSERT INTO `permission` VALUES ('8', 'group_user_create', 'Tạo nhóm quyền', '1', 'Nhóm quyền');
INSERT INTO `permission` VALUES ('9', 'group_user_edit', 'Sửa nhóm quyền', '1', 'Nhóm quyền');
INSERT INTO `permission` VALUES ('10', 'permission_full', 'Full tạo quyền', '1', 'Tạo quyền');
INSERT INTO `permission` VALUES ('11', 'permission_create', 'Tạo tạo quyền', '1', 'Tạo quyền');
INSERT INTO `permission` VALUES ('12', 'permission_edit', 'Sửa tạo quyền', '1', 'Tạo quyền');
INSERT INTO `permission` VALUES ('13', 'banner_full', 'Full quảng cáo', '1', 'Quyền quảng cáo');
INSERT INTO `permission` VALUES ('14', 'banner_view', 'Xem quảng cáo', '1', 'Quyền quảng cáo');
INSERT INTO `permission` VALUES ('15', 'banner_delete', 'Xóa quảng cáo', '1', 'Quyền quảng cáo');
INSERT INTO `permission` VALUES ('16', 'banner_create', 'Tạo quảng cáo', '1', 'Quyền quảng cáo');
INSERT INTO `permission` VALUES ('17', 'banner_edit', 'Sửa quảng cáo', '1', 'Quyền quảng cáo');
INSERT INTO `permission` VALUES ('18', 'category_full', 'Full danh mục', '1', 'Quyền danh mục');
INSERT INTO `permission` VALUES ('19', 'category_view', 'Xem danh mục', '1', 'Quyền danh mục');
INSERT INTO `permission` VALUES ('20', 'category_delete', 'Xóa danh mục', '1', 'Quyền danh mục');
INSERT INTO `permission` VALUES ('21', 'category_create', 'Tạo danh mục', '1', 'Quyền danh mục');
INSERT INTO `permission` VALUES ('22', 'category_edit', 'Sửa danh mục', '1', 'Quyền danh mục');
INSERT INTO `permission` VALUES ('23', 'items_full', 'Full tin rao', '1', 'Quyền tin rao');
INSERT INTO `permission` VALUES ('24', 'items_view', 'Xem tin rao', '1', 'Quyền tin rao');
INSERT INTO `permission` VALUES ('25', 'items_delete', 'Xóa tin rao', '1', 'Quyền tin rao');
INSERT INTO `permission` VALUES ('26', 'items_create', 'Tạo tin rao', '1', 'Quyền tin rao');
INSERT INTO `permission` VALUES ('27', 'items_edit', 'Sửa tin rao', '1', 'Quyền tin rao');
INSERT INTO `permission` VALUES ('28', 'news_full', 'Full tin tức', '1', 'Quyền tin tức');
INSERT INTO `permission` VALUES ('29', 'news_view', 'Xem tin tức', '1', 'Quyền tin tức');
INSERT INTO `permission` VALUES ('30', 'news_delete', 'Xóa tin tức', '1', 'Quyền tin tức');
INSERT INTO `permission` VALUES ('31', 'news_create', 'Tạo tin tức', '1', 'Quyền tin tức');
INSERT INTO `permission` VALUES ('32', 'news_edit', 'Sửa tin tức', '1', 'Quyền tin tức');
INSERT INTO `permission` VALUES ('33', 'province_full', 'Full tỉnh thành', '1', 'Quyền tỉnh thành');
INSERT INTO `permission` VALUES ('34', 'province_view', 'Xem tỉnh thành', '1', 'Quyền tỉnh thành');
INSERT INTO `permission` VALUES ('35', 'province_delete', 'Xóa tỉnh thành', '1', 'Quyền tỉnh thành');
INSERT INTO `permission` VALUES ('36', 'province_create', 'Tạo tỉnh thành', '1', 'Quyền tỉnh thành');
INSERT INTO `permission` VALUES ('37', 'province_edit', 'Sửa tỉnh thành', '1', 'Quyền tỉnh thành');
INSERT INTO `permission` VALUES ('38', 'user_customer_full', 'Full khách hàng', '1', 'Quyền khách hàng');
INSERT INTO `permission` VALUES ('39', 'user_customer_view', 'Xem khách hàng', '1', 'Quyền khách hàng');
INSERT INTO `permission` VALUES ('40', 'user_customer_delete', 'Xóa khách hàng', '1', 'Quyền khách hàng');
INSERT INTO `permission` VALUES ('41', 'user_customer_create', 'Tạo khách hàng', '1', 'Quyền khách hàng');
INSERT INTO `permission` VALUES ('42', 'user_customer_edit', 'Sửa khách hàng', '1', 'Quyền khách hàng');
INSERT INTO `permission` VALUES ('43', 'toolsCommon_full', 'Full quyền', '1', 'Full quyền Share link');
INSERT INTO `permission` VALUES ('45', 'user_view', 'Xem danh sách user Admin', '1', 'Tài khoản Admin');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_full_name` varchar(255) NOT NULL,
  `user_sex` tinyint(5) DEFAULT '0' COMMENT '0: nữ: 1 nam',
  `user_email` varchar(255) DEFAULT NULL,
  `user_phone` varchar(11) DEFAULT NULL,
  `user_service` varchar(255) DEFAULT NULL COMMENT 'Chức vụ',
  `user_time_work_start` int(11) DEFAULT '0' COMMENT 'Thời gian bắt đầu làm việc',
  `user_time_work_end` int(11) DEFAULT NULL COMMENT 'Thời gian nghỉ',
  `user_group_depart` varchar(200) DEFAULT NULL COMMENT 'Thuộc nhóm khoa: 1,2,3..',
  `user_status` int(2) NOT NULL DEFAULT '1' COMMENT '-1: xÃ³a , 1: active',
  `user_group` varchar(255) DEFAULT NULL,
  `user_last_login` int(11) DEFAULT NULL,
  `user_last_ip` varchar(15) DEFAULT NULL,
  `user_create_id` int(11) DEFAULT NULL,
  `user_create_name` varchar(255) DEFAULT NULL,
  `user_edit_id` int(11) DEFAULT NULL,
  `user_edit_name` varchar(255) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', 'admin', 'eef828faf0754495136af05c051766cb', 'Admin', '0', '', '', '', '0', '0', '', '1', '1,2', '1491827955', '127.0.0.1', null, null, null, null, null, null);
INSERT INTO `user` VALUES ('19', 'tech_code', '273704d8aff01015b6bdd001f5e73463', 'Tech code 3555', '0', '', '', '', '0', '0', '', '1', '2', '1487301492', '::1', null, null, '2', 'admin', null, '1481772561');
INSERT INTO `user` VALUES ('20', 'svquynhtm', 'fa268d7af7410dbf1b860075e9074889', 'Trương Mạnh Quỳnh', '1', 'manhquynh1984@gmail.com', '0938413368', 'Cộng tác viên', '1483203600', '1484240400', '1,6,7,8,9', '1', '3', '1482826054', '::1', '2', 'admin', '2', 'admin', '1482823830', '1482824272');
INSERT INTO `user` VALUES ('22', 'congtacvien', 'b899cec2f6ecfaf912ff013647d0a9e8', 'Cộng tác viên', '0', '', '', '', '0', '0', '1,7', '1', '4', '1487306266', '::1', null, null, null, null, null, null);

-- ----------------------------
-- Table structure for web_banner
-- ----------------------------
DROP TABLE IF EXISTS `web_banner`;
CREATE TABLE `web_banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `banner_image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `banner_image_temp` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Lưu image lỗi để sau xóa',
  `banner_link` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `banner_order` tinyint(5) DEFAULT '1' COMMENT 'thứ tự hiển thị',
  `banner_total_click` int(11) DEFAULT '0' COMMENT 'lượt click banner theo id',
  `banner_time_click` int(11) DEFAULT '0' COMMENT 'Time click gần nhất',
  `banner_is_target` tinyint(5) DEFAULT '0' COMMENT '0: Không mở tab mới, 1: mở tab mới',
  `banner_is_rel` tinyint(5) DEFAULT '0' COMMENT '0:nofollow, 1:follow',
  `banner_type` tinyint(5) DEFAULT '0' COMMENT '1:banner home to, 2: banner home nhỏ,3: banner trái, 4 banner phải',
  `banner_page` tinyint(5) DEFAULT '0' COMMENT '1: trang chủ, 2: trang list,3: trang detail, 4: trang list danh mục',
  `banner_category_id` int(11) DEFAULT '0',
  `banner_status` tinyint(5) DEFAULT '0',
  `banner_is_run_time` tinyint(5) DEFAULT '0' COMMENT '0: không có time chay,1: có thời gian chạy quảng cáo',
  `banner_start_time` int(11) DEFAULT '0',
  `banner_end_time` int(11) DEFAULT '0',
  `banner_is_shop` tinyint(5) DEFAULT '0' COMMENT '0: Không phải banner shop,1: quảng cáo banner của shop',
  `banner_shop_id` int(11) DEFAULT '0',
  `banner_create_time` int(11) DEFAULT '0',
  `banner_update_time` int(11) DEFAULT '0',
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_banner
-- ----------------------------
INSERT INTO `web_banner` VALUES ('17', 'Slider trang chủ 2', '1473695454-2.jpg', null, 'http://shopcuatui.com.vn/shop-70/Thoi-trang-tre-dep.html', '2', '0', '0', '1', '1', '1', '1', '0', '1', '0', '0', '0', '0', '0', '1473695454', '0');
INSERT INTO `web_banner` VALUES ('18', 'Slider trang chủ 3', '1473695513-3.jpg', null, 'http://shopcuatui.com.vn/shop-70/Thoi-trang-tre-dep.html', '3', '0', '0', '1', '1', '1', '1', '0', '1', '0', '0', '0', '0', '0', '1473695513', '0');
INSERT INTO `web_banner` VALUES ('19', 'Rao vặt nhanh hàng ngày', '1482385548-baner.png', null, 'http://raovat30s.vn?url_source=c2hvcGN1YXR1aS5jb20udm4=', '1', '0', '0', '1', '1', '6', '1', '0', '1', '0', '0', '0', '0', '0', '1473697809', '0');
INSERT INTO `web_banner` VALUES ('22', 'Banner nhỏ cạnh slider 4', '1473698980-44.jpg', null, 'http://shopcuatui.com.vn', '1', '0', '0', '1', '0', '7', '1', '0', '1', '0', '0', '0', '0', '0', '1473698529', '0');
INSERT INTO `web_banner` VALUES ('26', 'Banner shop slider 2', '1474513639-1474439819-girls-shopping.png', null, 'http://shopcuatui.com.vn', '2', '0', '0', '1', '0', '1', '1', '0', '1', '1', '1474416000', '1483056000', '1', '55', '1473795982', '0');
INSERT INTO `web_banner` VALUES ('27', 'Banner shop slider 3', '1474514102-bannerthoitrang.jpg', null, 'http://shopcuatui.com.vn', '3', '0', '0', '1', '0', '1', '1', '0', '1', '1', '1474416000', '1483056000', '1', '55', '1473796252', '0');
INSERT INTO `web_banner` VALUES ('29', 'Thời trang trẻ đẹp', '1474513192-1474470654-p.txt.jpg', null, 'http://shopcuatui.com.vn/shop-70/c-127/giay-dep-tui-xach-nu.html', '1', '0', '0', '1', '0', '1', '2', '0', '1', '1', '1474070400', '1483056000', '1', '70', '1474169867', '0');
INSERT INTO `web_banner` VALUES ('30', 'Giầy nam', '1474513404-banner-thoi-trangphukien.png', null, 'http://shopcuatui.com.vn/shop-70/c-127/giay-dep-tui-xach-nu.html', '0', '0', '0', '1', '0', '1', '2', '0', '1', '1', '1474243200', '1483056000', '1', '70', '1474253522', '0');
INSERT INTO `web_banner` VALUES ('31', 'Thời trang', '1475043581-productbanner.png.jpg', null, 'http://shopcuatui.com.vn/shop-70/Thoi-trang-tre-dep.html', '0', '0', '0', '1', '0', '1', '1', '0', '1', '1', '1474218000', '1483030800', '1', '70', '1474253553', '0');
INSERT INTO `web_banner` VALUES ('32', 'shop', '1475043024-bannerchuy1311711392104172.jpg', null, 'http://shopcuatui.com.vn/shop-70/Thoi-trang-tre-dep.html', '0', '0', '0', '1', '0', '1', '2', '0', '1', '1', '1474390800', '1483030800', '1', '70', '1474474281', '0');
INSERT INTO `web_banner` VALUES ('33', 'đồng hồ', '1475135909-2.jpg', null, 'http://shopcuatui.com.vn/shop-70/c-119/phu-kien-thoi-trang-nam.html', '0', '0', '0', '1', '0', '1', '1', '0', '1', '1', '1474995600', '1506704400', '1', '70', '1475042566', '0');
INSERT INTO `web_banner` VALUES ('34', 'túi mới', '1475136377-1475043178-banner01.jpg', null, 'http://shopcuatui.com.vn/shop-70/Phu-kien-thoi-trang.html', '0', '0', '0', '1', '0', '1', '1', '0', '1', '1', '1474995600', '1506704400', '1', '70', '1475043129', '0');
INSERT INTO `web_banner` VALUES ('35', 'Linh chi Nhật An', '1481523736-leftbaner.png', null, 'http://www.namdalat.com/index.php?route=product/product&product_id=75', '2', '0', '0', '1', '0', '3', '2', '0', '1', '0', '0', '0', '0', '0', '1481523718', '0');
INSERT INTO `web_banner` VALUES ('36', 'Rao vặt 30s', '1482385640-bannerto.png', null, 'http://raovat30s.vn?url_source=c2hvcGN1YXR1aS5jb20udm4=', '1', '0', '0', '1', '0', '3', '2', '0', '1', '0', '0', '0', '0', '0', '1482385640', '0');

-- ----------------------------
-- Table structure for web_category
-- ----------------------------
DROP TABLE IF EXISTS `web_category`;
CREATE TABLE `web_category` (
  `category_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `category_depart_id` int(12) DEFAULT NULL,
  `category_type` tinyint(2) DEFAULT '0' COMMENT 'loại danh mục',
  `category_level` tinyint(2) DEFAULT '1' COMMENT 'cấp danh mục',
  `category_image_background` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_icons` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_status` tinyint(1) DEFAULT '0',
  `category_menu_status` tinyint(1) DEFAULT '0',
  `category_menu_right` tinyint(1) DEFAULT NULL,
  `category_order` tinyint(5) DEFAULT '0',
  PRIMARY KEY (`category_id`),
  KEY `status` (`category_status`) USING BTREE,
  KEY `id_parrent` (`category_parent_id`,`category_status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of web_category
-- ----------------------------
INSERT INTO `web_category` VALUES ('1', 'Kẹo chew', '0', '2', '5', '1', null, null, '1', '0', null, '1');
INSERT INTO `web_category` VALUES ('2', 'Lương khô', '0', '3', '5', '1', null, null, '1', '0', null, '2');
INSERT INTO `web_category` VALUES ('4', 'Lương khô 65g', '2', '3', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('5', 'Giới thiệu', '0', '0', '6', '1', null, null, '1', '1', null, '1');
INSERT INTO `web_category` VALUES ('6', 'Bánh lương khô Omega 420g', '2', '3', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('7', 'Lương khô rong biển 70gr', '2', '3', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('8', 'Lương khô 5+', '2', '3', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('9', 'Bánh Omega 420gr', '2', '3', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('10', 'Kẹo Chew 100', '1', '1', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('11', 'Kẹo xoắn 260g', '1', '1', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('12', 'Kẹo gối 260g', '1', '1', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('13', 'Kẹo chew cốm', '1', '1', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('14', 'Kẹo Chew sữa', '1', '1', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('15', 'Kẹo mềm sữa 255g', '1', '1', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('16', 'Kẹo mềm cà phê 255g', '1', '1', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('17', 'Hạt nêm - Bột Canh ', '0', '4', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('18', 'Bột Hải Châu', '17', '4', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('19', 'Bột canh Ngon', '17', '4', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('20', 'Hạt nêm Jito thịt 170g’', '17', '4', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('21', 'Hạt nêm Jito gà 170g', '17', '4', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('22', 'Hạt nêm Jito 800g', '17', '4', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('23', 'Mứt Tết', '0', '6', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('24', 'Mứt Gừng 130gr', '23', '6', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('25', 'Mứt Tết bát giác 220gr', '23', '6', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('26', 'Mứt Tết hộp Lục giác 250gr', '23', '6', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('27', 'Mứt Tết hộp nhựa 300gr', '23', '6', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('28', 'Mứt Tết hộp bát giác 300gr', '23', '6', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('29', 'Mứt Tết thập cẩm ĐB 420gr', '23', '6', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('30', 'Bánh trứng nướng PiSô', '23', '6', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('31', 'Bánh trứng nướng piso ( 10 g)', '23', '6', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('32', 'Bánh trứng Nướng Phomai', '23', '6', '5', '1', null, null, '1', '0', null, '0');
INSERT INTO `web_category` VALUES ('33', 'Tin tức', '0', '0', '6', '1', null, null, '1', '1', null, '2');
INSERT INTO `web_category` VALUES ('34', 'Đại lý', '0', '0', '6', '1', null, null, '1', '1', null, '3');
INSERT INTO `web_category` VALUES ('35', 'Khuyến mại', '0', '0', '6', '1', null, null, '1', '1', null, '4');
INSERT INTO `web_category` VALUES ('36', 'Bảng giá', '0', '0', '6', '1', null, null, '1', '1', null, '5');
INSERT INTO `web_category` VALUES ('38', 'Tuyển dụng', '0', '0', '6', '1', null, null, '1', '1', null, '7');
INSERT INTO `web_category` VALUES ('39', 'Bánh Quy', '0', '1', '5', '1', null, null, '1', '0', null, '1');
INSERT INTO `web_category` VALUES ('40', 'Hương cam 130', '39', '1', '5', '1', null, null, '1', '0', null, '1');
INSERT INTO `web_category` VALUES ('41', 'Hương thảo 225', '39', '1', '5', '1', null, null, '1', '0', null, '2');
INSERT INTO `web_category` VALUES ('42', 'Quy kem 96gr', '39', '1', '5', '1', null, null, '1', '0', null, '3');
INSERT INTO `web_category` VALUES ('43', 'Bánh quy sesame 205g', '39', '1', '5', '1', null, null, '1', '0', null, '4');
INSERT INTO `web_category` VALUES ('44', 'Bánh quy Bictony 120g', '39', '1', '5', '1', null, null, '1', '0', null, '5');
INSERT INTO `web_category` VALUES ('45', 'Bánh quy Maryo 88g', '39', '1', '5', '1', null, null, '1', '0', null, '6');
INSERT INTO `web_category` VALUES ('46', 'Vani 300', '39', '1', '5', '1', null, null, '1', '0', null, '7');
INSERT INTO `web_category` VALUES ('47', 'Quy + 110g', '39', '1', '5', '1', null, null, '1', '0', null, '8');
INSERT INTO `web_category` VALUES ('48', 'Bánh Quy Hộp', '0', '1', '5', '1', null, null, '1', '0', null, '2');
INSERT INTO `web_category` VALUES ('49', 'Fance 405g', '48', '1', '5', '1', null, null, '1', '0', null, '1');
INSERT INTO `web_category` VALUES ('50', 'Uropi 305g', '48', '1', '5', '1', null, null, '1', '0', null, '2');
INSERT INTO `web_category` VALUES ('51', 'Qui nếp 200', '48', '1', '5', '1', null, null, '1', '0', null, '3');
INSERT INTO `web_category` VALUES ('52', 'Korolas 295g', '48', '1', '5', '1', null, null, '1', '0', null, '4');
INSERT INTO `web_category` VALUES ('53', 'Vani 270g', '48', '1', '5', '1', null, null, '1', '0', null, '5');
INSERT INTO `web_category` VALUES ('54', 'Bánh Orio 240gr', '48', '1', '5', '1', null, null, '1', '0', null, '6');
INSERT INTO `web_category` VALUES ('55', 'Bánh hộp Antiqes 415g', '48', '1', '5', '1', null, null, '1', '0', null, '7');
INSERT INTO `web_category` VALUES ('56', 'Bánh hộp Antiqes 450g', '48', '1', '5', '1', null, null, '1', '0', null, '8');
INSERT INTO `web_category` VALUES ('57', 'Bánh quy bơ Roal 300g', '48', '1', '5', '1', null, null, '1', '0', null, '9');
INSERT INTO `web_category` VALUES ('58', 'Bánh quy vừng GOLD 340g', '48', '1', '5', '1', null, null, '1', '0', null, '10');
INSERT INTO `web_category` VALUES ('59', 'Bánh quy bơ Famlys 260gr', '48', '1', '5', '1', null, null, '1', '0', null, '11');
INSERT INTO `web_category` VALUES ('60', 'Bánh quy bơ Famlys 320gr', '48', '1', '5', '1', null, null, '1', '0', null, '12');
INSERT INTO `web_category` VALUES ('61', 'Bánh quy Forever 360g', '48', '1', '5', '1', null, null, '1', '0', null, '13');
INSERT INTO `web_category` VALUES ('62', 'Bánh quy FC A+ 320g', '48', '1', '5', '1', null, null, '1', '0', null, '14');
INSERT INTO `web_category` VALUES ('63', 'Bánh quy kem hộp 255', '48', '1', '5', '1', null, null, '1', '0', null, '15');
INSERT INTO `web_category` VALUES ('64', 'Bánh kem xốp', '0', '1', '5', '1', null, null, '1', '0', null, '3');
INSERT INTO `web_category` VALUES ('65', 'Kem xốp 90', '64', '1', '5', '1', null, null, '1', '0', null, '1');
INSERT INTO `web_category` VALUES ('66', 'Kem xốp 300', '64', '1', '5', '1', null, null, '1', '0', null, '2');
INSERT INTO `web_category` VALUES ('67', 'Kem xốp 310', '64', '1', '5', '1', null, null, '1', '0', null, '3');
INSERT INTO `web_category` VALUES ('68', 'Kem xốp gấc 285g', '64', '1', '5', '1', null, null, '1', '0', null, '4');
INSERT INTO `web_category` VALUES ('69', 'Kem xốp trà xanh 135g', '64', '1', '5', '1', null, null, '1', '0', null, '5');
INSERT INTO `web_category` VALUES ('70', 'Kem xốp trà xanh 98gr', '64', '1', '5', '1', null, null, '1', '0', null, '6');
INSERT INTO `web_category` VALUES ('71', 'Kem xốp dừa gấc 98gr', '64', '1', '5', '1', null, null, '1', '0', null, '7');
INSERT INTO `web_category` VALUES ('72', 'Kem xốp colamik 240g', '64', '1', '5', '1', null, null, '1', '0', null, '8');
INSERT INTO `web_category` VALUES ('73', 'Kem xốp socola 170gr', '64', '1', '5', '1', null, null, '1', '0', null, '9');
INSERT INTO `web_category` VALUES ('74', 'Kem xốp 260g', '64', '1', '5', '1', null, null, '1', '0', null, '10');
INSERT INTO `web_category` VALUES ('75', 'Kem xốp socola 280', '64', '1', '5', '1', null, null, '1', '0', null, '11');
INSERT INTO `web_category` VALUES ('76', 'Xốp sữa 170', '64', '1', '5', '1', null, null, '1', '0', null, '12');
INSERT INTO `web_category` VALUES ('77', 'Kem xốp kobe 205', '64', '1', '5', '1', null, null, '1', '0', null, '13');
INSERT INTO `web_category` VALUES ('78', 'Kem xốp giấy bạc 230', '64', '1', '5', '1', null, null, '1', '0', null, '14');
INSERT INTO `web_category` VALUES ('79', 'Bánh kem xốp hộp', '0', '1', '5', '1', null, null, '1', '0', null, '4');
INSERT INTO `web_category` VALUES ('80', 'Bánh mềm', '0', '1', '5', '1', null, null, '1', '0', null, '5');
INSERT INTO `web_category` VALUES ('81', 'Bánh cookie', '0', '1', '5', '1', null, null, '1', '0', null, '5');
INSERT INTO `web_category` VALUES ('82', 'Kẹo hộp', '0', '2', '5', '1', null, null, '1', '0', null, '6');
INSERT INTO `web_category` VALUES ('83', 'Kẹo cứng', '0', '2', '5', '1', null, null, '1', '0', null, '7');
INSERT INTO `web_category` VALUES ('84', 'Kem xốp hộp 405g', '79', '1', '5', '1', null, null, '1', '0', null, '1');
INSERT INTO `web_category` VALUES ('85', 'Kem xốp hộp 295g', '79', '1', '5', '1', null, null, '1', '0', null, '2');
INSERT INTO `web_category` VALUES ('86', 'Kem xốp phủ SCL Anper 255g', '79', '1', '5', '1', null, null, '1', '0', null, '3');
INSERT INTO `web_category` VALUES ('87', 'Bánh kem xốp Pari 320g', '79', '1', '5', '1', null, null, '1', '0', null, '4');
INSERT INTO `web_category` VALUES ('88', 'Bánh kem xốp 3 in 1 265g', '79', '1', '5', '1', null, null, '1', '0', null, '4');
INSERT INTO `web_category` VALUES ('89', 'Bánh asea stlye 306g', '79', '1', '5', '1', null, null, '1', '0', null, '6');
INSERT INTO `web_category` VALUES ('90', 'Bánh kem xốp bela 310g', '79', '1', '5', '1', null, null, '1', '0', null, '7');
INSERT INTO `web_category` VALUES ('91', 'Kem xốp KX 190g', '79', '1', '5', '1', null, null, '1', '0', null, '8');
INSERT INTO `web_category` VALUES ('92', 'Bánh kem xốp varicty 355g', '79', '1', '5', '1', null, null, '1', '0', null, '9');
INSERT INTO `web_category` VALUES ('93', 'Bánh kem xốp Koji hộp 465g', '79', '1', '5', '1', null, null, '1', '0', null, '10');
INSERT INTO `web_category` VALUES ('94', 'Bánh kem xốp Apples hộp 315g', '79', '1', '5', '1', null, null, '1', '0', null, '10');
INSERT INTO `web_category` VALUES ('95', 'Bánh kem xốp hộp XP 320g', '79', '1', '5', '1', null, null, '1', '0', null, '11');
INSERT INTO `web_category` VALUES ('96', 'Bánh kem xốp hộp XP 306g', '79', '1', '5', '1', null, null, '1', '0', null, '12');
INSERT INTO `web_category` VALUES ('97', 'Kem Xop Phuc Loc Tho', '79', '1', '5', '1', null, null, '1', '0', null, '12');
INSERT INTO `web_category` VALUES ('98', 'Bánh Euro style 775g', '79', '1', '5', '1', null, null, '1', '0', null, '12');
INSERT INTO `web_category` VALUES ('99', 'Kem xốp hoàng gia 52gr', '79', '1', '5', '1', null, null, '1', '0', null, '13');
INSERT INTO `web_category` VALUES ('100', 'Kem xốp colamik hộp 270g', '79', '1', '5', '1', null, null, '1', '0', null, '14');
INSERT INTO `web_category` VALUES ('101', 'Bánh kem xốp caste 340g', '79', '1', '5', '1', null, null, '1', '0', null, '15');
INSERT INTO `web_category` VALUES ('102', 'Kem  xốp hôp 60g', '79', '1', '5', '1', null, null, '1', '0', null, '16');
INSERT INTO `web_category` VALUES ('103', 'Kem xốp hộp classic 272gr', '79', '1', '5', '1', null, null, '1', '0', null, '17');
INSERT INTO `web_category` VALUES ('104', 'Bánh Kem xốp Hộp Martin 336gr', '79', '1', '5', '1', null, null, '1', '0', null, '18');
INSERT INTO `web_category` VALUES ('105', 'Kem xốp KX + 280g', '79', '1', '5', '1', null, null, '1', '0', null, '22');
INSERT INTO `web_category` VALUES ('106', 'Tin tức hoạt động của Công ty Bánh kẹo Hải Châu', '33', '0', '6', '1', null, null, '1', '1', null, '1');
INSERT INTO `web_category` VALUES ('107', 'Tin tức hoạt động của các chinh nhánh của Công ty', '33', '0', '6', '1', null, null, '1', '1', null, '2');
INSERT INTO `web_category` VALUES ('108', 'Giới thiệu chung', '5', '0', '6', '1', null, null, '1', '1', null, '1');
INSERT INTO `web_category` VALUES ('109', 'Hệ thống tổ chức', '5', '0', '6', '1', null, null, '1', '1', null, '2');
INSERT INTO `web_category` VALUES ('110', 'Thông điệp của Tổng Giám Đốc', '5', '0', '6', '1', null, null, '1', '1', null, '3');
INSERT INTO `web_category` VALUES ('111', 'Tầm nhìn và Sứ mệnh', '5', '0', '6', '1', null, null, '1', '1', null, '4');
INSERT INTO `web_category` VALUES ('112', 'Các thành tích đã đạt được', '5', '0', '6', '1', null, null, '1', '1', null, '5');
INSERT INTO `web_category` VALUES ('113', 'Danh sách lãnh đạo qua các thời kỳ', '5', '0', '6', '1', null, null, '1', '1', null, '6');
INSERT INTO `web_category` VALUES ('114', 'Thông tin liên hệ', '5', '0', '6', '1', null, null, '1', '1', null, '7');
INSERT INTO `web_category` VALUES ('115', 'Chi nhánh Miền Bắc', '34', '0', '6', '1', null, null, '1', '1', null, '1');
INSERT INTO `web_category` VALUES ('116', 'Chi nhánh Miền Nam', '34', '0', '6', '1', null, null, '1', '1', null, '2');
INSERT INTO `web_category` VALUES ('117', 'Chi Nhánh Miền Trung', '34', '0', '6', '1', null, null, '1', '0', null, '3');
INSERT INTO `web_category` VALUES ('118', 'Hệ thống Phân Phối', '34', '0', '6', '1', null, null, '1', '0', null, '4');

-- ----------------------------
-- Table structure for web_contact
-- ----------------------------
DROP TABLE IF EXISTS `web_contact`;
CREATE TABLE `web_contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_title` varchar(255) DEFAULT NULL COMMENT 'tên liên hệ',
  `contact_content` mediumtext,
  `contact_content_reply` mediumtext,
  `contact_user_id_send` int(11) DEFAULT '0' COMMENT '0: khách vãng lai gửi, > 0 shop gửi liên hệ',
  `contact_user_name_send` varchar(255) DEFAULT NULL,
  `contact_phone_send` varchar(255) DEFAULT NULL,
  `contact_email_send` varchar(255) DEFAULT NULL,
  `contact_type` tinyint(5) DEFAULT '1' COMMENT '1:loại gửi , 2: loại nhận',
  `contact_reason` tinyint(5) DEFAULT '1' COMMENT 'Lý do gửi liên hệ: 1: liên hệ ở ngoài site, 2: shop liên hệ với quản trị',
  `contact_status` tinyint(5) DEFAULT '1' COMMENT '1: liên hệ mới, 2: đã xác nhận,3: đã xử lý',
  `contact_time_creater` int(11) DEFAULT NULL,
  `contact_user_id_update` int(11) DEFAULT NULL COMMENT 'Người xử lý liên hệ',
  `contact_user_name_update` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `contact_time_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_contact
-- ----------------------------

-- ----------------------------
-- Table structure for web_department
-- ----------------------------
DROP TABLE IF EXISTS `web_department`;
CREATE TABLE `web_department` (
  `department_id` int(10) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department_alias` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'giá trị type_keword',
  `department_layouts` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'giá trị type_keword',
  `department_status` tinyint(1) DEFAULT '0',
  `department_status_home` tinyint(1) DEFAULT '1' COMMENT '0: ân trên home, 1: có hiểnthij',
  `department_order` tinyint(5) DEFAULT '0',
  PRIMARY KEY (`department_id`),
  KEY `status` (`department_status`) USING BTREE,
  KEY `id_parrent` (`department_status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of web_department
-- ----------------------------
INSERT INTO `web_department` VALUES ('1', 'Các loại bánh', 'cacloaibanh', 'type_khoa', 'layouts_home', '1', '1', '1');
INSERT INTO `web_department` VALUES ('2', 'Các loại kẹo', 'cacloaikeo', 'type_khoa', 'layouts_home', '1', '1', '2');
INSERT INTO `web_department` VALUES ('3', 'Lương khô', 'luongkho', 'type_khoa', 'layouts_home', '1', '1', '3');
INSERT INTO `web_department` VALUES ('4', 'Bột Nêm – Bột canh', 'botnembotcanh', 'type_khoa', 'layouts_home', '1', '1', '4');
INSERT INTO `web_department` VALUES ('5', 'Khuyến Mại', 'khuyenmai', 'type_khoa', 'layouts_home', '1', '1', '5');
INSERT INTO `web_department` VALUES ('6', 'Mứt TẾT ', 'muttet', 'type_khoa', 'layouts_home', '1', '1', '6');

-- ----------------------------
-- Table structure for web_districts
-- ----------------------------
DROP TABLE IF EXISTS `web_districts`;
CREATE TABLE `web_districts` (
  `district_id` int(3) NOT NULL AUTO_INCREMENT,
  `district_name` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `district_province_id` int(10) NOT NULL DEFAULT '0',
  `district_status` tinyint(1) NOT NULL DEFAULT '1',
  `district_position` tinyint(2) DEFAULT '50',
  PRIMARY KEY (`district_id`),
  KEY `id_citiesfather` (`district_province_id`),
  KEY `Idx_id_citiesfather_orders_name` (`district_province_id`,`district_name`)
) ENGINE=InnoDB AUTO_INCREMENT=860 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_districts
-- ----------------------------
INSERT INTO `web_districts` VALUES ('1', 'Ba Đình', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('2', 'Long Biên', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('3', 'Sóc Sơn', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('4', 'Đông Anh', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('5', 'TP Thủ Dầu Một', '8', '1', '50');
INSERT INTO `web_districts` VALUES ('7', 'Thị xã Đồng Xoài', '10', '1', '50');
INSERT INTO `web_districts` VALUES ('10', 'Bến Cát', '8', '1', '50');
INSERT INTO `web_districts` VALUES ('12', 'Tân Uyên', '8', '1', '50');
INSERT INTO `web_districts` VALUES ('16', 'Thuận An', '8', '1', '50');
INSERT INTO `web_districts` VALUES ('18', 'TP Dĩ An', '8', '1', '50');
INSERT INTO `web_districts` VALUES ('20', 'Phú Giáo', '8', '1', '50');
INSERT INTO `web_districts` VALUES ('22', 'Dầu Tiếng', '8', '1', '50');
INSERT INTO `web_districts` VALUES ('28', 'Đồng Xoài', '10', '1', '50');
INSERT INTO `web_districts` VALUES ('31', 'Đồng Phú', '10', '1', '50');
INSERT INTO `web_districts` VALUES ('33', 'Chơn Thành', '10', '1', '50');
INSERT INTO `web_districts` VALUES ('35', 'Bình Long', '10', '1', '50');
INSERT INTO `web_districts` VALUES ('36', 'Lộc Ninh', '10', '1', '50');
INSERT INTO `web_districts` VALUES ('39', 'Bù Đốp', '10', '1', '50');
INSERT INTO `web_districts` VALUES ('40', 'Thành phố Phan Rang - Tháp Chàm', '41', '1', '50');
INSERT INTO `web_districts` VALUES ('42', 'Việt Trì', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('43', 'Phước Long', '10', '1', '50');
INSERT INTO `web_districts` VALUES ('44', 'Huyện Ninh Sơn', '41', '1', '50');
INSERT INTO `web_districts` VALUES ('45', 'Huyện Ninh Hải', '41', '1', '50');
INSERT INTO `web_districts` VALUES ('46', 'Bù Đăng', '10', '1', '50');
INSERT INTO `web_districts` VALUES ('47', 'Huyện Ninh Phước', '41', '1', '50');
INSERT INTO `web_districts` VALUES ('48', 'Hớn Quản', '10', '1', '50');
INSERT INTO `web_districts` VALUES ('49', 'Bác Ái', '41', '1', '50');
INSERT INTO `web_districts` VALUES ('50', 'Bù Gia Mập', '10', '1', '50');
INSERT INTO `web_districts` VALUES ('51', 'Hoàn Kiếm', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('52', 'Huyện Thuận Bắc', '41', '1', '50');
INSERT INTO `web_districts` VALUES ('53', 'Hai Bà Trưng', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('54', 'Huyện Thuận Nam', '41', '1', '50');
INSERT INTO `web_districts` VALUES ('55', 'Đống Đa', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('57', 'Tây Hồ', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('58', 'Đà Lạt', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('60', 'Cầu Giấy', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('61', 'Bảo Lộc', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('62', 'Thị xã Tây Ninh', '51', '1', '50');
INSERT INTO `web_districts` VALUES ('63', 'Thanh Xuân', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('64', 'Huyện Tân Biên', '51', '1', '50');
INSERT INTO `web_districts` VALUES ('65', 'Đức Trọng', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('66', 'Huyện Tân Châu', '51', '1', '50');
INSERT INTO `web_districts` VALUES ('67', 'Huyện Dương Minh Châu', '51', '1', '50');
INSERT INTO `web_districts` VALUES ('68', 'Di Linh', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('69', 'Huyện Châu Thành', '51', '1', '50');
INSERT INTO `web_districts` VALUES ('70', 'Hoàng Mai', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('71', 'Đơn Dương', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('72', 'Huyện Hoà Thành', '51', '1', '50');
INSERT INTO `web_districts` VALUES ('73', 'Huyện Bến Cầu', '51', '1', '50');
INSERT INTO `web_districts` VALUES ('74', 'Lạc Dương', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('75', 'Đoan Hùng', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('76', 'Đạ Huoai', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('77', 'Huyện Gò Dầu', '51', '1', '50');
INSERT INTO `web_districts` VALUES ('78', 'Huyện Trảng Bàng', '51', '1', '50');
INSERT INTO `web_districts` VALUES ('79', 'Đạ Tẻh', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('80', 'Thanh Ba', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('81', 'Cát Tiên', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('83', 'Lâm Hà', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('84', 'Thành phố Phan Thiết', '11', '1', '50');
INSERT INTO `web_districts` VALUES ('85', 'Huyện Tuy Phong', '11', '1', '50');
INSERT INTO `web_districts` VALUES ('86', 'Bảo Lâm', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('87', 'Nam Từ Liêm', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('88', 'Huyện Bắc Bình', '11', '1', '50');
INSERT INTO `web_districts` VALUES ('89', 'Đam Rông', '36', '1', '50');
INSERT INTO `web_districts` VALUES ('91', 'Thanh Trì', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('92', 'Hàm Thuận Bắc', '11', '1', '50');
INSERT INTO `web_districts` VALUES ('93', 'Gia Lâm', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('95', 'Hàm Thuận Nam', '11', '1', '50');
INSERT INTO `web_districts` VALUES ('96', 'Nha Trang', '30', '1', '50');
INSERT INTO `web_districts` VALUES ('97', 'Tuyên Quang', '58', '1', '50');
INSERT INTO `web_districts` VALUES ('98', 'Huyện Hàm Tân', '11', '1', '50');
INSERT INTO `web_districts` VALUES ('99', 'Vạn Ninh', '30', '1', '50');
INSERT INTO `web_districts` VALUES ('100', 'Huyện Đức Linh', '11', '1', '50');
INSERT INTO `web_districts` VALUES ('101', 'Na Hang', '58', '1', '50');
INSERT INTO `web_districts` VALUES ('102', 'Huyện Tánh Linh', '11', '1', '50');
INSERT INTO `web_districts` VALUES ('103', 'Ninh Hoà', '30', '1', '50');
INSERT INTO `web_districts` VALUES ('104', 'Huyện đảo Phú Quý', '11', '1', '50');
INSERT INTO `web_districts` VALUES ('105', 'Chiêm Hoá', '58', '1', '50');
INSERT INTO `web_districts` VALUES ('106', 'Thị xã La Gi', '11', '1', '50');
INSERT INTO `web_districts` VALUES ('107', 'Diên Khánh', '30', '1', '50');
INSERT INTO `web_districts` VALUES ('108', 'Hàm Yên', '58', '1', '50');
INSERT INTO `web_districts` VALUES ('109', 'Yên Sơn', '58', '1', '50');
INSERT INTO `web_districts` VALUES ('110', 'Khánh Vĩnh', '30', '1', '50');
INSERT INTO `web_districts` VALUES ('111', 'Cam Ranh', '30', '1', '50');
INSERT INTO `web_districts` VALUES ('112', 'Sơn Dương', '58', '1', '50');
INSERT INTO `web_districts` VALUES ('113', 'Hà Đông', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('115', 'Khánh Sơn', '30', '1', '50');
INSERT INTO `web_districts` VALUES ('116', 'Sơn Tây', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('117', 'Ba Vì', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('118', 'Trường Sa', '30', '1', '50');
INSERT INTO `web_districts` VALUES ('119', 'Thành phố Biên Hoà', '17', '1', '50');
INSERT INTO `web_districts` VALUES ('120', 'Phúc Thọ', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('121', 'Huyện Vĩnh Cửu', '17', '1', '50');
INSERT INTO `web_districts` VALUES ('122', 'Cam Lâm', '30', '1', '50');
INSERT INTO `web_districts` VALUES ('123', 'Thạch Thất', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('124', 'Quốc Oai', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('127', 'Chương Mỹ', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('128', 'Lạng Sơn', '34', '1', '50');
INSERT INTO `web_districts` VALUES ('129', 'Buôn Ma Thuột', '16', '1', '50');
INSERT INTO `web_districts` VALUES ('130', 'Đan Phượng', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('131', 'Tràng Định', '34', '1', '50');
INSERT INTO `web_districts` VALUES ('132', 'Hoài Đức', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('133', 'Ea H Leo', '16', '1', '50');
INSERT INTO `web_districts` VALUES ('134', 'Bình Gia', '34', '1', '50');
INSERT INTO `web_districts` VALUES ('135', 'Krông Buk', '16', '1', '50');
INSERT INTO `web_districts` VALUES ('136', 'Thanh Oai', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('137', 'Huyện Định Quán', '17', '1', '50');
INSERT INTO `web_districts` VALUES ('138', 'Văn Lãng', '34', '1', '50');
INSERT INTO `web_districts` VALUES ('139', 'Mỹ Đức', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('140', 'Krông Năng', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('141', 'Bắc Sơn', '34', '1', '50');
INSERT INTO `web_districts` VALUES ('142', 'Ứng Hoà', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('143', 'Ea Súp', '16', '1', '50');
INSERT INTO `web_districts` VALUES ('144', 'Thống Nhất', '17', '1', '50');
INSERT INTO `web_districts` VALUES ('145', 'Thường Tín', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('148', 'Phú Xuyên', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('149', 'Văn Quan', '34', '1', '50');
INSERT INTO `web_districts` VALUES ('150', 'Mê Linh', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('151', 'Thị xã Long Khánh', '17', '1', '50');
INSERT INTO `web_districts` VALUES ('152', 'Krông Pắc', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('153', 'Huyện Long Thành', '17', '1', '50');
INSERT INTO `web_districts` VALUES ('154', 'Ea Kar', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('155', 'Huyện Nhơn Trạch', '17', '1', '50');
INSERT INTO `web_districts` VALUES ('156', 'M&#39;Đrăk', '16', '1', '50');
INSERT INTO `web_districts` VALUES ('157', 'Huyện Trảng Bom', '17', '1', '50');
INSERT INTO `web_districts` VALUES ('158', 'Krông Ana', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('160', 'Krông Bông', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('161', 'Quận 1', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('162', 'Cao Lộc', '34', '1', '50');
INSERT INTO `web_districts` VALUES ('163', 'Quận 2', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('164', 'Lăk', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('165', 'Quận 3', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('166', 'Quận 4', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('167', 'Quận 5', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('168', 'Quận 6', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('169', 'Lộc Bình', '34', '1', '50');
INSERT INTO `web_districts` VALUES ('170', 'Quận 7', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('171', 'Chi Lăng', '34', '1', '50');
INSERT INTO `web_districts` VALUES ('172', 'Quận 8', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('173', 'Đình Lập', '34', '1', '50');
INSERT INTO `web_districts` VALUES ('174', 'Quận 9', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('175', 'Hữu Lũng', '34', '1', '50');
INSERT INTO `web_districts` VALUES ('176', 'Quận 10', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('177', 'Quận 11', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('178', 'Quận 12', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('179', 'Huyện Tân Phú', '17', '1', '50');
INSERT INTO `web_districts` VALUES ('180', 'Gò Vấp', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('181', 'Buôn Đôn', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('182', 'Tân Bình', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('183', 'Xuân Lộc', '17', '1', '50');
INSERT INTO `web_districts` VALUES ('185', 'Tân Phú', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('186', 'Cẩm Mỹ', '17', '1', '50');
INSERT INTO `web_districts` VALUES ('187', 'Buôn Hồ', '16', '1', '50');
INSERT INTO `web_districts` VALUES ('188', 'Bình Thạnh', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('189', 'Phú Nhuận', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('191', 'Tân An', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('192', 'Vĩnh Hưng', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('194', 'Mộc Hoá', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('195', 'Tuy Hoà', '43', '1', '50');
INSERT INTO `web_districts` VALUES ('196', 'Đồng Xuân', '43', '1', '50');
INSERT INTO `web_districts` VALUES ('197', 'Sông Cầu', '43', '1', '50');
INSERT INTO `web_districts` VALUES ('198', 'Tuy An', '43', '1', '50');
INSERT INTO `web_districts` VALUES ('199', 'Sơn Hoà', '43', '1', '50');
INSERT INTO `web_districts` VALUES ('200', 'Tân Thạnh', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('201', 'Sông Hinh', '43', '1', '50');
INSERT INTO `web_districts` VALUES ('202', 'Đông Hoà', '43', '1', '50');
INSERT INTO `web_districts` VALUES ('203', 'Phú Hoà', '43', '1', '50');
INSERT INTO `web_districts` VALUES ('204', 'Đức Huệ', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('205', 'Tây Hoà', '43', '1', '50');
INSERT INTO `web_districts` VALUES ('206', 'Đức Hoà', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('207', 'Bến Lức', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('208', 'Thủ Thừa', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('209', 'Châu Thành', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('212', 'Tân Trụ', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('213', 'Thái Nguyên', '53', '1', '50');
INSERT INTO `web_districts` VALUES ('214', 'Sông Công', '53', '1', '50');
INSERT INTO `web_districts` VALUES ('215', 'Cần Đước', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('216', 'Định Hoá', '53', '1', '50');
INSERT INTO `web_districts` VALUES ('217', 'Cần Giuộc', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('218', 'Phú Lương', '53', '1', '50');
INSERT INTO `web_districts` VALUES ('219', 'Tân Hưng', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('220', 'Võ Nhai', '53', '1', '50');
INSERT INTO `web_districts` VALUES ('222', 'Đại Từ', '53', '1', '50');
INSERT INTO `web_districts` VALUES ('223', 'TP Cao Lãnh', '18', '1', '50');
INSERT INTO `web_districts` VALUES ('224', 'Đồng Hỷ', '53', '1', '50');
INSERT INTO `web_districts` VALUES ('225', 'Sa Đéc', '18', '1', '50');
INSERT INTO `web_districts` VALUES ('226', 'Phú Bình', '53', '1', '50');
INSERT INTO `web_districts` VALUES ('227', 'Tân Hồng', '18', '1', '50');
INSERT INTO `web_districts` VALUES ('228', 'Phổ Yên', '53', '1', '50');
INSERT INTO `web_districts` VALUES ('229', 'Hồng Ngự', '18', '1', '50');
INSERT INTO `web_districts` VALUES ('230', 'Tam Nông', '18', '1', '50');
INSERT INTO `web_districts` VALUES ('231', 'Thanh Bình', '18', '1', '50');
INSERT INTO `web_districts` VALUES ('233', 'Yên Bái', '61', '1', '50');
INSERT INTO `web_districts` VALUES ('234', 'Lấp Vò', '18', '1', '50');
INSERT INTO `web_districts` VALUES ('235', 'Nghĩa Lộ', '61', '1', '50');
INSERT INTO `web_districts` VALUES ('236', 'Tháp Mười', '18', '1', '50');
INSERT INTO `web_districts` VALUES ('237', 'Văn Yên', '61', '1', '50');
INSERT INTO `web_districts` VALUES ('238', 'Lai Vung', '18', '1', '50');
INSERT INTO `web_districts` VALUES ('239', 'Pleiku', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('240', 'Yên Bình', '61', '1', '50');
INSERT INTO `web_districts` VALUES ('241', 'Châu Thành', '18', '1', '50');
INSERT INTO `web_districts` VALUES ('242', 'Mù Cang Chải', '61', '1', '50');
INSERT INTO `web_districts` VALUES ('243', 'Chư Păh', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('244', 'Văn Chấn', '61', '1', '50');
INSERT INTO `web_districts` VALUES ('245', 'Mang Yang', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('246', 'Trấn Yên', '61', '1', '50');
INSERT INTO `web_districts` VALUES ('247', 'Kông Chro', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('249', 'Đức Cơ', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('250', 'Long Xuyên', '66', '1', '50');
INSERT INTO `web_districts` VALUES ('251', 'Châu Đốc', '66', '1', '50');
INSERT INTO `web_districts` VALUES ('252', 'Chư Prông', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('253', 'Trạm Tấu', '61', '1', '50');
INSERT INTO `web_districts` VALUES ('254', 'An Phú', '66', '1', '50');
INSERT INTO `web_districts` VALUES ('255', 'Chư Sê', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('256', 'Tân Châu', '66', '1', '50');
INSERT INTO `web_districts` VALUES ('257', 'Ia Grai', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('258', 'Phú Tân', '66', '1', '50');
INSERT INTO `web_districts` VALUES ('259', 'Tịnh Biên', '66', '1', '50');
INSERT INTO `web_districts` VALUES ('260', 'Đăk Đoa', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('261', 'Tri Tôn', '66', '1', '50');
INSERT INTO `web_districts` VALUES ('262', 'Ia Pa', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('263', 'Châu Phú', '66', '1', '50');
INSERT INTO `web_districts` VALUES ('264', 'Đăk Pơ', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('265', 'Chợ Mới', '66', '1', '50');
INSERT INTO `web_districts` VALUES ('266', 'K’Bang', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('267', 'An Khê', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('268', 'Ayun Pa', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('269', 'Châu Thành', '66', '1', '50');
INSERT INTO `web_districts` VALUES ('270', 'Krông Pa', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('271', 'Thủ Đức', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('272', 'Phú Thiện', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('273', 'Thoại Sơn', '66', '1', '50');
INSERT INTO `web_districts` VALUES ('274', 'Bình Tân', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('275', 'Lục Yên', '61', '1', '50');
INSERT INTO `web_districts` VALUES ('276', 'Chư Pưh', '19', '1', '50');
INSERT INTO `web_districts` VALUES ('277', 'Bình Chánh', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('278', 'Củ Chi', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('280', 'Quy Nhơn', '9', '1', '50');
INSERT INTO `web_districts` VALUES ('281', 'Hóc Môn', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('282', 'Nhà Bè', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('283', 'An Lão', '9', '1', '50');
INSERT INTO `web_districts` VALUES ('285', 'Cần Giờ', '29', '1', '50');
INSERT INTO `web_districts` VALUES ('286', 'Hoài Ân', '9', '1', '50');
INSERT INTO `web_districts` VALUES ('287', 'Vũng Tàu', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('288', 'Bà Rịa', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('289', 'Hoài Nhơn', '9', '1', '50');
INSERT INTO `web_districts` VALUES ('290', 'Xuyên Mộc', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('291', 'Long Điền', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('292', 'Phù Mỹ', '9', '1', '50');
INSERT INTO `web_districts` VALUES ('293', 'Phù Cát', '9', '1', '50');
INSERT INTO `web_districts` VALUES ('294', 'Côn Đảo', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('295', 'Vĩnh Thạnh', '9', '1', '50');
INSERT INTO `web_districts` VALUES ('296', 'Tân Thành', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('297', 'Châu Đức', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('298', 'Tây Sơn', '9', '1', '50');
INSERT INTO `web_districts` VALUES ('300', 'Đất Đỏ', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('301', 'Sơn La', '50', '1', '50');
INSERT INTO `web_districts` VALUES ('302', 'Vân Canh', '9', '1', '50');
INSERT INTO `web_districts` VALUES ('303', 'Quỳnh Nhai', '50', '1', '50');
INSERT INTO `web_districts` VALUES ('305', 'Mường La', '50', '1', '50');
INSERT INTO `web_districts` VALUES ('306', 'An Nhơn', '9', '1', '50');
INSERT INTO `web_districts` VALUES ('307', 'Mỹ Tho', '56', '1', '50');
INSERT INTO `web_districts` VALUES ('308', 'Thuận Châu', '50', '1', '50');
INSERT INTO `web_districts` VALUES ('309', 'Tuy Phước', '9', '1', '50');
INSERT INTO `web_districts` VALUES ('310', 'Bắc Yên', '50', '1', '50');
INSERT INTO `web_districts` VALUES ('311', 'Gò Công', '56', '1', '50');
INSERT INTO `web_districts` VALUES ('313', 'Cái Bè', '56', '1', '50');
INSERT INTO `web_districts` VALUES ('314', 'Phù Yên', '50', '1', '50');
INSERT INTO `web_districts` VALUES ('315', 'KonTum', '32', '1', '50');
INSERT INTO `web_districts` VALUES ('316', 'Mai Sơn', '50', '1', '50');
INSERT INTO `web_districts` VALUES ('317', 'Cai Lậy', '56', '1', '50');
INSERT INTO `web_districts` VALUES ('318', 'Đăk Glei', '32', '1', '50');
INSERT INTO `web_districts` VALUES ('319', 'Yên Châu', '50', '1', '50');
INSERT INTO `web_districts` VALUES ('320', 'Châu Thành', '56', '1', '50');
INSERT INTO `web_districts` VALUES ('321', 'Ngọc Hồi', '32', '1', '50');
INSERT INTO `web_districts` VALUES ('322', 'Sông Mã', '50', '1', '50');
INSERT INTO `web_districts` VALUES ('323', 'Mộc Châu', '50', '1', '50');
INSERT INTO `web_districts` VALUES ('324', 'Đăk Tô', '32', '1', '50');
INSERT INTO `web_districts` VALUES ('325', 'Chợ Gạo', '56', '1', '50');
INSERT INTO `web_districts` VALUES ('326', 'Sa Thầy', '32', '1', '50');
INSERT INTO `web_districts` VALUES ('327', 'Sốp Cộp', '50', '1', '50');
INSERT INTO `web_districts` VALUES ('328', 'Gò Công Tây', '56', '1', '50');
INSERT INTO `web_districts` VALUES ('329', 'Kon Plong', '32', '1', '50');
INSERT INTO `web_districts` VALUES ('330', 'Đăk Hà', '32', '1', '50');
INSERT INTO `web_districts` VALUES ('331', 'Gò Công Đông', '56', '1', '50');
INSERT INTO `web_districts` VALUES ('332', 'Kon Rẫy', '32', '1', '50');
INSERT INTO `web_districts` VALUES ('333', 'Tu Mơ Rông', '32', '1', '50');
INSERT INTO `web_districts` VALUES ('335', 'Tân Phước', '56', '1', '50');
INSERT INTO `web_districts` VALUES ('337', 'Bắc Kạn', '4', '1', '50');
INSERT INTO `web_districts` VALUES ('339', 'Quảng Ngãi', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('340', 'Chợ Đồn', '4', '1', '50');
INSERT INTO `web_districts` VALUES ('341', 'Lý Sơn', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('342', 'Bạch Thông', '4', '1', '50');
INSERT INTO `web_districts` VALUES ('343', 'Bình Sơn', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('344', 'Trà Bồng', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('345', 'Sơn Tịnh', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('346', 'Na Rì', '4', '1', '50');
INSERT INTO `web_districts` VALUES ('347', 'Sơn Hà', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('348', 'Tân Phú Đông', '56', '1', '50');
INSERT INTO `web_districts` VALUES ('349', 'Tư Nghĩa', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('350', 'Nghĩa Hành', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('351', 'Ngân Sơn', '4', '1', '50');
INSERT INTO `web_districts` VALUES ('353', 'Minh Long', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('354', 'Ba Bể', '4', '1', '50');
INSERT INTO `web_districts` VALUES ('355', 'Rạch Giá', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('356', 'Chợ Mới', '4', '1', '50');
INSERT INTO `web_districts` VALUES ('357', 'Mộ Đức', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('358', 'Hà Tiên', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('359', 'Pác Nặm', '4', '1', '50');
INSERT INTO `web_districts` VALUES ('360', 'Đức Phổ', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('361', 'Kiên Lương', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('362', 'Hòn Đất', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('363', 'Ba Tơ', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('364', 'Phú Thọ', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('365', 'Tân Hiệp', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('366', 'Sơn Tây', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('367', 'Châu Thành', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('368', 'Tây Trà', '46', '1', '50');
INSERT INTO `web_districts` VALUES ('369', 'Giồng Riềng', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('370', 'Hạ Hoà', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('371', 'Gò Quao', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('372', 'Cẩm Khê', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('374', 'An Biên', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('375', 'Yên Lập', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('376', 'An Minh', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('377', 'Thanh Sơn', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('378', 'Vĩnh Thuận', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('379', 'Tam Kỳ', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('380', 'Phù Ninh', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('381', 'Phú Quốc', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('382', 'Hội An', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('383', 'Lâm Thao', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('384', 'Kiên Hải', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('385', 'Tam Nông', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('386', 'U Minh Thượng', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('387', 'Duy Xuyên', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('388', 'Thanh Thủy', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('389', 'Điện Bàn', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('390', 'Tân Sơn', '42', '1', '50');
INSERT INTO `web_districts` VALUES ('391', 'Giang Thành', '31', '1', '50');
INSERT INTO `web_districts` VALUES ('392', 'Đại Lộc', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('394', 'Quế Sơn', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('395', 'Ninh Kiều', '14', '1', '50');
INSERT INTO `web_districts` VALUES ('396', 'Hiệp Đức', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('397', 'Bình Thuỷ', '14', '1', '50');
INSERT INTO `web_districts` VALUES ('398', 'Thăng Bình', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('399', 'Cái Răng', '14', '1', '50');
INSERT INTO `web_districts` VALUES ('400', 'Ô Môn', '14', '1', '50');
INSERT INTO `web_districts` VALUES ('401', 'Núi Thành', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('402', 'Phong Điền', '14', '1', '50');
INSERT INTO `web_districts` VALUES ('403', 'Tiên Phước', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('404', 'Cờ Đỏ', '14', '1', '50');
INSERT INTO `web_districts` VALUES ('405', 'Bắc Trà My', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('406', 'Vĩnh Thạnh', '14', '1', '50');
INSERT INTO `web_districts` VALUES ('407', 'Thốt Nốt', '14', '1', '50');
INSERT INTO `web_districts` VALUES ('408', 'Đông Giang', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('409', 'Thới Lai', '14', '1', '50');
INSERT INTO `web_districts` VALUES ('410', 'Nam Giang', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('412', 'Phước Sơn', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('413', 'Nam Trà My', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('414', 'Bến Tre', '7', '1', '50');
INSERT INTO `web_districts` VALUES ('415', 'Tây Giang', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('416', 'Phú Ninh', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('417', 'Nông Sơn', '45', '1', '50');
INSERT INTO `web_districts` VALUES ('418', 'Châu Thành', '7', '1', '50');
INSERT INTO `web_districts` VALUES ('420', 'Chợ Lách', '7', '1', '50');
INSERT INTO `web_districts` VALUES ('421', 'Mỏ Cày Bắc', '7', '1', '50');
INSERT INTO `web_districts` VALUES ('423', 'Giồng Trôm', '7', '1', '50');
INSERT INTO `web_districts` VALUES ('424', 'Huế', '55', '1', '50');
INSERT INTO `web_districts` VALUES ('425', 'Hồng Bàng', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('426', 'Bình Đại', '7', '1', '50');
INSERT INTO `web_districts` VALUES ('427', 'Phong Điền', '55', '1', '50');
INSERT INTO `web_districts` VALUES ('428', 'Quảng Điền', '55', '1', '50');
INSERT INTO `web_districts` VALUES ('429', 'Ba Tri', '7', '1', '50');
INSERT INTO `web_districts` VALUES ('430', 'Thạnh Phú', '7', '1', '50');
INSERT INTO `web_districts` VALUES ('431', 'Hương Trà', '55', '1', '50');
INSERT INTO `web_districts` VALUES ('432', 'Mỏ Cày Nam', '7', '1', '50');
INSERT INTO `web_districts` VALUES ('433', 'Lê Chân', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('434', 'Phú Vang', '55', '1', '50');
INSERT INTO `web_districts` VALUES ('435', 'Ngô Quyền', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('436', 'Hương Thuỷ', '55', '1', '50');
INSERT INTO `web_districts` VALUES ('438', 'Kiến An', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('439', 'Phú Lộc', '55', '1', '50');
INSERT INTO `web_districts` VALUES ('440', 'Vĩnh Long', '59', '1', '50');
INSERT INTO `web_districts` VALUES ('442', 'Long Hồ', '59', '1', '50');
INSERT INTO `web_districts` VALUES ('443', 'Nam Đông', '55', '1', '50');
INSERT INTO `web_districts` VALUES ('444', 'Hải An', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('445', 'Mang Thít', '59', '1', '50');
INSERT INTO `web_districts` VALUES ('446', 'A Lưới', '55', '1', '50');
INSERT INTO `web_districts` VALUES ('447', 'Đồ Sơn', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('448', 'Bình Minh', '59', '1', '50');
INSERT INTO `web_districts` VALUES ('449', 'An Lão', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('450', 'Tam Bình', '59', '1', '50');
INSERT INTO `web_districts` VALUES ('452', 'Kiến Thụy', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('453', 'Trà Ôn', '59', '1', '50');
INSERT INTO `web_districts` VALUES ('454', 'Đông Hà', '48', '1', '50');
INSERT INTO `web_districts` VALUES ('455', 'Thủy Nguyên', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('456', 'An Dương', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('458', 'Tiên Lãng', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('459', 'Vĩnh Linh', '48', '1', '50');
INSERT INTO `web_districts` VALUES ('460', 'Vĩnh Bảo', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('461', 'Gio Linh', '48', '1', '50');
INSERT INTO `web_districts` VALUES ('462', 'Cam Lộ', '48', '1', '50');
INSERT INTO `web_districts` VALUES ('463', 'Triệu Phong', '48', '1', '50');
INSERT INTO `web_districts` VALUES ('464', 'Hải Lăng', '48', '1', '50');
INSERT INTO `web_districts` VALUES ('465', 'Hướng Hoá', '48', '1', '50');
INSERT INTO `web_districts` VALUES ('466', 'Đăk Rông', '48', '1', '50');
INSERT INTO `web_districts` VALUES ('467', 'Cồn Cỏ', '48', '1', '50');
INSERT INTO `web_districts` VALUES ('469', 'Đồng Hới', '44', '1', '50');
INSERT INTO `web_districts` VALUES ('470', 'Vũng Liêm', '59', '1', '50');
INSERT INTO `web_districts` VALUES ('471', 'Tuyên Hoá', '44', '1', '50');
INSERT INTO `web_districts` VALUES ('472', 'Bình Tân', '59', '1', '50');
INSERT INTO `web_districts` VALUES ('473', 'Minh Hoá', '44', '1', '50');
INSERT INTO `web_districts` VALUES ('474', 'Quảng Trạch', '44', '1', '50');
INSERT INTO `web_districts` VALUES ('476', 'Trà Vinh', '57', '1', '50');
INSERT INTO `web_districts` VALUES ('477', 'Bố Trạch', '44', '1', '50');
INSERT INTO `web_districts` VALUES ('478', 'Càng Long', '57', '1', '50');
INSERT INTO `web_districts` VALUES ('479', 'Cầu Kè', '57', '1', '50');
INSERT INTO `web_districts` VALUES ('480', 'Quảng Ninh', '44', '1', '50');
INSERT INTO `web_districts` VALUES ('481', 'Tiểu Cần', '57', '1', '50');
INSERT INTO `web_districts` VALUES ('482', 'Lệ Thuỷ', '44', '1', '50');
INSERT INTO `web_districts` VALUES ('483', 'Châu Thành', '57', '1', '50');
INSERT INTO `web_districts` VALUES ('484', 'Trà Cú', '57', '1', '50');
INSERT INTO `web_districts` VALUES ('485', 'Cầu Ngang', '57', '1', '50');
INSERT INTO `web_districts` VALUES ('487', 'Duyên Hải', '57', '1', '50');
INSERT INTO `web_districts` VALUES ('488', 'Hà Tĩnh', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('489', 'Hồng Lĩnh', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('490', 'Cát Hải', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('492', 'Hương Sơn', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('493', 'Sóc Trăng', '49', '1', '50');
INSERT INTO `web_districts` VALUES ('494', 'Bạch Long Vĩ', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('495', 'Đức Thọ', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('496', 'Mỹ Xuyên', '49', '1', '50');
INSERT INTO `web_districts` VALUES ('497', 'Dương Kinh', '26', '1', '50');
INSERT INTO `web_districts` VALUES ('498', 'Thạnh Trị', '49', '1', '50');
INSERT INTO `web_districts` VALUES ('499', 'Nghi Xuân', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('500', 'Can Lộc', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('501', 'Cù Lao Dung', '49', '1', '50');
INSERT INTO `web_districts` VALUES ('502', 'Ngã Năm', '49', '1', '50');
INSERT INTO `web_districts` VALUES ('503', 'Hương Khê', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('505', 'Thạch Hà', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('506', 'Kế Sách', '49', '1', '50');
INSERT INTO `web_districts` VALUES ('507', 'Cẩm Xuyên', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('508', 'Mỹ Tú', '49', '1', '50');
INSERT INTO `web_districts` VALUES ('509', 'Thị Xã Kỳ Anh', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('510', 'Hải Châu', '15', '1', '50');
INSERT INTO `web_districts` VALUES ('511', 'Long Phú', '49', '1', '50');
INSERT INTO `web_districts` VALUES ('512', 'Vũ Quang', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('513', 'Vĩnh Châu', '49', '1', '50');
INSERT INTO `web_districts` VALUES ('514', 'Thanh Khê', '15', '1', '50');
INSERT INTO `web_districts` VALUES ('515', 'Lộc Hà', '24', '1', '50');
INSERT INTO `web_districts` VALUES ('516', 'Châu Thành', '49', '1', '50');
INSERT INTO `web_districts` VALUES ('517', 'Sơn Trà', '15', '1', '50');
INSERT INTO `web_districts` VALUES ('518', 'Trần Đề', '49', '1', '50');
INSERT INTO `web_districts` VALUES ('519', 'Ngũ Hành Sơn', '15', '1', '50');
INSERT INTO `web_districts` VALUES ('521', 'Liên Chiểu', '15', '1', '50');
INSERT INTO `web_districts` VALUES ('522', 'Vinh', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('524', 'Hoà Vang', '15', '1', '50');
INSERT INTO `web_districts` VALUES ('525', 'Cửa Lò', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('526', 'Bạc Liêu', '3', '1', '50');
INSERT INTO `web_districts` VALUES ('527', 'Vĩnh Lợi', '3', '1', '50');
INSERT INTO `web_districts` VALUES ('528', 'Quỳ Châu', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('529', 'Hồng Dân', '3', '1', '50');
INSERT INTO `web_districts` VALUES ('530', 'Quỳ Hợp', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('531', 'Giá Rai', '3', '1', '50');
INSERT INTO `web_districts` VALUES ('532', 'Nghĩa Đàn', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('533', 'Cẩm Lệ', '15', '1', '50');
INSERT INTO `web_districts` VALUES ('534', 'Phước Long', '3', '1', '50');
INSERT INTO `web_districts` VALUES ('535', 'Quỳnh Lưu', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('536', 'Đông Hải', '3', '1', '50');
INSERT INTO `web_districts` VALUES ('537', 'Kỳ Sơn', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('538', 'Hoà Bình', '3', '1', '50');
INSERT INTO `web_districts` VALUES ('539', 'Tương Dương', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('540', 'Con Cuông', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('542', 'Tân Kỳ', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('543', 'Yên Thành', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('544', 'Diễn Châu', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('545', 'Anh Sơn', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('546', 'Đô Lương', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('547', 'Thanh Chương', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('548', 'Nghi Lộc', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('549', 'Đồng Văn', '20', '1', '50');
INSERT INTO `web_districts` VALUES ('550', 'Mèo Vạc', '20', '1', '50');
INSERT INTO `web_districts` VALUES ('551', 'Nam Đàn', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('553', 'Yên Minh', '20', '1', '50');
INSERT INTO `web_districts` VALUES ('554', 'Hưng Nguyên', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('555', 'Quản Bạ', '20', '1', '50');
INSERT INTO `web_districts` VALUES ('556', 'Vị Xuyên', '20', '1', '50');
INSERT INTO `web_districts` VALUES ('557', 'Quế Phong', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('558', 'Bắc Mê', '20', '1', '50');
INSERT INTO `web_districts` VALUES ('559', 'Thị xã Thái Hòa', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('560', 'Hoàng Su Phì', '20', '1', '50');
INSERT INTO `web_districts` VALUES ('561', 'Cà Mau', '12', '1', '50');
INSERT INTO `web_districts` VALUES ('563', 'Xín Mần', '20', '1', '50');
INSERT INTO `web_districts` VALUES ('564', 'Thới Bình', '12', '1', '50');
INSERT INTO `web_districts` VALUES ('565', 'Thanh Hoá', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('566', 'U Minh', '12', '1', '50');
INSERT INTO `web_districts` VALUES ('567', 'Bắc Quang', '20', '1', '50');
INSERT INTO `web_districts` VALUES ('568', 'Bỉm Sơn', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('569', 'Trần Văn Thời', '12', '1', '50');
INSERT INTO `web_districts` VALUES ('570', 'Sầm Sơn', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('571', 'Quang Bình', '20', '1', '50');
INSERT INTO `web_districts` VALUES ('572', 'Cái Nước', '12', '1', '50');
INSERT INTO `web_districts` VALUES ('573', 'Quan Hoá', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('574', 'Quan Sơn', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('575', 'Mường Lát', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('577', 'Bá Thước', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('578', 'Cao Bằng', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('579', 'Thường Xuân', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('580', 'Bảo Lạc', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('581', 'Thông Nông', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('582', 'Như Xuân', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('583', 'Như Thanh', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('584', 'Lang Chánh', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('585', 'Ngọc Lặc', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('586', 'Thạch Thành', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('587', 'Cẩm Thủy', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('588', 'Hà Quảng', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('589', 'Thọ Xuân', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('590', 'Trà Lĩnh', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('591', 'Vĩnh Lộc', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('592', 'Thiệu Hoá', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('593', 'Triệu Sơn', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('594', 'Đầm Dơi', '12', '1', '50');
INSERT INTO `web_districts` VALUES ('595', 'Nông Cống', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('596', 'Ngọc Hiển', '12', '1', '50');
INSERT INTO `web_districts` VALUES ('597', 'Đông Sơn', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('598', 'Năm Căn', '12', '1', '50');
INSERT INTO `web_districts` VALUES ('599', 'Hà Trung', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('600', 'Phú Tân', '12', '1', '50');
INSERT INTO `web_districts` VALUES ('601', 'Hoằng Hoá', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('603', 'Nga Sơn', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('604', 'Điện Biên Phủ', '69', '1', '1');
INSERT INTO `web_districts` VALUES ('605', 'Hậu Lộc', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('606', 'Mường Lay', '69', '1', '2');
INSERT INTO `web_districts` VALUES ('607', 'Quảng Xương', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('608', 'Điện Biên', '69', '1', '50');
INSERT INTO `web_districts` VALUES ('609', 'Tĩnh Gia', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('610', 'Tuần Giáo', '69', '1', '50');
INSERT INTO `web_districts` VALUES ('611', 'Yên Định', '54', '1', '50');
INSERT INTO `web_districts` VALUES ('612', 'Trùng Khánh', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('613', 'Mường Chà', '69', '1', '50');
INSERT INTO `web_districts` VALUES ('614', 'Tủa Chùa', '69', '1', '50');
INSERT INTO `web_districts` VALUES ('615', 'Nguyên Bình', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('616', 'Điện Biên Đông', '69', '1', '50');
INSERT INTO `web_districts` VALUES ('618', 'Mường Nhé', '69', '1', '50');
INSERT INTO `web_districts` VALUES ('619', 'Thành phố Ninh Bình', '40', '1', '50');
INSERT INTO `web_districts` VALUES ('620', 'Mường Ảng', '69', '1', '50');
INSERT INTO `web_districts` VALUES ('622', 'Tam Điệp', '40', '1', '50');
INSERT INTO `web_districts` VALUES ('623', 'Nho Quan', '40', '1', '50');
INSERT INTO `web_districts` VALUES ('624', 'Gia Viễn', '40', '1', '50');
INSERT INTO `web_districts` VALUES ('625', 'Hoa Lư', '40', '1', '50');
INSERT INTO `web_districts` VALUES ('626', 'Yên Mô', '40', '1', '50');
INSERT INTO `web_districts` VALUES ('628', 'Kim Sơn', '40', '1', '50');
INSERT INTO `web_districts` VALUES ('629', 'Gia Nghĩa', '71', '1', '50');
INSERT INTO `web_districts` VALUES ('630', 'Yên Khánh', '40', '1', '50');
INSERT INTO `web_districts` VALUES ('631', 'Dăk RLấp', '71', '1', '50');
INSERT INTO `web_districts` VALUES ('632', 'Dăk Mil', '71', '1', '50');
INSERT INTO `web_districts` VALUES ('633', 'Cư Jút', '71', '1', '50');
INSERT INTO `web_districts` VALUES ('635', 'Hoà An', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('636', 'Dăk Song', '71', '1', '50');
INSERT INTO `web_districts` VALUES ('637', 'Thái Bình', '52', '1', '50');
INSERT INTO `web_districts` VALUES ('638', 'Quảng Uyên', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('639', 'Krông Nô', '71', '1', '50');
INSERT INTO `web_districts` VALUES ('640', 'Thạch An', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('641', 'Quỳnh Phụ', '52', '1', '50');
INSERT INTO `web_districts` VALUES ('642', 'Dăk GLong', '71', '1', '50');
INSERT INTO `web_districts` VALUES ('643', 'Hạ Lang', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('644', 'Hưng Hà', '52', '1', '50');
INSERT INTO `web_districts` VALUES ('645', 'Tuy Đức', '71', '1', '50');
INSERT INTO `web_districts` VALUES ('646', 'Bảo Lâm', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('647', 'Đông Hưng', '52', '1', '50');
INSERT INTO `web_districts` VALUES ('648', 'Phục Hoà', '13', '1', '50');
INSERT INTO `web_districts` VALUES ('649', 'Vũ Thư', '52', '1', '50');
INSERT INTO `web_districts` VALUES ('651', 'Kiến Xương', '52', '1', '50');
INSERT INTO `web_districts` VALUES ('652', 'Vị Thanh', '70', '1', '50');
INSERT INTO `web_districts` VALUES ('654', 'Vị Thuỷ', '70', '1', '50');
INSERT INTO `web_districts` VALUES ('655', 'Tiền Hải', '52', '1', '50');
INSERT INTO `web_districts` VALUES ('656', 'Lai Châu', '33', '1', '50');
INSERT INTO `web_districts` VALUES ('657', 'Long Mỹ', '70', '1', '50');
INSERT INTO `web_districts` VALUES ('658', 'Thái Thuỵ', '52', '1', '50');
INSERT INTO `web_districts` VALUES ('659', 'Phụng Hiệp', '70', '1', '50');
INSERT INTO `web_districts` VALUES ('660', 'Tam Đường', '33', '1', '50');
INSERT INTO `web_districts` VALUES ('661', 'Châu Thành', '70', '1', '50');
INSERT INTO `web_districts` VALUES ('662', 'Phong Thổ', '33', '1', '50');
INSERT INTO `web_districts` VALUES ('663', 'Châu Thành A', '70', '1', '50');
INSERT INTO `web_districts` VALUES ('665', 'Sìn Hồ', '33', '1', '50');
INSERT INTO `web_districts` VALUES ('666', 'Ngã Bảy', '70', '1', '50');
INSERT INTO `web_districts` VALUES ('667', 'Nam Định', '38', '1', '50');
INSERT INTO `web_districts` VALUES ('668', 'Mường Tè', '33', '1', '50');
INSERT INTO `web_districts` VALUES ('669', 'Mỹ Lộc', '38', '1', '50');
INSERT INTO `web_districts` VALUES ('670', 'Than Uyên', '33', '1', '50');
INSERT INTO `web_districts` VALUES ('671', 'Xuân Trường', '38', '1', '50');
INSERT INTO `web_districts` VALUES ('672', 'Tân Uyên', '33', '1', '50');
INSERT INTO `web_districts` VALUES ('673', 'Giao Thủy', '38', '1', '50');
INSERT INTO `web_districts` VALUES ('674', 'Ý Yên', '38', '1', '50');
INSERT INTO `web_districts` VALUES ('676', 'Vụ Bản', '38', '1', '50');
INSERT INTO `web_districts` VALUES ('677', 'Lào Cai', '35', '1', '50');
INSERT INTO `web_districts` VALUES ('678', 'Nam Trực', '38', '1', '50');
INSERT INTO `web_districts` VALUES ('679', 'Xi Ma Cai', '35', '1', '50');
INSERT INTO `web_districts` VALUES ('680', 'Trực Ninh', '38', '1', '50');
INSERT INTO `web_districts` VALUES ('681', 'Bát Xát', '35', '1', '50');
INSERT INTO `web_districts` VALUES ('682', 'Nghĩa Hưng', '38', '1', '50');
INSERT INTO `web_districts` VALUES ('683', 'Bảo Thắng', '35', '1', '50');
INSERT INTO `web_districts` VALUES ('684', 'Hải Hậu', '38', '1', '50');
INSERT INTO `web_districts` VALUES ('685', 'Sa Pa', '35', '1', '50');
INSERT INTO `web_districts` VALUES ('686', 'Văn Bàn', '35', '1', '50');
INSERT INTO `web_districts` VALUES ('688', 'Phủ Lý', '21', '1', '50');
INSERT INTO `web_districts` VALUES ('689', 'Duy Tiên', '21', '1', '50');
INSERT INTO `web_districts` VALUES ('690', 'Bảo Yên', '35', '1', '50');
INSERT INTO `web_districts` VALUES ('691', 'Kim Bảng', '21', '1', '50');
INSERT INTO `web_districts` VALUES ('692', 'Bắc Hà', '35', '1', '50');
INSERT INTO `web_districts` VALUES ('693', 'Lý Nhân', '21', '1', '50');
INSERT INTO `web_districts` VALUES ('694', 'Mường Khương', '35', '1', '50');
INSERT INTO `web_districts` VALUES ('695', 'Thanh Liêm', '21', '1', '50');
INSERT INTO `web_districts` VALUES ('696', 'Bình Lục', '21', '1', '50');
INSERT INTO `web_districts` VALUES ('698', 'Hoà Bình', '27', '1', '50');
INSERT INTO `web_districts` VALUES ('699', 'Đà Bắc', '27', '1', '50');
INSERT INTO `web_districts` VALUES ('700', 'Mai Châu', '27', '1', '50');
INSERT INTO `web_districts` VALUES ('701', 'Tân Lạc', '27', '1', '50');
INSERT INTO `web_districts` VALUES ('702', 'Lạc Sơn', '27', '1', '50');
INSERT INTO `web_districts` VALUES ('703', 'Kỳ Sơn', '27', '1', '50');
INSERT INTO `web_districts` VALUES ('704', 'Lương Sơn', '27', '1', '50');
INSERT INTO `web_districts` VALUES ('705', 'Kim Bôi', '27', '1', '50');
INSERT INTO `web_districts` VALUES ('706', 'Lạc Thuỷ', '27', '1', '50');
INSERT INTO `web_districts` VALUES ('707', 'Yên Thuỷ', '27', '1', '50');
INSERT INTO `web_districts` VALUES ('708', 'Cao Phong', '27', '1', '50');
INSERT INTO `web_districts` VALUES ('710', 'Hưng Yên', '28', '1', '50');
INSERT INTO `web_districts` VALUES ('711', 'Kim Động', '28', '1', '50');
INSERT INTO `web_districts` VALUES ('712', 'Ân Thi', '28', '1', '50');
INSERT INTO `web_districts` VALUES ('713', 'Khoái Châu', '28', '1', '50');
INSERT INTO `web_districts` VALUES ('714', 'Yên Mỹ', '28', '1', '50');
INSERT INTO `web_districts` VALUES ('715', 'Tiên Lữ', '28', '1', '50');
INSERT INTO `web_districts` VALUES ('716', 'Phù Cừ', '28', '1', '50');
INSERT INTO `web_districts` VALUES ('717', 'Mỹ Hào', '28', '1', '50');
INSERT INTO `web_districts` VALUES ('718', 'Văn Lâm', '28', '1', '50');
INSERT INTO `web_districts` VALUES ('719', 'Văn Giang', '28', '1', '50');
INSERT INTO `web_districts` VALUES ('721', 'Hải Dương', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('722', 'Chí Linh', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('723', 'Nam Sách', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('724', 'Kinh Môn', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('725', 'Gia Lộc', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('726', 'Tứ Kỳ', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('727', 'Thanh Miện', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('728', 'Ninh Giang', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('729', 'Cẩm Giàng', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('730', 'Thanh Hà', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('731', 'Kim Thành', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('732', 'Bình Giang', '25', '1', '50');
INSERT INTO `web_districts` VALUES ('734', 'Bắc Ninh', '6', '1', '50');
INSERT INTO `web_districts` VALUES ('735', 'Yên Phong', '6', '1', '50');
INSERT INTO `web_districts` VALUES ('736', 'Quế Võ', '6', '1', '50');
INSERT INTO `web_districts` VALUES ('737', 'Tiên Du', '6', '1', '50');
INSERT INTO `web_districts` VALUES ('738', 'Từ  Sơn', '6', '1', '50');
INSERT INTO `web_districts` VALUES ('739', 'Thuận Thành', '6', '1', '50');
INSERT INTO `web_districts` VALUES ('740', 'Gia Bình', '6', '1', '50');
INSERT INTO `web_districts` VALUES ('741', 'Lương Tài', '6', '1', '50');
INSERT INTO `web_districts` VALUES ('743', 'Bắc Giang', '5', '1', '50');
INSERT INTO `web_districts` VALUES ('744', 'Yên Thế', '5', '1', '50');
INSERT INTO `web_districts` VALUES ('745', 'Lục Ngạn', '5', '1', '50');
INSERT INTO `web_districts` VALUES ('746', 'Sơn Động', '5', '1', '50');
INSERT INTO `web_districts` VALUES ('747', 'Lục Nam', '5', '1', '50');
INSERT INTO `web_districts` VALUES ('748', 'Tân Yên', '5', '1', '50');
INSERT INTO `web_districts` VALUES ('749', 'Hiệp Hoà', '5', '1', '50');
INSERT INTO `web_districts` VALUES ('750', 'Lạng Giang', '5', '1', '50');
INSERT INTO `web_districts` VALUES ('751', 'Việt Yên', '5', '1', '50');
INSERT INTO `web_districts` VALUES ('752', 'Yên Dũng', '5', '1', '50');
INSERT INTO `web_districts` VALUES ('754', 'Hạ Long', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('755', 'Cẩm Phả', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('756', 'Uông Bí', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('757', 'Móng Cái', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('758', 'Bình Liêu', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('759', 'Đầm Hà', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('760', 'Hải Hà', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('761', 'Tiên Yên', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('762', 'Ba Chẽ', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('763', 'Đông Triều', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('764', 'Yên Hưng', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('765', 'Hoành Bồ', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('766', 'Vân Đồn', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('767', 'Cô Tô', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('769', 'Vĩnh Yên', '60', '1', '50');
INSERT INTO `web_districts` VALUES ('770', 'Tam Dương', '60', '1', '50');
INSERT INTO `web_districts` VALUES ('771', 'Lập Thạch', '60', '1', '50');
INSERT INTO `web_districts` VALUES ('772', 'Vĩnh Tường', '60', '1', '50');
INSERT INTO `web_districts` VALUES ('773', 'Yên Lạc', '60', '1', '50');
INSERT INTO `web_districts` VALUES ('774', 'Bình Xuyên', '60', '1', '50');
INSERT INTO `web_districts` VALUES ('775', 'Sông Lô', '60', '1', '50');
INSERT INTO `web_districts` VALUES ('776', 'Phúc Yên', '60', '1', '50');
INSERT INTO `web_districts` VALUES ('777', 'Tam Đảo', '60', '1', '50');
INSERT INTO `web_districts` VALUES ('778', 'Thành phố Nha Trang', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('779', 'Huyện Vạn Ninh', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('780', 'Huyện Ninh Hoà', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('781', 'Huyện Diên Khánh', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('782', 'Huyện Khánh Vĩnh', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('783', 'Thị xã Cam Ranh', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('784', 'Huyện Khánh Sơn', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('785', 'Huyện đảo Trường Sa', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('786', 'Huyện Cam Lâm', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('787', 'Hoàng Sa', '15', '1', '50');
INSERT INTO `web_districts` VALUES ('789', 'Ban Mê Thuột', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('790', 'Lạc Thiện', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('791', 'Đắk Song', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('792', 'Buôn Hồ', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('793', 'M&#39;Đrak', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('794', 'Phường Vĩnh Hải', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('795', 'Phường Vĩnh Phước', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('796', 'Phường Vĩnh Thọ', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('797', 'Phường Xương Huân', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('798', 'Phường Vạn Thắng', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('799', 'Phường Vạn Thạnh', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('800', 'Phường Phương Sài', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('801', 'Phường Phương Sơn', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('802', 'Phường Ngọc Hiệp', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('803', 'Phường Phước Hoà', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('804', 'Phường Phước Tân', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('805', 'Phường Phước Tiến', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('806', 'Phường Phước Hải', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('807', 'Phường Lộc Thọ', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('808', 'Phường Tân Lập', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('809', 'Phường Vĩnh Nguyên', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('810', 'Phường Vĩnh Trường', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('811', 'Phường Phước Long', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('812', 'Phường Vĩnh Hoà', '68', '1', '50');
INSERT INTO `web_districts` VALUES ('813', 'Phường 1', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('814', 'Phường 2', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('815', 'Phường 3', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('816', 'Phường 4', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('817', 'Phường 5', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('818', 'Phường 6', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('819', 'Phường 7', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('820', 'Phường 8', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('821', 'Phường 9', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('822', 'Phường 10', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('823', 'Phường 11', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('824', 'Phường 12', '67', '1', '50');
INSERT INTO `web_districts` VALUES ('827', 'Bắc Từ Liêm', '22', '1', '50');
INSERT INTO `web_districts` VALUES ('829', 'Bàu Bàng', '8', '1', '50');
INSERT INTO `web_districts` VALUES ('831', 'Bắc Tân Uyên', '8', '1', '50');
INSERT INTO `web_districts` VALUES ('833', 'Cư M&#39;gaR', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('835', 'Cư Kuin', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('837', 'Ea H&#39;leo', '72', '1', '50');
INSERT INTO `web_districts` VALUES ('839', 'Thạch Hóa', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('841', 'Kiến Tường', '37', '1', '50');
INSERT INTO `web_districts` VALUES ('843', 'Thị xã Ba Đồn', '44', '1', '50');
INSERT INTO `web_districts` VALUES ('845', 'Thành phố Hà Giang', '20', '1', '50');
INSERT INTO `web_districts` VALUES ('847', 'Nậm Nhùm', '33', '1', '50');
INSERT INTO `web_districts` VALUES ('849', 'Huyện Cao Lãnh', '18', '1', '50');
INSERT INTO `web_districts` VALUES ('851', 'Thị xã Quảng Trị', '48', '1', '50');
INSERT INTO `web_districts` VALUES ('853', 'Thị xã Hoàng Mai', '39', '1', '50');
INSERT INTO `web_districts` VALUES ('855', 'Thị xã Quảng Yên', '47', '1', '50');
INSERT INTO `web_districts` VALUES ('857', 'Lâm Bình', '58', '1', '50');
INSERT INTO `web_districts` VALUES ('859', 'Huyện Kỳ Anh', '24', '1', '50');

-- ----------------------------
-- Table structure for web_info
-- ----------------------------
DROP TABLE IF EXISTS `web_info`;
CREATE TABLE `web_info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `info_title` varchar(255) DEFAULT NULL,
  `info_keyword` varchar(255) DEFAULT NULL COMMENT 'keyword',
  `info_intro` longtext,
  `info_content` longtext,
  `info_img` varchar(255) DEFAULT NULL,
  `info_created` varchar(15) DEFAULT NULL,
  `info_order_no` int(11) DEFAULT '0',
  `info_status` tinyint(4) DEFAULT '0' COMMENT 'Item enabled status (1 = enabled, 0 = disabled)',
  `meta_title` text COMMENT 'Meta title',
  `meta_keywords` text COMMENT 'Meta keywords',
  `meta_description` text COMMENT 'Meta description',
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Stores news content.';

-- ----------------------------
-- Records of web_info
-- ----------------------------
INSERT INTO `web_info` VALUES ('1', null, 'Thông tin chân trang', 'SITE_FOOTER_LEFT', '', '', '1481877283-573cb4258e810763aa000001.jpg', '1447794727', '1', '1', '', '', '');
INSERT INTO `web_info` VALUES ('2', null, 'Meta SEO trang liên hệ', 'SITE_SEO_CONTACT', '', '', '1487040720-anhtruong.jpg', '1487040558', '2', '1', 'Công ty cổ phần bánh kẹo Hải Châu', 'Công ty cổ phần bánh kẹo Hải Châu', 'Công ty cổ phần bánh kẹo Hải Châu');
INSERT INTO `web_info` VALUES ('3', null, 'Meta SEO trang chủ', 'SITE_SEO_HOME', '', '', '1487040710-anhtruong.jpg', '1487040663', '3', '1', 'Công ty cổ phần bánh kẹo Hải Châu', 'Công ty cổ phần bánh kẹo Hải Châu', 'Công ty cổ phần bánh kẹo Hải Châu');
INSERT INTO `web_info` VALUES ('4', null, 'Thông tin trang liên hệ', 'SITE_INFO_CONTACT', '', '', '', '1487042227', '4', '1', '', '', '');
INSERT INTO `web_info` VALUES ('5', null, 'Số điện thoại hotline đầu trang', 'SITE_NUM_NICK_SUPPORT_ONLINE', '', '01999.102.888', '', '1491797620', '5', '1', '', '', '');
INSERT INTO `web_info` VALUES ('6', null, 'Số danh mục ở menu ngang đầu trang', 'SITE_NUM_CATEGORY_HORIZONTAL', '', '50', '', '1491799448', '6', '1', '', '', '');

-- ----------------------------
-- Table structure for web_library_images
-- ----------------------------
DROP TABLE IF EXISTS `web_library_images`;
CREATE TABLE `web_library_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_title` varchar(255) DEFAULT NULL,
  `image_title_alias` varchar(255) DEFAULT NULL,
  `image_desc_sort` text,
  `image_content` longtext,
  `image_image` varchar(255) DEFAULT NULL COMMENT 'ảnh đại diện của bài viết',
  `image_image_other` longtext COMMENT 'Lưu ảnh của bài viết',
  `image_category` int(10) DEFAULT NULL,
  `image_status` tinyint(5) DEFAULT NULL,
  `image_hot` tinyint(5) DEFAULT NULL,
  `image_create` int(11) DEFAULT NULL,
  `type_language` tinyint(5) DEFAULT '1',
  `image_meta_title` text,
  `image_meta_keyword` text,
  `image_meta_description` text,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_library_images
-- ----------------------------

-- ----------------------------
-- Table structure for web_mail_send_content
-- ----------------------------
DROP TABLE IF EXISTS `web_mail_send_content`;
CREATE TABLE `web_mail_send_content` (
  `mail_send_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_send_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mail_send_content` text CHARACTER SET utf8,
  `mail_send_str_product_id` tinytext COMMENT 'chuỗi id sản phẩm:1,2,3,4',
  `mail_send_link` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mail_send_img` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mail_send_status` tinyint(5) DEFAULT NULL,
  `mail_send_time_creater` int(11) DEFAULT '0',
  `mail_send_time_update` int(11) DEFAULT '0',
  PRIMARY KEY (`mail_send_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_mail_send_content
-- ----------------------------
INSERT INTO `web_mail_send_content` VALUES ('1', 'Khuyến mại ngày 11-11 cực hot!!!!', '<p>K&iacute;nh ch&agrave;o qu&yacute; kh&aacute;ch!!</p>\\r\\n\\r\\n<p>Nh&acirc;n ng&agrave;y 11-11 Shopcuatui sẽ khuyến mại phiễn ph&iacute; ship tr&ecirc;n to&agrave;n quốc c&aacute;c sản phẩm đặt mua trong ng&agrave;y</p>\\r\\n\\r\\n<p><a href=\"http://shopcuatui.com.vn/shop-70/Phu-kien-thoi-trang.html\">http://shopcuatui.com.vn</a>&nbsp;c&oacute; chương tr&igrave;nh khuyến mại miễn ph&iacute; ship c&aacute;c sản phẩm sau..</p>\\r\\n', '789,788,785,787,753,747,790,806,807', 'http://shopcuatui.com.vn/shop-70/Phu-kien-thoi-trang.html', '', '1', '1478832092', '1478832092');

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
  `news_category_name` varchar(255) DEFAULT NULL,
  `news_status` tinyint(5) DEFAULT NULL,
  `news_hot` tinyint(2) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `news_create` int(11) DEFAULT NULL,
  `news_user_create` varchar(255) DEFAULT NULL,
  `news_update` int(11) DEFAULT NULL,
  `news_user_update` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_news
-- ----------------------------
INSERT INTO `web_news` VALUES ('16', 'Bánh kẹo Hải Châu vào Top 500 doanh nghiệp triển vọng xuất sắc nhất 2016', 'Năm nay, lần đầu tiên, Công ty cổ phần Bánh kẹo Hải Châu lọt vào Top 500 doanh nghiệp (DN) tăng trưởng và triển vọng xuất sắc nhất Việt Năm 2016.', '<p>Năm nay, lần đầu ti&ecirc;n, C&ocirc;ng ty cổ phần B&aacute;nh kẹo Hải Ch&acirc;u lọt v&agrave;o Top 500 doanh nghiệp (DN) tăng trưởng v&agrave; triển vọng xuất sắc nhất Việt Năm 2016.</p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"null\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/16/600x600/1491809734-1.jpg\" /></p>\r\n\r\n<p style=\"text-align:center\"><em>&Ocirc;ng Nguyễn Đ&igrave;nh Khi&ecirc;m- Tổng gi&aacute;m đốc C&ocirc;ng ty cổ phần B&aacute;nh kẹo Hải Ch&acirc;u nhận chứng nhận l&agrave; đơn vị triển vọng xuất sắc nhất 2016</em></p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"null\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/16/600x600/1491809745-2.jpg\" /></p>\r\n\r\n<p>Tại Lễ c&ocirc;ng bố 500 DN tăng trưởng v&agrave; triển vọng xuất sắc nhất Việt Nam 2016 diễn ra ng&agrave;y 12/4/2016 tại H&agrave; Nội, C&ocirc;ng ty cổ phần B&aacute;nh kẹo Hải Ch&acirc;u được xướng t&ecirc;n trong Top 500 DN tăng trưởng v&agrave; triển vọng xuất sắc nhất.</p>\r\n\r\n<p>Chương tr&igrave;nh do C&ocirc;ng ty CP B&aacute;o c&aacute;o Đ&aacute;nh gi&aacute; Việt Nam (Vietnam Report) phối hợp c&ugrave;ng B&aacute;o VietnamNet ch&iacute;nh thức tổ chức. Buổi lễ cũng l&agrave; dịp nh&igrave;n lại v&agrave; ghi nhận những nỗ lực cũng như th&agrave;nh quả hoạt động kinh doanh xuất sắc của c&aacute;c doanh nghiệp tăng trưởng v&agrave; triển vọng xuất sắc nhất Việt Nam trong thời gian vừa qua. C&aacute;c doanh nghiệp được vinh danh đều l&agrave; những đại diện c&oacute; tiềm lực thực sự v&agrave; tiềm năng tăng trưởng trong tương lai.</p>\r\n\r\n<p>C&ocirc;ng ty cổ phần B&aacute;nh kẹo Hải Ch&acirc;u lu&ocirc;n nỗ lực nghi&ecirc;n cứu đưa ra sản phẩm mới ph&ugrave; hợp thị hiếu người ti&ecirc;u d&ugrave;ng, hiện c&ocirc;ng ty c&oacute; tr&ecirc;n 80 chủng loại sản phẩm chất lượng cao được người ti&ecirc;u d&ugrave;ng tin d&ugrave;ng. Đặc biệt, sản phẩm s&ocirc;c&ocirc;la vi&ecirc;n v&agrave; thanh của c&ocirc;ng ty đạt ti&ecirc;u chuẩn ch&acirc;u &Acirc;u, được kh&aacute;ch h&agrave;ng trong v&agrave; ngo&agrave;i nước rất ưa chuộng. B&ecirc;n cạnh đ&oacute;, c&ocirc;ng ty c&ograve;n nghi&ecirc;n cứu triển khai c&aacute;c dự &aacute;n mới trong lĩnh vực chế biến c&aacute;c sản phẩm sữa, đồ uống cao cấp tổng hợp, thực phẩm ăn liền gi&agrave;u dinh dưỡng, sản phẩm ăn ki&ecirc;ng&hellip; để đ&aacute;p ứng ng&agrave;y c&agrave;ng tốt hơn nhu cầu đa dạng của người ti&ecirc;u d&ugrave;ng.</p>\r\n', '1491809734-1.jpg', 'a:2:{i:0;s:16:\"1491809734-1.jpg\";i:1;s:16:\"1491809745-2.jpg\";}', '1', '33', 'Tin tức', '1', '0', 'Bánh kẹo Hải Châu vào Top 500 doanh nghiệp triển vọng xuất sắc nhất 2016', 'Bánh kẹo Hải Châu vào Top 500 doanh nghiệp triển vọng xuất sắc nhất 2016', 'Năm nay, lần đầu tiên, Công ty cổ phần Bánh kẹo Hải Châu lọt vào Top 500 doanh nghiệp (DN) tăng trưởng và triển vọng xuất sắc nhất Việt Năm 2016.', '1491809734', 'admin', '1491835999', 'admin');
INSERT INTO `web_news` VALUES ('17', 'Bánh kẹo Hải Châu nhận Bằng khen của tỉnh Hưng Yên về thành tích nộp thuế năm 2015', 'Hội nghị tuyên dương người nộp thuế tiêu biểu năm 2015 và đối thoại với người nộp thuế', '<p>Hội nghị tuy&ecirc;n dương người nộp thuế ti&ecirc;u biểu năm 2015 v&agrave; đối thoại với người nộp thuế</p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"null\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/17/600x600/1491809981-3.jpg\" /></p>\r\n\r\n<p><em>B&agrave; Phạm Thị Mai Hương -Ph&oacute; tổng gi&aacute;m đốc, Kế to&aacute;n trưởng C&ocirc;ng ty cổ phần B&aacute;nh kẹo Hải Ch&acirc;u nhận bằng khen l&agrave; đơn vị xuất sắc trong thực hiện nghĩa vụ nộp thuế năm 2015 tỉnh Hưng Y&ecirc;n</em></p>\r\n\r\n<p>Ng&agrave;y 24/8/2016, Chi nh&aacute;nh C&ocirc;ng ty cổ phần b&aacute;nh kẹo Hải Ch&acirc;u (Nh&agrave; m&aacute;y b&aacute;nh kẹo Hải Ch&acirc;u) tại x&atilde; Vĩnh kh&uacute;c -huyện Văn giang -tỉnh Hưng Y&ecirc;n đ&oacute;n nhận Bằng khen của Ủy Ban Nh&acirc;n d&acirc;n tỉnh Hưng Y&ecirc;n về th&agrave;nh t&iacute;ch xuất sắc trong thực hiện nghĩa vụ nộp thuế năm 2015.</p>\r\n', '1491809981-3.jpg', 'a:1:{i:0;s:16:\"1491809981-3.jpg\";}', '1', '33', 'Tin tức', '1', '1', 'Bánh kẹo Hải Châu nhận Bằng khen của tỉnh Hưng Yên về thành tích nộp thuế năm 2015', 'Hội nghị tuyên dương người nộp thuế tiêu biểu năm 2015 và đối thoại với người nộp thuế', 'Hội nghị tuyên dương người nộp thuế tiêu biểu năm 2015 và đối thoại với người nộp thuế', '1491809981', 'admin', '1491835894', 'admin');
INSERT INTO `web_news` VALUES ('18', 'Một số hoạt động thể thao kỷ niệm 51 năm ngày TL Công ty Hải Châu (02/9/1965-02/9/2016)', 'Một số hình ảnh hoạt động thể thao kỷ niệm 51 năm ngày thành lập Công ty cổ phần Bánh kẹo Hải Châu (02/9/1965 - 02/9/2016)', '<p>Một số h&igrave;nh ảnh hoạt động thể thao kỷ niệm 51 năm ng&agrave;y th&agrave;nh lập C&ocirc;ng ty cổ phần B&aacute;nh kẹo Hải Ch&acirc;u (02/9/1965 - 02/9/2016)</p>\r\n\r\n<p>Ng&agrave;y 11/9/2016, tại C&ocirc;ng vi&ecirc;n Tuổi Trẻ, Quận HBT tổ chức thi Chung kết giải chạy b&aacute;o H&agrave; Nội mới lần thứ 43 &quot;v&igrave; h&ograve;a b&igrave;nh&quot;, kết quả chung cuộc: B&aacute;nh kẹo Hải Ch&acirc;u đạt Nhất giải Đồng đội Nữ v&agrave; Nhất giải đồng đội Nam. Xin ch&uacute;c mừng, năm 2015 cũng đ&atilde; đoạt giải cao: Nhất đồng đội Nam, Nh&igrave; đồng đội Nữ.</p>\r\n\r\n<p>Ch&uacute;c mừng: Hội thi k&eacute;o co: Nhất XN Gia vị Thực phẩm; Nh&igrave; XN Quy Kem xốp; Ba Chi nh&aacute;nh HN; Bốn Khối Cung t&agrave;i; Năm Khối Nghiệp vụ v&agrave; XN B&aacute;nh kẹo; v&agrave; Giao hữu b&oacute;ng đ&aacute; giữa c&ocirc;ng ty Hải Ch&acirc;u &amp; c&ocirc;ng ty Vĩnh Th&agrave;nh; Hội thi chạy giải b&aacute;o HNM lần thứ 43 &quot;v&igrave; h&ograve;a b&igrave;nh&quot; tại Nh&agrave; m&aacute;y BKHC: Về giải đồng đội nam: Nhất XN Quy KX, nh&igrave; XN GVTP, ba khối Cung t&agrave;i v&agrave; giải đồng đội nữ: Nhất XN Quy KX, nh&igrave; XN GVTP , ba XN B&aacute;nh kẹo. Xin ch&uacute;c mừng.</p>\r\n\r\n<p><img alt=\"Một số hoạt động thể thao kỷ niệm 51 năm ngày TL Công ty Hải Châu (02/9/1965-02/9/2016)\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/18/600x600/1491810173-1.jpg\" /><img alt=\"Một số hoạt động thể thao kỷ niệm 51 năm ngày TL Công ty Hải Châu (02/9/1965-02/9/2016)\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/18/600x600/1491810190-7.jpg\" /><img alt=\"Một số hoạt động thể thao kỷ niệm 51 năm ngày TL Công ty Hải Châu (02/9/1965-02/9/2016)\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/18/600x600/1491810190-6.jpg\" /><img alt=\"Một số hoạt động thể thao kỷ niệm 51 năm ngày TL Công ty Hải Châu (02/9/1965-02/9/2016)\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/18/600x600/1491810190-2.jpg\" /><img alt=\"Một số hoạt động thể thao kỷ niệm 51 năm ngày TL Công ty Hải Châu (02/9/1965-02/9/2016)\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/18/600x600/1491810190-3.jpg\" /><img alt=\"Một số hoạt động thể thao kỷ niệm 51 năm ngày TL Công ty Hải Châu (02/9/1965-02/9/2016)\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/18/600x600/1491810190-5.jpg\" /><img alt=\"Một số hoạt động thể thao kỷ niệm 51 năm ngày TL Công ty Hải Châu (02/9/1965-02/9/2016)\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/18/600x600/1491810190-4.jpg\" /></p>\r\n', '1491810173-1.jpg', 'a:7:{i:0;s:16:\"1491810173-1.jpg\";i:1;s:16:\"1491810190-7.jpg\";i:2;s:16:\"1491810190-6.jpg\";i:3;s:16:\"1491810190-2.jpg\";i:4;s:16:\"1491810190-3.jpg\";i:5;s:16:\"1491810190-5.jpg\";i:6;s:16:\"1491810190-4.jpg\";}', '1', '33', 'Tin tức', '1', '1', 'Một số hoạt động thể thao kỷ niệm 51 năm ngày TL Công ty Hải Châu (02/9/1965-02/9/2016)', 'Một số hoạt động thể thao kỷ niệm 51 năm ngày TL Công ty Hải Châu (02/9/1965-02/9/2016)', '', '1491810160', 'admin', '1491835885', 'admin');
INSERT INTO `web_news` VALUES ('19', 'Hải Châu chia sẻ cùng đồng bào miền Trung mùa lũ', 'Hướng về Miền Trung luôn có sự đồng hành thân thiết của Hải Châu trong nhiều năm qua v.v.v…Được sự chỉ đạo của đ/c Bí thư Đảng ủy, Tổng giám đốc Công ty, Đảng bộ, Công đoàn, Đoàn Thanh niên sự thống nhất Ban lãnh đạo Công ty, BCH Công đoàn công ty đã thông báo trong toàn công ty quyên góp được 100% cán bộ công nhân viên công ty tham gia ủng hộ.', '<p>&quot;&Ocirc;i đẹp l&agrave;m sao t&igrave;nh người sau cơn lũ Đem nụ cười sinh sự sống cho đời&quot;</p>\r\n\r\n<p>&quot;Nghe tin đọc b&aacute;o rưng nước mắt</p>\r\n\r\n<p>Dải ruột miền Trung mưa lớn về</p>\r\n\r\n<p>Chống b&atilde;o chưa xong phải chống lũ,</p>\r\n\r\n<p>&nbsp;Lũ chồng lũ chống chất kh&oacute; khăn&quot;</p>\r\n\r\n<p>Hướng về Miền Trung lu&ocirc;n c&oacute; sự đồng h&agrave;nh th&acirc;n thiết của Hải Ch&acirc;u trong nhiều năm qua v.v.v&hellip;Được sự chỉ đạo của đ/c B&iacute; thư Đảng ủy, Tổng gi&aacute;m đốc C&ocirc;ng ty, Đảng bộ, C&ocirc;ng đo&agrave;n, Đo&agrave;n Thanh ni&ecirc;n sự thống nhất Ban l&atilde;nh đạo C&ocirc;ng ty, BCH C&ocirc;ng đo&agrave;n c&ocirc;ng ty đ&atilde; th&ocirc;ng b&aacute;o trong to&agrave;n c&ocirc;ng ty quy&ecirc;n g&oacute;p được 100% c&aacute;n bộ c&ocirc;ng nh&acirc;n vi&ecirc;n c&ocirc;ng ty tham gia ủng hộ.</p>\r\n\r\n<p>C&ocirc;ng ty đ&atilde; tổ chức c&aacute;c chuyến đi thăm hỏi, tặng qu&agrave; cho đồng b&agrave;o bị thiệt hại mưa lũ tại Miền Trung trong đợt mưa lũ vừa qua, trực tiếp l&agrave; c&aacute;c tỉnh từ Nghệ an, H&agrave; Tĩnh, Quảng B&igrave;nh, Qu&agrave;ng Trị... Nhiều địa phương đ&atilde; ngập trong biển nước, l&agrave;m thiệt hại v&ocirc; c&ugrave;ng lớn về người v&agrave; t&agrave;i sản.</p>\r\n\r\n<p>Ng&agrave;y 24/10/2016, C&ocirc;ng ty đ&atilde; tặng gần 100 suất qu&agrave; gồm tiền v&agrave; c&aacute;c sản phẩm của c&ocirc;ng ty sản xuất như bột canh Hải Ch&acirc;u, b&aacute;nh kẹo v&agrave; lương kh&ocirc; 5+ ...đồng h&agrave;nh c&ugrave;ng c&aacute;c anh chị trong c&ocirc;ng ty đi đến c&aacute;c x&atilde; c&oacute; c&aacute;c hộ bị ảnh hưởng (nhưng &iacute;t c&oacute; c&aacute;c đo&agrave;n cứu trợ đến tặng qu&agrave;) mới thấm nỗi l&ograve;ng của người đi thiện nguyện v&agrave; c&aacute;n bộ dưới x&atilde;, th&ocirc;n đ&atilde; lăn lộn c&ugrave;ng c&aacute;c đo&agrave;n thiện nguyện trong việc triển khai lựa chọn, bố tr&iacute; trao qu&agrave; đ&uacute;ng đối tượng. Vui v&igrave; b&agrave; con c&oacute; qu&agrave; th&ecirc;m v&agrave;o khắc phục phần n&agrave;o thiệt hại, buồn v&igrave; thấy khi cơn lũ đi qua đời sống b&agrave; con th&ecirc;m phần kh&oacute; khăn. Cảm ơn C&ocirc;ng ty CP B&aacute;nh kẹo Hải Ch&acirc;u đ&atilde; đem đến nụ cười cho người d&acirc;n c&aacute;c nơi đến. Cảm ơn Tập đo&agrave;n Ph&uacute; T&agrave;i Đức đ&atilde; tạo điều kiện cho đo&agrave;n c&oacute; chỗ nghỉ ngơi sạch đẹp. Cảm ơn sự chu đ&aacute;o của c&aacute;c anh chị đi thiện nguyện tại địa phương đồng h&agrave;nh c&ugrave;ng đo&agrave;n.</p>\r\n\r\n<p><img alt=\"null\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/19/600x600/1491810332-1.jpg\" /></p>\r\n\r\n<p>Cảm ơn Chi nh&aacute;nh c&ocirc;ng ty tại Nghệ An ng&agrave;y 19/10/2016 đ&atilde; c&ugrave;ng đại l&yacute; L&acirc;m B&acirc;n -H&agrave; Tĩnh kịp thời đưa những tấm l&ograve;ng Hải Ch&acirc;u đến với miền Trung ruột thịt.</p>\r\n\r\n<p><img alt=\"null\" src=\"http://project.vn/KHAC/haichau.com.vn/uploads/thumbs/news/19/600x600/1491810336-2.jpg\" /></p>\r\n\r\n<p>Mong cộng đồng tiếp tục quan t&acirc;m gi&uacute;p đỡ b&agrave; con v&ugrave;ng lũ, c&aacute;c hộ ch&iacute;nh s&aacute;ch, kh&oacute; khăn..v&agrave; c&ugrave;ng chia sẻ tấm l&ograve;ng với &ldquo;The Kindness - Việc tử tế&rdquo; tại trang facebook: https://www.facebook.com/TheKindnessViecTuTe1/</p>\r\n', '1491810332-1.jpg', 'a:2:{i:0;s:16:\"1491810332-1.jpg\";i:1;s:16:\"1491810336-2.jpg\";}', '1', '33', 'Tin tức', '1', '1', 'Hải Châu chia sẻ cùng đồng bào miền Trung mùa lũ', 'Hải Châu chia sẻ cùng đồng bào miền Trung mùa lũ', 'Hải Châu chia sẻ cùng đồng bào miền Trung mùa lũ', '1491810332', 'admin', '1491835877', 'admin');

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
INSERT INTO `web_order` VALUES ('11', 'Nguyễn tien huan', '0902868001', 'nguyentienhuanl@gmail.com', '98-108 cmt8, p.7, q.3, hcm', 'Ngay 18/01/2016 ngay nhan hang', '634', '350000', '1', '15000', '0', '0', null, '32', 'Công ty CP Gilos', '1', '1', null, '0', '1484617031');
INSERT INTO `web_order` VALUES ('12', 'Nguyễn tien huan', '0902868001', 'nguyentienhuanl@gmail.com', '98-108 cmt8, p.7, q.3, hcm', 'Ngay 18/01/2016 ngay nhan hang', '634', '350000', '1', '15000', '1', '0', null, '32', 'Công ty CP Gilos', '2', '1', null, '0', '1484617048');
INSERT INTO `web_order` VALUES ('13', 'Nguyễn thị thu ', '0972179586', '', 'Số nha51 thôn bến Trung, xã Bắc hồng , huyện Đông Anh Hà nội', '', '658', '600000', '1', '15000', '2', '0', null, '63', 'Sữa non T470', '3', '0', null, '0', '1485356198');
INSERT INTO `web_order` VALUES ('14', 'Lê Hằng', '0932366081', '', '521 kim mã', 'Giao hàng h hành chính', '802', '550000', '8', '15000', '3', '0', null, '74', 'Đồ Gia Dụng ', '4', '0', null, '0', '1486874186');
INSERT INTO `web_order` VALUES ('15', 'Hải Nam', '0913922986', 'nguyenduypt86@gmail.com', '483 Nguyễn Khang Cầu giấy Hà Nội', 'Test đơn nhận mail.', '865', '350000', '1', '15000', '4', '0', null, '55', 'Siêu thị gia đình', '1', '0', null, '0', '1487303589');
INSERT INTO `web_order` VALUES ('16', 'Hải Nam', '0913922986', 'nguyenduypt86@gmail.com', '483 Nguyễn Khang Cầu giấy Hà Nội', 'Testing...', '865', '350000', '1', '15000', '0', '0', null, '55', 'Siêu thị gia đình', '1', '0', null, '0', '1487304103');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_product
-- ----------------------------
INSERT INTO `web_product` VALUES ('1', '', 'sản phẩm test', '1', '500000', '600000', '400000', '0', '1', '<p>m&ocirc; tả ngắn</p>\r\n', '<p>th&ocirc;ng tin chi tiết</p>\r\n\r\n<p><img alt=\"sản phẩm test\" src=\"http://localhost/banhkeohaichau/uploads/thumbs/product/1/600x600/1491273324-573cb4258e810763aa000001.jpg\" /></p>\r\n\r\n<p><img alt=\"sản phẩm test\" src=\"http://localhost/banhkeohaichau/uploads/thumbs/product/1/600x600/1491273770-9572042c1a3f27.jpg\" /></p>\r\n', 'thông tin khuyến mại', '1491273324-573cb4258e810763aa000001.jpg', '1491273324-573cb4258e810763aa000001.jpg', 'a:3:{i:0;s:39:\"1491273324-573cb4258e810763aa000001.jpg\";i:1;s:29:\"1491273770-9572042c1a3f27.jpg\";i:2;s:39:\"1491273770-57355c1302b01f7898000001.jpg\";}', '100', '0', '1', '4', 'Hàng đức', '0', '0', '1', '0', '1', '1', '1', '2', 'admin', '1491272625', '2', 'admin', '1491275505');
INSERT INTO `web_product` VALUES ('2', '', 'Sản phẩm 2', '1', '350000', '450000', '300000', '0', '1', '<p>m&ocirc; tả ngắn</p>\r\n', '<p>chi tiết</p>\r\n', '', '1491359509-57355c1302b01f7898000001.jpg', '1491359509-57355c1302b01f7898000001.jpg', 'a:1:{i:0;s:39:\"1491359509-57355c1302b01f7898000001.jpg\";}', '100', '0', '1', '4', 'Hàng đức', '0', '0', '1', '0', '1', '1', '1', '2', 'admin', '1491359509', '2', 'admin', '1491359512');

-- ----------------------------
-- Table structure for web_provider
-- ----------------------------
DROP TABLE IF EXISTS `web_provider`;
CREATE TABLE `web_provider` (
  `provider_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Tên nhà cung cấp',
  `provider_phone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `provider_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `provider_email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `provider_shop_id` int(11) DEFAULT NULL COMMENT 'ID shop của nhà cung cấp',
  `provider_shop_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `provider_status` tinyint(2) DEFAULT '1' COMMENT '0: không hoạt động, 1: đang hoạt động',
  `provider_note` tinytext CHARACTER SET utf8,
  `provider_time_creater` int(11) DEFAULT NULL,
  PRIMARY KEY (`provider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_provider
-- ----------------------------
INSERT INTO `web_provider` VALUES ('1', 'giầy dép đẹp', '0938413368', 'Địa chỉ của nhà cung cấp', 'manquynh@gmail.com', '6', 'Hàng xách tay', '1', 'Ghi chú của NCC', '1473675484');
INSERT INTO `web_provider` VALUES ('3', 'Lê Công Tài - Nguyễn Thị Trà', 'áda', 'adasd', 'ádasd', '55', 'Siêu thị gia đình', '1', 'ádasd', '1473737136');

-- ----------------------------
-- Table structure for web_province
-- ----------------------------
DROP TABLE IF EXISTS `web_province`;
CREATE TABLE `web_province` (
  `province_id` int(11) NOT NULL AUTO_INCREMENT,
  `province_name` varchar(255) NOT NULL,
  `province_position` tinyint(4) NOT NULL,
  `province_status` varchar(20) NOT NULL,
  `province_area` tinyint(4) NOT NULL COMMENT 'Vùng miền của tỉnh thành',
  PRIMARY KEY (`province_id`),
  KEY `position` (`province_position`),
  KEY `status` (`province_status`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_province
-- ----------------------------
INSERT INTO `web_province` VALUES ('3', 'Bạc Liêu', '6', '1', '3');
INSERT INTO `web_province` VALUES ('4', 'Bắc Cạn', '7', '1', '1');
INSERT INTO `web_province` VALUES ('5', 'Bắc Giang', '6', '1', '1');
INSERT INTO `web_province` VALUES ('6', 'Bắc Ninh', '7', '1', '1');
INSERT INTO `web_province` VALUES ('7', 'Bến Tre', '8', '1', '3');
INSERT INTO `web_province` VALUES ('8', 'Bình Dương', '9', '1', '3');
INSERT INTO `web_province` VALUES ('9', 'Bình Định', '10', '1', '2');
INSERT INTO `web_province` VALUES ('10', 'Bình Phước', '11', '1', '2');
INSERT INTO `web_province` VALUES ('11', 'Bình Thuận', '12', '1', '2');
INSERT INTO `web_province` VALUES ('12', 'Cà Mau', '13', '1', '3');
INSERT INTO `web_province` VALUES ('13', 'Cao Bằng', '14', '1', '1');
INSERT INTO `web_province` VALUES ('14', 'Cần Thơ', '8', '1', '3');
INSERT INTO `web_province` VALUES ('15', 'Đà Nẵng', '3', '1', '2');
INSERT INTO `web_province` VALUES ('17', 'Đồng Nai', '18', '1', '3');
INSERT INTO `web_province` VALUES ('18', 'Đồng Tháp', '19', '1', '3');
INSERT INTO `web_province` VALUES ('19', 'Gia Lai', '20', '1', '2');
INSERT INTO `web_province` VALUES ('20', 'Hà Giang', '21', '1', '1');
INSERT INTO `web_province` VALUES ('21', 'Hà Nam', '22', '1', '1');
INSERT INTO `web_province` VALUES ('22', 'Hà Nội', '1', '1', '1');
INSERT INTO `web_province` VALUES ('23', 'Hà Tây', '24', '1', '1');
INSERT INTO `web_province` VALUES ('24', 'Hà Tĩnh', '25', '1', '2');
INSERT INTO `web_province` VALUES ('25', 'Hải Dương', '26', '1', '1');
INSERT INTO `web_province` VALUES ('26', 'Hải Phòng', '5', '1', '1');
INSERT INTO `web_province` VALUES ('27', 'Hòa Bình', '28', '1', '1');
INSERT INTO `web_province` VALUES ('28', 'Hưng Yên', '29', '1', '1');
INSERT INTO `web_province` VALUES ('29', 'TP Hồ Chí Minh', '2', '1', '3');
INSERT INTO `web_province` VALUES ('30', 'Khánh Hòa', '31', '1', '2');
INSERT INTO `web_province` VALUES ('31', 'Kiên Giang', '32', '1', '3');
INSERT INTO `web_province` VALUES ('32', 'Kon Tum', '33', '1', '2');
INSERT INTO `web_province` VALUES ('33', 'Lai Châu', '34', '1', '1');
INSERT INTO `web_province` VALUES ('34', 'Lạng Sơn', '35', '1', '1');
INSERT INTO `web_province` VALUES ('35', 'Lào Cai', '36', '1', '1');
INSERT INTO `web_province` VALUES ('36', 'Lâm Đồng', '37', '1', '2');
INSERT INTO `web_province` VALUES ('37', 'Long An', '38', '1', '3');
INSERT INTO `web_province` VALUES ('38', 'Nam Định', '39', '1', '1');
INSERT INTO `web_province` VALUES ('39', 'Nghệ An', '40', '1', '2');
INSERT INTO `web_province` VALUES ('40', 'Ninh Bình', '41', '1', '1');
INSERT INTO `web_province` VALUES ('41', 'Ninh Thuận', '42', '1', '2');
INSERT INTO `web_province` VALUES ('42', 'Phú Thọ', '43', '1', '1');
INSERT INTO `web_province` VALUES ('43', 'Phú Yên', '44', '1', '2');
INSERT INTO `web_province` VALUES ('44', 'Quảng Bình', '45', '1', '2');
INSERT INTO `web_province` VALUES ('45', 'Quảng Nam', '46', '1', '2');
INSERT INTO `web_province` VALUES ('46', 'Quảng Ngãi', '47', '1', '2');
INSERT INTO `web_province` VALUES ('47', 'Quảng Ninh', '7', '1', '1');
INSERT INTO `web_province` VALUES ('48', 'Quảng Trị', '49', '1', '2');
INSERT INTO `web_province` VALUES ('49', 'Sóc Trăng', '50', '1', '3');
INSERT INTO `web_province` VALUES ('50', 'Sơn La', '51', '1', '1');
INSERT INTO `web_province` VALUES ('51', 'Tây Ninh', '52', '1', '3');
INSERT INTO `web_province` VALUES ('52', 'Thái Bình', '53', '1', '1');
INSERT INTO `web_province` VALUES ('53', 'Thái Nguyên', '54', '1', '1');
INSERT INTO `web_province` VALUES ('54', 'Thanh Hóa', '55', '1', '1');
INSERT INTO `web_province` VALUES ('55', 'Thừa Thiên Huế', '56', '1', '2');
INSERT INTO `web_province` VALUES ('56', 'Tiền Giang', '57', '1', '3');
INSERT INTO `web_province` VALUES ('57', 'Trà Vinh', '58', '1', '3');
INSERT INTO `web_province` VALUES ('58', 'Tuyên Quang', '59', '1', '1');
INSERT INTO `web_province` VALUES ('59', 'Vĩnh Long', '60', '1', '3');
INSERT INTO `web_province` VALUES ('60', 'Vĩnh Phúc', '61', '1', '1');
INSERT INTO `web_province` VALUES ('61', 'Yên Bái', '62', '1', '1');
INSERT INTO `web_province` VALUES ('66', 'An giang', '62', '1', '3');
INSERT INTO `web_province` VALUES ('67', 'Vũng Tàu', '6', '1', '3');
INSERT INTO `web_province` VALUES ('68', 'Nha Trang', '4', '1', '0');
INSERT INTO `web_province` VALUES ('69', 'Điện Biên', '0', '0', '0');
INSERT INTO `web_province` VALUES ('70', 'Hậu Giang', '15', '1', '0');

-- ----------------------------
-- Table structure for web_size_image
-- ----------------------------
DROP TABLE IF EXISTS `web_size_image`;
CREATE TABLE `web_size_image` (
  `size_img_id` int(11) NOT NULL AUTO_INCREMENT,
  `size_img_name` varchar(255) DEFAULT NULL,
  `size_img_width` int(10) DEFAULT '0',
  `size_img_height` int(10) DEFAULT '0',
  `size_img_status` tinyint(5) DEFAULT '0',
  PRIMARY KEY (`size_img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_size_image
-- ----------------------------
INSERT INTO `web_size_image` VALUES ('1', 'dang test', '150', '300', '1');
INSERT INTO `web_size_image` VALUES ('2', 'dang test', '155', '300', '1');
INSERT INTO `web_size_image` VALUES ('3', 'dang test 222', '152344', '234234', '1');
INSERT INTO `web_size_image` VALUES ('4', 'dang test 222', '150', '250', '1');

-- ----------------------------
-- Table structure for web_type_setting
-- ----------------------------
DROP TABLE IF EXISTS `web_type_setting`;
CREATE TABLE `web_type_setting` (
  `type_id` int(10) NOT NULL AUTO_INCREMENT,
  `type_title` varchar(255) DEFAULT NULL,
  `type_infor` text,
  `type_keyword` varchar(255) DEFAULT NULL,
  `type_group` varchar(255) DEFAULT NULL COMMENT 'Nhóm các thuộc tính cùng nhau',
  `type_order` int(10) DEFAULT '0',
  `type_status` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_type_setting
-- ----------------------------
INSERT INTO `web_type_setting` VALUES ('1', 'Kiểu chuyên mục', 'định nghĩa kiểu khoa hay trung tâm ', 'type_khoa', 'group_type', '1', '1');
INSERT INTO `web_type_setting` VALUES ('3', 'Giao diện trang chủ', 'kiểu hiển thị page', 'layouts_home', 'group_layouts', '3', '1');
INSERT INTO `web_type_setting` VALUES ('5', 'Danh mục sản phẩm', 'Danh mục sản phẩm', 'category_product', 'group_category', '0', '1');
INSERT INTO `web_type_setting` VALUES ('6', 'Danh mục tin tức', 'Danh mục tin tức', 'category_news', 'group_category', '0', '1');

-- ----------------------------
-- Table structure for web_video
-- ----------------------------
DROP TABLE IF EXISTS `web_video`;
CREATE TABLE `web_video` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `video_name_alias` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `video_sort_desc` text CHARACTER SET utf8,
  `video_content` text CHARACTER SET utf8,
  `video_link` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `video_file` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `video_img` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `video_img_temp` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `video_status` tinyint(5) DEFAULT NULL,
  `video_view` int(11) DEFAULT '0' COMMENT 'lượt view xem video tren site',
  `video_hot` tinyint(4) DEFAULT NULL,
  `video_time_creater` int(11) DEFAULT '0',
  `video_category` int(10) DEFAULT NULL,
  `type_language` tinyint(5) DEFAULT '1',
  `video_time_update` int(11) DEFAULT '0',
  `video_meta_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `video_meta_keyword` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `video_meta_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_video
-- ----------------------------
INSERT INTO `web_video` VALUES ('1', 'Khai thác quặng Quaczit trên sông chảy - Bảo Nhai - Bắc Hà - Lào Cai', 'khai-thac-quang-quaczit-tren-song-chay-bao-nhai-bac-ha-lao-cai', 'Khai thác quặng Quaczit trên sông chảy - Bảo Nhai - Bắc Hà - Lào Cai', '<p>Khai th&aacute;c quặng Quaczit tr&ecirc;n s&ocirc;ng chảy - Bảo Nhai - Bắc H&agrave; - L&agrave;o Cai</p>\r\n', 'https://www.youtube.com/watch?v=5eRaOPJqklg', '', '10-54-44-16-08-2016-426631.jpg', null, '1', '0', '1', '1470872365', '19', '1', '1471363174', 'Khai thác quặng Quaczit trên sông chảy - Bảo Nhai - Bắc Hà - Lào Cai', 'Khai thác quặng Quaczit trên sông chảy - Bảo Nhai - Bắc Hà - Lào Cai', 'Khai thác quặng Quaczit trên sông chảy - Bảo Nhai - Bắc Hà - Lào Cai');
INSERT INTO `web_video` VALUES ('2', 'Khai thác quặng đồng lộ thiên ', 'khai-thac-quang-dong-lo-thien', 'Khai thác quặng đồng lộ thiên ', '<p>Khai th&aacute;c quặng đồng lộ thi&ecirc;n</p>\r\n', 'https://www.youtube.com/watch?v=4LtujnxxOic', '11-51-17-16-08-2016-khai-thac-quang-dong-lo-thien.mp4', '11-02-14-16-08-2016-2.jpg', null, '1', '0', '1', '1471363334', '19', '1', '1471369027', 'Khai thác quặng đồng lộ thiên ', 'Khai thác quặng đồng lộ thiên ', 'Khai thác quặng đồng lộ thiên ');
