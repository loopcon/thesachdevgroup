-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2024 at 10:29 AM
-- Server version: 5.7.44-48-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbgvtf5hzhjf2b`
--

-- --------------------------------------------------------

--
-- Table structure for table `b2c_settings`
--

CREATE TABLE `b2c_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `b2c_settings`
--

INSERT INTO `b2c_settings` (`id`, `name`, `label`, `value`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Site Name', 'site_name', 'Hilite Mfg', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(2, 'Phone', 'phone', '9876543210', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(3, 'Address', 'address', NULL, NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(4, 'Contact Email', 'email', 'info@hilitemfg.com', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(5, 'Facebook', 'facebook', 'facebook.com', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(6, 'Twitter', 'twitter', 'twitter.com', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(7, 'Instagram', 'instagram', 'instagram.com', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(8, 'LinkedIn', 'linkedin', 'linkedin.com', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(9, 'Whatsapp', 'whatsapp', '9876543210', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(10, 'Fax', 'fax', '9876543210', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(11, 'Copyright Year', 'copyright_year', '2023', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(16, 'Cookie Consent', 'cookie_concent', 'Hilitemfg', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(17, 'Designed By', 'designed_by', 'loopcon', NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46'),
(18, 'Logo', 'logo', NULL, NULL, '2023-04-22 08:19:51', NULL, '2023-08-16 13:42:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b2c_settings`
--
ALTER TABLE `b2c_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b2c_settings`
--
ALTER TABLE `b2c_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
