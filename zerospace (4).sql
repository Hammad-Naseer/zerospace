-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 08:00 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zerospace`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` int(10) UNSIGNED NOT NULL,
  `acc_title` varchar(100) NOT NULL,
  `acc_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `acc_title`, `acc_status`, `created_at`, `updated_at`) VALUES
(1, 'KnJ Account', 1, NULL, '2023-03-19 11:22:55'),
(4, 'J&Y Account', 1, '2023-03-15 11:45:45', '2023-03-15 11:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(10) UNSIGNED NOT NULL,
  `acc_id` bigint(20) UNSIGNED NOT NULL,
  `brand_title` varchar(100) NOT NULL,
  `brand_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `acc_id`, `brand_title`, `brand_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'ZeroSpace', 1, '2023-03-18 15:54:07', '2023-03-18 15:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(10) UNSIGNED NOT NULL,
  `acc_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `cat_title` varchar(100) NOT NULL,
  `cat_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `acc_id`, `brand_id`, `cat_title`, `cat_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Lunch Boxes', 1, '2023-03-18 15:54:19', '2023-03-18 15:54:19'),
(2, 1, 1, 'Water Bottles', 1, '2023-03-18 19:38:25', '2023-03-18 19:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `counter_id` int(11) NOT NULL,
  `pur_refrence_no` int(11) NOT NULL,
  `stock_refrence_no` int(11) NOT NULL,
  `sales_invoice_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`counter_id`, `pur_refrence_no`, `stock_refrence_no`, `sales_invoice_no`) VALUES
(0, 2, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expensecategories`
--

CREATE TABLE `expensecategories` (
  `exp_cat_id` int(10) UNSIGNED NOT NULL,
  `exp_cat_title` varchar(255) NOT NULL,
  `exp_cat_code` varchar(255) DEFAULT NULL,
  `acc_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensecategories`
--

INSERT INTO `expensecategories` (`exp_cat_id`, `exp_cat_title`, `exp_cat_code`, `acc_id`, `created_at`, `updated_at`) VALUES
(1, 'Bank Account Charges', '01', 1, '2023-03-19 14:38:37', '2023-03-19 14:38:37'),
(2, 'Marketing & VVRO', '02', 1, '2023-03-19 14:41:53', '2023-03-19 14:41:53'),
(3, 'Returns & Listing Loss', '03', 1, '2023-03-19 14:42:17', '2023-03-19 14:42:17'),
(4, 'Warehouse Charges', '04', 1, '2023-03-19 14:43:00', '2023-03-19 14:43:00'),
(5, 'Pickup Delivery Charges', '05', 1, '2023-03-19 14:43:35', '2023-03-19 14:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `exp_id` int(10) UNSIGNED NOT NULL,
  `exp_cat_id` bigint(20) UNSIGNED NOT NULL,
  `exp_date` date NOT NULL,
  `exp_amount` varchar(255) NOT NULL,
  `exp_details` varchar(255) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`exp_id`, `exp_cat_id`, `exp_date`, `exp_amount`, `exp_details`, `acc_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-04-01', '200', 'Monthly Charges', 1, '2023-03-19 14:44:10', '2023-03-19 14:44:10'),
(2, 2, '2023-04-01', '1500', 'VVRO\'s, PPC and Returns', 1, '2023-03-19 14:44:55', '2023-03-19 14:44:55'),
(3, 4, '2023-04-01', '1200', 'Jamal Warehouse Monthly', 1, '2023-03-19 14:45:41', '2023-03-19 14:45:41'),
(4, 5, '2023-04-01', '1500', 'for Deliveries', 1, '2023-03-19 14:46:12', '2023-03-19 14:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itemdetails`
--

CREATE TABLE `itemdetails` (
  `item_detail_id` int(10) UNSIGNED NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `cost_per_unit` double(8,2) DEFAULT NULL,
  `item_pur_price` double(8,2) NOT NULL,
  `item_sale_price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `itemdetails`
--

INSERT INTO `itemdetails` (`item_detail_id`, `item_id`, `cost_per_unit`, `item_pur_price`, `item_sale_price`, `created_at`, `updated_at`) VALUES
(1, '1', 0.00, 21.50, 0.00, '2023-03-18 15:55:51', '2023-03-18 15:56:23'),
(2, '2', 0.00, 20.20, 0.00, '2023-03-18 16:02:53', '2023-03-18 16:02:53'),
(3, '3', 0.00, 20.20, 0.00, '2023-03-18 16:02:53', '2023-03-18 16:02:53'),
(4, '4', 0.00, 20.20, 0.00, '2023-03-18 16:05:07', '2023-03-18 16:05:07'),
(5, '5', 24.00, 21.40, 55.00, '2023-03-18 19:19:07', '2023-03-18 23:44:53'),
(6, '6', 24.00, 21.40, 55.00, '2023-03-18 19:19:07', '2023-03-18 23:44:53'),
(7, '7', 24.00, 21.40, 55.00, '2023-03-18 19:23:43', '2023-03-19 00:17:16'),
(8, '8', 23.00, 21.40, 55.00, '2023-03-18 19:23:43', '2023-03-19 00:17:16'),
(9, '9', 32.00, 31.00, 70.00, '2023-03-18 19:28:13', '2023-03-20 17:30:01'),
(10, '10', 32.00, 31.00, 70.00, '2023-03-18 19:28:13', '2023-03-19 14:35:49'),
(11, '11', 0.00, 14.80, 0.00, '2023-03-18 19:32:36', '2023-03-18 23:26:37'),
(12, '12', 0.00, 14.80, 0.00, '2023-03-18 19:32:36', '2023-03-18 23:26:40'),
(13, '13', 0.00, 5.90, 0.00, '2023-03-18 19:37:17', '2023-03-18 19:37:17'),
(14, '14', 0.00, 5.90, 0.00, '2023-03-18 19:37:17', '2023-03-18 19:37:17'),
(15, '15', 0.00, 10.10, 0.00, '2023-03-18 19:49:57', '2023-03-18 19:49:57'),
(16, '16', 0.00, 10.10, 0.00, '2023-03-18 19:49:57', '2023-03-18 19:49:57'),
(17, '17', 0.00, 10.10, 0.00, '2023-03-18 19:49:57', '2023-03-18 19:49:57'),
(18, '18', 0.00, 10.10, 0.00, '2023-03-18 19:49:57', '2023-03-18 19:49:57'),
(19, '19', 0.00, 10.10, 0.00, '2023-03-18 19:49:57', '2023-03-18 19:49:57'),
(20, '20', 0.00, 10.10, 0.00, '2023-03-18 19:49:57', '2023-03-18 19:49:57'),
(21, '21', 13.00, 11.00, 40.00, '2023-03-18 20:05:26', '2023-03-19 14:30:36'),
(22, '22', 13.00, 11.00, 40.00, '2023-03-18 20:05:26', '2023-03-19 14:30:36'),
(23, '23', 13.00, 11.00, 40.00, '2023-03-18 20:05:26', '2023-03-19 14:30:36'),
(24, '24', 13.00, 11.00, 40.00, '2023-03-18 20:05:26', '2023-03-19 14:30:36'),
(25, '25', 13.00, 11.00, 40.00, '2023-03-18 20:05:26', '2023-03-19 14:30:36'),
(26, '26', 13.00, 11.00, 40.00, '2023-03-18 20:05:26', '2023-03-19 14:30:36'),
(27, '27', 28.00, 26.20, 60.00, '2023-03-18 20:15:58', '2023-03-19 14:15:37'),
(28, '28', 28.00, 26.20, 60.00, '2023-03-18 20:15:58', '2023-03-19 14:23:36'),
(29, '29', 28.00, 26.20, 60.00, '2023-03-18 20:15:58', '2023-03-19 14:23:36'),
(30, '30', 28.00, 26.20, 60.00, '2023-03-18 20:15:58', '2023-03-19 14:23:36'),
(31, '31', 28.00, 26.20, 60.00, '2023-03-18 20:15:58', '2023-03-19 14:23:36'),
(32, '32', 0.00, 14.70, 0.00, '2023-03-19 01:29:27', '2023-03-19 01:29:27'),
(33, '33', 0.00, 14.70, 0.00, '2023-03-19 01:29:27', '2023-03-19 01:29:27'),
(34, '34', 0.00, 14.70, 0.00, '2023-03-19 01:29:27', '2023-03-19 01:29:27'),
(35, '35', 0.00, 14.70, 0.00, '2023-03-19 01:29:27', '2023-03-19 01:29:27'),
(36, '36', 0.00, 14.70, 0.00, '2023-03-19 01:29:27', '2023-03-19 01:29:27'),
(37, '37', 0.00, 7.30, 0.00, '2023-03-19 01:38:45', '2023-03-19 01:38:45'),
(38, '38', 0.00, 7.30, 0.00, '2023-03-19 01:38:45', '2023-03-19 01:38:45'),
(39, '39', 0.00, 7.30, 0.00, '2023-03-19 01:38:45', '2023-03-19 01:38:45'),
(40, '40', 0.00, 7.30, 0.00, '2023-03-19 01:38:45', '2023-03-19 01:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `listingowners`
--

CREATE TABLE `listingowners` (
  `list_owner_id` int(10) UNSIGNED NOT NULL,
  `list_owner_name` varchar(255) NOT NULL,
  `list_owner_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_20_104114_create_categories_table', 1),
(8, '2023_02_22_070134_create_accounts_table', 1),
(9, '2023_02_22_101314_create_brands_table', 1),
(11, '2023_02_23_102710_create_warehouses_table', 1),
(14, '2023_02_27_102319_create_product_sizes_tables', 3),
(18, '2023_02_22_125800_create_variants_table', 5),
(19, '2023_02_23_113121_create_productitems_table', 6),
(21, '2023_02_28_093605_create_purchases_detail_table', 8),
(23, '2023_02_28_111911_create_purchases_details_table', 10),
(31, '2023_02_21_093828_create_vendors_table', 15),
(32, '2023_02_21_050044_create_products_table', 16),
(33, '2023_02_27_102834_create_product_sizes_table', 17),
(35, '2023_02_28_121156_create_purchasedetails_table', 19),
(37, '2023_02_28_093202_create_purchases_table', 20),
(40, '2023_03_08_102932_create_permission_tables', 23),
(41, '2023_03_01_150049_create_stocks_table', 24),
(42, '2023_03_01_194050_create_stockdetails_table', 25),
(43, '2023_03_09_162016_create_item_prices_table', 26),
(44, '2023_03_09_162710_create_itemprices_table', 27),
(45, '2023_03_11_131019_create_listingowners_table', 28),
(46, '2023_03_11_224740_create_expensecategories_table', 29),
(47, '2023_03_11_232209_create_expenses_table', 30),
(48, '2023_03_12_193852_create_sales_table', 31),
(50, '2023_03_12_211914_create_saledetails_table', 32),
(51, '2023_03_12_215524_create_salesdetails_table', 33),
(52, '2023_03_13_170309_create_stockchargesdetails_table', 34),
(53, '2023_03_13_170842_create_itemdetails_table', 34),
(54, '2023_03_13_171251_create_stocktransferhistorys_table', 34),
(55, '2023_03_13_180719_create_stocktransferhistories_table', 35),
(56, '2023_04_05_001601_add_transit_and_receive_dates_to_purchases_table', 36);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'users.create', 'web', '2023-03-08 05:40:28', '2023-03-24 06:42:54'),
(3, 'users.store', 'web', '2023-03-08 05:40:28', '2023-03-24 06:42:39'),
(4, 'permissions.destroy', 'web', '2023-03-08 05:40:28', '2023-03-29 06:59:15'),
(7, 'permissions.update', 'web', '2023-03-08 05:40:28', '2023-03-24 06:39:55'),
(8, 'permissions.index', 'web', '2023-03-08 05:40:28', '2023-03-24 06:39:30'),
(10, 'permissions.create', 'web', '2023-03-08 07:32:34', '2023-03-28 06:02:28'),
(11, 'permissions.store', 'web', '2023-03-09 09:55:59', '2023-03-24 06:39:07'),
(13, 'roles.edit', 'web', '2023-03-24 06:52:01', '2023-03-24 06:52:01'),
(14, 'roles.index', 'web', '2023-03-24 06:52:15', '2023-03-24 06:52:15'),
(15, 'users.edit', 'web', '2023-03-24 06:52:43', '2023-03-24 06:52:43'),
(16, 'roles.create', 'web', '2023-03-24 06:53:22', '2023-03-24 06:53:22'),
(17, 'roles.store', 'web', '2023-03-24 07:11:23', '2023-03-24 07:11:23'),
(18, 'roles.destroy', 'web', '2023-03-24 07:11:44', '2023-03-24 07:11:44'),
(19, 'users.index', 'web', '2023-03-24 07:12:02', '2023-03-24 07:12:02'),
(21, 'users.update', 'web', '2023-03-24 07:13:24', '2023-03-24 07:13:24'),
(22, 'roles.update', 'web', '2023-03-27 10:25:53', '2023-03-27 10:25:53'),
(29, 'permissions.edit', 'web', '2023-03-28 06:02:40', '2023-03-28 06:02:40'),
(30, 'account.create', 'web', '2023-03-28 06:03:19', '2023-03-28 06:03:19'),
(31, 'account.index', 'web', '2023-03-28 06:03:38', '2023-03-28 06:03:38'),
(32, 'account.edit', 'web', '2023-03-28 06:03:49', '2023-03-28 06:03:49'),
(33, 'account.delete', 'web', '2023-03-28 06:04:06', '2023-03-28 06:04:06'),
(34, 'brand.create', 'web', '2023-03-28 06:05:28', '2023-03-28 06:05:28'),
(35, 'brand.index', 'web', '2023-03-28 06:05:40', '2023-03-28 06:05:40'),
(36, 'brand.edit', 'web', '2023-03-28 06:05:59', '2023-03-28 06:05:59'),
(37, 'brand.delete', 'web', '2023-03-28 06:06:14', '2023-03-28 06:06:14'),
(38, 'variant.create', 'web', '2023-03-28 06:08:48', '2023-03-28 06:08:48'),
(39, 'variant.index', 'web', '2023-03-28 06:09:04', '2023-03-28 06:09:04'),
(40, 'variant.edit', 'web', '2023-03-28 06:09:25', '2023-03-28 06:09:25'),
(41, 'variant.delete', 'web', '2023-03-28 06:09:38', '2023-03-28 06:09:38'),
(42, 'create_product', 'web', '2023-03-28 06:10:24', '2023-03-28 06:10:24'),
(43, 'product.index', 'web', '2023-03-28 06:10:42', '2023-03-28 06:10:42'),
(44, 'product.edit', 'web', '2023-03-28 06:10:56', '2023-03-28 06:10:56'),
(45, 'product.delete', 'web', '2023-03-28 06:11:08', '2023-03-28 06:11:08'),
(46, 'productitem.create', 'web', '2023-03-28 06:11:25', '2023-03-28 06:11:25'),
(47, 'productitem.index', 'web', '2023-03-28 06:11:39', '2023-03-28 06:11:39'),
(48, 'product_item.edit', 'web', '2023-03-28 06:11:53', '2023-03-28 06:11:53'),
(49, 'product_item.delete', 'web', '2023-03-28 06:13:21', '2023-03-28 06:13:21'),
(50, 'productitem.price', 'web', '2023-03-28 06:13:54', '2023-03-28 06:13:54'),
(51, 'vendor.create', 'web', '2023-03-28 07:12:23', '2023-03-28 07:12:23'),
(52, 'vendor.index', 'web', '2023-03-28 07:12:36', '2023-03-28 07:12:36'),
(53, 'vendor.edit', 'web', '2023-03-28 07:12:47', '2023-03-28 18:25:42'),
(54, 'vendor.delete', 'web', '2023-03-28 07:13:00', '2023-03-28 07:13:00'),
(55, 'purchase.create', 'web', '2023-03-28 07:22:05', '2023-03-28 07:22:05'),
(56, 'purchase.index', 'web', '2023-03-28 07:22:14', '2023-03-28 07:22:14'),
(57, 'purchase.edit', 'web', '2023-03-28 07:22:26', '2023-03-28 07:22:26'),
(58, 'purchase.delete', 'web', '2023-03-28 07:22:39', '2023-03-28 07:22:39'),
(59, 'purchase.show', 'web', '2023-03-28 07:22:51', '2023-03-28 07:22:51'),
(60, 'purchase.print', 'web', '2023-03-28 07:23:35', '2023-03-28 07:23:35'),
(61, 'stock.create', 'web', '2023-03-28 07:23:43', '2023-03-28 07:23:43'),
(62, 'stock.index', 'web', '2023-03-28 07:23:54', '2023-03-28 07:23:54'),
(63, 'stock.edit', 'web', '2023-03-28 07:24:26', '2023-03-28 07:24:26'),
(64, 'stock.list', 'web', '2023-03-28 07:24:34', '2023-03-28 07:24:34'),
(65, 'stock.delete', 'web', '2023-03-28 09:59:16', '2023-03-28 09:59:16'),
(66, 'warehouse.create', 'web', '2023-03-28 10:00:31', '2023-03-28 10:00:31'),
(68, 'warehouse.edit', 'web', '2023-03-28 10:01:03', '2023-03-28 10:01:03'),
(69, 'warehouse.delete', 'web', '2023-03-28 10:01:15', '2023-03-28 10:01:15'),
(70, 'expense.create', 'web', '2023-03-28 10:01:29', '2023-03-28 10:01:29'),
(71, 'expenses.index', 'web', '2023-03-28 10:01:53', '2023-03-28 10:01:53'),
(72, 'expenses.print_expenses', 'web', '2023-03-28 10:02:42', '2023-03-28 10:02:42'),
(73, 'expensecategories.create', 'web', '2023-03-28 10:05:05', '2023-03-28 10:05:05'),
(74, 'expensecategory.index', 'web', '2023-03-28 10:05:26', '2023-03-28 10:05:26'),
(75, 'expensecategories.edit', 'web', '2023-03-28 10:05:45', '2023-03-28 10:05:45'),
(76, 'expensecategories.delete', 'web', '2023-03-28 10:05:59', '2023-03-28 10:05:59'),
(77, 'sale.create', 'web', '2023-03-28 10:06:23', '2023-03-28 10:06:23'),
(78, 'sale.index', 'web', '2023-03-28 10:06:32', '2023-03-28 10:06:32'),
(79, 'sale.edit', 'web', '2023-03-28 10:06:45', '2023-03-28 10:06:45'),
(80, 'sale.delete', 'web', '2023-03-28 10:07:05', '2023-03-28 10:07:05'),
(81, 'sale.show', 'web', '2023-03-28 10:07:15', '2023-03-28 10:07:15'),
(82, 'sale.print', 'web', '2023-03-28 10:07:27', '2023-03-28 10:07:27'),
(83, 'stock.stock_transfer_history', 'web', '2023-03-28 10:07:49', '2023-03-28 10:07:49'),
(84, 'stock.stock_price_detail', 'web', '2023-03-28 10:08:04', '2023-03-28 10:08:04'),
(85, 'reports.item_metrics', 'web', '2023-03-28 10:08:18', '2023-03-28 10:08:18'),
(86, 'reports.low_stock_items', 'web', '2023-03-28 10:08:42', '2023-03-28 10:08:42'),
(87, 'reports.out_stock_items', 'web', '2023-03-28 10:08:52', '2023-03-28 10:08:52'),
(89, 'reports.expected_report', 'web', '2023-03-28 10:09:56', '2023-03-28 10:09:56'),
(90, 'permissions.show', 'web', '2023-03-29 06:59:23', '2023-03-29 06:59:23'),
(91, 'warehouse.index', 'web', '2023-03-29 06:59:44', '2023-03-29 06:59:44'),
(92, 'new permission', 'web', '2023-03-29 10:36:58', '2023-03-29 10:36:58'),
(94, 'SidebarAccount', 'web', '2023-03-30 20:16:28', '2023-03-30 20:16:28'),
(95, 'SidebarBrand', 'web', '2023-03-30 20:18:04', '2023-03-30 20:18:04'),
(96, 'SidebarCategories', 'web', '2023-03-30 20:18:49', '2023-03-30 20:18:49'),
(97, 'SidebarProducts', 'web', '2023-03-30 20:19:44', '2023-03-30 20:19:44'),
(98, 'SidebarSuppliers', 'web', '2023-03-30 20:24:51', '2023-03-30 20:24:51'),
(99, 'SidebarPurchases', 'web', '2023-03-30 20:25:48', '2023-03-30 20:25:48'),
(100, 'SidebarWarehouse', 'web', '2023-03-30 20:26:33', '2023-03-30 20:26:33'),
(101, 'SidebarStockAddTransfer', 'web', '2023-03-30 20:27:28', '2023-03-30 20:27:28'),
(102, 'SidebarExpenses', 'web', '2023-03-30 20:28:18', '2023-03-30 20:28:18'),
(103, 'SidebarSales', 'web', '2023-03-30 20:29:02', '2023-03-30 20:29:02'),
(104, 'SidebarAuthentication', 'web', '2023-03-30 20:29:57', '2023-03-30 20:29:57'),
(105, 'SidebarReports', 'web', '2023-03-30 20:31:03', '2023-03-30 20:31:03'),
(106, 'EditAccount', 'web', '2023-04-06 06:23:29', '2023-04-06 07:04:29'),
(107, 'DeleteAccount', 'web', '2023-04-06 06:26:09', '2023-04-06 07:04:13'),
(108, 'EditBrand', 'web', '2023-04-06 07:08:34', '2023-04-06 07:08:34'),
(109, 'DeleteBrand', 'web', '2023-04-06 07:09:06', '2023-04-06 07:09:06'),
(110, 'EditCategory', 'web', '2023-04-06 07:10:54', '2023-04-06 07:10:54'),
(111, 'DeleteCategory', 'web', '2023-04-06 07:27:29', '2023-04-06 07:27:29'),
(112, 'EditProductProfile', 'web', '2023-04-06 07:31:20', '2023-04-06 07:31:20'),
(113, 'DeleteProductProfile', 'web', '2023-04-06 07:32:30', '2023-04-06 07:32:30'),
(114, 'CreateProductitem', 'web', '2023-04-06 07:33:35', '2023-04-06 07:33:35'),
(115, 'ViewProductitem', 'web', '2023-04-06 07:34:28', '2023-04-06 07:34:28'),
(116, 'EditProductitem', 'web', '2023-04-06 07:36:31', '2023-04-06 07:36:31'),
(117, 'DeleteProductitem', 'web', '2023-04-06 07:37:39', '2023-04-06 07:37:39'),
(118, 'UpdateItemSalePrice', 'web', '2023-04-06 07:40:29', '2023-04-06 07:40:29'),
(119, 'EditVariant', 'web', '2023-04-06 07:44:50', '2023-04-06 07:44:50'),
(120, 'DeleteVariant', 'web', '2023-04-06 07:45:29', '2023-04-06 07:45:29'),
(121, 'EditSupplier', 'web', '2023-04-06 07:47:18', '2023-04-06 07:47:18'),
(122, 'DeleteSupplier', 'web', '2023-04-06 07:47:53', '2023-04-06 07:47:53'),
(123, 'EditPurchaseOrder', 'web', '2023-04-06 07:50:01', '2023-04-06 07:50:01'),
(124, 'DeletePurchaseOrder', 'web', '2023-04-06 07:50:32', '2023-04-06 07:50:32'),
(125, 'ViewPurchaseOrder', 'web', '2023-04-06 07:54:09', '2023-04-06 07:54:09'),
(126, 'PrintPurchaseOrder', 'web', '2023-04-06 07:54:52', '2023-04-06 07:54:52'),
(127, 'EditWarehouse', 'web', '2023-04-06 07:56:11', '2023-04-06 07:56:11'),
(128, 'DeleteWarehouse', 'web', '2023-04-06 07:56:38', '2023-04-06 07:56:38'),
(129, 'InvoiceTransferStock', 'web', '2023-04-06 07:59:19', '2023-04-06 07:59:19'),
(130, 'PrintTransferStock', 'web', '2023-04-06 07:59:57', '2023-04-06 07:59:57'),
(131, 'EditExpenseCategory', 'web', '2023-04-06 08:03:26', '2023-04-06 08:03:26'),
(132, 'DeleteExpenseCategory', 'web', '2023-04-06 08:04:03', '2023-04-06 08:04:03'),
(133, 'SaleShow', 'web', '2023-04-06 08:05:23', '2023-04-06 08:05:23'),
(134, 'EditUser', 'web', '2023-04-06 08:06:46', '2023-04-06 08:06:46'),
(135, 'DeleteUser', 'web', '2023-04-06 08:07:33', '2023-04-06 08:07:33'),
(136, 'EditPermission', 'web', '2023-04-06 08:09:22', '2023-04-06 08:09:22'),
(137, 'DeletePermission', 'web', '2023-04-06 08:10:14', '2023-04-06 08:10:14'),
(138, 'EditRole', 'web', '2023-04-06 08:11:36', '2023-04-06 08:11:36'),
(139, 'DeleteRole', 'web', '2023-04-06 08:12:10', '2023-04-06 08:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productitems`
--

CREATE TABLE `productitems` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `p_id` bigint(20) UNSIGNED NOT NULL,
  `var_id` bigint(20) UNSIGNED NOT NULL,
  `item_serial_no` varchar(30) NOT NULL,
  `item_barcode` varchar(255) DEFAULT NULL,
  `item_barcode_img` varchar(255) NOT NULL,
  `item_sku` varchar(255) NOT NULL,
  `item_asin` varchar(255) NOT NULL,
  `item_img` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productitems`
--

INSERT INTO `productitems` (`item_id`, `p_id`, `var_id`, `item_serial_no`, `item_barcode`, `item_barcode_img`, `item_sku`, `item_asin`, `item_img`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'LB01-1', NULL, 'uploads/Products/barcode/Screen Shot 2023-03-17 at 9.54.50 PM-1679136951.png', 'erere', 'erere', 'uploads/Products/itemimage/Screen Shot 2023-03-17 at 9.54.55 PM-1679136951.png', '2023-03-18 15:55:51', '2023-03-18 15:56:23'),
(2, 2, 1, 'LB01-1', NULL, 'uploads/Products/barcode/White-1679137373.png', '7X-2NZC-NNSG', 'B0B3J1M5SP', 'uploads/Products/itemimage/White-1679137373.jpg', '2023-03-18 16:02:53', '2023-03-18 16:02:53'),
(3, 2, 2, 'LB01-2', NULL, 'uploads/Products/barcode/Pink-1679137373.png', 'YW-SDWZ-OWIP', 'B0BM757RQB', 'uploads/Products/itemimage/Pink-1679137373.jpg', '2023-03-18 16:02:53', '2023-03-18 16:02:53'),
(5, 3, 3, 'LB01-1', NULL, 'uploads/Products/barcode/White-1679149143.png', '7X-2NZC-NNSG', 'B0B3J1M5SP', 'uploads/Products/itemimage/White-1679149146.jpg', '2023-03-18 19:19:07', '2023-03-18 23:24:38'),
(6, 3, 4, 'LB01-2', NULL, 'uploads/Products/barcode/Pink-1679149147.png', 'YW-SDWZ-OWIP', 'B0BM757RQB', 'uploads/Products/itemimage/Pink-1679149147.jpg', '2023-03-18 19:19:07', '2023-03-18 23:24:54'),
(7, 4, 5, 'LB02-1', NULL, 'uploads/Products/barcode/Blue-1679149423.png', '8Z-2WZU-9WK1', 'B0BBR9KR4Z', 'uploads/Products/itemimage/Blue-1679149423.jpg', '2023-03-18 19:23:43', '2023-03-18 23:24:58'),
(8, 4, 4, 'LB02-2', NULL, 'uploads/Products/barcode/Pink-1679149423.png', 'Z9-6N7Y-YYZL', 'B0BBRBNNT4', 'uploads/Products/itemimage/Pink-1679149423.jpg', '2023-03-18 19:23:43', '2023-03-18 23:25:01'),
(9, 5, 6, 'LB03-1', NULL, 'uploads/Products/barcode/Green-1679149693.png', '2Y-MARZ-ZWQA', 'B0BBR5CNQC', 'uploads/Products/itemimage/Green-1679149693.jpg', '2023-03-18 19:28:13', '2023-03-18 23:25:40'),
(10, 5, 7, 'LB03-2', NULL, 'uploads/Products/barcode/Purple-1679149693.png', 'BH-XRDL-UJ5M', 'B0BM78JNL8', 'uploads/Products/itemimage/Purple-1679149693.jpg', '2023-03-18 19:28:13', '2023-03-18 23:25:44'),
(11, 6, 5, 'LB04-1', NULL, 'uploads/Products/barcode/Blue-1679149956.png', 'F6-P5PT-W9UV', 'B0BRGM266P', 'uploads/Products/itemimage/Blue-1679149956.jpg', '2023-03-18 19:32:36', '2023-03-18 23:26:37'),
(12, 6, 4, 'LB04-2', NULL, 'uploads/Products/barcode/Pink-1679149956.png', '0Z-1710-DAN3', 'B0BFQXVYPZ', 'uploads/Products/itemimage/Pink-1679149956.jpg', '2023-03-18 19:32:36', '2023-03-18 23:26:40'),
(13, 7, 8, 'LB05-1', NULL, 'uploads/Products/barcode/Blue-1679150237.png', '2M-042D-LRP2', 'B0BYB1DQ71', 'uploads/Products/itemimage/Blue-1679150237.jpg', '2023-03-18 19:37:17', '2023-03-18 19:37:17'),
(14, 7, 9, 'LB05-2', NULL, 'uploads/Products/barcode/Pink-1679150237.png', 'H3-RJUI-VPPJ', 'B0BYF4X4YB', 'uploads/Products/itemimage/Pink-1679150237.jpg', '2023-03-18 19:37:17', '2023-03-18 19:37:17'),
(21, 9, 10, 'WB01-1', NULL, 'uploads/Products/barcode/Black-1679151926.png', '8B-TA7V-BMGC', 'B0BFQWZ1WL', 'uploads/Products/itemimage/Black-1679151926.jpg', '2023-03-18 20:05:26', '2023-03-18 20:05:26'),
(22, 9, 11, 'WB01-2', NULL, 'uploads/Products/barcode/Pink-1679151926.png', 'BC-CF44-915N', 'B0BFQXGZGD', 'uploads/Products/itemimage/Pink-1679151926.jpg', '2023-03-18 20:05:26', '2023-03-18 20:05:26'),
(23, 9, 12, 'WB01-3', NULL, 'uploads/Products/barcode/Blue-1679151926.png', 'E4-IQTM-J1NZ', 'B0BBRBD1VW', 'uploads/Products/itemimage/Blue-1679151926.jpg', '2023-03-18 20:05:26', '2023-03-18 20:05:26'),
(24, 9, 13, 'WB01-4', NULL, 'uploads/Products/barcode/Green-1679151926.png', 'BX-1EOU-WLQR', 'B0BBR9G8RZ', 'uploads/Products/itemimage/Green-1679151926.jpg', '2023-03-18 20:05:26', '2023-03-18 20:05:26'),
(25, 9, 14, 'WB01-5', NULL, 'uploads/Products/barcode/Dark Pink-1679151926.png', '9M-FQRS-VU3N', 'B0BRBSH5NN', 'uploads/Products/itemimage/Dark Pink-1679151926.jpg', '2023-03-18 20:05:26', '2023-03-18 20:05:26'),
(26, 9, 15, 'WB01-6', NULL, 'uploads/Products/barcode/Navy Blue-1679151926.png', '4M-AJRN-W0NC', 'B0BRBRG8ZB', 'uploads/Products/itemimage/Navy Blue-1679151926.jpg', '2023-03-18 20:05:26', '2023-03-18 20:05:26'),
(27, 10, 16, 'WB02-1', NULL, 'uploads/Products/barcode/Black-1679152558.png', '0M-3S72-HTCZ', 'B0BHQMYQX4', 'uploads/Products/itemimage/Black-1679152558.jpg', '2023-03-18 20:15:58', '2023-03-18 20:15:58'),
(28, 10, 17, 'WB02-2', NULL, 'uploads/Products/barcode/Blue-1679152558.png', 'MW-PSCT-HMQS', 'B0BHQQNLFB', 'uploads/Products/itemimage/Blue-1679152558.jpg', '2023-03-18 20:15:58', '2023-03-18 20:15:58'),
(29, 10, 18, 'WB02-3', NULL, 'uploads/Products/barcode/White-1679152558.png', '4L-7R1X-6TNS', 'B0BHQN8Y98', 'uploads/Products/itemimage/White-1679152558.jpg', '2023-03-18 20:15:58', '2023-03-18 20:15:58'),
(30, 10, 19, 'WB02-4', NULL, 'uploads/Products/barcode/Blue:Black-1679152558.png', 'O8-E9E2-ACM7', 'B0BHQNKWVM', 'uploads/Products/itemimage/Blue:Black-1679152558.jpg', '2023-03-18 20:15:58', '2023-03-18 20:15:58'),
(31, 10, 20, 'WB02-5', NULL, 'uploads/Products/barcode/White:Black-1679152558.png', 'YZ-FI4H-81PO', 'X001P3N303', 'uploads/Products/itemimage/White:Black-1679152558.jpg', '2023-03-18 20:15:58', '2023-03-18 20:15:58'),
(32, 11, 21, 'WB03-1', NULL, 'uploads/Products/barcode/Sky Blue-1679171366.png', 'UJ-ABJU-3CBG', 'B0BT9Q3Q69', 'uploads/Products/itemimage/Sky Blue-1679171367.jpg', '2023-03-19 01:29:27', '2023-03-19 01:29:27'),
(33, 11, 22, 'WB03-2', NULL, 'uploads/Products/barcode/Navy Blue-1679171367.png', 'YR-I83D-17HW', 'B0BT9QZ7JB', 'uploads/Products/itemimage/Navy Blue-1679171367.jpg', '2023-03-19 01:29:27', '2023-03-19 01:29:27'),
(34, 11, 23, 'WB03-3', NULL, 'uploads/Products/barcode/Pink-1679171367.png', 'VM-TGGY-JP58', 'B0BT9QS6VT', 'uploads/Products/itemimage/Pink-1679171367.jpg', '2023-03-19 01:29:27', '2023-03-19 01:29:27'),
(35, 11, 24, 'WB03-4', NULL, 'uploads/Products/barcode/Green-1679171367.png', 'O1-XSTI-XJZ5', 'B0BT9QXSR1', 'uploads/Products/itemimage/Green-1679171367.jpg', '2023-03-19 01:29:27', '2023-03-19 01:29:27'),
(36, 11, 25, 'WB03-5', NULL, 'uploads/Products/barcode/White-1679171367.png', 'UE-8WET-NFR8', 'B0BT9QBNMP', 'uploads/Products/itemimage/White-1679171367.jpg', '2023-03-19 01:29:27', '2023-03-19 01:29:27'),
(37, 12, 26, 'WB04-1', NULL, 'uploads/Products/barcode/Orange:Blue-1679171925.png', 'H5-LG01-AFUY', 'B0BYF8JD6Y', 'uploads/Products/itemimage/Orange:Blue-1679171925.jpg', '2023-03-19 01:38:45', '2023-03-19 01:38:45'),
(38, 12, 27, 'WB04-2', NULL, 'uploads/Products/barcode/Blue:Orange-1679171925.png', '4K-X97W-1OXS', 'B0BYGL82DF', 'uploads/Products/itemimage/Blue:Orange-1679171925.jpg', '2023-03-19 01:38:45', '2023-03-19 01:38:45'),
(39, 12, 28, 'WB04-3', NULL, 'uploads/Products/barcode/Green:Purple-1679171925.png', 'PK-UC80-W0LW', 'B0BYFY5VZG', 'uploads/Products/itemimage/Green:Purple-1679171925.jpg', '2023-03-19 01:38:45', '2023-03-19 01:38:45'),
(40, 12, 29, 'WB04-4', NULL, 'uploads/Products/barcode/Purple:Green-1679171925.png', '8Q-1S2H-4BG2', 'B0BYG3W35J', 'uploads/Products/itemimage/Purple:Green-1679171925.jpg', '2023-03-19 01:38:45', '2023-03-19 01:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(10) UNSIGNED NOT NULL,
  `acc_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_description` longtext DEFAULT NULL,
  `p_status` tinyint(4) NOT NULL,
  `p_units_in_carton` varchar(20) DEFAULT NULL,
  `p_net_weight` varchar(20) DEFAULT NULL,
  `p_gross_weight` varchar(20) DEFAULT NULL,
  `p_alert_qty` int(11) NOT NULL,
  `p_listing_owner` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `acc_id`, `brand_id`, `cat_id`, `p_name`, `p_description`, `p_status`, `p_units_in_carton`, `p_net_weight`, `p_gross_weight`, `p_alert_qty`, `p_listing_owner`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 1, 'Lunch Box (01)', NULL, 1, '24', '720 gram', '24 kg', 100, NULL, '2023-03-18 19:16:11', '2023-03-18 23:20:59'),
(4, 1, 1, 1, 'Lunch Box (02)', NULL, 1, '24', '720 gram', '22 kg', 100, NULL, '2023-03-18 19:21:18', '2023-03-18 23:21:23'),
(5, 1, 1, 1, 'Lunch Box (03)', NULL, 1, '30', '600 gram', '24 kg', 100, NULL, '2023-03-18 19:25:30', '2023-03-18 23:35:08'),
(6, 1, 1, 1, 'Lunch Box (04)', NULL, 1, '36', '720 gram', '30 kg', 100, NULL, '2023-03-18 19:30:26', '2023-03-18 23:21:49'),
(7, 1, 1, 1, 'Lunch Box (05)', NULL, 1, NULL, NULL, NULL, 100, NULL, '2023-03-18 19:34:07', '2023-03-18 23:36:50'),
(9, 1, 1, 2, 'Water Bottle (500ml)', NULL, 1, '25', '300 gram', '20 kg', 100, NULL, '2023-03-18 19:59:35', '2023-03-18 23:37:49'),
(10, 1, 1, 2, 'Water Bottle (1200ml)', NULL, 1, '25', '720 gram', '19 kg', 100, NULL, '2023-03-18 20:07:32', '2023-03-18 23:22:14'),
(11, 1, 1, 2, 'Water Bottle Kids (500ml)', NULL, 1, '25', '300 gram', '10 kg', 100, NULL, '2023-03-18 20:26:30', '2023-03-18 23:22:45'),
(12, 1, 1, 2, 'Water Bottle (2 Liters)', NULL, 1, NULL, '230 gram', NULL, 100, NULL, '2023-03-19 01:32:30', '2023-03-19 11:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_serials`
--

CREATE TABLE `product_serials` (
  `p_serial_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_serial_starts_from` varchar(30) NOT NULL,
  `p_serial_current` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_serials`
--

INSERT INTO `product_serials` (`p_serial_id`, `p_id`, `p_serial_starts_from`, `p_serial_current`, `created_at`, `updated_at`) VALUES
(1, 1, 'LB01-0', 'LB01-3', '2023-03-18 15:54:53', '2023-03-18 15:58:08'),
(2, 2, 'LB01-0', 'LB01-3', '2023-03-18 16:01:25', '2023-03-18 16:01:25'),
(3, 3, 'LB01-0', 'LB01-2', '2023-03-18 19:16:11', '2023-03-18 23:20:59'),
(4, 4, 'LB02-0', 'LB02-2', '2023-03-18 19:21:18', '2023-03-18 23:21:23'),
(5, 5, 'LB03-0', 'LB03-2', '2023-03-18 19:25:30', '2023-03-18 23:35:08'),
(6, 6, 'LB04-0', 'LB04-2', '2023-03-18 19:30:26', '2023-03-18 23:21:49'),
(7, 7, 'LB05-0', 'LB05-2', '2023-03-18 19:34:07', '2023-03-18 23:36:50'),
(8, 8, 'WB01-0', 'WB-6', '2023-03-18 19:41:16', '2023-03-18 19:56:07'),
(9, 9, 'WB01-0', 'WB01-6', '2023-03-18 19:59:35', '2023-03-18 23:37:49'),
(10, 10, 'WB02-0', 'WB02-5', '2023-03-18 20:07:32', '2023-03-18 23:22:14'),
(11, 11, 'WB03-0', 'WB03-5', '2023-03-18 20:26:30', '2023-03-18 23:22:45'),
(12, 12, 'WB04-0', 'WB04-4', '2023-03-19 01:32:30', '2023-03-19 11:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `p_size_id` int(10) UNSIGNED NOT NULL,
  `p_id` bigint(20) UNSIGNED NOT NULL,
  `p_box_size_length` varchar(255) DEFAULT NULL,
  `p_box_size_width` varchar(255) DEFAULT NULL,
  `p_box_size_height` varchar(255) DEFAULT NULL,
  `p_box_size_unit` varchar(255) DEFAULT NULL,
  `p_carton_size_length` varchar(255) DEFAULT NULL,
  `p_carton_size_width` varchar(255) DEFAULT NULL,
  `p_carton_size_height` varchar(255) DEFAULT NULL,
  `p_carton_size_unit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`p_size_id`, `p_id`, `p_box_size_length`, `p_box_size_width`, `p_box_size_height`, `p_box_size_unit`, `p_carton_size_length`, `p_carton_size_width`, `p_carton_size_height`, `p_carton_size_unit`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, '60', '40', '50', 'cm', '2023-03-18 15:54:53', '2023-03-18 15:58:08'),
(2, 2, NULL, NULL, NULL, NULL, '60', '40', '50', 'cm', '2023-03-18 16:01:25', '2023-03-18 16:01:25'),
(3, 3, NULL, NULL, NULL, NULL, '60', '40', '50', 'cm', '2023-03-18 19:16:11', '2023-03-18 23:20:59'),
(4, 4, NULL, NULL, NULL, NULL, '60', '40', '50', 'cm', '2023-03-18 19:21:18', '2023-03-18 23:21:23'),
(5, 5, NULL, NULL, NULL, NULL, '60', '40', '37', 'cm', '2023-03-18 19:25:30', '2023-03-18 23:35:08'),
(6, 6, NULL, NULL, NULL, NULL, '57', '64', '52', 'cm', '2023-03-18 19:30:26', '2023-03-18 23:21:49'),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-18 19:34:07', '2023-03-18 23:36:50'),
(8, 8, '8.2', '8.2', '23.5', 'cm', '43', '42', '26', 'cm', '2023-03-18 19:41:16', '2023-03-18 19:56:07'),
(9, 9, '8.2', '8.2', '23.5', 'cm', '43', '42', '26', 'cm', '2023-03-18 19:59:35', '2023-03-18 23:37:49'),
(10, 10, '10', '10', '37', 'cm', '51.5', '51.5', '38.5', 'cm', '2023-03-18 20:07:32', '2023-03-18 23:22:14'),
(11, 11, NULL, NULL, NULL, NULL, '51.5', '51.5', '38.5', 'cm', '2023-03-18 20:26:30', '2023-03-18 23:22:45'),
(12, 12, NULL, NULL, NULL, NULL, '67', '44', '28', 'cm', '2023-03-19 01:32:30', '2023-03-19 11:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetails`
--

CREATE TABLE `purchasedetails` (
  `pur_detail_id` int(10) UNSIGNED NOT NULL,
  `pur_id` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `item_purchase_price` varchar(255) NOT NULL,
  `units_in_carton` varchar(255) NOT NULL,
  `pur_item_qty` varchar(255) NOT NULL,
  `carton_qty` varchar(255) NOT NULL,
  `sub_total_amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchasedetails`
--

INSERT INTO `purchasedetails` (`pur_detail_id`, `pur_id`, `item_id`, `item_purchase_price`, `units_in_carton`, `pur_item_qty`, `carton_qty`, `sub_total_amount`, `created_at`, `updated_at`) VALUES
(4, '1', '11', '21.4', '24', '5', '0.21', '107.00', NULL, NULL),
(5, '4', '22', '21.4', '24', '48', '2.00', '1027.20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `pur_id` int(10) UNSIGNED NOT NULL,
  `pur_refrence_no` varchar(255) NOT NULL,
  `vend_id` varchar(255) NOT NULL,
  `pur_date` varchar(255) NOT NULL,
  `pur_status` varchar(255) NOT NULL,
  `pur_document` varchar(255) DEFAULT NULL,
  `pur_total_amount` varchar(255) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `alibaba_charges` float DEFAULT NULL,
  `shipping_charges` varchar(255) DEFAULT NULL,
  `miscellaneous_charges` varchar(255) DEFAULT NULL,
  `acc_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transit_date` date DEFAULT NULL,
  `received_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`pur_id`, `pur_refrence_no`, `vend_id`, `pur_date`, `pur_status`, `pur_document`, `pur_total_amount`, `remarks`, `alibaba_charges`, `shipping_charges`, `miscellaneous_charges`, `acc_id`, `created_at`, `updated_at`, `transit_date`, `received_date`) VALUES
(1, '1', '1', '2023-04-06', '4', '', '107.00', 'asasads', 101, '20', '30', 1, '2023-03-20 16:27:13', '2023-04-05 06:00:00', NULL, '2023-04-12'),
(4, '2', '1', '2023-04-06', '3', '', '1027.20', 'Test for', 10, '201', '30', 1, '2023-03-21 09:27:28', '2023-04-05 06:09:41', '2023-04-28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_documents`
--

CREATE TABLE `purchase_documents` (
  `pur_doc_id` int(10) UNSIGNED NOT NULL,
  `pur_id` bigint(20) UNSIGNED NOT NULL,
  `pur_refrence_no` bigint(20) UNSIGNED NOT NULL,
  `pur_document` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_documents`
--

INSERT INTO `purchase_documents` (`pur_doc_id`, `pur_id`, `pur_refrence_no`, `pur_document`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'uploads/orders/Dropdown-1680674400.txt', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2023-03-08 05:42:27', '2023-03-08 05:42:27'),
(2, 'Khurram', 'web', '2023-03-08 05:49:32', '2023-03-24 06:45:11'),
(4, 'amzaccount', 'web', '2023-03-27 11:16:22', '2023-03-27 11:16:22'),
(6, 'Brand', 'web', '2023-03-28 06:06:44', '2023-03-28 06:06:44'),
(7, 'abc123', 'web', '2023-03-28 18:00:40', '2023-03-28 18:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 6),
(1, 7),
(3, 1),
(4, 1),
(7, 1),
(7, 2),
(8, 1),
(10, 1),
(11, 1),
(11, 2),
(13, 1),
(13, 7),
(14, 1),
(15, 1),
(15, 2),
(16, 1),
(17, 1),
(18, 1),
(18, 2),
(19, 1),
(21, 1),
(22, 1),
(22, 2),
(22, 7),
(29, 1),
(31, 2),
(35, 2),
(36, 7),
(94, 1),
(94, 2),
(95, 1),
(95, 2),
(96, 1),
(96, 2),
(97, 1),
(97, 2),
(98, 1),
(98, 2),
(99, 1),
(99, 2),
(100, 1),
(100, 2),
(101, 1),
(101, 2),
(102, 1),
(102, 2),
(103, 1),
(103, 2),
(104, 1),
(105, 1),
(105, 2),
(106, 1),
(106, 2),
(107, 1),
(108, 1),
(108, 2),
(109, 1),
(109, 2),
(110, 1),
(110, 2),
(111, 1),
(111, 2),
(112, 1),
(112, 2),
(113, 1),
(113, 2),
(114, 1),
(114, 2),
(115, 1),
(115, 2),
(116, 1),
(116, 2),
(117, 1),
(117, 2),
(118, 1),
(118, 2),
(119, 1),
(119, 2),
(120, 1),
(120, 2),
(121, 1),
(121, 2),
(122, 1),
(122, 2),
(123, 1),
(123, 2),
(124, 1),
(124, 2),
(125, 1),
(125, 2),
(126, 1),
(126, 2),
(127, 1),
(127, 2),
(128, 1),
(128, 2),
(129, 1),
(129, 2),
(130, 1),
(130, 2),
(131, 1),
(131, 2),
(132, 1),
(132, 2),
(133, 1),
(133, 2),
(134, 1),
(134, 2),
(135, 1),
(135, 2),
(136, 1),
(136, 2),
(137, 1),
(137, 2),
(138, 1),
(138, 2),
(139, 1),
(139, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(10) UNSIGNED NOT NULL,
  `sales_invoice_no` varchar(20) NOT NULL,
  `sales_date` date NOT NULL,
  `wh_id` int(11) NOT NULL,
  `total_sales_amount` double(8,2) NOT NULL,
  `total_profit` double(8,2) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `acc_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `sales_invoice_no`, `sales_date`, `wh_id`, `total_sales_amount`, `total_profit`, `remarks`, `acc_id`, `created_at`, `updated_at`) VALUES
(1, '1', '2023-03-18', 1, 2200.00, 600.00, NULL, 1, '2023-03-19 00:22:56', '2023-03-19 00:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `salesdetails`
--

CREATE TABLE `salesdetails` (
  `sales_detail_id` int(10) UNSIGNED NOT NULL,
  `sales_invoice_no` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sale_price` float NOT NULL,
  `sale_qty` float(8,2) NOT NULL,
  `sale_item_profit` float NOT NULL,
  `sub_total` float(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salesdetails`
--

INSERT INTO `salesdetails` (`sales_detail_id`, `sales_invoice_no`, `item_id`, `sale_price`, `sale_qty`, `sale_item_profit`, `sub_total`, `created_at`, `updated_at`) VALUES
(1, '1', 5, 55, 40.00, 600, 2200.00, '2023-03-19 00:22:56', '2023-03-19 00:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `stockchargesdetails`
--

CREATE TABLE `stockchargesdetails` (
  `s_c_d_id` int(10) UNSIGNED NOT NULL,
  `stock_id` varchar(10) NOT NULL,
  `item_id` varchar(20) NOT NULL,
  `cbm_charges` float NOT NULL,
  `cbm` double(8,2) NOT NULL,
  `shiping_uae` double(8,2) NOT NULL,
  `amazon_fee` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stockchargesdetails`
--

INSERT INTO `stockchargesdetails` (`s_c_d_id`, `stock_id`, `item_id`, `cbm_charges`, `cbm`, `shiping_uae`, `amazon_fee`, `created_at`, `updated_at`) VALUES
(1, '1', '5', 500, 0.25, 125.00, 16.00, '2023-03-18 23:44:53', '2023-03-18 23:44:53'),
(2, '1', '6', 500, 0.25, 125.00, 16.00, '2023-03-18 23:44:53', '2023-03-18 23:44:53'),
(3, '2', '7', 500, 0.25, 125.00, 16.00, '2023-03-19 00:13:41', '2023-03-19 00:13:41'),
(4, '3', '7', 500, 0.25, 125.00, 16.00, '2023-03-19 00:17:16', '2023-03-19 00:17:16'),
(5, '3', '8', 500, 0.25, 125.00, 16.00, '2023-03-19 00:17:16', '2023-03-19 00:17:16'),
(6, '4', '21', 500, 0.10, 50.00, 14.00, '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(7, '4', '23', 500, 0.10, 50.00, 14.00, '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(8, '4', '26', 500, 0.10, 50.00, 14.00, '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(9, '4', '24', 500, 0.10, 50.00, 14.00, '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(10, '5', '29', 500, 0.10, 50.00, 16.00, '2023-03-19 14:11:13', '2023-03-19 14:11:13'),
(11, '5', '30', 500, 0.10, 50.00, 16.00, '2023-03-19 14:11:13', '2023-03-19 14:11:13'),
(12, '5', '31', 500, 0.10, 50.00, 16.00, '2023-03-19 14:11:13', '2023-03-19 14:11:13'),
(13, '6', '27', 500, 0.40, 200.00, 16.00, '2023-03-19 14:15:37', '2023-03-19 14:15:37'),
(14, '7', '31', 500, 0.20, 100.00, 16.00, '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(15, '7', '30', 500, 0.20, 100.00, 16.00, '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(16, '7', '28', 500, 0.10, 50.00, 16.00, '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(17, '7', '29', 500, 0.20, 100.00, 16.00, '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(18, '8', '21', 500, 0.20, 100.00, 14.00, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(19, '8', '22', 500, 0.10, 50.00, 14.00, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(20, '8', '23', 500, 0.20, 100.00, 14.00, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(21, '8', '24', 500, 0.30, 150.00, 14.00, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(22, '8', '25', 500, 0.20, 100.00, 14.00, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(23, '8', '26', 500, 0.30, 150.00, 14.00, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(24, '9', '9', 500, 0.20, 100.00, 16.00, '2023-03-19 14:35:49', '2023-03-19 14:35:49'),
(25, '9', '10', 500, 0.20, 100.00, 16.00, '2023-03-19 14:35:49', '2023-03-19 14:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `stockdetails`
--

CREATE TABLE `stockdetails` (
  `stock_detail_id` int(10) UNSIGNED NOT NULL,
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `wh_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `stock_qty` varchar(255) NOT NULL,
  `total_cost` double(8,2) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stockdetails`
--

INSERT INTO `stockdetails` (`stock_detail_id`, `stock_id`, `wh_id`, `item_id`, `stock_qty`, `total_cost`, `acc_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '5', '8', 192.00, 1, '2023-03-18 23:44:53', '2023-03-19 00:22:56'),
(2, 1, 1, '6', '48', 1152.00, 1, '2023-03-18 23:44:53', '2023-03-18 23:44:53'),
(3, 2, 2, '7', '24', 624.00, 1, '2023-03-19 00:13:41', '2023-03-19 00:13:41'),
(4, 3, 1, '7', '48', 1152.00, 1, '2023-03-19 00:17:16', '2023-03-19 00:17:16'),
(5, 3, 1, '8', '72', 1656.00, 1, '2023-03-19 00:17:16', '2023-03-19 00:17:16'),
(6, 4, 2, '21', '25', 325.00, 1, '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(7, 4, 2, '23', '25', 325.00, 1, '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(8, 4, 2, '26', '25', 325.00, 1, '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(9, 4, 2, '24', '25', 325.00, 1, '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(10, 5, 2, '29', '25', 700.00, 1, '2023-03-19 14:11:13', '2023-03-19 14:11:13'),
(11, 5, 2, '30', '50', 1350.00, 1, '2023-03-19 14:11:13', '2023-03-19 14:11:13'),
(12, 5, 2, '31', '25', 700.00, 1, '2023-03-19 14:11:13', '2023-03-19 14:11:13'),
(13, 6, 1, '27', '100', 2800.00, 1, '2023-03-19 14:15:37', '2023-03-19 14:15:37'),
(14, 7, 1, '31', '50', 1400.00, 1, '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(15, 7, 1, '30', '50', 1400.00, 1, '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(16, 7, 1, '28', '25', 700.00, 1, '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(17, 7, 1, '29', '50', 1400.00, 1, '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(18, 8, 1, '21', '50', 650.00, 1, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(19, 8, 1, '22', '25', 325.00, 1, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(20, 8, 1, '23', '50', 650.00, 1, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(21, 8, 1, '24', '75', 975.00, 1, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(22, 8, 1, '25', '50', 650.00, 1, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(23, 8, 1, '26', '75', 975.00, 1, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(24, 9, 1, '9', '60', 1920.00, 1, '2023-03-19 14:35:49', '2023-03-19 14:35:49'),
(25, 9, 1, '10', '60', 1920.00, 1, '2023-03-19 14:35:49', '2023-03-19 14:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(10) UNSIGNED NOT NULL,
  `stock_refrence_no` varchar(255) NOT NULL,
  `stock_entry_date` date NOT NULL,
  `acc_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `stock_refrence_no`, `stock_entry_date`, `acc_id`, `created_at`, `updated_at`) VALUES
(1, '1', '2023-03-18', 1, '2023-03-18 23:44:53', '2023-03-18 23:44:53'),
(2, '2', '2023-03-18', 1, '2023-03-19 00:13:41', '2023-03-19 00:13:41'),
(3, '3', '2023-03-18', 1, '2023-03-19 00:17:16', '2023-03-19 00:17:16'),
(4, '4', '2023-03-19', 1, '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(5, '5', '2023-03-19', 1, '2023-03-19 14:11:13', '2023-03-19 14:11:13'),
(6, '6', '2023-03-19', 1, '2023-03-19 14:15:37', '2023-03-19 14:15:37'),
(7, '7', '2023-03-19', 1, '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(8, '8', '2023-03-19', 1, '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(9, '9', '2023-03-19', 1, '2023-03-19 14:35:49', '2023-03-19 14:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `stocktransferhistories`
--

CREATE TABLE `stocktransferhistories` (
  `s_t_h_id` int(10) UNSIGNED NOT NULL,
  `stock_id` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `wh_id_from` varchar(255) DEFAULT NULL,
  `wh_id_to` varchar(255) NOT NULL,
  `stock_transfer_qty` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocktransferhistories`
--

INSERT INTO `stocktransferhistories` (`s_t_h_id`, `stock_id`, `item_id`, `wh_id_from`, `wh_id_to`, `stock_transfer_qty`, `type`, `created_at`, `updated_at`) VALUES
(1, '1', '5', '', '1', '48', '1', '2023-03-18 23:44:53', '2023-03-18 23:44:53'),
(2, '1', '6', '', '1', '48', '1', '2023-03-18 23:44:53', '2023-03-18 23:44:53'),
(3, '2', '7', '', '2', '24', '1', '2023-03-19 00:13:41', '2023-03-19 00:13:41'),
(4, '3', '7', '', '1', '48', '1', '2023-03-19 00:17:16', '2023-03-19 00:17:16'),
(5, '3', '8', '', '1', '72', '1', '2023-03-19 00:17:16', '2023-03-19 00:17:16'),
(6, '0', '5', '1', '', '40', '3', '2023-03-19 00:22:56', '2023-03-19 00:22:56'),
(7, '4', '21', '', '2', '25', '1', '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(8, '4', '23', '', '2', '25', '1', '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(9, '4', '26', '', '2', '25', '1', '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(10, '4', '24', '', '2', '25', '1', '2023-03-19 14:07:42', '2023-03-19 14:07:42'),
(11, '5', '29', '', '2', '25', '1', '2023-03-19 14:11:13', '2023-03-19 14:11:13'),
(12, '5', '30', '', '2', '50', '1', '2023-03-19 14:11:13', '2023-03-19 14:11:13'),
(13, '5', '31', '', '2', '25', '1', '2023-03-19 14:11:13', '2023-03-19 14:11:13'),
(14, '6', '27', '', '1', '100', '1', '2023-03-19 14:15:37', '2023-03-19 14:15:37'),
(15, '7', '31', '', '1', '50', '1', '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(16, '7', '30', '', '1', '50', '1', '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(17, '7', '28', '', '1', '25', '1', '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(18, '7', '29', '', '1', '50', '1', '2023-03-19 14:23:36', '2023-03-19 14:23:36'),
(19, '8', '21', '', '1', '50', '1', '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(20, '8', '22', '', '1', '25', '1', '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(21, '8', '23', '', '1', '50', '1', '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(22, '8', '24', '', '1', '75', '1', '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(23, '8', '25', '', '1', '50', '1', '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(24, '8', '26', '', '1', '75', '1', '2023-03-19 14:30:36', '2023-03-19 14:30:36'),
(25, '9', '9', '', '1', '60', '1', '2023-03-19 14:35:49', '2023-03-19 14:35:49'),
(26, '9', '10', '', '1', '60', '1', '2023-03-19 14:35:49', '2023-03-19 14:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `acc_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Khurram', 'knaeemj@gmail.com', NULL, '$2y$10$.MhbuK.MHA6LPdxAl/Slw.sDxhCvaJ70N.UZc4sdXMDVt6R3PRyti', 1, NULL, '2023-02-27 05:06:41', '2023-03-29 10:41:24'),
(2, 'J&Y', 'J&Y@gmail.com', NULL, '$2y$10$R/h5itnjs4XgCVZk25rY9OXaOrBVV0AgBMlnj3vOC2mTJ6mT6reUe', 4, NULL, '2023-03-08 05:42:27', '2023-03-18 04:19:40'),
(8, 'hammad', 'hammad123@gmail.com', NULL, '$2y$10$MZOAhSczzY0wGUPiGkU9lOdekW/yK5I767Es2XTpzGGpmOsrUe1UG', 1, NULL, '2023-03-24 06:57:29', '2023-03-24 06:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `var_id` int(10) UNSIGNED NOT NULL,
  `var_color` varchar(255) DEFAULT NULL,
  `var_size` varchar(255) DEFAULT NULL,
  `var_material` varchar(255) DEFAULT NULL,
  `var_weight` varchar(255) DEFAULT NULL,
  `acc_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`var_id`, `var_color`, `var_size`, `var_material`, `var_weight`, `acc_id`, `created_at`, `updated_at`) VALUES
(3, 'White', NULL, 'Stainless Steel', NULL, 1, '2023-03-18 19:16:38', '2023-03-18 19:16:38'),
(4, 'Pink', NULL, 'Stainless Steel', NULL, 1, '2023-03-18 19:16:55', '2023-03-18 19:16:55'),
(5, 'Blue', NULL, 'Stainless Steel', NULL, 1, '2023-03-18 19:21:42', '2023-03-18 19:21:42'),
(6, 'Green', '720ml', 'Stainless Steel', NULL, 1, '2023-03-18 19:25:58', '2023-03-18 19:25:58'),
(7, 'Purple', '720ml', 'Stainless Steel', NULL, 1, '2023-03-18 19:26:23', '2023-03-18 19:26:23'),
(8, 'Blue', NULL, 'Plastic', NULL, 1, '2023-03-18 19:34:44', '2023-03-18 19:34:44'),
(9, 'Pink', NULL, 'Plastic', NULL, 1, '2023-03-18 19:34:52', '2023-03-18 19:34:52'),
(10, 'Black', '500ml', 'Stainless Steel', NULL, 1, '2023-03-18 19:42:44', '2023-03-18 23:27:24'),
(11, 'Pink', '500ml', 'Stainless Steel', NULL, 1, '2023-03-18 19:42:58', '2023-03-18 23:27:32'),
(12, 'Blue', '500ml', 'Stainless Steel', NULL, 1, '2023-03-18 19:43:10', '2023-03-18 23:27:37'),
(13, 'Green', '500ml', 'Stainless Steel', NULL, 1, '2023-03-18 19:43:30', '2023-03-18 23:27:43'),
(14, 'Dark Pink', '500ml', 'Stainless Steel', NULL, 1, '2023-03-18 19:43:46', '2023-03-18 23:27:53'),
(15, 'Navy Blue', '500ml', 'Stainless Steel', NULL, 1, '2023-03-18 19:44:06', '2023-03-18 23:28:23'),
(16, 'Black', '1200ml', 'Stainless Steel', NULL, 1, '2023-03-18 20:08:13', '2023-03-18 23:29:12'),
(17, 'Blue', '1200ml', 'Stainless Steel', NULL, 1, '2023-03-18 20:08:28', '2023-03-18 23:29:21'),
(18, 'White', '1200ml', 'Stainless Steel', NULL, 1, '2023-03-18 20:08:44', '2023-03-18 23:29:29'),
(19, 'Blue/Black', '1200ml', 'Stainless Steel', NULL, 1, '2023-03-18 20:10:46', '2023-03-18 23:29:35'),
(20, 'White/Black', '1200ml', 'Stainless Steel', NULL, 1, '2023-03-18 20:11:19', '2023-03-18 23:29:43'),
(21, 'Sky Blue (Kids)', '500ml', 'Stainless Steel', NULL, 1, '2023-03-18 20:28:11', '2023-03-18 23:30:02'),
(22, 'Navy Blue (Kids)', '500ml', 'Stainless Steel', NULL, 1, '2023-03-18 20:28:43', '2023-03-18 23:30:14'),
(23, 'Pink (Kids)', '500ml', 'Stainless Steel', NULL, 1, '2023-03-18 20:30:19', '2023-03-18 23:30:25'),
(24, 'Green (Kids)', '500ml', 'Stainless Steel', NULL, 1, '2023-03-18 20:30:50', '2023-03-18 23:30:30'),
(25, 'White (Kids)', '500ml', 'Stainless Steel', NULL, 1, '2023-03-18 20:31:16', '2023-03-18 23:30:35'),
(26, 'Orange/Blue', '64oz', 'Plastic', NULL, 1, '2023-03-19 01:33:59', '2023-03-19 01:33:59'),
(27, 'Blue/Orange', '64oz', 'Plastic', NULL, 1, '2023-03-19 01:34:18', '2023-03-19 01:34:18'),
(28, 'Green/Purple', '64oz', 'Plastic', NULL, 1, '2023-03-19 01:34:40', '2023-03-19 01:34:40'),
(29, 'Purple/Green', '64oz', 'Plastic', NULL, 1, '2023-03-19 01:34:56', '2023-03-19 01:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vend_id` int(10) UNSIGNED NOT NULL,
  `vend_name` varchar(100) NOT NULL,
  `vend_city` varchar(255) NOT NULL,
  `vend_mobile` varchar(255) DEFAULT NULL,
  `vend_profile` varchar(255) DEFAULT NULL,
  `p_id` varchar(255) DEFAULT NULL,
  `acc_id` int(11) NOT NULL,
  `vend_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vend_id`, `vend_name`, `vend_city`, `vend_mobile`, `vend_profile`, `p_id`, `acc_id`, `vend_status`, `created_at`, `updated_at`) VALUES
(1, 'Henan Yeway International Trading Co., Ltd.', 'Henan, China', NULL, 'www.yewaygroup.en.alibaba.com', '11', 1, 1, '2023-03-19 01:05:23', '2023-03-19 01:05:23'),
(2, 'Dongguan Huixie Hardware Plastic Products Co., Ltd.', 'Guangdong, China', NULL, 'https://dghuixie88.en.alibaba.com/', '3', 1, 1, '2023-03-19 12:28:00', '2023-03-19 12:28:00'),
(3, 'Yongkang Okedi Trading Co., Ltd.', 'Zhejiang, China', NULL, 'https://olerd.en.alibaba.com', '10', 1, 1, '2023-03-19 12:28:53', '2023-03-19 12:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `wh_id` int(10) UNSIGNED NOT NULL,
  `wh_title` varchar(255) NOT NULL,
  `wh_contactperson` varchar(255) DEFAULT NULL,
  `wh_contactnumber` varchar(255) DEFAULT NULL,
  `wh_location` varchar(255) NOT NULL,
  `wh_status` tinyint(4) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`wh_id`, `wh_title`, `wh_contactperson`, `wh_contactnumber`, `wh_location`, `wh_status`, `acc_id`, `created_at`, `updated_at`) VALUES
(1, 'Amazon', NULL, NULL, 'Dubai', 1, 1, '2023-03-18 23:40:26', '2023-03-18 23:40:26'),
(2, 'Jamal (Warehouse)', 'Syed Jamal Shah', NULL, 'Sharjah', 1, 1, '2023-03-18 23:40:35', '2023-03-18 23:40:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `expensecategories`
--
ALTER TABLE `expensecategories`
  ADD PRIMARY KEY (`exp_cat_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`exp_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `itemdetails`
--
ALTER TABLE `itemdetails`
  ADD PRIMARY KEY (`item_detail_id`);

--
-- Indexes for table `listingowners`
--
ALTER TABLE `listingowners`
  ADD PRIMARY KEY (`list_owner_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `productitems`
--
ALTER TABLE `productitems`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `product_serials`
--
ALTER TABLE `product_serials`
  ADD PRIMARY KEY (`p_serial_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`p_size_id`);

--
-- Indexes for table `purchasedetails`
--
ALTER TABLE `purchasedetails`
  ADD PRIMARY KEY (`pur_detail_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`pur_id`);

--
-- Indexes for table `purchase_documents`
--
ALTER TABLE `purchase_documents`
  ADD PRIMARY KEY (`pur_doc_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `salesdetails`
--
ALTER TABLE `salesdetails`
  ADD PRIMARY KEY (`sales_detail_id`);

--
-- Indexes for table `stockchargesdetails`
--
ALTER TABLE `stockchargesdetails`
  ADD PRIMARY KEY (`s_c_d_id`);

--
-- Indexes for table `stockdetails`
--
ALTER TABLE `stockdetails`
  ADD PRIMARY KEY (`stock_detail_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `stocktransferhistories`
--
ALTER TABLE `stocktransferhistories`
  ADD PRIMARY KEY (`s_t_h_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`var_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vend_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`wh_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `acc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expensecategories`
--
ALTER TABLE `expensecategories`
  MODIFY `exp_cat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `exp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itemdetails`
--
ALTER TABLE `itemdetails`
  MODIFY `item_detail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `listingowners`
--
ALTER TABLE `listingowners`
  MODIFY `list_owner_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productitems`
--
ALTER TABLE `productitems`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_serials`
--
ALTER TABLE `product_serials`
  MODIFY `p_serial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `p_size_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchasedetails`
--
ALTER TABLE `purchasedetails`
  MODIFY `pur_detail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `pur_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_documents`
--
ALTER TABLE `purchase_documents`
  MODIFY `pur_doc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salesdetails`
--
ALTER TABLE `salesdetails`
  MODIFY `sales_detail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stockchargesdetails`
--
ALTER TABLE `stockchargesdetails`
  MODIFY `s_c_d_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `stockdetails`
--
ALTER TABLE `stockdetails`
  MODIFY `stock_detail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stocktransferhistories`
--
ALTER TABLE `stocktransferhistories`
  MODIFY `s_t_h_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `var_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vend_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `wh_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
