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

-- Dumping structure for table testdb.admin_logs
CREATE TABLE IF NOT EXISTS `admin_logs` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `activity` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`activity_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.admin_logs: ~13 rows (approximately)
/*!40000 ALTER TABLE `admin_logs` DISABLE KEYS */;
INSERT INTO `admin_logs` (`activity_id`, `user_group_id`, `email`, `activity`, `date_added`) VALUES
	(1, 1, 'admin', 'Login on dashboard', '2022-02-12 10:03:40'),
	(2, 1, 'admin', 'Login on dashboard', '2022-02-12 03:03:13'),
	(3, 1, 'admin', 'Update the order status of customer Juan Dela Cruz', '2022-02-12 03:58:32'),
	(4, 1, 'admin', 'Update the order status of customer Juan Dela Cruz', '2022-02-12 03:59:30'),
	(5, 1, 'admin', 'Logout', '2022-02-12 05:38:44'),
	(6, 2, 'john.doe@gmail.com', 'Login on dashboard', '2022-02-12 05:38:47'),
	(7, 2, 'john.doe@gmail.com', 'Update product', '2022-02-12 05:45:34'),
	(8, 2, 'john.doe@gmail.com', 'Logout', '2022-02-12 05:47:34'),
	(9, 1, 'admin', 'Login on dashboard', '2022-02-12 05:47:39'),
	(10, 1, 'admin', 'Update the order status of customer John Doe', '2022-02-12 05:49:06'),
	(11, 1, 'admin', 'Login on dashboard', '2022-02-13 06:47:10'),
	(12, 1, 'admin', 'Update the order status of customer Juan Dela Cruz', '2022-02-13 08:13:19'),
	(13, 1, 'admin', 'Update the order status of customer Juan Dela Cruz', '2022-02-13 08:41:25'),
	(14, 1, 'admin', 'Update product', '2022-02-13 09:49:53'),
	(15, 1, 'admin', 'Update product', '2022-02-13 09:50:03'),
	(16, 1, 'admin', 'Update product', '2022-02-13 09:50:17'),
	(17, 1, 'admin', 'Update product', '2022-02-13 09:50:29'),
	(18, 1, 'admin', 'Update product', '2022-02-13 09:50:59'),
	(19, 1, 'admin', 'Update product', '2022-02-13 09:51:13'),
	(20, 1, 'admin', 'Update product', '2022-02-13 09:51:35'),
	(21, 1, 'admin', 'Update product', '2022-02-13 09:51:59'),
	(22, 1, 'admin', 'Update product', '2022-02-13 09:52:05'),
	(23, 1, 'admin', 'Update product', '2022-02-13 09:52:15'),
	(24, 1, 'admin', 'Update product', '2022-02-13 09:52:36'),
	(25, 1, 'admin', 'Update product', '2022-02-13 09:54:40'),
	(26, 1, 'admin', 'Update product', '2022-02-13 09:55:24'),
	(27, 1, 'admin', 'Update product', '2022-02-13 09:55:30'),
	(28, 1, 'johndoe@gmail.com', 'Update the order status of customer John Doe', '2022-02-13 10:02:28'),
	(29, 1, 'johndoe@gmail.com', 'Update product', '2022-02-13 10:12:01'),
	(30, 1, 'johndoe@gmail.com', 'Update product', '2022-02-13 10:14:28');
/*!40000 ALTER TABLE `admin_logs` ENABLE KEYS */;

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
	(1, 'Admin', '', 'admin', '1', 1, 1, '2021-12-14 08:59:02', '2022-01-23 13:01:06'),
	(4, 'John', 'Doe', 'john.doe@gmail.com', '1', 2, 1, '2021-12-18 09:16:42', '2022-01-13 17:57:53');
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;

-- Dumping structure for table testdb.admin_user_group
CREATE TABLE IF NOT EXISTS `admin_user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_name` varchar(50) NOT NULL,
  `user_group_status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.admin_user_group: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin_user_group` DISABLE KEYS */;
INSERT INTO `admin_user_group` (`user_group_id`, `user_group_name`, `user_group_status`) VALUES
	(1, 'Administrator', 1),
	(2, 'Modifier', 1);
/*!40000 ALTER TABLE `admin_user_group` ENABLE KEYS */;

-- Dumping structure for table testdb.banks
CREATE TABLE IF NOT EXISTS `banks` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(50) NOT NULL,
  `account_number` varchar(20) NOT NULL DEFAULT '0',
  `account_name` varchar(50) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.banks: ~2 rows (approximately)
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
INSERT INTO `banks` (`bank_id`, `bank_name`, `account_number`, `account_name`) VALUES
	(1, 'Gcash', '9123456789', 'Your Shop Name'),
	(2, 'BDO', '1230123456789', 'Your Shop Name');
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;

-- Dumping structure for table testdb.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `api_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `Index` (`api_id`,`customer_id`,`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.cart: ~3 rows (approximately)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` (`cart_id`, `api_id`, `customer_id`, `product_id`, `quantity`, `date_added`) VALUES
	(9, 0, 4, 6, 1, '2022-02-12 08:20:04'),
	(10, 0, 16, 2, 2, '2022-02-12 09:39:23');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping structure for table testdb.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `category_status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`category_id`) USING BTREE,
  KEY `Index` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.categories: ~11 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`category_id`, `parent_id`, `category_status`, `date_added`, `date_modified`) VALUES
	(1, 0, 1, '2022-01-13 05:34:58', '2022-01-13 17:34:58'),
	(2, 0, 1, '2022-01-13 05:35:14', '2022-01-13 17:35:14'),
	(3, 0, 1, '2022-01-13 05:35:33', '2022-01-13 17:35:33'),
	(4, 0, 1, '2022-01-13 05:35:47', '2022-01-13 17:35:47'),
	(5, 0, 1, '2022-01-13 05:35:59', '2022-01-13 17:35:59'),
	(6, 0, 1, '2022-01-13 05:36:11', '2022-01-13 17:36:11'),
	(7, 0, 1, '2022-01-13 05:36:23', '2022-01-13 17:36:23'),
	(8, 0, 1, '2022-01-13 05:36:36', '2022-01-13 17:36:36'),
	(9, 0, 1, '2022-01-13 05:36:50', '2022-01-13 17:36:50'),
	(10, 0, 1, '2022-01-13 05:37:05', '2022-01-13 17:37:05'),
	(11, 0, 1, '2022-01-13 05:37:25', '2022-01-13 17:37:25');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table testdb.category_description
CREATE TABLE IF NOT EXISTS `category_description` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.category_description: ~11 rows (approximately)
/*!40000 ALTER TABLE `category_description` DISABLE KEYS */;
INSERT INTO `category_description` (`category_id`, `category_name`, `description`, `meta_title`) VALUES
	(1, 'Beverages', 'coffee/tea, juice, soda', 'Beverages'),
	(2, 'Bread/Bakery', 'sandwich loaves, dinner rolls, tortillas, bagels', 'Bread/Bakery'),
	(3, 'Canned/Jarred Goods', 'vegetables, spaghetti sauce, ketchup', 'Canned/Jarred Goods'),
	(4, 'Dairy ', 'cheeses, eggs, milk, yogurt, butter', 'Dairy'),
	(5, 'Dry/Baking Goods', 'cereals, flour, sugar, pasta, mixes', 'Dry/Baking Goods'),
	(6, 'Frozen Foods', 'waffles, vegetables, individual meals, ice cream', 'Frozen Foods'),
	(7, 'Meat ', 'lunch meat, poultry, beef, pork', 'Meat '),
	(8, 'Produce ', 'fruits, vegetables', 'Produce '),
	(9, 'Paper Goods', 'paper towels, toilet paper, aluminum foil, sandwich bags', 'Paper Goods'),
	(10, 'Personal Care', 'shampoo, soap, hand soap, shaving cream', 'Personal Care'),
	(11, 'Other ', 'baby items, pet items, batteries, greeting cards', 'Other');
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
	(1, 'John', 'Doe', 'johndoe@gmail.com', '0912345689', '1', '::1', 1, '2022-02-12 09:45:40'),
	(2, 'Juan', 'Dela Cruz', 'juan.delacruz@gmail.com', '12345678', '12', '::1', 1, '2022-02-12 01:27:49');
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

-- Dumping data for table testdb.customer_address: ~2 rows (approximately)
/*!40000 ALTER TABLE `customer_address` DISABLE KEYS */;
INSERT INTO `customer_address` (`address_id`, `customer_id`, `firstname`, `lastname`, `address_1`, `address_2`, `city`, `postcode`, `region`) VALUES
	(1, 1, 'John', 'Doe', 'Santol', '', 'Balagtas', '3016', 'Bulacan'),
	(2, 2, 'Juan', 'Dela Cruz', 'Balubad', '', 'Bulacan', '3017', 'Bulacan');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.customer_ip: ~2 rows (approximately)
/*!40000 ALTER TABLE `customer_ip` DISABLE KEYS */;
INSERT INTO `customer_ip` (`customer_ip_id`, `customer_id`, `email`, `ip`, `date_added`) VALUES
	(1, 1, 'johndoe@gmail.com', '::1', '2022-02-12 09:45:40'),
	(2, 2, 'juan.delacruz@gmail.com', '::1', '2022-02-12 01:27:49');
/*!40000 ALTER TABLE `customer_ip` ENABLE KEYS */;

-- Dumping structure for table testdb.customer_wishlist
CREATE TABLE IF NOT EXISTS `customer_wishlist` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.customer_wishlist: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer_wishlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_wishlist` ENABLE KEYS */;

-- Dumping structure for table testdb.information_description
CREATE TABLE IF NOT EXISTS `information_description` (
  `information_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_title` varchar(50) NOT NULL,
  `info_description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`information_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.information_description: ~7 rows (approximately)
/*!40000 ALTER TABLE `information_description` DISABLE KEYS */;
INSERT INTO `information_description` (`information_id`, `info_title`, `info_description`, `meta_title`, `meta_description`, `meta_keyword`, `info_status`, `date_added`, `date_modified`) VALUES
	(7, 'About Us', '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: ">Lorem ipsum dolor&nbsp;<span style="font-size: 1rem;">sit amet, consectetur adipiscing elit. Aenean ligula leo, feugiat sed auctor vel, suscipit consequat mi. Morbi dignissim metus id dui tincidunt consequat. Vestibulum eu nisi non nibh sagittis semper. Duis placerat efficitur velit sit amet dictum. Vivamus feugiat, lacus sed pulvinar tristique, tellus ligula tristique leo, luctus suscipit dolor quam ac neque. Donec vel maximus nisi. Quisque hendrerit tellus a volutpat tincidunt. Suspendisse lectus metus, porta sed eros in, egestas convallis ligula. Donec tellus lorem, mattis non euismod at, euismod vel leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Pellentesque mollis non libero ut auctor. Mauris sollicitudin consectetur tortor, a imperdiet arcu volutpat sit amet.</span></p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Nam tristique tristique sem, vel faucibus arcu fringilla ac. Nam vestibulum enim quis porttitor mattis. Etiam aliquet faucibus sapien ac mollis. Cras egestas eu felis vitae rutrum. Duis sollicitudin mi nec magna posuere, vitae molestie mauris pulvinar. Morbi purus est, tincidunt porta ipsum id, consectetur iaculis ex. Donec commodo, mi eget mattis suscipit, sapien risus laoreet purus, quis scelerisque lectus ipsum nec leo.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Sed hendrerit ligula ex. Maecenas eget tellus consectetur, lobortis odio ut, vehicula tortor. Donec vitae vestibulum turpis. Phasellus consectetur ligula metus, at blandit ipsum tempus eget. Morbi ut nisl mauris. Maecenas dui elit, vestibulum eu hendrerit sed, luctus at massa. Nulla ullamcorper tortor non velit bibendum, vel tincidunt leo pulvinar. Praesent tellus libero, vestibulum vitae enim vitae, tristique iaculis felis. Praesent eu tincidunt mi. Maecenas lacinia aliquam nisi sed gravida. Etiam et fermentum eros. Nullam sed erat id sem ultricies mattis. Etiam ultrices convallis tellus, in ullamcorper diam finibus at. Aenean in augue at sem consequat pharetra ac ac magna. Quisque ut urna libero. Phasellus tellus dui, gravida et urna in, molestie aliquam eros.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Praesent sed tellus sed sem commodo elementum. Duis dapibus purus malesuada pellentesque aliquam. Fusce dictum vel ligula vitae fermentum. Quisque lobortis est lorem, in finibus tellus luctus et. Aenean molestie laoreet nisi quis laoreet. Donec a tempor lorem. Nunc sollicitudin purus vitae interdum ultrices. Nam ornare neque a posuere pharetra. Maecenas id metus congue, tincidunt eros quis, egestas ex. Proin quis mi iaculis, sodales elit eu, bibendum neque. Donec eu mi a purus dapibus volutpat ut euismod ligula. Sed sed nunc id lectus blandit sollicitudin et quis est. Nam viverra hendrerit justo quis porta.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Quisque imperdiet elit felis, eget tincidunt dolor interdum a. Nunc sodales elit sed libero sodales posuere. Aliquam erat elit, sagittis at interdum posuere, convallis fringilla elit. Nulla et neque mattis, semper magna id, convallis felis. Ut imperdiet lectus sed enim luctus, eu vestibulum justo dictum. Pellentesque auctor tempus orci, eu sollicitudin tellus finibus quis. Vivamus eget eros at ex egestas sollicitudin auctor dignissim mauris. Nulla sed tincidunt ante, et sollicitudin nibh. Suspendisse sed tempor orci, a convallis libero</p>', 'About Us', '', '', 1, '2022-01-13 05:49:35', '2022-02-12 19:18:18'),
	(8, 'Privacy Policy', '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ligula leo, feugiat sed auctor vel, suscipit consequat mi. Morbi dignissim metus id dui tincidunt consequat. Vestibulum eu nisi non nibh sagittis semper. Duis placerat efficitur velit sit amet dictum. Vivamus feugiat, lacus sed pulvinar tristique, tellus ligula tristique leo, luctus suscipit dolor quam ac neque. Donec vel maximus nisi. Quisque hendrerit tellus a volutpat tincidunt. Suspendisse lectus metus, porta sed eros in, egestas convallis ligula. Donec tellus lorem, mattis non euismod at, euismod vel leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Pellentesque mollis non libero ut auctor. Mauris sollicitudin consectetur tortor, a imperdiet arcu volutpat sit amet.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Nam tristique tristique sem, vel faucibus arcu fringilla ac. Nam vestibulum enim quis porttitor mattis. Etiam aliquet faucibus sapien ac mollis. Cras egestas eu felis vitae rutrum. Duis sollicitudin mi nec magna posuere, vitae molestie mauris pulvinar. Morbi purus est, tincidunt porta ipsum id, consectetur iaculis ex. Donec commodo, mi eget mattis suscipit, sapien risus laoreet purus, quis scelerisque lectus ipsum nec leo.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Sed hendrerit ligula ex. Maecenas eget tellus consectetur, lobortis odio ut, vehicula tortor. Donec vitae vestibulum turpis. Phasellus consectetur ligula metus, at blandit ipsum tempus eget. Morbi ut nisl mauris. Maecenas dui elit, vestibulum eu hendrerit sed, luctus at massa. Nulla ullamcorper tortor non velit bibendum, vel tincidunt leo pulvinar. Praesent tellus libero, vestibulum vitae enim vitae, tristique iaculis felis. Praesent eu tincidunt mi. Maecenas lacinia aliquam nisi sed gravida. Etiam et fermentum eros. Nullam sed erat id sem ultricies mattis. Etiam ultrices convallis tellus, in ullamcorper diam finibus at. Aenean in augue at sem consequat pharetra ac ac magna. Quisque ut urna libero. Phasellus tellus dui, gravida et urna in, molestie aliquam eros.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Praesent sed tellus sed sem commodo elementum. Duis dapibus purus malesuada pellentesque aliquam. Fusce dictum vel ligula vitae fermentum. Quisque lobortis est lorem, in finibus tellus luctus et. Aenean molestie laoreet nisi quis laoreet. Donec a tempor lorem. Nunc sollicitudin purus vitae interdum ultrices. Nam ornare neque a posuere pharetra. Maecenas id metus congue, tincidunt eros quis, egestas ex. Proin quis mi iaculis, sodales elit eu, bibendum neque. Donec eu mi a purus dapibus volutpat ut euismod ligula. Sed sed nunc id lectus blandit sollicitudin et quis est. Nam viverra hendrerit justo quis porta.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Quisque imperdiet elit felis, eget tincidunt dolor interdum a. Nunc sodales elit sed libero sodales posuere. Aliquam erat elit, sagittis at interdum posuere, convallis fringilla elit. Nulla et neque mattis, semper magna id, convallis felis. Ut imperdiet lectus sed enim luctus, eu vestibulum justo dictum. Pellentesque auctor tempus orci, eu sollicitudin tellus finibus quis. Vivamus eget eros at ex egestas sollicitudin auctor dignissim mauris. Nulla sed tincidunt ante, et sollicitudin nibh. Suspendisse sed tempor orci, a convallis libero.</p>', 'Privacy Policy', '', '', 1, '2022-01-13 05:50:14', '2022-02-12 18:03:27'),
	(9, 'Terms & Condition', '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ligula leo, feugiat sed auctor vel, suscipit consequat mi. Morbi dignissim metus id dui tincidunt consequat. Vestibulum eu nisi non nibh sagittis semper. Duis placerat efficitur velit sit amet dictum. Vivamus feugiat, lacus sed pulvinar tristique, tellus ligula tristique leo, luctus suscipit dolor quam ac neque. Donec vel maximus nisi. Quisque hendrerit tellus a volutpat tincidunt. Suspendisse lectus metus, porta sed eros in, egestas convallis ligula. Donec tellus lorem, mattis non euismod at, euismod vel leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Pellentesque mollis non libero ut auctor. Mauris sollicitudin consectetur tortor, a imperdiet arcu volutpat sit amet.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Nam tristique tristique sem, vel faucibus arcu fringilla ac. Nam vestibulum enim quis porttitor mattis. Etiam aliquet faucibus sapien ac mollis. Cras egestas eu felis vitae rutrum. Duis sollicitudin mi nec magna posuere, vitae molestie mauris pulvinar. Morbi purus est, tincidunt porta ipsum id, consectetur iaculis ex. Donec commodo, mi eget mattis suscipit, sapien risus laoreet purus, quis scelerisque lectus ipsum nec leo.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Sed hendrerit ligula ex. Maecenas eget tellus consectetur, lobortis odio ut, vehicula tortor. Donec vitae vestibulum turpis. Phasellus consectetur ligula metus, at blandit ipsum tempus eget. Morbi ut nisl mauris. Maecenas dui elit, vestibulum eu hendrerit sed, luctus at massa. Nulla ullamcorper tortor non velit bibendum, vel tincidunt leo pulvinar. Praesent tellus libero, vestibulum vitae enim vitae, tristique iaculis felis. Praesent eu tincidunt mi. Maecenas lacinia aliquam nisi sed gravida. Etiam et fermentum eros. Nullam sed erat id sem ultricies mattis. Etiam ultrices convallis tellus, in ullamcorper diam finibus at. Aenean in augue at sem consequat pharetra ac ac magna. Quisque ut urna libero. Phasellus tellus dui, gravida et urna in, molestie aliquam eros.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Praesent sed tellus sed sem commodo elementum. Duis dapibus purus malesuada pellentesque aliquam. Fusce dictum vel ligula vitae fermentum. Quisque lobortis est lorem, in finibus tellus luctus et. Aenean molestie laoreet nisi quis laoreet. Donec a tempor lorem. Nunc sollicitudin purus vitae interdum ultrices. Nam ornare neque a posuere pharetra. Maecenas id metus congue, tincidunt eros quis, egestas ex. Proin quis mi iaculis, sodales elit eu, bibendum neque. Donec eu mi a purus dapibus volutpat ut euismod ligula. Sed sed nunc id lectus blandit sollicitudin et quis est. Nam viverra hendrerit justo quis porta.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Quisque imperdiet elit felis, eget tincidunt dolor interdum a. Nunc sodales elit sed libero sodales posuere. Aliquam erat elit, sagittis at interdum posuere, convallis fringilla elit. Nulla et neque mattis, semper magna id, convallis felis. Ut imperdiet lectus sed enim luctus, eu vestibulum justo dictum. Pellentesque auctor tempus orci, eu sollicitudin tellus finibus quis. Vivamus eget eros at ex egestas sollicitudin auctor dignissim mauris. Nulla sed tincidunt ante, et sollicitudin nibh. Suspendisse sed tempor orci, a convallis libero.</p>', 'Terms & Condition', '', '', 1, '2022-01-13 05:50:45', '2022-02-12 18:03:47'),
	(10, 'Location', '<p>Shop Location<br></p>', 'Location', '', '', 1, '2022-02-12 05:51:57', '2022-02-12 19:48:58'),
	(11, 'Email Address', '<p>shop@email.com<br></p>', 'Email Address', '', '', 1, '2022-02-12 05:52:13', '2022-02-12 20:39:20'),
	(12, 'Phone Number', '<p>+63 912 3456 789<br></p>', 'Phone Number', '', '', 1, '2022-02-12 05:52:31', '2022-02-12 20:38:37'),
	(13, 'Cash Basis', '<h3><span style="font-family: Arial;">Cash Basis:</span></h3><p><b>Note:</b> Once your order is Ready For Pick-up, you can now go to our physical store at: <b>Shop Location </b></p><p><span style="font-size: 1rem;">You can also contact us at </span><i>+63 912 3456 789</i><span style="font-size: 1rem;"> or email us at </span><i style="font-size: 1rem;">shop@email.com </i></p><p><span style="font-size: 1rem;">Thank you for your ordering!</span><br></p>', 'Cash Basis', '', '', 1, '2022-02-12 07:15:26', '2022-02-12 19:57:24');
/*!40000 ALTER TABLE `information_description` ENABLE KEYS */;

-- Dumping structure for table testdb.manufacturer
CREATE TABLE IF NOT EXISTS `manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.manufacturer: ~4 rows (approximately)
/*!40000 ALTER TABLE `manufacturer` DISABLE KEYS */;
INSERT INTO `manufacturer` (`manufacturer_id`, `name`) VALUES
	(1, 'Manufacturer 1'),
	(2, 'Manufacturer 2'),
	(3, 'Test 1'),
	(4, 'Test 2'),
	(5, 'Test 3');
/*!40000 ALTER TABLE `manufacturer` ENABLE KEYS */;

-- Dumping structure for table testdb.notes
CREATE TABLE IF NOT EXISTS `notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;

-- Dumping structure for table testdb.orders
CREATE TABLE IF NOT EXISTS `orders` (
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
  `pick_up_date` date NOT NULL,
  `date_added` date NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.orders: ~4 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`order_id`, `invoice_no`, `customer_id`, `firstname`, `lastname`, `email`, `telephone`, `comment`, `payment_method`, `payment_code`, `total`, `order_status_id`, `ip`, `pick_up_date`, `date_added`, `date_modified`) VALUES
	(1, 'INV-2022-41000', 1, 'John', 'Doe', 'johndoe@gmail.com', '0912345689', 'Test Order', 'Gcash', 'gcash', 500.0000, 3, '::1', '2022-02-15', '2022-02-12', '2022-02-12 15:01:13'),
	(2, 'INV-2022-03001', 1, 'John', 'Doe', 'johndoe@gmail.com', '0912345689', '', 'Bank Transfer', 'bank_transfer', 240.0000, 2, '::1', '2022-02-15', '2022-02-12', '2022-02-13 10:02:28'),
	(3, 'INV-2022-04002', 2, 'Juan', 'Dela Cruz', 'juan.delacruz@gmail.com', '12345678', '', 'Cash', 'cash', 240.0000, 3, '::1', '2022-02-14', '2022-02-12', '2022-02-13 08:41:25'),
	(4, 'INV-2022-43003', 2, 'Juan', 'Dela Cruz', 'juan.delacruz@gmail.com', '12345678', '', 'Bank Transfer', 'bank_transfer', 900.0000, 8, '::1', '2022-02-24', '2022-02-13', '2022-02-13 08:13:19');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table testdb.orders_history
CREATE TABLE IF NOT EXISTS `orders_history` (
  `order_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(50) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`order_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.orders_history: ~9 rows (approximately)
/*!40000 ALTER TABLE `orders_history` DISABLE KEYS */;
INSERT INTO `orders_history` (`order_history_id`, `invoice_no`, `order_id`, `order_status_id`, `comment`, `date_added`) VALUES
	(1, 'INV-2022-41000', 1, 3, 'Test Order', '2022-02-12 09:50:43'),
	(2, 'INV-2022-03001', 2, 2, '', '2022-02-12 02:20:38'),
	(3, 'INV-2022-04002', 3, 2, '', '2022-02-12 03:57:19'),
	(4, 'INV-2022-04002', 3, 8, '', '2022-02-12 03:58:32'),
	(5, 'INV-2022-04002', 3, 8, 'Test', '2022-02-12 03:59:30'),
	(6, 'INV-2022-03001', 2, 8, '', '2022-02-12 05:49:06'),
	(7, 'INV-2022-43003', 4, 2, '', '2022-02-13 08:12:28'),
	(8, 'INV-2022-43003', 4, 8, '', '2022-02-13 08:13:19'),
	(9, 'INV-2022-04002', 3, 3, 'Test', '2022-02-13 08:41:25'),
	(10, 'INV-2022-03001', 2, 2, '', '2022-02-13 10:02:28');
/*!40000 ALTER TABLE `orders_history` ENABLE KEYS */;

-- Dumping structure for table testdb.order_product
CREATE TABLE IF NOT EXISTS `order_product` (
  `order_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(50) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `total` decimal(15,4) NOT NULL DEFAULT 0.0000,
  PRIMARY KEY (`order_product_id`),
  KEY `Index` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.order_product: ~6 rows (approximately)
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
INSERT INTO `order_product` (`order_product_id`, `invoice_no`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `total`) VALUES
	(1, 'INV-2022-41000', 1, 2, 'Bacon', 1, 200.0000, 200.0000),
	(2, 'INV-2022-41000', 1, 3, 'Orange', 2, 150.0000, 300.0000),
	(3, 'INV-2022-03001', 2, 1, 'Lemon', 2, 120.0000, 240.0000),
	(4, 'INV-2022-04002', 3, 5, 'White Eggs', 2, 120.0000, 240.0000),
	(5, 'INV-2022-43003', 4, 3, 'Orange', 5, 150.0000, 750.0000),
	(6, 'INV-2022-43003', 4, 6, 'Ham', 1, 150.0000, 150.0000);
/*!40000 ALTER TABLE `order_product` ENABLE KEYS */;

-- Dumping structure for table testdb.order_status
CREATE TABLE IF NOT EXISTS `order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`order_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.order_status: ~6 rows (approximately)
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
INSERT INTO `order_status` (`order_status_id`, `name`) VALUES
	(2, 'Pending'),
	(3, 'Cancel'),
	(5, 'Ready for Pick up'),
	(6, 'Complete'),
	(8, 'Approve'),
	(9, 'Packed');
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;

-- Dumping structure for table testdb.order_total
CREATE TABLE IF NOT EXISTS `order_total` (
  `order_total_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `val` decimal(15,4) NOT NULL DEFAULT 0.0000,
  PRIMARY KEY (`order_total_id`),
  KEY `Index` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.order_total: ~12 rows (approximately)
/*!40000 ALTER TABLE `order_total` DISABLE KEYS */;
INSERT INTO `order_total` (`order_total_id`, `order_id`, `invoice_no`, `title`, `val`) VALUES
	(1, 1, 'INV-2022-41000', 'Sub-Total', 500.0000),
	(2, 1, 'INV-2022-41000', 'Total', 500.0000),
	(3, 1, 'INV-2022-41000', 'Vat', 0.0000),
	(4, 2, 'INV-2022-03001', 'Sub-Total', 240.0000),
	(5, 2, 'INV-2022-03001', 'Total', 240.0000),
	(6, 2, 'INV-2022-03001', 'Vat', 0.0000),
	(7, 3, 'INV-2022-04002', 'Sub-Total', 240.0000),
	(8, 3, 'INV-2022-04002', 'Total', 240.0000),
	(9, 3, 'INV-2022-04002', 'Vat', 0.0000),
	(10, 4, 'INV-2022-43003', 'Sub-Total', 900.0000),
	(11, 4, 'INV-2022-43003', 'Total', 900.0000),
	(12, 4, 'INV-2022-43003', 'Vat', 0.0000);
/*!40000 ALTER TABLE `order_total` ENABLE KEYS */;

-- Dumping structure for table testdb.product
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT 0,
  `stock_status_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `product_weight` decimal(15,8) NOT NULL DEFAULT 0.00000000,
  `weight_id` int(11) NOT NULL DEFAULT 0,
  `product_status` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.product: ~9 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`product_id`, `product_name`, `quantity`, `stock_status_id`, `image`, `manufacturer_id`, `price`, `product_weight`, `weight_id`, `product_status`, `date_added`, `date_modified`) VALUES
	(1, 'Lemon', 200, 4, '', 1, 120.0000, 1.00000000, 1, 1, '2022-01-13 05:43:18', '2022-01-16 16:01:01'),
	(2, 'Bacon', 100, 4, '', 3, 200.0000, 1.00000000, 1, 1, '2022-01-13 05:44:35', '2022-01-13 17:44:35'),
	(3, 'Orange', 100, 4, '', 4, 150.0000, 1.00000000, 1, 1, '2022-01-13 05:46:34', '2022-01-13 17:46:34'),
	(4, 'Bear brand', 60, 4, '', 1, 120.0000, 1.00000000, 3, 1, '2022-01-13 06:28:41', '2022-02-13 09:50:17'),
	(5, 'White Eggs', 20, 4, '', 4, 120.0000, 0.00000000, 1, 1, '2022-01-13 06:31:40', '2022-02-13 09:51:13'),
	(6, 'Ham', 20, 4, '', 4, 150.0000, 1.00000000, 1, 1, '2022-01-13 06:32:56', '2022-02-13 09:52:05'),
	(7, '555 Tuna', 100, 4, '', 2, 90.0000, 0.00000000, 1, 1, '2022-01-13 06:34:45', '2022-01-13 18:34:45'),
	(8, 'Corn Beef', 100, 4, '', 3, 90.0000, 0.00000000, 1, 1, '2022-01-13 06:35:12', '2022-01-13 18:35:12'),
	(9, 'Test', 1, 4, '', 0, 1.0000, 0.00000000, 1, 0, '2022-01-15 10:55:01', '2022-01-29 17:29:47');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table testdb.product_description
CREATE TABLE IF NOT EXISTS `product_description` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `store` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.product_description: ~9 rows (approximately)
/*!40000 ALTER TABLE `product_description` DISABLE KEYS */;
INSERT INTO `product_description` (`product_id`, `product_name`, `store`, `product_desc`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
	(1, 'Lemon', 'Test', '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae consequat lectus, at ultricies libero. Suspendisse dignissim porta sapien, semper porttitor neque sagittis eget. Fusce egestas sem in lacinia molestie. Suspendisse maximus id purus id tempor. Ut vulputate, urna nec elementum convallis, purus est posuere quam, sit amet consequat diam tellus vel orci. Cras accumsan mi ante, a consectetur leo blandit et. Cras porttitor lectus metus, quis laoreet justo maximus maximus. Integer non mi nec lectus tincidunt elementum eu ut mauris. Pellentesque elementum, urna sit amet fringilla feugiat, nunc magna consequat ex, et dictum neque dui nec diam.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif; font-size: 14px;">Sed ut nisi quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla commodo imperdiet enim sed volutpat. Suspendisse faucibus, velit sit amet porta vehicula, lorem justo cursus nibh, eu cursus ex sapien vel risus. Proin aliquam sit amet est et tristique. Duis in risus mi. Sed pulvinar tristique sapien eget ultrices. Vivamus blandit purus nulla. Praesent scelerisque aliquam ipsum semper sollicitudin. Ut lobortis metus magna, sed luctus metus auctor in. Sed eget vehicula odio. Maecenas faucibus in sem mollis faucibus. In sed sapien volutpat, rhoncus libero vitae, finibus libero. Aliquam vel metus auctor, vestibulum arcu in, eleifend ante.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif; font-size: 14px;">Nam posuere ipsum vitae porttitor mollis. Sed ut ante vel massa auctor aliquet. Duis posuere volutpat nisl id ultricies. Praesent sagittis nisl orci, eget venenatis urna rhoncus egestas. Sed interdum aliquam fermentum. Integer sed odio in enim mattis facilisis. Nam eu rhoncus mauris, sit amet facilisis purus. Suspendisse vehicula lacus mollis, efficitur nibh gravida, tincidunt lacus. Aliquam ac enim eu velit rhoncus volutpat at id purus. In hac habitasse platea dictumst.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif; font-size: 14px;">Quisque tristique ornare leo, a ornare nunc pharetra nec. Vivamus ut quam sit amet quam convallis pulvinar. Proin ultrices aliquam lorem, sed vestibulum orci interdum in. In vitae mauris massa. Nulla metus mauris, mollis et malesuada at, placerat sed magna. Pellentesque pretium orci sed pretium cursus. Etiam ut nulla vel nibh ullamcorper pretium. Vivamus eros nibh, vestibulum vitae ultrices non, pellentesque non nulla. Etiam elit dolor, consequat at lobortis in, pretium nec orci.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif; font-size: 14px;">Morbi gravida a est in scelerisque. Cras tincidunt justo at leo porta egestas. Integer fermentum purus nunc, sed euismod nisl vulputate at. Phasellus sit amet erat ac arcu accumsan fermentum. Integer id mattis ante. Quisque nibh dolor, facilisis sit amet mollis id, tempor nec neque. Fusce at mi leo.</p>', 'Lemon', '', 'Product 1'),
	(2, 'Bacon', '', '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae consequat lectus, at ultricies libero. Suspendisse dignissim porta sapien, semper porttitor neque sagittis eget. Fusce egestas sem in lacinia molestie. Suspendisse maximus id purus id tempor. Ut vulputate, urna nec elementum convallis, purus est posuere quam, sit amet consequat diam tellus vel orci. Cras accumsan mi ante, a consectetur leo blandit et. Cras porttitor lectus metus, quis laoreet justo maximus maximus. Integer non mi nec lectus tincidunt elementum eu ut mauris. Pellentesque elementum, urna sit amet fringilla feugiat, nunc magna consequat ex, et dictum neque dui nec diam.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Sed ut nisi quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla commodo imperdiet enim sed volutpat. Suspendisse faucibus, velit sit amet porta vehicula, lorem justo cursus nibh, eu cursus ex sapien vel risus. Proin aliquam sit amet est et tristique. Duis in risus mi. Sed pulvinar tristique sapien eget ultrices. Vivamus blandit purus nulla. Praesent scelerisque aliquam ipsum semper sollicitudin. Ut lobortis metus magna, sed luctus metus auctor in. Sed eget vehicula odio. Maecenas faucibus in sem mollis faucibus. In sed sapien volutpat, rhoncus libero vitae, finibus libero. Aliquam vel metus auctor, vestibulum arcu in, eleifend ante.</p>', 'Bacon', '', 'Product 2'),
	(3, 'Orange', '', '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae consequat lectus, at ultricies libero. Suspendisse dignissim porta sapien, semper porttitor neque sagittis eget. Fusce egestas sem in lacinia molestie. Suspendisse maximus id purus id tempor. Ut vulputate, urna nec elementum convallis, purus est posuere quam, sit amet consequat diam tellus vel orci. Cras accumsan mi ante, a consectetur leo blandit et. Cras porttitor lectus metus, quis laoreet justo maximus maximus. Integer non mi nec lectus tincidunt elementum eu ut mauris. Pellentesque elementum, urna sit amet fringilla feugiat, nunc magna consequat ex, et dictum neque dui nec diam.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Sed ut nisi quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla commodo imperdiet enim sed volutpat. Suspendisse faucibus, velit sit amet porta vehicula, lorem justo cursus nibh, eu cursus ex sapien vel risus. Proin aliquam sit amet est et tristique. Duis in risus mi. Sed pulvinar tristique sapien eget ultrices. Vivamus blandit purus nulla. Praesent scelerisque aliquam ipsum semper sollicitudin. Ut lobortis metus magna, sed luctus metus auctor in. Sed eget vehicula odio. Maecenas faucibus in sem mollis faucibus. In sed sapien volutpat, rhoncus libero vitae, finibus libero. Aliquam vel metus auctor, vestibulum arcu in, eleifend ante.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Nam posuere ipsum vitae porttitor mollis. Sed ut ante vel massa auctor aliquet. Duis posuere volutpat nisl id ultricies. Praesent sagittis nisl orci, eget venenatis urna rhoncus egestas. Sed interdum aliquam fermentum. Integer sed odio in enim mattis facilisis. Nam eu rhoncus mauris, sit amet facilisis purus. Suspendisse vehicula lacus mollis, efficitur nibh gravida, tincidunt lacus. Aliquam ac enim eu velit rhoncus volutpat at id purus. In hac habitasse platea dictumst.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Quisque tristique ornare leo, a ornare nunc pharetra nec. Vivamus ut quam sit amet quam convallis pulvinar. Proin ultrices aliquam lorem, sed vestibulum orci interdum in. In vitae mauris massa. Nulla metus mauris, mollis et malesuada at, placerat sed magna. Pellentesque pretium orci sed pretium cursus. Etiam ut nulla vel nibh ullamcorper pretium. Vivamus eros nibh, vestibulum vitae ultrices non, pellentesque non nulla. Etiam elit dolor, consequat at lobortis in, pretium nec orci.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Morbi gravida a est in scelerisque. Cras tincidunt justo at leo porta egestas. Integer fermentum purus nunc, sed euismod nisl vulputate at. Phasellus sit amet erat ac arcu accumsan fermentum. Integer id mattis ante. Quisque nibh dolor, facilisis sit amet mollis id, tempor nec neque. Fusce at mi leo.</p>', 'Orange', '', 'Product 3'),
	(4, 'Bear brand', '', '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae consequat lectus, at ultricies libero. Suspendisse dignissim porta sapien, semper porttitor neque sagittis eget. Fusce egestas sem in lacinia molestie. Suspendisse maximus id purus id tempor. Ut vulputate, urna nec elementum convallis, purus est posuere quam, sit amet consequat diam tellus vel orci. Cras accumsan mi ante, a consectetur leo blandit et. Cras porttitor lectus metus, quis laoreet justo maximus maximus. Integer non mi nec lectus tincidunt elementum eu ut mauris. Pellentesque elementum, urna sit amet fringilla feugiat, nunc magna consequat ex, et dictum neque dui nec diam.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif; font-size: 14px;">Sed ut nisi quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla commodo imperdiet enim sed volutpat. Suspendisse faucibus, velit sit amet porta vehicula, lorem justo cursus nibh, eu cursus ex sapien vel risus. Proin aliquam sit amet est et tristique. Duis in risus mi. Sed pulvinar tristique sapien eget ultrices. Vivamus blandit purus nulla. Praesent scelerisque aliquam ipsum semper sollicitudin. Ut lobortis metus magna, sed luctus metus auctor in. Sed eget vehicula odio. Maecenas faucibus in sem mollis faucibus. In sed sapien volutpat, rhoncus libero vitae, finibus libero. Aliquam vel metus auctor, vestibulum arcu in, eleifend ante.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif; font-size: 14px;">Nam posuere ipsum vitae porttitor mollis. Sed ut ante vel massa auctor aliquet. Duis posuere volutpat nisl id ultricies. Praesent sagittis nisl orci, eget venenatis urna rhoncus egestas. Sed interdum aliquam fermentum. Integer sed odio in enim mattis facilisis. Nam eu rhoncus mauris, sit amet facilisis purus. Suspendisse vehicula lacus mollis, efficitur nibh gravida, tincidunt lacus. Aliquam ac enim eu velit rhoncus volutpat at id purus. In hac habitasse platea dictumst.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif; font-size: 14px;">Quisque tristique ornare leo, a ornare nunc pharetra nec. Vivamus ut quam sit amet quam convallis pulvinar. Proin ultrices aliquam lorem, sed vestibulum orci interdum in. In vitae mauris massa. Nulla metus mauris, mollis et malesuada at, placerat sed magna. Pellentesque pretium orci sed pretium cursus. Etiam ut nulla vel nibh ullamcorper pretium. Vivamus eros nibh, vestibulum vitae ultrices non, pellentesque non nulla. Etiam elit dolor, consequat at lobortis in, pretium nec orci.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif; font-size: 14px;">Morbi gravida a est in scelerisque. Cras tincidunt justo at leo porta egestas. Integer fermentum purus nunc, sed euismod nisl vulputate at. Phasellus sit amet erat ac arcu accumsan fermentum. Integer id mattis ante. Quisque nibh dolor, facilisis sit amet mollis id, tempor nec neque. Fusce at mi leo.</p>', 'Bear brand', '', ''),
	(5, 'White Eggs', '', '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae consequat lectus, at ultricies libero. Suspendisse dignissim porta sapien, semper porttitor neque sagittis eget. Fusce egestas sem in lacinia molestie. Suspendisse maximus id purus id tempor. Ut vulputate, urna nec elementum convallis, purus est posuere quam, sit amet consequat diam tellus vel orci. Cras accumsan mi ante, a consectetur leo blandit et. Cras porttitor lectus metus, quis laoreet justo maximus maximus. Integer non mi nec lectus tincidunt elementum eu ut mauris. Pellentesque elementum, urna sit amet fringilla feugiat, nunc magna consequat ex, et dictum neque dui nec diam.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Sed ut nisi quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla commodo imperdiet enim sed volutpat. Suspendisse faucibus, velit sit amet porta vehicula, lorem justo cursus nibh, eu cursus ex sapien vel risus. Proin aliquam sit amet est et tristique. Duis in risus mi. Sed pulvinar tristique sapien eget ultrices. Vivamus blandit purus nulla. Praesent scelerisque aliquam ipsum semper sollicitudin. Ut lobortis metus magna, sed luctus metus auctor in. Sed eget vehicula odio. Maecenas faucibus in sem mollis faucibus. In sed sapien volutpat, rhoncus libero vitae, finibus libero. Aliquam vel metus auctor, vestibulum arcu in, eleifend ante.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Nam posuere ipsum vitae porttitor mollis. Sed ut ante vel massa auctor aliquet. Duis posuere volutpat nisl id ultricies. Praesent sagittis nisl orci, eget venenatis urna rhoncus egestas. Sed interdum aliquam fermentum. Integer sed odio in enim mattis facilisis. Nam eu rhoncus mauris, sit amet facilisis purus. Suspendisse vehicula lacus mollis, efficitur nibh gravida, tincidunt lacus. Aliquam ac enim eu velit rhoncus volutpat at id purus. In hac habitasse platea dictumst.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Quisque tristique ornare leo, a ornare nunc pharetra nec. Vivamus ut quam sit amet quam convallis pulvinar. Proin ultrices aliquam lorem, sed vestibulum orci interdum in. In vitae mauris massa. Nulla metus mauris, mollis et malesuada at, placerat sed magna. Pellentesque pretium orci sed pretium cursus. Etiam ut nulla vel nibh ullamcorper pretium. Vivamus eros nibh, vestibulum vitae ultrices non, pellentesque non nulla. Etiam elit dolor, consequat at lobortis in, pretium nec orci.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Morbi gravida a est in scelerisque. Cras tincidunt justo at leo porta egestas. Integer fermentum purus nunc, sed euismod nisl vulputate at. Phasellus sit amet erat ac arcu accumsan fermentum. Integer id mattis ante. Quisque nibh dolor, facilisis sit amet mollis id, tempor nec neque. Fusce at mi leo.</p>', 'White Eggs', '', ''),
	(6, 'Ham', '', '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae consequat lectus, at ultricies libero. Suspendisse dignissim porta sapien, semper porttitor neque sagittis eget. Fusce egestas sem in lacinia molestie. Suspendisse maximus id purus id tempor. Ut vulputate, urna nec elementum convallis, purus est posuere quam, sit amet consequat diam tellus vel orci. Cras accumsan mi ante, a consectetur leo blandit et. Cras porttitor lectus metus, quis laoreet justo maximus maximus. Integer non mi nec lectus tincidunt elementum eu ut mauris. Pellentesque elementum, urna sit amet fringilla feugiat, nunc magna consequat ex, et dictum neque dui nec diam.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Sed ut nisi quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla commodo imperdiet enim sed volutpat. Suspendisse faucibus, velit sit amet porta vehicula, lorem justo cursus nibh, eu cursus ex sapien vel risus. Proin aliquam sit amet est et tristique. Duis in risus mi. Sed pulvinar tristique sapien eget ultrices. Vivamus blandit purus nulla. Praesent scelerisque aliquam ipsum semper sollicitudin. Ut lobortis metus magna, sed luctus metus auctor in. Sed eget vehicula odio. Maecenas faucibus in sem mollis faucibus. In sed sapien volutpat, rhoncus libero vitae, finibus libero. Aliquam vel metus auctor, vestibulum arcu in, eleifend ante.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Nam posuere ipsum vitae porttitor mollis. Sed ut ante vel massa auctor aliquet. Duis posuere volutpat nisl id ultricies. Praesent sagittis nisl orci, eget venenatis urna rhoncus egestas. Sed interdum aliquam fermentum. Integer sed odio in enim mattis facilisis. Nam eu rhoncus mauris, sit amet facilisis purus. Suspendisse vehicula lacus mollis, efficitur nibh gravida, tincidunt lacus. Aliquam ac enim eu velit rhoncus volutpat at id purus. In hac habitasse platea dictumst.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Quisque tristique ornare leo, a ornare nunc pharetra nec. Vivamus ut quam sit amet quam convallis pulvinar. Proin ultrices aliquam lorem, sed vestibulum orci interdum in. In vitae mauris massa. Nulla metus mauris, mollis et malesuada at, placerat sed magna. Pellentesque pretium orci sed pretium cursus. Etiam ut nulla vel nibh ullamcorper pretium. Vivamus eros nibh, vestibulum vitae ultrices non, pellentesque non nulla. Etiam elit dolor, consequat at lobortis in, pretium nec orci.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Morbi gravida a est in scelerisque. Cras tincidunt justo at leo porta egestas. Integer fermentum purus nunc, sed euismod nisl vulputate at. Phasellus sit amet erat ac arcu accumsan fermentum. Integer id mattis ante. Quisque nibh dolor, facilisis sit amet mollis id, tempor nec neque. Fusce at mi leo.</p>', 'Ham', '', ''),
	(7, '555 Tuna', '', '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae consequat lectus, at ultricies libero. Suspendisse dignissim porta sapien, semper porttitor neque sagittis eget. Fusce egestas sem in lacinia molestie. Suspendisse maximus id purus id tempor. Ut vulputate, urna nec elementum convallis, purus est posuere quam, sit amet consequat diam tellus vel orci. Cras accumsan mi ante, a consectetur leo blandit et. Cras porttitor lectus metus, quis laoreet justo maximus maximus. Integer non mi nec lectus tincidunt elementum eu ut mauris. Pellentesque elementum, urna sit amet fringilla feugiat, nunc magna consequat ex, et dictum neque dui nec diam.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Sed ut nisi quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla commodo imperdiet enim sed volutpat. Suspendisse faucibus, velit sit amet porta vehicula, lorem justo cursus nibh, eu cursus ex sapien vel risus. Proin aliquam sit amet est et tristique. Duis in risus mi. Sed pulvinar tristique sapien eget ultrices. Vivamus blandit purus nulla. Praesent scelerisque aliquam ipsum semper sollicitudin. Ut lobortis metus magna, sed luctus metus auctor in. Sed eget vehicula odio. Maecenas faucibus in sem mollis faucibus. In sed sapien volutpat, rhoncus libero vitae, finibus libero. Aliquam vel metus auctor, vestibulum arcu in, eleifend ante.</p><ul><li><span style="font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;="" text-align:="" justify;"="">Lorem lorem</span></li><li><span style="font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;="" text-align:="" justify;"="">Lorem lorem</span></li><li style="text-align: justify; "><font face="Open Sans, Arial, sans-serif"><span style="font-size: 14px;">Lorem lorem</span></font></li></ul>', '555 Tuna', '', ''),
	(8, 'Corn Beef', '', '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae consequat lectus, at ultricies libero. Suspendisse dignissim porta sapien, semper porttitor neque sagittis eget. Fusce egestas sem in lacinia molestie. Suspendisse maximus id purus id tempor. Ut vulputate, urna nec elementum convallis, purus est posuere quam, sit amet consequat diam tellus vel orci. Cras accumsan mi ante, a consectetur leo blandit et. Cras porttitor lectus metus, quis laoreet justo maximus maximus. Integer non mi nec lectus tincidunt elementum eu ut mauris. Pellentesque elementum, urna sit amet fringilla feugiat, nunc magna consequat ex, et dictum neque dui nec diam.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Sed ut nisi quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla commodo imperdiet enim sed volutpat. Suspendisse faucibus, velit sit amet porta vehicula, lorem justo cursus nibh, eu cursus ex sapien vel risus. Proin aliquam sit amet est et tristique. Duis in risus mi. Sed pulvinar tristique sapien eget ultrices. Vivamus blandit purus nulla. Praesent scelerisque aliquam ipsum semper sollicitudin. Ut lobortis metus magna, sed luctus metus auctor in. Sed eget vehicula odio. Maecenas faucibus in sem mollis faucibus. In sed sapien volutpat, rhoncus libero vitae, finibus libero. Aliquam vel metus auctor, vestibulum arcu in, eleifend ante.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Nam posuere ipsum vitae porttitor mollis. Sed ut ante vel massa auctor aliquet. Duis posuere volutpat nisl id ultricies. Praesent sagittis nisl orci, eget venenatis urna rhoncus egestas. Sed interdum aliquam fermentum. Integer sed odio in enim mattis facilisis. Nam eu rhoncus mauris, sit amet facilisis purus. Suspendisse vehicula lacus mollis, efficitur nibh gravida, tincidunt lacus. Aliquam ac enim eu velit rhoncus volutpat at id purus. In hac habitasse platea dictumst.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Quisque tristique ornare leo, a ornare nunc pharetra nec. Vivamus ut quam sit amet quam convallis pulvinar. Proin ultrices aliquam lorem, sed vestibulum orci interdum in. In vitae mauris massa. Nulla metus mauris, mollis et malesuada at, placerat sed magna. Pellentesque pretium orci sed pretium cursus. Etiam ut nulla vel nibh ullamcorper pretium. Vivamus eros nibh, vestibulum vitae ultrices non, pellentesque non nulla. Etiam elit dolor, consequat at lobortis in, pretium nec orci.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">Morbi gravida a est in scelerisque. Cras tincidunt justo at leo porta egestas. Integer fermentum purus nunc, sed euismod nisl vulputate at. Phasellus sit amet erat ac arcu accumsan fermentum. Integer id mattis ante. Quisque nibh dolor, facilisis sit amet mollis id, tempor nec neque. Fusce at mi leo.</p>', 'Corn Beef', '', ''),
	(9, 'Test', '', '', 'Test', '', '');
/*!40000 ALTER TABLE `product_description` ENABLE KEYS */;

-- Dumping structure for table testdb.product_to_category
CREATE TABLE IF NOT EXISTS `product_to_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`) USING BTREE,
  KEY `Index` (`category_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.product_to_category: ~9 rows (approximately)
/*!40000 ALTER TABLE `product_to_category` DISABLE KEYS */;
INSERT INTO `product_to_category` (`product_id`, `category_id`) VALUES
	(9, 0),
	(7, 3),
	(8, 3),
	(4, 4),
	(5, 4),
	(2, 7),
	(6, 7),
	(1, 8),
	(3, 8);
/*!40000 ALTER TABLE `product_to_category` ENABLE KEYS */;

-- Dumping structure for table testdb.stock_status
CREATE TABLE IF NOT EXISTS `stock_status` (
  `stock_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`stock_status_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.stock_status: ~4 rows (approximately)
/*!40000 ALTER TABLE `stock_status` DISABLE KEYS */;
INSERT INTO `stock_status` (`stock_status_id`, `name`) VALUES
	(4, 'In Stock'),
	(5, 'Pre-Order'),
	(6, 'Out of Stock'),
	(10, '2-3 days');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.weight_class_description: ~5 rows (approximately)
/*!40000 ALTER TABLE `weight_class_description` DISABLE KEYS */;
INSERT INTO `weight_class_description` (`id`, `title`, `unit`) VALUES
	(1, 'Kilogram', 'kg'),
	(2, 'Gram', 'g'),
	(3, 'Pound', 'lb'),
	(4, 'Ounce', 'oz'),
	(5, 'Liter', 'l');
/*!40000 ALTER TABLE `weight_class_description` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
