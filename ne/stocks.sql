-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2025 at 10:22 AM
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
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_name`, `sku`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 'Bongo Shot 20 EC 400ml', 'PBS6699', 10000, 625.00, '2025-08-18 23:35:25', '2025-08-18 23:35:25'),
(2, 'Bongo Shot 20 EC 100ml', 'PBS8465', 10000, 169.00, '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(3, 'Bongo Shot 20 EC 50ml', 'PBS2410', 10000, 88.00, '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(4, 'Cipro 55 EC 1000ml', 'PC1550', 10000, 995.00, '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(5, 'Cipro 55 EC 500ml', 'PC8935', 10000, 502.00, '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(6, 'Cipro 55 EC 400ml', 'PC1256', 10000, 410.00, '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(7, 'Cipro 55 EC 100ml', 'PC9165', 10000, 112.00, '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(8, 'Cipro 55 EC 50ml', 'PC3712', 10000, 65.00, '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(9, 'IMO WDG 300gm', 'PI3405', 10000, 675.00, '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(10, 'IMO 60 WDG 100gm', 'PI1175', 10000, 230.00, '2025-08-18 23:35:26', '2025-08-18 23:35:26'),
(11, 'IMO 60 WDG 50gm', 'PI1035', 10000, 128.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(12, 'Karmo 75 WP 500gm', 'PK4742', 10000, 445.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(13, 'Karmo 75 WP 100gm', 'PK6933', 10000, 103.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(14, 'Mestra 55 SC 500ml', 'PM5726', 10000, 498.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(15, 'Mestra 55 SC 250ml', 'PM7201', 10000, 255.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(16, 'Mestra 55 SC 100ml', 'PM5881', 10000, 108.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(17, 'Pairaits 70 WG 100gm', 'PP6703', 10000, 575.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(18, 'Pairaits 70 WG 50gm', 'PP7384', 10000, 300.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(19, 'Pairaits 70 WG 15gm', 'PP8465', 10000, 95.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(20, 'Rafayel 18 WP 100gm', 'PR1093', 10000, 60.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(21, 'Strip 500ml', 'PS6397', 10000, 1492.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(22, 'Strip 400ml', 'PS8373', 10000, 1258.00, '2025-08-18 23:35:27', '2025-08-18 23:35:27'),
(23, 'Strip 100ml', 'PS7313', 10000, 344.00, '2025-08-18 23:35:28', '2025-08-18 23:35:28'),
(24, 'Strip 50ml', 'PS1002', 10000, 182.00, '2025-08-18 23:35:28', '2025-08-18 23:35:28'),
(25, 'Bongo Humic Gold Plus 500gm', 'FHGP8614', 10000, 75.00, '2025-08-19 11:56:40', '2025-08-19 11:56:40'),
(26, 'Bongo Mag (Crystal) 1kg', 'FBM3774', 10000, 45.00, '2025-08-20 06:55:23', '2025-08-20 06:55:23'),
(27, 'Tonic (GA-3) 10gm', 'FT7370', 10000, 85.00, '2025-08-20 07:03:08', '2025-08-20 07:03:08'),
(28, 'Bongo Zinc (Chelated) 17gm', 'FBZ1099', 10000, 17.00, '2025-08-20 07:04:15', '2025-08-20 07:04:15'),
(29, 'Bongo Solubor (Solubor Boron) 500gm', 'FSB4692', 10000, 210.00, '2025-08-20 07:36:56', '2025-08-20 07:36:56'),
(30, 'Bongo Boric (Boric Acid) 500gm', 'FBA1649', 10000, 110.00, '2025-08-20 07:36:57', '2025-08-20 07:36:57'),
(31, 'Sakura Gold (PGR) 100ml', 'FSG1035', 10000, 60.00, '2025-08-20 07:50:39', '2025-08-20 07:50:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stocks_sku_unique` (`sku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
