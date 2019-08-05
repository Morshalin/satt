-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 05, 2019 at 04:59 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `satt`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satt_admins`
--

DROP TABLE IF EXISTS `satt_admins`;
CREATE TABLE IF NOT EXISTS `satt_admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `satt_admins_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satt_admins`
--

INSERT INTO `satt_admins` (`id`, `first_name`, `last_name`, `user_name`, `gender`, `email`, `mobile_no`, `alternate_mobile_no`, `bio`, `image`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Tariqul', 'Islam', 'teamsatt', 'Male', 'tariqulislamrc@gmail.com', '01718627564', '01914217682', 'Hi, I am Md. Tariqul Islam', NULL, 1, '2019-07-30 18:40:26', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `satt_courses`
--

DROP TABLE IF EXISTS `satt_courses`;
CREATE TABLE IF NOT EXISTS `satt_courses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_description` text COLLATE utf8mb4_unicode_ci,
  `course_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `satt_courses_created_by_foreign` (`created_by`),
  KEY `satt_courses_updated_by_foreign` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satt_courses`
--

INSERT INTO `satt_courses` (`id`, `course_name`, `course_code`, `course_description`, `course_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 'Bangla', '101', 'dfds', 1, NULL, NULL, NULL, NULL),
(5, 'Math', '102', 'dxfds', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `satt_customer_business_type`
--

DROP TABLE IF EXISTS `satt_customer_business_type`;
CREATE TABLE IF NOT EXISTS `satt_customer_business_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `software_type` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_customer_business_type`
--

INSERT INTO `satt_customer_business_type` (`id`, `software_type`, `create_date`, `status`) VALUES
(3, 'Schools Management', '2019-08-04 08:23:53', 1),
(2, 'College Management', '2019-08-04 08:07:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `satt_customer_informations`
--

DROP TABLE IF EXISTS `satt_customer_informations`;
CREATE TABLE IF NOT EXISTS `satt_customer_informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `facebook_name` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `introduction_date` varchar(255) DEFAULT NULL,
  `customer_reference` varchar(255) DEFAULT NULL,
  `progressive_state` varchar(255) DEFAULT NULL,
  `interested_services` varchar(255) DEFAULT NULL,
  `institute_type` varchar(255) DEFAULT NULL,
  `institute_name` varchar(255) DEFAULT NULL,
  `institute_address` varchar(255) DEFAULT NULL,
  `institute_district` varchar(255) DEFAULT NULL,
  `official_notes` mediumtext,
  `last_contacted_date` varchar(255) DEFAULT NULL,
  `customer_leave_us` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satt_customer_informations`
--

INSERT INTO `satt_customer_informations` (`id`, `name`, `facebook_name`, `number`, `email`, `introduction_date`, `customer_reference`, `progressive_state`, `interested_services`, `institute_type`, `institute_name`, `institute_address`, `institute_district`, `official_notes`, `last_contacted_date`, `customer_leave_us`, `status`) VALUES
(1, 'Morshalin', 'Md Morshalin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `satt_customer_interestedservice`
--

DROP TABLE IF EXISTS `satt_customer_interestedservice`;
CREATE TABLE IF NOT EXISTS `satt_customer_interestedservice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `services` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_customer_interestedservice`
--

INSERT INTO `satt_customer_interestedservice` (`id`, `services`, `status`) VALUES
(1, 'Domain', 1),
(3, 'Hosting', 1);

-- --------------------------------------------------------

--
-- Table structure for table `satt_customer_notes`
--

DROP TABLE IF EXISTS `satt_customer_notes`;
CREATE TABLE IF NOT EXISTS `satt_customer_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_customer_notes`
--

INSERT INTO `satt_customer_notes` (`id`, `reason`, `status`) VALUES
(2, 'communication gap', 0),
(5, 'Heigh price', 1),
(4, 'already purchase from others', 0);

-- --------------------------------------------------------

--
-- Table structure for table `satt_customer_progres`
--

DROP TABLE IF EXISTS `satt_customer_progres`;
CREATE TABLE IF NOT EXISTS `satt_customer_progres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `progress_state` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_customer_progres`
--

INSERT INTO `satt_customer_progres` (`id`, `progress_state`, `create_date`, `status`) VALUES
(1, 'Facebook/Website Messaging in Initial State', '2019-08-03 12:03:51', 1),
(3, 'Facebook/Website Messaging', '2019-08-04 04:38:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `satt_customer_type`
--

DROP TABLE IF EXISTS `satt_customer_type`;
CREATE TABLE IF NOT EXISTS `satt_customer_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_customer_type`
--

INSERT INTO `satt_customer_type` (`id`, `type`, `status`, `create_date`) VALUES
(1, 'Facebook Messaging Customer', 1, '2019-08-03 09:42:25'),
(3, 'Google Messaging Customer', 1, '2019-08-03 10:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `satt_official_notes`
--

DROP TABLE IF EXISTS `satt_official_notes`;
CREATE TABLE IF NOT EXISTS `satt_official_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `note` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  KEY `satt_official_notes_customer_id_foreign` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `satt_settings`
--

DROP TABLE IF EXISTS `satt_settings`;
CREATE TABLE IF NOT EXISTS `satt_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satt_users`
--

DROP TABLE IF EXISTS `satt_users`;
CREATE TABLE IF NOT EXISTS `satt_users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from_table` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'satt_admins',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `satt_users_email_unique` (`email`),
  KEY `satt_users_admin_id_foreign` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satt_users`
--

INSERT INTO `satt_users` (`id`, `user_name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `admin_id`, `from_table`, `status`, `role`) VALUES
(1, 'teamsatt', 'tariqulislamrc@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 'satt_admins', 'active', 'admin'),
(2, 'satt', 'satt@gmail.com', '2019-08-15 18:00:00', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2019-08-03 18:00:00', '2019-08-03 18:00:00', 1, 'satt_admins', 'active', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `satt_user_logs`
--

DROP TABLE IF EXISTS `satt_user_logs`;
CREATE TABLE IF NOT EXISTS `satt_user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `satt_user_logs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satt_user_logs`
--

INSERT INTO `satt_user_logs` (`id`, `user_id`, `status`, `ip_address`, `details`, `user_name`, `password`, `created_at`, `updated_at`) VALUES
(112, NULL, 0, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-01 11:26:29\"}', 'teamsatt', '123456', '2019-08-01 05:26:29', NULL),
(113, NULL, 0, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-01 11:26:58\"}', 'teamsatt', '123456', '2019-08-01 05:26:58', NULL),
(114, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-01 11:40:01\"}', NULL, NULL, '2019-08-01 05:40:01', NULL),
(115, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/lock.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-01 11:41:04\"}', NULL, NULL, '2019-08-01 05:41:04', NULL),
(116, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-01 11:42:17\"}', NULL, NULL, '2019-08-01 05:42:17', NULL),
(117, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-01 11:52:57\"}', NULL, NULL, '2019-08-01 05:52:57', NULL),
(118, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/lock.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-01 11:53:34\"}', NULL, NULL, '2019-08-01 05:53:34', NULL),
(119, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-01 01:00:04\"}', NULL, NULL, '2019-08-01 07:00:05', NULL),
(120, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; WOW64; rv:68.0) Gecko/20100101 Firefox/68.0\",\"ts\":\"2019-08-01 02:50:25\"}', NULL, NULL, '2019-08-01 08:50:25', NULL),
(121, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/lock.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin%2Fcourse%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-01 02:57:39\"}', NULL, NULL, '2019-08-01 08:57:39', NULL),
(122, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-02 06:45:54\"}', NULL, NULL, '2019-08-02 12:45:54', NULL),
(123, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-02 07:18:08\"}', NULL, NULL, '2019-08-02 13:18:08', NULL),
(124, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/lock.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-02 08:04:35\"}', NULL, NULL, '2019-08-02 14:04:35', NULL),
(125, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/lock.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin%2Fcourse%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-02 09:00:12\"}', NULL, NULL, '2019-08-02 15:00:12', NULL),
(126, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/lock.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin%2Fcourse%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-02 10:10:10\"}', NULL, NULL, '2019-08-02 16:10:10', NULL),
(127, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-03 11:13:10\"}', NULL, NULL, '2019-08-03 05:13:10', NULL),
(128, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/lock.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin%2Fcourse%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-03 11:55:05\"}', NULL, NULL, '2019-08-03 05:55:05', NULL),
(129, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/lock.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin%2Fcourse%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-03 12:30:19\"}', NULL, NULL, '2019-08-03 06:30:19', NULL),
(130, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/lock.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin%2Fcourse%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-03 01:02:23\"}', NULL, NULL, '2019-08-03 07:02:23', NULL),
(131, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-04 10:22:47\"}', NULL, NULL, '2019-08-04 04:22:47', NULL),
(132, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/lock.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin%2Fbusiness-type%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-04 01:44:10\"}', NULL, NULL, '2019-08-04 07:44:10', NULL),
(133, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/lock.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin%2Fleav_us%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-04 06:18:53\"}', NULL, NULL, '2019-08-04 12:18:53', NULL),
(134, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-05 10:23:55\"}', NULL, NULL, '2019-08-05 04:23:55', NULL),
(135, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-05 10:57:17\"}', NULL, NULL, '2019-08-05 04:57:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `satt_venues`
--

DROP TABLE IF EXISTS `satt_venues`;
CREATE TABLE IF NOT EXISTS `satt_venues` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `venue_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_description` text COLLATE utf8mb4_unicode_ci,
  `venue_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `satt_venues_created_by_foreign` (`created_by`),
  KEY `satt_venues_updated_by_foreign` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satt_venues`
--

INSERT INTO `satt_venues` (`id`, `venue_name`, `venue_code`, `venue_description`, `venue_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Natore', '120', '', 1, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `satt_admins`
--
ALTER TABLE `satt_admins`
  ADD CONSTRAINT `satt_admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `satt_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `satt_courses`
--
ALTER TABLE `satt_courses`
  ADD CONSTRAINT `satt_courses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `satt_users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `satt_courses_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `satt_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `satt_official_notes`
--
ALTER TABLE `satt_official_notes`
  ADD CONSTRAINT `satt_official_notes_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `satt_admins` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `satt_official_notes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `satt_customer_informations` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `satt_users`
--
ALTER TABLE `satt_users`
  ADD CONSTRAINT `satt_users_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `satt_admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `satt_user_logs`
--
ALTER TABLE `satt_user_logs`
  ADD CONSTRAINT `satt_user_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `satt_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `satt_venues`
--
ALTER TABLE `satt_venues`
  ADD CONSTRAINT `satt_venues_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `satt_users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `satt_venues_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `satt_users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
