-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2020 at 05:02 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vue_lar07`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_hot` tinyint(4) DEFAULT 0,
  `is_feature` tinyint(4) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pseudonym` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `category_id`, `description`, `content`, `is_hot`, `is_feature`, `status`, `thumbnail`, `author`, `pseudonym`, `source`, `type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 'Bánh đậu xanh', 8, '<p>Bánh đậu xanh</p>', '<p>Bánh đậu xanh</p>', 0, 0, 1, '1590771799Screenshot (18).png', 'Bánh đậu xanh', 'Bánh đậu xanh', 'Bánh đậu xanh', NULL, 'admin', NULL, '2020-05-29 10:03:19', '2020-05-29 10:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `time_intend` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `customer_id`, `status`, `user_id`, `total`, `quantity`, `time_intend`, `created_at`, `updated_at`) VALUES
(26, 2, 3, NULL, '1350000', 3, NULL, '2020-03-26 06:50:13', '2020-03-26 08:07:03'),
(27, NULL, 1, 1, '1400000', 3, NULL, '2020-04-01 03:49:01', '2020-04-01 03:49:24'),
(28, NULL, 2, 1, '1650000', 3, NULL, '2020-04-01 03:51:12', '2020-04-01 03:51:28'),
(29, 3, 0, NULL, '1700000', 4, NULL, '2020-04-01 03:52:19', '2020-04-01 08:59:31'),
(30, NULL, 0, 1, '1000000', 2, NULL, '2020-04-01 09:07:25', '2020-04-01 09:07:25'),
(31, 4, 0, NULL, '1900000', 4, NULL, '2020-04-02 06:23:42', '2020-04-02 06:23:42'),
(32, NULL, 1, 1, '500000', 1, NULL, '2020-04-02 06:38:24', '2020-04-05 10:27:33'),
(33, NULL, 0, 1, '2750000', 6, NULL, '2020-05-07 09:53:05', '2020-05-07 09:53:05'),
(34, NULL, 0, 1, '1000000', 2, NULL, '2020-06-06 09:00:16', '2020-06-06 09:00:16'),
(35, NULL, 0, 1, '400000', 1, NULL, '2020-06-06 09:08:01', '2020-06-06 09:08:01'),
(36, NULL, 0, 1, '400000', 1, NULL, '2020-06-06 09:09:07', '2020-06-06 09:09:07'),
(37, NULL, 0, 1, '400000', 1, NULL, '2020-06-06 09:10:38', '2020-06-06 09:10:38'),
(38, NULL, 0, 1, '400000', 1, NULL, '2020-06-06 09:12:10', '2020-06-06 09:12:10'),
(39, NULL, 0, 1, '400000', 1, NULL, '2020-06-06 09:13:00', '2020-06-06 09:13:00'),
(40, NULL, 0, 1, '400000', 1, NULL, '2020-06-06 09:14:14', '2020-06-06 09:14:14'),
(41, NULL, 0, 1, '973000', 5, NULL, '2020-06-06 09:34:10', '2020-06-06 09:34:10'),
(42, NULL, 0, 1, '1800000', 4, NULL, '2020-06-07 08:34:42', '2020-06-07 08:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `bill_product`
--

CREATE TABLE `bill_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_product`
--

INSERT INTO `bill_product` (`id`, `product_id`, `quantity`, `bill_id`, `created_at`, `updated_at`) VALUES
(35, 4, '1', 26, NULL, NULL),
(36, 1, '1', 26, NULL, NULL),
(37, 2, '1', 26, NULL, NULL),
(38, 4, '1', 27, NULL, NULL),
(39, 7, '2', 27, NULL, NULL),
(40, 5, '1', 28, NULL, NULL),
(41, 4, '1', 28, NULL, NULL),
(42, 3, '1', 28, NULL, NULL),
(43, 4, '1', 29, NULL, NULL),
(44, 1, '3', 29, NULL, NULL),
(45, 8, '2', 30, NULL, NULL),
(46, 8, '1', 31, NULL, NULL),
(47, 5, '1', 31, NULL, NULL),
(48, 4, '1', 31, NULL, NULL),
(49, 2, '1', 31, NULL, NULL),
(50, 8, '1', 32, NULL, NULL),
(51, 2, '5', 33, NULL, NULL),
(52, 4, '1', 33, NULL, NULL),
(53, 8, '2', 34, NULL, NULL),
(54, 1, '1', 35, NULL, NULL),
(55, 1, '1', 36, NULL, NULL),
(56, 1, '1', 37, NULL, NULL),
(57, 1, '1', 38, NULL, NULL),
(58, 1, '1', 39, NULL, NULL),
(59, 1, '1', 40, NULL, NULL),
(60, 2, '2', 41, NULL, NULL),
(61, 1, ',', 41, NULL, NULL),
(62, 9, '2', 41, NULL, NULL),
(63, 2, '4', 42, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `content`, `thumbnail`, `type`, `status`, `created_by`, `updated_by`, `_lft`, `_rgt`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Trang chủ', NULL, NULL, '1585126002bg-sp-home.jpg', 'Introduce', 1, NULL, 'admin', 1, 2, NULL, '2020-03-22 04:02:27', '2020-03-25 01:46:42'),
(2, 'Sản phẩm', NULL, NULL, '1584882475bn-product.jpg', 'Product', 1, NULL, 'admin', 3, 20, NULL, '2020-03-22 04:02:27', '2020-03-22 06:07:55'),
(3, 'Hoa quả', NULL, NULL, '1585123408bg-sp-home.jpg', 'Product', 1, NULL, 'admin', 4, 9, 2, '2020-03-22 04:02:27', '2020-03-25 01:03:28'),
(4, 'Đồ khô', NULL, NULL, NULL, 'Product', 1, NULL, NULL, 10, 13, 2, '2020-03-22 04:02:27', '2020-03-22 04:02:27'),
(5, 'Khuyến mãi', NULL, NULL, '1584882486bn-promotion.jpg', 'Promotion', 1, NULL, 'admin', 21, 22, NULL, '2020-03-22 04:02:27', '2020-03-22 06:08:06'),
(6, 'Về chúng tôi', NULL, NULL, '1584883342bn-news.jpg', 'About', 1, NULL, 'admin', 23, 24, NULL, '2020-03-22 04:02:27', '2020-03-22 06:22:22'),
(7, 'Hỗ trợ', NULL, NULL, NULL, 'Faq', 1, NULL, NULL, 25, 26, NULL, '2020-03-22 04:02:27', '2020-03-22 04:02:27'),
(8, 'Tin tức', NULL, NULL, NULL, 'News', 1, NULL, NULL, 27, 28, NULL, '2020-03-22 04:02:27', '2020-03-22 04:02:27'),
(9, 'Liên hệ', NULL, NULL, NULL, 'Contact', 1, NULL, NULL, 29, 30, NULL, '2020-03-22 04:02:27', '2020-03-22 04:02:27'),
(10, 'Hải sản', '<p>Mô tả</p>', '<p>Thêm mô tả</p>', '1585123299bn-promotion.jpg', 'Product', 1, 'admin', 'admin', 14, 15, 2, '2020-03-25 01:01:39', '2020-03-25 01:03:49'),
(12, 'Đồ khô', NULL, NULL, NULL, 'Product', 1, 'admin', NULL, 18, 19, 2, NULL, NULL),
(13, 'Hoa quả dầm', NULL, NULL, NULL, 'Product', 1, 'admin', NULL, 5, 6, 3, '2020-03-26 07:35:13', '2020-03-26 07:35:13'),
(14, 'Hoa quả khô', NULL, NULL, NULL, 'Product', 1, 'admin', NULL, 7, 8, 3, '2020-03-26 07:35:21', '2020-03-26 07:35:21'),
(15, 'Đồ khô ướt', NULL, NULL, NULL, 'Product', 1, 'admin', NULL, 11, 12, 4, '2020-03-26 07:35:33', '2020-03-26 07:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 3, 2, NULL, NULL),
(5, 3, 3, NULL, NULL),
(6, 4, 2, NULL, NULL),
(7, 4, 3, NULL, NULL),
(8, 4, 4, NULL, NULL),
(9, 5, 2, NULL, NULL),
(10, 6, 10, NULL, NULL),
(11, 7, 2, NULL, NULL),
(12, 7, 3, NULL, NULL),
(13, 7, 13, NULL, NULL),
(14, 8, 2, NULL, NULL),
(15, 8, 3, NULL, NULL),
(16, 9, 2, NULL, NULL),
(17, 9, 3, NULL, NULL),
(18, 10, 10, NULL, NULL),
(19, 10, 4, NULL, NULL),
(20, 10, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `email`, `note`, `created_at`, `updated_at`) VALUES
(2, 'Dang Duc Tung', '0973793711', 'Hà Nội', 'tungdd@gmail.com', NULL, '2020-03-26 06:50:13', '2020-03-26 06:50:13'),
(3, 'Mạnh Nuuu', '123', '123', 'nuu@gmal.com', NULL, '2020-04-01 03:52:19', '2020-04-01 03:52:19'),
(4, 'dang duc tung', 'sad', 'ád', 'ád', NULL, '2020-04-02 06:23:42', '2020-04-02 06:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `datatypes`
--

CREATE TABLE `datatypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datatypes`
--

INSERT INTO `datatypes` (`id`, `title`, `code`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Sản phẩm', 'Product', NULL, NULL, NULL),
(2, 'Tin tức', 'News', NULL, NULL, NULL),
(3, 'HomePage', 'Introduce', NULL, NULL, NULL),
(4, 'Hỗ trợ', 'FAQ', NULL, NULL, NULL),
(5, 'Liên hệ', 'Contact', NULL, NULL, NULL),
(6, 'Giới thiệu', 'About', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2020_03_14_165540_create_datatypes', 1),
(3, '2020_03_15_132312_categories', 1),
(4, '2020_03_16_145453_units', 1),
(5, '2020_03_16_145636_suppliers', 1),
(6, '2020_03_17_031153_products', 1),
(7, '2020_03_17_135321_category_product', 1),
(8, '2020_03_19_103926_articles', 1),
(9, '2020_03_21_162055_customers', 1),
(10, '2020_03_21_162422_bills', 1),
(11, '2020_03_21_162603_bill_product', 1),
(12, '2020_03_24_041317_create_address', 2),
(13, '2020_04_02_033422_system', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT 0,
  `original_price` double DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `is_bestseller` tinyint(4) DEFAULT 0,
  `is_hot` tinyint(4) DEFAULT 1,
  `status` tinyint(4) DEFAULT 1,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `code`, `description`, `content`, `thumbnail`, `images`, `price`, `original_price`, `quantity`, `is_bestseller`, `is_hot`, `status`, `unit_id`, `supplier_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Cá ngừ hun khói', 'plasa', NULL, NULL, '15848771270cart1.jpg', '[\"15848771270cart1.jpg\"]', 400000, 450000, 0, 0, 0, 1, 1, 1, 'admin', 'admin', '2020-03-22 04:38:47', '2020-06-06 09:34:11'),
(2, 'Cá ngừ đại dương', '6JAfA', '<p>Switch is used for switching between two opposing states.</p>', '<p>Switch is used for switching between two opposing states.</p>', '15848834370product3.jpg', '[\"15848834370product3.jpg\"]', 450000, 560000, 4, 1, 0, 1, 1, 1, 'admin', NULL, '2020-03-22 06:23:57', '2020-06-07 08:34:43'),
(3, 'Nam Trang', 'NamTrang', NULL, NULL, '15849575780m-pro2.jpg', '[\"15849575780m-pro2.jpg\",\"15849575781m-pro3.jpg\"]', 700000, 890000, 125, 0, 0, 1, 1, 2, 'admin', NULL, '2020-03-23 02:59:38', '2020-03-23 02:59:38'),
(4, 'Mạnh nuu', 'Nuuu', NULL, NULL, '15849576020product1.jpg', '[\"15849576020product1.jpg\"]', 500000, 780000, 1, 0, 0, 1, 1, 2, 'admin', NULL, '2020-03-23 03:00:02', '2020-03-23 03:00:02'),
(5, 'Mạnh dở hơi', 'cXfdp', '<p>Rất là dở hơi</p>', '<p>Xấu tính</p>', '15851255270cart3.jpg', '[\"15851255270cart3.jpg\"]', 450000, 900000, 200, 0, 0, 1, 1, 1, 'admin', 'admin', '2020-03-25 01:14:38', '2020-03-25 01:38:47'),
(6, 'Mạnh xấu xí', 'EkXVW', NULL, NULL, '15852345990cart3.jpg', '[\"15852345990cart3.jpg\",\"15852345991sb-news4.jpg\"]', 600000, 900000, 120, 0, 0, 1, 1, 2, 'admin', NULL, '2020-03-26 07:56:39', '2020-03-26 07:56:39'),
(7, 'Mạnh nuu si', 'Ev4Sc', NULL, NULL, '15852346300sb-news3.jpg', '[\"15852346300sb-news3.jpg\"]', 450000, 780000, 450, 0, 0, 1, 1, 1, 'admin', NULL, '2020-03-26 07:57:10', '2020-03-26 07:57:10'),
(8, 'Mạnh ăn cứt', 'ydBql', NULL, NULL, '15852346960sb-news4.jpg', '[\"15852346960sb-news4.jpg\"]', 500000, 780000, 45, 0, 0, 1, 1, 1, 'admin', NULL, '2020-03-26 07:58:16', '2020-03-26 07:58:16'),
(9, 'Lalala', 'jnZvQ', NULL, NULL, '1591457095072d564525afcb3b455ab3172fb23c2d6de4cc53b1681299e4a9d457696dba737.jpeg', '[\"1591457095072d564525afcb3b455ab3172fb23c2d6de4cc53b1681299e4a9d457696dba737.jpeg\"]', 25000, 12000, 8, 0, 0, 1, 2, 2, 'admin', NULL, '2020-06-06 08:24:55', '2020-06-06 09:34:11'),
(10, 'Lelele', 'PrZwe', NULL, NULL, '1591457119087649661_203614134382397_3063759150451261440_n.jpg', '[\"1591457119087649661_203614134382397_3063759150451261440_n.jpg\"]', 23000, 45000, 100, 0, 0, 1, 1, 2, 'admin', NULL, '2020-06-06 08:25:19', '2020-06-06 08:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `title`, `description`, `content`, `address`, `phone`, `gmail`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Văn Hoá Việt', NULL, NULL, 'Hoàng Quốc Việt', '0973793711', 'tungdd98@gmail.com', 1, 'admin', NULL, '2020-03-22 05:50:24', '2020-03-22 05:50:24'),
(2, 'Phú Phú Phú', '<p>123</p>', '<p>123</p>', '123', '123', '123', 1, 'admin', NULL, '2020-03-22 05:50:40', '2020-03-22 05:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` bigint(20) NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fanpage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `company`, `address`, `phone`, `hotline`, `time`, `copyright`, `fanpage`, `brief`, `facebook`, `gmail`, `twitter`, `google`) VALUES
(1, 'Tomita Mart', 'B2-BT5 Lưu Hữu Phước, Mỹ Đình 2, Nam Từ Liêm, Hà Nội', '(+84) 243 200 1930', '0981 645 533 - 0989 353 233', '07:00 - 21:00 từ T2 - CN', 'Copyright @ 2018 tomitamart.vn - All Rights reserved | Design by Apecsoft', 'https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ftomitamart%2F&tabs&width=270&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=1863080223943997', 'TOMITA MART - HỆ THỐNG SIÊU THỊ THỰC PHẨM CAO CẤP\r\nThương hiệu độc quyền thuộc Tomita Farm.,JSC', 'https://www.facebook.com/tunggleee', 'https://www.facebook.com/tunggleee', 'https://www.facebook.com/tunggleee', 'https://www.facebook.com/tunggleee');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `title`, `note`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Kg', 'Kilogram', 1, 'admin', NULL, '2020-03-22 04:44:19', '2020-03-22 04:44:19'),
(2, 'G', 'Grammmm', 1, 'admin', 'admin', '2020-03-22 04:44:31', '2020-03-25 01:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ward` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `city`, `district`, `ward`, `phone`, `birthday`, `gender`, `status`, `avatar`, `level`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$A7QxGHue2ez8sUkK0SlNBOumH4sFQHY7JuHaMQo0qG0ytKOFbo4W.', 'số 44 ngõ 421', '01', '021', '00610', '0973793711', '03/02/2020', '1', 1, NULL, 1, '2020-03-09 15:52:15', '2020-04-01 08:23:46'),
(5, 'Nguyễn Mạnh Cường', 'dsaddsad', 'sadasdasd', 'ádsadsdas', NULL, NULL, NULL, 'sadsadsad', NULL, '1', 1, NULL, 0, '2020-03-22 20:39:30', '2020-03-22 20:39:30'),
(6, 'A Cang xấu xí', 'Cangxauxi@gmail.com', '123', 'haha', '11', '102', '03292', '0123456789', 'Mon Mar 02 2020 00:00:00 GMT+0700 (Giờ Đông Dương)', '0', 1, NULL, 0, '2020-03-24 01:49:28', '2020-03-24 01:49:28'),
(7, 'mạnh nuu si', 'manhnuu@gmail.com', '123456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-05-29 09:30:11', '2020-05-29 09:30:11'),
(8, 'mạnh dốt nát', 'manhhihi@gmail.com', '$2y$10$JCJL5cKoj0kQk3bvS7IeyOCdUI68BUzhzYX.oKfDWb6WffMogdINO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-05-29 09:36:47', '2020-05-29 09:36:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_category_id_foreign` (`category_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_product`
--
ALTER TABLE `bill_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_product_product_id_foreign` (`product_id`),
  ADD KEY `bill_product_bill_id_foreign` (`bill_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_product_product_id_foreign` (`product_id`),
  ADD KEY `category_product_category_id_foreign` (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datatypes`
--
ALTER TABLE `datatypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_unit_id_foreign` (`unit_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `bill_product`
--
ALTER TABLE `bill_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `datatypes`
--
ALTER TABLE `datatypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bill_product`
--
ALTER TABLE `bill_product`
  ADD CONSTRAINT `bill_product_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
