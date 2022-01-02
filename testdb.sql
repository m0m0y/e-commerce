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
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.admin_user: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` (`id`, `firstname`, `lastname`, `email`, `password`, `user_group`, `admin_status`, `date_added`) VALUES
	(1, 'Christian', 'Pascual', 'cpascual107@gmail.com', 'admin', 1, 1, '2021-12-14 08:59:02'),
	(4, 'Hannah Clarisse', 'Toledo', 'hannahclarisse107@gmail.com', 'hannah', 2, 0, '2021-12-18 09:16:42');
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
  `status` tinyint(1) NOT NULL,
  `date_added` date NOT NULL,
  `date_modified` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`category_id`) USING BTREE,
  KEY `Index` (`parent_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table testdb.category_description
CREATE TABLE IF NOT EXISTS `category_description` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.category_description: ~0 rows (approximately)
/*!40000 ALTER TABLE `category_description` DISABLE KEYS */;
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

-- Dumping data for table testdb.customer: ~2 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`customer_id`, `firstname`, `lastname`, `email`, `telephone`, `password`, `ip`, `status`, `date_added`) VALUES
	(1, 'Christian', 'Pascual', 'cpascual107@gmail.com', '09123456789', 'test123', '::1', 1, '2022-01-01 00:00:00'),
	(2, 'Itchan', 'Pascual', 'itchaaanp@gmail.com', '09123456789', '123', '::1', 1, '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table testdb.customer_ip
CREATE TABLE IF NOT EXISTS `customer_ip` (
  `customer_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_ip_id`) USING BTREE,
  KEY `Index 2` (`ip`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.customer_ip: ~2 rows (approximately)
/*!40000 ALTER TABLE `customer_ip` DISABLE KEYS */;
INSERT INTO `customer_ip` (`customer_ip_id`, `customer_id`, `email`, `ip`, `date_added`) VALUES
	(1, 1, 'cpascual107@gmail.com', '::1', '2022-01-01 00:00:00'),
	(2, 2, 'itchaaanp@gmail.com', '::1', '2022-01-01 00:00:00');
/*!40000 ALTER TABLE `customer_ip` ENABLE KEYS */;

-- Dumping structure for table testdb.information
CREATE TABLE IF NOT EXISTS `information` (
  `information_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`information_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.information: ~0 rows (approximately)
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
/*!40000 ALTER TABLE `information` ENABLE KEYS */;

-- Dumping structure for table testdb.manufacturer
CREATE TABLE IF NOT EXISTS `manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.manufacturer: ~0 rows (approximately)
/*!40000 ALTER TABLE `manufacturer` DISABLE KEYS */;
/*!40000 ALTER TABLE `manufacturer` ENABLE KEYS */;

-- Dumping structure for table testdb.product
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT 0,
  `stock_status_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `product_weight` decimal(15,8) NOT NULL DEFAULT 0.00000000,
  `weight_id` int(11) NOT NULL DEFAULT 0,
  `product_status` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.product: ~3 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`product_id`, `product_name`, `quantity`, `stock_status_id`, `image`, `price`, `product_weight`, `weight_id`, `product_status`, `date_added`, `date_modified`) VALUES
	(2, 'Manggo', 20, 6, '', 150.0000, 1.00000000, 1, 0, '2021-12-21 08:00:00', '2021-12-23 15:57:36'),
	(3, 'Banana', 12, 4, '', 100.0000, 1.00000000, 1, 1, '2021-12-21 08:20:00', '2021-12-23 16:25:04'),
	(4, 'Apple', 20, 4, '', 150.0000, 1.00000000, 1, 1, '2021-12-21 08:00:00', '2021-12-28 07:53:41'),
	(5, 'Melon', 25, 4, '', 150.0000, 1.00000000, 1, 1, '0000-00-00 00:00:00', '2022-01-01 16:16:51');
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

-- Dumping data for table testdb.product_description: ~4 rows (approximately)
/*!40000 ALTER TABLE `product_description` DISABLE KEYS */;
INSERT INTO `product_description` (`product_id`, `product_name`, `product_desc`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
	(1, 'Water Melon', '', 'Water Melon', '', ''),
	(2, 'Manggo', 'Manggo is the best.', 'Manggo', '', ''),
	(3, 'Banana', '', 'Banana', '', ''),
	(4, 'Apple', '', 'Apple', '', ''),
	(5, 'Melon', 'Melon is delicious', 'Order per kilo', 'Melon', '');
/*!40000 ALTER TABLE `product_description` ENABLE KEYS */;

-- Dumping structure for table testdb.product_to_category
CREATE TABLE IF NOT EXISTS `product_to_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`) USING BTREE,
  KEY `Index` (`category_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.product_to_category: ~0 rows (approximately)
/*!40000 ALTER TABLE `product_to_category` DISABLE KEYS */;
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
