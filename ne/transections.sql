-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2025 at 10:23 AM
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
-- Table structure for table `transections`
--

CREATE TABLE `transections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `pre_stock` int(11) NOT NULL,
  `tran_quant` int(11) NOT NULL,
  `curr_stock` int(11) NOT NULL,
  `sales_value` decimal(10,2) DEFAULT NULL,
  `tran_type` enum('Warehouse Stock In','Warehouse to Sale Point') NOT NULL,
  `status` enum('Stock In','Stock Out','Return') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transections`
--

INSERT INTO `transections` (`id`, `user_id`, `stock_id`, `order_invoice_id`, `product_name`, `sku`, `pre_stock`, `tran_quant`, `curr_stock`, `sales_value`, `tran_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'Bongo Shot 20 EC 400ml', 'PBS6699', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:25', '2025-08-18 23:35:25'),
(2, 1, 2, NULL, 'Bongo Shot 20 EC 100ml', 'PBS8465', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(3, 1, 3, NULL, 'Bongo Shot 20 EC 50ml', 'PBS2410', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(4, 1, 4, NULL, 'Cipro 55 EC 1000ml', 'PC1550', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(5, 1, 5, NULL, 'Cipro 55 EC 500ml', 'PC8935', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(6, 1, 6, NULL, 'Cipro 55 EC 400ml', 'PC1256', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(7, 1, 7, NULL, 'Cipro 55 EC 100ml', 'PC9165', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(8, 1, 8, NULL, 'Cipro 55 EC 50ml', 'PC3712', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(9, 1, 9, NULL, 'IMO WDG 300gm', 'PI3405', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(10, 1, 10, NULL, 'IMO 60 WDG 100gm', 'PI1175', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(11, 1, 11, NULL, 'IMO 60 WDG 50gm', 'PI1035', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(12, 1, 12, NULL, 'Karmo 75 WP 500gm', 'PK4742', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(13, 1, 13, NULL, 'Karmo 75 WP 100gm', 'PK6933', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(14, 1, 14, NULL, 'Mestra 55 SC 500ml', 'PM5726', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(15, 1, 15, NULL, 'Mestra 55 SC 250ml', 'PM7201', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(16, 1, 16, NULL, 'Mestra 55 SC 100ml', 'PM5881', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(17, 1, 17, NULL, 'Pairaits 70 WG 100gm', 'PP6703', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(18, 1, 18, NULL, 'Pairaits 70 WG 50gm', 'PP7384', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(19, 1, 19, NULL, 'Pairaits 70 WG 15gm', 'PP8465', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(20, 1, 20, NULL, 'Rafayel 18 WP 100gm', 'PR1093', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(21, 1, 21, NULL, 'Strip 500ml', 'PS6397', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(22, 1, 22, NULL, 'Strip 400ml', 'PS8373', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:28', '2025-08-18 23:35:28'),
(23, 1, 23, NULL, 'Strip 100ml', 'PS7313', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:28', '2025-08-18 23:35:28'),
(24, 1, 24, NULL, 'Strip 50ml', 'PS1002', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-18 23:35:28', '2025-08-18 23:35:28'),
(25, 1, 25, NULL, 'Bongo Humic Gold Plus 500gm', 'FHGP8614', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-19 11:56:40', '2025-08-19 11:56:40'),
(26, 1, 26, NULL, 'Bongo Mag (Crystal) 1kg', 'FBM3774', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-20 06:55:23', '2025-08-20 06:55:23'),
(27, 1, 27, NULL, 'Tonic (GA-3) 10gm', 'FT7370', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-20 07:03:08', '2025-08-20 07:03:08'),
(28, 1, 28, NULL, 'Bongo Zinc (Chelated) 17gm', 'FBZ1099', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-20 07:04:15', '2025-08-20 07:04:15'),
(29, 1, 29, NULL, 'Bongo Solubor (Solubor Boron) 500gm', 'FSB4692', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-20 07:36:56', '2025-08-20 07:36:56'),
(30, 1, 30, NULL, 'Bongo Boric (Boric Acid) 500gm', 'FBA1649', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-20 07:36:57', '2025-08-20 07:36:57'),
(31, 1, 31, NULL, 'Sakura Gold (PGR) 100ml', 'FSG1035', 0, 10000, 10000, NULL, 'Warehouse Stock In', 'Stock In', '2025-08-20 07:50:39', '2025-08-20 07:50:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transections_user_id_foreign` (`user_id`),
  ADD KEY `transections_stock_id_foreign` (`stock_id`),
  ADD KEY `transections_order_invoice_id_foreign` (`order_invoice_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transections`
--
ALTER TABLE `transections`
  ADD CONSTRAINT `transections_order_invoice_id_foreign` FOREIGN KEY (`order_invoice_id`) REFERENCES `order_invoices` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transections_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transections_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
