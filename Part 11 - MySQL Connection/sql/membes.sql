-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2024 at 11:23 PM
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
-- Database: `membes`
--
CREATE DATABASE IF NOT EXISTS `membes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `membes`;

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_type` text NOT NULL,
  `source` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`transaction_id`, `user_id`, `activity_type`, `source`, `date`) VALUES
(1, 19, 'udp', '', 1727860370),
(2, 19, 'login', '', 1727860912),
(3, 19, 'login', 'login.php', 1727868855),
(4, 19, 'failed_login', 'login.php', 1727868959),
(5, 19, 'success_login', 'login.php', 1727868988),
(6, 19, 'failed_login', 'login.php', 1727868998),
(7, 19, 'success_login', 'login.php', 1727869033),
(8, 19, 'success_login', 'login.php', 1727869114),
(9, 19, 'profile_update', 'updater.php', 1727869119),
(10, 19, 'profile_update', 'updater.php', 1727870147),
(11, 19, 'success_login', 'login.php', 1727870605),
(12, 19, 'success_login', 'login.php', 1727871550);

-- --------------------------------------------------------

--
-- Table structure for table `mem`
--

CREATE TABLE `mem` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `signup` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mem`
--

INSERT INTO `mem` (`userid`, `username`, `password`, `fname`, `sname`, `email`, `signup`) VALUES
(19, 'james', '$2y$10$WXmtrWOOL89BgzH0CJkO6eG/N8hYsTLR64uQnpI/U7C.ve7NXZ31S', 'James', 'Barowik', 'barowikajames@gmail.com.com', '2024-10-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mem`
--
ALTER TABLE `mem`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mem`
--
ALTER TABLE `mem`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD CONSTRAINT `audit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `mem` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
