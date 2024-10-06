-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2024 at 07:27 PM
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
-- Table structure for table `bill_bottom`
--

CREATE TABLE `bill_bottom` (
  `id_bill_head` int(6) NOT NULL,
  `sum_netto` decimal(10,0) NOT NULL,
  `vat` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `comment` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_bottom`
--

INSERT INTO `bill_bottom` (`id_bill_head`, `sum_netto`, `vat`, `total`, `comment`) VALUES
(10, 0, 0, 0, NULL),
(11, 0, 0, 0, NULL),
(42, 0, 0, 0, NULL),
(19, 0, 0, 0, NULL),
(44, 280, 53, 333, NULL),
(45, 648, 123, 771, NULL),
(47, 1103, 210, 1313, NULL),
(48, 1150, 219, 1369, NULL),
(50, 330, 63, 393, NULL),
(51, 308, 59, 367, NULL),
(52, 69, 13, 82, NULL),
(53, 152, 29, 181, NULL),
(53, 152, 29, 181, NULL),
(55, 176, 33, 209, NULL),
(55, 176, 33, 209, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
