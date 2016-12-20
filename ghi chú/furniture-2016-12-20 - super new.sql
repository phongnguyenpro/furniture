-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2016 at 02:41 PM
-- Server version: 5.0.82-community-nt
-- PHP Version: 5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `furniture`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `articles_id` int(255) NOT NULL auto_increment,
  `articles_name` varchar(255) collate utf8_unicode_ci default NULL,
  `articles_description` text collate utf8_unicode_ci,
  `articles_content` text collate utf8_unicode_ci,
  `articles_slug` varchar(200) collate utf8_unicode_ci default NULL,
  `articles_date_create` datetime default NULL,
  `articles_avatar` varchar(300) collate utf8_unicode_ci default NULL,
  `articles_index` int(255) default NULL,
  `articles_show` int(1) default NULL,
  `articles_feature` int(1) default NULL,
  `articles_view` int(100) default NULL,
  `articles_like` int(100) default NULL,
  `articles_new` int(1) default NULL,
  PRIMARY KEY  (`articles_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articles_id`, `articles_name`, `articles_description`, `articles_content`, `articles_slug`, `articles_date_create`, `articles_avatar`, `articles_index`, `articles_show`, `articles_feature`, `articles_view`, `articles_like`, `articles_new`) VALUES
(8, 'gfdgd asdasd', 'gdfgdf', 'gdfgdf{readmore}dasdasdasdasdasd', 'gfdgd-asdasd', '2016-12-17 22:20:13', 'gfdgd-asdasd-921481906265.jpg', 1, 1, 1, 0, 0, NULL),
(10, 'gdfgfdg', ',hj,hjhj,hj,hmhfg', ',hj,hjhj,hj,hmhfg{readmore}hdfgdfgdfgdgdfg', 'gdfgfdg', '2016-12-17 22:59:14', 'gdfgfdg-61481990354.jpg', 2, 1, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `articlescategory`
--

CREATE TABLE IF NOT EXISTS `articlescategory` (
  `articlescategory_id` int(255) NOT NULL auto_increment,
  `articlescategory_name` varchar(255) collate utf8_unicode_ci default NULL,
  `articlescategory_slug` varchar(255) collate utf8_unicode_ci default NULL,
  `articlescategory_parent` int(255) default NULL,
  `articlescategory_index` int(255) default NULL,
  `articlescategory_icon` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`articlescategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `articlescategory`
--

INSERT INTO `articlescategory` (`articlescategory_id`, `articlescategory_name`, `articlescategory_slug`, `articlescategory_parent`, `articlescategory_index`, `articlescategory_icon`) VALUES
(6, 'ab', 'ab', 0, 2, ''),
(7, 'bvf', 'bvf', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `articlescategory_detail`
--

CREATE TABLE IF NOT EXISTS `articlescategory_detail` (
  `articles_id` int(255) default NULL,
  `articlescategory_id` int(255) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articlescategory_detail`
--

INSERT INTO `articlescategory_detail` (`articles_id`, `articlescategory_id`) VALUES
(8, 7),
(10, 7);

-- --------------------------------------------------------

--
-- Table structure for table `articles_tag`
--

CREATE TABLE IF NOT EXISTS `articles_tag` (
  `articles_id` int(255) default NULL,
  `tag_id` int(255) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles_tag`
--

INSERT INTO `articles_tag` (`articles_id`, `tag_id`) VALUES
(1, 7),
(1, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attr_val`
--

CREATE TABLE IF NOT EXISTS `attr_val` (
  `attr_val_id` int(225) NOT NULL auto_increment,
  `productattr_id` int(225) default NULL,
  `attr_val_value` text,
  `attr_val_index` int(255) default NULL,
  `attr_val_label` varchar(100) default NULL,
  `attr_val_date_update` datetime default NULL,
  `attr_val_user_update` int(100) default NULL,
  PRIMARY KEY  (`attr_val_id`),
  KEY `id_thuoctinhchon` (`productattr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `attr_val`
--

INSERT INTO `attr_val` (`attr_val_id`, `productattr_id`, `attr_val_value`, `attr_val_index`, `attr_val_label`, `attr_val_date_update`, `attr_val_user_update`) VALUES
(1, 1, 'red', 1, 'red', '2016-12-03 14:45:55', NULL),
(2, 1, 'tím', 2, 'purple', NULL, NULL),
(4, 3, 'Gỗ', 1, 'Gỗ', NULL, NULL),
(5, 3, 'Thủy tinh', 2, 'Thủy tinh', NULL, NULL),
(6, 3, 'Inox', 3, 'Inox', NULL, NULL),
(7, 3, 'Nỉ', 4, 'Nỉ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE IF NOT EXISTS `career` (
  `career_id` int(11) NOT NULL auto_increment,
  `career_name` varchar(100) collate utf8_unicode_ci default NULL,
  `career_index` int(100) default NULL,
  `career_date_update` datetime default NULL,
  `career_user_update` int(100) default NULL,
  PRIMARY KEY  (`career_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `career`
--

INSERT INTO `career` (`career_id`, `career_name`, `career_index`, `career_date_update`, `career_user_update`) VALUES
(1, 'Đồi nội thất', 1, '2016-12-05 04:58:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fee_shipping`
--

CREATE TABLE IF NOT EXISTS `fee_shipping` (
  `fee_shipping_id` int(11) NOT NULL,
  `fee_shipping_name` varchar(255) collate utf8_unicode_ci default NULL,
  `fee_shipping_parent` int(11) default NULL,
  `fee_shipping_index` int(11) default NULL,
  `fee_shipping_value` float default NULL,
  PRIMARY KEY  (`fee_shipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(255) NOT NULL auto_increment,
  `user_id` int(255) default NULL,
  `invoice_code` varchar(100) collate utf8_unicode_ci default NULL,
  `invoice_date_create` datetime default NULL,
  `invoice_date_pay` datetime default NULL,
  `user_name` varchar(100) collate utf8_unicode_ci default NULL,
  `user_address` varchar(150) collate utf8_unicode_ci default NULL,
  `user_phone` varchar(50) collate utf8_unicode_ci default NULL,
  `invoice_type_pay` int(1) default NULL,
  `invoice_note` text collate utf8_unicode_ci,
  `invoice_total_discount` int(10) default NULL,
  `invoice_amout` double default NULL,
  `invoice_status` int(1) default NULL,
  `user_email` varchar(100) collate utf8_unicode_ci default NULL,
  `invoice_money_plus` double(100,0) default NULL,
  `invoice_note_money_plus` text collate utf8_unicode_ci,
  `invoice_money_subtract` double(100,0) default NULL,
  `invoice_note_money_subtract` text collate utf8_unicode_ci,
  `invoice_protect_code` varchar(100) collate utf8_unicode_ci default NULL,
  `invoice_discount_code` varchar(100) collate utf8_unicode_ci default NULL,
  `invoice_shipping_status` int(1) default NULL,
  `invoice_deal_code` varchar(100) collate utf8_unicode_ci default NULL,
  `invoice_discount_value` int(11) default NULL,
  `distance_id` int(100) default NULL,
  PRIMARY KEY  (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detail`
--

CREATE TABLE IF NOT EXISTS `invoice_detail` (
  `invoice_detail_id` varchar(100) collate utf8_unicode_ci NOT NULL,
  `invoice_id` int(255) default NULL,
  `product_id` int(255) default NULL,
  `product_detail_id` int(255) default NULL,
  `quantity` int(10) default NULL,
  `attr_val_ids` varchar(100) collate utf8_unicode_ci default NULL,
  `invoice_detail_discount` int(3) default NULL,
  `product_price` double default NULL,
  `product_avatar` varchar(150) collate utf8_unicode_ci default NULL,
  `attr_val_labels` varchar(200) collate utf8_unicode_ci default NULL,
  `user_id_agency` int(100) default NULL,
  PRIMARY KEY  (`invoice_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(100) NOT NULL auto_increment,
  `menu_name` varchar(50) collate utf8_unicode_ci default NULL,
  `menu_parent` int(100) default NULL,
  `menu_index` int(10) default NULL,
  `menu_type` int(1) default NULL,
  `menu_format` varchar(10) collate utf8_unicode_ci default NULL,
  `menu_slug` varchar(100) collate utf8_unicode_ci default NULL,
  `menu_date_update` datetime default NULL,
  `menu_user_update` int(11) default NULL,
  PRIMARY KEY  (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_parent`, `menu_index`, `menu_type`, `menu_format`, `menu_slug`, `menu_date_update`, `menu_user_update`) VALUES
(1, 'Home', 0, NULL, 1, 'link', '/', NULL, NULL),
(2, 'Shop', 0, 1, 1, 'productcat', './', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `module_id` int(100) NOT NULL auto_increment,
  `module_name` varchar(50) collate utf8_unicode_ci default NULL,
  `module_description` varchar(100) collate utf8_unicode_ci default NULL,
  `module_location` varchar(10) collate utf8_unicode_ci default NULL,
  `module_index` int(10) default NULL,
  `module_type` varchar(10) collate utf8_unicode_ci default NULL,
  `module_config` longtext collate utf8_unicode_ci,
  PRIMARY KEY  (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `module_description`, `module_location`, `module_index`, `module_type`, `module_config`) VALUES
(2, 'Nổi bật', 'product 1', 'main', 1, 'product', 'a:2:{s:19:"module_product_type";s:3:"hot";s:20:"module_product_limit";s:2:"10";}'),
(3, 'Slider 1', 'Slider 1', 'main', 1, 'slider', 'a:3:{i:0;a:2:{s:12:"module_image";s:43:"public/upload/images/slider/sl_1%5B1%5D.png";s:11:"module_link";s:3:"abc";}i:1;a:2:{s:12:"module_image";s:36:"public/upload/images/slider/sl_2.png";s:11:"module_link";s:3:"abc";}i:2;a:2:{s:12:"module_image";s:36:"public/upload/images/slider/sl_3.png";s:11:"module_link";s:3:"abc";}}'),
(4, 'Quan cao product', 'Quan cao product', 'main', 1, 'banner', 'a:1:{i:0;a:2:{s:12:"module_image";s:50:"public/upload/images/banner/banner-cate%5B1%5D.png";s:11:"module_link";s:3:"abc";}}'),
(6, 'all', '', 'header', 454, 'slider', NULL),
(7, 'Quan cao product', 'Quan cao product', 'main', 2, 'banner', 'a:1:{i:0;a:2:{s:12:"module_image";s:39:"public/upload/images/banner/Capture.PNG";s:11:"module_link";s:1:"2";}}'),
(8, 'Quan cao product slider', 'Quan cao product slider', 'main', 1, 'banner', 'a:3:{i:0;a:2:{s:12:"module_image";s:41:"public/upload/images/banner/banner1-1.jpg";s:11:"module_link";s:2:"  ";}i:1;a:2:{s:12:"module_image";s:41:"public/upload/images/banner/banner1-2.jpg";s:11:"module_link";s:1:" ";}i:2;a:2:{s:12:"module_image";s:41:"public/upload/images/banner/banner1-3.jpg";s:11:"module_link";s:1:" ";}}'),
(9, 'Đang bán chạy', 'Đang bán chạy', 'main', 2, 'product', 'a:2:{s:19:"module_product_type";s:7:"selling";s:20:"module_product_limit";s:2:"10";}'),
(10, 'Đang giảm giá', 'Đang giảm giá', 'main', 3, 'product', 'a:2:{s:19:"module_product_type";s:4:"sale";s:20:"module_product_limit";s:2:"10";}');

-- --------------------------------------------------------

--
-- Table structure for table `module_detail`
--

CREATE TABLE IF NOT EXISTS `module_detail` (
  `module_id` int(100) default NULL,
  `module_detail_page` varchar(20) collate utf8_unicode_ci default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `module_detail`
--

INSERT INTO `module_detail` (`module_id`, `module_detail_page`) VALUES
(3, 'home'),
(4, 'productcategory'),
(6, '-1'),
(8, 'home'),
(2, 'home'),
(9, 'home'),
(7, 'home'),
(10, 'home');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` bigint(255) NOT NULL auto_increment,
  `career_id` int(11) default NULL,
  `product_code` varchar(100) default NULL,
  `product_name` varchar(150) default NULL,
  `product_price` double default NULL,
  `product_total` int(10) default NULL,
  `product_content` text,
  `product_description` text,
  `product_unit` varchar(20) default NULL,
  `product_index` bigint(225) default NULL,
  `product_show` int(1) default NULL,
  `product_slug` varchar(100) default NULL,
  `product_date_create` datetime default NULL,
  `product_avatar` varchar(150) default NULL,
  `product_sale` int(10) default NULL,
  `product_date_sale` datetime default NULL,
  `product_view` int(100) default NULL,
  `product_feature` int(1) default NULL,
  `product_like` int(100) default NULL,
  `product_selling` int(1) default NULL,
  `product_new` int(1) default NULL,
  `product_search` varchar(255) default NULL,
  `product_date_update` datetime default NULL,
  `product_user_update` int(100) default NULL,
  `product_delete` int(1) default NULL,
  PRIMARY KEY  (`product_id`),
  KEY `id_nganhnghe` (`career_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `career_id`, `product_code`, `product_name`, `product_price`, `product_total`, `product_content`, `product_description`, `product_unit`, `product_index`, `product_show`, `product_slug`, `product_date_create`, `product_avatar`, `product_sale`, `product_date_sale`, `product_view`, `product_feature`, `product_like`, `product_selling`, `product_new`, `product_search`, `product_date_update`, `product_user_update`, `product_delete`) VALUES
(27, 1, 'funiture1', 'hand made painted wood furniture', 6700000, 20, '', NULL, 'bộ', NULL, 1, 'hand-made-painted-wood-furniture', '2016-12-04 14:02:08', 'hand-made-painted-wood-furniture-57961480834876.jpeg', 0, NULL, 5, 2, 1, 2, 2, 'hand made painted wood furniture 6700000', '2016-12-04 14:02:08', NULL, NULL),
(28, 1, 'product2', 'Manufacturers and sellers of soft furniture for homes, hotels, restaurants', 2987878, 34, 'Manufacturers and sellers of soft furniture for homes, hotels, restaurants{readmore}\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td colspan="2">\r\n			<h2>Produit</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Type</th>\r\n			<td>Furniture</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Origine</th>\r\n			<td>Lithuanie</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Style</th>\r\n			<td>Contemporain</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Type de mat&eacute;riaux principal</th>\r\n			<td>Autres mat&eacute;riaux</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Mat&eacute;riaux principal</th>\r\n			<td>Contreplaqu&eacute; - multiplex</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2">\r\n			<h2>Sp&eacute;cifications</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Quantit&eacute;</th>\r\n			<td>20.0 - 40.0 pi&egrave;ces par mois</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Certification</th>\r\n			<td>ISO 9001</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Description</th>\r\n			<td>This model is made in accordance with European standards. Comfortable,</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2">\r\n			<h2>Prix et Conditions</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Prix</th>\r\n			<td><a href="javascript:showAskPrice(''17920885'');">Demandez le prix</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th>D&eacute;lai de livraison</th>\r\n			<td>Disponible sur commande en moins de 30 jours</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Vend en:</th>\r\n			<td>Oc&eacute;anie , Antarctique, Afrique, Am&eacute;rique du sud, Am&eacute;rique du nord, Europe, Asie</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Manufacturers and sellers of soft furniture for homes, hotels, restaurants', 'bo', NULL, 1, 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants', '2016-12-04 14:05:23', 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants-10741480835098.jpeg', 0, NULL, 49, 1, 0, 1, 1, 'manufacturers and sellers of soft furniture for homes, hotels, restaurants 2987878', '2016-12-04 14:05:23', NULL, NULL),
(29, 1, 'pp1', ' Phong cách Châu Á hiện đại', 22222222, 10, 'Kiến tr&uacute;c hiện đại l&agrave; một sự đoạn tuyệt mạnh mẽ với kiến tr&uacute;c cổ điển, thể hiện một lối tư duy mới của sự ph&aacute;t triển&nbsp;{readmore}\r\n<p>Kiến tr&uacute;c hiện đại l&agrave; một sự đoạn tuyệt mạnh mẽ với kiến tr&uacute;c cổ điển, thể hiện một lối tư duy mới của sự ph&aacute;t triển b&ugrave;ng nổ của c&aacute;c x&atilde; hội Ch&acirc;u &Acirc;u&nbsp;cuối thế kỉ 19, đầu thế kỉ 20. sự đơn giản trong bố cục h&igrave;nh khối kh&ocirc;ng gian mặt đứng loại bỏ việc sử dụng c&aacute;c họa tiết trang tr&iacute; của trường ph&aacute;i cổ điển&nbsp;cũng như việc sử dụng vật liệu&nbsp;mới như k&iacute;nh, th&eacute;p, b&ecirc; t&ocirc;ng</p>\r\n\r\n<p>Sự ra đời của kiến tr&uacute;c hiện đại đ&atilde; mang đến sự h&igrave;nh th&agrave;nh phong c&aacute;ch hiện đại trong thiết kế nội. Phong c&aacute;ch thiết kế hiện đại, sạch sẽ, tập trung chủ yếu v&agrave;o t&iacute;nh c&ocirc;ng năng v&agrave; tr&aacute;nh c&aacute;c phụ kiện rườm r&agrave;, c&aacute;c trang tr&iacute; qu&aacute; mức thường thấy trong nhiều phong c&aacute;ch kh&aacute;c. Một số người cảm thấy việc thiết kế hiện đại l&agrave; qu&aacute; đơn giản, th&ocirc; hoặc lạnh, tuy nhi&ecirc;n khi được l&ecirc;n kế hoạch chặt chẽ, hợp l&yacute;, n&oacute; sẽ tạo n&ecirc;n cảm gi&aacute;c y&ecirc;n b&igrave;nh v&agrave; đơn giản cho ng&ocirc;i nh&agrave; của bạn.</p>\r\n\r\n<p>V&iacute; dụ dưới đ&acirc;y sẽ cho c&aacute;c bạn thấy được phong c&aacute;ch hiện đại được thiết kế cho một căn nh&agrave; phố biệt thự tại quận 7.&nbsp;Phong c&aacute;ch Ch&acirc;u &Aacute; hiện đại</p>\r\n', 'Kiến tr&uacute;c hiện đại l&agrave; một sự đoạn tuyệt mạnh mẽ với kiến tr&uacute;c cổ điển, thể hiện một lối tư duy mới của sự ph&aacute;t triển&nbsp;', '', NULL, 1, 'phong-cach-chau-a-hien-dai', '2016-12-05 05:00:34', 'phong-cach-chau-a-hien-dai-64951480888792.jpg', 0, NULL, 10, 1, 0, 1, 1, 'phong c&aacute;ch ch&acirc;u &aacute; hien dai 22222222', '2016-12-05 05:00:34', NULL, NULL),
(30, 1, 'CB602 ', 'Combo đồ nội thất đẹp ', 14600000, 10, 'Bộ&nbsp;Combo đồ nội thất đẹp m&atilde; CB602 gồm&nbsp;<a href="http://nhaxinhplaza.vn/ke-tivi/ke-tivi-go-ma-ktv614.html"><strong>Kệ tivi gỗ m&atilde; KTV614</strong></a>&nbsp;v&agrave;&nbsp;<a href="http://nhaxinhplaza.vn/ban-tra/ban-tra-go-ma-bt611.html"><strong>B&agrave;n tr&agrave; gỗ m&atilde; BT611</strong></a>&nbsp;được thiết kế ban sẵn tại Nội Thất Xinh{readmore}\r\n<h2><strong>Mẫu nội thất b&aacute;n sẵn mới nhất 2016 tại Nội Thất Xinh</strong></h2>\r\nBộ&nbsp;Combo đồ nội thất đẹp m&atilde; CB602 gồm&nbsp;<a href="http://nhaxinhplaza.vn/ke-tivi/ke-tivi-go-ma-ktv614.html"><strong>Kệ tivi gỗ m&atilde; KTV614</strong></a>&nbsp;v&agrave;&nbsp;<a href="http://nhaxinhplaza.vn/ban-tra/ban-tra-go-ma-bt611.html"><strong>B&agrave;n tr&agrave; gỗ m&atilde; BT611</strong></a>&nbsp;được thiết kế ban sẵn tại Nội Thất Xinh. Sản phẩm mang đến cho kh&ocirc;ng gian sống n&eacute;t đẹp h&agrave;i h&ograve;a cả về c&ocirc;ng năng sử dụng, m&agrave;u sắc v&agrave; &iacute;nh thẩm mỹ. Đ&acirc;y chắc chắn sẽ l&agrave; m&oacute;n đồ nội thất xứng đ&aacute;ng để đặt trong căn ph&ograve;ng kh&aacute;ch hiện đại v&agrave; sang trọng m&agrave; bạn mong muốn c&oacute; được.<br />\r\n&nbsp;', 'Bộ&nbsp;Combo đồ nội thất đẹp m&atilde; CB602 gồm&nbsp;<a href="http://nhaxinhplaza.vn/ke-tivi/ke-tivi-go-ma-ktv614.html"><strong>Kệ tivi gỗ m&atilde; KTV614</strong></a>&nbsp;v&agrave;&nbsp;<a href="http://nhaxinhplaza.vn/ban-tra/ban-tra-go-ma-bt611.html"><strong>B&agrave;n tr&agrave; gỗ m&atilde; BT611</strong></a>&nbsp;được thiết kế ban sẵn tại Nội Thất Xinh', '', NULL, 1, 'combo-do-noi-that-dep-ma-cb602-combo-do-noi-that-dep-ma-cb602-combo-do-noi-that-dep-ma-cb602', '2016-12-05 00:00:00', 'combo-do-noi-that-dep-ma-cb602-combo-do-noi-that-dep-ma-cb602-combo-do-noi-that-dep-ma-cb602-57441480889059.JPG', 0, NULL, 0, 1, 0, 2, 1, 'combo do noi that dep 14600000', '2016-12-05 05:21:56', NULL, NULL),
(31, 1, ' KTV613', 'Kệ tivi gỗ ', 7300000, 20, '<h2><strong>Mẫu kệ tivi bền đẹp tại H&agrave; Nội</strong>{readmore}</h2>\r\n\r\n<h2><strong>Mẫu kệ tivi bền đẹp tại H&agrave; Nội</strong></h2>\r\nKệ tivi gỗ m&atilde; KTV613 l&agrave; một trong những mẫu sản phẩm nội thất đẹp được thiết kế với chất lượng vượt trội được b&aacute;n tại Nội Thất Xinh. Nếu bạn muốn sở hữu một kh&ocirc;ng gian nội thất hiện đại, mẫu&nbsp;<a href="http://nhaxinhplaza.vn/ke-tivi.html"><strong>kệ tivi đẹp rẻ</strong></a>&nbsp;n&agrave;y chắc chắn sẽ l&agrave; gợi &yacute; th&ocirc;ng minh nhất.\r\n\r\n<ul>\r\n	<li>Xuất xứ: Nội Thất Xinh</li>\r\n	<li>K&iacute;ch thước: 2200 x 450 x 380</li>\r\n	<li>Chất liệu: gỗ MDF l&otilde;i xanh nhập khẩu Malaysia cao cấp</li>\r\n	<li>Gam m&agrave;u đen trắng hiện đại</li>\r\n	<li>Thiết kế tối giản nhưng sang trọng</li>\r\n	<li>Kệ tivi đẹp được sơn bệt chống xước tốt</li>\r\n	<li>Bảo h&agrave;nh 12 th&aacute;ng, bảo tr&igrave; trọn đời</li>\r\n</ul>\r\n', '<h2><strong>Mẫu kệ tivi bền đẹp tại H&agrave; Nội</strong>', 'bộ', NULL, 1, 'ke-tivi-go-ma-ktv613-ke-tivi-go-ma-ktv613-ke-tivi-go', '2016-12-05 00:00:00', 'ke-tivi-go-ma-ktv613-ke-tivi-go-ma-ktv613-ke-tivi-go-72131480889260.jpg', 0, NULL, 1, 1, 0, 1, 1, 'ke tivi go 7300000', '2016-12-05 05:21:05', NULL, NULL),
(32, 1, ' NDT2810', 'Sofa da thật', 33333333, 100, '<h2>Mẫu sofa da thật cao cấp mới nhất 2016<br />\r\n{readmore}<br />\r\nC&aacute;c mẫu&nbsp;<a href="http://nhaxinhplaza.vn/tag/sofa-da-that.html" style="font-size: 13px;"><strong>ghế sofa da thật</strong></a><span style="font-size:13px">&nbsp;thiết kế đẹp mắt, chất liệu sử dụng được lựa chọn cẩn thận, kiểu d&aacute;ng đặt linh hoạt th&iacute;ch hợp cho nhiều dạng kh&ocirc;ng gian nội thất &nbsp;kh&aacute;c nhau. Bộ&nbsp;Sofa da thật m&atilde; NDT2810 l&agrave; một trong những sản phẩm đ&aacute;p ứng rất nhiều ưu điểm quan trọng, gi&uacute;p bạn dễ d&agrave;ng đặt trong c&aacute;c gian ph&ograve;ng kh&aacute;ch, văn ph&ograve;ng c&ocirc;ng ty....</span></h2>\r\n', '<h2>Mẫu sofa da thật cao cấp mới nhất 2016<br />\r\n', 'bộ', NULL, 1, 'sofa-da-that', '2016-12-05 05:11:17', 'sofa-da-that-12721480889443.jpg', 0, NULL, 1, 2, 0, 2, 2, 'sofa da that 33333333', '2016-12-05 05:11:17', NULL, NULL),
(33, 1, 'NTX601', 'Sofa bán sẵn', 18500000, 200, 'Ghế sofa b&aacute;n tại Nội Thất Xinh lu&ocirc;n l&agrave; lựa chọn được ưu ti&ecirc;n mang đến cho kh&ocirc;ng gian nội thất trong căn nh&agrave; của bạn vẻ đẹp sang trọng v&agrave; gần gũ{readmore}<br />\r\nGhế sofa b&aacute;n tại Nội Thất Xinh lu&ocirc;n l&agrave; lựa chọn được ưu ti&ecirc;n mang đến cho kh&ocirc;ng gian nội thất trong căn nh&agrave; của bạn vẻ đẹp sang trọng v&agrave; gần gũi. Nếu bạn kh&ocirc;ng c&oacute; thời gian đặt mua sản phẩm sofa, h&atilde;y thử trải nghiệm với những&nbsp;<a href="http://nhaxinhplaza.vn/sofa-ban-san.html">mẫu b&agrave;n ghế sofa b&aacute;n sẵn</a>&nbsp;tại showroom Nội Thất Xinh của ch&uacute;ng t&ocirc;i.\r\n\r\n<h2><strong>Mẫu sofa b&aacute;n sẵn NTX601 - Lựa chọn ho&agrave;n hảo cho kh&ocirc;ng gian tiện nghi</strong></h2>\r\n', 'Ghế sofa b&aacute;n tại Nội Thất Xinh lu&ocirc;n l&agrave; lựa chọn được ưu ti&ecirc;n mang đến cho kh&ocirc;ng gian nội thất trong căn nh&agrave; của bạn vẻ đẹp sang trọng v&agrave; gần gũ', 'bộ', NULL, 1, 'sofa-ban-san', '2016-12-05 00:00:00', 'sofa-ban-san-61821480889691.jpg', 0, NULL, 2, 2, 0, 1, 2, 'sofa b&aacute;n san 18500000', '2016-12-05 05:18:00', NULL, NULL),
(34, 1, 'G24', 'Sofa phòng ngủ mã G24 Sofa phòng ngủ mã G24 Sofa phòng ngủ', 10400000, 100, 'Kh&ocirc;ng giống như những bộ&nbsp;<a href="http://nhaxinhplaza.vn/sofa.html"><strong>ghế sofa</strong></a>&nbsp;th&ocirc;ng thường, chiếc ghế sofa ph&ograve;ng ngủ m&atilde; G24 t&ocirc;ng m&agrave;u hồng nhạt&nbsp;{readmore}<br />\r\nCung cấp h&agrave;ng trăm mẫu sofa tr&ecirc;n thị trường, Nội thất xinh lu&ocirc;n khẳng định thương hiệu của m&igrave;nh tới kh&aacute;ch h&agrave;ng kh&ocirc;ng chỉ ở chất lượng, m&agrave; c&ograve;n mẫu m&atilde;, kiểu d&aacute;ng v&agrave; gi&aacute; cả v&ocirc; c&ugrave;ng hấp dẫn.<a href="http://nhaxinhplaza.vn/sofa-phong-ngu.html"><strong>Sofa ph&ograve;ng ngủ</strong></a>&nbsp;b&aacute;n sẵn tại&nbsp;<strong>showroom Nội thất xinh 321 Trường Chinh</strong>&nbsp;l&agrave; một v&iacute; dụ điển h&igrave;nh\r\n<h2><strong>Nội thất xinh b&aacute;n&nbsp;Sofa ph&ograve;ng ngủ m&atilde; G24&nbsp;</strong></h2>\r\nKh&ocirc;ng giống như những bộ&nbsp;<a href="http://nhaxinhplaza.vn/sofa.html"><strong>ghế sofa</strong></a>&nbsp;th&ocirc;ng thường, chiếc ghế sofa ph&ograve;ng ngủ m&atilde; G24 t&ocirc;ng m&agrave;u hồng nhạt được thiết kế th&ocirc;ng minh, mang đến sự mới lạ, độc đ&aacute;o v&agrave; hấp dẫn c&oacute; thể k&eacute;o ra th&agrave;nh giường một c&aacute;ch dễ d&agrave;ng, thuận tiện cho việc bạn ngồi tiếp kh&aacute;ch, đọc b&aacute;o, xem tivi, khi mệt mỏi bạn c&oacute; thể k&eacute;o ra ngay lập tức n&oacute; sẽ biến h&oacute;a th&agrave;nh chiếc giường ngủ &ecirc;m &aacute;i, dễ chịu.', 'Kh&ocirc;ng giống như những bộ&nbsp;<a href="http://nhaxinhplaza.vn/sofa.html"><strong>ghế sofa</strong></a>&nbsp;th&ocirc;ng thường, chiếc ghế sofa ph&ograve;ng ngủ m&atilde; G24 t&ocirc;ng m&agrave;u hồng nhạt&nbsp;', 'bộ', NULL, 1, 'sofa-phong-ngu-ma-g24-sofa-phong-ngu-ma-g24-sofa-phong-ngu', '2016-12-05 00:00:00', 'sofa-phong-ngu-ma-g24-sofa-phong-ngu-ma-g24-sofa-phong-ngu-60561480890379.jpg', 20, NULL, 11, 1, 0, 1, 1, 'sofa ph&ograve;ng ngu m&atilde; g24 sofa ph&ograve;ng ngu m&atilde; g24 sofa ph&ograve;ng ngu 10400000', '2016-12-05 05:37:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productattr`
--

CREATE TABLE IF NOT EXISTS `productattr` (
  `productattr_id` int(225) NOT NULL auto_increment,
  `productattr_name` varchar(100) default NULL,
  `productattr_index` int(255) default NULL,
  `career_id` int(100) default NULL,
  `productattr_showfilter` int(1) default NULL,
  `productattr_date_update` datetime default NULL,
  `productattr_user_update` int(100) default NULL,
  PRIMARY KEY  (`productattr_id`),
  KEY `id_ngonngu` (`productattr_date_update`),
  KEY `id_nganhnghe` (`career_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `productattr`
--

INSERT INTO `productattr` (`productattr_id`, `productattr_name`, `productattr_index`, `career_id`, `productattr_showfilter`, `productattr_date_update`, `productattr_user_update`) VALUES
(1, 'Màu sắc', 1, 1, 1, '2016-12-03 14:45:54', NULL),
(3, 'Chất liệu', 2, 1, 1, '2016-12-03 14:45:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productattr_detail`
--

CREATE TABLE IF NOT EXISTS `productattr_detail` (
  `product_detail_id` bigint(255) default NULL,
  `product_id` bigint(255) default NULL,
  `productattr_id` int(255) default NULL,
  `attr_val_id` int(255) default NULL,
  KEY `id_thuoctinhchon` (`productattr_id`),
  KEY `id_giatrithuoctinhchon` (`attr_val_id`),
  KEY `id_sanpham` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productattr_detail`
--

INSERT INTO `productattr_detail` (`product_detail_id`, `product_id`, `productattr_id`, `attr_val_id`) VALUES
(-1, 27, 1, 1),
(-1, 27, 1, 2),
(-1, 27, 3, 4),
(-1, 27, 3, 5),
(-1, 27, 3, 6),
(-1, 28, 1, 2),
(-1, 28, 3, 4),
(-1, 29, 1, 1),
(-1, 29, 3, 5),
(-1, 33, 1, 1),
(-1, 33, 1, 2),
(-1, 33, 3, 4),
(-1, 33, 3, 5),
(-1, 33, 3, 6),
(-1, 31, 1, 1),
(-1, 31, 1, 2),
(-1, 31, 3, 4),
(-1, 31, 3, 5),
(-1, 34, 1, 1),
(-1, 34, 1, 2),
(-1, 34, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

CREATE TABLE IF NOT EXISTS `productcategory` (
  `productcategory_id` int(100) NOT NULL auto_increment,
  `productcategory_name` varchar(100) default NULL,
  `productcategory_parent` int(100) default NULL,
  `productcategory_index` int(100) default NULL,
  `productcategory_slug` varchar(100) default NULL,
  `productcategory_icon` varchar(150) default NULL,
  `productcategory_panel` varchar(255) default NULL,
  `career_id` int(100) default NULL,
  `productcategory_show` int(1) default NULL,
  `productcategory_showmenu` int(1) default NULL,
  `productcategory_date_update` datetime default NULL,
  `productcategory_user_update` int(100) default NULL,
  PRIMARY KEY  (`productcategory_id`),
  KEY `id_nganhnghe` (`career_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`productcategory_id`, `productcategory_name`, `productcategory_parent`, `productcategory_index`, `productcategory_slug`, `productcategory_icon`, `productcategory_panel`, `career_id`, `productcategory_show`, `productcategory_showmenu`, `productcategory_date_update`, `productcategory_user_update`) VALUES
(1, 'Nội thất hiện đại', 0, NULL, 'noi-that-hien-dai', 'http://wp.smartaddons.com/themes/sw_market/wp-content/uploads/2015/03/7.png', '', 1, 1, 2, '2016-12-05 06:12:57', NULL),
(2, 'Nội thất cổ điển', 0, 1, 'noi-that-co-dien', 'http://wp.smartaddons.com/themes/sw_market/wp-content/uploads/2015/03/13.png', '', 1, 1, 2, '2016-12-05 06:12:57', NULL),
(3, 'Nội thất phòng khách', 0, 2, 'noi-that-phong-khach', '', '', 1, 1, 2, '2016-12-05 06:12:57', NULL),
(4, 'Nội thất phòng ngủ', 0, 3, 'noi-that-phong-ngu', '', '', 1, 1, 2, '2016-12-05 06:12:57', NULL),
(7, 'Nội thất khách sạn', 0, 4, 'noi-that-khach-san', '', '', 1, 1, 2, '2016-12-05 06:12:57', NULL),
(11, 'Nội thất gỗ', 2, NULL, 'noi-that-go', '', NULL, 1, 1, NULL, '2016-12-05 06:12:57', NULL),
(12, 'Nội thất hoa văn', 2, 1, 'noi-that-hoa-van', '', NULL, 1, 1, NULL, '2016-12-05 06:12:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productcategory_detail`
--

CREATE TABLE IF NOT EXISTS `productcategory_detail` (
  `product_id` bigint(255) default NULL,
  `productcategory_id` int(255) default NULL,
  KEY `id_sanpham` (`product_id`),
  KEY `id_danhmuc` (`productcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productcategory_detail`
--

INSERT INTO `productcategory_detail` (`product_id`, `productcategory_id`) VALUES
(27, 2),
(28, 2),
(29, 1),
(32, 3),
(32, 4),
(32, 7),
(33, 7),
(31, 3),
(30, 3),
(34, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE IF NOT EXISTS `product_detail` (
  `product_detail_id` bigint(255) NOT NULL auto_increment,
  `product_id` bigint(255) default NULL,
  `product_detail_price` float(100,0) default NULL,
  `product_detail_total` int(100) default NULL,
  `product_detail_avatar` varchar(150) default NULL,
  `product_detail_date_create` datetime default NULL,
  `product_detail_date_update` datetime default NULL,
  `product_detail_user_update` int(100) default NULL,
  PRIMARY KEY  (`product_detail_id`),
  KEY `id_sanpham` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `product_id` bigint(255) default NULL,
  `product_images_name` varchar(150) default NULL,
  `product_images_index` int(100) default NULL,
  `product_images_id` bigint(255) NOT NULL auto_increment,
  PRIMARY KEY  (`product_images_id`),
  KEY `id_sanpham` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`product_id`, `product_images_name`, `product_images_index`, `product_images_id`) VALUES
(27, 'hand-made-painted-wood-furniture-19321480834896.jpeg', 1, 232),
(28, 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants-3531480835108.jpeg', 1, 233),
(28, 'manufacturers-and-sellers-of-soft-furniture-for-homes-hotels-restaurants-83121480835115.jpeg', 2, 234),
(29, 'phong-cach-chau-a-hien-dai-25581480888804.jpg', 1, 235),
(29, 'phong-cach-chau-a-hien-dai-41851480888813.jpg', 2, 236),
(29, 'phong-cach-chau-a-hien-dai-64881480888821.jpg', 3, 237),
(29, 'phong-cach-chau-a-hien-dai-20001480888830.jpg', 4, 238),
(32, 'sofa-da-that-71731480889448.jpg', 1, 239);

-- --------------------------------------------------------

--
-- Table structure for table `product_prop`
--

CREATE TABLE IF NOT EXISTS `product_prop` (
  `product_prop_id` int(255) NOT NULL auto_increment,
  `product_prop_name` varchar(100) default NULL,
  `product_prop_index` int(100) default NULL,
  `career_id` int(100) default NULL,
  `product_prop_date_update` datetime default NULL,
  `product_prop_user_update` int(100) default NULL,
  PRIMARY KEY  (`product_prop_id`),
  KEY `id_ngonngu` (`product_prop_date_update`),
  KEY `id_nganhnghe` (`career_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product_prop`
--

INSERT INTO `product_prop` (`product_prop_id`, `product_prop_name`, `product_prop_index`, `career_id`, `product_prop_date_update`, `product_prop_user_update`) VALUES
(1, 'Xuất xứ', 1, 1, '2016-11-16 21:00:13', NULL),
(2, 'Bảo hành', 2, 1, '2016-12-05 05:05:13', NULL),
(3, 'Màu sắc', 3, 1, '2016-12-05 05:05:21', NULL),
(4, 'Chất liệu', 4, 1, '2016-12-05 05:05:29', NULL),
(5, 'Kích thước', 5, 1, '2016-12-05 05:05:34', NULL),
(6, 'Tình trạng', 6, 1, '2016-12-05 05:05:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_prop_detail`
--

CREATE TABLE IF NOT EXISTS `product_prop_detail` (
  `product_id` bigint(255) default NULL,
  `product_prop_id` int(255) default NULL,
  `product_prop_detail_value` text,
  KEY `id_thuoctinh` (`product_prop_id`),
  KEY `id_sanpham` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_prop_detail`
--

INSERT INTO `product_prop_detail` (`product_id`, `product_prop_id`, `product_prop_detail_value`) VALUES
(29, 1, '1000000'),
(32, 1, 'Nội Thất Xinh'),
(32, 2, '7 năm'),
(32, 3, 'Vàng cam'),
(32, 4, ' Da Thật'),
(32, 5, '2820x1760x880'),
(32, 6, 'Đặt Hàng'),
(33, 1, 'Nội Thất Xinh'),
(33, 2, '6 năm'),
(33, 3, 'Màu đen'),
(33, 4, 'Vải Loki'),
(33, 5, '2750x1700x850'),
(33, 6, 'Có sẵn'),
(31, 1, 'Nội Thất Xinh'),
(31, 2, '12T'),
(31, 3, 'Trắng - Đen'),
(31, 4, 'Trắng - Đen'),
(31, 5, '2200 x 450 x 380'),
(31, 6, 'Đặt Hàng'),
(34, 1, 'Nội Thất Xinh'),
(34, 2, ' 6 năm'),
(34, 3, 'Màu sữa'),
(34, 4, ' Nỉ cao cấp'),
(34, 5, '1900*1800'),
(34, 6, 'Có sẵn');

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE IF NOT EXISTS `product_tag` (
  `product_id` bigint(255) default NULL,
  `tag_id` int(255) default NULL,
  KEY `id_sanpham` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`product_id`, `tag_id`) VALUES
(33, 6),
(31, 5),
(34, 6);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(100) NOT NULL auto_increment,
  `role_role` varchar(20) collate utf8_unicode_ci default NULL,
  `role_controller` varchar(20) collate utf8_unicode_ci default NULL,
  `role_action` varchar(20) collate utf8_unicode_ci default NULL,
  `role_date_update` datetime default NULL,
  `role_user_update` int(100) default NULL,
  PRIMARY KEY  (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_role`, `role_controller`, `role_action`, `role_date_update`, `role_user_update`) VALUES
(1, 'administrator', 'menu', 'index', '2016-12-04 00:54:57', NULL),
(2, 'administrator', 'config', 'update', '2016-12-04 00:54:57', NULL),
(3, 'administrator', 'career', 'insert', '2016-12-04 00:54:57', NULL),
(4, 'administrator', 'productattr', 'insert', '2016-12-04 00:54:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(255) NOT NULL auto_increment,
  `tag_name` varchar(100) default NULL,
  `tag_index` int(255) default NULL,
  `tag_view` int(100) default NULL,
  `tag_slug` varchar(100) default NULL,
  `tag_search` varchar(100) default NULL,
  PRIMARY KEY  (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `tag_index`, `tag_view`, `tag_slug`, `tag_search`) VALUES
(1, '434', NULL, 0, '434', '434'),
(2, 'fre', NULL, 0, 'fre', 'fre'),
(3, 'abc', NULL, 0, 'abc', 'abc'),
(4, '34543534', NULL, 0, '34543534', '34543534'),
(5, 'kệ tivi', NULL, 0, 'ke-tivi', 'ke tivi'),
(6, 'sofa cao cấp', NULL, 0, 'sofa-cao-cap', 'sofa cao cap');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(100) NOT NULL auto_increment,
  `user_email` varchar(100) collate utf8_unicode_ci default NULL,
  `user_password` varchar(20) collate utf8_unicode_ci default NULL,
  `user_name` varchar(100) collate utf8_unicode_ci default NULL,
  `user_sex` int(1) default NULL,
  `user_birthday` datetime default NULL,
  `user_phone` int(15) default NULL,
  `user_address` varchar(50) collate utf8_unicode_ci default NULL,
  `user_note` text collate utf8_unicode_ci,
  `user_id_social` varchar(50) collate utf8_unicode_ci default NULL,
  `user_role` varchar(20) collate utf8_unicode_ci default NULL,
  `user_avatar` varchar(150) collate utf8_unicode_ci default NULL,
  `user_status` int(1) default NULL,
  `user_date_update` datetime default NULL,
  `user_user_update` int(100) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usergroup`
--

CREATE TABLE IF NOT EXISTS `usergroup` (
  `usergroup_id` int(10) NOT NULL auto_increment,
  `usergroup_name` varchar(50) default NULL,
  `usergroup_parent` int(10) default NULL,
  `usergroup_index` varchar(255) default NULL,
  PRIMARY KEY  (`usergroup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `usergroup`
--

INSERT INTO `usergroup` (`usergroup_id`, `usergroup_name`, `usergroup_parent`, `usergroup_index`) VALUES
(5, '3 r r', 0, '0'),
(12, '46fdg fdg gdf ', 0, '1'),
(13, '46fdg fdg gdf ', 12, '2'),
(14, '46fdg fdg gdf ', 13, '3'),
(15, '46fdg fdg gdf ', 0, '4'),
(16, '46fdg fdg gdf ', 15, '5');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
