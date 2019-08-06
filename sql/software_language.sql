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
-- Table structure for table `software_language`
--

CREATE TABLE `software_language` (
  `id` int(11) NOT NULL,
  `software_language_name` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `software_language`
--
ALTER TABLE `software_language`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `software_language`
--
ALTER TABLE `software_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
