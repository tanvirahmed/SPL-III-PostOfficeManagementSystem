-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2017 at 07:15 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `post_office_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `post_code` int(10) DEFAULT NULL,
  `manager` int(11) DEFAULT NULL,
  `zilla` varchar(100) NOT NULL,
  `llong` varchar(50) CHARACTER SET utf16 DEFAULT NULL,
  `lat` varchar(50) CHARACTER SET utf16 DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `upzilla` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `post_code`, `manager`, `zilla`, `llong`, `lat`, `district`, `upzilla`, `created_at`, `updated_at`) VALUES
(10, 'fghdddd', 675656, NULL, 'sdg', 'g', 'dg', NULL, 'hohih', '2017-12-19 15:52:35', '2017-12-20 16:03:18'),
(6, 'Chittagong', 78, NULL, 'Chittagong', '91.815536', '789jj', NULL, 'lk', '2017-12-18 13:20:29', '2017-12-20 16:04:38'),
(5, 'Mymensingh', 2000, NULL, 'Mymensingh', '90.3984', '24.7434', NULL, 'Mymensingh', '2017-12-18 13:20:29', '2017-12-18 07:39:27'),
(4, 'Dhaka', 1000, NULL, 'Dhaka', '90.399452', '23.777176', NULL, 'Dhaka', '2017-12-18 13:20:29', NULL),
(7, 'Sylhet', 4000, NULL, 'Sylhet', '91.880722', '24.886436', NULL, 'Sylhet', '2017-12-18 13:20:29', NULL),
(8, 'Khulna', 5000, NULL, 'Khulna', '89.56439', '22.80979', NULL, 'Khulna', '2017-12-18 13:20:29', NULL),
(9, 'Rajshahi', 6000, NULL, 'Rajshahi', '89.249298', '24.006355', NULL, 'Rajshahi', '2017-12-18 13:28:25', NULL),
(11, 'fghdddd', 34, NULL, 'sdg', '2321', '23', NULL, 'fg', '2017-12-19 15:53:18', NULL),
(14, 'gcbn', 435, NULL, 'gdn', 'gn', 'gn', NULL, 'gn', '2017-12-20 15:55:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `route` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT 'fa fa-square-o',
  `parent` int(2) NOT NULL DEFAULT '0',
  `admin_only` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `route`, `icon`, `parent`, `admin_only`) VALUES
(1, 'Home', 'home', 'fa fa-home', 0, 0),
(14, 'Money Order', 'moneyOrders', 'fa fa-square-o', 0, 0),
(13, 'Parcel', 'parcels', 'fa fa-square-o', 0, 0),
(12, 'Branch Manager', 'managers', 'fa fa-user', 0, 1),
(11, 'Branch', 'branches', 'fa fa-square-o', 0, 1),
(16, 'Settings', 'settings', 'fa fa-gear', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moneyorder`
--

CREATE TABLE `moneyorder` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(155) DEFAULT NULL,
  `sender_phone_number` varchar(15) DEFAULT NULL,
  `receiver_name` varchar(155) DEFAULT NULL,
  `receiver_phone_number` varchar(15) DEFAULT NULL,
  `source_post_office` int(11) NOT NULL DEFAULT '0',
  `destination_post_office` int(11) NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `cost` float NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `pin_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mone_order_status`
--

CREATE TABLE `mone_order_status` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mone_order_status`
--

INSERT INTO `mone_order_status` (`id`, `title`) VALUES
(1, 'Recieved'),
(2, 'Delivered'),
(3, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `parcel`
--

CREATE TABLE `parcel` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(155) DEFAULT NULL,
  `sender_mail` varchar(255) DEFAULT NULL,
  `sender_phone` varchar(20) DEFAULT NULL,
  `receiver_phone` varchar(20) DEFAULT NULL,
  `receiver_name` varchar(155) DEFAULT NULL,
  `receiver_address` varchar(255) DEFAULT NULL,
  `source_post_office` int(11) NOT NULL DEFAULT '0',
  `current_post_office` int(11) NOT NULL DEFAULT '0',
  `next_post_office` int(11) NOT NULL DEFAULT '0',
  `destination_post_office` int(11) NOT NULL DEFAULT '0',
  `weight` float NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `type` int(1) NOT NULL DEFAULT '1',
  `pin` varchar(50) DEFAULT NULL,
  `tracking_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parcel`
--

INSERT INTO `parcel` (`id`, `sender_name`, `sender_mail`, `sender_phone`, `receiver_phone`, `receiver_name`, `receiver_address`, `source_post_office`, `current_post_office`, `next_post_office`, `destination_post_office`, `weight`, `price`, `status`, `type`, `pin`, `tracking_id`, `created_at`, `updated_at`, `created_by`) VALUES
(22, 'Abdur', NULL, '01911949575', '01515240965', 'Mim', 'aaaabsbb', 7, 0, 0, 6, 5000, 1, 0, 2, '1234567', '30zP22', '2017-12-20 05:20:34', '2017-12-20 16:07:40', 1),
(21, 'abc', NULL, '01911949575', '01515240965', 'Julfikar', 'aaaabsbb', 7, 0, 0, 11, 4455, 2, 0, 1, '123456', '30Yk6n', '2017-12-20 05:19:36', '2017-12-20 16:14:56', 1),
(20, 'Saju Ahmed', NULL, '019111111134', '01913344444444', 'Limon Mondol', 'Rajpara', 5, 0, 0, 8, 200, 10, 0, 1, '123456', '20jL0b', '2017-12-18 17:23:47', NULL, 9),
(19, 'Tarif Ahmed', NULL, '019111111111', '01922222222', 'Kamrul Amin', 'purbadhala', 7, 0, 0, 6, 100, 10, 0, 1, '123456', '19ga6Q', '2017-12-18 17:23:47', NULL, 9),
(18, 'Hasib', NULL, '01911949575', '01521109488', 'Sagor', 'hhihilo', 5, 0, 0, 9, 100, 10, 0, 1, '123456', '18Zwbi', '2017-12-18 17:03:01', NULL, 1),
(17, 'jjj', NULL, '01911949575', '53563653653', 'kkk', 'jgjhg', 6, 0, 0, 8, 1000, 20, 0, 2, '123456', '17DW6d', '2017-12-18 14:11:15', NULL, 1),
(16, 'ggg', NULL, '01911949575', '01515240965', 'hhh', 'ghkhbk', 4, 0, 0, 6, 100, 10, 0, 2, '123456', '16Qr3r', '2017-12-18 14:10:05', NULL, 1),
(15, 'eee', NULL, '01611444444', '01611555555', 'fff', 'hhuhu', 5, 6, 0, 7, 300, 30, 2, 1, '123456', '3VMka', '2017-12-18 13:35:27', '2017-12-18 10:51:16', 1),
(14, 'ccc', NULL, '01611222222', '01611333333', 'ddd', 'gkgg', 4, 8, 0, 8, 200, 20, 2, 1, '123456', '2DZ3R', '2017-12-18 13:35:27', '2017-12-18 07:59:25', 1),
(13, 'aaa', NULL, '01611666666', '0162111111', 'bbb', 'hfhtgf', 6, 4, 5, 9, 100, 10, 2, 1, '123456', '16M1mW', '2017-12-18 13:35:27', '2017-12-19 11:03:44', 1),
(23, 'sfrgrf', NULL, '123456', '46464767', 'sgsfg', 'sgsf', 6, 0, 0, 8, 123, 10, 0, 1, '212323', '23zDS4', '2017-12-20 15:54:07', NULL, 1),
(24, 'Amit', NULL, '01911949575', '01515240965', 'Amed', 'ljljl;', 6, 0, 0, 9, 10, 1, 0, 1, '123456', '24gyo5', '2017-12-20 16:48:22', NULL, 1),
(25, 'Abdur', NULL, '01911949575', '01515240965', 'bcd', 'Uttara dhaka', 7, 0, 0, 9, 12, 12, 0, 1, '1234567', '25bECU', '2017-12-20 17:07:30', NULL, 1),
(26, 'Saju', NULL, '01911949575', '01515240965', 'Julfikar', 'Uttara dhaka', 5, 0, 0, 9, 123, 12, 0, 1, '123456', '26Xtds', '2017-12-20 17:37:51', NULL, 1),
(27, 'Hasib', NULL, 'xs', 'sx', 'Mim', 'aaaabsbb', 8, 0, 0, 7, 12, 50, 0, 2, '12345', '271eQf', '2017-12-20 17:44:53', NULL, 1),
(28, 'abc', NULL, '54098597943', '53563653653', 'Arif', 'aaaabsbb', 6, 0, 0, 9, 100, 100, 0, 1, '12345', '28wHgh', '2017-12-20 17:50:37', NULL, 1),
(29, 'abc', NULL, '01911949575', '01515240965', 'Arif', 'aaaabsbb', 6, 0, 0, 9, 100, 100, 0, 1, '12345', '29JijO', '2017-12-20 17:53:18', NULL, 1),
(30, 'Hasib', NULL, '01911949575', '01515240965', 'bbb', 'Uttara dhaka', 6, 0, 0, 9, 23, 22, 0, 1, '123456', '30VzY2', '2017-12-20 22:16:37', NULL, 1),
(31, 'Hasib', NULL, '01911949575', '01515240965', 'Rahim', 'Rajshahi', 4, 0, 0, 7, 12, 100, 0, 1, '123456', '316Ked', '2017-12-20 22:21:18', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `parcel_status`
--

CREATE TABLE `parcel_status` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parcel_status`
--

INSERT INTO `parcel_status` (`id`, `title`) VALUES
(1, 'Recieved'),
(2, 'Delivered'),
(3, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` int(11) NOT NULL,
  `parcel` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `next` int(11) NOT NULL DEFAULT '0',
  `destination` int(11) NOT NULL DEFAULT '0',
  `current` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `parcel`, `status`, `next`, `destination`, `current`, `created_at`, `updated_at`, `type`) VALUES
(1, 2, 1, 3, 0, 2, '2017-11-03 06:44:11', '2017-11-03 06:44:11', 1),
(2, 1, 2, 2, 0, 2, '2017-11-12 06:42:03', '2017-11-12 06:42:03', 1),
(3, 1, 1, 1, 0, 1, '2017-11-15 06:43:23', '2017-11-15 06:43:23', 1),
(14, 2, 2, 3, 0, 1, '2017-11-15 11:07:54', '2017-11-15 11:07:54', 1),
(7, 1, 1, 2, 0, 1, '2017-11-15 10:21:48', '2017-11-15 10:21:48', 1),
(9, 1, 1, 1, 0, 1, '2017-11-15 10:36:51', '2017-11-15 10:36:51', 1),
(10, 1, 1, 3, 0, 1, '2017-11-15 10:37:04', '2017-11-15 10:37:04', 1),
(15, 4, 1, 1, 0, 2, '2017-11-20 05:16:59', '2017-11-20 05:16:59', 1),
(16, 4, 1, 0, 0, 1, '2017-11-20 05:24:05', '2017-11-20 08:28:34', 1),
(18, 14, 3, 6, 0, 4, '2017-12-18 07:44:47', '2017-12-18 07:44:47', 1),
(19, 14, 3, 6, 0, 4, '2017-12-18 07:45:22', '2017-12-18 07:45:22', 1),
(30, 13, 2, 5, 0, 4, '2017-12-19 11:03:44', '2017-12-19 11:03:44', 1),
(23, 14, 2, 6, 0, 4, '2017-12-18 07:50:38', '2017-12-18 07:50:38', 1),
(24, 14, 2, 9, 0, 6, '2017-12-18 07:52:16', '2017-12-18 07:52:16', 1),
(25, 14, 2, 8, 0, 9, '2017-12-18 07:53:49', '2017-12-18 07:53:49', 1),
(26, 14, 2, 0, 0, 8, '2017-12-18 07:59:25', '2017-12-18 07:59:25', 1),
(27, 13, 2, 8, 0, 6, '2017-12-18 08:00:26', '2017-12-18 08:00:26', 1),
(28, 13, 2, 4, 0, 8, '2017-12-18 08:01:12', '2017-12-18 08:01:12', 1),
(29, 13, 2, 9, 0, 4, '2017-12-18 08:04:03', '2017-12-18 08:04:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(155) DEFAULT NULL,
  `nid` varchar(155) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `branch` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nid`, `dob`, `password`, `branch`, `created_at`, `updated_at`, `email`, `remember_token`, `type`) VALUES
(1, 'Admin', NULL, NULL, '$2y$10$1LzsD960Nl5iCfoYKGsBSeVGKHYMKA8HIXdG7cxfPoS4vLwexW9YO', 0, NULL, '2017-12-17 20:52:34', 'admin@gmail.com', 'jktmpZjEkHk5QFTKaygTf5pOrhzGrAbRl1D7mYEjFThdFcwctVrFDwIAn8N3', 0),
(10, 'Tarif', '444444', '2017-12-04', '$2y$10$VLOsaRVNCMTcm.GKeRoDR.mRihmJveJCUxwRNyAftqwIwGtNtJrvO', 6, '2017-12-18 13:25:38', NULL, 'tarif@gmail.com', 'm30veh19M4LsKeulwU8K8hSBifhjK1kQm1tNuXGUvr2Qiq3RLTDRfB4N8RiC', 2),
(9, 'Real', '333333', '2017-12-03', '$2y$10$2BFyhOt73RWgrD4c2Xufq.71JWIg2WWv9kOnUSd0RZWEjQPgXSeSW', 7, '2017-12-18 13:25:38', '2017-12-19 10:36:16', 'real@gmail.com', 'XpgwsDbNychxRXkJfafKP8piPIcLNgGegQHkGq4sNYZy6dsdRdEEXT8jTcSH', 2),
(7, 'Sagor', '111111', '2017-12-01', '$2y$10$1fJlXLjp6h1bdYQtUw.hE.0Jusmdp7zekY1jD1BV.DnE/2xlfhaPu', 4, '2017-12-18 13:25:38', NULL, 'sagor@gmail.com', 'Gvn02NVoGeMsG7yxne2Ngdy6Dv9GKXv7vWW1Oq9K4azmgQfH9Uf3xH2iIcrw', 2),
(8, 'Touhid', '222222', '2017-12-02', '$2y$10$TJo3j5BqCYmhSP1YkPVuW.bGBqZwmXXGKoy19rVFIJ3HpjbSi0YPm', 8, '2017-12-18 13:25:38', NULL, 'touhid@gmail.com', '8K9EIc3fjDZs7mWGBG5cIqsRWqXthw4JI0CGWdcNW8abhngpsY7YF8c3KTnY', 2),
(11, 'Saju', '555555', '2017-12-05', '$2y$10$5oXHuOzxRgwlj2mYd2nQH.oS4yYCed.gZRBCjZo44LR6jgN5J6fN.', 5, '2017-12-18 13:25:38', NULL, 'saju@gmail.com', 'lBUvuVObevQlHAVin2r9fZ793QAIfqOecb2KENOId4YcEAQcbt0irGTtdKzv', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_`
--

CREATE TABLE `users_` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_`
--

INSERT INTO `users_` (`id`, `name`, `email`, `type`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Khondoker', 'khondokernahid@gmail.com', 0, '$2y$10$aYxUToGk5XmY.HTNpF0ldebLtdVpSoly2dLp/Hbeasw2ybargWZvm', NULL, '2017-10-16 11:46:19', '2017-10-16 11:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_tyoe`
--

CREATE TABLE `user_tyoe` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tyoe`
--

INSERT INTO `user_tyoe` (`id`, `title`) VALUES
(1, 'Admin'),
(2, 'Branch Manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moneyorder`
--
ALTER TABLE `moneyorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mone_order_status`
--
ALTER TABLE `mone_order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel_status`
--
ALTER TABLE `parcel_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_`
--
ALTER TABLE `users_`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tyoe`
--
ALTER TABLE `user_tyoe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moneyorder`
--
ALTER TABLE `moneyorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mone_order_status`
--
ALTER TABLE `mone_order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `parcel_status`
--
ALTER TABLE `parcel_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_`
--
ALTER TABLE `users_`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_tyoe`
--
ALTER TABLE `user_tyoe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
