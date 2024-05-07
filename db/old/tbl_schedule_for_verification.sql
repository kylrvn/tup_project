-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 04:50 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

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
-- Table structure for table `tbl_schedule_for_verification`
--

CREATE TABLE `tbl_schedule_for_verification` (
  `ID` int(11) NOT NULL,
  `facultyID` varchar(20) DEFAULT NULL,
  `dateSubmitted` date DEFAULT current_timestamp(),
  `schoolYear` varchar(50) DEFAULT NULL,
  `schoolTerm` varchar(50) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `edited` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_schedule_for_verification`
--

INSERT INTO `tbl_schedule_for_verification` (`ID`, `facultyID`, `dateSubmitted`, `schoolYear`, `schoolTerm`, `verified`, `edited`) VALUES
(1, '57', '2024-04-22', '2023 to 2024', '1st', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_schedule_for_verification`
--
ALTER TABLE `tbl_schedule_for_verification`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_schedule_for_verification`
--
ALTER TABLE `tbl_schedule_for_verification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
