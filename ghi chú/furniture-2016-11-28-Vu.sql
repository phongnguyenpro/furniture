-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2016 at 03:35 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `attr_val`
--

INSERT INTO `attr_val` (`attr_val_id`, `productattr_id`, `attr_val_value`, `attr_val_index`, `attr_val_label`, `attr_val_date_update`, `attr_val_user_update`) VALUES
(1, 1, 'đỏ', 1, 'đỏ', NULL, NULL),
(2, 1, 'tím', 2, 'tím', NULL, NULL),
(3, 2, 'tèn ten 1', 1, 'tèn ten 1', NULL, NULL);

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
(1, 'abc', 1, '2016-11-16 20:59:27', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_parent`, `menu_index`, `menu_type`, `menu_format`, `menu_slug`, `menu_date_update`, `menu_user_update`) VALUES
(1, 'abc', 0, NULL, 1, 'link', 'http://www.codeigniter.com/user_guide/general/caching.html', NULL, NULL),
(2, 'Home', 0, 1, 1, 'link', './', NULL, NULL),
(3, 'Home', 2, 2, 1, 'link', '/', NULL, NULL),
(4, 'Home', 3, 3, 1, 'link', '/', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `module_description`, `module_location`, `module_index`, `module_type`, `module_config`) VALUES
(1, '5654', '8900p', 'header', 45654, 'slider', 'a:0:{}'),
(2, 'product 2', 'product 1', 'left', 1, 'product', 'a:2:{s:19:"module_product_type";s:3:"hot";s:20:"module_product_limit";s:2:"10";}');

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
(1, '-1'),
(2, '-1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `career_id`, `product_code`, `product_name`, `product_price`, `product_total`, `product_content`, `product_description`, `product_unit`, `product_index`, `product_show`, `product_slug`, `product_date_create`, `product_avatar`, `product_sale`, `product_date_sale`, `product_view`, `product_feature`, `product_like`, `product_selling`, `product_new`, `product_search`, `product_date_update`, `product_user_update`, `product_delete`) VALUES
(2, 1, '345 fsdf sdfsdf ds', 'sản phẩm 1', 5435, 53453, '3454343dsf<br />\r\n{readmore}<br />\r\nsdfdsf', '3454343dsf<br />\r\n', '43543 sdfd', 2, 1, ' 34543  sfd', '0000-00-00 00:00:00', '345435-28501479337623.jpg', 0, NULL, 147, 2, 0, 2, 2, '345435 5435', '2016-11-16 21:13:21', NULL, NULL),
(3, NULL, '345 fsdf sdfsdf ds', '345435 dsfds ', 54354353409, 53453, '3454343dsf<br />\r\n{readmore}<br />\r\nsdfdsf', '3454343dsf<br />\r\n', '43543 sdfd', 3, 1, ' 34543  sfd', '1970-01-01 00:00:00', NULL, 0, NULL, 0, 2, 0, 2, 2, '345435 dsfds 54354353409', '2016-11-17 06:41:50', NULL, NULL),
(4, NULL, '345 fsdf sdfsdf ds', '345435 dsfds ', 54354353409, 53453, '3454343dsf<br />\r\n{readmore}<br />\r\nsdfdsf', '3454343dsf<br />\r\n', '43543 sdfd', 4, 1, ' 34543  sfd', '1970-01-01 00:00:00', NULL, 0, NULL, 0, 2, 0, 2, 2, '345435 dsfds 54354353409', '2016-11-17 06:41:51', NULL, NULL),
(5, NULL, '345 fsdf sdfsdf ds', '345435 dsfds ', 54354353409, 53453, '3454343dsf<br />\r\n{readmore}<br />\r\nsdfdsf', '3454343dsf<br />\r\n', '43543 sdfd', 5, 1, ' 34543  sfd', '1970-01-01 00:00:00', NULL, 0, NULL, 0, 2, 0, 2, 2, '345435 dsfds 54354353409', '2016-11-17 06:42:02', NULL, NULL),
(6, 1, '56654', '654654', 5465, 2147483647, '5654', NULL, '46546', 6, 1, ' 56546', '2016-11-20 00:00:00', '654654-30371479526086.jpg', 0, NULL, 0, 2, 0, 2, 2, '654654 5465', '2016-11-19 10:28:10', NULL, NULL),
(7, 1, '345', '43534', 54353, 345, '345', NULL, '4543', 7, 1, ' 34543', '2016-11-19 10:35:00', NULL, 0, NULL, 0, 2, 0, 2, 2, '43534 54353', '2016-11-19 10:35:00', NULL, NULL),
(8, 1, 'fwe', 'sf g  ẻ4', 435, 54354, '34543', NULL, '43543', 8, 1, 'sf-g-e4', '2016-11-19 00:00:00', 'sf-g-e4-85691479526703.jpg', 0, NULL, 0, 2, 0, 2, 2, 'sf g  e4 435', '2016-11-19 10:37:34', NULL, NULL),
(9, 1, '456', 'CAMRY E (AT)vds ', 34543, 345, '34543', NULL, '43543', 9, 1, 'camry-e-atvds', '2016-11-19 00:00:00', 'camry-e-atvds-46281479526825.jpg', 0, NULL, 0, 2, 0, 2, 2, 'camry e (at)vds 34543', '2016-11-19 10:40:05', NULL, NULL),
(10, 1, '32432', '32432', 234, 234234, '23423', NULL, '234', 10, 1, '32432', '2016-11-19 10:43:18', '32432-20481479527010.jpg', 0, NULL, 0, 2, 0, 2, 2, '32432 234', '2016-11-19 10:43:18', NULL, NULL),
(11, 1, '543', '5435', 5435, 435435, '34543', NULL, '435', 11, 1, '543543543', '2016-11-19 00:00:00', '5435-53241479527069.jpg', 0, NULL, 0, 1, 0, 1, 1, '5435 5435', '2016-11-19 10:44:21', NULL, NULL),
(12, 1, '324', '324324324', 32432, 243243, '32432', NULL, '43243', 13, 1, '324324324', '0000-00-00 00:00:00', '324324324-16061479605222.jpg', 0, NULL, 37, 1, 0, 2, 1, '324324324 32432', '2016-11-19 10:45:18', NULL, NULL),
(13, 1, '456', 'CAMRY E (AT)', 654654, 546, '5464', NULL, '654', 12, 1, ' 54654', '2016-11-19 00:00:00', 'camry-e-at-5331479527275.jpg', 0, NULL, 0, 2, 0, 2, 2, 'camry e (at) 654654', '2016-11-19 10:47:49', NULL, NULL),
(14, 1, '345', '34534', 34543, 543534, '3443', NULL, '534', NULL, 1, '345343', '2016-11-19 00:00:00', '34534-66401479528032.jpg', 0, NULL, 0, 1, 0, 2, 1, '34534 34543', '2016-11-19 11:00:28', NULL, NULL),
(15, 1, '345', '34534534', 543, 534543, '3453', NULL, '543543', NULL, 1, '34534534', '2016-11-19 00:00:00', '34534534-5671479528491.jpg', 0, NULL, 0, 2, 0, 2, 2, '34534534 543', '2016-11-19 11:07:35', NULL, NULL),
(16, 1, '456546', '546546546', 456546, 654654, '54654', NULL, '54654', NULL, 1, '54654654', '2016-11-19 00:00:00', '546546546-36311479528602.jpg', 0, NULL, 0, 1, 0, 2, 1, '546546546 456546', '2016-11-19 11:09:59', NULL, NULL),
(17, 1, '45', '55', 5454, 55, '456', NULL, '55', NULL, 1, '555', '0000-00-00 00:00:00', '55-61551479538741.jpg', 0, NULL, 0, 2, 0, 2, 2, '55 5454', '2016-11-19 11:13:22', NULL, NULL),
(18, 1, '45', '55', 5454, 55, '456', NULL, '55', NULL, 1, '555', '0000-00-00 00:00:00', NULL, 0, NULL, 0, 2, 0, 2, 2, '55 5454', '2016-11-19 12:35:36', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `productattr`
--

INSERT INTO `productattr` (`productattr_id`, `productattr_name`, `productattr_index`, `career_id`, `productattr_showfilter`, `productattr_date_update`, `productattr_user_update`) VALUES
(1, 'Màu sắc', 1, 1, 1, '2016-11-16 20:59:56', NULL),
(2, 'tèn ten', 2, 1, 1, '2016-11-20 10:04:38', NULL);

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
(1, 12, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`productcategory_id`, `productcategory_name`, `productcategory_parent`, `productcategory_index`, `productcategory_slug`, `productcategory_icon`, `productcategory_panel`, `career_id`, `productcategory_show`, `productcategory_showmenu`, `productcategory_date_update`, `productcategory_user_update`) VALUES
(1, 'Áo thun nam', 0, NULL, 'ao-thun-nam', '', '', 1, 1, 2, '2016-11-23 22:59:36', NULL),
(2, 'Quần nam', 1, NULL, 'quan-nam', '', '', 1, 1, 2, '2016-11-23 22:59:43', NULL),
(3, 'Thời trang nam', 0, 1, 'thoi-trang-nam', '', '', 1, 1, 2, '2016-11-23 23:00:11', NULL),
(4, 'Thời trang nữ', 0, 2, 'thoi-trang-nu', '', NULL, 1, 1, NULL, '2016-11-23 23:00:00', NULL);

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
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(1, NULL),
(17, 1),
(18, 1),
(12, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`product_detail_id`, `product_id`, `product_detail_price`, `product_detail_total`, `product_detail_avatar`, `product_detail_date_create`, `product_detail_date_update`, `product_detail_user_update`) VALUES
(1, 12, 16690000, 20, '324324324-21651479605395.jpg', '2016-11-26 08:48:25', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`product_id`, `product_images_name`, `product_images_index`, `product_images_id`) VALUES
(2, 'san-pham-1-10401479526041.jpg', 1, 23),
(6, '654654-56611479526088.jpg', 1, 24),
(6, '654654-26071479526088.jpg', 2, 25),
(9, 'camry-e-atvds-28361479526803.jpg', 1, 26),
(9, 'camry-e-atvds-56081479526803.jpg', 2, 27),
(10, '32432-13061479526961.jpg', 1, 28),
(10, '32432-74061479526961.jpg', 2, 29),
(13, 'camry-e-at-46501479527267.jpg', 1, 30),
(13, 'camry-e-at-75451479527267.jpg', 2, 31),
(14, '34534-77731479528037.jpg', 1, 32),
(14, '34534-78911479528037.jpg', 2, 33),
(14, '34534-52391479528037.png', 2, 34),
(14, '34534-73871479528037.jpg', 2, 35),
(15, '34534534-88321479528496.jpg', 1, 36),
(15, '34534534-54471479528497.jpg', 2, 37),
(15, '34534534-3911479528497.jpg', 3, 38),
(16, '546546546-63151479528606.jpg', 1, 39),
(16, '546546546-81201479528606.jpg', 1, 40),
(17, '55-5041479528818.jpg', 3, 41),
(17, '55-26761479528818.jpg', 2, 42),
(17, '55-54131479528818.jpg', 0, 43),
(17, '55-61801479528818.jpg', 1, 44),
(12, '324324324-14981479605395.jpg', 3, 60),
(12, '324324324-21651479605395.jpg', 3, 61),
(12, '324324324-52511479605395.jpg', 4, 62);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_prop`
--

INSERT INTO `product_prop` (`product_prop_id`, `product_prop_name`, `product_prop_index`, `career_id`, `product_prop_date_update`, `product_prop_user_update`) VALUES
(1, 'độ dài', 1, 1, '2016-11-16 21:00:13', NULL);

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
(1, 1, '32423'),
(2, 1, '34534'),
(3, 1, '34534'),
(4, 1, '34534'),
(5, 1, '34534'),
(6, 1, '546'),
(7, 1, '435'),
(8, 1, '454'),
(9, 1, '43543'),
(10, 1, '23423'),
(11, 1, '43534'),
(13, 1, '45654'),
(14, 1, '3443'),
(15, 1, '34543'),
(16, 1, '45654'),
(17, 1, 'new abc { abc 123 }'),
(18, 1, 'hjkl;'),
(12, 1, '32432');

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
(18, 1),
(18, 2),
(18, 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `tag_index`, `tag_view`, `tag_slug`, `tag_search`) VALUES
(1, '434', NULL, 0, '434', '434'),
(2, 'fre', NULL, 0, 'fre', 'fre'),
(3, 'abc', NULL, 0, 'abc', 'abc');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
