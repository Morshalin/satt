-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2019 at 07:08 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

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
-- Table structure for table `agent_list`
--

CREATE TABLE `agent_list` (
  `id` int(11) NOT NULL,
  `agent_serial` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `father_name` varchar(225) DEFAULT NULL,
  `mother_name` varchar(225) DEFAULT NULL,
  `occupation` varchar(225) DEFAULT NULL,
  `education_qualification` varchar(225) DEFAULT NULL,
  `permanent_house` varchar(225) DEFAULT NULL,
  `permanent_road` varchar(225) DEFAULT NULL,
  `permanent_village` varchar(225) DEFAULT NULL,
  `permanent_post` varchar(225) DEFAULT NULL,
  `permanent_up` varchar(225) DEFAULT NULL,
  `permanent_dist` varchar(225) DEFAULT NULL,
  `permanent_post_code` varchar(225) DEFAULT NULL,
  `same_as` tinyint(1) DEFAULT NULL,
  `present_house` varchar(225) DEFAULT NULL,
  `present_road` varchar(225) DEFAULT NULL,
  `present_village` varchar(225) DEFAULT NULL,
  `present_post` varchar(225) DEFAULT NULL,
  `present_up` varchar(225) DEFAULT NULL,
  `present_dist` varchar(225) DEFAULT NULL,
  `present_post_code` varchar(225) DEFAULT NULL,
  `mobile_no` varchar(225) DEFAULT NULL,
  `alternate_mobile` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `interested_dist` varchar(225) DEFAULT NULL,
  `interested_up` varchar(225) DEFAULT NULL,
  `document_type` varchar(50) DEFAULT NULL,
  `photo` varchar(225) DEFAULT NULL,
  `document_front` varchar(225) DEFAULT NULL,
  `document_back` varchar(225) DEFAULT NULL,
  `tread_license` varchar(225) DEFAULT NULL,
  `bussiness_name` varchar(225) DEFAULT NULL,
  `terms_agree` tinyint(1) DEFAULT NULL,
  `signature` varchar(225) DEFAULT NULL,
  `created-at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(250) NOT NULL DEFAULT 'Registered'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agent_list`
--

INSERT INTO `agent_list` (`id`, `agent_serial`, `name`, `father_name`, `mother_name`, `occupation`, `education_qualification`, `permanent_house`, `permanent_road`, `permanent_village`, `permanent_post`, `permanent_up`, `permanent_dist`, `permanent_post_code`, `same_as`, `present_house`, `present_road`, `present_village`, `present_post`, `present_up`, `present_dist`, `present_post_code`, `mobile_no`, `alternate_mobile`, `email`, `interested_dist`, `interested_up`, `document_type`, `photo`, `document_front`, `document_back`, `tread_license`, `bussiness_name`, `terms_agree`, `signature`, `created-at`, `status`) VALUES
(1, '50', 'à¦®à¦¾à¦¹à¦«à§à¦œ ', 'à¦†à¦¬à§à¦² à¦•à¦¾à¦¶à§‡à¦®  ', 'à¦¸à¦¾à¦¹à§‡à¦¬à¦¾ à¦†à¦•à§à¦¤à¦¾à¦° ', 'à¦•à¦®à§à¦ªà¦¿à¦‰à¦Ÿà¦¾à¦° à¦…à¦ªà¦¾à¦°à§‡à¦Ÿà¦°  ', 'à¦¬à¦¿ à¦ (à¦«à¦¾à¦œà¦¿à¦²) à¦ªà¦¾à¦¸ ', '', 'à§¦à§¨', 'à¦‰à¦¤à§à¦¤à¦° à¦§à¦²à¦¿à§Ÿà¦¾ ', 'à¦¬à¦¾à¦²à§à§Ÿà¦¾ à¦šà§Œà¦®à§à¦¹à¦¨à§€ ', 'à¦«à§‡à¦¨à§€ à¦¸à¦¦à¦°  ', 'à¦«à§‡à¦¨à§€ ', 'à§©à§¯à§¦à§¦', 1, '', '', '', '', '', '', '', '01811227734', '', 'mahfuzbhuiyan91@gmail.com', 'Feni ', 'Feni ', 'NID', 'admin/uploads/photo/febd5bb1cc.jpg', 'admin/uploads/NID/febd5bb1cc.jpg', 'admin/uploads/NID/back_febd5bb1cc.jpg', '', 'à¦®à¦¿à¦›à¦¬à¦¾à¦¹à§à¦² à¦•à§à¦°à¦†à¦¨ à¦®à¦¾à¦¦à§à¦°à¦¾à¦¸à¦¾  ', 1, 'à¦®à¦¾à¦¹à¦«à§à¦œ ', '2019-07-03 17:49:10', 'Processing '),
(2, '51', 'à¦«à¦œà¦²à§‡ à¦°à¦¾à¦¬à§à¦¬à§€', 'à¦°à§‡à¦œà¦¾à¦‰à¦² à¦•à¦°à¦¿à¦®', 'à¦¤à¦¾à¦¨à¦œà¦¿à¦¨à¦¾ à¦†à¦•à§à¦¤à¦¾à¦°', 'à¦¬à§à¦¯à¦¾à¦¬à¦¸à¦¾à§Ÿà§€', 'à¦‰à¦šà§à¦š à¦®à¦¾à¦§à§à¦¯à¦®à¦¿à¦•', '', '', 'à¦•à¦¿à¦°à§à¦¤à§à¦¤à¦¨à§€à§Ÿà¦¾à¦ªà¦¾à§œà¦¾', 'à¦ªà§‹à§œà¦¾à¦°à¦¹à¦¾à¦Ÿ', 'à¦¨à§€à¦²à¦«à¦¾à¦®à¦¾à¦°à§€', 'à¦¨à§€à¦²à¦«à¦¾à¦®à¦¾à¦°à§€', 'à§«à§©à§¦à§¦', 1, '', '', '', '', '', '', '', ' 01780524138', '01521388679', 'fr.computer38@gmail.com', 'à¦¨à§€à¦²à¦«à¦¾à¦®à¦¾à¦°à§€', 'à¦¨à§€à¦²à¦«à¦¾à¦®à¦¾à¦°à§€', 'Birth_Certificate', 'admin/uploads/photo/0b708a6997.jpg', '', '', '', 'à¦à¦«.à¦†à¦° à¦•à¦®à§à¦ªà¦¿à¦‰à¦Ÿà¦¾à¦°', 1, 'à¦«à¦œà¦²à§‡ à¦°à¦¾à¦¬à§à¦¬à§€', '2019-07-03 18:23:57', 'Processing '),
(3, '52', 'à¦†à¦¬à¦¦à§à¦¸ à¦¸à¦¾à¦®à¦¾à¦¦', 'à¦¹à§‹à¦›à¦¾à¦‡à¦¨ à¦†à¦¹à¦®à¦¦à§‡', 'à¦°à¦¾à¦¬à§‡à§Ÿà¦¾ à¦¬à§‡à¦—à¦®', 'à¦›à¦¾à¦¤à§à¦°', 'Diploma', '', '', 'à¦¹à§‹à¦—à¦²à§€', 'à¦¸à¦¿à¦‚à¦¹à§‡à¦° à¦—à¦¾à¦“', 'à¦«à¦°à¦¿à¦¦à¦—à¦žà§à¦œ', 'à¦šà¦¾à¦¦à¦ªà§à¦°', 'à§©à§¬à§«à§¨', 1, '', '', '', '', '', '', '', '01845891962', '', 'abdussamad018@gmail.com', 'à¦šà¦¾à¦¦à¦ªà§à¦°', 'à¦«à¦°à¦¿à¦¦à¦—à¦žà§à¦œ', 'NID', 'admin/uploads/photo/9d5e4dde8e.jpg', 'admin/uploads/NID/9d5e4dde8e.jpg', 'admin/uploads/NID/back_9d5e4dde8e.jpg', '', '', 1, 'à¦†à¦¬à¦¦à§à¦¸ à¦¸à¦¾à¦®à¦¾à¦¦', '2019-07-03 19:40:11', 'Processing '),
(4, '53', 'Md Rasel Mahamud', 'Md Mokles Rhoman', 'Sufia Begam', 'job', 'HSC', '', '', 'Damoder pur', 'Damoderpur', 'kaligonj ', 'jhenaidah ', '7350', 0, '', '', 'Damoder pur', 'Damoderpur', 'kaligonj ', 'jhenaidah ', '7350', '01302669601', '01973966929', 'raseljkd2@gmail.com', 'jessore ', 'bagherpara', 'NID', 'admin/uploads/photo/66ae694de6.jpg', '', '', '', '', 1, 'Md Rasel Mahamud', '2019-07-04 02:59:53', 'Processing ');

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satt_admins`
--

CREATE TABLE `satt_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satt_admins`
--

INSERT INTO `satt_admins` (`id`, `first_name`, `last_name`, `user_name`, `gender`, `email`, `mobile_no`, `alternate_mobile_no`, `bio`, `image`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Tariqul', 'Islam', 'teamsatt', 'Male', 'tariqulislamrc@gmail.com', '01718627564', '01914217682', 'Hi, I am Md. Tariqul Islam', NULL, 1, '2019-07-30 18:40:26', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `satt_courses`
--

CREATE TABLE `satt_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_description` text COLLATE utf8mb4_unicode_ci,
  `course_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `satt_customer_business_type` (
  `id` int(11) NOT NULL,
  `software_type` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `satt_customer_informations` (
  `id` int(11) NOT NULL,
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
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satt_customer_informations`
--

INSERT INTO `satt_customer_informations` (`id`, `name`, `facebook_name`, `number`, `email`, `introduction_date`, `customer_reference`, `progressive_state`, `interested_services`, `institute_type`, `institute_name`, `institute_address`, `institute_district`, `official_notes`, `last_contacted_date`, `customer_leave_us`, `status`) VALUES
(1, 'Morshalin', 'Md Morshalin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `satt_customer_interestedservice`
--

CREATE TABLE `satt_customer_interestedservice` (
  `id` int(11) NOT NULL,
  `services` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `satt_customer_notes` (
  `id` int(11) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `satt_customer_progres` (
  `id` int(11) NOT NULL,
  `progress_state` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `satt_customer_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `satt_official_notes` (
  `id` int(11) NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `note` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `satt_settings`
--

CREATE TABLE `satt_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satt_users`
--

CREATE TABLE `satt_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satt_users`
--

INSERT INTO `satt_users` (`id`, `user_name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `admin_id`, `from_table`, `status`, `role`) VALUES
(1, 'teamsatt', 'tariqulislamrc@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 'satt_admins', 'active', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `satt_user_logs`
--

CREATE TABLE `satt_user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `satt_venues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venue_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_description` text COLLATE utf8mb4_unicode_ci,
  `venue_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satt_venues`
--

INSERT INTO `satt_venues` (`id`, `venue_name`, `venue_code`, `venue_description`, `venue_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Natore', '120', '', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `software_language`
--

CREATE TABLE `software_language` (
  `id` int(11) NOT NULL,
  `software_language_name` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_language`
--

INSERT INTO `software_language` (`id`, `software_language_name`, `date`, `status`) VALUES
(2, 'abc', '2019-08-03 12:01:51', 1),
(4, 'kanak', '2019-08-03 12:02:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `software_status`
--

CREATE TABLE `software_status` (
  `id` int(11) NOT NULL,
  `software_status_name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_status`
--

INSERT INTO `software_status` (`id`, `software_status_name`, `date`, `status`) VALUES
(1, 'kanak', '2019-08-03 09:43:18', 1),
(6, 'tazbinur', '2019-08-03 09:45:34', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_list`
--
ALTER TABLE `agent_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `satt_admins`
--
ALTER TABLE `satt_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satt_admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `satt_courses`
--
ALTER TABLE `satt_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satt_courses_created_by_foreign` (`created_by`),
  ADD KEY `satt_courses_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `satt_customer_business_type`
--
ALTER TABLE `satt_customer_business_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satt_customer_informations`
--
ALTER TABLE `satt_customer_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satt_customer_interestedservice`
--
ALTER TABLE `satt_customer_interestedservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satt_customer_notes`
--
ALTER TABLE `satt_customer_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satt_customer_progres`
--
ALTER TABLE `satt_customer_progres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satt_customer_type`
--
ALTER TABLE `satt_customer_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satt_official_notes`
--
ALTER TABLE `satt_official_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `satt_official_notes_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `satt_settings`
--
ALTER TABLE `satt_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satt_users`
--
ALTER TABLE `satt_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `satt_users_email_unique` (`email`),
  ADD KEY `satt_users_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `satt_user_logs`
--
ALTER TABLE `satt_user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satt_user_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `satt_venues`
--
ALTER TABLE `satt_venues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satt_venues_created_by_foreign` (`created_by`),
  ADD KEY `satt_venues_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `software_language`
--
ALTER TABLE `software_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_status`
--
ALTER TABLE `software_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_list`
--
ALTER TABLE `agent_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satt_admins`
--
ALTER TABLE `satt_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `satt_courses`
--
ALTER TABLE `satt_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `satt_customer_business_type`
--
ALTER TABLE `satt_customer_business_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satt_customer_informations`
--
ALTER TABLE `satt_customer_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `satt_customer_interestedservice`
--
ALTER TABLE `satt_customer_interestedservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `satt_customer_notes`
--
ALTER TABLE `satt_customer_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `satt_customer_progres`
--
ALTER TABLE `satt_customer_progres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `satt_customer_type`
--
ALTER TABLE `satt_customer_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `satt_official_notes`
--
ALTER TABLE `satt_official_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satt_settings`
--
ALTER TABLE `satt_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satt_users`
--
ALTER TABLE `satt_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `satt_user_logs`
--
ALTER TABLE `satt_user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `satt_venues`
--
ALTER TABLE `satt_venues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `software_language`
--
ALTER TABLE `software_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `software_status`
--
ALTER TABLE `software_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
