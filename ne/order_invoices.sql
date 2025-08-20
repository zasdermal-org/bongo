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
-- Table structure for table `order_invoices`
--

CREATE TABLE `order_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `submitted_by_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_point_id` bigint(20) UNSIGNED NOT NULL,
  `territory_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Requested','Accepted','Assigned','Delivered','Partial Return','Return','Cancel') NOT NULL DEFAULT 'Requested',
  `return_amount` decimal(10,2) DEFAULT NULL,
  `return_note` text DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_invoices`
--

INSERT INTO `order_invoices` (`id`, `user_id`, `submitted_by_user_id`, `updated_by_user_id`, `sale_point_id`, `territory_id`, `invoice_number`, `total_amount`, `status`, `return_amount`, `return_note`, `invoice_date`, `delivery_date`, `created_at`, `updated_at`) VALUES
(1, 36, 1, NULL, 304, 22, 'INV2508189993', 81300.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-01 00:00:00', '2025-07-01 00:00:00'),
(2, 36, 1, NULL, 304, 22, 'INV2508197728', 43800.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-01 00:00:00', '2025-07-01 00:00:00'),
(3, 34, 1, NULL, 290, 21, 'INV2508201692', 69000.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-05 00:00:00', '2025-07-05 00:00:00'),
(4, 36, 1, NULL, 316, 22, 'INV2508202007', 114440.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-05 00:00:00', '2025-07-05 00:00:00'),
(5, 36, 1, NULL, 304, 22, 'INV2508206580', 21990.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-07 00:00:00', '2025-07-07 00:00:00'),
(6, 36, 1, NULL, 304, 22, 'INV2508207070', 29850.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-07 00:00:00', '2025-07-07 00:00:00'),
(7, 24, 1, NULL, 320, 12, 'INV2508205822', 8780.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-07 00:00:00', '2025-07-07 00:00:00'),
(8, 36, 1, NULL, 309, 22, 'INV2508203426', 27000.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-07 00:00:00', '2025-07-07 00:00:00'),
(9, 34, 1, NULL, 290, 21, 'INV2508209774', 10040.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-07 00:00:00', '2025-07-07 00:00:00'),
(10, 34, 1, NULL, 324, 21, 'INV2508208255', 61980.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-08 00:00:00', '2025-07-08 00:00:00'),
(11, 34, 1, NULL, 290, 21, 'INV2508201494', 34450.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-12 00:00:00', '2025-07-12 00:00:00'),
(12, 36, 1, NULL, 304, 22, 'INV2508207365', 2550.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-13 00:00:00', '2025-07-13 00:00:00'),
(13, 24, 1, NULL, 14, 12, 'INV2508207834', 41950.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-14 00:00:00', '2025-07-14 00:00:00'),
(14, 24, 1, NULL, 320, 12, 'INV2508207151', 3600.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-14 00:00:00', '2025-07-14 00:00:00'),
(15, 24, 1, NULL, 238, 12, 'INV2508207760', 1700.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-14 00:00:00', '2025-07-14 00:00:00'),
(16, 21, 1, NULL, 265, 9, 'INV2508204702', 5850.00, 'Requested', NULL, NULL, NULL, NULL, '2025-07-15 00:00:00', '2025-07-15 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_invoices`
--
ALTER TABLE `order_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `order_invoices_user_id_foreign` (`user_id`),
  ADD KEY `order_invoices_submitted_by_user_id_foreign` (`submitted_by_user_id`),
  ADD KEY `order_invoices_updated_by_user_id_foreign` (`updated_by_user_id`),
  ADD KEY `order_invoices_sale_point_id_foreign` (`sale_point_id`),
  ADD KEY `order_invoices_territory_id_foreign` (`territory_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_invoices`
--
ALTER TABLE `order_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_invoices`
--
ALTER TABLE `order_invoices`
  ADD CONSTRAINT `order_invoices_sale_point_id_foreign` FOREIGN KEY (`sale_point_id`) REFERENCES `sale_points` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_invoices_submitted_by_user_id_foreign` FOREIGN KEY (`submitted_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_invoices_territory_id_foreign` FOREIGN KEY (`territory_id`) REFERENCES `territories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_invoices_updated_by_user_id_foreign` FOREIGN KEY (`updated_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
