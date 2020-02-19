-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2020 at 01:29 AM
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
(1, 39, 'adf', 27),
(2, 40, 'asdf', 27),
(3, 39, 'battery lang e', 28),
(4, 39, 'batter', 29),
(5, 40, 'circ', 29),
(11, 35, 'asdf', 30),
(12, 37, 'asdf', 30),
(13, 28, 'asdfasdf', 31),
(14, 29, 'sadfsadf', 31),
(15, 30, 'asdfasdf', 31),
(16, 31, 'SDASDF', 31),
(17, 32, 'fsadfsdaf', 31),
(18, 33, 'asdfsadfsd', 31),
(19, 34, 'asfasdfdsa', 31),
(21, 35, 'a', 34),
(22, 36, 'b', 34),
(26, 40, 'asdf', 35),
(27, 40, 'asdf', 36),
(28, 39, 'asdf', 37),
(29, 40, 'fdasdsfsda', 37),
(30, 39, 'adsfsadf', 38),
(31, 40, 'zcv', 38),
(32, 35, '', 39),
(33, 37, '12354', 39),
(34, 35, 'asdf', 40),
(35, 36, 'asdfdsf', 40),
(36, 38, 'asdfsadfsdfsdfasd', 40),
(37, 35, 'asdffdsa', 41),
(38, 37, 'f', 41),
(39, 35, 'asdf', 42),
(40, 37, 'hays', 42),
(41, 39, 'asdf', 43),
(42, 39, 'asdf', 44),
(43, 40, 'suro', 44);

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
(12, 'TEST-CODE edited', 'TEST-DEP');

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
(13, 8, 5, 'Derman', 'Dalmo', NULL),
(14, 8, 6, 'Lolita', 'Bentres', NULL),
(15, 8, 7, 'Johnny', 'Jose', NULL),
(16, 8, 8, 'Dexter', 'Dimas', NULL),
(17, 10, 9, 'Clarita', 'Prudencio', NULL),
(18, 1, 1, 'Jenny Rose', 'Borja', 'Information Systems Analyst'),
(19, 1, 2, 'Brian Jr.', 'Mang-oy', 'I don\'t know position'),
(20, 1, 3, 'Rae Sandy', 'Calado', 'I don\'t know position'),
(21, 1, 4, 'Gretchen', 'Marrero', 'I don\'t know position'),
(22, 1, 2312, 'Jando', 'Sasa', NULL),
(35, 1, 123, 'Ad', 'Min', NULL),
(36, 8, 321, 'Depart', 'Ment', NULL);

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
(23, 'CPU', 'main', 0),
(24, 'Printer', 'main', NULL),
(25, 'UPS', 'main', NULL),
(26, 'Accessories', 'main', 0),
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
(46, 'External HDD', 'sub', 27);

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
  `status` enum('post-repair inspected','pre-repair inspected','assessment pending','deployed','done','pending','received','assessed') NOT NULL DEFAULT 'received',
  `statusupdate_useraccount_id` int(255) DEFAULT NULL,
  `itsrequest_category` enum('hw','other') DEFAULT NULL,
  `hwcomponent_id` int(11) DEFAULT NULL,
  `hwcomponent_sub_id` int(11) NOT NULL,
  `itshw_category` enum('on-site','walk-in','pulled-out') DEFAULT NULL,
  `property_num` varchar(255) DEFAULT NULL,
  `solution` varchar(500) DEFAULT NULL,
  `received_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itservices_request_tbl`
--

INSERT INTO `itservices_request_tbl` (`itsrequest_id`, `dept_id`, `emp_id`, `itsrequest_date`, `concern`, `status`, `statusupdate_useraccount_id`, `itsrequest_category`, `hwcomponent_id`, `hwcomponent_sub_id`, `itshw_category`, `property_num`, `solution`, `received_date`) VALUES
(2, 8, 13, '2020-02-03 22:34:29', 'Restarts on its own', 'done', 40, 'hw', 23, 0, 'on-site', NULL, '', NULL),
(3, 8, 14, '2020-02-03 22:51:28', 'Layout Tarpauline - Theme: Adivay 2020 . Size: 10ftx15ft', 'done', 40, 'other', NULL, 0, '', NULL, 'OK', NULL),
(4, 10, 17, '2020-02-03 23:01:26', 'Sensor blinking red', 'deployed', 42, 'hw', 24, 0, 'pulled-out', 'PNP1', 'Reset', '2020-02-03 23:54:36'),
(5, 8, 15, '2020-02-03 23:03:05', 'Doesn\'t Power on', 'deployed', 40, 'hw', 25, 0, 'walk-in', 'PNUPS1', '', '2020-02-10 15:41:24'),
(6, 8, 15, '2020-02-04 16:55:27', 'Paper Jam', 'deployed', 40, 'hw', 24, 0, 'pulled-out', 'PN213232', 'OK replaced\r\n', '2020-02-12 09:24:12'),
(7, 8, 13, '2020-02-05 14:48:59', 'Paper Jam', 'done', 40, 'hw', 24, 0, 'pulled-out', 'PNsfds13213', '', NULL),
(8, 8, 16, '2020-02-10 15:18:46', 'Layout Tarp 12x12', 'done', 40, 'other', NULL, 0, '', NULL, '', NULL),
(10, 8, 14, '2020-02-10 15:51:49', 'Paper Jam', 'deployed', 40, 'hw', 24, 0, 'pulled-out', 'PNprinter23213', '', '2020-02-11 10:55:36'),
(15, 8, 36, '2020-02-11 11:02:09', 'testing', 'done', 40, 'other', NULL, 0, '', NULL, 'amazing solution\r\n', NULL),
(17, 8, 13, '2020-02-11 11:29:08', 'the concern', 'deployed', 40, 'hw', 27, 0, 'pulled-out', '12312213123', '', '2020-02-12 08:28:14'),
(18, 8, 36, '2020-02-11 11:57:43', '', 'done', 40, 'other', NULL, 0, '', NULL, '', NULL),
(19, 8, 13, '2020-02-11 11:59:09', 'asdf', 'assessment pending', 40, 'hw', 24, 0, 'pulled-out', '', NULL, NULL),
(21, 8, 14, '2020-02-12 08:21:19', 'sadfsdafa', 'assessment pending', 40, 'hw', 24, 0, 'pulled-out', '32132', NULL, NULL),
(22, 8, 14, '2020-02-12 09:24:32', 'test', 'pre-repair inspected', 40, 'hw', 25, 0, 'pulled-out', '', NULL, NULL),
(23, 8, 36, '2020-02-12 14:02:06', 'automatic shut down', 'assessed', 40, 'hw', 23, 0, 'pulled-out', '', NULL, NULL),
(24, 8, 13, '2020-02-12 15:15:45', 'test', 'pending', 40, 'other', NULL, 0, '', NULL, NULL, NULL),
(25, 8, 13, '2020-02-14 11:19:31', 'testing', 'assessed', 40, 'hw', 26, 0, 'pulled-out', '123-123-321', NULL, NULL),
(26, 8, 14, '2020-02-14 11:24:11', 'adsfasdf', 'done', 40, 'hw', 24, 0, 'pulled-out', '023190130129032103', 'ad;lkfja', NULL),
(27, 8, 36, '2020-02-14 11:26:54', 'dasfsadfsdf', 'assessed', 40, 'hw', 24, 0, 'pulled-out', '123123123', NULL, NULL),
(28, 8, 14, '2020-02-14 11:29:46', 'dasfadsfasd', 'assessed', 40, 'hw', 24, 0, 'pulled-out', '1232131231221', NULL, NULL),
(29, 8, 13, '2020-02-14 11:30:50', '12412c q22323231', 'assessed', 40, 'hw', 26, 0, 'pulled-out', '21123123', NULL, NULL),
(30, 8, 16, '2020-02-14 11:40:43', 'adsfdasf', 'assessed', 40, 'hw', 24, 0, 'pulled-out', 'adfsadfas', NULL, NULL),
(31, 8, 15, '2020-02-15 09:04:54', 'yep on', 'received', 40, 'hw', 24, 0, 'pulled-out', 'proere num1234234', NULL, NULL),
(32, 8, 15, '2020-02-15 09:06:04', 'sadfadsf', 'assessed', 40, 'hw', 24, 0, 'pulled-out', 'asdfasdfs', NULL, NULL),
(33, 8, 13, '2020-02-15 14:06:49', 'yep yep!', 'assessed', 40, 'hw', 26, 0, 'pulled-out', 'proprty-num1234', NULL, NULL),
(34, 8, 14, '2020-02-15 14:09:11', 'asdfasdf', 'assessed', 40, 'hw', 25, 0, 'pulled-out', 'asdfasdfasdf', NULL, NULL),
(35, 8, 15, '2020-02-15 14:33:07', 'ups ups ups', 'assessed', 40, 'hw', 25, 0, 'pulled-out', 'adsfsdafsdafsda', NULL, NULL),
(36, 8, 36, '2020-02-15 14:48:31', 'adngek', 'assessed', 40, 'hw', 24, 0, 'pulled-out', 'asdf', NULL, NULL),
(37, 8, 13, '2020-02-15 15:29:07', 'asdfsadf', 'assessed', 40, 'hw', 23, 0, 'pulled-out', '2876982176', NULL, NULL),
(38, 8, 36, '2020-02-15 15:47:01', '54h45h5h5h5h', 'deployed', 40, 'hw', 26, 0, 'pulled-out', '123123', 'done bruh\r\n', '2020-02-15 16:12:44'),
(39, 8, 14, '2020-02-15 16:17:24', 'asdf', 'assessed', 40, 'hw', 24, 0, 'pulled-out', '123f123f', NULL, NULL),
(40, 8, 14, '2020-02-15 16:20:32', 'asdfsadf', 'assessed', 40, 'hw', 25, 0, 'pulled-out', 'adfasdf', NULL, NULL),
(41, 8, 13, '2020-02-15 17:04:04', 'asdfsadf', 'done', 40, 'hw', 25, 0, 'pulled-out', 'asdf12asdf', 'Solution', NULL),
(42, 8, 14, '2020-02-16 08:47:03', '123123123\r\n', 'assessed', 40, 'hw', 24, 0, 'pulled-out', '123', NULL, NULL),
(43, 8, 16, '2020-02-16 11:06:39', 'alpha male', 'assessed', 40, 'hw', 24, 0, 'pulled-out', '123-=123-=123', NULL, NULL),
(44, 8, 13, '2020-02-16 11:20:08', 'asdfasdfadsf', 'assessed', 40, 'hw', 24, 0, 'pulled-out', 'adfsdaf', NULL, NULL),
(45, 8, 14, '2020-02-16 11:35:19', 'ho', 'assessed', 40, 'hw', 24, 0, 'pulled-out', 'sdf2', NULL, NULL),
(46, 8, 13, '2020-02-16 11:51:32', 'adsf', 'pre-repair inspected', 40, 'hw', 25, 0, 'pulled-out', 'lll', NULL, NULL),
(48, 8, 13, '2020-02-16 16:43:43', 'asdfasdff heheh heheh ', 'assessed', 40, 'hw', 25, 0, 'pulled-out', 'prop num!', NULL, NULL);

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
(1, 22, 40, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(2, 25, 40, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(3, 26, 40, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(4, 27, 40, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(5, 28, 40, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(6, 29, 40, 26, '2020-02-10 16:00:00', '0000-00-00 00:00:00', 'adfsadfdsa', 0, 'asdfdsafdsafdsaf', 'partly damaged', 'yep', 'notesnotes here'),
(7, 30, 40, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asdfadsf', 7, 'asdfadsf', '', '', ''),
(8, 32, 40, 24, '2020-01-31 16:00:00', '2020-01-31 16:00:00', 'ytjnrjntn', 3, 'rtyjn', 'repaired', 'evtrvhrhrer', 'erhtvhetrh'),
(9, 32, 40, 24, '2020-01-31 16:00:00', '2020-01-31 16:00:00', 'adfadsdsaf', 1, 'asdfsdaf', 'partly damaged', 'asdf', 'asdf'),
(10, 32, 40, 24, '2020-01-31 16:00:00', '2020-01-31 16:00:00', 'adsf', 2, 'asdfasdf', 'beyond repair', 'beyond rapair', 'notesnotesnotes'),
(11, 32, 40, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(12, 32, 40, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(13, 32, 40, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(14, 33, 40, 26, '2020-01-31 16:00:00', '2020-01-31 16:00:00', 'asdfasdf', 123, 'asdf', 'partly damaged', 'asdf', 'asdf'),
(15, 33, 40, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fas;jklfdsja;aklsdjf', 123, 'asdfasdfasdf', 'repaired', 'asdfsdaf', 'asdfadfsfdsa'),
(16, 34, 40, 25, '2020-01-31 16:00:00', '2020-02-01 16:00:00', 'fdsaf123sdadf', 5, 'asdfasfsadf', 'for replacement', 'adsfsadfsda', 'testing'),
(17, 34, 40, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(18, 34, 40, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(19, 34, 40, 25, '0000-00-00 00:00:00', '2020-01-31 16:00:00', 'asdasdfsadsadf', 3, 'asdfasdfdsa', 'repaired', 'asasdf', 'dfasfasfsdfsd'),
(20, 34, 40, 25, '0000-00-00 00:00:00', '2020-01-31 16:00:00', 'asdasdfsadsadf', 3, 'asdfasdfdsa', 'repaired', 'asasdf', 'dfasfasfsdfsd'),
(21, 34, 40, 25, '0000-00-00 00:00:00', '2020-01-31 16:00:00', 'asdasdfsadsadf', 3, 'asdfasdfdsa', 'repaired', 'asasdf', 'dfasfasfsdfsd'),
(22, 34, 40, 25, '2020-01-31 16:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(23, 34, 40, 25, '2020-01-31 16:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(24, 34, 40, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '', '', ''),
(25, 34, 40, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', 'beyond repair', 'asdfadsfadsf', 'asdf'),
(26, 34, 40, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', 'beyond repair', 'asdfadsfadsf', 'asdf'),
(27, 34, 40, 25, '0000-00-00 00:00:00', '2020-01-31 16:00:00', 'hays!', 3, 'asdf', 'repaired', 'adsfdas', 'dasfasdfsfasfas'),
(28, 34, 40, 25, '2020-01-31 16:00:00', '2020-01-31 16:00:00', 'Model/Description:', 1, 'Serial Number:', 'for replacement', 'replace', 'note notesnotess'),
(29, 35, 40, 25, '2020-01-31 16:00:00', '0000-00-00 00:00:00', 'Model/Description:', 3, 'Model/Description:', 'partly damaged', 'asdf', 'the notes here'),
(30, 36, 40, 24, '2020-01-31 16:00:00', '2020-01-31 16:00:00', 'asdfsadf', 2, 'asdfasdf', 'partly damaged', 'asdfadsf', 'asdfdsdsfadsads'),
(31, 37, 40, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', 'beyond repair', 'asdfsdfds', 'abcdefg'),
(32, 38, 40, 26, '2020-01-31 16:00:00', '0000-00-00 00:00:00', 'asdfsafd', 0, 'asdfsdaf', 'repaired', 'asdfasdf', 'NOTES NOTES NOTES'),
(33, 38, 40, 26, '2020-01-31 16:00:00', '2020-01-31 16:00:00', 'adsfsdaf', 5, 'asdfsadfsadfsda', 'partly damaged', 'asdf', 'NOTES NOTES'),
(34, 39, 40, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'adfasdf', 2, 'asdfsdaf', 'partly damaged', 'asdfasdf', 'note snotes notes'),
(35, 40, 40, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asdfasdf', 2, 'asdfasdf', 'partly damaged', 'asdf', 'note snotes'),
(36, 40, 40, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asdfasdf', 2, 'asdfasdf', 'partly damaged', 'asdf', 'note snotes'),
(37, 40, 40, 25, '2020-01-31 16:00:00', '0000-00-00 00:00:00', 'adfasdfdasfdsa', 2, 'adsfasdfsdf', 'partly damaged', 'adsfdas', 'notes otse notes nosentoseka;fj;dlaskfjsdf'),
(38, 41, 40, 25, '2020-01-31 16:00:00', '2020-01-31 16:00:00', 'asdfasdfasdf', 2, 'adsfsadfasdfasdf', 'partly damaged', 'asdf', 'fadsafsdfsdfasfdsafds'),
(39, 42, 40, 24, '2020-01-31 16:00:00', '2020-01-31 16:00:00', 'mo', 0, '123456789', 'repaired', 'good', 'noteeeeeeeeee'),
(40, 43, 40, 24, '0000-00-00 00:00:00', '2020-01-31 16:00:00', 'Model/Description:', 10.05, 'fasfsdfsadafsd', 'partly damaged', 'asdf', 'fasdf'),
(41, 44, 40, 24, '2020-01-31 16:00:00', '2020-01-31 16:00:00', 'asdfasdfsdaf', 0.05, 'asdfasdfasdf', 'for replacement', 'hehehe', 'heheh'),
(42, 45, 40, 24, '2020-01-31 16:00:00', '2020-02-01 16:00:00', 'Model/Description:', 0.06, 'asdfasdf', 'partly damaged', 'damaged ', 'the notes'),
(43, 46, 40, 25, '2020-01-31 16:00:00', '2020-01-31 16:00:00', 'asdfsdafsdaf', 10.1, 'asdfsdaf', 'partly damaged', 'asdf', 'fasd'),
(44, 48, 40, 25, '2020-01-31 16:00:00', '2020-02-01 16:00:00', 'reegerwgewrgewrg', 0.07, 'ewrgewrgerwgergereger', 'for replacement', 'i replace mon', 'testing notes 123');

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
(1, 0, 'rocknroll', 'e780f6b40bbc916f8b8a36a90b84c636', '1', 'programmer', NULL),
(38, NULL, 'OPAG', '06a383ef4618e44cead97a238c85dbf4', '1', 'department', 8),
(39, NULL, 'PGO-Main', '59009d1d1d36ff60872d330e36b5d508', '1', 'department', 10),
(40, 18, 'jennyrose', '758af45d6ed1c16c9e60e5d1a20f1850', '1', 'admin', 1),
(41, 19, 'brianjr', '685c3795d05138dce880eb566fbdec33', '1', 'personnel', NULL),
(42, 20, 'raesandy', '5e89b388c66d9b3e7f74aa1d29bfa124', '1', 'personnel', NULL),
(43, 21, 'gretchen', '759949062e065aff5dadea6a27e6b00d', '1', 'personnel', NULL),
(44, 22, 'jando', 'f45731e3d39a1b2330bbf93e9b3de59e', '1', 'admin', NULL),
(46, 24, 'programmer', '5f4dcc3b5aa765d61d8327deb882cf99', '1', 'programmer', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `department_tbl`
--
ALTER TABLE `department_tbl`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `hardwarecomponent_tbl`
--
ALTER TABLE `hardwarecomponent_tbl`
  MODIFY `hwcomponent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `itservices_request_tbl`
--
ALTER TABLE `itservices_request_tbl`
  MODIFY `itsrequest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `repassessreport_tbl`
--
ALTER TABLE `repassessreport_tbl`
  MODIFY `repassessreport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `repinspectreport_tbl`
--
ALTER TABLE `repinspectreport_tbl`
  MODIFY `repinspectreport_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useraccount_tbl`
--
ALTER TABLE `useraccount_tbl`
  MODIFY `useraccount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
  ADD CONSTRAINT `itservices_request_tbl_ibfk_4` FOREIGN KEY (`hwcomponent_id`) REFERENCES `hardwarecomponent_tbl` (`hwcomponent_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
