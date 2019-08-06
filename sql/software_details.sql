-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2019 at 07:55 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

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
  `condition_details` text DEFAULT NULL,
  `customer_question` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_details`
--

INSERT INTO `software_details` (`id`, `software_name`, `software_status_name`, `software_status_id`, `create_date`, `end_date`, `update_date`, `short_feature`, `user_manual`, `condition_details`, `customer_question`, `status`) VALUES
(6, 'Inventory', 'Bug fIxing mode', 7, '2019-07-31 18:00:00', '2019-08-09 18:00:00', NULL, 'fsgvgss', 'ggcgss', 'sggsdsd', NULL, 1),
(7, 'shg', 'Bug fIxing mode', 7, '2019-08-04 18:00:00', '2019-08-23 18:00:00', NULL, 'fd', 'gfssgfd', 'fdgfgfsd', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `software_details`
--
ALTER TABLE `software_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `software_details`
--
ALTER TABLE `software_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
