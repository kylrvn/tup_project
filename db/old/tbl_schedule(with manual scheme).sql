-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 05:25 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtr_tup_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `ID` int(11) NOT NULL,
  `Faculty_id` varchar(50) NOT NULL,
  `Room` varchar(50) NOT NULL,
  `Subject` varchar(255) DEFAULT NULL,
  `Day` varchar(50) NOT NULL,
  `Date` date DEFAULT current_timestamp(),
  `school_year` varchar(50) DEFAULT NULL,
  `school_term` varchar(50) DEFAULT NULL,
  `time_frame` varchar(20) DEFAULT NULL,
  `Start_time` time DEFAULT NULL,
  `End_time` time DEFAULT NULL,
  `scheme` int(50) DEFAULT NULL,
  `Active` varchar(10) NOT NULL DEFAULT '1 '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`ID`, `Faculty_id`, `Room`, `Subject`, `Day`, `Date`, `school_year`, `school_term`, `time_frame`, `Start_time`, `End_time`, `scheme`, `Active`) VALUES
(1, '59', 'Test Room 2', '1', 'monday', '2024-04-12', '2023 to 2024', '1st', 'AM', '08:45:00', '12:00:00', NULL, '1 '),
(2, '59', 'Test Room', 'ADVANCE CALCULUS', 'monday', '2024-04-12', '2023 to 2024', '1st', 'PM', '13:15:00', '17:00:00', NULL, '1 '),
(3, '59', 'Test', 'LATHE MACHINING 1', 'wednesday', '2024-04-12', '2023 to 2024', '1st', 'AM', '09:45:00', '11:45:00', NULL, '1 '),
(4, '59', 'Test', 'Test Subject', 'wednesday', '2024-04-12', '2023 to 2024', '1st', 'PM', '14:15:00', '16:45:00', NULL, '1 '),
(5, '57', 'Test Room', '2', 'monday', '2024-04-13', '2023 to 2024', '1st', 'AM', '08:15:00', '12:00:00', NULL, '1 '),
(6, '57', 'Test Room', '3', 'monday', '2024-04-13', '2023 to 2024', '1st', 'PM', '13:45:00', '17:15:00', NULL, '1 '),
(7, '57', 'Test Room', '5', 'tuesday', '2024-04-13', '2023 to 2024', '1st', 'AM', '09:45:00', '11:45:00', NULL, '1 '),
(8, '57', 'Test Room', '6', 'tuesday', '2024-04-13', '2023 to 2024', '1st', 'PM', '14:15:00', '16:15:00', NULL, '1 '),
(9, '57', 'Test Room', '8', 'wednesday', '2024-04-13', '2023 to 2024', '1st', 'AM', '10:15:00', '12:00:00', NULL, '1 '),
(10, '57', 'Test Room', '7', 'wednesday', '2024-04-13', '2023 to 2024', '1st', 'PM', '15:00:00', '17:45:00', NULL, '1 '),
(11, '57', 'Test Room', '5', 'thursday', '2024-04-13', '2023 to 2024', '1st', 'AM', '08:00:00', '11:30:00', NULL, '1 '),
(12, '57', 'Test Room', '2', 'thursday', '2024-04-13', '2023 to 2024', '1st', 'PM', '14:45:00', '17:30:00', NULL, '1 '),
(13, '57', 'Test Room', '3', 'friday', '2024-04-13', '2023 to 2024', '1st', 'AM', '07:45:00', '10:45:00', NULL, '1 '),
(14, '57', 'Test Room', '5', 'friday', '2024-04-13', '2023 to 2024', '1st', 'PM', '14:00:00', '17:15:00', NULL, '1 '),
(15, '55', 'ehhh', '2', 'monday', '2024-04-21', '2023 to 2024', '3rd', 'AM', '08:15:00', '00:00:00', 6, '1 '),
(16, '55', 'sdfgdsf', '3', 'monday', '2024-04-21', '2023 to 2024', '3rd', 'PM', '13:45:00', '17:15:00', 6, '1 '),
(17, '55', 'dhbdfggb', '3', 'tuesday', '2024-04-21', '2023 to 2024', '3rd', 'AM', '09:15:00', '12:00:00', 4, '1 '),
(18, '55', '324543564', '7', 'tuesday', '2024-04-21', '2023 to 2024', '3rd', 'PM', '13:00:00', '17:00:00', 4, '1 '),
(19, '55', '23454356', '8', 'wednesday', '2024-04-21', '2023 to 2024', '3rd', 'AM', '08:45:00', '10:15:00', 5, '1 '),
(20, '55', '45674567', '8', 'wednesday', '2024-04-21', '2023 to 2024', '3rd', 'PM', '13:45:00', '16:45:00', 5, '1 '),
(21, '55', '5e675476', '5', 'thursday', '2024-04-21', '2023 to 2024', '3rd', 'AM', '08:30:00', '11:30:00', 6, '1 '),
(22, '55', '5647457', '5', 'thursday', '2024-04-21', '2023 to 2024', '3rd', 'PM', '13:15:00', '15:30:00', 6, '1 '),
(23, '55', '4563546', '3', 'friday', '2024-04-21', '2023 to 2024', '3rd', 'AM', '10:45:00', '12:00:00', 3, '1 '),
(24, '55', '364536', '5', 'friday', '2024-04-21', '2023 to 2024', '3rd', 'PM', '14:15:00', '17:15:00', 3, '1 ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
