-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2024 at 11:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `file_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `admin_user` text NOT NULL,
  `admin_password` text NOT NULL,
  `admin_status` varchar(50) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `name`, `admin_user`, `admin_password`, `admin_status`, `designation`) VALUES
(13, 'admin', 'admin@plp.edu.ph', '$2y$12$UA8lWGiReEC5mo3iJaDbs.tjEmt3sF5HeaXv7q5.T8SXcnhy3zvJO', 'Admin', 'CCS');

-- --------------------------------------------------------

--
-- Table structure for table `department_office`
--

CREATE TABLE `department_office` (
  `ID` int(4) UNSIGNED ZEROFILL NOT NULL,
  `offices` varchar(200) NOT NULL,
  `OFNAME` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_office`
--

INSERT INTO `department_office` (`ID`, `offices`, `OFNAME`) VALUES
(1026, 'CCS', 'College of Computer Study');

-- --------------------------------------------------------

--
-- Table structure for table `download_log`
--

CREATE TABLE `download_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `DEPARTMENT` varchar(200) NOT NULL,
  `SIZE` varchar(200) NOT NULL,
  `DOWNLOAD` int(200) NOT NULL,
  `MONTH` varchar(200) NOT NULL,
  `TIME` varchar(200) NOT NULL,
  `YEAR` int(200) NOT NULL,
  `ACC_STATUS` varchar(200) NOT NULL,
  `EMAIL` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_log`
--

CREATE TABLE `history_log` (
  `log_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `email_address` text NOT NULL,
  `action` varchar(100) NOT NULL,
  `actions` varchar(200) NOT NULL DEFAULT 'Has LoggedOut the system at',
  `ip` text NOT NULL,
  `host` text NOT NULL,
  `login_time` varchar(200) NOT NULL,
  `logout_time` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_log1`
--

CREATE TABLE `history_log1` (
  `log_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `admin_user` text NOT NULL,
  `action` varchar(100) NOT NULL,
  `actions` varchar(200) NOT NULL DEFAULT 'Has LoggedOut the system at',
  `ip` text NOT NULL,
  `host` text NOT NULL,
  `login_time` varchar(200) NOT NULL,
  `logout_time` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_log`
--

CREATE TABLE `hr_log` (
  `log_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `hr_user` text NOT NULL,
  `action` varchar(100) NOT NULL,
  `actions` varchar(200) NOT NULL DEFAULT 'Has LoggedOut the system at',
  `ip` text NOT NULL,
  `host` text NOT NULL,
  `login_time` varchar(200) NOT NULL,
  `logout_time` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_user`
--

CREATE TABLE `hr_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hr_email` varchar(255) NOT NULL,
  `hr_password` text NOT NULL,
  `hr_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hr_user`
--

INSERT INTO `hr_user` (`id`, `name`, `hr_email`, `hr_password`, `hr_status`) VALUES
(111, 'Seiji Ken Tuico', 'tuico_seijiken@plpasig.edu.ph', '$2y$12$X7gwnSxjJjyMTpPuDUOtxe2VAgkHZXqFSvY.rwOIMn3dl4ppdJ4pi', 'HR');

-- --------------------------------------------------------

--
-- Table structure for table `newlycreatedadmin`
--

CREATE TABLE `newlycreatedadmin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newlycreatedadmin`
--

INSERT INTO `newlycreatedadmin` (`id`, `email`, `status`) VALUES
(117, 'try@gmail.com', 'Faculty');

-- --------------------------------------------------------

--
-- Table structure for table `newlycreatedhr`
--

CREATE TABLE `newlycreatedhr` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newlycreatedpersonnel`
--

CREATE TABLE `newlycreatedpersonnel` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifcation_table`
--

CREATE TABLE `notifcation_table` (
  `id` int(11) NOT NULL,
  `controlNumber` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `SENDTO` varchar(255) NOT NULL,
  `ACTION` varchar(255) NOT NULL,
  `FILENAME` varchar(255) NOT NULL,
  `TIMERS` text NOT NULL,
  `SEEN_STATUS` tinyint(1) NOT NULL,
  `LINK` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personnel_login`
--

CREATE TABLE `personnel_login` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email_address` text NOT NULL,
  `user_password` text NOT NULL,
  `user_status` varchar(50) NOT NULL,
  `designation` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `personnel_login`
--

INSERT INTO `personnel_login` (`id`, `name`, `email_address`, `user_password`, `user_status`, `designation`) VALUES
(6, 'ss', 'uadmin@plp.edu.ph', '$2y$12$4q/HdLNNY1tn7t568J23TuoFNSPSLysXI9L62xYnMsHTi5Ginxbme', 'User', 'CAS');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(10) NOT NULL,
  `REQUESTID` int(8) UNSIGNED ZEROFILL NOT NULL,
  `DEPARTMENT` varchar(200) NOT NULL,
  `REQUEST` text NOT NULL,
  `SENDTO` varchar(200) NOT NULL,
  `TIMERS` varchar(200) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `STATUS` varchar(200) NOT NULL,
  `ACKNOWLEDGED` tinyint(1) NOT NULL,
  `SEEN_STATUS` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `requests`
--
DELIMITER $$
CREATE TRIGGER `set_REQUESTID` BEFORE INSERT ON `requests` FOR EACH ROW BEGIN


    SET NEW.REQUESTID = (SELECT IFNULL(MAX(REQUESTID), 0) + 1 FROM requests);


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `resetpasswords`
--

CREATE TABLE `resetpasswords` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `timeOut` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send_history`
--

CREATE TABLE `send_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `controlNumber` varchar(11) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `DEPARTMENT` varchar(20) NOT NULL,
  `SIZE` varchar(200) NOT NULL,
  `DESCRIPTION` text DEFAULT NULL,
  `SENTBY` varchar(255) NOT NULL,
  `SENDTO` varchar(200) NOT NULL,
  `DOWNLOAD` varchar(200) NOT NULL,
  `TIMERS` varchar(200) NOT NULL,
  `DESIGNATION` varchar(255) NOT NULL,
  `ADMIN_STATUS` varchar(300) NOT NULL,
  `EMAIL` text NOT NULL,
  `YEAR` int(200) NOT NULL,
  `SEEN_STATUS` int(200) NOT NULL,
  `ARCHIVE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signature_data`
--

CREATE TABLE `signature_data` (
  `signature_id` int(11) NOT NULL,
  `hr_email` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `signature_1` varchar(255) DEFAULT NULL,
  `signature_2` varchar(255) DEFAULT NULL,
  `signature_3` varchar(255) DEFAULT NULL,
  `signature_4` varchar(255) DEFAULT NULL,
  `signature_5` varchar(255) DEFAULT NULL,
  `signature_6` varchar(255) DEFAULT NULL,
  `signature_7` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upload_files`
--

CREATE TABLE `upload_files` (
  `id` int(10) UNSIGNED NOT NULL,
  `controlNumber` int(8) UNSIGNED ZEROFILL NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `DEPARTMENT` varchar(20) NOT NULL,
  `SIZE` varchar(200) NOT NULL,
  `DESCRIPTION` text DEFAULT NULL,
  `SENTBY` varchar(255) NOT NULL,
  `SENDTO` varchar(200) NOT NULL,
  `DOWNLOAD` varchar(200) NOT NULL,
  `TIMERS` varchar(200) NOT NULL,
  `TIMEDOWNLOAD` varchar(255) NOT NULL,
  `DESIGNATION` varchar(255) NOT NULL,
  `ADMIN_STATUS` varchar(300) NOT NULL,
  `EMAIL` text NOT NULL,
  `YEAR` int(200) NOT NULL,
  `SEEN_STATUS` int(200) NOT NULL,
  `ARCHIVE` tinyint(1) NOT NULL,
  `file_status` varchar(50) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `upload_files`
--
DELIMITER $$
CREATE TRIGGER `set_controlNumber` BEFORE INSERT ON `upload_files` FOR EACH ROW BEGIN

    SET NEW.controlNumber = (SELECT IFNULL(MAX(controlNumber), 0) + 1 FROM upload_files);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `upload_log`
--

CREATE TABLE `upload_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `DEPARTMENT` varchar(200) NOT NULL,
  `SIZE` varchar(200) NOT NULL,
  `UPLOAD` int(200) NOT NULL,
  `MONTH` varchar(200) NOT NULL,
  `TIME` varchar(200) NOT NULL,
  `YEAR` int(200) NOT NULL,
  `ACC_STATUS` varchar(200) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `file_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_signatures`
--

CREATE TABLE `user_signatures` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yearvalidation`
--

CREATE TABLE `yearvalidation` (
  `YEAR` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `yearvalidation`
--

INSERT INTO `yearvalidation` (`YEAR`) VALUES
(2024),
(2024),
(2024),
(2024);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_office`
--
ALTER TABLE `department_office`
  ADD PRIMARY KEY (`ID`,`offices`);

--
-- Indexes for table `download_log`
--
ALTER TABLE `download_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_log`
--
ALTER TABLE `history_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `history_log1`
--
ALTER TABLE `history_log1`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `hr_user`
--
ALTER TABLE `hr_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newlycreatedadmin`
--
ALTER TABLE `newlycreatedadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newlycreatedhr`
--
ALTER TABLE `newlycreatedhr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newlycreatedpersonnel`
--
ALTER TABLE `newlycreatedpersonnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifcation_table`
--
ALTER TABLE `notifcation_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel_login`
--
ALTER TABLE `personnel_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resetpasswords`
--
ALTER TABLE `resetpasswords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_history`
--
ALTER TABLE `send_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signature_data`
--
ALTER TABLE `signature_data`
  ADD PRIMARY KEY (`signature_id`);

--
-- Indexes for table `upload_files`
--
ALTER TABLE `upload_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_log`
--
ALTER TABLE `upload_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_signatures`
--
ALTER TABLE `user_signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `department_office`
--
ALTER TABLE `department_office`
  MODIFY `ID` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1027;

--
-- AUTO_INCREMENT for table `download_log`
--
ALTER TABLE `download_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `history_log`
--
ALTER TABLE `history_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `history_log1`
--
ALTER TABLE `history_log1`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `hr_user`
--
ALTER TABLE `hr_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `newlycreatedadmin`
--
ALTER TABLE `newlycreatedadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `newlycreatedhr`
--
ALTER TABLE `newlycreatedhr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newlycreatedpersonnel`
--
ALTER TABLE `newlycreatedpersonnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifcation_table`
--
ALTER TABLE `notifcation_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personnel_login`
--
ALTER TABLE `personnel_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `resetpasswords`
--
ALTER TABLE `resetpasswords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `send_history`
--
ALTER TABLE `send_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signature_data`
--
ALTER TABLE `signature_data`
  MODIFY `signature_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upload_files`
--
ALTER TABLE `upload_files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `upload_log`
--
ALTER TABLE `upload_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `user_signatures`
--
ALTER TABLE `user_signatures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `download_log`
--
ALTER TABLE `download_log`
  ADD CONSTRAINT `all_delete` FOREIGN KEY (`id`) REFERENCES `upload_files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_signatures`
--
ALTER TABLE `user_signatures`
  ADD CONSTRAINT `user_signatures_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `admin_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
