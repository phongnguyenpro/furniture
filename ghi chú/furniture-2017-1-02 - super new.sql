/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : furniture

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2017-01-02 21:07:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `articles_id` int(255) NOT NULL AUTO_INCREMENT,
  `articles_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `articles_description` text COLLATE utf8_unicode_ci,
  `articles_content` text COLLATE utf8_unicode_ci,
  `articles_slug` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `articles_date_create` datetime DEFAULT NULL,
  `articles_avatar` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `articles_index` int(255) DEFAULT NULL,
  `articles_show` int(1) DEFAULT NULL,
  `articles_feature` int(1) DEFAULT NULL,
  `articles_view` int(100) DEFAULT NULL,
  `articles_like` int(100) DEFAULT NULL,
  `articles_new` int(1) DEFAULT NULL,
  PRIMARY KEY (`articles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('8', 'gfdgd asdasd', 'gdfgdf', 'gdfgdf{readmore}dasdasdasdasdasd', 'gfdgd-asdasd', '2016-12-17 22:20:13', 'gfdgd-asdasd-921481906265.jpg', '1', '1', '1', '0', '0', null);
INSERT INTO `articles` VALUES ('10', 'gdfgfdg', ',hj,hjhj,hj,hmhfg', ',hj,hjhj,hj,hmhfg{readmore}hdfgdfgdfgdgdfg', 'gdfgfdg', '2016-12-17 22:59:14', 'gdfgfdg-61481990354.jpg', '2', '1', '0', '0', '0', null);

-- ----------------------------
-- Table structure for articlescategory
-- ----------------------------
DROP TABLE IF EXISTS `articlescategory`;
CREATE TABLE `articlescategory` (
  `articlescategory_id` int(255) NOT NULL AUTO_INCREMENT,
  `articlescategory_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `articlescategory_slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `articlescategory_parent` int(255) DEFAULT NULL,
  `articlescategory_index` int(255) DEFAULT NULL,
  `articlescategory_icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`articlescategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of articlescategory
-- ----------------------------
INSERT INTO `articlescategory` VALUES ('6', 'ab', 'ab', '0', '2', '');
INSERT INTO `articlescategory` VALUES ('7', 'bvf', 'bvf', '0', '1', '');

-- ----------------------------
-- Table structure for articlescategory_detail
-- ----------------------------
DROP TABLE IF EXISTS `articlescategory_detail`;
CREATE TABLE `articlescategory_detail` (
  `articles_id` int(255) DEFAULT NULL,
  `articlescategory_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of articlescategory_detail
-- ----------------------------
INSERT INTO `articlescategory_detail` VALUES ('8', '7');
INSERT INTO `articlescategory_detail` VALUES ('10', '7');

-- ----------------------------
-- Table structure for articles_tag
-- ----------------------------
DROP TABLE IF EXISTS `articles_tag`;
CREATE TABLE `articles_tag` (
  `articles_id` int(255) DEFAULT NULL,
  `tag_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of articles_tag
-- ----------------------------
INSERT INTO `articles_tag` VALUES ('1', '7');
INSERT INTO `articles_tag` VALUES ('1', '1');
INSERT INTO `articles_tag` VALUES ('8', '1');

-- ----------------------------
-- Table structure for attr_val
-- ----------------------------
DROP TABLE IF EXISTS `attr_val`;
CREATE TABLE `attr_val` (
  `attr_val_id` int(225) NOT NULL AUTO_INCREMENT,
  `productattr_id` int(225) DEFAULT NULL,
  `attr_val_value` text,
  `attr_val_index` int(255) DEFAULT NULL,
  `attr_val_label` varchar(100) DEFAULT NULL,
  `attr_val_date_update` datetime DEFAULT NULL,
  `attr_val_user_update` int(100) DEFAULT NULL,
  PRIMARY KEY (`attr_val_id`),
  KEY `id_thuoctinhchon` (`productattr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of attr_val
-- ----------------------------
INSERT INTO `attr_val` VALUES ('1', '1', 'red', '1', 'red', '2016-12-03 14:45:55', null);
INSERT INTO `attr_val` VALUES ('2', '1', 'tím', '2', 'purple', null, null);
INSERT INTO `attr_val` VALUES ('4', '3', 'Gỗ', '1', 'Gỗ', null, null);
INSERT INTO `attr_val` VALUES ('5', '3', 'Thủy tinh', '2', 'Thủy tinh', null, null);
INSERT INTO `attr_val` VALUES ('6', '3', 'Inox', '3', 'Inox', null, null);
INSERT INTO `attr_val` VALUES ('7', '3', 'Nỉ', '4', 'Nỉ', null, null);

-- ----------------------------
-- Table structure for career
-- ----------------------------
DROP TABLE IF EXISTS `career`;
CREATE TABLE `career` (
  `career_id` int(11) NOT NULL AUTO_INCREMENT,
  `career_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `career_index` int(100) DEFAULT NULL,
  `career_date_update` datetime DEFAULT NULL,
  `career_user_update` int(100) DEFAULT NULL,
  PRIMARY KEY (`career_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of career
-- ----------------------------
INSERT INTO `career` VALUES ('1', 'Đồi nội thất', '1', '2017-01-02 21:03:31', null);

-- ----------------------------
-- Table structure for fee_shipping
-- ----------------------------
DROP TABLE IF EXISTS `fee_shipping`;
CREATE TABLE `fee_shipping` (
  `fee_shipping_id` int(11) NOT NULL,
  `fee_shipping_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee_shipping_parent` int(11) DEFAULT NULL,
  `fee_shipping_index` int(11) DEFAULT NULL,
  `fee_shipping_value` float DEFAULT NULL,
  PRIMARY KEY (`fee_shipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of fee_shipping
-- ----------------------------

-- ----------------------------
-- Table structure for invoice
-- ----------------------------
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `invoice_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `invoice_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_date_create` datetime DEFAULT NULL,
  `invoice_date_pay` datetime DEFAULT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_type_pay` int(1) DEFAULT NULL,
  `invoice_note` text COLLATE utf8_unicode_ci,
  `invoice_total_discount` int(10) DEFAULT NULL,
  `invoice_amout` double DEFAULT NULL,
  `invoice_status` int(1) DEFAULT NULL,
  `user_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_money_plus` double(100,0) DEFAULT NULL,
  `invoice_note_money_plus` text COLLATE utf8_unicode_ci,
  `invoice_money_subtract` double(100,0) DEFAULT NULL,
  `invoice_note_money_subtract` text COLLATE utf8_unicode_ci,
  `invoice_protect_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_discount_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_shipping_status` int(1) DEFAULT NULL,
  `invoice_deal_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_discount_value` int(11) DEFAULT NULL,
  `distance_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of invoice
-- ----------------------------

-- ----------------------------
-- Table structure for invoice_detail
-- ----------------------------
DROP TABLE IF EXISTS `invoice_detail`;
CREATE TABLE `invoice_detail` (
  `invoice_detail_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_id` int(255) DEFAULT NULL,
  `product_id` int(255) DEFAULT NULL,
  `product_detail_id` int(255) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `attr_val_ids` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_detail_discount` int(3) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `product_avatar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attr_val_labels` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id_agency` int(100) DEFAULT NULL,
  PRIMARY KEY (`invoice_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of invoice_detail
-- ----------------------------

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(100) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_parent` int(100) DEFAULT NULL,
  `menu_index` int(10) DEFAULT NULL,
  `menu_type` int(1) DEFAULT NULL,
  `menu_format` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_slug` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_date_update` datetime DEFAULT NULL,
  `menu_user_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Home', '0', null, '1', 'link', '/', null, null);
INSERT INTO `menu` VALUES ('2', 'Shop', '0', '1', '1', 'productcat', './', null, null);

-- ----------------------------
-- Table structure for module
-- ----------------------------
DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `module_id` int(100) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_location` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_index` int(10) DEFAULT NULL,
  `module_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_config` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of module
-- ----------------------------
INSERT INTO `module` VALUES ('2', 'Nổi bật', 'product 1', 'main', '1', 'product', 'a:2:{s:19:\"module_product_type\";s:3:\"hot\";s:20:\"module_product_limit\";s:2:\"10\";}');
INSERT INTO `module` VALUES ('3', 'Slider 1', 'Slider 1', 'main', '1', 'slider', 'a:3:{i:0;a:2:{s:12:\"module_image\";s:43:\"public/upload/images/slider/sl_1%5B1%5D.png\";s:11:\"module_link\";s:3:\"abc\";}i:1;a:2:{s:12:\"module_image\";s:36:\"public/upload/images/slider/sl_2.png\";s:11:\"module_link\";s:3:\"abc\";}i:2;a:2:{s:12:\"module_image\";s:36:\"public/upload/images/slider/sl_3.png\";s:11:\"module_link\";s:3:\"abc\";}}');
INSERT INTO `module` VALUES ('4', 'Quan cao product', 'Quan cao product', 'main', '1', 'banner', 'a:1:{i:0;a:2:{s:12:\"module_image\";s:50:\"public/upload/images/banner/banner-cate%5B1%5D.png\";s:11:\"module_link\";s:3:\"abc\";}}');
INSERT INTO `module` VALUES ('6', 'all', '', 'header', '454', 'slider', null);
INSERT INTO `module` VALUES ('7', 'Quan cao product', 'Quan cao product', 'main', '2', 'banner', 'a:1:{i:0;a:2:{s:12:\"module_image\";s:39:\"public/upload/images/banner/Capture.PNG\";s:11:\"module_link\";s:1:\"2\";}}');
INSERT INTO `module` VALUES ('8', 'Quan cao product slider', 'Quan cao product slider', 'main', '1', 'banner', 'a:3:{i:0;a:2:{s:12:\"module_image\";s:41:\"public/upload/images/banner/banner1-1.jpg\";s:11:\"module_link\";s:2:\"  \";}i:1;a:2:{s:12:\"module_image\";s:41:\"public/upload/images/banner/banner1-2.jpg\";s:11:\"module_link\";s:1:\" \";}i:2;a:2:{s:12:\"module_image\";s:41:\"public/upload/images/banner/banner1-3.jpg\";s:11:\"module_link\";s:1:\" \";}}');
INSERT INTO `module` VALUES ('9', 'Đang bán chạy', 'Đang bán chạy', 'main', '2', 'product', 'a:2:{s:19:\"module_product_type\";s:7:\"selling\";s:20:\"module_product_limit\";s:2:\"10\";}');
INSERT INTO `module` VALUES ('10', 'Đang giảm giá', 'Đang giảm giá', 'main', '3', 'product', 'a:2:{s:19:\"module_product_type\";s:4:\"sale\";s:20:\"module_product_limit\";s:2:\"10\";}');

-- ----------------------------
-- Table structure for module_detail
-- ----------------------------
DROP TABLE IF EXISTS `module_detail`;
CREATE TABLE `module_detail` (
  `module_id` int(100) DEFAULT NULL,
  `module_detail_page` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of module_detail
-- ----------------------------
INSERT INTO `module_detail` VALUES ('3', 'home');
INSERT INTO `module_detail` VALUES ('4', 'productcategory');
INSERT INTO `module_detail` VALUES ('6', '-1');
INSERT INTO `module_detail` VALUES ('8', 'home');
INSERT INTO `module_detail` VALUES ('2', 'home');
INSERT INTO `module_detail` VALUES ('9', 'home');
INSERT INTO `module_detail` VALUES ('7', 'home');
INSERT INTO `module_detail` VALUES ('10', 'home');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` bigint(255) NOT NULL AUTO_INCREMENT,
  `career_id` int(11) DEFAULT NULL,
  `product_code` varchar(100) DEFAULT NULL,
  `product_name` varchar(150) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `product_total` int(10) DEFAULT NULL,
  `product_content` text,
  `product_description` text,
  `product_unit` varchar(20) DEFAULT NULL,
  `product_index` bigint(225) DEFAULT NULL,
  `product_show` int(1) DEFAULT NULL,
  `product_slug` varchar(100) DEFAULT NULL,
  `product_date_create` datetime DEFAULT NULL,
  `product_avatar` varchar(150) DEFAULT NULL,
  `product_sale` int(10) DEFAULT NULL,
  `product_date_sale` datetime DEFAULT NULL,
  `product_view` int(100) DEFAULT NULL,
  `product_feature` int(1) DEFAULT NULL,
  `product_like` int(100) DEFAULT NULL,
  `product_selling` int(1) DEFAULT NULL,
  `product_new` int(1) DEFAULT NULL,
  `product_search` varchar(255) DEFAULT NULL,
  `product_date_update` datetime DEFAULT NULL,
  `product_user_update` int(100) DEFAULT NULL,
  `product_delete` int(1) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `id_nganhnghe` (`career_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('32', '1', ' NDT2810', 'Sofa da thật', '33333333', '100', '<h2>Mẫu sofa da thật cao cấp mới nhất 2016<br />\r\n{readmore}<br />\r\nC&aacute;c mẫu&nbsp;<a href=\"http://nhaxinhplaza.vn/tag/sofa-da-that.html\" style=\"font-size: 13px;\"><strong>ghế sofa da thật</strong></a><span style=\"font-size:13px\">&nbsp;thiết kế đẹp mắt, chất liệu sử dụng được lựa chọn cẩn thận, kiểu d&aacute;ng đặt linh hoạt th&iacute;ch hợp cho nhiều dạng kh&ocirc;ng gian nội thất &nbsp;kh&aacute;c nhau. Bộ&nbsp;Sofa da thật m&atilde; NDT2810 l&agrave; một trong những sản phẩm đ&aacute;p ứng rất nhiều ưu điểm quan trọng, gi&uacute;p bạn dễ d&agrave;ng đặt trong c&aacute;c gian ph&ograve;ng kh&aacute;ch, văn ph&ograve;ng c&ocirc;ng ty....</span></h2>\r\n', '<h2>Mẫu sofa da thật cao cấp mới nhất 2016<br />\r\n', 'bộ', null, '1', 'sofa-da-that', '2016-12-05 05:11:17', 'sofa-da-that-12721480889443.jpg', '0', null, '1', '2', '0', '2', '2', 'sofa da that 33333333', '2016-12-05 05:11:17', null, null);
INSERT INTO `product` VALUES ('33', '1', 'NTX601', 'Sofa bán sẵn', '18500000', '200', 'Ghế sofa b&aacute;n tại Nội Thất Xinh lu&ocirc;n l&agrave; lựa chọn được ưu ti&ecirc;n mang đến cho kh&ocirc;ng gian nội thất trong căn nh&agrave; của bạn vẻ đẹp sang trọng v&agrave; gần gũ{readmore}<br />\r\nGhế sofa b&aacute;n tại Nội Thất Xinh lu&ocirc;n l&agrave; lựa chọn được ưu ti&ecirc;n mang đến cho kh&ocirc;ng gian nội thất trong căn nh&agrave; của bạn vẻ đẹp sang trọng v&agrave; gần gũi. Nếu bạn kh&ocirc;ng c&oacute; thời gian đặt mua sản phẩm sofa, h&atilde;y thử trải nghiệm với những&nbsp;<a href=\"http://nhaxinhplaza.vn/sofa-ban-san.html\">mẫu b&agrave;n ghế sofa b&aacute;n sẵn</a>&nbsp;tại showroom Nội Thất Xinh của ch&uacute;ng t&ocirc;i.\r\n\r\n<h2><strong>Mẫu sofa b&aacute;n sẵn NTX601 - Lựa chọn ho&agrave;n hảo cho kh&ocirc;ng gian tiện nghi</strong></h2>\r\n', 'Ghế sofa b&aacute;n tại Nội Thất Xinh lu&ocirc;n l&agrave; lựa chọn được ưu ti&ecirc;n mang đến cho kh&ocirc;ng gian nội thất trong căn nh&agrave; của bạn vẻ đẹp sang trọng v&agrave; gần gũ', 'bộ', null, '1', 'sofa-ban-san', '2016-12-05 00:00:00', 'sofa-ban-san-61821480889691.jpg', '0', null, '2', '2', '0', '1', '2', 'sofa b&aacute;n san 18500000', '2016-12-05 05:18:00', null, null);
INSERT INTO `product` VALUES ('34', '1', 'G24', 'Sofa phòng ngủ mã G24 Sofa phòng ngủ mã G24 Sofa phòng ngủ', '10400000', '100', 'Kh&ocirc;ng giống như những bộ&nbsp;<a href=\"http://nhaxinhplaza.vn/sofa.html\"><strong>ghế sofa</strong></a>&nbsp;th&ocirc;ng thường, chiếc ghế sofa ph&ograve;ng ngủ m&atilde; G24 t&ocirc;ng m&agrave;u hồng nhạt&nbsp;{readmore}<br />\r\nCung cấp h&agrave;ng trăm mẫu sofa tr&ecirc;n thị trường, Nội thất xinh lu&ocirc;n khẳng định thương hiệu của m&igrave;nh tới kh&aacute;ch h&agrave;ng kh&ocirc;ng chỉ ở chất lượng, m&agrave; c&ograve;n mẫu m&atilde;, kiểu d&aacute;ng v&agrave; gi&aacute; cả v&ocirc; c&ugrave;ng hấp dẫn.<a href=\"http://nhaxinhplaza.vn/sofa-phong-ngu.html\"><strong>Sofa ph&ograve;ng ngủ</strong></a>&nbsp;b&aacute;n sẵn tại&nbsp;<strong>showroom Nội thất xinh 321 Trường Chinh</strong>&nbsp;l&agrave; một v&iacute; dụ điển h&igrave;nh\r\n<h2><strong>Nội thất xinh b&aacute;n&nbsp;Sofa ph&ograve;ng ngủ m&atilde; G24&nbsp;</strong></h2>\r\nKh&ocirc;ng giống như những bộ&nbsp;<a href=\"http://nhaxinhplaza.vn/sofa.html\"><strong>ghế sofa</strong></a>&nbsp;th&ocirc;ng thường, chiếc ghế sofa ph&ograve;ng ngủ m&atilde; G24 t&ocirc;ng m&agrave;u hồng nhạt được thiết kế th&ocirc;ng minh, mang đến sự mới lạ, độc đ&aacute;o v&agrave; hấp dẫn c&oacute; thể k&eacute;o ra th&agrave;nh giường một c&aacute;ch dễ d&agrave;ng, thuận tiện cho việc bạn ngồi tiếp kh&aacute;ch, đọc b&aacute;o, xem tivi, khi mệt mỏi bạn c&oacute; thể k&eacute;o ra ngay lập tức n&oacute; sẽ biến h&oacute;a th&agrave;nh chiếc giường ngủ &ecirc;m &aacute;i, dễ chịu.', 'Kh&ocirc;ng giống như những bộ&nbsp;<a href=\"http://nhaxinhplaza.vn/sofa.html\"><strong>ghế sofa</strong></a>&nbsp;th&ocirc;ng thường, chiếc ghế sofa ph&ograve;ng ngủ m&atilde; G24 t&ocirc;ng m&agrave;u hồng nhạt&nbsp;', 'bộ', null, '1', 'sofa-phong-ngu-ma-g24-sofa-phong-ngu-ma-g24-sofa-phong-ngu', '2016-12-05 00:00:00', 'sofa-phong-ngu-ma-g24-sofa-phong-ngu-ma-g24-sofa-phong-ngu-60561480890379.jpg', '20', null, '11', '1', '0', '1', '1', 'sofa ph&ograve;ng ngu m&atilde; g24 sofa ph&ograve;ng ngu m&atilde; g24 sofa ph&ograve;ng ngu 10400000', '2016-12-05 05:37:56', null, null);

-- ----------------------------
-- Table structure for productattr
-- ----------------------------
DROP TABLE IF EXISTS `productattr`;
CREATE TABLE `productattr` (
  `productattr_id` int(225) NOT NULL AUTO_INCREMENT,
  `productattr_name` varchar(100) DEFAULT NULL,
  `productattr_index` int(255) DEFAULT NULL,
  `career_id` int(100) DEFAULT NULL,
  `productattr_showfilter` int(1) DEFAULT NULL,
  `productattr_date_update` datetime DEFAULT NULL,
  `productattr_user_update` int(100) DEFAULT NULL,
  PRIMARY KEY (`productattr_id`),
  KEY `id_ngonngu` (`productattr_date_update`),
  KEY `id_nganhnghe` (`career_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productattr
-- ----------------------------
INSERT INTO `productattr` VALUES ('1', 'Màu sắc', '1', '1', '1', '2016-12-03 14:45:54', null);
INSERT INTO `productattr` VALUES ('3', 'Chất liệu', '2', '1', '1', '2016-12-03 14:45:55', null);

-- ----------------------------
-- Table structure for productattr_detail
-- ----------------------------
DROP TABLE IF EXISTS `productattr_detail`;
CREATE TABLE `productattr_detail` (
  `product_detail_id` bigint(255) DEFAULT NULL,
  `product_id` bigint(255) DEFAULT NULL,
  `productattr_id` int(255) DEFAULT NULL,
  `attr_val_id` int(255) DEFAULT NULL,
  KEY `id_thuoctinhchon` (`productattr_id`),
  KEY `id_giatrithuoctinhchon` (`attr_val_id`),
  KEY `id_sanpham` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productattr_detail
-- ----------------------------
INSERT INTO `productattr_detail` VALUES ('-1', '33', '1', '1');
INSERT INTO `productattr_detail` VALUES ('-1', '33', '1', '2');
INSERT INTO `productattr_detail` VALUES ('-1', '33', '3', '4');
INSERT INTO `productattr_detail` VALUES ('-1', '33', '3', '5');
INSERT INTO `productattr_detail` VALUES ('-1', '33', '3', '6');
INSERT INTO `productattr_detail` VALUES ('-1', '34', '1', '1');
INSERT INTO `productattr_detail` VALUES ('-1', '34', '1', '2');
INSERT INTO `productattr_detail` VALUES ('-1', '34', '3', '7');

-- ----------------------------
-- Table structure for productcategory
-- ----------------------------
DROP TABLE IF EXISTS `productcategory`;
CREATE TABLE `productcategory` (
  `productcategory_id` int(100) NOT NULL AUTO_INCREMENT,
  `productcategory_name` varchar(100) DEFAULT NULL,
  `productcategory_parent` int(100) DEFAULT NULL,
  `productcategory_index` int(100) DEFAULT NULL,
  `productcategory_slug` varchar(100) DEFAULT NULL,
  `productcategory_icon` varchar(150) DEFAULT NULL,
  `productcategory_panel` varchar(255) DEFAULT NULL,
  `career_id` int(100) DEFAULT NULL,
  `productcategory_show` int(1) DEFAULT NULL,
  `productcategory_showmenu` int(1) DEFAULT NULL,
  `productcategory_date_update` datetime DEFAULT NULL,
  `productcategory_user_update` int(100) DEFAULT NULL,
  PRIMARY KEY (`productcategory_id`),
  KEY `id_nganhnghe` (`career_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productcategory
-- ----------------------------
INSERT INTO `productcategory` VALUES ('1', 'Nội thất hiện đại', '0', null, 'noi-that-hien-dai', 'http://wp.smartaddons.com/themes/sw_market/wp-content/uploads/2015/03/7.png', '', '1', '1', '2', '2016-12-05 06:12:57', null);
INSERT INTO `productcategory` VALUES ('2', 'Nội thất cổ điển', '0', '1', 'noi-that-co-dien', 'http://wp.smartaddons.com/themes/sw_market/wp-content/uploads/2015/03/13.png', '', '1', '1', '2', '2016-12-05 06:12:57', null);
INSERT INTO `productcategory` VALUES ('3', 'Nội thất phòng khách', '0', '2', 'noi-that-phong-khach', '', '', '1', '1', '2', '2016-12-05 06:12:57', null);
INSERT INTO `productcategory` VALUES ('4', 'Nội thất phòng ngủ', '0', '3', 'noi-that-phong-ngu', '', '', '1', '1', '2', '2016-12-05 06:12:57', null);
INSERT INTO `productcategory` VALUES ('7', 'Nội thất khách sạn', '0', '4', 'noi-that-khach-san', '', '', '1', '1', '2', '2016-12-05 06:12:57', null);
INSERT INTO `productcategory` VALUES ('11', 'Nội thất gỗ', '2', null, 'noi-that-go', '', null, '1', '1', null, '2016-12-05 06:12:57', null);
INSERT INTO `productcategory` VALUES ('12', 'Nội thất hoa văn', '2', '1', 'noi-that-hoa-van', '', null, '1', '1', null, '2016-12-05 06:12:57', null);

-- ----------------------------
-- Table structure for productcategory_detail
-- ----------------------------
DROP TABLE IF EXISTS `productcategory_detail`;
CREATE TABLE `productcategory_detail` (
  `product_id` bigint(255) DEFAULT NULL,
  `productcategory_id` int(255) DEFAULT NULL,
  KEY `id_sanpham` (`product_id`),
  KEY `id_danhmuc` (`productcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productcategory_detail
-- ----------------------------
INSERT INTO `productcategory_detail` VALUES ('32', '3');
INSERT INTO `productcategory_detail` VALUES ('32', '4');
INSERT INTO `productcategory_detail` VALUES ('32', '7');
INSERT INTO `productcategory_detail` VALUES ('33', '7');
INSERT INTO `productcategory_detail` VALUES ('34', '4');

-- ----------------------------
-- Table structure for product_detail
-- ----------------------------
DROP TABLE IF EXISTS `product_detail`;
CREATE TABLE `product_detail` (
  `product_detail_id` bigint(255) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(255) DEFAULT NULL,
  `product_detail_price` float(100,0) DEFAULT NULL,
  `product_detail_total` int(100) DEFAULT NULL,
  `product_detail_avatar` varchar(150) DEFAULT NULL,
  `product_detail_date_create` datetime DEFAULT NULL,
  `product_detail_date_update` datetime DEFAULT NULL,
  `product_detail_user_update` int(100) DEFAULT NULL,
  PRIMARY KEY (`product_detail_id`),
  KEY `id_sanpham` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_detail
-- ----------------------------

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `product_id` bigint(255) DEFAULT NULL,
  `product_images_name` varchar(150) DEFAULT NULL,
  `product_images_index` int(100) DEFAULT NULL,
  `product_images_id` bigint(255) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`product_images_id`),
  KEY `id_sanpham` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES ('32', 'sofa-da-that-71731480889448.jpg', '1', '239');

-- ----------------------------
-- Table structure for product_prop
-- ----------------------------
DROP TABLE IF EXISTS `product_prop`;
CREATE TABLE `product_prop` (
  `product_prop_id` int(255) NOT NULL AUTO_INCREMENT,
  `product_prop_name` varchar(100) DEFAULT NULL,
  `product_prop_index` int(100) DEFAULT NULL,
  `career_id` int(100) DEFAULT NULL,
  `product_prop_date_update` datetime DEFAULT NULL,
  `product_prop_user_update` int(100) DEFAULT NULL,
  PRIMARY KEY (`product_prop_id`),
  KEY `id_ngonngu` (`product_prop_date_update`),
  KEY `id_nganhnghe` (`career_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_prop
-- ----------------------------
INSERT INTO `product_prop` VALUES ('1', 'Xuất xứ', '1', '1', '2016-11-16 21:00:13', null);
INSERT INTO `product_prop` VALUES ('2', 'Bảo hành', '2', '1', '2016-12-05 05:05:13', null);
INSERT INTO `product_prop` VALUES ('3', 'Màu sắc', '3', '1', '2016-12-05 05:05:21', null);
INSERT INTO `product_prop` VALUES ('4', 'Chất liệu', '4', '1', '2016-12-05 05:05:29', null);
INSERT INTO `product_prop` VALUES ('5', 'Kích thước', '5', '1', '2016-12-05 05:05:34', null);
INSERT INTO `product_prop` VALUES ('6', 'Tình trạng', '6', '1', '2016-12-05 05:05:42', null);

-- ----------------------------
-- Table structure for product_prop_detail
-- ----------------------------
DROP TABLE IF EXISTS `product_prop_detail`;
CREATE TABLE `product_prop_detail` (
  `product_id` bigint(255) DEFAULT NULL,
  `product_prop_id` int(255) DEFAULT NULL,
  `product_prop_detail_value` text,
  KEY `id_thuoctinh` (`product_prop_id`),
  KEY `id_sanpham` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_prop_detail
-- ----------------------------
INSERT INTO `product_prop_detail` VALUES ('32', '1', 'Nội Thất Xinh');
INSERT INTO `product_prop_detail` VALUES ('32', '2', '7 năm');
INSERT INTO `product_prop_detail` VALUES ('32', '3', 'Vàng cam');
INSERT INTO `product_prop_detail` VALUES ('32', '4', ' Da Thật');
INSERT INTO `product_prop_detail` VALUES ('32', '5', '2820x1760x880');
INSERT INTO `product_prop_detail` VALUES ('32', '6', 'Đặt Hàng');
INSERT INTO `product_prop_detail` VALUES ('33', '1', 'Nội Thất Xinh');
INSERT INTO `product_prop_detail` VALUES ('33', '2', '6 năm');
INSERT INTO `product_prop_detail` VALUES ('33', '3', 'Màu đen');
INSERT INTO `product_prop_detail` VALUES ('33', '4', 'Vải Loki');
INSERT INTO `product_prop_detail` VALUES ('33', '5', '2750x1700x850');
INSERT INTO `product_prop_detail` VALUES ('33', '6', 'Có sẵn');
INSERT INTO `product_prop_detail` VALUES ('34', '1', 'Nội Thất Xinh');
INSERT INTO `product_prop_detail` VALUES ('34', '2', ' 6 năm');
INSERT INTO `product_prop_detail` VALUES ('34', '3', 'Màu sữa');
INSERT INTO `product_prop_detail` VALUES ('34', '4', ' Nỉ cao cấp');
INSERT INTO `product_prop_detail` VALUES ('34', '5', '1900*1800');
INSERT INTO `product_prop_detail` VALUES ('34', '6', 'Có sẵn');

-- ----------------------------
-- Table structure for product_tag
-- ----------------------------
DROP TABLE IF EXISTS `product_tag`;
CREATE TABLE `product_tag` (
  `product_id` bigint(255) DEFAULT NULL,
  `tag_id` int(255) DEFAULT NULL,
  KEY `id_sanpham` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_tag
-- ----------------------------
INSERT INTO `product_tag` VALUES ('33', '6');
INSERT INTO `product_tag` VALUES ('34', '6');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` int(100) NOT NULL AUTO_INCREMENT,
  `role_role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_controller` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_action` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_date_update` datetime DEFAULT NULL,
  `role_user_update` int(100) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=621 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('391', 'administrator', 'main', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('392', 'administrator', 'menu', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('393', 'administrator', 'menu', 'insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('394', 'administrator', 'menu', 'delete', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('395', 'administrator', 'menu', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('396', 'administrator', 'menu', 'load_menu_edit', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('397', 'administrator', 'menu', 'sort_menu', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('398', 'administrator', 'footer', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('399', 'administrator', 'footer', 'insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('400', 'administrator', 'footer', 'delete', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('401', 'administrator', 'footer', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('402', 'administrator', 'footer', 'load_footer_edit', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('403', 'administrator', 'footer', 'sort_footer', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('404', 'administrator', 'config', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('405', 'administrator', 'config', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('406', 'administrator', 'career', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('407', 'administrator', 'career', 'insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('408', 'administrator', 'career', 'delete', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('409', 'administrator', 'career', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('410', 'administrator', 'productcategory', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('411', 'administrator', 'productcategory', 'insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('412', 'administrator', 'productcategory', 'delete', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('413', 'administrator', 'productcategory', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('414', 'administrator', 'productcategory', 'load_category_edit', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('415', 'administrator', 'productcategory', 'sort_category', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('416', 'administrator', 'productattr', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('417', 'administrator', 'productattr', 'insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('418', 'administrator', 'productattr', 'delete', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('419', 'administrator', 'productattr', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('420', 'administrator', 'productattr', 'sort_attr', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('421', 'administrator', 'productattr', 'v_attr_val', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('422', 'administrator', 'productattr', 'attr_val_insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('423', 'administrator', 'productattr', 'attr_val_delete', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('424', 'administrator', 'productattr', 'attr_val_delete', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('425', 'administrator', 'productattr', 'attr_val_sort', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('426', 'administrator', 'product_prop', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('427', 'administrator', 'product_prop', 'insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('428', 'administrator', 'product_prop', 'delete', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('429', 'administrator', 'product_prop', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('430', 'administrator', 'product_prop', 'product_prop_sort', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('431', 'administrator', 'product', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('432', 'administrator', 'product', 'load_data_ssp', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('433', 'administrator', 'product', 'create', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('434', 'administrator', 'product', 'insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('435', 'administrator', 'product', 'edit', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('436', 'administrator', 'product', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('437', 'administrator', 'product', 'sort_product', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('438', 'administrator', 'product', 'avatar', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('439', 'administrator', 'product', 'upload_image', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('440', 'administrator', 'product', 'sort_image', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('441', 'administrator', 'product', 'delete_temp_forder', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('442', 'administrator', 'product', 'delete_image', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('443', 'administrator', 'product', 'add_product_detail', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('444', 'administrator', 'invoice', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('445', 'administrator', 'invoice', 'load_data_ssp', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('446', 'administrator', 'invoice', 'view', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('447', 'administrator', 'invoice', 'delete_invoice', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('448', 'administrator', 'invoice', 'update_invoice', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('449', 'administrator', 'invoice', 'update_quantity', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('450', 'administrator', 'invoice', 'invoice_payment', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('451', 'administrator', 'articlescategory', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('452', 'administrator', 'articlescategory', 'sort', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('453', 'administrator', 'articles', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('454', 'administrator', 'articles', 'articles_ajax', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('455', 'administrator', 'articles', 'create', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('456', 'administrator', 'articles', 'insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('457', 'administrator', 'articles', 'show', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('458', 'administrator', 'articles', 'sort_articles', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('459', 'administrator', 'articles', 'delete_articles', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('460', 'administrator', 'articles', 'edit_articles', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('461', 'administrator', 'articles', 'update_articles', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('462', 'administrator', 'user', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('463', 'administrator', 'user', 'load_data_ssp', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('464', 'administrator', 'user', 'insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('465', 'administrator', 'user', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('466', 'administrator', 'user', 'delete', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('467', 'administrator', 'usergroup', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('468', 'administrator', 'usergroup', 'insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('469', 'administrator', 'usergroup', 'delete', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('470', 'administrator', 'usergroup', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('471', 'administrator', 'usergroup', 'load_usergroup_edit', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('472', 'administrator', 'usergroup', 'usergroup_sort', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('473', 'administrator', 'role', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('474', 'administrator', 'role', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('475', 'administrator', 'module', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('476', 'administrator', 'module', 'detail', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('477', 'administrator', 'module', 'insert', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('478', 'administrator', 'module', 'delete', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('479', 'administrator', 'module', 'config', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('480', 'administrator', 'module', 'update', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('481', 'administrator', 'tag', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('482', 'administrator', 'tag', 'create_tag', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('483', 'administrator', 'tag', 'delete_tag', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('484', 'administrator', 'tag', 'update_tag', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('485', 'administrator', 'tag', 'sort_tag', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('486', 'administrator', 'media', 'index', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('487', 'administrator', 'media', 'selectphoto', '2017-01-02 20:48:43', null);
INSERT INTO `role` VALUES ('591', '19', 'menu', 'index', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('592', '19', 'menu', 'insert', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('593', '19', 'menu', 'delete', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('594', '19', 'menu', 'update', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('595', '19', 'menu', 'load_menu_edit', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('596', '19', 'menu', 'sort_menu', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('597', '19', 'footer', 'index', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('598', '19', 'footer', 'insert', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('599', '19', 'footer', 'delete', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('600', '19', 'footer', 'update', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('601', '19', 'footer', 'load_footer_edit', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('602', '19', 'footer', 'sort_footer', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('603', '19', 'config', 'index', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('604', '19', 'config', 'update', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('605', '19', 'career', 'index', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('606', '19', 'career', 'insert', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('607', '19', 'career', 'delete', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('608', '19', 'career', 'update', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('609', '19', 'career', 'sort_career', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('610', '19', 'product', 'index', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('611', '19', 'product', 'load_data_ssp', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('612', '19', 'product', 'edit', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('613', '19', 'product', 'update', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('614', '19', 'product', 'sort_product', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('615', '19', 'product', 'avatar', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('616', '19', 'product', 'upload_image', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('617', '19', 'product', 'sort_image', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('618', '19', 'product', 'delete_temp_forder', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('619', '19', 'product', 'delete_image', '2017-01-02 21:03:01', null);
INSERT INTO `role` VALUES ('620', '19', 'product', 'add_product_detail', '2017-01-02 21:03:01', null);

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `tag_id` int(255) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(100) DEFAULT NULL,
  `tag_index` int(255) DEFAULT NULL,
  `tag_view` int(100) DEFAULT NULL,
  `tag_slug` varchar(100) DEFAULT NULL,
  `tag_search` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('1', '434', '4', '0', '434', '434');
INSERT INTO `tag` VALUES ('2', 'fre', '1', '0', 'fre', 'fre');
INSERT INTO `tag` VALUES ('3', 'abc', '2', '0', 'abc', 'abc');
INSERT INTO `tag` VALUES ('4', '34543534', '3', '0', '34543534', '34543534');
INSERT INTO `tag` VALUES ('5', 'kệ tivi', '5', '0', 'ke-tivi', 'ke tivi');
INSERT INTO `tag` VALUES ('6', 'sofa cao cấp', '6', '0', 'sofa-cao-cap', 'sofa cao cap');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_sex` int(1) DEFAULT NULL,
  `user_birthday` datetime DEFAULT NULL,
  `user_phone` int(15) DEFAULT NULL,
  `user_address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_note` text COLLATE utf8_unicode_ci,
  `user_id_social` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_avatar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_status` int(1) DEFAULT NULL,
  `user_date_update` datetime DEFAULT NULL,
  `user_user_update` int(100) DEFAULT NULL,
  `user_role_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('6', 'tuni.9xx@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'Phong', '2', '2017-01-02 00:00:00', '0', 'Phong', 'Phong', null, 'administrator', 'phong-911483348064.jpg', '1', '2017-01-02 19:33:05', null, 'Administrator');
INSERT INTO `user` VALUES ('7', 'abc@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'Nguyễn Lê Trung Hiếu', '1', '2017-01-02 00:00:00', '1228786345', 'Cần Thơ', 'T&agrave;i khoản n&agrave;y để quản l&yacute; sản phẩm', null, '19', 'nguyen-le-trung-hieu-91483361691.jpg', '1', '2017-01-02 19:54:51', null, 'Quản lý sản phẩm');

-- ----------------------------
-- Table structure for usergroup
-- ----------------------------
DROP TABLE IF EXISTS `usergroup`;
CREATE TABLE `usergroup` (
  `usergroup_id` int(10) NOT NULL AUTO_INCREMENT,
  `usergroup_name` varchar(50) DEFAULT NULL,
  `usergroup_parent` int(10) DEFAULT NULL,
  `usergroup_index` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usergroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usergroup
-- ----------------------------
INSERT INTO `usergroup` VALUES ('19', 'Quản lý sản phẩm', '0', '1');
