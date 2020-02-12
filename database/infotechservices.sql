-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2020 at 02:54 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

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
(10, 'PGO-Main', 'Provincial Governors Office - Main Division');

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE `employee_tbl` (
  `emp_id` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `emp_idnum` int(255) NOT NULL,
  `emp_fname` varchar(255) NOT NULL,
  `emp_lname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_tbl`
--

INSERT INTO `employee_tbl` (`emp_id`, `dept_id`, `emp_idnum`, `emp_fname`, `emp_lname`) VALUES
(13, 8, 5, 'Derman', 'Dalmo'),
(14, 8, 6, 'Lolita', 'Bentres'),
(15, 8, 7, 'Johnny', 'Jose'),
(16, 8, 8, 'Dexter', 'Dimas'),
(17, 10, 9, 'Clarita', 'Prudencio'),
(18, 1, 1, 'Jenny Rose', 'Borja'),
(19, 1, 2, 'Brian Jr.', 'Mang-oy'),
(20, 1, 3, 'Rae Sandy', 'Calado'),
(21, 1, 4, 'Gretchen', 'Marrero');

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
  `hwcomponent_sub_id` int(255) NOT NULL,
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
(3, 8, 14, '2020-02-03 22:51:28', 'Layout Tarpauline - Theme: Adivay 2020 . Size: 10ftx15ft', 'received', NULL, 'other', NULL, 0, '', NULL, NULL, NULL),
(4, 10, 17, '2020-02-03 23:01:26', 'Sensor blinking red', 'deployed', 42, 'hw', 24, 0, 'pulled-out', 'PNP1', 'Reset', '2020-02-03 23:54:36'),
(5, 8, 15, '2020-02-03 23:03:05', 'Doesn\'t Power on', 'done', 40, 'hw', 25, 0, 'walk-in', 'PNUPS1', '', NULL),
(6, 8, 15, '2020-02-04 16:55:27', 'Paper Jam', 'pending', 40, 'hw', 24, 0, 'on-site', NULL, NULL, NULL),
(7, 8, 13, '2020-02-05 14:48:59', 'Paper Jam', 'post-repair inspected', 40, 'hw', 24, 0, 'pulled-out', 'PNsfds13213', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repassessreport_tbl`
--
-- Error reading structure for table infotechservices.repassessreport_tbl: #1932 - Table 'infotechservices.repassessreport_tbl' doesn't exist in engine
-- Error reading data for table infotechservices.repassessreport_tbl: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `infotechservices`.`repassessreport_tbl`' at line 1

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
(1, NULL, 'rocknroll', 'e780f6b40bbc916f8b8a36a90b84c636', '1', 'programmer', NULL),
(38, NULL, 'OPAG', '06a383ef4618e44cead97a238c85dbf4', '1', 'department', 8),
(39, NULL, 'PGO-Main', '59009d1d1d36ff60872d330e36b5d508', '1', 'department', 10),
(40, 18, 'jennyrose', '758af45d6ed1c16c9e60e5d1a20f1850', '1', 'admin', NULL),
(41, 19, 'brianjr', '685c3795d05138dce880eb566fbdec33', '1', 'personnel', NULL),
(42, 20, 'raesandy', '5e89b388c66d9b3e7f74aa1d29bfa124', '1', 'personnel', NULL),
(43, 21, 'gretchen', '759949062e065aff5dadea6a27e6b00d', '1', 'personnel', NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `department_tbl`
--
ALTER TABLE `department_tbl`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `hardwarecomponent_tbl`
--
ALTER TABLE `hardwarecomponent_tbl`
  MODIFY `hwcomponent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `itservices_request_tbl`
--
ALTER TABLE `itservices_request_tbl`
  MODIFY `itsrequest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `repinspectreport_tbl`
--
ALTER TABLE `repinspectreport_tbl`
  MODIFY `repinspectreport_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useraccount_tbl`
--
ALTER TABLE `useraccount_tbl`
  MODIFY `useraccount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `repinspectreport_tbl`
--
ALTER TABLE `repinspectreport_tbl`
  ADD CONSTRAINT `repinspectreport_tbl_ibfk_1` FOREIGN KEY (`repassessreport_id`) REFERENCES `repassessreport_tbl` (`repassessreport_id`),
  ADD CONSTRAINT `repinspectreport_tbl_ibfk_2` FOREIGN KEY (`preinspector_emp_id`) REFERENCES `employee_tbl` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `useraccount_tbl`
--
ALTER TABLE `useraccount_tbl`
  ADD CONSTRAINT `useraccount_tbl_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_tbl` (`emp_id`),
  ADD CONSTRAINT `useraccount_tbl_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `department_tbl` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
