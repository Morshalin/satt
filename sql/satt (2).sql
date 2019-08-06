-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2019 at 08:25 AM
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
  `user_id` varchar(255) DEFAULT NULL,
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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(250) NOT NULL DEFAULT 'Registered',
  `send_mail` int(11) NOT NULL DEFAULT '0',
  `confirmation_letter` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agent_list`
--

INSERT INTO `agent_list` (`id`, `user_id`, `name`, `father_name`, `mother_name`, `occupation`, `education_qualification`, `permanent_house`, `permanent_road`, `permanent_village`, `permanent_post`, `permanent_up`, `permanent_dist`, `permanent_post_code`, `same_as`, `present_house`, `present_road`, `present_village`, `present_post`, `present_up`, `present_dist`, `present_post_code`, `mobile_no`, `alternate_mobile`, `email`, `interested_dist`, `interested_up`, `document_type`, `photo`, `document_front`, `document_back`, `tread_license`, `bussiness_name`, `terms_agree`, `signature`, `created_at`, `status`, `send_mail`, `confirmation_letter`, `updated_at`) VALUES
(6, NULL, 'Md. Abul Khair Sohag', 'Md. Salah Uddin', 'Most. Khairun Nesa', 'Softwae Developer', 'ICE RU', '#021', '102121', 'Uzanpara', 'Matikata', 'Godagari', 'Rajshahi', '6290', 1, '#021', '102121', 'Uzanpara', 'Matikata', 'Godagari', 'Rajshahi', '6290', '01753474401', '01701010760', 'abulkhairsohag@gmail.com', 'Rajshahi', 'Rajshahi', 'NID', 'images/img-5366d69e13.jpg', 'document_image/front-5366d69e13.jpg', 'document_image/back-5366d69e13.jpg', 'trade_license_image/trade5366d69e13.jpg', 'Satt IT', 1, 'Abul Khair Sohag', '0000-00-00 00:00:00', 'Registered', 0, NULL, NULL),
(7, NULL, 'Abir', 'dsfdf', 'asdas', 'sdf', 'ICE RU', 'sd', 'sdf', 'asd', 'asd', 'Godagari', 'Rajshahi', 'dsf', 1, 'sd', 'sdf', 'asd', 'asd', 'Godagari', 'Rajshahi', 'dsf', '21', 'asd', 'a@gmail.com', 'xcvx', 'cv', 'Passport', 'images/img-a1cfc884b5.jpg', 'document_image/front-a1cfc884b5.jpg', NULL, 'trade_license_image/tradea1cfc884b5.jpg', 'sfssfsfg', 1, 'dsf', '0000-00-00 00:00:00', 'Registered', 0, NULL, NULL),
(8, NULL, 'Abir', 'dsfdf', 'asdas', 'das', 'ICE RU', 'sd', 'sdf', 'asd', 'zc', 'sdf', 'sdf', 'zcx', 1, 'sd', 'sdf', 'asd', 'zc', 'sdf', 'sdf', 'zcx', 'sdfsfasdfsdf', '', 'a@gmail.com', 'Rajshahi', 'cv', 'Passport', 'images/img-2e8ba4fac1.jpg', 'document_image/front-2e8ba4fac1.jpg', NULL, NULL, '', 1, 'dsf', '2019-08-05 12:08:56', 'Registered', 0, NULL, NULL),
(9, NULL, 'Abir', 'dsfdf', 'sdf', 'sdf', 'zxc', 'sdf', 'asd', 'asd', 'zc', 'sdfa', 'asd', 'dsf', 0, 'sdf', 'sdf', 'Uzanpara', 'Matikata', 'Godagari', 'asd', 'ads', '01753474401', '01701010760', 'a@gmail.com', 'xcvx', 'cv', 'NID', 'images/img-34ea50db4c.jpg', 'document_image/front-34ea50db4c.jpg', 'document_image/back-34ea50db4c.jpg', 'trade_license_image/trade34ea50db4c.jpg', 'Satt IT', 1, 'sfd', '2019-08-05 14:11:16', 'Registered', 0, NULL, NULL),
(10, NULL, 'Motiur Rahman', 'zxczxc', 'sdf', 'sdf', 'zxc', 'sd', 'sdf', 'asd', 'asd', 'sdf', 'sdf', 'sdf', 1, 'sd', 'sdf', 'asd', 'asd', 'sdf', 'sdf', 'sdf', '01753474401', 'asd', 'a@gmail.com', 'xcvx', 'cv', 'Passport', 'images/img-8dbc32307a.jpg', 'document_image/front-8dbc32307a.jpg', NULL, NULL, '', 1, 'dsf', '2019-08-05 14:16:50', 'Registered', 0, NULL, NULL),
(11, NULL, 'Abir', 'dsfdf', 'asdas', 'sdf', 'ICE RU', 'sdf', 'asd', 'asd', 'sdf', 'sdfa', 'sdf', 'ads', 1, 'sdf', 'asd', 'asd', 'sdf', 'sdfa', 'sdf', 'ads', '01753474401', 'zxc', 'a@gmail.com', 'xcvx', 'cv', 'Passport', 'images/img-f5b7886097.jpg', 'document_image/front-f5b7886097.jpg', NULL, NULL, '', 1, 'sfd', '2019-08-05 14:17:51', 'Registered', 0, NULL, NULL),
(12, NULL, 'abir', 'dsfdf', 'asdas', 'das', 'df', 'sd', 'sdf', 'zxc', 'sdf', 'sdfa', 'sdf', 'ads', 1, 'sd', 'sdf', 'zxc', 'sdf', 'sdfa', 'sdf', 'ads', '01753474401', 'asd', 'a@gmail.com', 'xcvx', 'cv', 'Passport', 'images/img-0e1b37fdfb.jpg', 'document_image/front-0e1b37fdfb.jpg', NULL, NULL, '', 1, 'as', '2019-08-05 14:19:05', 'Registered', 0, NULL, NULL);

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
  `bio` longtext,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`id`, `name`, `email`, `mobile_no`, `image`, `address`, `bio`, `facebook`, `twitter`, `linkedin`, `instagram`, `status`) VALUES
(1, 'Kanak Debnath', 'kanakdebnath826@gmail.com', '01767515963', 'image/e786436c33.jpg', 'kumarpara, Rajshahi', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit alias recusandae harum eum obcaecati sunt vitae sequi veritatis tempore vel?', 'www.facebook.com/kanaksatt', 'https://twitter.com/kanakdebnath9', 'https://www.linkedin.com/in/kanak-debnath-a0b146141/', 'https://www.instagram.com/debnath_kanak/', 1),
(2, 'Abul Khair Sohag', 'abulkhairsohag@gmail.com', '01753474401', 'image/009bf8a95b.jpg', 'Saheb bazar,Rajshai', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit nostrum blanditiis recusandae laboriosam tempore, obcaecati ducimus vel amet. Optio, quaerat.', 'https://www.facebook.com/abul.khair.sohag', 'w', 'w', 'w', 1);

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
(135, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost/satt/login.php?goto=http%3A%2F%2Flocalhost%2Fsatt%2Fadmin\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\",\"ts\":\"2019-08-05 10:57:17\"}', NULL, NULL, '2019-08-05 04:57:17', NULL),
(136, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36\",\"ts\":\"2019-08-06 11:08:56\"}', NULL, NULL, '2019-08-06 05:08:56', NULL);

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
-- Table structure for table `software_details`
--

CREATE TABLE `software_details` (
  `id` int(11) NOT NULL,
  `software_name` varchar(255) DEFAULT NULL,
  `software_status_name` varchar(255) DEFAULT NULL,
  `software_status_id` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL,
  `short_feature` varchar(255) DEFAULT NULL,
  `user_manual` varchar(255) DEFAULT NULL,
  `condition_details` text,
  `customer_question` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_details`
--

INSERT INTO `software_details` (`id`, `software_name`, `software_status_name`, `software_status_id`, `create_date`, `end_date`, `update_date`, `short_feature`, `user_manual`, `condition_details`, `customer_question`, `status`) VALUES
(6, 'Inventory', 'Bug fIxing mode', 7, '2019-07-31 18:00:00', '2019-08-09 18:00:00', NULL, 'fsgvgss', 'ggcgss', 'sggsdsd', NULL, 1),
(7, 'shg', 'Bug fIxing mode', 7, '2019-08-04 18:00:00', '2019-08-23 18:00:00', NULL, 'fd', 'gfssgfd', 'fdgfgfsd', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `software_develope_by`
--

CREATE TABLE `software_develope_by` (
  `id` int(11) NOT NULL,
  `software_id` int(11) DEFAULT NULL,
  `developer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_develope_by`
--

INSERT INTO `software_develope_by` (`id`, `software_id`, `developer_id`) VALUES
(5, 6, 1),
(6, 6, 2),
(7, 7, 1),
(8, 7, 2);

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
(2, 'PHP', '2019-08-03 12:01:51', 1),
(4, 'Mysql', '2019-08-03 12:02:00', 1),
(5, 'Laravel', '2019-08-05 05:48:23', 1),
(6, 'Ajax', '2019-08-05 05:48:32', 1),
(7, 'jQuery', '2019-08-05 05:48:41', 1),
(8, 'React', '2019-08-05 05:48:50', 1),
(9, 'VueJs', '2019-08-05 05:48:58', 1),
(10, 'Cake PHP', '2019-08-05 05:49:06', 1),
(11, 'Codignator', '2019-08-05 05:49:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `software_language_multi`
--

CREATE TABLE `software_language_multi` (
  `id` int(11) NOT NULL,
  `software_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_language_multi`
--

INSERT INTO `software_language_multi` (`id`, `software_id`, `language_id`) VALUES
(8, 6, 2),
(9, 6, 4),
(10, 6, 6),
(11, 6, 7),
(12, 7, 2),
(13, 7, 4),
(14, 7, 6),
(15, 7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `software_price`
--

CREATE TABLE `software_price` (
  `id` int(11) NOT NULL,
  `software_name` varchar(255) DEFAULT NULL,
  `software_id` int(11) DEFAULT NULL,
  `demo_url` varchar(255) DEFAULT NULL,
  `installation_charge` varchar(255) DEFAULT NULL,
  `monthly_charge` varchar(255) DEFAULT NULL,
  `yearly_charge` varchar(255) DEFAULT NULL,
  `direct_sell` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `agent_commission_one_time` varchar(255) DEFAULT NULL,
  `agent_commission_monthly` varchar(255) DEFAULT NULL,
  `discount_offer` varchar(255) DEFAULT NULL,
  `yearly_renew_charge` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_price`
--

INSERT INTO `software_price` (`id`, `software_name`, `software_id`, `demo_url`, `installation_charge`, `monthly_charge`, `yearly_charge`, `direct_sell`, `total_price`, `agent_commission_one_time`, `agent_commission_monthly`, `discount_offer`, `yearly_renew_charge`) VALUES
(3, 'Inventory', 6, 'gsfgf', '456', '41', '456', '4516', '4561', '414', '465', '176', '781'),
(4, 'shg', 7, 'gfsd', '42', '4562', '2456', '2546', '4562', '4562', '2456', '2456', '4526');

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
(1, 'Live', '2019-08-03 09:43:18', 1),
(6, 'Developing Mode', '2019-08-03 09:45:34', 1),
(7, 'Bug fIxing mode', '2019-08-05 05:46:54', 1),
(8, 'To develope', '2019-08-05 05:47:10', 1),
(9, 'To purchase ready made Code', '2019-08-05 05:47:25', 1);

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
-- Indexes for table `satt_admins`
--
ALTER TABLE `satt_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satt_admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `satt_users`
--
ALTER TABLE `satt_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `satt_users_email_unique` (`email`),
  ADD KEY `satt_users_admin_id_foreign` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `satt_admins`
--
ALTER TABLE `satt_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `satt_users`
--
ALTER TABLE `satt_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `satt_admins`
--
ALTER TABLE `satt_admins`
  ADD CONSTRAINT `satt_admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `satt_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `satt_users`
--
ALTER TABLE `satt_users`
  ADD CONSTRAINT `satt_users_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `satt_admins` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
