-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 03:53 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

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
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `ID` int(11) NOT NULL,
  `FacultyID` int(12) NOT NULL,
  `office` varchar(200) NOT NULL,
  `timein_am` datetime DEFAULT NULL,
  `timeout_am` datetime DEFAULT NULL,
  `timein_pm` datetime DEFAULT NULL,
  `timeout_pm` datetime DEFAULT NULL,
  `date_log` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`ID`, `FacultyID`, `office`, `timein_am`, `timeout_am`, `timein_pm`, `timeout_pm`, `date_log`, `date_updated`) VALUES
(1, 57, 'DTR', '2024-04-15 08:55:43', NULL, NULL, '2024-04-15 17:20:00', '2024-04-15 19:07:06', '2024-03-11 19:07:06'),
(2, 57, 'DTR', NULL, NULL, '2024-04-16 13:35:00', '2024-04-16 18:35:00', '2024-04-16 12:07:06', '2024-03-07 12:07:06'),
(3, 57, 'DTR', '2024-04-17 10:15:00', '2024-04-17 11:37:03', NULL, NULL, '2024-04-17 09:33:13', '2024-03-13 09:33:13'),
(4, 57, 'DTR', '2024-04-18 08:00:00', NULL, NULL, '2024-03-14 17:30:00', '2024-04-18 09:33:13', '2024-03-14 09:33:13'),
(5, 57, 'DTR', '2024-04-19 07:55:00', NULL, NULL, '2024-03-15 17:25:35', '2024-04-19 00:00:00', '2024-03-08 02:37:35'),
(6, 57, 'DTR', '2024-04-20 00:00:00', NULL, NULL, '2024-03-16 17:15:00', '2024-04-20 00:00:00', '2024-03-16 10:20:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
