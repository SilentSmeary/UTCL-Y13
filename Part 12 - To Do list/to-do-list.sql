-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2024 at 09:53 PM
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
-- Database: `to-do-list`
--
CREATE DATABASE IF NOT EXISTS `to-do-list` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `to-do-list`;

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `audit_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `source` text NOT NULL,
  `definition` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`audit_id`, `user_id`, `source`, `definition`, `date`) VALUES
(1, 1, 'login.php', 'success_login', 1729589485),
(2, 1, 'login.php', 'failed_login', 1729589856),
(3, 2, 'login.php', 'success_login', 1729594186),
(4, 1, 'login.php', 'success_login', 1729596013),
(5, 1, 'login.php', 'success_login', 1729596100),
(6, 1, 'login.php', 'success_login', 1729597326),
(7, 1, 'login.php', 'success_login', 1729597447),
(8, 1, 'login.php', 'success_login', 1729597763),
(9, 1, 'login.php', 'success_login', 1729598748),
(10, 1, 'login.php', 'success_login', 1729601394),
(11, 1, 'login.php', 'success_login', 1729602141),
(12, 1, 'login.php', 'success_login', 1729602499),
(13, 1, 'create_a_list.php', 'create_a_list', 1729603609),
(14, 1, 'login.php', 'success_login', 1729673132),
(15, 1, 'create_a_list.php', 'create_a_list', 1729674478),
(16, 1, 'create_a_list.php', 'create_a_list', 1729674501),
(17, 1, 'create_a_list.php', 'create_a_list', 1729674515),
(18, 1, 'create_a_list.php', 'create_a_list', 1729674547),
(19, 1, 'create_a_list.php', 'create_a_list', 1729674987),
(20, 1, 'create_a_list.php', 'create_a_list', 1729684274),
(21, 1, 'create_a_list.php', 'create_a_list', 1729759459);

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `lists_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `list_name` text NOT NULL,
  `list_description` text DEFAULT NULL,
  `list_date_creation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`lists_id`, `user_id`, `list_name`, `list_description`, `list_date_creation`) VALUES
(1, 1, 'To Do List', 'List Description', 1729603437),
(2, 1, 'New', 'List', 1729603609),
(3, 1, 'New List', 'Created a new list', 1729674478),
(4, 1, 'New List', 'Created a new list', 1729674501),
(5, 1, 'Created a new list', 'Created a new list', 1729674515),
(6, 1, 'Jack witney', 'plenty of stuff to do', 1729674547),
(7, 1, 'New List', 'New List', 1729674987),
(8, 1, 'To Do List', 'To Do List', 1729684274),
(9, 1, 'This is a to do list', 'This is also a new to do list', 1729759459);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `sign_up_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `sign_up_date`) VALUES
(1, 'James', 'Barowik', 'barowikajames@gmail.com', '$2y$10$TmNgZmL49Zn96Re4lJUR9uVwwDfR1TP9BKc7xwpTFKHSFO/9/qFEa', 1729585871),
(2, 'Bob', 'Bobby', 'bob@bob.com', '$2y$10$nCLt20ICmP6l9ND16FzsOulpFM2zSgCixH3GWOaK6J1FC71gzz1Ae', 1729594108);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`audit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`lists_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `audit_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `lists_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD CONSTRAINT `audit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
