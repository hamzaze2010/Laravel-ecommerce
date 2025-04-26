-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 07, 2024 at 10:24 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shatarat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `image_path`, `Gender`, `created_at`, `updated_at`, `reset_token`) VALUES
(4, 'hamzaahmed', 'hamza@gmail.com', '$2y$12$9Svc5IT.Ledzba2GIXhZy.i9vZ54OMlgQf/SwKH3vu8ZT2/ayu4oS', 'admin/img/3kYs1PDncBCPgN306YeARDoGP8ZDvFjsjmy25GQZ.jpg', 'male', '2024-06-11 08:17:14', '2024-06-14 07:09:51', 'UXZOTQiIOtSIXxMjlpDgLabYXOLQPg3exiCHiUbNJr1jl754VV5PUgwE8ltb'),
(14, 'mohammad', 'mohammad3010d@hotmail.com', '$2y$12$GIFnF8XV2J.2Jq5EHtnBBef1jq.7HbexsdF3fu/lvP4USduMEsz8.', 'admin/img/PaoCSa5yxAuh67pqL4IhwHX1eYDuSIJAZHowRYww.png', 'male', '2024-06-12 06:45:49', '2024-06-14 07:21:46', NULL),
(15, 'amaal', 'amal@gmail.com', '$2y$12$BVum1T.68bLqIoRM4ALHK.oNbAHFo/uR3pQX3AnqB9sKzzn1CxKxS', 'admin/img/wXIuij8rLoVlQ4BlkCedgrriptZy5kkYhAVT2yRI.jpg', 'male', '2024-06-12 08:07:53', '2024-06-22 07:40:13', 'sAtevbVTuwgWPZlEyDz4zFaxcAFiLgQlvMjEKv3gOyiIXYfEPvJSteZtWGez');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `status`, `description`, `created_at`, `updated_at`) VALUES
(9, 'Computers', 'images/VrdTRiGLL3M97qTVfS2D9ISUZsQx9PViNyyt4sUk.jpg', 'active', 'all computer accessories', '2024-06-12 07:55:19', '2024-06-29 04:03:59'),
(10, 'Cloth', 'images/QBMsLiNFUxOwRbOF0wToH6IUtzjLbjF4GT4ACYaM.jpg', 'active', 'hhhhh', '2024-06-12 07:55:35', '2024-06-29 04:04:07'),
(11, 'Furniture', 'images/bc1y49P8iu6LQEN7dL1V3vt8qsfHJQT8fCvS3pju.jpg', 'active', 'fffgggg', '2024-06-12 07:55:51', '2024-06-29 04:04:15'),
(14, 'Households', 'images/tvoO2QHleP3uvxes9sCYAt3D3iTAkcVIBu1eHCvN.jpg', 'active', 'Households for cleaning', '2024-06-16 04:33:59', '2024-06-29 04:04:40'),
(17, 'appliances', 'images/ScTtxWKn85ydNC2HP7tfhtV9PLw7iWq9QVyI4Ilp.jpg', 'active', 'fridges, dryer, washing machine, kittle , cooking apliances', '2024-06-26 07:30:58', '2024-06-29 04:04:56'),
(22, 'shoes', 'images/EeKa04VmmomgJGju5S4BeJTtgLW0oGDt835cr32B.jpg', 'active', 'ffggghhh', '2024-06-29 05:05:15', '2024-06-29 05:05:15'),
(23, 'mobile phones', 'images/xpbbKmc79sYUDAeN0fMbRROkS85ivbt0LVOli9r1.jpg', 'active', 'phones of all types', '2024-07-03 13:05:02', '2024-07-03 13:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_06_11_130645_admin_table', 1),
(7, '2024_06_11_130716_add_column_to_table_name', 1),
(8, '2024_06_11_130802_create_category_table', 1),
(9, '2024_06_11_130851_drop_product_id_from_categories_table', 1),
(11, '2024_06_11_130918_create_products_table', 2),
(12, '2024_06_13_103902_add_password_reset_columns_to_admin_table', 3),
(13, '2024_06_13_105748_add_reset_token_to_admin_table', 4),
(14, '2024_06_20_100414_update_table_users', 5),
(15, '2024_06_29_105307_create_wishlists_table', 6),
(16, '2024_07_03_101922_create_orders_table', 7),
(17, '2024_07_03_102056_create_order_items_table', 8),
(18, '2024_07_03_104319_create_carts_table', 9),
(19, '2024_07_03_122946_add_columns_to_carts_table', 10),
(20, '2024_07_03_174535_add_columns_to_products_table', 11),
(21, '2024_07_10_110922_update_orders_table', 12),
(22, '2024_07_10_111654_update_orders_table_remove_status', 12),
(23, '2024_07_10_113240_add_status_column_to_orders_table', 13),
(24, '2024_07_10_113753_add_total_column_to_order_items_table', 14),
(25, '2024_07_10_165932_modify_orders_table', 15),
(26, '2024_07_10_170245_add_address_fields_to_users_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('received','processing','confirmed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'received',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `disc_price` decimal(8,2) DEFAULT NULL,
  `hot_trend` tinyint(1) NOT NULL DEFAULT '0',
  `best_seller` tinyint(1) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `disc_price`, `hot_trend`, `best_seller`, `featured`, `category_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'bottle', 'clean and healthy', 20, 0, NULL, 0, 0, 0, 14, 'images/yUbvCW2KQGieMBke2C3zdaTcF24wI2njGuIVYwMk.jpg', 'active', '2024-06-16 04:47:34', '2024-06-16 04:50:46'),
(3, 'shirt', 'blue', 600, 0, NULL, 0, 0, 0, 10, 'images/zmBg88cnMLwK91IBKpdox9ine8G8k0mXoSIzj0WP.jpg', 'active', '2024-06-16 04:50:20', '2024-06-16 04:50:20'),
(6, 'shoes', 'black', 300, 0, NULL, 0, 0, 0, 10, 'images/84IRNijJ9iLgVJTQQlXZ20ivyOzbjW38PcjYXWVP.jpg', 'active', '2024-06-16 05:29:58', '2024-06-16 05:30:10'),
(8, 'shirt', 'gray shirt for men', 900, 0, NULL, 0, 0, 0, 10, 'images/JVo8qDsd2n3kRRY294ivi0Cd5ERLUC7fOeqh8gfU.jpg', 'active', '2024-06-26 07:17:11', '2024-06-26 07:17:11'),
(9, 'hp laptop', 'hp pavilion gaming laptop', 94000, 0, NULL, 0, 0, 0, 9, 'images/iRbs9nO6WKkQGGglQyzuhRs3ntlwvfy2rvpjdKIy.jpg', 'active', '2024-06-26 07:42:48', '2024-06-26 07:42:48'),
(10, 'office table', 'black for wide use', 5000, 0, NULL, 0, 0, 0, 11, 'images/60VOAackjhSlaQoxJ7gDq7wuVtqwH17dCF9UXwGX.png', 'active', '2024-06-26 07:43:57', '2024-06-26 07:43:57'),
(11, 'AC', 'sumsung AC', 45000, 0, NULL, 0, 0, 0, 17, 'images/SdSfp0d7iXioRO6nXEvQ6qI19aiJwLg2S4KK7kDw.jpg', 'active', '2024-06-26 07:45:18', '2024-06-26 07:45:18'),
(12, 'apple laptop', 'black apple laptop', 100000, 0, NULL, 0, 0, 0, 9, 'images/jxS1oqa0d7e2soEgm96JWJL7JO1F1mNQFOkPexAu.jpg', 'active', '2024-06-28 07:13:37', '2024-06-28 07:13:37'),
(13, 'shoes', 'leather', 500, 0, NULL, 1, 1, 1, 22, 'images/uCdhiZgzsjN8luBS4IYnNDPRaZooXCp63ENkzLJB.jpg', 'active', '2024-06-29 05:05:43', '2024-07-03 12:57:49'),
(14, 'iphone', 'black iphone', 60000, 4, 58000.00, 1, 1, 1, 23, 'images/utSMpX83UdqL4fClhYUfv5vbdN3kXmpGLjyqOB8C.jpg', 'active', '2024-07-03 12:55:02', '2024-07-03 14:00:50'),
(15, 'iphone15', 'red color', 65000, 5, 62000.00, 1, 1, 1, 23, 'images/yfn1aYp7ku0krBUbxDsBG3wlsMZwYvOJYp5LyRuq.jpg', 'active', '2024-07-03 13:06:02', '2024-07-03 13:06:02'),
(16, 'sumsang', 'balck sumsang', 40000, 5, 35000.00, 1, 1, 1, 23, 'images/sKtQHdLFTwCEjK5ur3DsgI2mtxB1p2mlIIFR0ixC.jpg', 'active', '2024-07-03 13:39:55', '2024-07-03 14:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `country`, `city`, `state`, `email_verified_at`, `password`, `address`, `phone`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'hamza ahmed', 'kingzaze10@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$LtNkGOwPkjj7B5PrZT.BXOU0tzN.suqYwK2TFx9Yw0eZNkhOkHBF2', 'G V ENCLAVE, PEETHALA STREET, CHINAWALTER, VISHAKHAPATNAM-530017.', '09392630359', 'images/WoIkLaSYmsR1XVYlx73p2qlzkT4qvTJNBVLvgEgo.jpg', NULL, '2024-06-13 17:05:13', '2024-07-13 06:15:27'),
(2, 'Aweis ali', 'aweis@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$/81e2Pm8w3yl6C3hpO1SJe1i3WwcWybWDWRKuCXaql6twN3ffdlea', 'hhhhh', '2314789652', 'images/CjsFoGQ8RmtfnYu11nmJLaZOoE18reCfyswbKwXU.png', NULL, '2024-06-14 05:18:38', '2024-06-20 05:10:25'),
(3, 'amaal', 'amal@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$zdLW9t2x5luHWXEMQX.PhOOLZaFnzGvWd.e3Dvl.gbMw1KtNMpmeu', 'G V ENCLAVE, PEETHALA STREET, CHINAWALTER, VISHAKHAPATNAM-530017.', '09640444958', 'images/BTUuew0fLT14eC05INq7W94qCtRCV9Esx4D6866s.png', NULL, '2024-06-14 06:53:21', '2024-07-13 06:18:11'),
(4, 'mohammad', 'mohammad3010d@hotmail.com', NULL, NULL, NULL, NULL, '$2y$12$MTtbZv7exnlxclSyN6raZ.0evds8Fp8.lgcbpIQ8C3c6N3sVxsziK', NULL, NULL, 'images/Nwxd35zmd6PiklAC3tuliBAPmbh3KoSTJbR2uVNG.jpg', NULL, '2024-06-20 04:28:35', '2024-06-20 04:28:50'),
(5, 'cilmi', 'cilmi@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$s20iwlXmWe9ggGvVqJ6YLOUXWREn/BGD2f1t6WT/mqcWatOpXeSpC', 'hhhhh', '9392630359', 'images/OPcYZqpWRYZziuBvWERNzIDz8WtlrnfCFMMMbiWZ.png', NULL, '2024-06-20 04:53:04', '2024-06-20 04:53:04'),
(6, 'hamda', 'hamda@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$kRTrbJuaDd0H6VYHPm1w4O8XKcPaEds5QdUbo187XkOobiwuUOXT6', 'ffffff', '5055894715', 'images/DXUdlrgflcJuLTI6EmVV2RQzWBBSofnBu7oBnyHL.jpg', NULL, '2024-06-20 04:57:25', '2024-06-20 04:57:25'),
(7, 'mohammad', 'mohammad@hotmail.com', NULL, NULL, NULL, NULL, '$2y$12$AgXx/B7veKBe2cEL5UpAxepg7MjAJAZWH1062DNe68jyG3EGGB19.', 'hhhhh', '3636363636', 'images/sFfB5RMZpboNjeWswsxN6xCfBD9el5Bm4fUK7Y60.jpg', NULL, '2024-06-20 05:13:23', '2024-06-20 05:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `wishlists_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(15, 3, 8, '2024-07-03 04:11:02', '2024-07-03 04:11:02'),
(14, 3, 11, '2024-07-03 04:10:59', '2024-07-03 04:10:59'),
(13, 3, 2, '2024-07-03 04:10:55', '2024-07-03 04:10:55'),
(12, 3, 6, '2024-07-03 04:10:51', '2024-07-03 04:10:51'),
(11, 3, 3, '2024-07-03 04:10:49', '2024-07-03 04:10:49');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
