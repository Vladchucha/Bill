-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2024 at 07:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_header`
--

CREATE TABLE `bill_header` (
  `id` int(10) NOT NULL,
  `id_carriers` int(3) NOT NULL,
  `1d_users` int(3) NOT NULL,
  `bill_number` int(6) NOT NULL COMMENT 'bill_number+id_user+year is unique.',
  `year` int(4) NOT NULL COMMENT 'User can insert, update.',
  `month` text DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `pdf` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_header`
--

INSERT INTO `bill_header` (`id`, `id_carriers`, `1d_users`, `bill_number`, `year`, `month`, `date_created`, `pdf`) VALUES
(24, 7, 32, 23, 2024, '', '2024-09-29 00:00:00', 0),
(25, 8, 32, 24, 2024, '', '2024-09-29 00:00:00', 0),
(26, 7, 32, 25, 2024, '', '2024-09-29 00:00:00', 0),
(27, 7, 32, 26, 2024, '', '2024-09-29 00:00:00', 0),
(28, 7, 32, 27, 2024, '', '2024-10-01 00:00:00', 0),
(29, 7, 32, 28, 2024, '', '2024-10-01 00:00:00', 0),
(30, 8, 32, 29, 2024, 'Mai', '2024-10-01 00:00:00', 0),
(31, 7, 32, 30, 2024, '', '2024-10-01 00:00:00', 0),
(32, 7, 32, 31, 2024, '', '2024-10-01 00:00:00', 0),
(33, 7, 32, 32, 2024, '', '2024-10-01 00:00:00', 0),
(43, 7, 32, 1, 2025, '', '2024-10-03 00:00:00', 0),
(44, 7, 32, 42, 2024, '', '2024-10-03 00:00:00', 0),
(45, 7, 32, 43, 2024, '', '2024-10-03 00:00:00', 0),
(46, 7, 32, 44, 2024, 'Mai', '2024-10-03 00:00:00', 0),
(47, 7, 32, 45, 2024, '', '2024-10-03 00:00:00', 0),
(48, 10, 33, 1, 2024, 'September', '2024-10-03 22:17:46', 0),
(49, 9, 33, 2, 2024, '', '2024-10-03 22:22:39', 0),
(50, 10, 33, 3, 2024, '', '2024-10-03 22:27:21', 0),
(51, 9, 33, 4, 2024, '', '2024-10-03 22:28:54', 0),
(52, 9, 33, 5, 2024, 'mia', '2024-10-03 22:54:44', 0),
(53, 9, 33, 6, 2024, 'mai', '2024-10-03 23:11:13', 0),
(54, 9, 33, 7, 2024, '', '2024-10-03 23:59:33', 0),
(55, 9, 33, 8, 2024, '', '2024-10-04 00:00:06', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_header`
--
ALTER TABLE `bill_header`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_header`
--
ALTER TABLE `bill_header`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
