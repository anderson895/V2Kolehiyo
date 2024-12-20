-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 03:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(60) NOT NULL,
  `admin_username` varchar(60) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=disable, 1=enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `admin_status`) VALUES
(1, 'Juan Admin', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `home_sec` text NOT NULL,
  `about_me` text NOT NULL,
  `about_me_p` text NOT NULL,
  `about_me_img` varchar(255) NOT NULL,
  `proj_img1` varchar(255) NOT NULL,
  `proj_img1_p` text NOT NULL,
  `proj_img2` varchar(255) NOT NULL,
  `proj_img2_p` text NOT NULL,
  `proj_img3` varchar(255) NOT NULL,
  `proj_img3_p` text NOT NULL,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `user_name`, `password`, `home_sec`, `about_me`, `about_me_p`, `about_me_img`, `proj_img1`, `proj_img1_p`, `proj_img2`, `proj_img2_p`, `proj_img3`, `proj_img3_p`, `profile_picture`) VALUES
(1, 'joshua', 'joshua', 'home_sec content here ss', 'about_me Content here ...', 'about_me_p Content here ...', '672b9036f9585e08077d65a5737198e6.jpg', 'images (5).jpeg', 'Project 1 Description here', 'images (6).jpeg', 'Project 2 Description here', '../upload/67640814f3e69.png', 'Project 3 Description here', '../upload/676406cabf41f.jpg'),
(9, 'test', 'test', 'test', 'test', 'test', '../upload/676421e6f4045.jpg', '../upload/676421fd4a1db.jpg', 's1', '../upload/676421f53e7f9.jpg', 's2', '../upload/676421f53eb95.jpg', 's1', '../upload/6764230d9bb2b.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
