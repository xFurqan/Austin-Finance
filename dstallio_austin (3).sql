-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2022 at 05:19 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dstallio_austin`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'United States', '2021-06-17 18:31:23', '2021-06-17 18:31:23'),
(2, 'Australia', '2021-06-23 18:31:23', '2021-06-24 18:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest_rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joint_account_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joint_account_given_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joint_account_surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `account_number`, `account_title`, `name`, `interest_rate`, `surname`, `password`, `login`, `email`, `status`, `country`, `joint_account_title`, `joint_account_given_name`, `joint_account_surname`, `notes`, `created_at`, `updated_at`) VALUES
(46, '2530', 'Roger Gullock', 'Roger', '1.1', 'Gullock', '$tCck9^&!p', '329308', 'rmg05@test.com', '1', 'america', NULL, NULL, NULL, NULL, NULL, NULL),
(49, '47', 'TEST ACCOUNT', 'Test', '1.12', 'test', 'vF^yC#D>w(', '944750', 'testing@demo.com', '1', 'america', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finances`
--

CREATE TABLE `finances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gained_interest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdrawal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isBonusInterest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finances`
--

INSERT INTO `finances` (`id`, `customer_id`, `date`, `country`, `account_type`, `amount`, `current_amount`, `gained_interest`, `withdrawal`, `comments`, `isBonusInterest`, `created_at`, `updated_at`) VALUES
(1, 46, '2010-01-01 20:13:00', 'america', '1', '100', '100', NULL, NULL, 'Today\'s Total', NULL, '2021-09-07 10:14:00', '2021-09-07 10:14:00'),
(2, 46, '2010-07-01 00:00:00', 'america', '1', NULL, '104.83981252157', '4.8398125215703', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 10:14:00'),
(3, 46, '2011-07-01 00:00:00', 'america', '1', NULL, '115.35391149077', '10.514098969199', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 10:14:00'),
(4, 46, '2012-07-01 00:00:00', 'america', '1', NULL, '126.95558757568', '11.60167608491', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 10:14:00'),
(5, 46, '2013-07-01 00:00:00', 'america', '1', NULL, '139.68761733001', '12.732029754335', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 10:14:00'),
(6, 46, '2014-07-01 00:00:00', 'america', '1', NULL, '363.37613267975', '16.774852173848', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 15:03:52'),
(7, 46, '2015-07-01 00:00:00', 'america', '1', NULL, '399.81813434065', '36.442001660902', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 15:03:52'),
(8, 46, '2016-07-01 00:00:00', 'america', '1', NULL, '440.02969221109', '40.211557870444', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 15:03:52'),
(9, 46, '2017-07-01 00:00:00', 'america', '1', NULL, '484.15907037401', '44.129378162916', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 15:03:52'),
(10, 46, '2018-07-01 00:00:00', 'america', '1', NULL, '532.71406356136', '48.554993187349', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 15:03:52'),
(11, 46, '2019-07-01 00:00:00', 'america', '1', NULL, '586.13850463823', '27.058427575297', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 15:03:52'),
(12, 46, '2020-07-01 00:00:00', 'america', '1', NULL, '645.08916338768', '58.950658749446', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 15:03:52'),
(13, 46, '2021-07-01 00:00:00', 'america', '1', NULL, '709.78339685381', '64.694233466131', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 15:03:52'),
(14, 46, '2021-09-07  15:14:00', 'america', '1', NULL, '722.68785237334', '12.904455519533', NULL, 'Financial Year Not Editable', NULL, '2021-09-07 10:14:00', '2021-09-07 15:03:52'),
(15, 46, '2019-01-01T20:14', 'america', '1', '60', '559.08007706293', '26.36601350157', NULL, 'Today\'s Total', NULL, '2021-09-07 10:14:15', '2021-09-07 15:03:52'),
(16, 46, '2014-01-01T01:03', 'america', '1', '200', '346.6012805059', '206.91366317589', NULL, 'Today\'s Total', NULL, '2021-09-07 15:03:52', '2021-09-07 15:03:52'),
(17, 49, '2010-01-28 20:51:00', 'america', '1', NULL, '100', '0', NULL, 'Today\'s Total', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(18, 49, '2010-07-01 00:00:00', 'america', '1', NULL, '104.86513405115', '4.865134051148', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(19, 49, '2011-07-01 00:00:00', 'america', '1', NULL, '117.44895013729', '17.448950137288', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(20, 49, '2012-07-01 00:00:00', 'america', '1', NULL, '131.58367316715', '31.58367316715', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(21, 49, '2013-07-01 00:00:00', 'america', '1', NULL, '147.37371394721', '47.373713947208', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(22, 49, '2014-07-01 00:00:00', 'america', '1', NULL, '165.05855962088', '65.058559620875', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(23, 49, '2015-07-01 00:00:00', 'america', '1', NULL, '184.86558677539', '84.865586775386', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(24, 49, '2016-07-01 00:00:00', 'america', '1', NULL, '207.11375386218', '107.11375386218', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(25, 49, '2017-07-01 00:00:00', 'america', '1', NULL, '231.96740432564', '131.96740432564', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(26, 49, '2018-07-01 00:00:00', 'america', '1', NULL, '259.80349284472', '159.80349284472', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(27, 49, '2019-07-01 00:00:00', 'america', '1', NULL, '290.97991198609', '190.97991198609', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(28, 49, '2020-07-01 00:00:00', 'america', '1', NULL, '325.99870490309', '225.99870490309', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(29, 49, '2021-07-01 00:00:00', 'america', '1', NULL, '365.11854949146', '265.11854949146', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(30, 49, '2022-07-01 00:00:00', 'america', '1', NULL, '408.93277543044', '308.93277543044', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(31, 49, '2022-02-28  15:52:12', 'america', '1', NULL, '424.72015967752', '324.72015967752', NULL, 'Financial Year Not Editable', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12'),
(32, 49, '2010-01-28T20:51', 'america', '1', NULL, '100', '0', NULL, 'Today\'s Total 100', NULL, '2022-02-28 10:52:12', '2022-02-28 10:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_years`
--

CREATE TABLE `fiscal_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `financial_years` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fiscal_years`
--

INSERT INTO `fiscal_years` (`id`, `country`, `start_date`, `end_date`, `financial_years`, `created_at`, `updated_at`) VALUES
(1, 'australia', '2010-06-06', '2010-07-31', '2010-2011', NULL, NULL),
(2, 'America', '2010-01-01', '2010-12-31', '2010-2011', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `interest_changeds`
--

CREATE TABLE `interest_changeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `finance_id` int(11) NOT NULL,
  `old_interest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_interest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interest_rate`
--

CREATE TABLE `interest_rate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interest_rate`
--

INSERT INTO `interest_rate` (`id`, `customer_id`, `rate`, `year`, `created_at`, `updated_at`) VALUES
(39, 46, '1.1', '2019-01-01T20:14', '2021-09-07 10:14:15', '2021-09-07 10:14:15'),
(40, 46, '1.1', '2014-01-01T01:03', '2021-09-07 15:03:52', '2021-09-07 15:03:52');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_04_20_162046_create_customers_table', 1),
(5, '2021_04_28_171513_create_finances_table', 1),
(6, '2021_04_28_200713_create_changefins_table', 1),
(7, '2021_06_17_182852_create_currencies_table', 2),
(8, '2021_06_29_163848_create_fiscal_years_table', 3),
(9, '2021_08_22_161001_create_interest_rate_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$f.kxIoh3QRPscPxeupJccefHXPEcmQxN1ZF88G7ue71PLqlzpFIWe', '2021-05-28 03:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$9b1amg3jHsJWTPKqam/WcOHSDynXk/AQRstZE1BsxEYbP4k.ERKPa', NULL, '2021-04-28 15:17:05', '2021-04-28 15:17:05'),
(2, 'CHECK', 'ch@gmail.com', NULL, '$2y$10$6CKTwGU/x1CJ7Unj8fYlDuLP3M6AQTbhyC2IkzmBRyhRcV/ZzV7Zu', NULL, '2021-05-05 17:23:49', '2021-05-05 17:23:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `finances`
--
ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finances_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `fiscal_years`
--
ALTER TABLE `fiscal_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interest_changeds`
--
ALTER TABLE `interest_changeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interest_rate`
--
ALTER TABLE `interest_rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interest_rate_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finances`
--
ALTER TABLE `finances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `fiscal_years`
--
ALTER TABLE `fiscal_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `interest_changeds`
--
ALTER TABLE `interest_changeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `interest_rate`
--
ALTER TABLE `interest_rate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `finances`
--
ALTER TABLE `finances`
  ADD CONSTRAINT `finances_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `interest_rate`
--
ALTER TABLE `interest_rate`
  ADD CONSTRAINT `interest_rate_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
