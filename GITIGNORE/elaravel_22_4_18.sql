# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.5-10.1.30-MariaDB
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2018-04-22 20:43:41
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for elaravel
DROP DATABASE IF EXISTS `elaravel`;
CREATE DATABASE IF NOT EXISTS `elaravel` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `elaravel`;


# Dumping structure for table elaravel.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

# Dumping data for table elaravel.migrations: ~5 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2018_04_10_135858_create_tbl_admin_table', 1),
	(2, '2018_04_15_145845_create_tbl_categories_table', 2),
	(3, '2018_04_15_154127_create_tbl_categories_table', 3),
	(4, '2018_04_16_155843_create_tbl_brands_table', 4),
	(5, '2018_04_16_160141_create_tbl_brands_table', 5),
	(6, '2018_04_17_062357_create_tbl_products_table', 6),
	(7, '2018_04_18_155757_create_tbl_sliders_table', 7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


# Dumping structure for table elaravel.tbl_admin
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

# Dumping data for table elaravel.tbl_admin: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
REPLACE INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`, `created_at`, `updated_at`) VALUES
	(1, 'aalmamun417@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'mamun', '1234', '2018-04-15 16:24:36', '2018-04-10 20:19:33');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;


# Dumping structure for table elaravel.tbl_brands
DROP TABLE IF EXISTS `tbl_brands`;
CREATE TABLE IF NOT EXISTS `tbl_brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

# Dumping data for table elaravel.tbl_brands: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_brands` DISABLE KEYS */;
REPLACE INTO `tbl_brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'symphony', 1, '2018-04-17 11:56:50', '2018-04-17 11:56:50'),
	(4, 'walton', 1, '2018-04-17 20:32:47', '2018-04-17 20:32:47'),
	(5, 'lava', 1, '2018-04-18 13:15:28', '2018-04-18 13:15:28'),
	(6, 'oppo', 1, '2018-04-18 13:16:03', '2018-04-18 13:16:03'),
	(7, 'sony', 1, '2018-04-18 13:16:16', '2018-04-18 13:16:16'),
	(8, 'nokea', 1, '2018-04-18 13:16:34', '2018-04-18 13:16:34'),
	(9, 'others', 1, '2018-04-18 13:16:44', '2018-04-18 13:16:44');
/*!40000 ALTER TABLE `tbl_brands` ENABLE KEYS */;


# Dumping structure for table elaravel.tbl_categories
DROP TABLE IF EXISTS `tbl_categories`;
CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

# Dumping data for table elaravel.tbl_categories: ~8 rows (approximately)
/*!40000 ALTER TABLE `tbl_categories` DISABLE KEYS */;
REPLACE INTO `tbl_categories` (`id`, `category_name`, `category_description`, `status`, `created_at`, `updated_at`) VALUES
	(20, 'women', 'description', 1, '2018-04-16 21:08:42', '2018-04-16 21:08:42'),
	(21, 'men', 'description', 1, '2018-04-16 21:55:44', '2018-04-16 21:55:44'),
	(22, 'laptop', NULL, 1, '2018-04-18 13:15:09', '2018-04-18 13:15:09'),
	(23, 'laptop', NULL, 1, '2018-04-18 13:15:09', '2018-04-18 13:15:09'),
	(24, 'electronics', NULL, 1, '2018-04-18 13:17:21', '2018-04-18 13:17:21'),
	(25, 'cloth', NULL, 1, '2018-04-18 13:17:30', '2018-04-18 13:17:30'),
	(26, 'accessories', NULL, 1, '2018-04-18 13:17:52', '2018-04-18 13:17:52'),
	(27, 'others', NULL, 1, '2018-04-18 13:17:59', '2018-04-18 13:17:59');
/*!40000 ALTER TABLE `tbl_categories` ENABLE KEYS */;


# Dumping structure for table elaravel.tbl_products
DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `products_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `products_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products_price` double(8,2) NOT NULL,
  `products_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

# Dumping data for table elaravel.tbl_products: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_products` DISABLE KEYS */;
REPLACE INTO `tbl_products` (`id`, `products_name`, `category_id`, `brand_id`, `products_description`, `products_price`, `products_image`, `products_size`, `products_color`, `status`, `created_at`, `updated_at`) VALUES
	(19, 'Sibuthin Capsule', 22, 6, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. ', 100000.00, 'G8hobavLqxiUbthgallery2.jpg', NULL, NULL, 1, '2018-04-18 20:04:05', '2018-04-18 20:04:05'),
	(20, 'shirt', 23, 6, NULL, 23000.00, 'GNrOCN40FPdD9ATone.png', NULL, NULL, 1, '2018-04-22 15:28:30', '2018-04-22 15:28:30'),
	(21, 'pant', 24, 7, NULL, 4000.00, 'TGyN42aeLLuarBBthree.png', NULL, NULL, 1, '2018-04-22 15:28:55', '2018-04-22 15:28:55'),
	(22, 'laptop', 24, 7, NULL, 40000.00, 'Iq3P00KVdPILh74product5.jpg', NULL, NULL, 1, '2018-04-22 15:29:47', '2018-04-22 15:29:47');
/*!40000 ALTER TABLE `tbl_products` ENABLE KEYS */;


# Dumping structure for table elaravel.tbl_products_copy
DROP TABLE IF EXISTS `tbl_products_copy`;
CREATE TABLE IF NOT EXISTS `tbl_products_copy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `products_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `products_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products_price` double(8,2) NOT NULL,
  `products_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

# Dumping data for table elaravel.tbl_products_copy: ~15 rows (approximately)
/*!40000 ALTER TABLE `tbl_products_copy` DISABLE KEYS */;
REPLACE INTO `tbl_products_copy` (`id`, `products_name`, `category_id`, `brand_id`, `products_description`, `products_price`, `products_image`, `products_size`, `products_color`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'i-phone 10', 21, 3, 'This is a nice phone', 100000.00, 'k64P7dqncgxRiC3girl3.jpg', '6\'', 'red,white,black', 1, '2018-04-17 16:24:42', '2018-04-17 16:24:42'),
	(3, 'walton', 21, 3, 'This is a nice phone&nbsp;', 100000.00, 'uzz55mkBz9F2Gdtproduct6.jpg', '6\'', 'red,white,black', 0, '2018-04-17 16:30:50', '2018-04-17 16:30:50'),
	(4, 'test', 20, 8, NULL, 100000.00, 'rfPJZdU36LA9pz8gallery2.jpg', '21', 'red,white,black', 1, '2018-04-17 20:37:18', '2018-04-17 20:37:18'),
	(5, 'mouse', 25, 5, NULL, 3000.00, 'xyWfJa7iXxZf8XZgallery1.jpg', NULL, NULL, 0, '2018-04-18 13:19:49', '2018-04-18 13:19:49'),
	(6, 'iphon 7', 24, 9, NULL, 40000.00, 'AoQiOSahrUX90WYgallery2.jpg', NULL, 'red', 0, '2018-04-18 13:21:56', '2018-04-18 13:21:56'),
	(7, 'light', 24, 9, NULL, 1000.00, 'mBDO7ECgopp77Ntgirl1.jpg', NULL, 'red', 1, '2018-04-18 13:22:28', '2018-04-18 13:22:28'),
	(8, 'test', 20, 8, NULL, 100000.00, '0gfDZXndvzl9XHsproduct1.jpg', '21', 'red,white,black', 1, '2018-04-18 13:22:58', '2018-04-18 13:22:58'),
	(9, 'pant', 25, 9, NULL, 900.00, 'h21OoUvXOZJyNUwproduct2.jpg', NULL, 'red', 1, '2018-04-18 13:23:41', '2018-04-18 13:23:41'),
	(10, 't shirt', 25, 9, NULL, 6600.00, 'AnuhDmJd8abmn5Eproduct4.jpg', NULL, 'red', 1, '2018-04-18 13:24:05', '2018-04-18 13:24:05'),
	(11, 'product', 25, 9, NULL, 6600.00, 'ZcRL2fyvelc7RFtgallery1.jpg', NULL, 'red', 1, '2018-04-18 13:24:40', '2018-04-18 13:24:40'),
	(12, 'product 2', 25, 9, NULL, 6600.00, 'bRqZcGl6CchfwJTproduct5.jpg', NULL, 'red', 1, '2018-04-18 13:24:54', '2018-04-18 13:24:54'),
	(13, 'product 3', 25, 9, NULL, 6600.00, '5Ft2MRBARx4hN2mproduct3.jpg', NULL, 'red', 1, '2018-04-18 13:25:11', '2018-04-18 13:25:11'),
	(14, 'product 4', 25, 9, NULL, 6600.00, 'ODphnOyowCC2cyAgirl3.jpg', NULL, 'red', 1, '2018-04-18 13:25:24', '2018-04-18 13:25:24'),
	(15, 'product 7', 25, 9, NULL, 6600.00, '8eP6szl6eEDit8ggirl2.jpg', NULL, 'red', 1, '2018-04-18 13:25:38', '2018-04-18 13:25:38'),
	(16, 'test', 21, 9, NULL, 100000.00, 'JztHIaotjVQf8iKgirl3.jpg', '21', NULL, 1, '2018-04-18 19:27:53', '2018-04-18 19:27:53');
/*!40000 ALTER TABLE `tbl_products_copy` ENABLE KEYS */;


# Dumping structure for table elaravel.tbl_sliders
DROP TABLE IF EXISTS `tbl_sliders`;
CREATE TABLE IF NOT EXISTS `tbl_sliders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

# Dumping data for table elaravel.tbl_sliders: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_sliders` DISABLE KEYS */;
REPLACE INTO `tbl_sliders` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
	(20, 'slider1', 'DSKt7EA2Fja8Hhkgirl2.jpg', 1, '2018-04-19 19:08:59', '2018-04-19 19:08:59'),
	(21, 'slider2', '5Prfv9GST0F26zBgirl1.jpg', 1, '2018-04-19 20:08:38', '2018-04-19 20:08:38'),
	(22, 'slider3', 'H0LgLtGBc4xrAUIgirl3.jpg', 1, '2018-04-19 20:30:57', '2018-04-19 20:30:57');
/*!40000 ALTER TABLE `tbl_sliders` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
