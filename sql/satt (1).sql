-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2019 at 07:55 AM
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
-- Table structure for table `agent_client`
--

CREATE TABLE `agent_client` (
  `id` int(11) NOT NULL,
  `agent_id` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agent_client`
--

INSERT INTO `agent_client` (`id`, `agent_id`, `client_id`, `client_name`, `add_date`) VALUES
(2, '16', '12', 'kanak', '2019-08-07 16:07:15'),
(3, '16', '21', 'Morshalin', '2019-08-22 05:04:40'),
(4, '16', '22', 'Motiur Rahman', '2019-08-22 05:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `agent_contact`
--

CREATE TABLE `agent_contact` (
  `id` int(11) NOT NULL,
  `agent_id` varchar(255) NOT NULL,
  `contact_note` varchar(255) DEFAULT NULL,
  `contact_by` varchar(255) NOT NULL,
  `contact_time` varchar(255) DEFAULT NULL,
  `contact_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agent_contact`
--

INSERT INTO `agent_contact` (`id`, `agent_id`, `contact_note`, `contact_by`, `contact_time`, `contact_date`) VALUES
(2, '16', 'dssdfsdfs', 'ID: 102, Name: abul khair', 'sadfs', '2019-08-21'),
(4, '21', 'sfsdf', 'ID: 103, Name: kank', 'sfdsdf', '2019-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `agent_contact_by`
--

CREATE TABLE `agent_contact_by` (
  `id` int(11) NOT NULL,
  `contact_person_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agent_contact_by`
--

INSERT INTO `agent_contact_by` (`id`, `contact_person_id`, `name`, `status`) VALUES
(2, '102', 'abul khair', '1'),
(3, '103', 'kank', '1');

-- --------------------------------------------------------

--
-- Table structure for table `agent_id`
--

CREATE TABLE `agent_id` (
  `id` int(11) NOT NULL,
  `agent_id` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `level` varchar(255) DEFAULT NULL,
  `send_mail` int(11) NOT NULL DEFAULT '0',
  `confirmation_letter` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agent_list`
--

INSERT INTO `agent_list` (`id`, `user_id`, `name`, `father_name`, `mother_name`, `occupation`, `education_qualification`, `permanent_house`, `permanent_road`, `permanent_village`, `permanent_post`, `permanent_up`, `permanent_dist`, `permanent_post_code`, `same_as`, `present_house`, `present_road`, `present_village`, `present_post`, `present_up`, `present_dist`, `present_post_code`, `mobile_no`, `alternate_mobile`, `email`, `interested_dist`, `interested_up`, `document_type`, `photo`, `document_front`, `document_back`, `tread_license`, `bussiness_name`, `terms_agree`, `signature`, `created_at`, `status`, `level`, `send_mail`, `confirmation_letter`, `updated_at`) VALUES
(16, NULL, 'Md. Abul Khair Sohag', 'Md. Salah Uddin', 'Most. Khairun Nesa', 'Softwae Developer', 'ICE RU', '123', '456', 'Uzanpara', 'Matikata', 'Godagari', 'Rajshahi', '6290', 1, '123', '456', 'Uzanpara', 'Matikata', 'Godagari', 'Rajshahi', '6290', '01753474401', '', 'a@gmail.com', 'Rajshahi', 'Godagari', 'NID', 'images/img-b67fad106e.jpg', 'document_image/front-b67fad106e.jpg', 'document_image/back-282447a3dc.jpg', 'trade_license_image/trade-282447a3dc.jpg', 'dfsadfsdf', 1, 'sohag', '2019-08-07 08:54:22', 'Promote', 'Golden', 2, 'appiontment_letters/Md. Abul Khair Sohag_16.pdf', '2019-08-20 10:28:25'),
(21, NULL, 'Abul Khair Sohagsfs', 'Md. Salah Uddinsfs', 'Most. Khairun Nesasf', 'Softwae Developersfs', 'ICE RUsfd', '012321sf', '102121sf', 'Uzanparasf', 'Matikatasf', 'asdfsf', 'Rajshahisf', 'asdfsf', 1, '012321sf', '102121sf', 'Uzanparasf', 'Matikatasf', 'asdfsf', 'Rajshahisf', 'asdfsf', '017356456545456', 'asd456', 'abulkha464irsohag@gmail.com', '145646', 'zxcz456465', 'NID', 'images/img-54baae64bd.jpg', 'document_image/front-e3b3bd0445.jpg', 'document_image/back-960883a5cd.jpg', 'trade_license_image/trade-7d03c69cbe.jpg', 'dsfsdf', 1, 'sfdfcghnbnvn', '2019-08-20 10:29:41', 'Promote', 'Silver', 0, 'appiontment_letters/Abul Khair Sohagsfs_21.pdf', '2019-08-22 05:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `agent_note`
--

CREATE TABLE `agent_note` (
  `id` int(11) NOT NULL,
  `agent_id` varchar(255) DEFAULT NULL,
  `note` longtext,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agent_note`
--

INSERT INTO `agent_note` (`id`, `agent_id`, `note`, `add_date`) VALUES
(7, '16', 'zfCzX', '2019-08-11 11:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `agent_selling_product_list`
--

CREATE TABLE `agent_selling_product_list` (
  `id` int(11) NOT NULL,
  `agent_id` varchar(255) DEFAULT NULL,
  `software_id` varchar(255) DEFAULT NULL,
  `software_name` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `sell_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agent_selling_product_list`
--

INSERT INTO `agent_selling_product_list` (`id`, `agent_id`, `software_id`, `software_name`, `client_id`, `client_name`, `sell_date`) VALUES
(1, '16', '7', 'shg', '2', 'kanak', '2019-08-11 11:40:20'),
(2, '16', '0', 'sfsdfs', '3', 'Morshalin', '2019-08-22 05:05:16'),
(3, '21', '6', 'Inventory', '5', 'Morshalin', '2019-08-22 05:35:50'),
(4, '21', '0', 'sfsdfs', '5', 'Morshalin', '2019-08-22 05:38:16');

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
(1, 'Kanak Debnath', 'kanakdebnath826@gmail.com', '01767515963', 'image/49d66aabd6.jpg', 'kumarpara, Rajshahi', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit alias recusandae harum eum obcaecati sunt vitae sequi veritatis tempore vel?', 'www.facebook.com/kanaksatt', 'https://twitter.com/kanakdebnath9', 'https://www.linkedin.com/in/kanak-debnath-a0b146141/', 'https://www.instagram.com/debnath_kanak/', 1),
(2, 'Abul Khair Sohag', 'abulkhairsohag@gmail.com', '01753474401', 'image/009bf8a95b.jpg', 'Saheb bazar,Rajshai', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit nostrum blanditiis recusandae laboriosam tempore, obcaecati ducimus vel amet. Optio, quaerat.', 'https://www.facebook.com/abul.khair.sohag', 'wafsfda', 'wsdsafd', 'wsdafsadf', 1);

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
(2, 'College Management', '2019-08-04 08:07:09', 1),
(4, 'Super shop', '2019-08-05 11:31:26', 1),
(5, 'Hardware Shop', '2019-08-05 11:31:48', 1),
(6, 'Pharmacy', '2019-08-05 11:32:09', 1),
(7, 'Hold Back', '2019-08-20 08:01:04', 1);

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
  `institute_type` varchar(255) DEFAULT NULL,
  `institute_name` varchar(255) DEFAULT NULL,
  `institute_address` text,
  `institute_district` varchar(255) DEFAULT NULL,
  `last_contacted_date` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satt_customer_informations`
--

INSERT INTO `satt_customer_informations` (`id`, `name`, `facebook_name`, `number`, `email`, `introduction_date`, `customer_reference`, `progressive_state`, `institute_type`, `institute_name`, `institute_address`, `institute_district`, `last_contacted_date`, `status`) VALUES
(21, 'Morshalin', 'Md Morshalin', '01792747486', 'morshalin@gmail.com', '2019-08-21', 'Facebook Messaging Customer', 'Website Messaging', 'School', 'primary school', 'Rajshahi', 'Rajshahi', '2019-08-23', 1),
(22, 'Motiur Rahman', 'vxcvx', 'vcxcv', 'abulkhairsohag@gmail.com', 'August 22, 2019', 'Social Network Twitter', 'Facebook', 'xcvx', 'sdfsdf', 'sdfsdf', 'bgcvbc', 'August 22, 2019', 1);

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
(1, 'Domain Sevices', 1),
(3, 'Hosting', 1),
(6, 'Website', 1),
(7, 'Graphic Design', 1),
(8, 'Hold Back', 1);

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
(2, 'Communication gap', 1),
(5, 'Heigh price', 1),
(4, 'Already purchase from others', 1);

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
(1, 'Website Messaging in Initial State', '2019-08-03 12:03:51', 1),
(5, 'Website Messaging', '2019-08-19 11:55:47', 1),
(3, 'Facebook', '2019-08-04 04:38:08', 1),
(6, 'Twitter Messaging', '2019-08-19 11:56:45', 1);

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
(5, 'Social Network Twitter', 1, '2019-08-05 05:40:47'),
(3, 'Google Messaging Customer', 1, '2019-08-03 10:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `satt_extra_interested_service`
--

CREATE TABLE `satt_extra_interested_service` (
  `id` int(11) NOT NULL,
  `interested_services_id` int(11) DEFAULT NULL,
  `cutomer_details_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_extra_interested_service`
--

INSERT INTO `satt_extra_interested_service` (`id`, `interested_services_id`, `cutomer_details_id`) VALUES
(57, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `satt_extra_office_notes`
--

CREATE TABLE `satt_extra_office_notes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `facebook_name` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `introduction_date` varchar(255) DEFAULT NULL,
  `customer_reference` varchar(255) DEFAULT NULL,
  `progressive_state` varchar(255) DEFAULT NULL,
  `institute_type` varchar(255) DEFAULT NULL,
  `institute_name` varchar(255) DEFAULT NULL,
  `institute_address` varchar(255) DEFAULT NULL,
  `institute_district` varchar(255) DEFAULT NULL,
  `last_contacted_date` varchar(255) DEFAULT NULL,
  `note` text,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_extra_office_notes`
--

INSERT INTO `satt_extra_office_notes` (`id`, `name`, `facebook_name`, `number`, `email`, `introduction_date`, `customer_reference`, `progressive_state`, `institute_type`, `institute_name`, `institute_address`, `institute_district`, `last_contacted_date`, `note`, `status`) VALUES
(12, 'Morshalin', '', '01792747486', '', '2019-08-21', 'Customer Reference', 'Progress State', '', '', '', '', '2019-08-15', 'Another time, contact with you.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `satt_extra__software_category`
--

CREATE TABLE `satt_extra__software_category` (
  `id` int(11) NOT NULL,
  `software_id` int(11) DEFAULT NULL,
  `cutomer_details_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_extra__software_category`
--

INSERT INTO `satt_extra__software_category` (`id`, `software_id`, `cutomer_details_id`) VALUES
(58, 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `satt_interested_services`
--

CREATE TABLE `satt_interested_services` (
  `id` int(11) NOT NULL,
  `interested_services_id` int(11) DEFAULT NULL,
  `cutomer_details_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_interested_services`
--

INSERT INTO `satt_interested_services` (`id`, `interested_services_id`, `cutomer_details_id`) VALUES
(66, 1, 21),
(67, 3, 21),
(68, 6, 22);

-- --------------------------------------------------------

--
-- Table structure for table `satt_leave_reason`
--

CREATE TABLE `satt_leave_reason` (
  `id` int(11) NOT NULL,
  `custimer_id` int(11) DEFAULT NULL,
  `leave_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `satt_message`
--

CREATE TABLE `satt_message` (
  `id` int(225) NOT NULL,
  `message_type` varchar(225) DEFAULT NULL,
  `customer_question` varchar(225) DEFAULT NULL,
  `our_reply` varchar(225) DEFAULT NULL,
  `software_information` varchar(225) DEFAULT NULL,
  `contact_details` varchar(225) DEFAULT NULL,
  `introduction_message` varchar(225) DEFAULT NULL,
  `status` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_message`
--

INSERT INTO `satt_message` (`id`, `message_type`, `customer_question`, `our_reply`, `software_information`, `contact_details`, `introduction_message`, `status`) VALUES
(1, 'simple', 'How are you?', 'i am fine', 'it\'s still developing', '01728091199', 'hellow, how are you?', '0'),
(2, 'simple', 'How are you?', 'i am fine', 'it\'s still developing', '01728091199', 'hellow, how are you?', '0'),
(3, 'simple', 'How are you?', 'i am fine', 'it\'s still developing', '01728091199', 'hellow, how are you?', '1'),
(4, 'simple', 'How are you?', 'i am fine', 'it\'s still developing', '01728091199', 'hellow, how are you?', '1'),
(5, 'simple', 'How are you?', 'i am fine', 'it\'s still developing', '01728091199', 'hellow, how are you?', '1'),
(6, 'Important', 'sdfsdf', 'sfsd', 'sdf', 'sdfsdf', 'sdfs', '0');

-- --------------------------------------------------------

--
-- Table structure for table `satt_message_type`
--

CREATE TABLE `satt_message_type` (
  `id` int(225) NOT NULL,
  `type` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_message_type`
--

INSERT INTO `satt_message_type` (`id`, `type`) VALUES
(2, 'Important'),
(8, 'simple'),
(9, 'sdfsfsdf sdfsddfsdfsd'),
(10, 'sdfsdfsdfsf   dsfsdfsdfsdfsd');

-- --------------------------------------------------------

--
-- Table structure for table `satt_official_notes`
--

CREATE TABLE `satt_official_notes` (
  `id` int(11) NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `note` text NOT NULL,
  `creat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satt_official_notes`
--

INSERT INTO `satt_official_notes` (`id`, `admin_id`, `customer_id`, `note`, `creat_date`, `update_date`, `status`) VALUES
(91, 0, 22, 'asdfasdasdasd', '2019-08-22 05:12:50', '2019-08-22 05:12:50', 1),
(92, 0, 22, 'asdasdasdasdasdas', '2019-08-22 05:13:00', '2019-08-22 05:13:00', 1);

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
(136, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36\",\"ts\":\"2019-08-06 11:08:56\"}', NULL, NULL, '2019-08-06 05:08:56', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/lock.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36\",\"ts\":\"2019-08-06 12:30:31\"}', NULL, NULL, '2019-08-06 06:30:31', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/lock.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36\",\"ts\":\"2019-08-06 02:27:01\"}', NULL, NULL, '2019-08-06 08:27:01', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36\",\"ts\":\"2019-08-07 10:23:49\"}', NULL, NULL, '2019-08-07 04:23:49', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/lock.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36\",\"ts\":\"2019-08-07 10:52:10\"}', NULL, NULL, '2019-08-07 04:52:10', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-07 11:51:55\"}', NULL, NULL, '2019-08-07 05:51:55', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/lock.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-07 12:51:30\"}', NULL, NULL, '2019-08-07 06:51:30', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-07 01:09:00\"}', NULL, NULL, '2019-08-07 07:09:00', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:67.0) Gecko/20100101 Firefox/67.0\",\"ts\":\"2019-08-07 01:09:09\"}', NULL, NULL, '2019-08-07 07:09:09', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-07 04:41:34\"}', NULL, NULL, '2019-08-07 10:41:35', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/lock.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent%2Fselling_product_list.php%3Fagent_id%3D16\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-07 09:54:56\"}', NULL, NULL, '2019-08-07 15:54:56', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-07 10:19:01\"}', NULL, NULL, '2019-08-07 16:19:01', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/lock.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-07 11:00:25\"}', NULL, NULL, '2019-08-07 17:00:25', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-08 12:15:09\"}', NULL, NULL, '2019-08-08 06:15:09', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/lock.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-08 01:54:58\"}', NULL, NULL, '2019-08-08 07:54:58', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-11 05:39:16\"}', NULL, NULL, '2019-08-11 11:39:16', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-18 12:22:17\"}', NULL, NULL, '2019-08-18 06:22:17', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-19 10:57:52\"}', NULL, NULL, '2019-08-19 04:57:52', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-19 11:59:54\"}', NULL, NULL, '2019-08-19 05:59:54', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-19 12:59:56\"}', NULL, NULL, '2019-08-19 06:59:56', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/lock.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-19 02:45:47\"}', NULL, NULL, '2019-08-19 08:45:47', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-19 03:18:37\"}', NULL, NULL, '2019-08-19 09:18:37', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/lock.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-19 03:30:36\"}', NULL, NULL, '2019-08-19 09:30:36', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-19 03:48:22\"}', NULL, NULL, '2019-08-19 09:48:22', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-19 09:41:49\"}', NULL, NULL, '2019-08-19 15:41:49', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-20 10:37:08\"}', NULL, NULL, '2019-08-20 04:37:08', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-20 11:16:18\"}', NULL, NULL, '2019-08-20 05:16:18', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-20 11:27:08\"}', NULL, NULL, '2019-08-20 05:27:08', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-21 10:30:18\"}', NULL, NULL, '2019-08-21 04:30:18', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-21 12:20:55\"}', NULL, NULL, '2019-08-21 06:20:56', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fagent\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-21 03:18:24\"}', NULL, NULL, '2019-08-21 09:18:24', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/lock.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fcontact-by%2Fajax.php%3Fid%3D3\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-21 03:39:12\"}', NULL, NULL, '2019-08-21 09:39:12', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/lock.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin%2Fcontact-by%2F\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-21 06:01:38\"}', NULL, NULL, '2019-08-21 12:01:38', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-22 11:01:16\"}', NULL, NULL, '2019-08-22 05:01:16', NULL),
(0, 1, 1, '::1', '{\"ip\":\"::1\",\"re\":\"http://localhost:8080/satt/login.php?goto=http%3A%2F%2Flocalhost%3A8080%2Fsatt%2Fadmin\",\"ag\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\",\"ts\":\"2019-08-22 11:23:58\"}', NULL, NULL, '2019-08-22 05:23:58', NULL);

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
-- Table structure for table `sat_software_category`
--

CREATE TABLE `sat_software_category` (
  `id` int(11) NOT NULL,
  `software_id` int(11) DEFAULT NULL,
  `cutomer_details_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sat_software_category`
--

INSERT INTO `sat_software_category` (`id`, `software_id`, `cutomer_details_id`) VALUES
(54, 6, 22);

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
(2, 'school management', 'Bug fIxing mode', 7, '2019-08-05 18:00:00', '2019-08-07 18:00:00', '0000-00-00 00:00:00', 'abc', 'abc', 'abc', NULL, 1),
(8, 'Shop managment', 'To develope', 8, '2019-08-06 18:00:00', '2019-08-14 18:00:00', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, quibusdam quae, ullam eaque soluta corporis facere adipisci ducimus nobis iste!', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, quibusdam quae, ullam eaque soluta corporis facere adipisci ducimus nobis iste!', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, quibusdam quae, ullam eaque soluta corporis facere adipisci ducimus nobis iste!', NULL, 1),
(9, 'ffads', 'Live', 1, '2019-08-18 18:00:00', '2019-08-18 18:00:00', '0000-00-00 00:00:00', 'frrfe', 'rfesre', 'rferef', NULL, 1);

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
(19, 8, 1),
(20, 8, 2),
(26, 2, 1),
(27, 2, 2),
(30, 9, 1),
(31, 9, 2);

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
(28, 8, 2),
(29, 8, 4),
(30, 8, 6),
(31, 8, 7),
(42, 2, 2),
(43, 2, 4),
(44, 2, 6),
(45, 2, 7),
(48, 9, 4),
(49, 9, 5);

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
(5, 'refre', 1, 'erwrfe', '435', '435', '453', '534', '354', '534', '543', '534', '534'),
(6, 'school management', 2, 'cwrecgr', '4562', '4652', '4265', '2465', '4265', '4625', '4652', '4625', '4265'),
(10, 'Shop managment', 8, 'erp.sattit.com', '5000', '2000', '20000', '70000', '70000', '15000', '1000', '10000', '5000'),
(11, 'ffads', 9, 'res', '54', '54', '5', '564', '56', '65', '655', '54', '65645');

-- --------------------------------------------------------

--
-- Table structure for table `software_price_log`
--

CREATE TABLE `software_price_log` (
  `id` int(225) NOT NULL,
  `software_name` varchar(225) DEFAULT NULL,
  `software_id` int(225) DEFAULT NULL,
  `demo_url` varchar(225) DEFAULT NULL,
  `installation_charge` varchar(225) DEFAULT NULL,
  `monthly_charge` varchar(225) DEFAULT NULL,
  `yearly_charge` varchar(225) DEFAULT NULL,
  `direct_sell` varchar(225) DEFAULT NULL,
  `total_price` varchar(225) DEFAULT NULL,
  `agent_commission_one_time` varchar(225) DEFAULT NULL,
  `agent_commission_monthly` varchar(225) DEFAULT NULL,
  `discount_offer` varchar(225) DEFAULT NULL,
  `yearly_renew_charge` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_price_log`
--

INSERT INTO `software_price_log` (`id`, `software_name`, `software_id`, `demo_url`, `installation_charge`, `monthly_charge`, `yearly_charge`, `direct_sell`, `total_price`, `agent_commission_one_time`, `agent_commission_monthly`, `discount_offer`, `yearly_renew_charge`) VALUES
(1, 'shohag', 9, 'gfsd', '42', '4562', '2456', '2546', '4562', '4562', '2456', '2456', '4526'),
(2, 'shohag', 8, 'dddddddddddddd', '42', '4562', '2456', '2546', '4562', '4562', '2456', '2456', '4526'),
(3, 'shohag', 7, 'tazbinur', '42', '4562', '2456', '2546', '4562', '4562', '2456', '2456', '4526'),
(4, 'shohag', 2, 'http://www.google.com', '42', '4562', '2456', '2546', '4562', '4562', '2456', '2456', '4526');

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
-- Indexes for table `agent_client`
--
ALTER TABLE `agent_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_contact`
--
ALTER TABLE `agent_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_contact_by`
--
ALTER TABLE `agent_contact_by`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_id`
--
ALTER TABLE `agent_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_list`
--
ALTER TABLE `agent_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_note`
--
ALTER TABLE `agent_note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_selling_product_list`
--
ALTER TABLE `agent_selling_product_list`
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
-- Indexes for table `satt_extra_interested_service`
--
ALTER TABLE `satt_extra_interested_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satt_extra_interested_service_cutomer_details_id_foreign` (`cutomer_details_id`);

--
-- Indexes for table `satt_extra_office_notes`
--
ALTER TABLE `satt_extra_office_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satt_extra__software_category`
--
ALTER TABLE `satt_extra__software_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satt_extra__software_category_cutomer_details_id_foreign` (`cutomer_details_id`);

--
-- Indexes for table `satt_interested_services`
--
ALTER TABLE `satt_interested_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satt_interested_services_cutomer_details_id_foreign` (`cutomer_details_id`);

--
-- Indexes for table `satt_leave_reason`
--
ALTER TABLE `satt_leave_reason`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satt_leave_reason_custimer_id_foreign` (`custimer_id`);

--
-- Indexes for table `satt_message`
--
ALTER TABLE `satt_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satt_message_type`
--
ALTER TABLE `satt_message_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satt_official_notes`
--
ALTER TABLE `satt_official_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `satt_official_notes_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `satt_users`
--
ALTER TABLE `satt_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `satt_users_email_unique` (`email`),
  ADD KEY `satt_users_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `sat_software_category`
--
ALTER TABLE `sat_software_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sat_software_category_cutomer_details_id_foreign` (`cutomer_details_id`);

--
-- Indexes for table `software_details`
--
ALTER TABLE `software_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_develope_by`
--
ALTER TABLE `software_develope_by`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_language`
--
ALTER TABLE `software_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_language_multi`
--
ALTER TABLE `software_language_multi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_price`
--
ALTER TABLE `software_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_price_log`
--
ALTER TABLE `software_price_log`
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
-- AUTO_INCREMENT for table `agent_client`
--
ALTER TABLE `agent_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `agent_contact`
--
ALTER TABLE `agent_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `agent_contact_by`
--
ALTER TABLE `agent_contact_by`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `agent_id`
--
ALTER TABLE `agent_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent_list`
--
ALTER TABLE `agent_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `agent_note`
--
ALTER TABLE `agent_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `agent_selling_product_list`
--
ALTER TABLE `agent_selling_product_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satt_admins`
--
ALTER TABLE `satt_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `satt_customer_business_type`
--
ALTER TABLE `satt_customer_business_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `satt_customer_informations`
--
ALTER TABLE `satt_customer_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `satt_customer_interestedservice`
--
ALTER TABLE `satt_customer_interestedservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `satt_customer_notes`
--
ALTER TABLE `satt_customer_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `satt_customer_progres`
--
ALTER TABLE `satt_customer_progres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `satt_customer_type`
--
ALTER TABLE `satt_customer_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `satt_extra_interested_service`
--
ALTER TABLE `satt_extra_interested_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `satt_extra_office_notes`
--
ALTER TABLE `satt_extra_office_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `satt_extra__software_category`
--
ALTER TABLE `satt_extra__software_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `satt_interested_services`
--
ALTER TABLE `satt_interested_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `satt_leave_reason`
--
ALTER TABLE `satt_leave_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `satt_message`
--
ALTER TABLE `satt_message`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `satt_message_type`
--
ALTER TABLE `satt_message_type`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `satt_official_notes`
--
ALTER TABLE `satt_official_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `satt_users`
--
ALTER TABLE `satt_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sat_software_category`
--
ALTER TABLE `sat_software_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `software_details`
--
ALTER TABLE `software_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `software_develope_by`
--
ALTER TABLE `software_develope_by`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `software_language`
--
ALTER TABLE `software_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `software_language_multi`
--
ALTER TABLE `software_language_multi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `software_price`
--
ALTER TABLE `software_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `software_price_log`
--
ALTER TABLE `software_price_log`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `software_status`
--
ALTER TABLE `software_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
