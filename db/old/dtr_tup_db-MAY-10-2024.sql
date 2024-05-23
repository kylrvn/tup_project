-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 01:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
  `ForVerif` tinyint(1) NOT NULL DEFAULT 0,
  `ForVerifStatus` tinyint(1) NOT NULL DEFAULT 0,
  `ForVerifReason` varchar(255) DEFAULT NULL,
  `Date_Acknowledged` datetime NOT NULL DEFAULT current_timestamp(),
  `school_term` varchar(50) NOT NULL,
  `school_year` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_acknowledged`
--

INSERT INTO `tbl_acknowledged` (`ID`, `FacultyID`, `Schedule`, `Acknowledged`, `ForVerif`, `ForVerifStatus`, `ForVerifReason`, `Date_Acknowledged`, `school_term`, `school_year`) VALUES
(1, 1, 'Mar 11, 2024 - Mar 16, 2024', 1, 0, 0, NULL, '2024-03-08 14:51:23', '1st', '2023 to 2024'),
(2, 57, 'Mar 11, 2024 - Mar 16, 2024', 1, 1, 0, 'TESTING', '2024-03-08 15:18:38', '1st', '2023 to 2024'),
(3, 55, 'Mar 11, 2024 - Mar 16, 2024', 1, 1, 1, 'ESSSSSS', '2024-03-08 15:18:38', '1st', '2023 to 2024'),
(4, 57, 'Apr 15, 2024 - Apr 20, 2024', 1, 0, 0, NULL, '2024-04-20 09:42:54', '1st', '2023 to 2024');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_active_term`
--

CREATE TABLE `tbl_active_term` (
  `ID` int(11) NOT NULL,
  `active_term` varchar(50) DEFAULT NULL,
  `active_school_year` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_active_term`
--

INSERT INTO `tbl_active_term` (`ID`, `active_term`, `active_school_year`) VALUES
(1, '3rd', '2023 to 2024');

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
-- Table structure for table `tbl_exam_schedule`
--

CREATE TABLE `tbl_exam_schedule` (
  `ID` int(11) NOT NULL,
  `faculty_id` varchar(50) DEFAULT NULL,
  `department_id` varchar(50) DEFAULT NULL,
  `term` varchar(20) DEFAULT NULL,
  `school_year` varchar(20) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_exam_schedule`
--

INSERT INTO `tbl_exam_schedule` (`ID`, `faculty_id`, `department_id`, `term`, `school_year`, `from_date`, `to_date`) VALUES
(1, '55', '1', '1st', '2023 to 2024', '2024-04-14', '2024-04-20'),
(2, '60', '1', '2nd', '2023 to 2024', '2024-04-23', '2024-04-25'),
(3, '60', '1', '3rd', '2023 to 2024', '2024-05-14', '2024-05-23'),
(4, '55', '1', '2nd', '2023 to 2024', '2024-04-15', '2024-04-20');

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
  `verified` varchar(10) NOT NULL DEFAULT '0',
  `Remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_file_attachment`
--

INSERT INTO `tbl_file_attachment` (`ID`, `FacultyID`, `Concern_Type`, `Date_Uploaded`, `Filename`, `verified`, `Remarks`) VALUES
(1, 57, 'Sick Leave with Medical Certificate', '2024-03-21', '57_2024-03-21_65edb139ef6d2.pdf', '1', NULL),
(2, 55, 'TESTING', '2024-03-11', '55_2024-03-11_65ede243a89c2.jpg', '0', NULL),
(3, 55, 'DOCX', '2024-03-20', '55_2024-03-11_65ede2dc4230d.docx', '1', NULL);

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
(1, 57, 'DTR', '2024-03-11 07:30:06', '2024-03-11 12:00:00', '2024-03-11 13:30:00', '2024-03-11 17:30:00', '2024-03-11 19:07:06', '2024-03-11 19:07:06'),
(2, 57, 'DTR', '2024-03-12 07:40:00', '2024-03-12 12:30:00', '2024-03-07 13:00:00', '2024-03-07 14:40:00', '2024-03-12 12:07:06', '2024-03-07 12:07:06'),
(3, 57, 'DTR', '2024-03-13 08:00:00', '2024-03-13 12:30:00', NULL, '2024-03-08 17:41:27', '2024-03-13 09:33:13', '2024-03-13 09:33:13'),
(4, 57, 'DTR', '2024-03-14 08:30:00', '2024-03-14 11:30:00', NULL, '2024-03-14 17:33:13', '2024-03-14 09:33:13', '2024-03-14 09:33:13'),
(5, 57, 'DTR', '2024-03-15 09:25:35', '2024-03-15 12:30:00', '2024-03-15 13:37:35', '2024-03-15 17:25:35', '2024-03-15 00:00:00', '2024-03-08 02:37:35'),
(6, 57, 'DTR', '2024-03-16 10:00:00', '2024-03-16 12:00:00', '2024-03-16 13:00:00', '2024-03-16 17:34:00', '2024-03-16 00:00:00', '2024-03-16 10:20:13'),
(8, 61, 'DTR', '2024-03-16 10:00:00', '2024-03-16 12:00:00', '2024-03-16 13:00:00', '2024-03-16 17:34:00', '2024-03-16 00:00:00', '2024-03-16 10:20:13'),
(9, 62, 'DTR', '2024-04-15 07:00:00', NULL, NULL, '2024-04-15 16:00:00', '2024-04-15 01:00:00', '2024-04-15 23:20:13'),
(10, 62, 'DTR', '2024-04-16 07:15:00', NULL, NULL, '2024-04-16 17:45:00', '2024-04-16 01:00:00', '2024-04-16 23:20:13'),
(11, 62, 'DTR', '2024-04-15 07:00:00', NULL, NULL, '2024-04-15 16:00:00', '2024-04-15 01:00:00', '2024-04-15 23:20:13'),
(12, 62, 'DTR', '2024-04-16 08:00:00', NULL, NULL, '2024-04-16 17:00:00', '2024-04-16 01:00:00', '2024-04-16 23:20:13'),
(13, 62, 'DTR', '2024-04-17 07:15:00', NULL, NULL, '2024-04-17 16:45:00', '2024-04-17 01:00:00', '2024-04-17 23:20:13'),
(14, 62, 'DTR', '2024-04-18 09:00:00', NULL, NULL, '2024-04-18 16:00:00', '2024-04-18 01:00:00', '2024-04-18 23:20:13'),
(15, 62, 'DTR', '2024-04-19 10:00:00', NULL, NULL, '2024-04-19 14:00:00', '2024-04-19 01:00:00', '2024-04-19 23:20:13'),
(16, 62, '', NULL, NULL, '2024-05-08 16:06:59', '2024-05-08 16:07:21', '2024-05-08 16:06:59', '2024-05-08 16:07:21'),
(17, 62, '', '2024-04-22 08:00:00', '2024-04-22 12:00:00', '2024-04-22 13:00:00', '2024-04-22 16:45:00', '2024-04-22 16:06:59', '2024-04-22 16:07:21'),
(18, 62, '', '2024-04-23 08:00:00', '2024-04-23 12:00:00', '2024-04-23 13:00:00', '2024-04-23 13:30:00', '2024-04-23 16:06:59', '2024-04-23 16:07:21'),
(19, 62, '', '2024-04-24 09:00:00', '2024-04-24 12:00:00', '2024-04-24 13:00:00', '2024-04-24 13:30:00', '2024-04-24 16:45:59', '2024-04-24 16:07:21'),
(20, 62, '', '2024-04-25 07:00:00', NULL, NULL, '2024-04-25 16:45:00', '2024-04-25 16:45:59', '2024-04-25 16:07:21'),
(21, 62, '', '2024-04-26 09:00:00', '2024-04-26 11:00:00', NULL, NULL, '2024-04-26 15:15:46', '2024-04-26 15:15:46'),
(22, 62, '', '2024-04-10 08:00:00', '2024-04-10 12:00:00', '2024-04-10 13:00:00', '2024-04-10 13:30:00', '2024-04-10 18:00:00', '2024-04-10 16:07:21'),
(23, 62, '', '2024-04-11 08:00:00', NULL, NULL, '2024-04-11 16:45:00', '2024-04-11 16:45:59', '2024-04-11 16:07:21'),
(24, 62, '', '2024-04-12 08:00:00', '2024-04-12 11:00:00', NULL, NULL, '2024-04-12 15:15:46', '2024-04-12 15:15:46'),
(25, 62, '', '2024-04-05 08:00:00', '2024-04-05 12:00:00', NULL, NULL, '2024-04-05 15:15:46', '2024-04-05 15:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_non_working_days`
--

CREATE TABLE `tbl_non_working_days` (
  `ID` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qr`
--

CREATE TABLE `tbl_qr` (
  `ID` int(11) NOT NULL,
  `fID` int(11) NOT NULL,
  `qr` varchar(50) NOT NULL,
  `Date_Generated` datetime NOT NULL DEFAULT current_timestamp(),
  `Generated_By` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_qr`
--

INSERT INTO `tbl_qr` (`ID`, `fID`, `qr`, `Date_Generated`, `Generated_By`) VALUES
(1, 57, '3096110302771554567164347363257', '2024-05-08 15:41:15', NULL),
(2, 62, '4998144054387960852733795505162', '2024-05-08 15:41:15', NULL),
(3, 63, '3514911354584325588927747184863', '2024-05-08 15:41:15', NULL),
(4, 64, '9060906806562624046244173292364', '2024-05-08 15:41:15', NULL),
(5, 65, '4904803957972339429498368212965', '2024-05-08 15:41:15', NULL),
(6, 66, '5697921585144633280987604058166', '2024-05-08 15:41:15', NULL),
(7, 67, '9011700035702877756909033979667', '2024-05-08 15:41:15', NULL),
(8, 68, '6716604417786364100284507374268', '2024-05-08 15:41:15', NULL),
(9, 69, '4668199231711099214291103890769', '2024-05-08 15:41:15', NULL),
(10, 70, '6897237942162173351573320713570', '2024-05-08 15:41:15', NULL),
(11, 71, '3838702974625612668834109255171', '2024-05-08 15:41:15', NULL),
(12, 72, '0616887129042839586796879943272', '2024-05-08 15:41:15', NULL),
(13, 73, '8680319631405933585114023802873', '2024-05-08 15:41:15', NULL),
(14, 74, '9773242818174390572045150629474', '2024-05-08 15:41:15', NULL),
(15, 75, '8911315085364414205960687829875', '2024-05-08 15:41:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ranks`
--

CREATE TABLE `tbl_ranks` (
  `ID` int(11) NOT NULL,
  `rankName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ranks`
--

INSERT INTO `tbl_ranks` (`ID`, `rankName`) VALUES
(1, 'PROFESSOR I'),
(2, 'ASSOCIATE PROF. V'),
(3, 'ASSOCIATE PROF. IV'),
(4, 'ASSOCIATE PROF. III'),
(5, 'ASSOCIATE PROF. II'),
(6, 'ASSOCIATE PROF. I'),
(7, 'ASSISTANT PROF. IV'),
(8, 'ASSISTANT PROF. III'),
(9, 'ASSISTANT PROF. II'),
(10, 'ASSISTANT PROF. I'),
(11, 'INSTRUCTOR III'),
(12, 'INSTRUCTOR II'),
(13, 'INSTRUCTOR I'),
(14, 'DIRECTOR II'),
(15, 'CHIEF ADMIN OFFICER'),
(16, 'ACCOUNTANT III'),
(17, 'ADMIN OFFICER V'),
(18, 'ADMIN OFFICER IV'),
(19, 'ADMIN OFFICER III'),
(20, 'ADMIN OFFICER II'),
(21, 'ADMIN OFFICER I'),
(22, 'ADMIN ASSISTANT III'),
(23, 'ADMIN ASSISTANT II'),
(24, 'ADMIN ASSISTANT I'),
(25, 'ADMIN AIDE VI'),
(26, 'ADMIN AIDE V'),
(27, 'ADMIN AIDE IV'),
(28, 'ADMIN AIDE III'),
(29, 'ADMIN AIDE II'),
(30, 'ADMIN AIDE I'),
(31, 'PLANNING OFFICER IV'),
(32, 'SR. SCIENCE RESEARCH SPECIALIST'),
(33, 'SCIENCE RESEARCH SPECIALIST II'),
(34, 'SCIENCE RESEARCH ANALYST'),
(35, 'COLLEGE LIBRARIAN III'),
(36, 'COLLEGE LIBRARIAN II'),
(37, 'COLLEGE LIBRARIAN I'),
(38, 'MEDICAL OFFICER III'),
(39, 'DENTIST II'),
(40, 'NURSE II'),
(41, 'NURSING ATTENDANT I'),
(42, 'REGISTRAR III'),
(43, 'GUIDANCE COORDINATOR III');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `ID` int(11) NOT NULL,
  `Faculty_id` varchar(50) NOT NULL,
  `Room` varchar(50) NOT NULL,
  `Subject` varchar(255) DEFAULT NULL,
  `Section` varchar(255) DEFAULT NULL,
  `Day` varchar(50) NOT NULL,
  `Date` date DEFAULT current_timestamp(),
  `school_year` varchar(50) DEFAULT NULL,
  `school_term` varchar(50) DEFAULT NULL,
  `time_frame` varchar(20) DEFAULT NULL,
  `Start_time` time DEFAULT NULL,
  `End_time` time DEFAULT NULL,
  `scheme` int(50) DEFAULT NULL,
  `Active` varchar(10) NOT NULL DEFAULT '1 '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`ID`, `Faculty_id`, `Room`, `Subject`, `Section`, `Day`, `Date`, `school_year`, `school_term`, `time_frame`, `Start_time`, `End_time`, `scheme`, `Active`) VALUES
(1, '59', 'Test Room 2', '1', 'ECE 2A', 'monday', '2024-04-12', '2023 to 2024', '1st', 'AM', '08:45:00', '12:00:00', NULL, '1 '),
(2, '59', 'Test Room', 'ADVANCE CALCULUS', 'ECE 2A', 'monday', '2024-04-12', '2023 to 2024', '1st', 'PM', '13:15:00', '17:00:00', NULL, '1 '),
(3, '59', 'Test', 'LATHE MACHINING 1', 'ECE 2A', 'wednesday', '2024-04-12', '2023 to 2024', '1st', 'AM', '09:45:00', '11:45:00', NULL, '1 '),
(4, '59', 'Test', 'Test Subject', 'ECE 2A', 'wednesday', '2024-04-12', '2023 to 2024', '1st', 'PM', '14:15:00', '16:45:00', NULL, '1 '),
(5, '57', 'Test Room', '2', 'ECE 2A', 'monday', '2024-04-13', '2023 to 2024', '1st', 'AM', '08:15:00', '12:00:00', NULL, '1 '),
(6, '57', 'Test Room', '3', 'ECE 2A', 'monday', '2024-04-13', '2023 to 2024', '1st', 'PM', '13:45:00', '17:15:00', NULL, '1 '),
(7, '57', 'Test Room', '5', 'ECE 2A', 'tuesday', '2024-04-13', '2023 to 2024', '1st', 'AM', '09:45:00', '11:45:00', NULL, '1 '),
(8, '57', 'Test Room', '6', 'ECE 2A', 'tuesday', '2024-04-13', '2023 to 2024', '1st', 'PM', '14:15:00', '16:15:00', NULL, '1 '),
(9, '57', 'Test Room', '8', 'ECE 2A', 'wednesday', '2024-04-13', '2023 to 2024', '1st', 'AM', '10:15:00', '12:00:00', NULL, '1 '),
(10, '57', 'Test Room', '7', 'ECE 2A', 'wednesday', '2024-04-13', '2023 to 2024', '1st', 'PM', '15:00:00', '17:45:00', NULL, '1 '),
(11, '57', 'Test Room', '5', 'ECE 2A', 'thursday', '2024-04-13', '2023 to 2024', '1st', 'AM', '08:00:00', '11:30:00', NULL, '1 '),
(12, '57', 'Test Room', '2', 'ECE 2A', 'thursday', '2024-04-13', '2023 to 2024', '1st', 'PM', '14:45:00', '17:30:00', NULL, '1 '),
(13, '57', 'Test Room', '3', 'ECE 2A', 'friday', '2024-04-13', '2023 to 2024', '1st', 'AM', '08:45:00', '10:45:00', NULL, '1 '),
(14, '57', 'Test Room', '5', 'ECE 2A', 'friday', '2024-04-13', '2023 to 2024', '1st', 'PM', '14:00:00', '17:15:00', NULL, '1 '),
(15, '55', 'ehhh', '2', 'ECE 2A', 'monday', '2024-04-21', '2023 to 2024', '3rd', 'AM', '08:15:00', '00:00:00', 6, '1 '),
(16, '55', 'sdfgdsf', '3', 'ECE 2A', 'monday', '2024-04-21', '2023 to 2024', '3rd', 'PM', '13:45:00', '17:15:00', 6, '1 '),
(17, '55', 'dhbdfggb', '3', 'ECE 2A', 'tuesday', '2024-04-21', '2023 to 2024', '3rd', 'AM', '09:15:00', '12:00:00', 4, '1 '),
(18, '55', '324543564', '7', 'ECE 2A', 'tuesday', '2024-04-21', '2023 to 2024', '3rd', 'PM', '13:00:00', '17:00:00', 4, '1 '),
(19, '55', '23454356', '8', 'ECE 2A', 'wednesday', '2024-04-21', '2023 to 2024', '3rd', 'AM', '08:45:00', '10:15:00', 5, '1 '),
(20, '55', '45674567', '8', 'ECE 2A', 'wednesday', '2024-04-21', '2023 to 2024', '3rd', 'PM', '13:45:00', '16:45:00', 5, '1 '),
(21, '55', '5e675476', '5', 'ECE 2A', 'thursday', '2024-04-21', '2023 to 2024', '3rd', 'AM', '08:30:00', '11:30:00', 6, '1 '),
(22, '55', '5647457', '5', 'ECE 2A', 'thursday', '2024-04-21', '2023 to 2024', '3rd', 'PM', '13:15:00', '15:30:00', 6, '1 '),
(23, '55', '4563546', '3', 'ECE 2A', 'friday', '2024-04-21', '2023 to 2024', '3rd', 'AM', '10:45:00', '12:00:00', 3, '1 '),
(24, '55', '364536', '5', 'ECE 2A', 'friday', '2024-04-21', '2023 to 2024', '3rd', 'PM', '14:15:00', '17:15:00', 3, '1 '),
(31, '62', '31', '4', 'ME TIME', 'monday', '2024-05-08', '2023 to 2024', '3rd', 'AM', '08:00:00', '08:15:00', 5, '1 '),
(32, '62', 'ECEWS', '2', 'ECE-2A', 'monday', '2024-05-08', '2023 to 2024', '3rd', 'AM', '08:15:00', '12:00:00', 0, '1 '),
(33, '62', 'ECEWS', '1', 'ECE-2C', 'monday', '2024-05-08', '2023 to 2024', '3rd', 'PM', '13:00:00', '16:45:00', 0, '1 '),
(34, '62', 'ECEWS', '1', 'ECE2B', 'tuesday', '2024-05-08', '2023 to 2024', '3rd', 'AM', '08:15:00', '12:00:00', 5, '1 '),
(35, '62', 'NEB6', '3', 'ECE4B', 'tuesday', '2024-05-08', '2023 to 2024', '3rd', 'PM', '13:00:00', '16:45:00', 0, '1 '),
(36, '62', '31', '4', 'ECE4', 'wednesday', '2024-05-08', '2023 to 2024', '3rd', 'AM', '08:00:00', '08:15:00', 5, '1 '),
(37, '62', 'ECEWS', '2', 'ECE2A', 'wednesday', '2024-05-08', '2023 to 2024', '3rd', 'AM', '08:15:00', '12:00:00', 0, '1 '),
(38, '62', 'ECEWS', '1', 'ECE2C', 'wednesday', '2024-05-08', '2023 to 2024', '3rd', 'PM', '13:00:00', '16:45:00', 0, '1 '),
(39, '62', '31', '4', '12', 'thursday', '2024-05-08', '2023 to 2024', '3rd', 'AM', '08:00:00', '08:15:00', 6, '1 '),
(40, '62', 'ECEWS', '1', 'ECE2B', 'thursday', '2024-05-08', '2023 to 2024', '3rd', 'AM', '08:15:00', '12:00:00', 6, '1 '),
(41, '62', 'ECE LAB 1', '3', 'ECE4C', 'thursday', '2024-05-08', '2023 to 2024', '3rd', 'PM', '13:00:00', '16:45:00', 0, '1 '),
(42, '62', '31', '4', '43', 'friday', '2024-05-08', '2023 to 2024', '3rd', 'AM', '08:00:00', '08:15:00', 4, '1 '),
(43, '62', 'NEB 4', '3', 'ECE4A', 'friday', '2024-05-08', '2023 to 2024', '3rd', 'AM', '08:15:00', '12:00:00', 0, '1 ');

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
(1, '57', '2024-04-22', '2023 to 2024', '1st', 0, 0),
(6, '62', '2024-05-08', '2023 to 2024', '3rd', 1, 0),
(7, '62', '2024-05-08', '2023 to 2024', '3rd', 1, 0),
(8, '62', '2024-05-08', '2023 to 2024', '3rd', 1, 0),
(9, '62', '2024-05-08', '2023 to 2024', '3rd', 1, 0),
(10, '62', '2024-05-08', '2023 to 2024', '3rd', 1, 0),
(11, '62', '2024-05-08', '2023 to 2024', '3rd', 1, 0),
(12, '62', '2024-05-08', '2023 to 2024', '3rd', 1, 0),
(13, '62', '2024-05-08', '2023 to 2024', '3rd', 1, 0),
(14, '62', '2024-05-08', '2023 to 2024', '3rd', 1, 0),
(15, '62', '2024-05-08', '2023 to 2024', '3rd', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `ID` int(50) NOT NULL,
  `Subject_name` varchar(255) NOT NULL,
  `subject_code` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `Department` varchar(50) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`ID`, `Subject_name`, `subject_code`, `color`, `Department`, `Active`) VALUES
(1, 'Electronics Engineering Tech. Practice 1 ', 'ECE222', '#0D45F0', '1', 1),
(2, 'Electronics Engineering Tech. Practice 2 ', 'ECE232', '#0D0FF4', '1', 1),
(3, 'Seminars/Colloquium ', 'ECE431', '#090BF2', '1', 1),
(4, 'Must Time ', 'Must time', '#EA6330', '1', 1),
(5, 'LPT', 'LPT', '#0C5FC8', '1', 1),
(6, 'Consultation Time', 'Consultation Time', '#F8FF53', '1', 1),
(7, 'Staff Duty ', 'Staff Duty ', '#E41723', '1', 1),
(8, 'Research Duty', 'Research Duty', '#CF17E4', '1', 1),
(9, 'ADVANCE CALCULUS', 'da', '#914747', '1', 1);

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
  `Faculty_number` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Salt` varchar(255) NOT NULL,
  `U_ID` varchar(255) NOT NULL,
  `User_type` varchar(255) NOT NULL,
  `Active` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Suffix` varchar(255) NOT NULL,
  `Contact_Number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`ID`, `Fname`, `Lname`, `Mname`, `Department`, `Rank`, `Faculty_number`, `Username`, `Password`, `Salt`, `U_ID`, `User_type`, `Active`, `Address`, `Suffix`, `Contact_Number`) VALUES
(55, 'user', 'admin', 'account', '1', 'N/A', '15566865423', 'admin_user', '01a9f3940de07123ec59eaa1f919b0bcab40ea17', '@&w$oPZt)2hNt~$5KyS1>tmh@N7eY11Js36PzA*Ix1*^VR5yHj', '6964317b4b6650e7121e1d37d4ea3ad72732083b:10e20c45a076cf0b61172838f2f4a8af59eb2beb:78f9d528dc091d65c5909b5c212b30ba98426d1a1', '4', 0, '', '', '0'),
(57, 'user', 'faculty', 'account', '4', 'N/A', '00000000', 'faculty_user', 'bab45ecb2fa544909e20681cca059611ed90aa8a', '<5$U1>%4xv16ML@fsziWoq5uAjMI6>6huoiO$gs(1S\\VL1JlE4', 'e6d20a93fe67e2ba53a377a7176e20596ae4fa1c:3b35ebaee8c7b6a348b13957ce73594027f0013a:59359d001d83d08a856733381abe70c211249df71', '1', 0, '', '', '13200200212'),
(58, 'user', 'HR', 'account', '3', 'N/A', '00000000', 'hr_user', 'a8942f9ce2029aec5b2166d75e12995f8bb19cd4', 'DTnnW<sOu#(1$Wn2n$Pr3f3.)81Q#Yl%W$I(n74oOcXGigg/Dq', '3d5c622e67ed5d38c5ccbe845d6be9368e74bec0:c47930d6f0d3d2354eb16dd6a7beb40987a36345:80725c89e359b2ecbc79b4dd6e686ed3c3ad6e181', '3', 0, '', '', '13200200212'),
(60, 'PROGRAM HEAD', 'ECE', 'TEST', '1', 'CAPTAIN', '246453232', 'ece_program_head', '13ccde845f423aa448978941e27056c0bfb3654f', '#Y)o6QY%1d4Q$2?LeVw!ktTY#)Kc&gZJ@J3!4kxw\\s$4iEVz?1', '936d179b7263acbb21f3b1841862f91256e8fca0:2e36b5c2213d72966428c187a0e2e17bb761598a:9546a798e1a6e6319918e0675326fc9eea04ed0a1', '2', 0, 'Test Address', 'ENGR', '15554884'),
(61, 'Renato', 'Deldo', 'C', '1', '11', '01', 'RDeldo', '6c192656c8074ed4e2a5f9666c174154c3602055', 'x1Y0EU#)8ho5wImHpdZ8L#6THusfM%8\\eAfXwtw@hi/U<LJB11', '326619d3856cf6b053d3df07e5d825e8bb601fc7:06247f0b107a5b212f3bb1531d7d5933e46701c1:482b1c4d439400b0450da1e222f2747fa1c73b581', '2', 0, 'Bacolod City', '', '09500321588'),
(62, 'Marian', 'Abalajon', 'T. ', '1', '11', '02', 'MAbalajon', '21cfb2cb5cf426161e407cce00e9a742b7bbcae3', 'Hs.%sMDG(d#ek4(8bA5)E0\\Nk%xvMg@X?1b$6LXy^1NX19/83d', '11205dddfa29e09a80b23d536e13259c2674a1c5:70f47fff4014a4d874934e51086903cf864f37f2:dfa5064da679a8a17689eba9c249cc4918c3a3371', '1', 0, 'Negros Occidental', '', '099999999'),
(63, 'May Ricciel', 'Benitez', 'Rubrico', '1', '11', '03', 'MBenitez', '120cdd1f211a8adf0b9ca82da736067bb0df49d2', 'P6b7PeSytFX<!l9$>X*LVOVNB5CRFWkC1kmsp<^^.a9Dn4%$21', 'e1586d48f253149c7020f7eb8f726f297ffa327f:dd9ab4533984c5de60bea319cb5533dad3c955ce:63fd445a32adcc2d5420bd78c7790332662739211', '1', 0, 'Negros Occidental', '', '099999999'),
(64, 'Shallel', 'Billones', 'Galope', '1', '11', '04', 'SBillones', '2d7708a67a46ad1b4b6e770431ff9fe45eece169', 'O2\\P&IbdZ/Cq1QBZmMFDN^~J~f1~Z%e$?>~StqMJe946?ORvo?', 'bf1832108824bfaee14b29b364f83c32c0306ac2:0689fe2c38672cf11329da8bc8c2f4f730416f1d:77938be578b008c264e85ec3052f942f621b3cf41', '1', 0, 'Negros Occidental', '', '0999999'),
(65, 'Alexander', 'Diamante', 'Torres', '1', '11', '05', 'ADiamante', 'ce28d303d5367b20dfc895186fc0c098dfb55de3', 'Pce@LO$b\\ZP29x$yS(JcTcp1%m*H2HFqYC%F2Bb>aAwK\\5f#>x', '33cb0a0bda504514ef4ea83d5448ec3e5a081f13:814152ae9f73964c44dc2ee2c12b45491067e36d:fc79f9893ef547f74612414daae2b7988d0618c41', '1', 0, 'Negros Occidental', 'Jr.', '0999999'),
(66, 'Jovanie', 'Española', 'O', '1', '11', '06', 'JEspañola', '2ee27ad9a130edf48a586fe6d5ba73aac67f86e1', 'iBt~%42m9)!9x>d0VtoK!T57/@%zchB24vCo.#4~Bn*aLYIF^\\', 'b57f76d47f25ff3f1b7a9a44b1dcec03afdc6820:eb0f3f0078f6a36260d0fed59df12a96616ddb8e:af0c7308acd0ac03c9cc0f7dd0a132bbd87d9e781', '1', 0, 'Negros Occidental', '', '099999'),
(67, 'Christopher', 'Faciolan', '', '1', '11', '07', 'CFaciolan', 'eb136269785d85242b50f47ad5c1bedb2252fad3', 'YAUo2yksC!b9n$ldM7LcXOCSlD16Lz9n$qYAuNsk#0W&rPo1>p', 'c6c96202627679057a19d905044bd218d687e9d6:693c81847c223c9a303e7348ee4ef71426cb9a12:c5bc5f341b60789cf4baaefa5f3ee8feac751c9a1', '1', 0, 'Negros Occidental', '', ''),
(68, 'Joseph', 'Fernandez', 'P', '1', '11', '08', 'JFernandez', 'eb6cfe6d70f2360d677516e01aa513bb36d3c0cc', 'I)1y3sOWlc$7^$MlE&/aZ3P)G@MRT8I8I.1Mm5#sY/Ty9NFCBo', '6d6074f74dcb84741c7ba5eea16b51e03e6ddafa:1613b300c7b82b18cb36995c370ee04c17627bb8:1ce6f3864d74db70772a7b1ed8d085a23dea9a6c1', '1', 0, 'Negros Occidental', '', ''),
(69, 'Janyl Jane', 'Plaza', 'Nicart', '1', '11', '09', 'JPlaza', 'ebca3e9cf46001e1b227eca9a894b09f249254db', '<D!Rc@?4/seg46tW)\\FZZ~Ci*A7YReMRsp&AiAy8?Jm3uFpr1~', '9378f5962944f246962b5cda6a0fd453f99157e8:1233e1928cdb039f804c0f5bdf9b347db6fb2591:18ee822e359dfac671fc470744f97358e004a0e71', '1', 0, 'Negros Occidental', '', ''),
(70, 'Mark Jefel', 'Plaza', 'C.', '1', '11', '10', 'MPlaza', 'a5d9e03824f7d9cab82cde67fed76434c996cf00', 'PH7P0v?2C(kxFL9oIEMzX7v&aGTngX&/slO!bY~yNrA1zAzMEd', '769bff244c8089cc4b75e0753df80cc2986553ec:3f8389baf46e07b5b8758e64ccf2cdb072448e70:7b37cb94f8e2c4d7a78906a7a8e1c9ae065bd5fa1', '1', 0, 'Negros Occidental', '', ''),
(71, 'Donnie', 'Senomio', 'L', '1', '11', '11', 'DSenomio', 'a5beaef221d39221aaf5c3cc1db2dac04d000c17', 'SGpUlE*ft8QZf(a4>w.lK.DpVs4OOvarASXr&np.F%$@t%HXAX', '0138f1db24e5ab646e7d72a07016871b20b70094:086ee0fd915d8eef3febe57bfd0b2696ee81b106:241fa76abfc309b8ac196d2ea3ecbc3abfcf10621', '1', 0, 'Negros Occidental', '', ''),
(72, 'Stephanie', 'Senomio ', 'B', '1', '11', '12', 'SSenomio ', '054f95f3a22876b19bf9681b9810a8a100b54654', 'tXm(ENp)%E1#0zRmywWg%A<nN$\\Gfbj91FtoWE$~rQ4~@1rqBF', '38edcfada6d372077d69e536b98fb564fafa0b56:8c9c7dd5bacfe233cb52fe35fbe47091d1431241:a5023f1d86fb020ff6203ce07acfcb90cc92f0561', '1', 0, 'Negros Occidental', '', ''),
(73, 'Jovel', 'Young', 'V', '1', '11', '13', 'JYoung', '3c107e1eabbf9797272441a7b7210eaaa745f966', 'Tg^Gxw!z9cAQ6K6hIPEE4Qbib.TQfq\\3Q)B~%Wd>LjC?#kzTJ$', 'ff5f45bb163b9b4c80d474fbeee50010df6b3948:916fef2697ce988bfd2909bdd2337509cd62221b:3b89b45815067213f9119f6e6fc4269802cca5991', '1', 0, 'Negros Occidental', '', ''),
(74, 'Edan', 'Peñaroyo', '', '1', '11', '14', 'EPeñaroyo', '5273026ed5a3d4603dadc099f00697a27d5b1c5a', 'jtZGiG!AYh@fZ3r0lXOI4ohBoh%X)L~5a1X~^<)RO1I!?72N0^', '61311e2c60eb90b6bd4a9675b85240851b20518a:9fe3c5c3920541426a2dd80bc661fb5abcd298a7:6e0172af6312d5554c46edd93bc8e4bca885e9071', '5', 0, 'Negros Occidental', '', ''),
(75, 'Rem John Dave', 'Pitong', '', '1', '11', '15', 'RPitong', '6a765faf507aff6775eb75f71f906e11761e0f74', '9N?S1I1r~FHC77j0<M\\hblcxyKgc8J>$z4zmE.Zo3QL<p^pDWO', '3228881feb7a3d0d7ee540a6e0b1a78354740491:b4526d1612dfc91579d541c641359e54bc794191:90af4582b98e2ed05811690c279d31f12496a9121', '5', 0, 'Negros Occidental', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_acknowledged`
--
ALTER TABLE `tbl_acknowledged`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_active_term`
--
ALTER TABLE `tbl_active_term`
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
-- Indexes for table `tbl_exam_schedule`
--
ALTER TABLE `tbl_exam_schedule`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_file_attachment`
--
ALTER TABLE `tbl_file_attachment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_leavetype`
--
ALTER TABLE `tbl_leavetype`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_non_working_days`
--
ALTER TABLE `tbl_non_working_days`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_qr`
--
ALTER TABLE `tbl_qr`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_ranks`
--
ALTER TABLE `tbl_ranks`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_schedule_for_verification`
--
ALTER TABLE `tbl_schedule_for_verification`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_active_term`
--
ALTER TABLE `tbl_active_term`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `tbl_exam_schedule`
--
ALTER TABLE `tbl_exam_schedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_file_attachment`
--
ALTER TABLE `tbl_file_attachment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_leavetype`
--
ALTER TABLE `tbl_leavetype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_non_working_days`
--
ALTER TABLE `tbl_non_working_days`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_qr`
--
ALTER TABLE `tbl_qr`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_ranks`
--
ALTER TABLE `tbl_ranks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_schedule_for_verification`
--
ALTER TABLE `tbl_schedule_for_verification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
