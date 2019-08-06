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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `software_price`
--
ALTER TABLE `software_price`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `software_price`
--
ALTER TABLE `software_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
