-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2024 at 07:31 PM
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
-- Table structure for table `carriers`
--

CREATE TABLE `carriers` (
  `id` mediumint(9) NOT NULL,
  `id_users` int(5) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telephon` varchar(30) DEFAULT NULL,
  `time_record` datetime NOT NULL,
  `comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='all firmen for bills';

--
-- Dumping data for table `carriers`
--

INSERT INTO `carriers` (`id`, `id_users`, `name`, `address`, `email`, `telephon`, `time_record`, `comment`) VALUES
(7, 32, 'Berthold', 'Land', 'fffdfgdfg@web.de', '3536543635', '2024-09-22 22:02:42', ''),
(8, 32, 'Govosi', 'gfdrtgwerg', 'dffz@wer.de', 'telfo456456', '2024-09-22 22:06:09', '456456'),
(9, 33, 'Wild', 'popenstrasse 23', 'fff@web.de', '34343', '2024-10-03 22:15:32', ''),
(10, 33, 'Berthold', 'Dorf', 'peter@web.de', '22222', '2024-10-03 22:16:28', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carriers`
--
ALTER TABLE `carriers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carriers`
--
ALTER TABLE `carriers`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
