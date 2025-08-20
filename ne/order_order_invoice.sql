-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2025 at 10:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_bongo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_order_invoice`
--

CREATE TABLE `order_order_invoice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_invoice_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_order_invoice`
--

INSERT INTO `order_order_invoice` (`id`, `order_id`, `order_invoice_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-08-18 01:08:39', '2025-08-18 01:08:39'),
(2, 2, 1, '2025-08-18 01:08:39', '2025-08-18 01:08:39'),
(3, 3, 2, '2025-08-19 11:59:41', '2025-08-19 11:59:41'),
(4, 4, 2, '2025-08-19 11:59:41', '2025-08-19 11:59:41'),
(5, 5, 2, '2025-08-19 11:59:41', '2025-08-19 11:59:41'),
(6, 6, 2, '2025-08-19 11:59:41', '2025-08-19 11:59:41'),
(7, 7, 3, '2025-08-20 06:50:38', '2025-08-20 06:50:38'),
(8, 8, 4, '2025-08-20 06:58:11', '2025-08-20 06:58:11'),
(9, 9, 4, '2025-08-20 06:58:11', '2025-08-20 06:58:11'),
(10, 10, 4, '2025-08-20 06:58:11', '2025-08-20 06:58:11'),
(11, 11, 4, '2025-08-20 06:58:11', '2025-08-20 06:58:11'),
(12, 12, 4, '2025-08-20 06:58:11', '2025-08-20 06:58:11'),
(13, 13, 4, '2025-08-20 06:58:11', '2025-08-20 06:58:11'),
(14, 14, 4, '2025-08-20 06:58:11', '2025-08-20 06:58:11'),
(15, 15, 5, '2025-08-20 07:05:26', '2025-08-20 07:05:26'),
(16, 16, 5, '2025-08-20 07:05:26', '2025-08-20 07:05:26'),
(17, 17, 5, '2025-08-20 07:05:26', '2025-08-20 07:05:26'),
(18, 18, 5, '2025-08-20 07:05:26', '2025-08-20 07:05:26'),
(19, 19, 5, '2025-08-20 07:05:26', '2025-08-20 07:05:26'),
(20, 20, 6, '2025-08-20 07:07:43', '2025-08-20 07:07:43'),
(21, 21, 7, '2025-08-20 07:10:09', '2025-08-20 07:10:09'),
(22, 22, 7, '2025-08-20 07:10:09', '2025-08-20 07:10:09'),
(23, 23, 8, '2025-08-20 07:11:37', '2025-08-20 07:11:37'),
(24, 24, 9, '2025-08-20 07:13:37', '2025-08-20 07:13:37'),
(25, 25, 10, '2025-08-20 07:20:07', '2025-08-20 07:20:07'),
(26, 26, 10, '2025-08-20 07:20:07', '2025-08-20 07:20:07'),
(27, 27, 10, '2025-08-20 07:20:07', '2025-08-20 07:20:07'),
(28, 28, 10, '2025-08-20 07:20:08', '2025-08-20 07:20:08'),
(29, 29, 10, '2025-08-20 07:20:08', '2025-08-20 07:20:08'),
(30, 30, 10, '2025-08-20 07:20:08', '2025-08-20 07:20:08'),
(31, 31, 10, '2025-08-20 07:20:08', '2025-08-20 07:20:08'),
(32, 32, 10, '2025-08-20 07:20:08', '2025-08-20 07:20:08'),
(33, 33, 10, '2025-08-20 07:20:08', '2025-08-20 07:20:08'),
(34, 34, 10, '2025-08-20 07:20:08', '2025-08-20 07:20:08'),
(35, 35, 11, '2025-08-20 07:25:38', '2025-08-20 07:25:38'),
(36, 36, 11, '2025-08-20 07:25:38', '2025-08-20 07:25:38'),
(37, 37, 12, '2025-08-20 07:32:23', '2025-08-20 07:32:23'),
(38, 38, 13, '2025-08-20 07:39:43', '2025-08-20 07:39:43'),
(39, 39, 13, '2025-08-20 07:39:43', '2025-08-20 07:39:43'),
(40, 40, 13, '2025-08-20 07:39:43', '2025-08-20 07:39:43'),
(41, 41, 14, '2025-08-20 07:42:15', '2025-08-20 07:42:15'),
(42, 42, 15, '2025-08-20 07:44:18', '2025-08-20 07:44:18'),
(43, 43, 16, '2025-08-20 07:51:49', '2025-08-20 07:51:49'),
(44, 44, 16, '2025-08-20 07:51:50', '2025-08-20 07:51:50'),
(45, 45, 16, '2025-08-20 07:51:50', '2025-08-20 07:51:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_order_invoice`
--
ALTER TABLE `order_order_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_order_invoice_order_id_foreign` (`order_id`),
  ADD KEY `order_order_invoice_order_invoice_id_foreign` (`order_invoice_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_order_invoice`
--
ALTER TABLE `order_order_invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_order_invoice`
--
ALTER TABLE `order_order_invoice`
  ADD CONSTRAINT `order_order_invoice_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_order_invoice_order_invoice_id_foreign` FOREIGN KEY (`order_invoice_id`) REFERENCES `order_invoices` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
