/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : furniture

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-11-19 20:06:15
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of attr_val
-- ----------------------------
INSERT INTO `attr_val` VALUES ('1', '1', 'đỏ', '1', 'đỏ', null, null);
INSERT INTO `attr_val` VALUES ('2', '1', 'tím', '2', 'tím', null, null);

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
INSERT INTO `career` VALUES ('1', 'abc', '1', '2016-11-16 20:59:27', null);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('2', '1', '345 fsdf sdfsdf ds', 'sản phẩm 1', '5435', '53453', '3454343dsf<br />\r\n{readmore}<br />\r\nsdfdsf', '3454343dsf<br />\r\n', '43543 sdfd', '2', '1', ' 34543  sfd', '0000-00-00 00:00:00', '345435-28501479337623.jpg', '0', null, '0', '2', '0', '2', '2', '345435 5435', '2016-11-16 21:13:21', null, null);
INSERT INTO `product` VALUES ('3', null, '345 fsdf sdfsdf ds', '345435 dsfds ', '54354353409', '53453', '3454343dsf<br />\r\n{readmore}<br />\r\nsdfdsf', '3454343dsf<br />\r\n', '43543 sdfd', '3', '1', ' 34543  sfd', '1970-01-01 00:00:00', null, '0', null, '0', '2', '0', '2', '2', '345435 dsfds 54354353409', '2016-11-17 06:41:50', null, null);
INSERT INTO `product` VALUES ('4', null, '345 fsdf sdfsdf ds', '345435 dsfds ', '54354353409', '53453', '3454343dsf<br />\r\n{readmore}<br />\r\nsdfdsf', '3454343dsf<br />\r\n', '43543 sdfd', '4', '1', ' 34543  sfd', '1970-01-01 00:00:00', null, '0', null, '0', '2', '0', '2', '2', '345435 dsfds 54354353409', '2016-11-17 06:41:51', null, null);
INSERT INTO `product` VALUES ('5', null, '345 fsdf sdfsdf ds', '345435 dsfds ', '54354353409', '53453', '3454343dsf<br />\r\n{readmore}<br />\r\nsdfdsf', '3454343dsf<br />\r\n', '43543 sdfd', '5', '1', ' 34543  sfd', '1970-01-01 00:00:00', null, '0', null, '0', '2', '0', '2', '2', '345435 dsfds 54354353409', '2016-11-17 06:42:02', null, null);
INSERT INTO `product` VALUES ('6', '1', '56654', '654654', '5465', '2147483647', '5654', null, '46546', '6', '1', ' 56546', '2016-11-20 00:00:00', '654654-30371479526086.jpg', '0', null, '0', '2', '0', '2', '2', '654654 5465', '2016-11-19 10:28:10', null, null);
INSERT INTO `product` VALUES ('7', '1', '345', '43534', '54353', '345', '345', null, '4543', '7', '1', ' 34543', '2016-11-19 10:35:00', null, '0', null, '0', '2', '0', '2', '2', '43534 54353', '2016-11-19 10:35:00', null, null);
INSERT INTO `product` VALUES ('8', '1', 'fwe', 'sf g  ẻ4', '435', '54354', '34543', null, '43543', '8', '1', 'sf-g-e4', '2016-11-19 00:00:00', 'sf-g-e4-85691479526703.jpg', '0', null, '0', '2', '0', '2', '2', 'sf g  e4 435', '2016-11-19 10:37:34', null, null);
INSERT INTO `product` VALUES ('9', '1', '456', 'CAMRY E (AT)vds ', '34543', '345', '34543', null, '43543', '9', '1', 'camry-e-atvds', '2016-11-19 00:00:00', 'camry-e-atvds-46281479526825.jpg', '0', null, '0', '2', '0', '2', '2', 'camry e (at)vds 34543', '2016-11-19 10:40:05', null, null);
INSERT INTO `product` VALUES ('10', '1', '32432', '32432', '234', '234234', '23423', null, '234', '10', '1', '32432', '2016-11-19 10:43:18', '32432-20481479527010.jpg', '0', null, '0', '2', '0', '2', '2', '32432 234', '2016-11-19 10:43:18', null, null);
INSERT INTO `product` VALUES ('11', '1', '543', '5435', '5435', '435435', '34543', null, '435', '11', '1', '543543543', '2016-11-19 00:00:00', '5435-53241479527069.jpg', '0', null, '0', '1', '0', '1', '1', '5435 5435', '2016-11-19 10:44:21', null, null);
INSERT INTO `product` VALUES ('12', '1', '324', '324324324', '32432', '243243', '32432', null, '43243', '12', '1', '324324324', '2016-11-19 10:45:18', '324324324-21211479527146.png', '0', null, '0', '1', '0', '2', '2', '324324324 32432', '2016-11-19 10:45:18', null, null);
INSERT INTO `product` VALUES ('13', '1', '456', 'CAMRY E (AT)', '654654', '546', '5464', null, '654', '13', '1', ' 54654', '2016-11-19 00:00:00', 'camry-e-at-5331479527275.jpg', '0', null, '0', '2', '0', '2', '2', 'camry e (at) 654654', '2016-11-19 10:47:49', null, null);
INSERT INTO `product` VALUES ('14', '1', '345', '34534', '34543', '543534', '3443', null, '534', '14', '1', '345343', '2016-11-19 00:00:00', '34534-66401479528032.jpg', '0', null, '0', '1', '0', '2', '1', '34534 34543', '2016-11-19 11:00:28', null, null);
INSERT INTO `product` VALUES ('15', '1', '345', '34534534', '543', '534543', '3453', null, '543543', '15', '1', '34534534', '2016-11-19 00:00:00', '34534534-5671479528491.jpg', '0', null, '0', '2', '0', '2', '2', '34534534 543', '2016-11-19 11:07:35', null, null);
INSERT INTO `product` VALUES ('16', '1', '456546', '546546546', '456546', '654654', '54654', null, '54654', '16', '1', '54654654', '2016-11-19 00:00:00', '546546546-36311479528602.jpg', '0', null, '0', '1', '0', '2', '1', '546546546 456546', '2016-11-19 11:09:59', null, null);
INSERT INTO `product` VALUES ('17', '1', '45', '55', '5454', '55', '456', null, '55', '17', '1', '555', '0000-00-00 00:00:00', '55-61551479538741.jpg', '0', null, '0', '2', '0', '2', '2', '55 5454', '2016-11-19 11:13:22', null, null);
INSERT INTO `product` VALUES ('18', '1', '45', '55', '5454', '55', '456', null, '55', '18', '1', '555', '0000-00-00 00:00:00', null, '0', null, '0', '2', '0', '2', '2', '55 5454', '2016-11-19 12:35:36', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productattr
-- ----------------------------
INSERT INTO `productattr` VALUES ('1', 'Màu sắc', '1', '1', '1', '2016-11-16 20:59:56', null);

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
INSERT INTO `productattr_detail` VALUES ('-2', '17', '1', '1');
INSERT INTO `productattr_detail` VALUES ('-2', '17', '1', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productcategory
-- ----------------------------
INSERT INTO `productcategory` VALUES ('1', 'danh mục 1', '0', '1', 'danh-muc-1', 'public/upload/images/1db205_simg_70aaf2_700x700_maxb.jpg', null, '1', '1', null, '2016-11-16 20:59:41', null);

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
INSERT INTO `productcategory_detail` VALUES ('1', '1');
INSERT INTO `productcategory_detail` VALUES ('2', '1');
INSERT INTO `productcategory_detail` VALUES ('3', '1');
INSERT INTO `productcategory_detail` VALUES ('4', '1');
INSERT INTO `productcategory_detail` VALUES ('5', '1');
INSERT INTO `productcategory_detail` VALUES ('6', '1');
INSERT INTO `productcategory_detail` VALUES ('7', '1');
INSERT INTO `productcategory_detail` VALUES ('8', '1');
INSERT INTO `productcategory_detail` VALUES ('9', '1');
INSERT INTO `productcategory_detail` VALUES ('10', '1');
INSERT INTO `productcategory_detail` VALUES ('11', '1');
INSERT INTO `productcategory_detail` VALUES ('12', '1');
INSERT INTO `productcategory_detail` VALUES ('13', '1');
INSERT INTO `productcategory_detail` VALUES ('14', '1');
INSERT INTO `productcategory_detail` VALUES ('15', '1');
INSERT INTO `productcategory_detail` VALUES ('16', '1');
INSERT INTO `productcategory_detail` VALUES ('1', null);
INSERT INTO `productcategory_detail` VALUES ('17', '1');
INSERT INTO `productcategory_detail` VALUES ('18', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES ('2', 'san-pham-1-10401479526041.jpg', '1', '23');
INSERT INTO `product_images` VALUES ('6', '654654-56611479526088.jpg', '1', '24');
INSERT INTO `product_images` VALUES ('6', '654654-26071479526088.jpg', '2', '25');
INSERT INTO `product_images` VALUES ('9', 'camry-e-atvds-28361479526803.jpg', '1', '26');
INSERT INTO `product_images` VALUES ('9', 'camry-e-atvds-56081479526803.jpg', '2', '27');
INSERT INTO `product_images` VALUES ('10', '32432-13061479526961.jpg', '1', '28');
INSERT INTO `product_images` VALUES ('10', '32432-74061479526961.jpg', '2', '29');
INSERT INTO `product_images` VALUES ('13', 'camry-e-at-46501479527267.jpg', '1', '30');
INSERT INTO `product_images` VALUES ('13', 'camry-e-at-75451479527267.jpg', '2', '31');
INSERT INTO `product_images` VALUES ('14', '34534-77731479528037.jpg', '1', '32');
INSERT INTO `product_images` VALUES ('14', '34534-78911479528037.jpg', '2', '33');
INSERT INTO `product_images` VALUES ('14', '34534-52391479528037.png', '2', '34');
INSERT INTO `product_images` VALUES ('14', '34534-73871479528037.jpg', '2', '35');
INSERT INTO `product_images` VALUES ('15', '34534534-88321479528496.jpg', '1', '36');
INSERT INTO `product_images` VALUES ('15', '34534534-54471479528497.jpg', '2', '37');
INSERT INTO `product_images` VALUES ('15', '34534534-3911479528497.jpg', '3', '38');
INSERT INTO `product_images` VALUES ('16', '546546546-63151479528606.jpg', '1', '39');
INSERT INTO `product_images` VALUES ('16', '546546546-81201479528606.jpg', '1', '40');
INSERT INTO `product_images` VALUES ('17', '55-5041479528818.jpg', '3', '41');
INSERT INTO `product_images` VALUES ('17', '55-26761479528818.jpg', '2', '42');
INSERT INTO `product_images` VALUES ('17', '55-54131479528818.jpg', '0', '43');
INSERT INTO `product_images` VALUES ('17', '55-61801479528818.jpg', '1', '44');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_prop
-- ----------------------------
INSERT INTO `product_prop` VALUES ('1', 'độ dài', '1', '1', '2016-11-16 21:00:13', null);

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
INSERT INTO `product_prop_detail` VALUES ('1', '1', '32423');
INSERT INTO `product_prop_detail` VALUES ('2', '1', '34534');
INSERT INTO `product_prop_detail` VALUES ('3', '1', '34534');
INSERT INTO `product_prop_detail` VALUES ('4', '1', '34534');
INSERT INTO `product_prop_detail` VALUES ('5', '1', '34534');
INSERT INTO `product_prop_detail` VALUES ('6', '1', '546');
INSERT INTO `product_prop_detail` VALUES ('7', '1', '435');
INSERT INTO `product_prop_detail` VALUES ('8', '1', '454');
INSERT INTO `product_prop_detail` VALUES ('9', '1', '43543');
INSERT INTO `product_prop_detail` VALUES ('10', '1', '23423');
INSERT INTO `product_prop_detail` VALUES ('11', '1', '43534');
INSERT INTO `product_prop_detail` VALUES ('12', '1', '32432');
INSERT INTO `product_prop_detail` VALUES ('13', '1', '45654');
INSERT INTO `product_prop_detail` VALUES ('14', '1', '3443');
INSERT INTO `product_prop_detail` VALUES ('15', '1', '34543');
INSERT INTO `product_prop_detail` VALUES ('16', '1', '45654');
INSERT INTO `product_prop_detail` VALUES ('17', '1', 'new abc { abc 123 }');
INSERT INTO `product_prop_detail` VALUES ('18', '1', 'hjkl;');

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
INSERT INTO `product_tag` VALUES ('18', '1');
INSERT INTO `product_tag` VALUES ('18', '2');
INSERT INTO `product_tag` VALUES ('18', '3');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('1', '434', null, '0', '434', '434');
INSERT INTO `tag` VALUES ('2', 'fre', null, '0', 'fre', 'fre');
INSERT INTO `tag` VALUES ('3', 'abc', null, '0', 'abc', 'abc');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
