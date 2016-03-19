-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2016 at 03:42 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ntucourses`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(10) NOT NULL,
  `name` varchar(999) NOT NULL,
  `startTime` int(10) NOT NULL,
  `endTime` int(10) NOT NULL,
  `type` int(10) NOT NULL,
  `cgroup` varchar(999) NOT NULL,
  `day` int(10) NOT NULL,
  `venue` varchar(999) NOT NULL,
  `courseID` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseID` varchar(999) NOT NULL,
  `courseName` varchar(999) NOT NULL,
  `AU` int(12) NOT NULL,
  `examDate` date NOT NULL,
  `examStart` int(12) NOT NULL,
  `examEnd` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `classID` varchar(999) NOT NULL,
  `courseID` varchar(999) NOT NULL,
  `referenceID` int(9) NOT NULL,
  `timetableID` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`classID`, `courseID`, `referenceID`, `timetableID`) VALUES
('Yergozha', 'Nuri', 1, 4),
('Yergozha', 'Nuri', 0, 0),
('Yergozha', 'Nuri', 1, 4),
('Yergozha', 'Nuri', 0, 0),
('Yergozha', 'Nuri', 1, 4),
('Yergozhin', 'Nurzhan', 1, 4),
('Yergozha', 'Nuri', 1, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
