-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for testdb
CREATE DATABASE IF NOT EXISTS `testdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `testdb`;

-- Dumping structure for table testdb.admin_user
CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_group` int(11) NOT NULL DEFAULT 0,
  `admin_status` tinyint(1) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.admin_user: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` (`id`, `firstname`, `lastname`, `email`, `password`, `user_group`, `admin_status`, `date_added`, `date_modified`) VALUES
	(1, 'Christian', 'Pascual', 'cpascual107@gmail.com', 'admin', 1, 1, '2021-12-14 08:59:02', '2022-01-05 10:20:08'),
	(4, 'Hannah Clarisse', 'Toledo', 'hannahclarisse107@gmail.com', 'hannah', 2, 0, '2021-12-18 09:16:42', '2022-01-05 10:20:08');
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;

-- Dumping structure for table testdb.admin_user_group
CREATE TABLE IF NOT EXISTS `admin_user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_name` varchar(50) NOT NULL,
  `user_group_status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.admin_user_group: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin_user_group` DISABLE KEYS */;
INSERT INTO `admin_user_group` (`user_group_id`, `user_group_name`, `user_group_status`) VALUES
	(1, 'Administrator', 1),
	(2, 'User', 1);
/*!40000 ALTER TABLE `admin_user_group` ENABLE KEYS */;

-- Dumping structure for table testdb.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `category_status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`category_id`) USING BTREE,
  KEY `Index` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.categories: ~6 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`category_id`, `parent_id`, `category_status`, `date_added`, `date_modified`) VALUES
	(4, 0, 1, '2022-01-05 03:48:33', '2022-01-06 17:11:23'),
	(5, 0, 1, '2022-01-05 03:48:55', '2022-01-05 15:48:55'),
	(6, 0, 1, '2022-01-05 03:49:11', '2022-01-05 15:49:11'),
	(7, 0, 1, '2022-01-05 03:49:27', '2022-01-05 15:49:27'),
	(8, 0, 1, '2022-01-05 03:49:40', '2022-01-05 15:49:40'),
	(10, 0, 1, '2022-01-05 03:51:08', '2022-01-05 16:01:39'),
	(13, 0, 0, '2022-01-06 05:23:39', '2022-01-06 17:31:55');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table testdb.category_description
CREATE TABLE IF NOT EXISTS `category_description` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.category_description: ~6 rows (approximately)
/*!40000 ALTER TABLE `category_description` DISABLE KEYS */;
INSERT INTO `category_description` (`category_id`, `category_name`, `description`, `meta_title`) VALUES
	(4, 'Beverages', 'coffee/tea, juice, soda', 'Beverages'),
	(5, 'Canned/Jarred Goods', 'vegetables, spaghetti sauce, ketchup', 'Canned/Jarred Goods'),
	(6, 'Dairy', 'cheeses, eggs, milk, yogurt, butter', 'Dairy '),
	(7, 'Meat ', 'lunch meat, poultry, beef, pork', 'Meat '),
	(8, 'Frozen Foods', 'waffles, vegetables, individual meals, ice cream', 'Frozen Foods'),
	(10, 'Bread', 'sandwich loaves, dinner rolls, tortillas, bagels', 'Bread'),
	(13, 'Produce', 'fruits, vegetables', 'Produce');
/*!40000 ALTER TABLE `category_description` ENABLE KEYS */;

-- Dumping structure for table testdb.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.customer: ~1 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`customer_id`, `firstname`, `lastname`, `email`, `telephone`, `password`, `ip`, `status`, `date_added`) VALUES
	(2, 'John', 'Doe', 'example@email.com', '09123456789', '123', '::1', 1, '2022-01-07 02:25:57');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table testdb.customer_address
CREATE TABLE IF NOT EXISTS `customer_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address_1` varchar(125) NOT NULL,
  `address_2` varchar(125) NOT NULL,
  `city` varchar(20) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `region` varchar(50) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `Index` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.customer_address: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer_address` DISABLE KEYS */;
INSERT INTO `customer_address` (`address_id`, `customer_id`, `firstname`, `lastname`, `address_1`, `address_2`, `city`, `postcode`, `region`) VALUES
	(1, 1, 'Christian', 'Pascual', '044 Santol', '', 'Balagtas', '3016', 'Bulacan'),
	(2, 2, 'John', 'Doe', '044 Sanrol', '', 'Blagtas', '3016', 'Bulacan');
/*!40000 ALTER TABLE `customer_address` ENABLE KEYS */;

-- Dumping structure for table testdb.customer_ip
CREATE TABLE IF NOT EXISTS `customer_ip` (
  `customer_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_ip_id`) USING BTREE,
  KEY `Index 2` (`ip`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.customer_ip: ~4 rows (approximately)
/*!40000 ALTER TABLE `customer_ip` DISABLE KEYS */;
INSERT INTO `customer_ip` (`customer_ip_id`, `customer_id`, `email`, `ip`, `date_added`) VALUES
	(1, 1, 'cpascual107@gmail.com', '::1', '2022-01-01 00:00:00'),
	(2, 2, 'itchaaanp@gmail.com', '::1', '2022-01-01 00:00:00'),
	(3, 1, 'cpascual107@gmail.com', '::1', '2022-01-07 00:00:00'),
	(4, 1, 'cpascual107@gmail.com', '::1', '2022-01-07 01:37:22'),
	(5, 2, 'example@email.com', '::1', '2022-01-07 02:25:57');
/*!40000 ALTER TABLE `customer_ip` ENABLE KEYS */;

-- Dumping structure for table testdb.information_description
CREATE TABLE IF NOT EXISTS `information_description` (
  `information_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_title` varchar(50) NOT NULL,
  `info_description` mediumtext NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`information_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.information_description: ~5 rows (approximately)
/*!40000 ALTER TABLE `information_description` DISABLE KEYS */;
INSERT INTO `information_description` (`information_id`, `info_title`, `info_description`, `meta_title`, `meta_description`, `meta_keyword`, `info_status`, `date_added`, `date_modified`) VALUES
	(1, 'About Us', 'Test 123', 'About Us', '', '', 1, '2022-01-06 07:15:11', '2022-01-07 10:40:05'),
	(3, 'Privacy Policy', 'Lorem Lorem', 'Privacy Policy', '', '', 1, '2022-01-06 08:29:52', '2022-01-06 20:29:52'),
	(4, 'Terms & Condition', 'N/A', 'Terms & Condition', '', '', 1, '2022-01-06 08:30:17', '2022-01-06 20:30:17'),
	(5, 'test', 'aaaa', 'test', '', '', 0, '2022-01-07 10:41:03', '2022-01-07 10:41:17'),
	(6, 'Test 2', 'adsdsd', 'Test 2', '', '', 0, '2022-01-07 10:41:54', '2022-01-07 10:42:04');
/*!40000 ALTER TABLE `information_description` ENABLE KEYS */;

-- Dumping structure for table testdb.manufacturer
CREATE TABLE IF NOT EXISTS `manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.manufacturer: ~0 rows (approximately)
/*!40000 ALTER TABLE `manufacturer` DISABLE KEYS */;
/*!40000 ALTER TABLE `manufacturer` ENABLE KEYS */;

-- Dumping structure for table testdb.order
CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(30) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `payment_code` varchar(100) NOT NULL,
  `total` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `order_status_id` int(11) NOT NULL DEFAULT 0,
  `ip` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.order: ~0 rows (approximately)
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;

-- Dumping structure for table testdb.order_history
CREATE TABLE IF NOT EXISTS `order_history` (
  `order_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`order_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.order_history: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_history` ENABLE KEYS */;

-- Dumping structure for table testdb.order_product
CREATE TABLE IF NOT EXISTS `order_product` (
  `order_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `total` decimal(15,4) NOT NULL DEFAULT 0.0000,
  PRIMARY KEY (`order_product_id`),
  KEY `Index` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.order_product: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_product` ENABLE KEYS */;

-- Dumping structure for table testdb.order_status
CREATE TABLE IF NOT EXISTS `order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`order_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.order_status: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;

-- Dumping structure for table testdb.order_total
CREATE TABLE IF NOT EXISTS `order_total` (
  `order_total_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `value` decimal(15,4) NOT NULL DEFAULT 0.0000,
  PRIMARY KEY (`order_total_id`),
  KEY `Index` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.order_total: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_total` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_total` ENABLE KEYS */;

-- Dumping structure for table testdb.product
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT 0,
  `stock_status_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `manufacturer_id` int(11) NOT NULL DEFAULT 0,
  `price` decimal(15,4) NOT NULL,
  `product_weight` decimal(15,8) NOT NULL DEFAULT 0.00000000,
  `weight_id` int(11) NOT NULL DEFAULT 0,
  `product_status` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.product: ~4 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`product_id`, `product_name`, `quantity`, `stock_status_id`, `image`, `manufacturer_id`, `price`, `product_weight`, `weight_id`, `product_status`, `date_added`, `date_modified`) VALUES
	(1, 'Manggo', 123, 4, '', 0, 123.0000, 1.00000000, 1, 1, '2022-01-06 02:16:05', '2022-01-06 16:18:06'),
	(2, 'Watermelon', 123, 5, '', 0, 123.0000, 2.00000000, 2, 1, '2022-01-06 02:16:44', '2022-01-06 17:14:37'),
	(3, 'Orange', 123, 7, '', 0, 123.0000, 2.00000000, 1, 1, '2022-01-06 02:18:51', '2022-01-06 16:19:08'),
	(4, 'Lemon', 111, 5, '', 0, 111.0000, 1.00000000, 3, 1, '2022-01-06 02:21:09', '2022-01-06 16:18:49'),
	(5, 'Apple', 100, 4, '', 0, 140.0000, 1.00000000, 1, 1, '2022-01-06 02:53:55', '2022-01-06 18:27:27');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table testdb.product_description
CREATE TABLE IF NOT EXISTS `product_description` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `product_desc` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.product_description: ~5 rows (approximately)
/*!40000 ALTER TABLE `product_description` DISABLE KEYS */;
INSERT INTO `product_description` (`product_id`, `product_name`, `product_desc`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
	(1, 'Manggo', 'Nam faucibus ultricies tellus. Donec accumsan, orci non facilisis posuere, massa nisl pharetra felis, nec lobortis ipsum tellus at justo. Etiam sed lectus dolor. Etiam in tempus sem, vel feugiat elit. Fusce sit amet dapibus nunc. Nam ultricies fringilla ante at facilisis. Donec nibh mauris, vestibulum a mi non, molestie sagittis leo. Phasellus aliquam laoreet dolor in ullamcorper. Vestibulum faucibus urna eu aliquet viverra. Quisque tempus risus et est porta auctor.', 'Manggo', '', ''),
	(2, 'Watermelon', 'Nam faucibus ultricies tellus. Donec accumsan, orci non facilisis posuere, massa nisl pharetra felis, nec lobortis ipsum tellus at justo. Etiam sed lectus dolor. Etiam in tempus sem, vel feugiat elit. Fusce sit amet dapibus nunc. Nam ultricies fringilla ante at facilisis. Donec nibh mauris, vestibulum a mi non, molestie sagittis leo. Phasellus aliquam laoreet dolor in ullamcorper. Vestibulum faucibus urna eu aliquet viverra. Quisque tempus risus et est porta auctor.', 'Watermelon', '', ''),
	(3, 'Orange', '', 'Product 3', '', ''),
	(4, 'Lemon', 'Nam faucibus ultricies tellus. Donec accumsan, orci non facilisis posuere, massa nisl pharetra felis, nec lobortis ipsum tellus at justo. Etiam sed lectus dolor. Etiam in tempus sem, vel feugiat elit. Fusce sit amet dapibus nunc. Nam ultricies fringilla ante at facilisis. Donec nibh mauris, vestibulum a mi non, molestie sagittis leo. Phasellus aliquam laoreet dolor in ullamcorper. Vestibulum faucibus urna eu aliquet viverra. Quisque tempus risus et est porta auctor.', 'Lemon', '', ''),
	(5, 'Apple', '', 'Apple', '', '');
/*!40000 ALTER TABLE `product_description` ENABLE KEYS */;

-- Dumping structure for table testdb.product_to_category
CREATE TABLE IF NOT EXISTS `product_to_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`) USING BTREE,
  KEY `Index` (`category_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.product_to_category: ~5 rows (approximately)
/*!40000 ALTER TABLE `product_to_category` DISABLE KEYS */;
INSERT INTO `product_to_category` (`product_id`, `category_id`) VALUES
	(1, 13),
	(2, 13),
	(3, 13),
	(4, 13),
	(5, 13);
/*!40000 ALTER TABLE `product_to_category` ENABLE KEYS */;

-- Dumping structure for table testdb.stock_status
CREATE TABLE IF NOT EXISTS `stock_status` (
  `stock_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`stock_status_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.stock_status: ~4 rows (approximately)
/*!40000 ALTER TABLE `stock_status` DISABLE KEYS */;
INSERT INTO `stock_status` (`stock_status_id`, `name`) VALUES
	(4, 'In Stock'),
	(5, 'Pre-Order'),
	(6, 'Out of Stock'),
	(7, '2-3 Days');
/*!40000 ALTER TABLE `stock_status` ENABLE KEYS */;

-- Dumping structure for table testdb.weight_class
CREATE TABLE IF NOT EXISTS `weight_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(15,8) NOT NULL DEFAULT 0.00000000,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.weight_class: ~4 rows (approximately)
/*!40000 ALTER TABLE `weight_class` DISABLE KEYS */;
INSERT INTO `weight_class` (`id`, `value`) VALUES
	(1, 1.00000000),
	(2, 1000.00000000),
	(3, 2.20460000),
	(4, 35.27400000);
/*!40000 ALTER TABLE `weight_class` ENABLE KEYS */;

-- Dumping structure for table testdb.weight_class_description
CREATE TABLE IF NOT EXISTS `weight_class_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `unit` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.weight_class_description: ~4 rows (approximately)
/*!40000 ALTER TABLE `weight_class_description` DISABLE KEYS */;
INSERT INTO `weight_class_description` (`id`, `title`, `unit`) VALUES
	(1, 'Kilogram', 'kg'),
	(2, 'Gram', 'g'),
	(3, 'Pound', 'lb'),
	(4, 'Ounce', 'oz');
/*!40000 ALTER TABLE `weight_class_description` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
