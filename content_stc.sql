-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2021 at 12:27 PM
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
  `user_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `banner` text NOT NULL,
  `link` text DEFAULT NULL,
  `qr_code` text DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 for publish, 2 for draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`id`, `user_id`, `title`, `description`, `banner`, `link`, `qr_code`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 'test', 'test test test', '800px_COLOURBOX4200269.jpg', 'http://www.stc.com.sa', '3123', 1, 0, '2021-09-08 08:58:00', NULL),
(6, 1, 'test 3423', 'qweqwe', '878800px_COLOURBOX4200269.jpg', 'http://www.stc.com.sa', 'qweqwe', 1, 2, '2021-09-08 09:00:52', NULL),
(7, 1, 'test', 'fdsfffsdfdsfd', '', 'fdfdfdfdfdfd', 'fsdfsfdsfdsf', 1, 0, '2021-09-08 09:05:30', NULL),
(8, 1, 'new', 'new 435345', '', 'http://www.stc.com.sa', '343434', 1, 1, '2021-09-08 09:08:18', NULL),
(9, 1, 'weqwq', 'wqdewqe', '', 'http://www.stc.com.sa', '', 1, 1, '2021-09-08 09:25:39', NULL),
(10, 1, 'new', 'new 435345', '6875c5014acdd102a6c36b506ad_1548752044003.jpg', 'http://www.stc.com.sa', '343434', 1, 1, '2021-09-18 05:44:28', NULL),
(11, 1, 'new', 'new', '', 'http://www.stc.com.sa', '343434', 1, 2, '2021-09-18 06:41:52', NULL),
(12, 1, 'test', 'test', '9762267608bc68f3b190ab27b1c8f9889b9.jpg', 'test', 'test567', 0, 2, '2021-09-18 06:43:36', NULL),
(13, 1, 'test 123', 'test 123', '817800px_COLOURBOX4200269.jpg', 'http://www.stc.com.sa', '34frtt', 0, 1, '2021-09-18 09:43:02', NULL),
(14, 1, 'new', 'new', '8415c5014acdd102a6c36b506ad_1548752044003.jpg', 'http://www.stc.com.sa', '3242354356456', 0, 1, '2021-09-18 09:59:51', NULL),
(15, 2, 'testweqweqwe', 'wwewqeq', '', 'wqeqweqwe', 'wqeqwe', 0, 1, '2021-09-18 10:20:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `profile_image` text NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 2,
  `permission` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `fullname`, `email`, `password`, `profile_image`, `role`, `permission`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123', '', 1, 'Add,Update,Delete,View', 1, 0, '2021-09-18 04:08:59', '2021-09-18 06:08:34'),
(2, 'sojitra vaibhavi', 'sojitravaibhavi@gmail.com', '25d55ad283aa400af464c76d713c07ad', '338mario_PNG53.png', 2, 'Add,Delete,View', 1, 0, '2021-09-17 09:00:24', NULL),
(3, 'test', 'test@gmail.com', '25d55ad283aa400af464c76d713c07ad', '970883216f191c8b4089e8d074073cd6911.jpg', 2, 'Add,Update,View', 0, 0, '2021-09-17 12:19:27', NULL),
(6, 'test test', 'test123@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', 2, 'Add,Update,View', 1, 1, '2021-09-18 09:46:43', NULL),
(7, 'test test', 'test123@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', 2, 'View', 1, 1, '2021-09-18 09:50:49', NULL),
(8, 'test 123', 'test123@gmail.com', '25d55ad283aa400af464c76d713c07ad', '145800px_COLOURBOX4200269.jpg', 2, 'Add,Update,View', 1, 1, '2021-09-18 09:56:31', NULL),
(9, 'test 123', 'test123@gmail.com', '25d55ad283aa400af464c76d713c07ad', '7163de15302858656e5b98759cbd6c0da08.jpg', 2, 'Add,Delete,View', 1, 0, '2021-09-18 09:59:21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
