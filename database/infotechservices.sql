-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2020 at 04:27 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infotechservices`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessment_sub_components`
--

CREATE TABLE `assessment_sub_components` (
  `id` int(11) NOT NULL,
  `sub_component_id` int(11) NOT NULL,
  `remark` text,
  `repassessreport_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessment_sub_components`
--

INSERT INTO `assessment_sub_components` (`id`, `sub_component_id`, `remark`, `repassessreport_id`) VALUES
(6, 39, 'fdsa', 90),
(7, 40, 'aaaa', 90);

-- --------------------------------------------------------

--
-- Table structure for table `department_tbl`
--

CREATE TABLE `department_tbl` (
  `dept_id` int(11) NOT NULL,
  `dept_code` varchar(255) NOT NULL,
  `dept_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_tbl`
--

INSERT INTO `department_tbl` (`dept_id`, `dept_code`, `dept_name`) VALUES
(1, 'PGO-IT', 'Provincial Governors Office - Information Technology'),
(8, 'OPAG', 'Office of Provincial Agriculture'),
(10, 'PGO-Main', 'Provincial Governors Office - Main Division'),
(12, 'TEST-CODE', 'TEST-DEPartment'),
(13, 'CODE312', 'dep_name_yeah');

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE `employee_tbl` (
  `emp_id` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `emp_idnum` int(255) NOT NULL,
  `emp_fname` varchar(255) NOT NULL,
  `emp_lname` varchar(255) NOT NULL,
  `emp_position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_tbl`
--

INSERT INTO `employee_tbl` (`emp_id`, `dept_id`, `emp_idnum`, `emp_fname`, `emp_lname`, `emp_position`) VALUES
(1, 8, 1, 'opag employee fname', 'opag employee lname', 'opag employee position'),
(2, 1, 2, 'pgo it employee fname', 'pgo it employee lname', 'pgo it employee position'),
(3, 13, 54321, 'Edited', 'Edited', 'Main Position'),
(4, 10, 1928, 'First Name', 'Last Name', 'Position in Main');

-- --------------------------------------------------------

--
-- Table structure for table `hardwarecomponent_tbl`
--

CREATE TABLE `hardwarecomponent_tbl` (
  `hwcomponent_id` int(11) NOT NULL,
  `hwcomponent_name` varchar(255) NOT NULL,
  `hwcomponent_type` enum('main','sub') DEFAULT NULL,
  `hwcomponent_category` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hardwarecomponent_tbl`
--

INSERT INTO `hardwarecomponent_tbl` (`hwcomponent_id`, `hwcomponent_name`, `hwcomponent_type`, `hwcomponent_category`) VALUES
(23, 'CPU', 'main', NULL),
(24, 'Printer', 'main', NULL),
(25, 'UPS', 'main', NULL),
(26, 'Accessories', 'main', NULL),
(27, 'Others', 'main', NULL),
(28, 'Processor', 'sub', 23),
(29, 'RAM (Memory)', 'sub', 23),
(30, 'Hard Disk', 'sub', 23),
(31, 'Video Card', 'sub', 23),
(32, 'Power Supply', 'sub', 23),
(33, 'Motherboard', 'sub', 23),
(34, 'Optical Drive (DVD)', 'sub', 23),
(35, 'Ink Cartridge', 'sub', 24),
(36, 'Toners', 'sub', 24),
(37, 'Power Adapter', 'sub', 24),
(38, 'Sensors', 'sub', 24),
(39, 'Battery', 'sub', 25),
(40, 'Circuit Board', 'sub', 25),
(41, 'Keyboard', 'sub', 26),
(42, 'Mouse', 'sub', 26),
(43, 'Speakers', 'sub', 26),
(44, 'Monitor LCD/LED', 'sub', 26),
(45, 'Monitor Circuit Board', 'sub', 26),
(46, 'External HDD ', 'sub', 27),
(47, 'Sensors', 'sub', 27);

-- --------------------------------------------------------

--
-- Table structure for table `itservices_request_tbl`
--

CREATE TABLE `itservices_request_tbl` (
  `itsrequest_id` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `itsrequest_date` datetime NOT NULL,
  `concern` varchar(255) NOT NULL,
  `status` enum('post-repair inspected','pre-repair inspected','assessment pending','deployed','done','pending','received','assessed','pre-post-repair inspected') NOT NULL DEFAULT 'received',
  `statusupdate_useraccount_id` int(255) DEFAULT NULL,
  `itsrequest_category` enum('hw','other') DEFAULT NULL,
  `hwcomponent_id` int(11) DEFAULT NULL,
  `hwcomponent_sub_id` int(11) NOT NULL,
  `itshw_category` enum('on-site','walk-in','pulled-out') DEFAULT NULL,
  `property_num` varchar(255) DEFAULT NULL,
  `solution` varchar(500) DEFAULT NULL,
  `deployment_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itservices_request_tbl`
--

INSERT INTO `itservices_request_tbl` (`itsrequest_id`, `dept_id`, `emp_id`, `itsrequest_date`, `concern`, `status`, `statusupdate_useraccount_id`, `itsrequest_category`, `hwcomponent_id`, `hwcomponent_sub_id`, `itshw_category`, `property_num`, `solution`, `deployment_date`) VALUES
(105, 8, 1, '2020-03-02 14:13:00', 'l', 'pending', 50, 'hw', 24, 0, 'pulled-out', 'adsf', NULL, NULL),
(106, 8, 1, '2020-03-02 14:14:34', 'wew', 'pending', 50, 'hw', 23, 0, 'pulled-out', 'fa21', NULL, NULL),
(107, 8, 1, '2020-03-02 14:17:32', 'fad', 'pre-post-repair inspected', 50, 'hw', 24, 0, 'pulled-out', 'fdas', NULL, NULL),
(108, 8, 1, '2020-03-02 14:23:19', '651651', 'pre-post-repair inspected', 50, 'hw', 24, 0, 'pulled-out', '456', NULL, NULL),
(109, 8, 1, '2020-03-02 14:35:22', 'wew', 'pre-post-repair inspected', 50, 'hw', 24, 0, 'pulled-out', 'we', NULL, NULL),
(110, 8, 1, '2020-03-02 14:37:17', 'spu', 'pre-post-repair inspected', 50, 'hw', 25, 0, 'pulled-out', 'hy', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partstoreplaceinspectreports`
--

CREATE TABLE `partstoreplaceinspectreports` (
  `id` int(11) NOT NULL,
  `repassessreport_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `repassessreport_tbl`
--

CREATE TABLE `repassessreport_tbl` (
  `repassessreport_id` int(11) NOT NULL,
  `itsrequest_id` int(11) NOT NULL,
  `assessmenttechrep_useraccount_id` int(11) NOT NULL,
  `hwcomponent_id` int(11) NOT NULL,
  `assessment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hwcomponent_dateAcquired` timestamp NULL DEFAULT NULL,
  `hwcomponent_description` text,
  `hwcomponent_acquisitioncost` float DEFAULT NULL,
  `serial_number` varchar(255) NOT NULL,
  `findings_category` enum('repaired','partly damaged','beyond repair','for replacement','others') NOT NULL,
  `findings_description` text,
  `notes` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `repassessreport_tbl`
--

INSERT INTO `repassessreport_tbl` (`repassessreport_id`, `itsrequest_id`, `assessmenttechrep_useraccount_id`, `hwcomponent_id`, `assessment_date`, `hwcomponent_dateAcquired`, `hwcomponent_description`, `hwcomponent_acquisitioncost`, `serial_number`, `findings_category`, `findings_description`, `notes`) VALUES
(25, 94, 50, 25, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'aw', 0.04, 'aw', 'partly damaged', 'aw', 'awaw'),
(26, 95, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fafa', 123, 'fafa', 'partly damaged', 'asdfadsf', 'fasdf'),
(27, 96, 50, 24, '2020-02-29 16:00:00', '2020-02-29 16:00:00', 'asdf', 123, 'asdf', 'repaired', 'asdf', 'asdf'),
(28, 96, 50, 24, '2020-02-29 16:00:00', '2020-02-29 16:00:00', 'asdf', 123, 'asdf', 'repaired', 'asdf', 'asdf'),
(29, 96, 50, 24, '2020-02-29 16:00:00', '2020-02-29 16:00:00', 'asdf', 123, 'asdf', 'repaired', 'asdf', 'asdf'),
(30, 96, 50, 24, '2020-02-29 16:00:00', '2020-02-29 16:00:00', 'asdf', 123, 'asdf', 'repaired', 'asdf', 'asdf'),
(31, 96, 50, 24, '2020-02-29 16:00:00', '2020-02-29 16:00:00', 'asdf', 123, 'asdf', 'repaired', 'asdf', 'asdf'),
(32, 96, 50, 24, '2020-02-29 16:00:00', '2020-02-29 16:00:00', 'asdf', 123, 'asdf', 'repaired', 'asdf', 'asdf'),
(33, 96, 50, 24, '2020-02-29 16:00:00', '2020-02-29 16:00:00', 'asdf', 123, 'asdf', 'repaired', 'asdf', 'asdf'),
(34, 96, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'asdf', 123, 'asdf', 'partly damaged', 'asdf', 'fadsfdas'),
(35, 96, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fdsa', 123, 'asdf', 'partly damaged', 'asdf', 'fdas'),
(36, 96, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', '123', 123, '321', 'partly damaged', 'asdf', 'fasd'),
(37, 96, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', '123', 123, '321', 'partly damaged', 'asdf', 'fasd'),
(38, 96, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fdasf', 123231, 'fdsaf', 'for replacement', 'fdasf', 'fdsafdas'),
(39, 96, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fdasf', 123231, 'fdsaf', 'for replacement', 'fdasf', 'fdsafdas'),
(40, 96, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fdasf', 123231, 'fdsaf', 'for replacement', 'fdasf', 'fdsafdas'),
(41, 96, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fdasf', 123231, 'fdsaf', 'for replacement', 'fdasf', 'fdsafdas'),
(42, 96, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fdsafdsf', 12312300, 'asdfdsafsd', 'partly damaged', 'fdasf', 'sdafsa'),
(43, 96, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fdsafdsf', 12312300, 'asdfdsafsd', 'partly damaged', 'fdasf', 'sdafsa'),
(44, 96, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fdsafdsf', 12312300, 'asdfdsafsd', 'partly damaged', 'fdasf', 'sdafsa'),
(45, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fadsfsda', 123213, 'asdfasdf', 'partly damaged', 'fdasf', 'dfsaf'),
(46, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fadsfsda', 123213, 'asdfasdf', 'partly damaged', 'fdasf', 'dfsaf'),
(47, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-04 16:00:00', 'fdsafsdfds', 123, '12323', 'repaired', 'asdf', 'fdsa'),
(48, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fsadfasd', 12321, 'asdfsdaf', 'beyond repair', 'fdas', 'fdsaf'),
(49, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fdsaf', 12321, '12321', 'for replacement', 'f', 'f'),
(50, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'F', 1, 'a', 'partly damaged', 'f', 'a'),
(51, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 2, 'b', 'partly damaged', 'f', 'a'),
(52, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 2, 'b', 'partly damaged', 'f', 'a'),
(53, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 2, 'b', 'partly damaged', 'f', 'a'),
(54, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 2, 'b', 'partly damaged', 'f', 'a'),
(55, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 2, 'b', 'partly damaged', 'f', 'a'),
(56, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 1, 'b', 'repaired', 'f', 'a'),
(57, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 1, 'b', 'repaired', 'f', 'a'),
(58, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 1, 'b', 'repaired', 'f', 'a'),
(59, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 1, 'b', 'beyond repair', 'f', 'a'),
(60, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 1, 'b', 'beyond repair', 'f', 'a'),
(61, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 1, 'b', 'beyond repair', 'f', 'a'),
(62, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 1, 'b', 'beyond repair', 'f', 'a'),
(63, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 1, 'b', 'beyond repair', 'f', 'a'),
(64, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 1, 'b', 'beyond repair', 'f', 'a'),
(65, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'a', 1, 'b', 'beyond repair', 'f', 'a'),
(66, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', '1', 1, 'f', 'partly damaged', 'f', 'a'),
(67, 97, 50, 23, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'f', 2, 'a', 'repaired', 'a', 'b'),
(68, 98, 50, 24, '2020-02-29 16:00:00', '2020-03-01 16:00:00', 'fadsfads', 123, 'f', 'partly damaged', 'a', 'f'),
(69, 99, 50, 23, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'model', 123, 'fadsf', 'partly damaged', 'fdas', 'fdasfds'),
(70, 99, 50, 23, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'model', 123, 'fadsf', 'partly damaged', 'fdas', 'fdasfds'),
(71, 99, 50, 23, '2020-03-01 16:00:00', '2020-03-04 16:00:00', 'fdsaf', 123, 'fasdfasd', 'partly damaged', 'adfs', 'fdas'),
(72, 99, 50, 23, '2020-03-01 16:00:00', '2020-03-04 16:00:00', 'fdsaf', 123, 'fasdfasd', 'partly damaged', 'adfs', 'fdas'),
(73, 100, 50, 24, '2020-03-01 16:00:00', '2020-03-02 16:00:00', 'fasdf', 123, 'fdaf', 'repaired', 'f', 'a'),
(74, 100, 50, 24, '2020-03-01 16:00:00', '2020-03-02 16:00:00', 'fasdf', 123, 'fdaf', 'repaired', 'f', 'a'),
(75, 100, 50, 24, '2020-03-01 16:00:00', '2020-03-02 16:00:00', 'f', 0.01, 'a', 'repaired', 'f', 'a'),
(76, 101, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'fefefe', 123, 'fasdf', 'beyond repair', 'fads', 'asdf'),
(77, 101, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'fdasf', 123, 'fdasf', 'repaired', 'fsadf', 'fdsaf'),
(78, 101, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'fdasf', 123, 'fdasf', 'repaired', 'fsadf', 'fdsaf'),
(79, 102, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'fasd', 1, 'fdsa', 'repaired', 'fdas', 'asdf'),
(80, 102, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'fasd', 1, 'fdsa', 'repaired', 'fdas', 'asdf'),
(81, 102, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'fasd', 1, 'fdsa', 'repaired', 'fdas', 'asdf'),
(82, 103, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'fa', 123, 'fa', 'partly damaged', 'f', 'a'),
(83, 104, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'ha', 1, 'f', 'partly damaged', 'fa', 'adsf'),
(84, 104, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'ha', 1, 'f', 'partly damaged', 'fa', 'adsf'),
(85, 107, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'fdasf', 123, 'fa', 'for replacement', 'f', 'a'),
(86, 107, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'fdasf', 123, 'fa', 'for replacement', 'f', 'a'),
(87, 107, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'fdas', 123, 'fdas', 'beyond repair', 'f', 'a'),
(88, 108, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'a', 1, 'f', 'for replacement', 'a', 'b'),
(89, 109, 50, 24, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'fdas', 123, 'asdf', 'for replacement', 'findings', ';lkdfsa'),
(90, 110, 50, 25, '2020-03-01 16:00:00', '2020-02-29 16:00:00', 'asdf', 123, 'fdasf', 'partly damaged', 'fdsa', 'asdfds');

-- --------------------------------------------------------

--
-- Table structure for table `repinspectreport_tbl`
--

CREATE TABLE `repinspectreport_tbl` (
  `repinspectreport_id` int(11) NOT NULL,
  `control_num` varchar(255) NOT NULL,
  `repassessreport_id` int(11) NOT NULL,
  `repair_historyanddate` varchar(500) DEFAULT NULL,
  `job_order` varchar(500) DEFAULT NULL,
  `parttoreplace_qty` int(11) NOT NULL,
  `parttoreplace_unit` enum('pc','unit','set') NOT NULL,
  `parttoreplace_description` varchar(500) DEFAULT NULL,
  `parttoreplace_amount` decimal(19,2) DEFAULT NULL,
  `preinspector_emp_id` int(11) NOT NULL,
  `post_findings` varchar(500) NOT NULL,
  `stocksupplies_availability` enum('yes','no') NOT NULL,
  `stocksupplies_icsnum` varchar(500) DEFAULT NULL,
  `stocksupplies_inventorynum` varchar(500) DEFAULT NULL,
  `stocksupplies_serialnum` varchar(500) DEFAULT NULL,
  `wastematerial` enum('with','without') NOT NULL,
  `natureoflastrepair` varchar(500) NOT NULL,
  `defects` varchar(255) NOT NULL,
  `findings` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `useraccount_tbl`
--

CREATE TABLE `useraccount_tbl` (
  `useraccount_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `usertype` enum('programmer','admin','personnel','department') NOT NULL,
  `dept_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccount_tbl`
--

INSERT INTO `useraccount_tbl` (`useraccount_id`, `emp_id`, `username`, `password`, `status`, `usertype`, `dept_id`) VALUES
(50, 2, 'admin', '$2y$10$V4vi5BGOquFeXCXvECbs5uGnIyWhYsgoh6v9JQIuYcS5vUnhoGnca', '1', 'admin', 1),
(51, 1, 'opag', '$2y$10$7YqbRlOh6xzSAof2bFFuC.uhPdPkHEU1IICgiUddF7Dft2kebi10K', '1', 'department', 8),
(52, 2, 'amazing', '$2y$10$f6Y3fHM1IDkVOJBKw/32GemzJAg50o6boZUyMUvt6w4C5umLrSgzu', '1', 'admin', NULL),
(53, NULL, 'pgo-main', '$2y$10$agQG.9kYMNKAvHfBNc2iSOJlrt41XRwlflStR2FIFIIDa5xe28pza', '1', 'department', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessment_sub_components`
--
ALTER TABLE `assessment_sub_components`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_component_id` (`sub_component_id`),
  ADD KEY `repassessreport_id` (`repassessreport_id`);

--
-- Indexes for table `department_tbl`
--
ALTER TABLE `department_tbl`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `dept_code` (`dept_code`),
  ADD UNIQUE KEY `dept_name` (`dept_name`);

--
-- Indexes for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emp_idnum` (`emp_idnum`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `hardwarecomponent_tbl`
--
ALTER TABLE `hardwarecomponent_tbl`
  ADD PRIMARY KEY (`hwcomponent_id`);

--
-- Indexes for table `itservices_request_tbl`
--
ALTER TABLE `itservices_request_tbl`
  ADD PRIMARY KEY (`itsrequest_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `hwcomponent_id` (`hwcomponent_id`),
  ADD KEY `statusupdate_useraccount_id` (`statusupdate_useraccount_id`);

--
-- Indexes for table `partstoreplaceinspectreports`
--
ALTER TABLE `partstoreplaceinspectreports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repassessreport_id` (`repassessreport_id`);

--
-- Indexes for table `repassessreport_tbl`
--
ALTER TABLE `repassessreport_tbl`
  ADD PRIMARY KEY (`repassessreport_id`),
  ADD KEY `assessmenttechrep_useraccount_id` (`assessmenttechrep_useraccount_id`),
  ADD KEY `hwcomponent_id` (`hwcomponent_id`);

--
-- Indexes for table `repinspectreport_tbl`
--
ALTER TABLE `repinspectreport_tbl`
  ADD PRIMARY KEY (`repinspectreport_id`),
  ADD KEY `repassessreport_id` (`repassessreport_id`),
  ADD KEY `preinspector_emp_id` (`preinspector_emp_id`);

--
-- Indexes for table `useraccount_tbl`
--
ALTER TABLE `useraccount_tbl`
  ADD PRIMARY KEY (`useraccount_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `dept_id` (`dept_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessment_sub_components`
--
ALTER TABLE `assessment_sub_components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department_tbl`
--
ALTER TABLE `department_tbl`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hardwarecomponent_tbl`
--
ALTER TABLE `hardwarecomponent_tbl`
  MODIFY `hwcomponent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `itservices_request_tbl`
--
ALTER TABLE `itservices_request_tbl`
  MODIFY `itsrequest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `partstoreplaceinspectreports`
--
ALTER TABLE `partstoreplaceinspectreports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repassessreport_tbl`
--
ALTER TABLE `repassessreport_tbl`
  MODIFY `repassessreport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `repinspectreport_tbl`
--
ALTER TABLE `repinspectreport_tbl`
  MODIFY `repinspectreport_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useraccount_tbl`
--
ALTER TABLE `useraccount_tbl`
  MODIFY `useraccount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessment_sub_components`
--
ALTER TABLE `assessment_sub_components`
  ADD CONSTRAINT `assessment_sub_components_ibfk_1` FOREIGN KEY (`sub_component_id`) REFERENCES `hardwarecomponent_tbl` (`hwcomponent_id`),
  ADD CONSTRAINT `assessment_sub_components_ibfk_2` FOREIGN KEY (`repassessreport_id`) REFERENCES `repassessreport_tbl` (`repassessreport_id`);

--
-- Constraints for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD CONSTRAINT `employee_tbl_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department_tbl` (`dept_id`);

--
-- Constraints for table `itservices_request_tbl`
--
ALTER TABLE `itservices_request_tbl`
  ADD CONSTRAINT `itservices_request_tbl_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department_tbl` (`dept_id`),
  ADD CONSTRAINT `itservices_request_tbl_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employee_tbl` (`emp_id`),
  ADD CONSTRAINT `itservices_request_tbl_ibfk_3` FOREIGN KEY (`statusupdate_useraccount_id`) REFERENCES `useraccount_tbl` (`useraccount_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itservices_request_tbl_ibfk_4` FOREIGN KEY (`hwcomponent_id`) REFERENCES `hardwarecomponent_tbl` (`hwcomponent_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itservices_request_tbl_ibfk_5` FOREIGN KEY (`emp_id`) REFERENCES `employee_tbl` (`emp_id`);

--
-- Constraints for table `partstoreplaceinspectreports`
--
ALTER TABLE `partstoreplaceinspectreports`
  ADD CONSTRAINT `partstoreplaceinspectreports_ibfk_1` FOREIGN KEY (`repassessreport_id`) REFERENCES `repassessreport_tbl` (`repassessreport_id`);

--
-- Constraints for table `repassessreport_tbl`
--
ALTER TABLE `repassessreport_tbl`
  ADD CONSTRAINT `repassessreport_tbl_ibfk_1` FOREIGN KEY (`assessmenttechrep_useraccount_id`) REFERENCES `useraccount_tbl` (`useraccount_id`),
  ADD CONSTRAINT `repassessreport_tbl_ibfk_2` FOREIGN KEY (`hwcomponent_id`) REFERENCES `hardwarecomponent_tbl` (`hwcomponent_id`),
  ADD CONSTRAINT `repassessreport_tbl_ibfk_3` FOREIGN KEY (`assessmenttechrep_useraccount_id`) REFERENCES `useraccount_tbl` (`useraccount_id`),
  ADD CONSTRAINT `repassessreport_tbl_ibfk_4` FOREIGN KEY (`hwcomponent_id`) REFERENCES `hardwarecomponent_tbl` (`hwcomponent_id`),
  ADD CONSTRAINT `repassessreport_tbl_ibfk_5` FOREIGN KEY (`assessmenttechrep_useraccount_id`) REFERENCES `useraccount_tbl` (`useraccount_id`),
  ADD CONSTRAINT `repassessreport_tbl_ibfk_6` FOREIGN KEY (`hwcomponent_id`) REFERENCES `hardwarecomponent_tbl` (`hwcomponent_id`);

--
-- Constraints for table `useraccount_tbl`
--
ALTER TABLE `useraccount_tbl`
  ADD CONSTRAINT `useraccount_tbl_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department_tbl` (`dept_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
