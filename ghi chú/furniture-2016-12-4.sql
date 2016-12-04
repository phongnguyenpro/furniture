/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : furniture

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-12-04 22:35:52
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of attr_val
-- ----------------------------
INSERT INTO `attr_val` VALUES ('1', '1', 'red', '1', 'red', '2016-12-03 14:45:55', null);
INSERT INTO `attr_val` VALUES ('2', '1', 'tím', '2', 'purple', null, null);
INSERT INTO `attr_val` VALUES ('4', '3', 'M', '1', 'M', null, null);
INSERT INTO `attr_val` VALUES ('5', '3', 'S', '2', 'S', null, null);
INSERT INTO `attr_val` VALUES ('6', '3', 'L', '3', 'L', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'abc', '0', null, '1', 'link', 'http://www.codeigniter.com/user_guide/general/caching.html', null, null);
INSERT INTO `menu` VALUES ('2', 'Home', '0', '1', '1', 'link', './', null, null);
INSERT INTO `menu` VALUES ('3', 'Home', '2', '2', '1', 'link', '/', null, null);
INSERT INTO `menu` VALUES ('4', 'Home', '3', '3', '1', 'link', '/', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of module
-- ----------------------------
INSERT INTO `module` VALUES ('2', 'product 1', 'product 1', 'main', '1', 'product', 'a:2:{s:19:\"module_product_type\";s:3:\"hot\";s:20:\"module_product_limit\";s:2:\"10\";}');
INSERT INTO `module` VALUES ('3', 'Slider 1', 'Slider 1', 'main', '1', 'slider', 'a:3:{i:0;a:2:{s:12:\"module_image\";s:43:\"public/upload/images/slider/sl_1%5B1%5D.png\";s:11:\"module_link\";s:3:\"abc\";}i:1;a:2:{s:12:\"module_image\";s:36:\"public/upload/images/slider/sl_2.png\";s:11:\"module_link\";s:3:\"abc\";}i:2;a:2:{s:12:\"module_image\";s:36:\"public/upload/images/slider/sl_3.png\";s:11:\"module_link\";s:3:\"abc\";}}');
INSERT INTO `module` VALUES ('4', 'Quan cao product', 'Quan cao product', 'main', '1', 'banner', 'a:1:{i:0;a:2:{s:12:\"module_image\";s:50:\"public/upload/images/banner/banner-cate%5B1%5D.png\";s:11:\"module_link\";s:3:\"abc\";}}');
INSERT INTO `module` VALUES ('6', 'all', '', 'header', '454', 'slider', null);
INSERT INTO `module` VALUES ('7', 'Quan cao product', 'Quan cao product', 'main', '2', 'banner', 'a:1:{i:0;a:2:{s:12:\"module_image\";s:102:\"http://wp.smartaddons.com/themes/sw_market/wp-content/themes/sw_market/assets/img/banner/banner2-4.png\";s:11:\"module_link\";s:1:\"2\";}}');
INSERT INTO `module` VALUES ('8', 'Quan cao product slider', 'Quan cao product slider', 'main', '1', 'banner', 'a:3:{i:0;a:2:{s:12:\"module_image\";s:41:\"public/upload/images/banner/banner1-1.jpg\";s:11:\"module_link\";s:2:\"  \";}i:1;a:2:{s:12:\"module_image\";s:41:\"public/upload/images/banner/banner1-2.jpg\";s:11:\"module_link\";s:1:\" \";}i:2;a:2:{s:12:\"module_image\";s:41:\"public/upload/images/banner/banner1-3.jpg\";s:11:\"module_link\";s:1:\" \";}}');

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
INSERT INTO `module_detail` VALUES ('2', 'home');
INSERT INTO `module_detail` VALUES ('3', 'home');
INSERT INTO `module_detail` VALUES ('4', 'productcategory');
INSERT INTO `module_detail` VALUES ('6', '-1');
INSERT INTO `module_detail` VALUES ('7', 'home');
INSERT INTO `module_detail` VALUES ('8', 'home');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('27', '1', 'funiture1', 'hand made painted wood furniture', '6700000', '20', '', null, 'bộ', null, '1', 'hand-made-painted-wood-furniture', '2016-12-04 14:02:08', 'hand-made-painted-wood-furniture-57961480834876.jpeg', '0', null, '4', '2', '0', '2', '2', 'hand made painted wood furniture 6700000', '2016-12-04 14:02:08', null, null);
INSERT INTO `product` VALUES ('28', '1', 'product2', 'Manufacturers and sellers of soft furniture for homes, hotels, restaurants', '2987878', '34', 'Manufacturers and sellers of soft furniture for homes, hotels, restaurants{readmore}\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<h2>Produit</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Type</th>\r\n			<td>Furniture</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Origine</th>\r\n			<td>Lithuanie</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Style</th>\r\n			<td>Contemporain</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Type de mat&eacute;riaux principal</th>\r\n			<td>Autres mat&eacute;riaux</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Mat&eacute;riaux principal</th>\r\n			<td>Contreplaqu&eacute; - multiplex</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<h2>Sp&eacute;cifications</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Quantit&eacute;</th>\r\n			<td>20.0 - 40.0 pi&egrave;ces par mois</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Certification</th>\r\n			<td>ISO 9001</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Description</th>\r\n			<td>This model is made in accordance with European standards. Comfortable,</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<h2>Prix et Conditions</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Prix</th>\r\n			<td><a href=\"javascript:showAskPrice(\'17920885\');\">Demandez le prix</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th>D&eacute;lai de livraison</th>\r\n			<td>Disponible sur commande en moins de 30 jours</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Vend en:</th>\r\n			<td>Oc&eacute;anie , Antarctique, Afrique, Am&eacute;rique du sud, Am&eacute;rique du nord, Europe, Asie</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Manufacturers and sellers of soft furniture for homes, hotels, restaurants', 'bo', null, '1', 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants', '2016-12-04 14:05:23', 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants-10741480835098.jpeg', '0', null, '20', '1', '0', '1', '1', 'manufacturers and sellers of soft furniture for homes, hotels, restaurants 2987878', '2016-12-04 14:05:23', null, null);

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
INSERT INTO `productattr` VALUES ('3', 'Size', '2', '1', '1', '2016-12-03 14:45:55', null);

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
INSERT INTO `productattr_detail` VALUES ('-1', '27', '1', '1');
INSERT INTO `productattr_detail` VALUES ('-1', '27', '1', '2');
INSERT INTO `productattr_detail` VALUES ('-1', '27', '3', '4');
INSERT INTO `productattr_detail` VALUES ('-1', '27', '3', '5');
INSERT INTO `productattr_detail` VALUES ('-1', '27', '3', '6');
INSERT INTO `productattr_detail` VALUES ('-1', '28', '1', '2');
INSERT INTO `productattr_detail` VALUES ('-1', '28', '3', '4');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productcategory
-- ----------------------------
INSERT INTO `productcategory` VALUES ('1', 'Áo thun nam', '0', null, 'ao-thun-nam', '', '', '1', '1', '2', '2016-11-23 22:59:36', null);
INSERT INTO `productcategory` VALUES ('2', 'Quần nam', '1', null, 'quan-nam', '', '', '1', '1', '2', '2016-11-23 22:59:43', null);
INSERT INTO `productcategory` VALUES ('3', 'Thời trang nam', '0', '1', 'thoi-trang-nam', '', '', '1', '1', '2', '2016-11-23 23:00:11', null);
INSERT INTO `productcategory` VALUES ('4', 'Thời trang nữ', '0', '2', 'thoi-trang-nu', '', null, '1', '1', null, '2016-11-23 23:00:00', null);

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
INSERT INTO `productcategory_detail` VALUES ('27', '2');
INSERT INTO `productcategory_detail` VALUES ('28', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES ('27', 'hand-made-painted-wood-furniture-19321480834896.jpeg', '1', '232');
INSERT INTO `product_images` VALUES ('28', 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants-3531480835108.jpeg', '1', '233');
INSERT INTO `product_images` VALUES ('28', 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants-83121480835115.jpeg', '2', '234');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'administrator', 'menu', 'index', '2016-12-04 00:54:57', null);
INSERT INTO `role` VALUES ('2', 'administrator', 'config', 'update', '2016-12-04 00:54:57', null);
INSERT INTO `role` VALUES ('3', 'administrator', 'career', 'insert', '2016-12-04 00:54:57', null);
INSERT INTO `role` VALUES ('4', 'administrator', 'productattr', 'insert', '2016-12-04 00:54:57', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('1', '434', null, '0', '434', '434');
INSERT INTO `tag` VALUES ('2', 'fre', null, '0', 'fre', 'fre');
INSERT INTO `tag` VALUES ('3', 'abc', null, '0', 'abc', 'abc');
INSERT INTO `tag` VALUES ('4', '34543534', null, '0', '34543534', '34543534');

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
