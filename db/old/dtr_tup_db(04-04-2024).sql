-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 03:17 AM
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
-- Table structure for table `tbl_acknowledged`
--

CREATE TABLE `tbl_acknowledged` (
  `ID` int(11) NOT NULL,
  `FacultyID` int(12) NOT NULL,
  `Schedule` varchar(50) NOT NULL,
  `Acknowledged` smallint(2) NOT NULL,
  `Date_Acknowledged` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_acknowledged`
--

INSERT INTO `tbl_acknowledged` (`ID`, `FacultyID`, `Schedule`, `Acknowledged`, `Date_Acknowledged`) VALUES
(1, 1, 'Mar 11, 2024 - Mar 16, 2024', 1, '2024-03-08 14:51:23'),
(2, 1, 'Mar 11, 2024 - Mar 16, 2024', 1, '2024-03-08 15:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE `tbl_departments` (
  `ID` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`ID`, `department_name`, `status`) VALUES
(1, 'ECE', 'Active'),
(2, 'ME', 'Active'),
(3, 'BSET', 'Active'),
(4, 'COAC', 'Active'),
(5, 'CHEM', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dtr`
--

CREATE TABLE `tbl_dtr` (
  `ID` int(11) NOT NULL,
  `Faculty_id` int(11) NOT NULL,
  `Date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dtr`
--

INSERT INTO `tbl_dtr` (`ID`, `Faculty_id`, `Date_time`) VALUES
(1, 44, '0000-00-00 00:00:00'),
(2, 44, '0000-00-00 00:00:00'),
(3, 44, '2024-02-02 15:18:12'),
(12, 1, '2024-02-03 12:33:09'),
(13, 1, '2024-02-03 12:46:07'),
(14, 1, '2024-02-12 09:54:08'),
(15, 1, '2024-02-12 09:54:09'),
(16, 1, '2024-02-12 10:09:55'),
(17, 1, '2024-02-12 10:10:20'),
(18, 1, '2024-02-12 10:10:21'),
(20, 1, '2024-02-12 14:50:49'),
(21, 1, '2024-02-12 14:55:04'),
(22, 1, '2024-02-12 14:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file_attachment`
--

CREATE TABLE `tbl_file_attachment` (
  `ID` int(11) NOT NULL,
  `FacultyID` int(12) NOT NULL,
  `Concern_Type` varchar(50) NOT NULL,
  `Date_Uploaded` date NOT NULL,
  `Filename` varchar(50) NOT NULL,
  `verified` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_file_attachment`
--

INSERT INTO `tbl_file_attachment` (`ID`, `FacultyID`, `Concern_Type`, `Date_Uploaded`, `Filename`, `verified`) VALUES
(1, 57, 'Sick Leave with Medical Certificate', '2024-03-21', '57_2024-03-21_65edb139ef6d2.pdf', '1'),
(2, 55, 'TESTING', '2024-03-11', '55_2024-03-11_65ede243a89c2.jpg', '0'),
(3, 55, 'DOCX', '2024-03-11', '55_2024-03-11_65ede2dc4230d.docx', '0');

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
(1, 55, 'DTR', '2024-03-11 07:30:06', '2024-03-11 12:00:00', '2024-03-11 13:30:00', '2024-03-11 17:30:00', '2024-03-11 19:07:06', '2024-03-11 19:07:06'),
(2, 55, 'DTR', '2024-03-12 07:40:00', '2024-03-12 12:30:00', '2024-03-07 13:00:00', '2024-03-07 14:40:00', '2024-03-12 12:07:06', '2024-03-07 12:07:06'),
(3, 55, 'DTR', '2024-03-13 08:00:00', '2024-03-13 12:30:00', NULL, '2024-03-08 17:41:27', '2024-03-13 09:33:13', '2024-03-13 09:33:13'),
(4, 55, 'DTR', '2024-03-14 08:30:00', '2024-03-14 11:30:00', NULL, '2024-03-14 17:33:13', '2024-03-14 09:33:13', '2024-03-14 09:33:13'),
(5, 55, 'DTR', '2024-03-15 09:25:35', '2024-03-15 12:30:00', '2024-03-15 13:37:35', '2024-03-15 17:25:35', '2024-03-15 00:00:00', '2024-03-08 02:37:35'),
(6, 55, 'DTR', '2024-03-16 10:00:00', '2024-03-16 12:00:00', '2024-03-16 13:00:00', '2024-03-16 17:34:00', '2024-03-16 00:00:00', '2024-03-16 10:20:13');

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
  `time_frame` varchar(20) DEFAULT NULL,
  `Start_time` time DEFAULT NULL,
  `End_time` time DEFAULT NULL,
  `Active` varchar(10) NOT NULL DEFAULT '1 '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`ID`, `Faculty_id`, `Room`, `Subject`, `Day`, `Date`, `time_frame`, `Start_time`, `End_time`, `Active`) VALUES
(1, '57', 'ROOM 5', 'SOLID MENSURATION', 'monday', '2024-03-26', 'AM', '08:15:00', '11:45:00', '1 '),
(2, '57', 'ROOM 3', 'GEN MATH', 'monday', '2024-03-26', 'PM', '13:15:00', '16:45:00', '1 '),
(3, '57', 'DRAFTING ROOM 2', 'ENGINEERING DRAWING', 'tuesday', '2024-03-26', 'AM', '09:45:00', '12:00:00', '1 '),
(4, '57', 'WELING AREA 3', 'SHIELDED METAL ARC WELDING', 'tuesday', '2024-03-26', 'PM', '14:15:00', '17:00:00', '1 ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `ID` int(50) NOT NULL,
  `Subject_name` varchar(255) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `Department` varchar(50) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`ID`, `Subject_name`, `color`, `Department`, `Active`) VALUES
(1, 'MECHANICAL PRINCIPLES 1', '#F50606', '2', 1),
(2, 'LATHE MACHINING 1', '#474747', '3', 1),
(3, 'ADVANCE CALCULUS', '#3EF3BF', '1', 1),
(5, 'Test Subject', '#25F539', '5', 1),
(6, 'Test 3', '#8A4A4A', '3', 1),
(7, 'Test 4', '#FFE702', '2', 1),
(8, 'Test 5', '#4472E3', '5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `ID` int(11) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Mname` varchar(255) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Rank` varchar(255) NOT NULL,
  `Sex` varchar(255) NOT NULL,
  `Faculty_number` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Salt` varchar(255) NOT NULL,
  `U_ID` varchar(255) NOT NULL,
  `User_type` varchar(255) NOT NULL,
  `Active` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Suffix` varchar(255) NOT NULL,
  `Age` int(255) NOT NULL,
  `Contact_Number` varchar(255) NOT NULL,
  `Estatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`ID`, `Fname`, `Lname`, `Mname`, `Department`, `Rank`, `Sex`, `Faculty_number`, `Username`, `Password`, `Salt`, `U_ID`, `User_type`, `Active`, `Address`, `Suffix`, `Age`, `Contact_Number`, `Estatus`) VALUES
(55, 'user', 'admin', 'account', 'ECE', 'N/A', 'Male', '15566865423', 'admin_user', '01a9f3940de07123ec59eaa1f919b0bcab40ea17', '@&w$oPZt)2hNt~$5KyS1>tmh@N7eY11Js36PzA*Ix1*^VR5yHj', '6964317b4b6650e7121e1d37d4ea3ad72732083b:10e20c45a076cf0b61172838f2f4a8af59eb2beb:78f9d528dc091d65c5909b5c212b30ba98426d1a1', 'admin', 0, '', '', 69, '0', 'Single'),
(57, 'user', 'faculty', 'account', 'COAC', 'N/A', 'Male', '00000000', 'faculty_user', 'bab45ecb2fa544909e20681cca059611ed90aa8a', '<5$U1>%4xv16ML@fsziWoq5uAjMI6>6huoiO$gs(1S\\VL1JlE4', 'e6d20a93fe67e2ba53a377a7176e20596ae4fa1c:3b35ebaee8c7b6a348b13957ce73594027f0013a:59359d001d83d08a856733381abe70c211249df71', 'faculty', 0, '', '', 56, '13200200212', 'Married'),
(58, 'user', 'HR', 'account', 'BSET', 'N/A', 'Female', '00000000', 'hr_user', 'a8942f9ce2029aec5b2166d75e12995f8bb19cd4', 'DTnnW<sOu#(1$Wn2n$Pr3f3.)81Q#Yl%W$I(n74oOcXGigg/Dq', '3d5c622e67ed5d38c5ccbe845d6be9368e74bec0:c47930d6f0d3d2354eb16dd6a7beb40987a36345:80725c89e359b2ecbc79b4dd6e686ed3c3ad6e181', 'HR', 0, '', '', 945, '13200200212', 'Married');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_acknowledged`
--
ALTER TABLE `tbl_acknowledged`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_dtr`
--
ALTER TABLE `tbl_dtr`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_file_attachment`
--
ALTER TABLE `tbl_file_attachment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_acknowledged`
--
ALTER TABLE `tbl_acknowledged`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_dtr`
--
ALTER TABLE `tbl_dtr`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_file_attachment`
--
ALTER TABLE `tbl_file_attachment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
