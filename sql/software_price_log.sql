-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2019 at 02:17 PM
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
(1, 'shohag', 7, 'gfsd', '42', '4562', '2456', '2546', '4562', '4562', '2456', '2456', '4526'),
(2, 'shohag', 7, 'dddddddddddddd', '42', '4562', '2456', '2546', '4562', '4562', '2456', '2456', '4526'),
(3, 'shohag', 7, 'tazbinur', '42', '4562', '2456', '2546', '4562', '4562', '2456', '2456', '4526'),
(4, 'shohag', 7, 'http://www.google.com', '42', '4562', '2456', '2546', '4562', '4562', '2456', '2456', '4526');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `software_price_log`
--
ALTER TABLE `software_price_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `software_price_log`
--
ALTER TABLE `software_price_log`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
