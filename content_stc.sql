-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 08, 2021 at 11:26 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `content_stc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `banner` text NOT NULL,
  `link` text DEFAULT NULL,
  `qr_code` text DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`id`, `title`, `description`, `banner`, `link`, `qr_code`, `is_deleted`, `created_at`, `updated_at`) VALUES
(5, 'test', 'test test test', '800px_COLOURBOX4200269.jpg', 'http://www.stc.com.sa', '3123', 1, '2021-09-08 08:58:00', NULL),
(6, 'test 3423', 'qweqwe', '2267608bc68f3b190ab27b1c8f9889b9.jpg', 'http://www.stc.com.sa', 'qweqwe', 0, '2021-09-08 09:00:52', NULL),
(7, 'test', 'fdsfffsdfdsfd', '', 'fdfdfdfdfdfd', 'fsdfsfdsfdsf', 1, '2021-09-08 09:05:30', NULL),
(8, 'new', 'new 435345', '8905d21a91f524d3f7ffb43c3504f04c.png', 'http://www.stc.com.sa', '343434', 0, '2021-09-08 09:08:18', NULL),
(9, 'weqwq', 'wqdewqe', '', 'http://www.stc.com.sa', '', 0, '2021-09-08 09:25:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
