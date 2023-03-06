-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2023 at 09:16 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bursary_ms`
--
CREATE DATABASE IF NOT EXISTS `bursary_ms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bursary_ms`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '08f90c1a417155361a5c4b8d297e0d78', '2021-10-04 17:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `bursary_application`
--

CREATE TABLE IF NOT EXISTS `bursary_application` (
  `application_id` int(11) NOT NULL AUTO_INCREMENT,
  `bursary_id` int(11) NOT NULL,
  `studID` varchar(200) NOT NULL,
  `fromdate` varchar(200) NOT NULL,
  `todate` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `application_status` int(200) NOT NULL,
  `IsRead` int(11) NOT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bursary_limits`
--

CREATE TABLE IF NOT EXISTS `bursary_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limit_checker` int(11) NOT NULL,
  `occupation` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `bursary_limits`
--

INSERT INTO `bursary_limits` (`id`, `limit_checker`, `occupation`) VALUES
(5, 1, 'peasant farmer'),
(6, 1, 'Teacher'),
(7, 2, 'Doctor');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `studID` varchar(255) DEFAULT NULL,
  `contactNo` bigint(11) DEFAULT NULL,
  `stud_year` tinytext,
  `stud_course` varchar(255) DEFAULT NULL,
  `limit_checker` int(6) DEFAULT NULL,
  `otp` varchar(200) NOT NULL,
  `applied` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `studID`, `contactNo`, `stud_year`, `stud_course`, `limit_checker`, `otp`, `applied`, `regDate`, `updationDate`, `status`) VALUES
(31, 'BENJAMIN NEMWEL', 'benja@gmail.com', '20/00000', 712345678, '3rd Year', NULL, NULL, '', NULL, '2022-11-20 22:36:21', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bursary`
--

CREATE TABLE IF NOT EXISTS `tbl_bursary` (
  `bursary_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` varchar(200) NOT NULL,
  `offered_by` varchar(200) NOT NULL,
  `limit_checker` int(11) NOT NULL,
  `applied` int(11) NOT NULL,
  PRIMARY KEY (`bursary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
