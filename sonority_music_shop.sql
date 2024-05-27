-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.36 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sonority_music_shop
CREATE DATABASE IF NOT EXISTS `sonority_music_shop` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sonority_music_shop`;

-- Dumping structure for table sonority_music_shop.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(70) NOT NULL,
  `password` text,
  `name` varchar(45) DEFAULT NULL,
  `vcode` varchar(45) DEFAULT NULL,
  `profile_img` text,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.admin: ~1 rows (approximately)
INSERT INTO `admin` (`email`, `password`, `name`, `vcode`, `profile_img`) VALUES
	('hiranyagunawasrdhane@gamail.com', '$2y$10$eczZGi322teDxuSLqeWSJeHbwZgqQ3Rh2rNfK/rUNqHniHetuM8P2', 'Hiranyas Semindi', '8571', 'assets/img/profile_images/Hiranyas Semindi_660cd9b351324.jpeg');

-- Dumping structure for table sonority_music_shop.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.brand: ~13 rows (approximately)
INSERT INTO `brand` (`id`, `brand_name`) VALUES
	(1, 'Guitar Center'),
	(2, 'Sam Ash Music'),
	(3, 'Sweetwater'),
	(4, 'Musician\'s Friend'),
	(5, 'Reverb'),
	(6, 'Thomann'),
	(7, 'Andertons Music Co'),
	(8, 'Dawsons Music'),
	(9, 'Long & McQuade'),
	(10, 'Chicago Music Exchange'),
	(11, 'Gibson'),
	(12, 'Roland'),
	(13, 'Fender'),
	(14, 'xxn'),
	(15, 'undefined');

-- Dumping structure for table sonority_music_shop.brand_has_model
CREATE TABLE IF NOT EXISTS `brand_has_model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL,
  `model_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_brand_has_model_model1_idx` (`model_id`),
  KEY `fk_brand_has_model_brand1_idx` (`brand_id`),
  CONSTRAINT `fk_brand_has_model_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `fk_brand_has_model_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.brand_has_model: ~16 rows (approximately)
INSERT INTO `brand_has_model` (`id`, `brand_id`, `model_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 2, 3),
	(4, 3, 4),
	(5, 4, 5),
	(6, 4, 6),
	(7, 5, 7),
	(8, 6, 8),
	(9, 7, 9),
	(10, 8, 10),
	(11, 9, 11),
	(12, 10, 12),
	(13, 10, 13),
	(16, 11, 14),
	(17, 12, 15),
	(18, 13, 16);

-- Dumping structure for table sonority_music_shop.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qty` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.cart: ~4 rows (approximately)
INSERT INTO `cart` (`id`, `qty`, `product_id`, `user_email`) VALUES
	(10, 1, 2, 'dharmaratnec@yahoo.com'),
	(11, 1, 10, 'hiranyagunawardhane@gmail.com'),
	(14, 1, 3, 'menaraa@gmail.com'),
	(15, 1, 5, 'hiranyagunawardhane@gmail.com');

-- Dumping structure for table sonority_music_shop.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `img_path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.category: ~4 rows (approximately)
INSERT INTO `category` (`id`, `name`, `img_path`) VALUES
	(1, 'Electric Guitars', 'assets/img/Electric Guitars.jpg'),
	(2, 'Digital Piano', 'assets/img/Digital Piano.jpeg'),
	(3, 'Drum Kit', 'assets/img/Drum Kit.jpg'),
	(4, 'Electric Bass Guitar', 'assets/img/Electric Bass Guitar.jpg');

-- Dumping structure for table sonority_music_shop.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(45) DEFAULT NULL,
  `district_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_district1_idx` (`district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.city: ~6 rows (approximately)
INSERT INTO `city` (`id`, `city_name`, `district_id`) VALUES
	(1, 'Malambe', 1),
	(2, 'Kasbewa', 1),
	(3, 'Piliyandala', 1),
	(4, 'Homagama', 1),
	(5, 'Athurugiriya', 1),
	(6, 'Gonapola', 3),
	(7, 'Welmilla', 3);

-- Dumping structure for table sonority_music_shop.color
CREATE TABLE IF NOT EXISTS `color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `color` varchar(20) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.color: ~4 rows (approximately)
INSERT INTO `color` (`id`, `color`, `code`) VALUES
	(1, 'Red', '#c40000'),
	(2, 'Blue', '#0087bd'),
	(3, 'Black', '#0d0d0d'),
	(4, 'Brown', '#402402');

-- Dumping structure for table sonority_music_shop.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `condition` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.condition: ~2 rows (approximately)
INSERT INTO `condition` (`id`, `condition`) VALUES
	(1, 'BrandNew'),
	(2, 'Used');

-- Dumping structure for table sonority_music_shop.deliver_status
CREATE TABLE IF NOT EXISTS `deliver_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.deliver_status: ~2 rows (approximately)
INSERT INTO `deliver_status` (`id`, `status`) VALUES
	(1, 'Pending'),
	(2, 'Delivered');

-- Dumping structure for table sonority_music_shop.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(45) DEFAULT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_province1_idx` (`province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.district: ~2 rows (approximately)
INSERT INTO `district` (`id`, `district_name`, `province_id`) VALUES
	(1, 'Colombo', 1),
	(2, 'Gampaha', 1),
	(3, 'Kalutara', 1);

-- Dumping structure for table sonority_music_shop.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table sonority_music_shop.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `order_id` varchar(20) NOT NULL,
  `date_selled` datetime DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `total` varchar(45) DEFAULT NULL,
  `deliver_status_id` int NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  KEY `fk_invoice_deliver_status1_idx` (`deliver_status_id`),
  CONSTRAINT `fk_invoice_deliver_status1` FOREIGN KEY (`deliver_status_id`) REFERENCES `deliver_status` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.invoice: ~9 rows (approximately)
INSERT INTO `invoice` (`order_id`, `date_selled`, `user_email`, `total`, `deliver_status_id`) VALUES
	('660956141c174', '2024-03-31 17:55:14', 'hiranyagunawardhane@gmail.com', '4450', 2),
	('6609565d48585', '2024-03-31 17:56:19', 'hiranyagunawardhane@gmail.com', '45600', 2),
	('660c10b8dc2cf', '2024-04-02 19:36:42', 'dharmaratnec@yahoo.com', '5400', 2),
	('660cdadf2a3f9', '2024-04-03 09:58:35', 'hiranyagunawardhane@gmail.com', '26200', 1),
	('660d1a5399569', '2024-04-03 14:29:28', 'menaraa@gmail.com', '4600', 1),
	('660d1ee923300', '2024-04-03 14:48:52', 'menaraa@gmail.com', '40300', 1),
	('6611ab96d66a2', '2024-04-07 01:38:18', 'hiranyagunawardhane@gmail.com', '20700', 2),
	('664916cac6857', '2024-05-19 02:30:50', 'sahan@gmail.coom', '4600', 1),
	('6649175ab9b8c', '2024-05-19 02:32:48', 'hiranyagunawardhane@gmail.com', '4600', 1);

-- Dumping structure for table sonority_music_shop.invoice_item
CREATE TABLE IF NOT EXISTS `invoice_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qty` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `invoice_order_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_item_product1_idx` (`product_id`),
  KEY `fk_invoice_item_invoice1_idx` (`invoice_order_id`),
  CONSTRAINT `fk_invoice_item_invoice1` FOREIGN KEY (`invoice_order_id`) REFERENCES `invoice` (`order_id`),
  CONSTRAINT `fk_invoice_item_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.invoice_item: ~10 rows (approximately)
INSERT INTO `invoice_item` (`id`, `qty`, `product_id`, `invoice_order_id`) VALUES
	(38, 2, 4, '660956141c174'),
	(39, 1, 3, '6609565d48585'),
	(40, 1, 5, '6609565d48585'),
	(41, 1, 2, '660c10b8dc2cf'),
	(42, 1, 5, '660cdadf2a3f9'),
	(43, 1, 10, '660cdadf2a3f9'),
	(44, 1, 1, '660d1a5399569'),
	(45, 1, 3, '660d1ee923300'),
	(46, 1, 10, '6611ab96d66a2'),
	(47, 1, 10, '6611ab96d66a2'),
	(48, 1, 1, '664916cac6857'),
	(49, 1, 1, '6649175ab9b8c');

-- Dumping structure for table sonority_music_shop.model
CREATE TABLE IF NOT EXISTS `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.model: ~16 rows (approximately)
INSERT INTO `model` (`id`, `model_name`) VALUES
	(1, 'Fender Stratocaster'),
	(2, 'Yamaha Pacifica'),
	(3, 'Ibanez RG Series'),
	(4, 'PRS Custom 242'),
	(5, 'Epiphone Les Paul Standard'),
	(6, 'Fender Player Series'),
	(7, 'Gibson SG Standard'),
	(8, 'Harley Benton guitars and basses'),
	(9, 'Chapman Guitars'),
	(10, 'Fender American Professional Series'),
	(11, 'Taylor Academy Series'),
	(12, 'Gibson Custom Shop'),
	(13, 'Martin Custom Shop'),
	(14, 'xxn'),
	(15, 'FP-30'),
	(16, 'Player Jazz Bass'),
	(17, 'xxcc');

-- Dumping structure for table sonority_music_shop.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(80) DEFAULT NULL,
  `description` text,
  `category_id` int NOT NULL,
  `price` double DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `status_id` int NOT NULL,
  `added_date` datetime DEFAULT NULL,
  `condition_id` int NOT NULL,
  `rating` tinyint NOT NULL,
  `brand_has_model_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category_idx` (`category_id`),
  KEY `fk_product_status1_idx` (`status_id`),
  KEY `fk_product_condition1_idx` (`condition_id`),
  KEY `fk_product_brand_has_model1_idx` (`brand_has_model_id`),
  CONSTRAINT `fk_product_brand_has_model1` FOREIGN KEY (`brand_has_model_id`) REFERENCES `brand_has_model` (`id`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.product: ~7 rows (approximately)
INSERT INTO `product` (`id`, `title`, `description`, `category_id`, `price`, `delivery_fee_colombo`, `delivery_fee_other`, `qty`, `image_path`, `status_id`, `added_date`, `condition_id`, `rating`, `brand_has_model_id`) VALUES
	(1, 'Roland FP-30 Digital Piano, Black', 'Experience the ultimate in performance and portability with the Roland FP-30 Digital Piano in sleek Black. Boasting authentic piano feel and sound, along with modern features, the FP-30 is perfect for aspiring pianists and seasoned performers alike.', 2, 4000, 600, 1000, 17, 'assets/img/product_images/1_660cd5a0148a3.jpeg', 1, '2024-03-18 10:23:19', 1, 3, 17),
	(2, 'Yamaha Pacifica 112V Electric Guitar, Black', 'Unlock your musical potential with the Yamaha Pacifica 112V Electric Guitar in sleek Black finish. Renowned for its exceptional playability, versatility, and value, the Pacifica 112V is a favorite among guitarists of all skill levels.', 1, 5000, 400, 500, 6, 'assets/img/product_images/2_660cca94a9243.jpeg', 1, '2024-03-18 10:26:13', 1, 4, 2),
	(3, ' Ibanez RG550 Genesis Collection Electric Guitar, Desert Sun Yellow dc', 'Unleash your sonic potential with the Ibanez RG550 Genesis Collection Electric Guitar in striking Desert Sun Yellow finish. Part of the legendary RG Series, this instrument combines premium craftsmanship, cutting-edge design, and high-performance features to deliver an unparalleled playing experience.', 1, 40000, 300, 500, 2, 'assets/img/product_images/3_660ccb011da94.jpeg', 1, '2024-03-18 10:28:33', 1, 1, 3),
	(4, 'PRS Custom 24 Electric Guitar, Whale Blue', 'Elevate your stage presence with the PRS Custom 24 Electric Guitar in mesmerizing Whale Blue finish. Crafted by the esteemed artisans at PRS (Paul Reed Smith), this instrument embodies a perfect balance of elegance, versatility, and sonic excellence.', 1, 2000, 450, 550, 1, 'assets/img/product_images/4_660ccb5b10681.jpeg', 1, '2024-03-18 10:29:57', 1, 5, 4),
	(5, 'Pearl Export Series Drum Kit, High Voltage Blue', 'Take your drumming to the next level with the Pearl Export Series Drum Kit in striking High Voltage Blue. Offering exceptional sound and durability, this kit is a favorite among drummers worldwide.', 3, 5000, 500, 600, 4, 'assets/img/product_images/5_660cd62f61c88.png', 1, '2024-03-18 10:32:51', 1, 5, 5),
	(9, 'Gibson Les Paul Standard 50s Electric Guitar, Heritage Cherry Sunburst', 'Immerse yourself in the rich heritage of rock and blues with the Gibson Les Paul Standard 50s Electric Guitar in Heritage Cherry Sunburst. Featuring classic design elements and premium construction, this guitar delivers timeless tone and style.', 1, 10000, 500, 800, 10, 'assets/img/product_images/9_660cd4cea3643.jpeg', 1, '2024-04-03 09:32:22', 1, 1, 16),
	(10, 'Fender Player Jazz Bass Electric Bass Guitar, Polar White', 'Elevate your bass playing with the Fender Player Jazz Bass Electric Bass Guitar in eye-catching Polar White. With its smooth feel, versatile tone, and iconic design, this bass is perfect for any style of music.', 4, 20000, 700, 900, 9, 'assets/img/product_images/10_660cd6fb824ce.png', 1, '2024-04-03 09:41:39', 1, 1, 18);

-- Dumping structure for table sonority_music_shop.product_has_color
CREATE TABLE IF NOT EXISTS `product_has_color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `color_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_has_color_color1_idx` (`color_id`),
  KEY `fk_product_has_color_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_has_color_color1` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  CONSTRAINT `fk_product_has_color_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.product_has_color: ~0 rows (approximately)

-- Dumping structure for table sonority_music_shop.promotions
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(100) DEFAULT NULL,
  `description` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.promotions: ~7 rows (approximately)
INSERT INTO `promotions` (`id`, `image`, `description`, `date`) VALUES
	(1, 'assets/img/promo_images/1_660bcdea57d63.jpeg', 'Attention all music enthusiasts! Get ready to rock out with our incredible Music Madness Sale happening at [Shop Name]! Whether you\'re a seasoned pro or just starting your musical journey, we have something for everyone.', '2024-03-29 22:50:58'),
	(2, 'assets/img/promo_images/2_660bd76c9d3f2.jpeg', 'hello', '2024-04-02 14:44:38'),
	(3, 'assets/img/promo_images/3_660bccb939b72.jpeg', '', '2024-04-02 14:45:37'),
	(4, 'assets/img/promo_images/4_660bce3b06d0a.jpeg', 'xzxasawdds', '2024-04-02 14:46:24'),
	(5, 'assets/img/promo_images/5_660bccf60544f.jpeg', 'ssas', '2024-04-02 14:46:38'),
	(6, 'assets/img/promo_images/6_660bce04634ac.jpeg', 'sds', '2024-04-02 14:51:08'),
	(7, 'assets/img/promo_images/7_660bf78818272.jpeg', 'gsvevtryinmro8 owra vcxesdssd', '2024-04-02 17:48:16'),
	(8, 'assets/img/promo_images/8_660bf796125b5.jpeg', 'gsvevtryinmro8 owra vcxesdssd', '2024-04-02 17:48:30');

-- Dumping structure for table sonority_music_shop.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.province: ~2 rows (approximately)
INSERT INTO `province` (`id`, `province_name`) VALUES
	(1, 'Western'),
	(2, 'Eastern');

-- Dumping structure for table sonority_music_shop.ratings
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  `rating` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_has_product_product1_idx` (`product_id`),
  KEY `fk_user_has_product_user1_idx` (`user_email`),
  CONSTRAINT `fk_user_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_user_has_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.ratings: ~6 rows (approximately)
INSERT INTO `ratings` (`id`, `user_email`, `product_id`, `rating`) VALUES
	(1, 'hiranyagunawardhane@gmail.com', 10, 1),
	(2, 'hiranyagunawardhane@gmail.com', 5, 5),
	(3, 'sahan@gmail.coom', 1, 2),
	(4, 'hiranyagunawardhane@gmail.com', 1, 4),
	(5, 'hiranyagunawardhane@gmail.com', 4, 5);

-- Dumping structure for table sonority_music_shop.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `review` text,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reviews_user1_idx` (`user_email`),
  CONSTRAINT `fk_reviews_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.reviews: ~7 rows (approximately)
INSERT INTO `reviews` (`id`, `review`, `user_email`) VALUES
	(1, 'This place is a gem for any musician! The staff are incredibly knowledgeable and helpful. They have a wide selection of instruments and accessories, and the prices are competitive. I\'ve been coming here for years and have never been disappointed.', 'hiranyagunawardhane@gmail.com'),
	(2, 'Great store with a fantastic variety of instruments! I recently purchased a guitar here and the staff went above and beyond to help me find the perfect one within my budget. The atmosphere is welcoming and I always enjoy browsing through their selection.', 'rashmi@gmail.com'),
	(3, 'Decent shop, but the prices can be a bit steep. The staff are friendly, but sometimes it feels like they\'re more focused on making a sale rather than genuinely helping you find what you need. Overall, not a bad experience, but there\'s room for improvement.', 'tarin@gmail.com'),
	(4, 'I absolutely love this store! The staff are incredibly passionate about music and it shows. They\'ve helped me find rare instruments and even provided advice on maintenance and care. It\'s more than just a store; it\'s a community for musicians.', 'menaraa@gmail.com'),
	(5, 'Disappointed with my experience here. I found the staff to be uninterested in helping me, and the selection was limited. The prices were also higher than what I\'ve seen elsewhere. I\'ll be taking my business elsewhere in the future.', 'dfd@gmail.com'),
	(6, 'I\'ve had mixed experiences here, but overall it\'s a good shop. They have a decent selection, and the staff are usually helpful. Sometimes it gets busy and it can be hard to get assistance, but when they have time, they\'re great at guiding you through your options.', 'virulnirmala@gmail.com'),
	(7, 'I\'m a beginner in the world of music, and this shop has been incredibly supportive. They didn\'t make me feel intimidated or rushed when I was asking questions, and they helped me find the perfect instrument to start with. I highly recommend them!', 'tilakna@gmail.com');

-- Dumping structure for table sonority_music_shop.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.status: ~2 rows (approximately)
INSERT INTO `status` (`id`, `status`) VALUES
	(1, 'Active'),
	(2, 'Deactive');

-- Dumping structure for table sonority_music_shop.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` text,
  `gender_id` int NOT NULL,
  `status_id` int NOT NULL,
  `joined_date` datetime DEFAULT NULL,
  `verification_code` varchar(45) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `profile_img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender1_idx` (`gender_id`),
  KEY `fk_user_status1_idx` (`status_id`),
  CONSTRAINT `fk_user_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.user: ~9 rows (approximately)
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `gender_id`, `status_id`, `joined_date`, `verification_code`, `mobile`, `profile_img`) VALUES
	('df', 'df', 'dfd@gmail.com', '$2y$10$UxvrdtBllpBK1DrrsLF2T.NULb9cDPzZ1SHp7HEZg5WWVzF6M.4nK', 2, 2, '2024-03-14 00:39:05', '1658', '0783316784', 'assets/img/profile_images/H.S.A_65f70c9010d34.png'),
	('Chamila', 'Dharmarathne', 'dharmaratnec@yahoo.com', '$2y$10$hvc94Trvlgl0t5GYxuCspuuFSNA/78gaRyGetxylLBwxPykibpzza', 2, 1, '2024-04-02 19:32:22', NULL, '0714454095', 'assets/img/profile_images/Chamila_660c107c451f7.jpeg'),
	('xc', 'Semindi', 'hiranyagunawardhane@gmail.com', '$2y$10$IemEDn3KVvUJvzKLBFqOE.aaCtNIPlB7LPGCa3e8TlxxP2oGeCyBy', 2, 1, '2024-03-02 23:24:32', '9261', '0751122299', 'assets/img/profile_images/xc_6609a1ac69cbd.jpeg'),
	('Hiranya', 'Semindi', 'menara@gmail.com', '$2y$10$sm1f6pIHNuJ3HR7ZgUPbFO4SeNs/KTXi5cHcw9rD01HEnm/pEqbmW', 2, 2, '2024-03-14 00:27:36', NULL, '0751122994', 'assets/img/profile_images/H.S.A_65f70c9010d34.png'),
	('Menara', 'Perera', 'menaraa@gmail.com', '$2y$10$zJZeXqubWHu5h8Jcxeiq8OT5rPQ8ysZt0NgAoe.X85jS7Se4lIxym', 2, 1, '2024-04-03 14:21:02', NULL, '0783346798', 'assets/img/profile_images/Menara_660d21002d47d.png'),
	('H.S.A', 'Gunawardhane', 'rashmi@gmail.com', '$2y$10$hvB.VIFp11LpYPUU6Iw0buorJphfHZzDqlLLKtge.ipdoEoYSDPdO', 2, 1, '2024-03-03 10:43:31', NULL, '0751442990', 'assets/img/profile_images/H.S.A_65f70c9010d34.png'),
	('Sahan', 'Perera', 'sahan@gmail.coom', '$2y$10$idK0OrAHTNDTo.FsmFqEeeSG.J73TG4ZEGn6khDgrKGHTiyosFQ.W', 1, 1, '2024-03-18 15:59:48', NULL, '0783346798', 'assets/img/profile_images/Sahan_660d20d56ce2e.png'),
	('Tarin', 'Ransana', 'tarin@gmail.com', '$2y$10$AitNaKA/pc4mIFNpmS/s.OlvANWUT7R30JT7zPKeN.u08xvZunwAO', 1, 1, '2024-03-02 00:12:35', '4677', '0751122990', 'assets/img/profile_images/Tarin_660d20b0df899.png'),
	('Tilakna', 'Lewwandi', 'tilakna@gmail.com', '$2y$10$XG7kuK1uaXcDzH0zhALF3.X7AxdPU3uQayXljGUfaIkYdjTPoFl2i', 2, 1, '2024-03-18 15:58:55', '4426', '0712277227', 'assets/img/profile_images/Tilakna_660d202b55ca7.png'),
	('Virul', 'Nirmala', 'virulnirmala@gmail.com', '$2y$10$EOCfglkasaqn/ZqXrIN9Len0btLxR0N4oNvoDjMfM38jiJCb9O0ZW', 1, 1, '2024-03-18 15:55:43', '1878', '0721152990', 'assets/img/profile_images/Virul_660d1feb57578.png');

-- Dumping structure for table sonority_music_shop.user_has_address
CREATE TABLE IF NOT EXISTS `user_has_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `line1` text,
  `line2` text,
  `postal_code` varchar(5) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `city_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_has_address_user1_idx` (`user_email`),
  KEY `fk_user_has_address_city1_idx` (`city_id`),
  CONSTRAINT `fk_user_has_address_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_user_has_address_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.user_has_address: ~2 rows (approximately)
INSERT INTO `user_has_address` (`id`, `line1`, `line2`, `postal_code`, `user_email`, `city_id`) VALUES
	(1, '222/C, ', 'Aloka Uyana Road', '10300', 'hiranyagunawardhane@gmail.com', 2),
	(2, '222/C, ', 'Aloka Uyana Road', '10300', 'menara@gmail.com', 1),
	(3, '11', '11', '1200', 'dharmaratnec@yahoo.com', 2),
	(4, '112/2, Aloka Pedesa', 'Sandunpura', '1200', 'menaraa@gmail.com', 1),
	(5, '222/C, Aloka Uyana, Kesbewa', '', '10300', 'sahan@gmail.coom', 1);

-- Dumping structure for table sonority_music_shop.wishlist
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wishlist_product1_idx` (`product_id`),
  KEY `fk_wishlist_user1_idx` (`user_email`),
  CONSTRAINT `fk_wishlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_wishlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table sonority_music_shop.wishlist: ~7 rows (approximately)
INSERT INTO `wishlist` (`id`, `product_id`, `user_email`) VALUES
	(10, 2, 'dharmaratnec@yahoo.com'),
	(11, 10, 'hiranyagunawardhane@gmail.com'),
	(12, 1, 'menaraa@gmail.com'),
	(13, 3, 'menaraa@gmail.com'),
	(14, 5, 'menaraa@gmail.com'),
	(15, 2, 'hiranyagunawardhane@gmail.com');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
