-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2018 at 01:52 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone_number` int(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `model` varchar(150) NOT NULL,
  `chassis_number` varchar(150) NOT NULL,
  `part_description` text NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `model` varchar(30) NOT NULL,
  `drive_date` varchar(30) NOT NULL,
  `drive_time` varchar(10) NOT NULL,
  `comments` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_id` int(24) DEFAULT NULL,
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` mediumtext NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(15) NOT NULL,
  `event_image` varchar(150) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` varchar(55) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_detail`
--

CREATE TABLE `event_detail` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(50) NOT NULL,
  `lang` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(2) NOT NULL,
  `language` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `language`) VALUES
(1, 'English'),
(2, 'Arabic');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news_image` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news_detail`
--

CREATE TABLE `news_detail` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `lang` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `offers_image` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offers_detail`
--

CREATE TABLE `offers_detail` (
  `id` int(11) NOT NULL,
  `offers_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `lang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(24) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `qid` varchar(50) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `vehicle` varchar(50) NOT NULL,
  `year_of_make` varchar(30) NOT NULL,
  `chassis_number` varchar(50) NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `t_shirt_size` varchar(25) NOT NULL,
  `number` varchar(150) NOT NULL,
  `gender` varchar(30) NOT NULL DEFAULT 'Male',
  `profile_pic` varchar(255) NOT NULL,
  `registered_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL,
  `account_status` tinyint(1) NOT NULL,
  `email_confirmed` tinyint(1) NOT NULL,
  `activation_hash` varchar(32) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `password_reset_hash` varchar(32) NOT NULL,
  `user_role` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `last_name`, `qid`, `user_name`, `email`, `password`, `vehicle`, `year_of_make`, `chassis_number`, `registration_number`, `t_shirt_size`, `number`, `gender`, `profile_pic`, `registered_on`, `modified_on`, `account_status`, `email_confirmed`, `activation_hash`, `pass`, `password_reset_hash`, `user_role`, `is_deleted`) VALUES
(1, 'Admin', '', '1212', '', 'admin@clubqatar.com', 'e10adc3949ba59abbe56e057f20f883e', 'BMW', '2018', '3232', '23232', '', '', 'Male', '1525345169.jpg', '2018-04-11 09:36:18', '0000-00-00 00:00:00', 0, 0, '', '', '', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`),
  ADD KEY `user_id_fk_ci_sessions` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_detail`
--
ALTER TABLE `event_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_detail`
--
ALTER TABLE `news_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `lang` (`lang`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers_detail`
--
ALTER TABLE `offers_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_id` (`offers_id`),
  ADD KEY `lang` (`lang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_role_idx` (`user_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `event_detail`
--
ALTER TABLE `event_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `news_detail`
--
ALTER TABLE `news_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `offers_detail`
--
ALTER TABLE `offers_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_detail`
--
ALTER TABLE `event_detail`
  ADD CONSTRAINT `event_detail_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_detail`
--
ALTER TABLE `news_detail`
  ADD CONSTRAINT `news_detail_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offers_detail`
--
ALTER TABLE `offers_detail`
  ADD CONSTRAINT `offers_detail_ibfk_1` FOREIGN KEY (`offers_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
