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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Name of Firma',
  `address` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `iban` char(20) NOT NULL DEFAULT 'NO' COMMENT 'YES - man muss News-Letter senden',
  `taxNumber` varchar(20) NOT NULL,
  `registr_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `email`, `password`, `iban`, `taxNumber`, `registr_date`) VALUES
(31, 'Test6', 'erferf', 'vladar6@e-mail.de', '$2y$10$RgksgCMRw06HgHL3Ac0YIuVlNGmw8aS2Q16YJfpyLFkg/NUUzX3Gm', 'ergfergf', 'ergfergf', '2024-09-16 22:39:56'),
(32, 'Chucha', 'rthyrfth', 'vladar9@e-mail.de', '$2y$10$1quLZPjDuyX.cRoJCKuKYOrri7rGhYnwDq5xuaJjCnyWkqpMDxndW', '456456456', '54645645654', '2024-09-18 17:38:35'),
(33, 'Filip', 'Gudrinstrasse 28 90459 Nuernberg', 'filip@web.de', '$2y$10$eOJXWYvZKXwr/pXJPQNoguEHUMXEdOqIXj7sNm8u3/c75rmPZRNFe', '456456456465', '240/345/92888', '2024-10-03 22:13:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `uc_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
