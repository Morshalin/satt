-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2019 at 02:40 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

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
(5, 'simple', 'How are you?', 'i am fine', 'it\'s still developing', '01728091199', 'hellow, how are you?', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `satt_message`
--
ALTER TABLE `satt_message`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `satt_message`
--
ALTER TABLE `satt_message`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
