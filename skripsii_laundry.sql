-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2018 at 01:48 AM
-- Server version: 10.0.35-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsii_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'Karyawan', 'Karyawan Laundry');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL,
  `is_private_key` tinyint(1) NOT NULL,
  `ip_addresses` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `date_created`, `is_private_key`, `ip_addresses`) VALUES
(1, 2, 'f99aecef3d12e02dcbb6260bbdd35189c89e6e73', 2, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_packets`
--

CREATE TABLE `laundry_packets` (
  `laundry_packet_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laundry_packets`
--

INSERT INTO `laundry_packets` (`laundry_packet_id`, `name`, `price`, `created_at`, `update_at`) VALUES
(1, 'Cuci Kering', 13000, '2018-03-31 04:59:23', NULL),
(2, 'Cuci Basah', 10000, '2018-03-31 04:59:37', NULL),
(4, 'Bedcover', 20000, '2018-05-28 09:21:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactions_in`
--

CREATE TABLE `transactions_in` (
  `transaction_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `laundry_packet_id` int(11) NOT NULL DEFAULT '0',
  `status_laundry` tinyint(4) NOT NULL DEFAULT '0',
  `status_pembayaran` tinyint(4) NOT NULL DEFAULT '0',
  `weight_total` float NOT NULL DEFAULT '0',
  `laundry_qty` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `status_pengambilan` tinyint(1) NOT NULL,
  `payment_type` tinyint(4) NOT NULL DEFAULT '0',
  `retreived_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `taken_out_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions_in`
--

INSERT INTO `transactions_in` (`transaction_id`, `employee_id`, `user_id`, `name`, `laundry_packet_id`, `status_laundry`, `status_pembayaran`, `weight_total`, `laundry_qty`, `price`, `status_pengambilan`, `payment_type`, `retreived_at`, `taken_out_at`) VALUES
(29, 1, 7, 'Daniel User', 2, 1, 1, 1, 0, 9000, 0, 2, '2018-04-11 14:32:13', NULL),
(45, 1, 14, 'Sandy Dc', 2, 1, 1, 9, 20, 81000, 0, 2, '2018-05-27 13:27:53', NULL),
(46, 1, 14, 'Sandy Dc', 2, 0, 1, 15, 1, 135000, 0, 2, '2018-05-27 16:30:50', NULL),
(47, 1, 0, 'RUPERT', 2, 0, 1, 5, 5, 50000, 0, 1, '2018-05-27 16:55:23', NULL),
(51, 1, 14, 'Sandy Dc', 2, 0, 1, 10, 5, 90000, 0, 2, '2018-05-28 07:41:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_out`
--

CREATE TABLE `transaction_out` (
  `transaction_out_id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `harga` float NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `harga_total` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_out`
--

INSERT INTO `transaction_out` (`transaction_out_id`, `nama_barang`, `tanggal`, `harga`, `quantity`, `harga_total`) VALUES
(1, 'Sabun', '2018-04-04 00:00:00', 20000, 20, 400000),
(2, 'Sokline', '2018-04-06 00:00:00', 20000, 10, 200000),
(3, 'sabun', '2018-05-10 00:00:00', 50000, 2, 100000),
(4, 'sabun', '2017-12-12 00:00:00', 30000, 3, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `transfers_report`
--

CREATE TABLE `transfers_report` (
  `transfer_report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `examiner_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `transaction_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `processed_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfers_report`
--

INSERT INTO `transfers_report` (`transfer_report_id`, `user_id`, `examiner_id`, `type`, `name`, `transaction_id`, `image`, `status`, `created_on`, `processed_on`) VALUES
(18, 14, 0, 1, 'Sandy Dc', 0, 'uploads/1527401832-Sandy-0.jpg', 1, '2018-05-27 06:17:12', NULL),
(20, 14, 0, 2, 'Sandy Dc', 52, 'uploads/1527493454-Sandy-52.jpeg', 1, '2018-05-28 07:44:14', NULL),
(21, 14, 0, 2, 'Sandy Dc', 57, 'uploads/1527499364-Sandy-57.jpeg', 1, '2018-05-28 09:22:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `balance` float UNSIGNED NOT NULL DEFAULT '0',
  `device_token` text,
  `access_token` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_at`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `address`, `balance`, `device_token`, `access_token`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$CiDYcHF2e7da7yeVqIZFmOetkoRl7eMQ36IJqWYtmALCOrdhArxGW', '', 'admin@admin.com', '', NULL, NULL, 'GEtT7CgBvD.bIJmlJMyio.', '2018-04-06 07:43:29', 1528569420, 1, 'Admin', 'Bejo', 'ADMIN', '0', NULL, 0, NULL, NULL),
(6, '127.0.0.1', 'wibowo', '', NULL, 'wibowo@email.com', NULL, NULL, NULL, NULL, '2018-04-09 10:05:16', NULL, NULL, 'wibowo', 'www', NULL, '12301283', 'abcd', 0, NULL, NULL),
(7, '127.0.0.1', 'tes', '$2y$08$lrMxE1Hu2h0SATpJC/wby.OS1F0DZRpm8ra6ezs2J4xbxsvSzHXAy', NULL, 'tes@gmail.com', NULL, NULL, NULL, NULL, '2018-04-11 14:29:53', NULL, 1, 'Daniel', 'User', NULL, '08912839218', 'Surabaya', 320000, 'dE12J5k0g9Y:APA91bFUquq6nCo4_D4g-MTnAg8hbZ3k6vKDFQWZdam0uTaGU2xwKA-gcUe6kn7lU6UgA9vHK9YX8-QH5QBkfSi4zyCi4DdziDVUAgRS5iARHpO7NgOu64WyTYkGdbCSzhuOj3OqLD5v', 'df1f31599e4441c7334ea87b22eba1b9'),
(12, '120.188.33.121', 'cruser01', '$2y$08$l.GIukUYhZzIIJwUaPoDv.FnQJWct5MN.Xk66Lf321dk8mwnPyktG', NULL, 'rere@rocketmail.com', NULL, NULL, NULL, NULL, '2018-05-14 14:31:42', 1526308385, 1, 'jordan rio', 'c', NULL, '82232010605', 'Uc apartment berkley tower 2326 citraland', 0, NULL, NULL),
(14, '114.4.78.182', 'Sandy', '$2y$08$vlhDuWTMpvarsEDKIYnno.VgB5kPuuid2qjbRGbUqI8E4sFwlSb86', NULL, 'hoe.daniel96@gmail.com', NULL, NULL, NULL, NULL, '2018-05-27 06:14:23', NULL, 1, 'Sandy', 'Dc', NULL, '082232010605', 'Uc apartment berkley tower 2326 citraland', 143000, 'e-YwQLyFC9A:APA91bHvN5wBgsliiwibCWam7N3grTZBR71ScouqPs39f3L5WOOUDgnnyk3YyfPDyScNBhikv5YrieZgEFGd2aCd5a3b8WU6v0s5Y9CHNEWV6JPMMldE5SFqN-w6ZlYZOWu4MFjQm3eH', '900bf93999960e27a7af330e1d9b5c7f'),
(16, '36.73.164.179', 'april', '$2y$08$qCQAEZVQUrFas39th0YZ0.eQgIk9vS8krXqqzN0Kk/muZE2cGMSsi', NULL, 'daniel@student.ciputra.ac.id', NULL, NULL, NULL, NULL, '2018-05-28 09:26:29', NULL, 1, 'dabiek', 't', NULL, '082232010605', 'asdfaw', 0, NULL, NULL),
(21, '36.74.181.51', 'daniel', '', NULL, 'hoe.daniel96@gmail.com', NULL, NULL, NULL, NULL, '2018-06-04 08:31:14', NULL, NULL, 'daniel', 'ho', NULL, '082232010605', 'Carrer De Ferrer', 32000, 'dCOpgF1ljOc:APA91bHAuiwbon12_7FuIpoEBaIpP8WE5YlAL_P5yEOTMf_wC375PLPp2WIDIVJW4c4EIcV-Ggg_Nq4tDoZ6kHqEeqYuB3AEjjr56CLKQn2TOT7pHQlOXLRqEcMW1eSDxOduO8vOpNpR', 'c9385615d1cc1eafd23bf920b13ec7c0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(6, 6, 3),
(7, 7, 2),
(12, 12, 3),
(14, 14, 2),
(16, 16, 3),
(21, 21, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_packets`
--
ALTER TABLE `laundry_packets`
  ADD PRIMARY KEY (`laundry_packet_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions_in`
--
ALTER TABLE `transactions_in`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transaction_out`
--
ALTER TABLE `transaction_out`
  ADD PRIMARY KEY (`transaction_out_id`);

--
-- Indexes for table `transfers_report`
--
ALTER TABLE `transfers_report`
  ADD PRIMARY KEY (`transfer_report_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laundry_packets`
--
ALTER TABLE `laundry_packets`
  MODIFY `laundry_packet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transactions_in`
--
ALTER TABLE `transactions_in`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `transaction_out`
--
ALTER TABLE `transaction_out`
  MODIFY `transaction_out_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transfers_report`
--
ALTER TABLE `transfers_report`
  MODIFY `transfer_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
