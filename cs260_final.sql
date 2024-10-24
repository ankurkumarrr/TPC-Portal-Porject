-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 06:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs260_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnus`
--

CREATE TABLE `alumnus` (
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `RollNo` varchar(8) DEFAULT NULL,
  `Specialization` varchar(100) DEFAULT NULL,
  `Gender` varchar(100) DEFAULT NULL,
  `YoE` int(11) DEFAULT NULL,
  `isVerified` int(11) NOT NULL DEFAULT 0,
  `Transcript` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumnus`
--

INSERT INTO `alumnus` (`Email`, `Password`, `Name`, `RollNo`, `Specialization`, `Gender`, `YoE`, `isVerified`, `Transcript`) VALUES
('kritik@iitp.ac.in', 'Test@123', 'Kritik', '1601CS55', 'CSE', 'Male', 2016, 1, NULL),
('bla@iitp.ac.in', 'Test@123', 'bla bla bla', '1601EE25', 'EEE', 'Female', 2016, 1, 'https://www.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `applied`
--

CREATE TABLE `applied` (
  `studentrollno` varchar(100) NOT NULL,
  `jobcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applied`
--

INSERT INTO `applied` (`studentrollno`, `jobcode`) VALUES
('2101EE10', 'OMZXZBhP'),
('2101AI38', 'x2vwaGzK');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `Company` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `isVerified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Company`, `Email`, `Password`, `isVerified`) VALUES
('TCS', 'tcs@gmail.com', 'Test@123', 1),
('Amazon', 'amazon@gmail.com', 'Test@123', 0),
('Admin', 'admin@iitp.ac.in', 'Test@123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `Company` varchar(100) DEFAULT NULL,
  `Position` varchar(100) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `CTC` int(11) DEFAULT NULL,
  `Specialization` varchar(100) DEFAULT NULL,
  `InterviewType` varchar(100) DEFAULT NULL,
  `InterviewMode` varchar(100) DEFAULT NULL,
  `MinCPI` decimal(4,2) DEFAULT NULL,
  `MinStd10` int(11) DEFAULT NULL,
  `MinStd12` int(11) DEFAULT NULL,
  `Gender` varchar(100) DEFAULT NULL,
  `jobcode` varchar(50) NOT NULL,
  `offerct` int(11) NOT NULL DEFAULT 0,
  `Year` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`Company`, `Position`, `City`, `CTC`, `Specialization`, `InterviewType`, `InterviewMode`, `MinCPI`, `MinStd10`, `MinStd12`, `Gender`, `jobcode`, `offerct`, `Year`) VALUES
('tcs@gmail.com', 'piss wiper', 'BIHITA', 1, 'CSE', 'Written', 'Offline', '8.90', 89, 89, 'Male', 'OMZXZBhP', 2, 2023),
('tcs@gmail.com', 'CEO', 'London', 5000, 'CE', 'Written', 'Offline', '7.00', 90, 90, 'Male', 'qch7WsYC', 0, 2023),
('amazon@gmail.com', 'CEO', 'Hyderabad', 5000, 'ME', 'Oral', 'Offline', '9.00', 90, 90, 'Female', 'x2vwaGzK', 1, 2023),
('tcs@gmail.com', 'Head', 'Tokyo', 12000000, 'CSE', 'Oral', 'Online', '8.00', 75, 75, 'Female', 'ha17JMWZ', 0, 2023),
('tcs@gmail.com', 'Head', 'Tokyo', 12000000, 'AIDS', 'Oral', 'Online', '8.00', 75, 75, 'Female', 'GCepylSb', 0, 2023),
('tcs@gmail.com', 'Head', 'Tokyo', 12000000, 'MNC', 'Oral', 'Online', '8.00', 75, 75, 'Female', 'pzRly33C', 0, 2023);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `RollNo` varchar(100) DEFAULT NULL,
  `Std10` int(11) DEFAULT NULL,
  `Std12` int(11) DEFAULT NULL,
  `CPI` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`RollNo`, `Std10`, `Std12`, `CPI`) VALUES
('2101CS69', 99, 99, '9.40'),
('2101EE10', 99, 99, '9.40'),
('1601CS56', 98, 98, '9.60'),
('2101AI38', 99, 99, '9.90'),
('1601CS55', 99, 99, '9.90'),
('2101CS89', 99, 99, '9.90'),
('2101CS89', 99, 99, '9.90'),
('2101CS89', 99, 99, '9.90'),
('2101CS89', 99, 99, '9.90'),
('1601EE25', 87, 92, '8.60');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `studentrollno` varchar(8) NOT NULL,
  `jobcode` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `placement`
--

CREATE TABLE `placement` (
  `RollNo` varchar(8) DEFAULT NULL,
  `Company` varchar(100) DEFAULT NULL,
  `Position` varchar(100) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `CTC` int(11) DEFAULT 0,
  `YoJ` int(11) DEFAULT 0,
  `YoL` int(11) DEFAULT 0,
  `offerct` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `placement`
--

INSERT INTO `placement` (`RollNo`, `Company`, `Position`, `City`, `CTC`, `YoJ`, `YoL`, `offerct`) VALUES
('2101CS69', 'Meta', 'Dev', 'London', 800000, 2023, 0, 1),
('2101EE10', 'Meta', 'Dev', 'London', 50000, 2023, 0, 0),
('1601CS56', 'Accenture2', 'Senior Dev', 'Kyoto', 90000, 2022, 0, 0),
('2101AI38', 'amazon@gmail.com', 'CEO', 'Hyderabad', 4000, 2023, 0, 1),
('1601CS55', 'Accenture2', 'CEO', 'London', 100000, 2020, 0, 0),
('2101CS89', 'Accenture', 'CEO', 'London', 9000000, 2019, 0, 0),
('2101CS89', 'Accenture', 'CEO', 'London', 900000, 2021, 0, 0),
('2101CS89', 'Accenture', 'CEO', 'London', 900000, 2021, 0, 0),
('2101CS89', 'Accenture', 'CEO', 'London', 900000, 2022, 0, 0),
('1601EE25', 'ZS Associates', 'Junior Dev', 'Pune', 2000000, 2020, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `RollNo` varchar(8) DEFAULT NULL,
  `Gender` varchar(100) DEFAULT NULL,
  `YoE` int(11) DEFAULT NULL,
  `Semester` int(11) DEFAULT NULL,
  `Specialization` varchar(100) DEFAULT NULL,
  `AoI` varchar(100) DEFAULT NULL,
  `Placed` varchar(100) DEFAULT '0',
  `isVerified` int(11) NOT NULL DEFAULT 0,
  `Transcript` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Email`, `Password`, `Name`, `RollNo`, `Gender`, `YoE`, `Semester`, `Specialization`, `AoI`, `Placed`, `isVerified`, `Transcript`) VALUES
('ankur@iitp.ac.in', 'Test@123', 'Ankur Kumar', '2101EE10', 'Male', 2019, 4, 'EEE', 'Development', 'no', 0, NULL),
('sid@iitp.ac.in', 'Test@123', 'Sid', '2101AI38', 'Female', 2021, 4, 'ME', 'Development', 'yes', 1, NULL),
('nishtha@iitp.ac.in', 'Test@123', 'Nishtha Taktewale', '2101CS89', 'Female', 2020, 4, 'CSE', 'CP', 'yes', 1, 'https://docs.google.com/document/d/1jJffQ002EIvQCJo7gHxbkFPU10tvYNoI-Kn5OuXcSvE/edit?usp=sharing');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
