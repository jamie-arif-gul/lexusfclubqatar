-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2018 at 02:40 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yasir_fclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gallery_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `gallery_image`) VALUES
(10, '1528458173.jpg'),
(11, '1528458175.jpg'),
(22, '1528459385.jpg'),
(23, '1528459430.jpg'),
(24, '1528459432.jpg'),
(25, '1528459434.jpg'),
(26, '1528459437.jpg'),
(27, '1528459440.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_detail`
--

CREATE TABLE `gallery_detail` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `lang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_detail`
--

INSERT INTO `gallery_detail` (`id`, `gallery_id`, `title`, `description`, `lang`) VALUES
(5, 10, 'gallery Title', 'Description', 1),
(6, 10, 'عنوان صالات العرض', 'وصف', 2),
(7, 11, 'gallery Title', 'Description', 1),
(8, 11, 'عنوان صالات العرض', 'وصف', 2),
(29, 22, 'title', 'description', 1),
(30, 22, 'عنوان صالات العرض', 'وصف', 2),
(31, 23, 'title', 'description', 1),
(32, 23, 'عنوان صالات العرض', 'وصف', 2),
(33, 24, 'title', 'description', 1),
(34, 24, 'عنوان صالات العرض', 'وصف', 2),
(35, 25, 'title', 'description', 1),
(36, 25, 'عنوان صالات العرض', 'وصف', 2),
(37, 26, 'title', 'description', 1),
(38, 26, 'عنوان صالات العرض', 'وصف', 2),
(39, 27, 'title', 'description', 1),
(40, 27, 'عنوان صالات العرض', 'وصف', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_detail`
--
ALTER TABLE `gallery_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `gallery_detail`
--
ALTER TABLE `gallery_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
