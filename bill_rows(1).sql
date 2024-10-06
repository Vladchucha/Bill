-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2024 at 07:29 PM
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
-- Table structure for table `bill_rows`
--

CREATE TABLE `bill_rows` (
  `id` int(6) NOT NULL,
  `id_bill_header` int(6) NOT NULL COMMENT 'id_bill_header and item_number together are uniq key',
  `item_number` int(8) NOT NULL COMMENT 'in the one bill number from 1 and uniq in the one bill',
  `item_work` varchar(60) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  `amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_rows`
--

INSERT INTO `bill_rows` (`id`, `id_bill_header`, `item_number`, `item_work`, `price`, `quantity`, `amount`) VALUES
(21, 19, 1, 'www', 22, 2, 44),
(22, 19, 2, 'www1', 33, 3, 99),
(23, 44, 1, 'nnn', 2, 5, 10),
(24, 44, 2, 'ttt', 6, 45, 270),
(25, 45, 1, 'nnnn', 12, 50, 600),
(26, 45, 2, 'mm', 12, 3, 36),
(27, 45, 3, 'lll', 12, 1, 12),
(28, 47, 1, 'vv', 2, 34, 68),
(29, 47, 2, 'rrrrrr', 23, 45, 1035),
(30, 48, 1, 'Tour 2346', 45, 20, 900),
(31, 48, 2, 'Tour 3499', 25, 10, 250),
(32, 50, 1, 'ugfjfj', 55, 2, 110),
(33, 50, 2, 'tryty', 55, 4, 220),
(34, 51, 1, 'kkk', 44, 4, 176),
(35, 51, 2, 'uuu', 66, 2, 132),
(36, 52, 1, 'wwww2', 12, 2, 24),
(37, 52, 2, 'www34', 45, 1, 45),
(38, 52, 3, 'www34', 45, 1, 45),
(39, 53, 1, 'erte', 4, 4, 16),
(40, 53, 2, 'fgffgh', 34, 4, 136),
(41, 55, 1, 'rttyryrtyrtyrtyryryrtry', 44, 4, 176);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_rows`
--
ALTER TABLE `bill_rows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `item` (`item_number`,`id_bill_header`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_rows`
--
ALTER TABLE `bill_rows`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
