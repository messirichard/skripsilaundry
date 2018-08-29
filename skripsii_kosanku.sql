-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2018 at 01:49 AM
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
-- Database: `skripsii_kosanku`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_setting`
--

CREATE TABLE `admin_setting` (
  `id` int(25) NOT NULL,
  `deadline` varchar(255) NOT NULL,
  `indekos_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_setting`
--

INSERT INTO `admin_setting` (`id`, `deadline`, `indekos_id`) VALUES
(1, '1529082000', '6'),
(3, '1528218000', '24'),
(4, '1528131600', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_employee` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_indekos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `id_admin`, `id_user`, `id_indekos`, `created_at`, `updated_at`) VALUES
(6, 8, 44, 0, NULL, NULL),
(7, 8, 45, 0, NULL, NULL),
(8, 8, 46, 0, NULL, NULL),
(9, 8, 48, 0, NULL, NULL),
(10, 8, 54, 0, NULL, NULL),
(11, 8, 55, 0, NULL, NULL),
(12, 8, 56, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `isi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'admin', 'Super Admin'),
(2, 'karyawan', 'Karyawan Kos'),
(3, 'user', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `indekos`
--

CREATE TABLE `indekos` (
  `id_indekos` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `random_id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `fasilitas_umum` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indekos`
--

INSERT INTO `indekos` (`id_indekos`, `id_user`, `random_id`, `nama`, `alamat`, `kota`, `fasilitas_umum`, `foto`, `gender`, `created_at`, `updated_at`) VALUES
(24, 47, '1645136561', 'kos serenity', 'jalan agung suprapto', 'surabaya', 'ac. kompor. piring', 'uploads/1528035768.jpg', 'male', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `id_indekos` int(11) NOT NULL,
  `no_kamar` int(11) NOT NULL DEFAULT '0',
  `lantai_ke` int(11) NOT NULL DEFAULT '0',
  `ukuran` int(11) NOT NULL DEFAULT '0',
  `bulan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL DEFAULT '0',
  `fasilitas` varchar(255) DEFAULT NULL,
  `kwh` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `book_expired_at` timestamp NULL DEFAULT NULL,
  `created_on` int(11) NOT NULL DEFAULT '0',
  `updated_on` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `id_indekos`, `no_kamar`, `lantai_ke`, `ukuran`, `bulan`, `harga`, `fasilitas`, `kwh`, `status`, `book_expired_at`, `created_on`, `updated_on`) VALUES
(16, 0, 101, 1, 30, '', 500000, 'wc', 5, 0, '2018-06-05 20:52:45', 0, 0),
(17, 24, 123, 1, 200, '', 2000000, 'ac tv celana', 145, 0, NULL, 0, 0),
(19, 24, 506, 5, 461616, '', 66463, 'jsjsbfbf', 316494, 0, NULL, 0, 0),
(23, 24, 505, 5, 124, '', 300000, 'nasi', 50, 2, '2018-06-07 18:14:19', 0, 0),
(24, 24, 356, 3, 6555, '', 380000, 'fhfyey\n', 5800, 0, NULL, 0, 0),
(29, 24, 1646, 4925, 59, '12', 19, 'sv', 46, 2, '2018-06-07 18:17:02', 0, 0);

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
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(5, '36.82.96.3', 'Admin@admin.com', 1528116948),
(6, '36.82.96.3', 'Admin@admin.com', 1528116953),
(7, '36.82.96.3', 'Admin@admin.com', 1528116959),
(8, '36.82.96.3', 'admin', 1528117018);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `id_indekos` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `admin_action_time` varchar(255) DEFAULT NULL,
  `msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `transaction_id`, `id_indekos`, `id_kamar`, `id_user`, `amount`, `status`, `payment_type`, `expired_at`, `admin_action_time`, `msg`) VALUES
(7, NULL, 24, 17, 47, 2000000, 'approve', NULL, NULL, '1528192195', ''),
(9, NULL, 24, 19, 47, 66463, 'pending', NULL, NULL, '1528210665', 'avdbf'),
(11, NULL, 24, 24, 47, 380000, 'pending', NULL, NULL, NULL, ''),
(12, NULL, 24, 23, 47, 300000, 'pending', NULL, NULL, NULL, ''),
(13, NULL, 24, 29, 47, 19, 'approve', NULL, NULL, '1528352239', '');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(25) NOT NULL,
  `indekos_id` varchar(255) NOT NULL,
  `reminder_date` varchar(255) NOT NULL,
  `indekos_name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `strtotime` varchar(552) NOT NULL,
  `status` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `indekos_id`, `reminder_date`, `indekos_name`, `user_id`, `strtotime`, `status`) VALUES
(3, '6', '1528909200', '123456', '8', '1528109747', 1),
(4, '6', '1528045200', '123456', '8', '1528110559', 1),
(5, '24', '1528131600', 'kos serenity', '47', '1528113267', 1),
(6, '24', '1528045200', 'kos serenity', '47', '1528114746', 1),
(7, '24', '1528045200', 'kos serenity', '47', '1528124001', 1),
(8, '24', '1528045200', 'kos serenity', '47', '1528131906', 1),
(9, '24', '1528131600', 'kos serenity', '47', '1528132212', 1),
(10, '24', '1528045200', 'kos serenity', '47', '1528133827', 1),
(11, '24', '1528045200', 'kos serenity', '47', '1528137092', 1),
(12, '24', '1527958800', 'kos serenity', '47', '1528138237', 1),
(13, '24', '1527958800', 'kos serenity', '47', '1528138245', 1),
(14, '24', '1528131600', 'kos serenity', '47', '1528178808', 1),
(15, '24', '1528131600', 'kos serenity', '47', '1528193619', 0);

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
  `device_token` text,
  `nik` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `indekos_random` varchar(255) NOT NULL,
  `access_token` text,
  `regid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_at`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `address`, `device_token`, `nik`, `pekerjaan`, `indekos_random`, `access_token`, `regid`) VALUES
(8, '::1', 'administrator', '$2y$08$5qs3nQgoDLtaBe.8E7OJluBhP.Jw2L39bnbDChCqRI.K42LIt2ZzW', NULL, 'admin@admin.com', NULL, NULL, NULL, 'TJ7TvsOy.4.kTxylBRolGO', '2018-05-08 12:05:01', 1528015640, 1, 'Jon', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, '', '8ab0d8f14a00d84b0c4e3649496b49c1', 'emotc0epelw:APA91bHwS469M0QGr96N1VW20ojy56KnXDoBxoJE6cUIjgeH15x8E4FlmUBGIJ8mAJ6zsvn_xcm943uRXqattYPNFBtS9YXqmwbMILq4iaHy3uvxNlH8IobPLAJ_nlXlZR1aT1Gwq12b'),
(23, '114.4.79.20', 'daniel', '$2y$08$2LR2xQ9plb.AWw/7kYu7N.d.IM5qa8QxLLncHVp.awEBIP2UdMli.', NULL, 'asd@gmail.com', NULL, NULL, NULL, NULL, '2018-05-24 16:44:59', NULL, 1, 'danie', 'el', NULL, NULL, NULL, NULL, NULL, NULL, '', '9889dcd85a08ca89f0f801b263fca791', ''),
(24, '114.125.86.171', 'kar', '$2y$08$x0Qb2Ru1ur0LyQmqLgO94OtOmiqax4/x6kHpJ1jNgU1VE/2osz5AS', NULL, 'fkff', NULL, NULL, NULL, NULL, '2018-05-25 01:07:04', NULL, 1, 'kart', 'tileng', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(25, '120.188.93.189', 'cruser', '$2y$08$3XVZfPxl0nuPEzqgUINJeegoyMAAU7D6tYZpzBV8Ddxs4mansReHS', NULL, 'rete@yahdd', NULL, NULL, NULL, NULL, '2018-05-25 01:08:23', NULL, 1, 'jsjss', 'jrjjr', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(26, '120.188.93.189', 'cruser01', '$2y$08$kJAvAfTCytFb6VTjhcLHu.8EvYosoF81Y4UIkXCUXnIIghlkBxo0K', NULL, 'shshs', NULL, NULL, NULL, NULL, '2018-05-25 01:09:02', NULL, 1, 'jeee', 'dhdjbd', NULL, NULL, NULL, NULL, NULL, NULL, '', '40ba6f49a66e2482b208b431b8236fc6', ''),
(27, '114.125.86.171', 'kar', '$2y$08$dZqbIlJuhwWvmwP/tB6m8uCwvo/lC6a8RCZ4iuXjtUUJG9DfYy17W', NULL, 'jdkdmd', NULL, NULL, NULL, NULL, '2018-05-25 01:10:25', NULL, 1, 'kkd', 'kdd', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(28, '114.125.86.171', 'hi', '$2y$08$uyqVCSJs1mhofwqBHjbx6OeinLQ5k/5/gDij5GHL3irZ25U6UXb9i', NULL, 'fff', NULL, NULL, NULL, NULL, '2018-05-25 01:11:20', NULL, 1, 'gggg', 'kdf', NULL, NULL, NULL, NULL, NULL, NULL, '', '7323d7e08b0f17b9ac2f663e770807f2', ''),
(29, '114.125.86.171', 'yuwono', '$2y$08$ktOZFq/QQ16iTcHa2MdAhuTxnzZUhzkOVfw9pIzxNXX/ZyYXIqSSm', NULL, 'yu', NULL, NULL, NULL, NULL, '2018-05-25 01:15:40', NULL, 1, 'yu', 'wono', NULL, NULL, NULL, NULL, NULL, NULL, '', '69a1b4215f28bee91f3d873b22dd2402', ''),
(30, '106.213.220.155', 'bshrgav', '$2y$08$YnD6d7VchGkz8V2TX5WNveTRe6bKZ2qmN/ha9ys8zzymsKC8.Bluy', NULL, 'bk@gmail.com', NULL, NULL, NULL, NULL, '2018-05-26 11:28:58', NULL, 1, 'bhargav', 'gujarati', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(31, '106.213.220.155', 'bhargav', '$2y$08$jOOWTcMenbI7i2yH9xHqbeljVbMudkLpqEwtB0C5qb0KG0KL/E5WO', NULL, 'bk@gmail.com', NULL, NULL, NULL, NULL, '2018-05-26 11:30:01', NULL, 1, 'bhargav', 'gujarati', NULL, NULL, NULL, NULL, NULL, NULL, '', 'b69d572d6b60333cd5b9ee29b45318ea', ''),
(32, '47.247.87.71', 'bpatidar', '$2y$08$5OsUW.ZKR2iUnwCCheRov.NjGH1yDB..BhHlsHPSnJINWaVHzziBC', NULL, 'b@gmail.com', NULL, NULL, NULL, NULL, '2018-05-26 11:34:08', NULL, 1, 'Bhupesh', 'kumat', NULL, NULL, NULL, NULL, NULL, NULL, '', 'fbbf0f7c84ed2369d5fd29ab79f0246b', ''),
(33, '47.247.125.0', 'smtpatidar', '$2y$08$7PFdH31.SqZkoT24cfIv2Og77o7SPHkv108LVR.fpBcX5o6jfFMTO', NULL, 's@gmail.com', NULL, NULL, NULL, NULL, '2018-05-27 07:15:26', NULL, 1, 'sumeet', 'patidar', NULL, NULL, NULL, NULL, NULL, NULL, '', '7220451b8eb611cf4b9acef95c3e8b43', ''),
(34, '114.125.126.123', 'cruser01', '$2y$08$gMLUjcEJJJHsgQbC18wwE.PvmQ8tpFoqENAearEdxm2pofCmflqWu', NULL, 'jordan@gmail.com', NULL, NULL, NULL, NULL, '2018-05-27 10:36:27', NULL, 1, 'jordan rio', 'c', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(35, '114.125.126.123', 'jorudan', '$2y$08$HU0EHe6Gr6Kkz7UbbNTW5e9q3ZcqbarZwAO.f9sOtjtdXf7MVJLXC', NULL, 'dhsksjwhw', NULL, NULL, NULL, NULL, '2018-05-27 10:37:36', NULL, 1, 'xjdbfbff', 'hsjjfkg', NULL, NULL, NULL, NULL, NULL, NULL, '', 'cd35996c5dbce4c8313554c9e476e003', ''),
(36, '114.125.108.231', 'jordan01', '$2y$08$v1Iay8ZMpGXnEvrxfH4fjO7PKmqLier..xm7q7KvpPodZtAqTu9KG', NULL, 'rereshadow@yahoo.co.id', NULL, NULL, NULL, NULL, '2018-05-28 04:57:11', NULL, 1, 'Jordan Rio', 'C', NULL, NULL, NULL, NULL, NULL, NULL, '', 'cebbb116db0258860cad20a0117b6d11', ''),
(37, '114.125.92.236', 'sandydc', '$2y$08$QbwesvfrOGV6vrOCYnV2XulvH8RzBf/jWr0YHPNzvaAWAB5ZcOrCe', NULL, 'sandy@sandy', NULL, NULL, NULL, NULL, '2018-05-29 14:42:13', NULL, 1, 'sandy', 'dc', NULL, NULL, NULL, NULL, NULL, NULL, '', '3db6cb0023b0508c05a38ec49d8d2a10', ''),
(38, '115.178.253.37', 'thenardo55', '$2y$08$V2.sWbxD4xnAZNu1qt35Nuoq2g359xzXoE//cdHSfLwOVe/Nnu8em', NULL, 'thenardo55@yahoo.co.id', NULL, NULL, NULL, NULL, '2018-05-30 12:41:06', NULL, 1, 'Ardo', 'Thena', NULL, NULL, NULL, NULL, NULL, NULL, '', '2ca0881206a8ed07311ec318b6aee7e5', ''),
(39, '14.142.189.178', 'john', '$2y$08$HP8b23Ozp5FXCTnxDBG.LeVDm5KdqJPPwl7ARiywGBZTdxM2uyvdO', NULL, 'johnwick56565@gmail.com', NULL, NULL, NULL, NULL, '2018-05-31 13:21:19', NULL, 1, 'John', 'Wick', NULL, NULL, NULL, NULL, NULL, NULL, '', '639920231ffda531700a5f15bdb08a93', ''),
(40, '14.142.189.178', 'aaaron', '$2y$08$qNj1MxKnLklwQVUL44i0GuP4.hrjXIBdL0fvO5rOhmoP/vY0E.e9q', NULL, 'aaron@gmail.com', NULL, NULL, NULL, NULL, '2018-06-02 05:08:26', NULL, 1, 'aarron', 'aarron', NULL, NULL, NULL, NULL, NULL, NULL, '', 'b042fb64e71b765f70db34e30bc4837f', ''),
(41, '14.142.189.178', 'test', '$2y$08$O4AtSEQTIXpsDGv/yd.OmOkH9iMKW9vCrDKp3xuokovi0Jk1qmYWy', NULL, '2dfgdgdfg', NULL, NULL, NULL, NULL, '2018-06-02 08:07:08', NULL, 1, 'tyrytry', 'pritt', NULL, NULL, NULL, NULL, '546546546', '1234554', 'yes5454654', '7c45d8e6dbabf08225359d3d36fc40da', ''),
(42, '14.142.189.178', 'test', '$2y$08$RE5LIOcuQZuCLE/mAG/WTeI7nHzYHXG988IDfZ8r69GD74XOD5OQG', NULL, '2dfgdgdfg', NULL, NULL, NULL, NULL, '2018-06-02 11:58:15', NULL, 1, 'tyrytry', 'pritt', NULL, NULL, NULL, NULL, '546546546', '1234554', '123456', NULL, ''),
(43, '14.142.189.178', 'atul', '$2y$08$YJVQ8ZtN0DTv9uCWNLQxLud5mutbWAW1vvy3THwl2ILMcrNEW/OIC', NULL, 'atul@gmail.com', NULL, NULL, NULL, NULL, '2018-06-02 12:51:18', NULL, 1, 'Atul', 'namdeo', NULL, NULL, NULL, NULL, '4646', 'Developer', '45678', '17f6957620b332893aa86b76700b061c', 'fItN-bHXc4A:APA91bEy91-3NVbhm_WwuFZb9htQi80dddbf05d2PkhVWWmWsxa5wvMfCNwB394l8if4LYhuhY1fjBG-WA-NySewcW95ELLbkEWhimQAN5V601MeV9hVGP9Wp3c5ZQv8jCpsOR7pIUsD'),
(44, '171.60.157.212', 'tetssr', '$2y$08$23sjPO1yh5Wrr2NvWS3fp.6jV8oqd4CEOwdsvimAGI4KSeGZSywPe', NULL, 'aasd@gmail.com', NULL, NULL, NULL, NULL, '2018-06-03 12:57:27', NULL, 1, 'fsdfsdf', 'sdfsd', NULL, NULL, NULL, NULL, 'fsdf', 'sdfsd', '', NULL, ''),
(45, '103.82.99.25', 'New employee ', '$2y$08$4X/nUnYUiqvKhG8E5ns8KOd6WKulVOUHCx8BcoNUPgsPV.GLd2dLm', NULL, 'Employee@gmail.com', NULL, NULL, NULL, NULL, '2018-06-03 13:03:43', NULL, 1, 'Emoloyee', 'Check', NULL, NULL, NULL, NULL, '2368', 'Jdke', '', 'ef5952304e3b9bc97366f9c23d81b375', 'er-iK5WgrCk:APA91bFs-8WLEY7_IgsMe8Sd9CkRXzS0i8xE9eMVX_ZGgo18O3tcdR0Vg3e_dCg00WzMYZNyo1P532CJsS0eTUNtWaaUfXh33aFAkJ03TowTLbeEeHIqZnp2eojdbT0fmlOsRxXA3RLo'),
(46, '180.253.68.11', 'daniel01', '$2y$08$TI8w7y9SYt3M90UMX1eFYOgCUtcaPDlZ494SSN8ncys/No.U1YnPy', NULL, 'daniel@gmail.com', NULL, NULL, NULL, NULL, '2018-06-03 14:32:52', NULL, 1, 'daniel', 'hoe', NULL, NULL, NULL, NULL, '61949595244', 'mahasiswa', '', '8d61c5764f13549af896bf0f46cfae9a', 'doXXgQx1hvk:APA91bELbRd6D1rt0mncrw1o_b5zGSlkFxrGiyujumiKing27LGVCLIm7PkbSaqnaLw8Ow3Pl5JS2IgcaVBPjnRLfGzlfB6rbKo6vPNXjFWNGJ-NujzUaki7HtTf3qS1JUuN2Md7k_Hi'),
(47, '180.253.68.11', 'sdc123', '$2y$08$5qs3nQgoDLtaBe.8E7OJluBhP.Jw2L39bnbDChCqRI.K42LIt2ZzW', NULL, 'sandy@gmail.com', NULL, NULL, NULL, NULL, '2018-06-03 14:39:22', NULL, 1, 'san', 'dy', NULL, NULL, NULL, NULL, '123456789', 'mahasiswa', '1645136561', '7b549564958b892d49ee8ae5b06e4edb', 'eG9rWwqB7k0:APA91bH1GziZr-6GsmA9EPnQzJCrRZfgBtC4IUIoFgku0Tl8JCXmQfwc8r-wrJnKu-dO1IBPwfbO6AUbxgJMZz5cXwA6l6HEnMfloN-EMGLSD3c7K0F7nt349rDzHrsADlv4XufwLz30'),
(48, '180.253.68.11', 'karyawan', '$2y$08$QTWEnJ5ejrKzb59WsApAk.unjWmE4hvvgyHp49pefDGHSPFXWr3AW', NULL, 'karyawan@google.com', NULL, NULL, NULL, NULL, '2018-06-03 15:01:54', NULL, 1, 'karya', 'wan', NULL, NULL, NULL, NULL, '1234567890', 'sukasuka', '', NULL, ''),
(49, '14.142.189.178', 'heyyuser', '$2y$08$LcO4huCR08HAEf80PfOZ/eWboxPucsn.O8p/cSu1LNKDj.SGzLr6O', NULL, 'heyy@gmail.com', NULL, NULL, NULL, NULL, '2018-06-03 15:08:53', NULL, 1, 'hello', 'dear', NULL, NULL, NULL, NULL, '8959', 'ehej', '924943501', NULL, ''),
(50, '180.253.68.11', 'member', '$2y$08$TzaFGvxLTwhR8.C17wEYjuyc0cdTqjhDNx0iv1xZZ/eIrZ8gWR9ua', NULL, 'member@gmail.com', NULL, NULL, NULL, NULL, '2018-06-03 15:10:39', NULL, 1, 'mem', 'ber', NULL, NULL, NULL, NULL, '123456789', 'mahasiswa', '924943501', 'f4df92545c9997cc86eeda570aa6e57e', 'f7d-P6Czk9k:APA91bE6BgbnY8OELXX7NfooJTPiYNgx12XRuojkMzk8rwUigxPl_CzGiqXicbXHmVyISB1EGgr2GJw3iWweuJ-poFx403X7CQtEDqQ-chrKqV1Kls2xicKku0WDDopYY8RmSxRyFs5K'),
(51, '182.1.83.20', 'jordan001', '$2y$08$yZStAfXBE1f3dk2vjwuoCu8edOum2.rfPPqnUl4jDMix71mMFwRuy', NULL, 'gjghjtgxd', NULL, NULL, NULL, NULL, '2018-06-03 16:04:28', NULL, 1, 'Jordan R', 'C', NULL, NULL, NULL, NULL, '8543866', 'Mahasiswa', '235774226', 'f0ca26f54b82fde33d46c438ddeebc58', 'cy7FQcs3qRE:APA91bFVD9YzAmiZV1wV7Gm3H9U41yTR_IFNznqUfPM8jX4j8h6iNdpHw-WRcYV8bAkO1V6flGIta2iP_R1udSdc_Vr62PBZTUHU1YkHO8b-UqEkVTHdJlIA3qq7Z9x0rxQi4yfykfVx'),
(52, '182.1.80.37', 'jrc01', '$2y$08$HUYvYW8Gw0/qcvNheNBmQ.8M3JzwhUemqe8kGpQW/saGbl9wlmehC', NULL, 'jsjsjrr', NULL, NULL, NULL, NULL, '2018-06-03 17:08:46', NULL, 1, 'jordan r ', 'c', NULL, NULL, NULL, NULL, '646464', 'mahasiswa', '899132237', 'f80db7a4cb00f3c875d95eb8a49a90fc', 'f7d-P6Czk9k:APA91bE6BgbnY8OELXX7NfooJTPiYNgx12XRuojkMzk8rwUigxPl_CzGiqXicbXHmVyISB1EGgr2GJw3iWweuJ-poFx403X7CQtEDqQ-chrKqV1Kls2xicKku0WDDopYY8RmSxRyFs5K'),
(53, '115.178.235.110', 'kart', '$2y$08$W3b2KHSOBw/WFHWOBzk1COGKsuEYECgCTXLdh3wd2523mvGBfGG8y', NULL, 'kartika.gianina@gmail.com', NULL, NULL, NULL, NULL, '2018-06-04 07:10:09', NULL, 1, 'kartika', 'tileng', NULL, NULL, NULL, NULL, '8504545454', 'dosen', '167680462', '07bf0b371dee45f1665e052920f07127', 'cIvcjFI0JnY:APA91bFtRP9BUgleIUTjjOYrQXC_JARppEPs6ltfY7tZEX1dxmRZcMQXn5djkYGOsqhBy6mX8VzR5ETHv33dyvqB_X7MXaY0r2XtCzbDK5kUjpeNAKVUlZkk9g_9LiVE8ode-moAB82_'),
(54, '115.178.235.110', 'bpatidar', '$2y$08$h9vPueNTahaVytN9ek6yr.ujza00cegOIU/THSMVD65BUGl2dtxa6', NULL, 'bpatidar@gmail.com', NULL, NULL, NULL, NULL, '2018-06-04 14:55:09', NULL, 1, 'Buphesh', 'Patidar', NULL, NULL, NULL, NULL, '8464848264', 'Mahasiswa', '', NULL, ''),
(55, '182.1.64.70', 'jordan02', '$2y$08$3sITFUIYCj6tWSFucEjg5.F6qCCD2Ko/ev3y2rD6uWz58MudlBDl6', NULL, 'jrcryser023@gmail.com', NULL, NULL, NULL, NULL, '2018-06-04 18:58:22', NULL, 1, 'jordan', 'Rio c', NULL, NULL, NULL, NULL, '668423688', 'mahasiswa', '', '64728b9ebb1bf0e1b87a8b3721ba8b79', 'caUmUJpBao0:APA91bGlqqIWl7PNDbdYo2XQzCVXOUgJGi1TpkrUC6TbgUcxvLSubc2e0WrPwkMhyVz3IEm6sn0uRrrglQcaESgBoKWmabEdkJTO3a1uxu62UqrjmfBql9ICv8WQSW3HUMQwsg5V5YUd'),
(56, '114.125.110.134', 'jordan01', '$2y$08$7HqZYtEtHCyAZcZgT.I7bOl1iobFtJeIDHMBPLcnAyFndjnzC1KCK', NULL, 'jordan@gmail.com', NULL, NULL, NULL, NULL, '2018-06-05 08:27:58', NULL, 1, 'Jordan  Rio', 'C', NULL, NULL, NULL, NULL, '946594946', 'Mahasiswa', '', NULL, '');

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
(2, 2, 2),
(15, 3, 2),
(16, 4, 2),
(22, 5, 1),
(23, 5, 3),
(17, 6, 3),
(7, 7, 2),
(8, 8, 1),
(26, 11, 3),
(27, 12, 3),
(28, 13, 3),
(36, 15, 3),
(33, 16, 3),
(35, 17, 3),
(40, 18, 3),
(39, 19, 3),
(41, 20, 3),
(42, 21, 3),
(64, 23, 3),
(49, 24, 3),
(50, 25, 3),
(76, 26, 3),
(53, 27, 3),
(54, 28, 3),
(55, 29, 3),
(56, 30, 3),
(57, 31, 3),
(84, 32, 3),
(60, 33, 3),
(61, 34, 3),
(62, 35, 3),
(63, 36, 3),
(65, 37, 3),
(66, 38, 3),
(67, 39, 3),
(68, 40, 3),
(69, 41, 3),
(70, 42, 3),
(71, 43, 3),
(72, 44, 3),
(73, 45, 3),
(74, 46, 2),
(75, 47, 3),
(77, 48, 3),
(78, 49, 3),
(79, 50, 3),
(80, 51, 3),
(81, 52, 3),
(82, 53, 3),
(83, 54, 3),
(85, 55, 3),
(86, 56, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_setting`
--
ALTER TABLE `admin_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indekos`
--
ALTER TABLE `indekos`
  ADD PRIMARY KEY (`id_indekos`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin_setting`
--
ALTER TABLE `admin_setting`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `indekos`
--
ALTER TABLE `indekos`
  MODIFY `id_indekos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

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
