/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : furniture

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-12-20 21:13:54
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
INSERT INTO `career` VALUES ('1', 'Đồi nội thất', '1', '2016-12-05 04:58:13', null);

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
INSERT INTO `product` VALUES ('27', '1', 'funiture1', 'hand made painted wood furniture', '6700000', '20', '', null, 'bộ', null, '1', 'hand-made-painted-wood-furniture', '2016-12-04 14:02:08', 'hand-made-painted-wood-furniture-57961480834876.jpeg', '0', null, '5', '2', '1', '2', '2', 'hand made painted wood furniture 6700000', '2016-12-04 14:02:08', null, null);
INSERT INTO `product` VALUES ('28', '1', 'product2', 'Manufacturers and sellers of soft furniture for homes, hotels, restaurants', '2987878', '34', 'Manufacturers and sellers of soft furniture for homes, hotels, restaurants{readmore}\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<h2>Produit</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Type</th>\r\n			<td>Furniture</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Origine</th>\r\n			<td>Lithuanie</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Style</th>\r\n			<td>Contemporain</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Type de mat&eacute;riaux principal</th>\r\n			<td>Autres mat&eacute;riaux</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Mat&eacute;riaux principal</th>\r\n			<td>Contreplaqu&eacute; - multiplex</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<h2>Sp&eacute;cifications</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Quantit&eacute;</th>\r\n			<td>20.0 - 40.0 pi&egrave;ces par mois</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Certification</th>\r\n			<td>ISO 9001</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Description</th>\r\n			<td>This model is made in accordance with European standards. Comfortable,</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<h2>Prix et Conditions</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Prix</th>\r\n			<td><a href=\"javascript:showAskPrice(\'17920885\');\">Demandez le prix</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th>D&eacute;lai de livraison</th>\r\n			<td>Disponible sur commande en moins de 30 jours</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Vend en:</th>\r\n			<td>Oc&eacute;anie , Antarctique, Afrique, Am&eacute;rique du sud, Am&eacute;rique du nord, Europe, Asie</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Manufacturers and sellers of soft furniture for homes, hotels, restaurants', 'bo', null, '1', 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants', '2016-12-04 14:05:23', 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants-10741480835098.jpeg', '0', null, '49', '1', '0', '1', '1', 'manufacturers and sellers of soft furniture for homes, hotels, restaurants 2987878', '2016-12-04 14:05:23', null, null);
INSERT INTO `product` VALUES ('29', '1', 'pp1', ' Phong cách Châu Á hiện đại', '22222222', '10', 'Kiến tr&uacute;c hiện đại l&agrave; một sự đoạn tuyệt mạnh mẽ với kiến tr&uacute;c cổ điển, thể hiện một lối tư duy mới của sự ph&aacute;t triển&nbsp;{readmore}\r\n<p>Kiến tr&uacute;c hiện đại l&agrave; một sự đoạn tuyệt mạnh mẽ với kiến tr&uacute;c cổ điển, thể hiện một lối tư duy mới của sự ph&aacute;t triển b&ugrave;ng nổ của c&aacute;c x&atilde; hội Ch&acirc;u &Acirc;u&nbsp;cuối thế kỉ 19, đầu thế kỉ 20. sự đơn giản trong bố cục h&igrave;nh khối kh&ocirc;ng gian mặt đứng loại bỏ việc sử dụng c&aacute;c họa tiết trang tr&iacute; của trường ph&aacute;i cổ điển&nbsp;cũng như việc sử dụng vật liệu&nbsp;mới như k&iacute;nh, th&eacute;p, b&ecirc; t&ocirc;ng</p>\r\n\r\n<p>Sự ra đời của kiến tr&uacute;c hiện đại đ&atilde; mang đến sự h&igrave;nh th&agrave;nh phong c&aacute;ch hiện đại trong thiết kế nội. Phong c&aacute;ch thiết kế hiện đại, sạch sẽ, tập trung chủ yếu v&agrave;o t&iacute;nh c&ocirc;ng năng v&agrave; tr&aacute;nh c&aacute;c phụ kiện rườm r&agrave;, c&aacute;c trang tr&iacute; qu&aacute; mức thường thấy trong nhiều phong c&aacute;ch kh&aacute;c. Một số người cảm thấy việc thiết kế hiện đại l&agrave; qu&aacute; đơn giản, th&ocirc; hoặc lạnh, tuy nhi&ecirc;n khi được l&ecirc;n kế hoạch chặt chẽ, hợp l&yacute;, n&oacute; sẽ tạo n&ecirc;n cảm gi&aacute;c y&ecirc;n b&igrave;nh v&agrave; đơn giản cho ng&ocirc;i nh&agrave; của bạn.</p>\r\n\r\n<p>V&iacute; dụ dưới đ&acirc;y sẽ cho c&aacute;c bạn thấy được phong c&aacute;ch hiện đại được thiết kế cho một căn nh&agrave; phố biệt thự tại quận 7.&nbsp;Phong c&aacute;ch Ch&acirc;u &Aacute; hiện đại</p>\r\n', 'Kiến tr&uacute;c hiện đại l&agrave; một sự đoạn tuyệt mạnh mẽ với kiến tr&uacute;c cổ điển, thể hiện một lối tư duy mới của sự ph&aacute;t triển&nbsp;', '', null, '1', 'phong-cach-chau-a-hien-dai', '2016-12-05 05:00:34', 'phong-cach-chau-a-hien-dai-64951480888792.jpg', '0', null, '10', '1', '0', '1', '1', 'phong c&aacute;ch ch&acirc;u &aacute; hien dai 22222222', '2016-12-05 05:00:34', null, null);
INSERT INTO `product` VALUES ('30', '1', 'CB602 ', 'Combo đồ nội thất đẹp ', '14600000', '10', 'Bộ&nbsp;Combo đồ nội thất đẹp m&atilde; CB602 gồm&nbsp;<a href=\"http://nhaxinhplaza.vn/ke-tivi/ke-tivi-go-ma-ktv614.html\"><strong>Kệ tivi gỗ m&atilde; KTV614</strong></a>&nbsp;v&agrave;&nbsp;<a href=\"http://nhaxinhplaza.vn/ban-tra/ban-tra-go-ma-bt611.html\"><strong>B&agrave;n tr&agrave; gỗ m&atilde; BT611</strong></a>&nbsp;được thiết kế ban sẵn tại Nội Thất Xinh{readmore}\r\n<h2><strong>Mẫu nội thất b&aacute;n sẵn mới nhất 2016 tại Nội Thất Xinh</strong></h2>\r\nBộ&nbsp;Combo đồ nội thất đẹp m&atilde; CB602 gồm&nbsp;<a href=\"http://nhaxinhplaza.vn/ke-tivi/ke-tivi-go-ma-ktv614.html\"><strong>Kệ tivi gỗ m&atilde; KTV614</strong></a>&nbsp;v&agrave;&nbsp;<a href=\"http://nhaxinhplaza.vn/ban-tra/ban-tra-go-ma-bt611.html\"><strong>B&agrave;n tr&agrave; gỗ m&atilde; BT611</strong></a>&nbsp;được thiết kế ban sẵn tại Nội Thất Xinh. Sản phẩm mang đến cho kh&ocirc;ng gian sống n&eacute;t đẹp h&agrave;i h&ograve;a cả về c&ocirc;ng năng sử dụng, m&agrave;u sắc v&agrave; &iacute;nh thẩm mỹ. Đ&acirc;y chắc chắn sẽ l&agrave; m&oacute;n đồ nội thất xứng đ&aacute;ng để đặt trong căn ph&ograve;ng kh&aacute;ch hiện đại v&agrave; sang trọng m&agrave; bạn mong muốn c&oacute; được.<br />\r\n&nbsp;', 'Bộ&nbsp;Combo đồ nội thất đẹp m&atilde; CB602 gồm&nbsp;<a href=\"http://nhaxinhplaza.vn/ke-tivi/ke-tivi-go-ma-ktv614.html\"><strong>Kệ tivi gỗ m&atilde; KTV614</strong></a>&nbsp;v&agrave;&nbsp;<a href=\"http://nhaxinhplaza.vn/ban-tra/ban-tra-go-ma-bt611.html\"><strong>B&agrave;n tr&agrave; gỗ m&atilde; BT611</strong></a>&nbsp;được thiết kế ban sẵn tại Nội Thất Xinh', '', null, '1', 'combo-do-noi-that-dep-ma-cb602-combo-do-noi-that-dep-ma-cb602-combo-do-noi-that-dep-ma-cb602', '2016-12-05 00:00:00', 'combo-do-noi-that-dep-ma-cb602-combo-do-noi-that-dep-ma-cb602-combo-do-noi-that-dep-ma-cb602-57441480889059.JPG', '0', null, '0', '1', '0', '2', '1', 'combo do noi that dep 14600000', '2016-12-05 05:21:56', null, null);
INSERT INTO `product` VALUES ('31', '1', ' KTV613', 'Kệ tivi gỗ ', '7300000', '20', '<h2><strong>Mẫu kệ tivi bền đẹp tại H&agrave; Nội</strong>{readmore}</h2>\r\n\r\n<h2><strong>Mẫu kệ tivi bền đẹp tại H&agrave; Nội</strong></h2>\r\nKệ tivi gỗ m&atilde; KTV613 l&agrave; một trong những mẫu sản phẩm nội thất đẹp được thiết kế với chất lượng vượt trội được b&aacute;n tại Nội Thất Xinh. Nếu bạn muốn sở hữu một kh&ocirc;ng gian nội thất hiện đại, mẫu&nbsp;<a href=\"http://nhaxinhplaza.vn/ke-tivi.html\"><strong>kệ tivi đẹp rẻ</strong></a>&nbsp;n&agrave;y chắc chắn sẽ l&agrave; gợi &yacute; th&ocirc;ng minh nhất.\r\n\r\n<ul>\r\n	<li>Xuất xứ: Nội Thất Xinh</li>\r\n	<li>K&iacute;ch thước: 2200 x 450 x 380</li>\r\n	<li>Chất liệu: gỗ MDF l&otilde;i xanh nhập khẩu Malaysia cao cấp</li>\r\n	<li>Gam m&agrave;u đen trắng hiện đại</li>\r\n	<li>Thiết kế tối giản nhưng sang trọng</li>\r\n	<li>Kệ tivi đẹp được sơn bệt chống xước tốt</li>\r\n	<li>Bảo h&agrave;nh 12 th&aacute;ng, bảo tr&igrave; trọn đời</li>\r\n</ul>\r\n', '<h2><strong>Mẫu kệ tivi bền đẹp tại H&agrave; Nội</strong>', 'bộ', null, '1', 'ke-tivi-go-ma-ktv613-ke-tivi-go-ma-ktv613-ke-tivi-go', '2016-12-05 00:00:00', 'ke-tivi-go-ma-ktv613-ke-tivi-go-ma-ktv613-ke-tivi-go-72131480889260.jpg', '0', null, '1', '1', '0', '1', '1', 'ke tivi go 7300000', '2016-12-05 05:21:05', null, null);
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
INSERT INTO `productattr_detail` VALUES ('-1', '27', '1', '1');
INSERT INTO `productattr_detail` VALUES ('-1', '27', '1', '2');
INSERT INTO `productattr_detail` VALUES ('-1', '27', '3', '4');
INSERT INTO `productattr_detail` VALUES ('-1', '27', '3', '5');
INSERT INTO `productattr_detail` VALUES ('-1', '27', '3', '6');
INSERT INTO `productattr_detail` VALUES ('-1', '28', '1', '2');
INSERT INTO `productattr_detail` VALUES ('-1', '28', '3', '4');
INSERT INTO `productattr_detail` VALUES ('-1', '29', '1', '1');
INSERT INTO `productattr_detail` VALUES ('-1', '29', '3', '5');
INSERT INTO `productattr_detail` VALUES ('-1', '33', '1', '1');
INSERT INTO `productattr_detail` VALUES ('-1', '33', '1', '2');
INSERT INTO `productattr_detail` VALUES ('-1', '33', '3', '4');
INSERT INTO `productattr_detail` VALUES ('-1', '33', '3', '5');
INSERT INTO `productattr_detail` VALUES ('-1', '33', '3', '6');
INSERT INTO `productattr_detail` VALUES ('-1', '31', '1', '1');
INSERT INTO `productattr_detail` VALUES ('-1', '31', '1', '2');
INSERT INTO `productattr_detail` VALUES ('-1', '31', '3', '4');
INSERT INTO `productattr_detail` VALUES ('-1', '31', '3', '5');
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
INSERT INTO `productcategory_detail` VALUES ('27', '2');
INSERT INTO `productcategory_detail` VALUES ('28', '2');
INSERT INTO `productcategory_detail` VALUES ('29', '1');
INSERT INTO `productcategory_detail` VALUES ('32', '3');
INSERT INTO `productcategory_detail` VALUES ('32', '4');
INSERT INTO `productcategory_detail` VALUES ('32', '7');
INSERT INTO `productcategory_detail` VALUES ('33', '7');
INSERT INTO `productcategory_detail` VALUES ('31', '3');
INSERT INTO `productcategory_detail` VALUES ('30', '3');
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
INSERT INTO `product_images` VALUES ('27', 'hand-made-painted-wood-furniture-19321480834896.jpeg', '1', '232');
INSERT INTO `product_images` VALUES ('28', 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants-3531480835108.jpeg', '1', '233');
INSERT INTO `product_images` VALUES ('28', 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants-83121480835115.jpeg', '2', '234');
INSERT INTO `product_images` VALUES ('29', 'phong-cach-chau-a-hien-dai-25581480888804.jpg', '1', '235');
INSERT INTO `product_images` VALUES ('29', 'phong-cach-chau-a-hien-dai-41851480888813.jpg', '2', '236');
INSERT INTO `product_images` VALUES ('29', 'phong-cach-chau-a-hien-dai-64881480888821.jpg', '3', '237');
INSERT INTO `product_images` VALUES ('29', 'phong-cach-chau-a-hien-dai-20001480888830.jpg', '4', '238');
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
INSERT INTO `product_prop_detail` VALUES ('29', '1', '1000000');
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
INSERT INTO `product_prop_detail` VALUES ('31', '1', 'Nội Thất Xinh');
INSERT INTO `product_prop_detail` VALUES ('31', '2', '12T');
INSERT INTO `product_prop_detail` VALUES ('31', '3', 'Trắng - Đen');
INSERT INTO `product_prop_detail` VALUES ('31', '4', 'Trắng - Đen');
INSERT INTO `product_prop_detail` VALUES ('31', '5', '2200 x 450 x 380');
INSERT INTO `product_prop_detail` VALUES ('31', '6', 'Đặt Hàng');
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
INSERT INTO `product_tag` VALUES ('31', '5');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('1', '434', null, '0', '434', '434');
INSERT INTO `tag` VALUES ('2', 'fre', null, '0', 'fre', 'fre');
INSERT INTO `tag` VALUES ('3', 'abc', null, '0', 'abc', 'abc');
INSERT INTO `tag` VALUES ('4', '34543534', null, '0', '34543534', '34543534');
INSERT INTO `tag` VALUES ('5', 'kệ tivi', null, '0', 'ke-tivi', 'ke tivi');
INSERT INTO `tag` VALUES ('6', 'sofa cao cấp', null, '0', 'sofa-cao-cap', 'sofa cao cap');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usergroup
-- ----------------------------
INSERT INTO `usergroup` VALUES ('5', '3 r r', '0', '0');
INSERT INTO `usergroup` VALUES ('12', '46fdg fdg gdf ', '0', '1');
INSERT INTO `usergroup` VALUES ('13', '46fdg fdg gdf ', '12', '2');
INSERT INTO `usergroup` VALUES ('14', '46fdg fdg gdf ', '13', '3');
INSERT INTO `usergroup` VALUES ('15', '46fdg fdg gdf ', '0', '4');
INSERT INTO `usergroup` VALUES ('16', '46fdg fdg gdf ', '15', '5');
