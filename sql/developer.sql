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
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `bio` longtext DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`id`, `name`, `email`, `mobile_no`, `image`, `address`, `bio`, `facebook`, `twitter`, `linkedin`, `instagram`, `status`) VALUES
(1, 'Kanak Debnath', 'kanakdebnath826@gmail.com', '01767515963', 'image/e786436c33.jpg', 'kumarpara, Rajshahi', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit alias recusandae harum eum obcaecati sunt vitae sequi veritatis tempore vel?', 'www.facebook.com/kanaksatt', 'https://twitter.com/kanakdebnath9', 'https://www.linkedin.com/in/kanak-debnath-a0b146141/', 'https://www.instagram.com/debnath_kanak/', 1),
(2, 'Abul Khair Sohag', 'abulkhairsohag@gmail.com', '01753474401', 'image/009bf8a95b.jpg', 'Saheb bazar,Rajshai', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit nostrum blanditiis recusandae laboriosam tempore, obcaecati ducimus vel amet. Optio, quaerat.', 'https://www.facebook.com/abul.khair.sohag', 'w', 'w', 'w', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
