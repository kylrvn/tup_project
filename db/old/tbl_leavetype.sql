-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2024 at 04:48 AM
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
-- Table structure for table `tbl_leavetype`
--

CREATE TABLE `tbl_leavetype` (
  `ID` int(11) NOT NULL,
  `LeaveType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_leavetype`
--

INSERT INTO `tbl_leavetype` (`ID`, `LeaveType`) VALUES
(1, 'Vacation Leave'),
(2, 'Mandatory/Forced Leave'),
(3, 'Sick Leave'),
(4, 'Maternity Leave'),
(5, 'Paternity Leave'),
(6, 'Special Privilege Leave'),
(7, 'Solo Parent Leave'),
(8, 'Study Leave'),
(9, '10-Day VAWC Leave'),
(10, 'Rehabilitation Privilige'),
(11, 'Special Benefits for Women'),
(12, 'Special Emergency (Calamity) Leave'),
(13, 'Adoption Leave');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_leavetype`
--
ALTER TABLE `tbl_leavetype`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_leavetype`
--
ALTER TABLE `tbl_leavetype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
