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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.admin_logs: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin_logs` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.cart: ~2 rows (approximately)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` (`cart_id`, `api_id`, `customer_id`, `product_id`, `quantity`, `date_added`) VALUES
	(6, 0, 1, 3, 4, '2022-01-29 04:56:11'),
	(7, 0, 1, 1, 1, '2022-01-30 08:55:07');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.customer: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`customer_id`, `firstname`, `lastname`, `email`, `telephone`, `password`, `ip`, `status`, `date_added`) VALUES
	(1, 'John', 'Doe', 'johndoe@email.com', '09123456789', '1', '::1', 1, '2022-01-13 05:31:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.customer_address: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer_address` DISABLE KEYS */;
INSERT INTO `customer_address` (`address_id`, `customer_id`, `firstname`, `lastname`, `address_1`, `address_2`, `city`, `postcode`, `region`) VALUES
	(1, 1, 'John', 'Doe', '044, Santol', 'Balubad, Bulakan, Bulacan', 'Balagtas', '3016', 'Bulacan');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.customer_ip: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer_ip` DISABLE KEYS */;
INSERT INTO `customer_ip` (`customer_ip_id`, `customer_id`, `email`, `ip`, `date_added`) VALUES
	(1, 1, 'cpascual107@gmail.com', '::1', '2022-01-13 05:31:00');
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
  `info_description` mediumtext NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`information_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.information_description: ~3 rows (approximately)
/*!40000 ALTER TABLE `information_description` DISABLE KEYS */;
INSERT INTO `information_description` (`information_id`, `info_title`, `info_description`, `meta_title`, `meta_description`, `meta_keyword`, `info_status`, `date_added`, `date_modified`) VALUES
	(7, 'About Us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim, dui et rutrum tristique, sapien neque pulvinar leo, eget dapibus est ipsum sed justo. Pellentesque tincidunt quis ligula non tincidunt. Nunc facilisis dignissim sodales. Aliquam vitae nulla malesuada, efficitur ex sed, convallis elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris risus felis, ultrices vel mauris a, dictum euismod nibh. Nam non aliquet turpis. Nulla a laoreet ipsum. Pellentesque porttitor leo lectus, ac tristique ante pharetra ut. Integer fermentum sagittis metus quis efficitur. Maecenas id felis aliquet, molestie leo non, gravida felis. Maecenas a ex velit. Mauris eleifend libero mauris, vel ultricies lectus rutrum eu. Nullam ligula nulla, semper at metus eu, porttitor aliquam lacus.\n\nMorbi interdum est ac accumsan viverra. Ut vel sapien eget mi venenatis sagittis. Curabitur mollis libero vitae libero efficitur tincidunt. Nullam efficitur urna in justo sagittis tempor. Phasellus molestie, purus nec tincidunt vehicula, ipsum quam aliquam justo, non accumsan magna erat ut enim. Donec tristique nibh sit amet felis commodo, ut tincidunt massa vulputate. Etiam pellentesque nisi tincidunt enim laoreet aliquet. Vestibulum euismod consequat sapien, vitae consequat metus dictum non. Aenean pharetra nulla non elementum tempor. Nunc fringilla, mi eget fringilla scelerisque, leo augue malesuada nulla, ut ornare lectus tortor eget purus. Vivamus nunc neque, efficitur ut consectetur non, auctor eu lacus. Proin tincidunt purus ac ligula molestie, eget feugiat lacus ultricies. Nullam a nibh quis felis maximus tempor ut in enim. Suspendisse placerat ipsum id elit interdum, sed sodales sem dignissim.', 'About Us', '', '', 1, '2022-01-13 05:49:35', '2022-01-16 19:58:29'),
	(8, 'Privacy Policy', 'Etiam eu ultricies tellus. Ut vitae sagittis tortor, eu viverra lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam ultricies faucibus urna, ac ullamcorper nisl commodo a. Sed condimentum sodales justo, vel consequat tellus eleifend et. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean placerat risus sit amet venenatis placerat.\n\nDonec eget eleifend purus. Donec in laoreet risus. Nunc posuere, lorem quis pharetra accumsan, ipsum risus rutrum quam, vel fermentum orci libero at dui. Praesent lacus orci, rhoncus eu neque quis, tincidunt laoreet mauris. Mauris vel felis pellentesque, ultricies neque sit amet, facilisis massa. Donec at arcu lobortis, rhoncus risus non, suscipit ex. Quisque quis magna sed mi tempor venenatis. Ut et consequat urna. Ut in massa vel nisl auctor venenatis ac id tellus. Integer velit nulla, tempor non sapien quis, luctus posuere nisi. Vestibulum molestie ligula luctus eleifend tempus. Integer ante ex, commodo sit amet mi eget, pellentesque aliquet ex. Vivamus vitae mi nulla. Nullam vitae nulla lobortis, imperdiet sapien id, pretium leo.\n\n\nInteger mattis efficitur ante vitae aliquet. Ut fringilla augue at tincidunt eleifend. Phasellus at sodales nisl. Suspendisse vestibulum dolor leo, id luctus nisi bibendum et. Duis sit amet ante a ante volutpat auctor. Phasellus in arcu vitae justo tristique fringilla at nec eros. Duis ut arcu sollicitudin, commodo velit volutpat, mattis arcu. Aliquam vitae turpis risus. Proin id sollicitudin nisl. Nulla ultrices urna ac quam venenatis, nec fringilla nisl dapibus. Morbi ac augue ut nibh posuere dignissim nec non leo. Curabitur eget cursus est.', 'Privacy Policy', '', '', 1, '2022-01-13 05:50:14', '2022-01-16 20:03:17'),
	(9, 'Terms & Condition', 'Nunc dictum sem eget risus elementum lobortis. Pellentesque venenatis maximus nulla iaculis hendrerit. Phasellus sagittis a nunc aliquet malesuada. Ut dignissim rutrum nibh nec tristique. Aenean mauris eros, sodales sed ligula at, interdum lacinia dui. Vestibulum accumsan lacus vitae tellus placerat, in consequat magna gravida. Nam pharetra laoreet augue eget porttitor. Ut turpis felis, faucibus hendrerit sem ut, dictum vehicula orci. Nunc facilisis odio massa, quis efficitur ante dignissim sit amet. Ut a dignissim quam. Ut sit amet consectetur tortor. Ut imperdiet scelerisque orci ultricies placerat. Suspendisse massa sem, ornare a erat in, ornare consequat lorem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;\n\nEtiam eu ultricies tellus. Ut vitae sagittis tortor, eu viverra lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam ultricies faucibus urna, ac ullamcorper nisl commodo a. Sed condimentum sodales justo, vel consequat tellus eleifend et. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean placerat risus sit amet venenatis placerat.\n\nDonec eget eleifend purus. Donec in laoreet risus. Nunc posuere, lorem quis pharetra accumsan, ipsum risus rutrum quam, vel fermentum orci libero at dui. Praesent lacus orci, rhoncus eu neque quis, tincidunt laoreet mauris. Mauris vel felis pellentesque, ultricies neque sit amet, facilisis massa. Donec at arcu lobortis, rhoncus risus non, suscipit ex. Quisque quis magna sed mi tempor venenatis. Ut et consequat urna. Ut in massa vel nisl auctor venenatis ac id tellus. Integer velit nulla, tempor non sapien quis, luctus posuere nisi. Vestibulum molestie ligula luctus eleifend tempus. Integer ante ex, commodo sit amet mi eget, pellentesque aliquet ex. Vivamus vitae mi nulla. Nullam vitae nulla lobortis, imperdiet sapien id, pretium leo.', 'Terms & Condition', '', '', 1, '2022-01-13 05:50:45', '2022-01-16 20:06:54');
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
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.orders: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`order_id`, `invoice_no`, `customer_id`, `firstname`, `lastname`, `email`, `telephone`, `comment`, `payment_method`, `payment_code`, `total`, `order_status_id`, `ip`, `pick_up_date`, `date_added`, `date_modified`) VALUES
	(1, 'INV-2022-16000', 1, 'John', 'Doe', 'johndoe@email.com', '09123456789', '', 'Gcash', 'gcash', 750.0000, 2, '::1', '2022-01-24', '2022-01-23 03:45:17', '2022-01-29 18:10:23');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.orders_history: ~3 rows (approximately)
/*!40000 ALTER TABLE `orders_history` DISABLE KEYS */;
INSERT INTO `orders_history` (`order_history_id`, `invoice_no`, `order_id`, `order_status_id`, `comment`, `date_added`) VALUES
	(1, 'INV-2022-16000', 1, 2, '', '2022-01-23 03:45:17'),
	(2, 'INV-2022-16000', 1, 8, 'test', '2022-01-29 05:05:08'),
	(3, 'INV-2022-16000', 1, 3, 'test', '2022-01-29 05:39:08'),
	(4, 'INV-2022-16000', 1, 2, '', '2022-01-29 06:10:23');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.order_product: ~2 rows (approximately)
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
INSERT INTO `order_product` (`order_product_id`, `invoice_no`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `total`) VALUES
	(1, 'INV-2022-16000', 1, 3, 'Orange', 4, 150.0000, 600.0000),
	(2, 'INV-2022-16000', 1, 6, 'Ham', 1, 150.0000, 150.0000);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.order_total: ~4 rows (approximately)
/*!40000 ALTER TABLE `order_total` DISABLE KEYS */;
INSERT INTO `order_total` (`order_total_id`, `order_id`, `invoice_no`, `title`, `val`) VALUES
	(1, 1, 'INV-2022-16000', 'Sub-Total', 750.0000),
	(2, 1, 'INV-2022-16000', 'Total', 750.0000),
	(3, 1, 'INV-2022-16000', 'Vat', 0.0000),
	(4, 0, 'INV-2022-00000', 'Total', 0.0000);
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
	(4, 'Bear brand', 60, 10, '', 1, 120.0000, 1.00000000, 3, 1, '2022-01-13 06:28:41', '2022-01-13 18:28:41'),
	(5, 'White Eggs', 20, 5, '', 4, 120.0000, 0.00000000, 1, 1, '2022-01-13 06:31:40', '2022-01-13 18:31:40'),
	(6, 'Ham', 20, 5, '', 4, 150.0000, 1.00000000, 1, 1, '2022-01-13 06:32:56', '2022-01-13 18:32:56'),
	(7, '555 Tuna', 100, 4, '', 2, 90.0000, 0.00000000, 1, 1, '2022-01-13 06:34:45', '2022-01-13 18:34:45'),
	(8, 'Corn Beef', 100, 4, '', 3, 90.0000, 0.00000000, 1, 1, '2022-01-13 06:35:12', '2022-01-13 18:35:12'),
	(9, 'Test', 1, 4, '', 0, 1.0000, 0.00000000, 1, 0, '2022-01-15 10:55:01', '2022-01-29 17:29:47');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testdb.product_description: ~9 rows (approximately)
/*!40000 ALTER TABLE `product_description` DISABLE KEYS */;
INSERT INTO `product_description` (`product_id`, `product_name`, `product_desc`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
	(1, 'Lemon', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim, dui et rutrum tristique, sapien neque pulvinar leo, eget dapibus est ipsum sed justo. Pellentesque tincidunt quis ligula non tincidunt. Nunc facilisis dignissim sodales. Aliquam vitae nulla malesuada, efficitur ex sed, convallis elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris risus felis, ultrices vel mauris a, dictum euismod nibh. Nam non aliquet turpis. Nulla a laoreet ipsum. Pellentesque porttitor leo lectus, ac tristique ante pharetra ut. Integer fermentum sagittis metus quis efficitur. Maecenas id felis aliquet, molestie leo non, gravida felis. Maecenas a ex velit. Mauris eleifend libero mauris, vel ultricies lectus rutrum eu. Nullam ligula nulla, semper at metus eu, porttitor aliquam lacus.', 'Lemon', '', 'Product 1'),
	(2, 'Bacon', 'Morbi interdum est ac accumsan viverra. Ut vel sapien eget mi venenatis sagittis. Curabitur mollis libero vitae libero efficitur tincidunt. Nullam efficitur urna in justo sagittis tempor. Phasellus molestie, purus nec tincidunt vehicula, ipsum quam aliquam justo, non accumsan magna erat ut enim. Donec tristique nibh sit amet felis commodo, ut tincidunt massa vulputate.', 'Bacon', '', 'Product 2'),
	(3, 'Orange', 'Ut elit augue, finibus ac risus quis, porta placerat lectus. Nulla egestas tempus sem, ut rhoncus mauris bibendum vitae. In nec metus vitae dolor commodo tincidunt. Sed mattis ante semper, egestas nulla id, fermentum eros. Donec nulla lorem, ultricies dapibus molestie ac, sollicitudin ut elit. Vivamus luctus sollicitudin porta. ', 'Orange', '', 'Product 3'),
	(4, 'Bear brand', 'Morbi interdum est ac accumsan viverra. Ut vel sapien eget mi venenatis sagittis. Curabitur mollis libero vitae libero efficitur tincidunt. Nullam efficitur urna in justo sagittis tempor. Phasellus molestie, purus nec tincidunt vehicula, ipsum quam aliquam justo, non accumsan magna erat ut enim. Donec tristique nibh sit amet felis commodo, ut tincidunt massa vulputate. Etiam pellentesque nisi tincidunt enim laoreet aliquet.', 'Bear brand', '', ''),
	(5, 'White Eggs', 'Morbi interdum est ac accumsan viverra. Ut vel sapien eget mi venenatis sagittis. Curabitur mollis libero vitae libero efficitur tincidunt. Nullam efficitur urna in justo sagittis tempor. Phasellus molestie, purus nec tincidunt vehicula, ipsum quam aliquam justo, non accumsan magna erat ut enim. Donec tristique nibh sit amet felis commodo, ut tincidunt massa vulputate. Etiam pellentesque nisi tincidunt enim laoreet aliquet. ', 'White Eggs', '', ''),
	(6, 'Ham', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim, dui et rutrum tristique, sapien neque pulvinar leo, eget dapibus est ipsum sed justo. Pellentesque tincidunt quis ligula non tincidunt. ', 'Ham', '', ''),
	(7, '555 Tuna', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim, dui et rutrum tristique, sapien neque pulvinar leo, eget dapibus est ipsum sed justo. Pellentesque tincidunt quis ligula non tincidunt. ', '555 Tuna', '', ''),
	(8, 'Corn Beef', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim, dui et rutrum tristique, sapien neque pulvinar leo, eget dapibus est ipsum sed justo. Pellentesque tincidunt quis ligula non tincidunt. ', 'Corn Beef', '', ''),
	(9, 'Test', '', 'Test', '', '');
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
