-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 20, 2023 at 07:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hourly_pay`
--

-- --------------------------------------------------------

--
-- Table structure for table `hourly_tracker`
--

CREATE TABLE `hourly_tracker` (
  `id` int(50) NOT NULL,
  `work_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `hour_worked` double NOT NULL,
  `user_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hourly_tracker`
--

INSERT INTO `hourly_tracker` (`id`, `work_date`, `start_time`, `end_time`, `hour_worked`, `user_id`) VALUES
(53, '2023-06-22', '20:18:00', '17:18:00', 21, 0),
(54, '2023-06-13', '20:22:00', '22:22:00', 2, 0),
(55, '2023-06-29', '19:22:00', '08:22:00', 13, 0),
(56, '2023-06-14', '20:23:00', '16:27:00', 20.066666666666666, 0),
(57, '2023-06-22', '20:23:00', '21:23:00', 1, 9),
(58, '2023-06-28', '20:24:00', '01:24:00', 5, 0),
(59, '2023-06-08', '21:24:00', '22:24:00', 1, 8),
(60, '2023-06-19', '16:53:00', '21:49:00', 4.933333333333334, 0),
(61, '2023-06-15', '21:35:00', '23:35:00', 2, 15),
(62, '2023-06-22', '22:37:00', '04:37:00', 6, 8),
(65, '2023-06-22', '23:50:00', '18:53:00', 19.05, 16),
(66, '2023-06-15', '19:30:00', '12:27:00', 16.95, 8),
(67, '2023-06-15', '10:29:00', '23:32:00', 13.05, 8),
(68, '2023-06-28', '23:30:00', '23:30:00', 0, 8),
(69, '2023-06-16', '19:35:00', '23:31:00', 3.933333333333333, 17),
(70, '2023-06-29', '20:54:00', '23:54:00', 3, 8),
(71, '2023-06-15', '00:51:00', '23:46:00', 22.916666666666668, 8),
(81, '2023-06-01', '02:17:00', '12:21:00', 10.066666666666666, 18),
(86, '2023-06-16', '00:11:00', '16:11:00', 16, 14),
(87, '2023-06-14', '00:22:00', '06:22:00', 6, 19),
(88, '2023-06-09', '23:22:00', '11:22:00', 12, 19),
(89, '2023-07-12', '02:45:00', '12:30:00', 9.75, 20),
(90, '2023-07-29', '12:30:00', '08:30:00', 20, 21),
(91, '2023-07-29', '02:30:00', '12:30:00', 10, 21),
(92, '2023-07-30', '07:30:00', '05:30:00', 22, 21),
(93, '2023-07-31', '04:30:00', '14:50:00', 10.333333333333334, 21),
(95, '2023-08-16', '16:51:00', '02:54:00', 10.05, 22),
(97, '2023-08-22', '18:49:00', '19:55:00', 1.1, 22),
(98, '2023-08-23', '18:50:00', '20:51:00', 2.0166666666666666, 22);

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id` int(50) NOT NULL,
  `name` varchar(60) NOT NULL,
  `phone` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `organization` varchar(120) NOT NULL,
  `rate` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hourly_tracker`
--
ALTER TABLE `hourly_tracker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hourly_tracker`
--
ALTER TABLE `hourly_tracker`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
