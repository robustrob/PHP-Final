-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2016 at 02:27 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookingapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `b_id` int(8) NOT NULL,
  `u_id` int(5) NOT NULL,
  `b_fname` varchar(30) NOT NULL,
  `b_lname` varchar(30) NOT NULL,
  `b_address` varchar(50) NOT NULL,
  `b_apt_num` varchar(7) NOT NULL,
  `b_city` varchar(25) NOT NULL,
  `b_state` varchar(30) NOT NULL,
  `b_country` varchar(30) NOT NULL,
  `b_zip` varchar(15) NOT NULL,
  `b_cc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`b_id`, `u_id`, `b_fname`, `b_lname`, `b_address`, `b_apt_num`, `b_city`, `b_state`, `b_country`, `b_zip`, `b_cc`) VALUES
(0, 1, 'Roberto', 'Viglione', '5740 robert boul.', '', 'Monteral', 'Quebec', 'Canada', 'H1P1M4', '1234-1234-1234-1234'),
(0, 50, 'Roberto', 'Viglione', '5740 robert boul.', '', 'Monteral', 'Quebec', 'Canada', 'H1P1M4', '1234-1234-1234-1234');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `f_id` int(7) NOT NULL,
  `f_location` varchar(255) NOT NULL,
  `f_mime_type` varchar(30) NOT NULL,
  `u_id` int(5) NOT NULL,
  `f_uploaded_by` int(5) NOT NULL,
  `f_upload_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `p_id` int(8) NOT NULL,
  `p_status` int(1) NOT NULL,
  `p_method` int(1) NOT NULL,
  `b_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`p_id`, `p_status`, `p_method`, `b_id`) VALUES
(0, 1, 2, 0),
(0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `m_id` int(1) NOT NULL,
  `m_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`m_id`, `m_name`) VALUES
(1, 'Visa'),
(2, 'MasterCard');

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `ps_id` int(1) NOT NULL,
  `ps_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `r_id` int(8) NOT NULL,
  `u_id` int(5) NOT NULL,
  `expiration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `r_id` int(3) NOT NULL,
  `r_min_payment` decimal(5,2) NOT NULL,
  `r_max_sessions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`r_id`, `r_min_payment`, `r_max_sessions`) VALUES
(1, '60.00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `s_id` int(8) NOT NULL,
  `s_start` datetime NOT NULL,
  `s_end` datetime NOT NULL,
  `u_id` int(5) NOT NULL,
  `s_type` int(1) NOT NULL,
  `s_desc` varchar(255) NOT NULL,
  `p_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`s_id`, `s_start`, `s_end`, `u_id`, `s_type`, `s_desc`, `p_id`) VALUES
(1, '2016-04-29 10:00:00', '2016-04-29 15:00:00', 42, 0, 'Mixing the last track of the ablum', 1),
(2, '2016-04-29 16:00:00', '2016-04-29 20:48:00', 42, 0, 'Mixing the last track of the ablum', 1),
(5, '2016-04-27 10:00:00', '2016-04-27 16:00:00', 42, 0, 'sdfg', 0),
(7, '2016-04-29 09:00:00', '2016-04-29 10:00:00', 1, 1, 'Description', 0),
(10, '2016-04-30 09:00:00', '2016-04-30 13:00:00', 1, 1, 'Description', 0),
(11, '2016-04-30 13:00:00', '2016-04-30 21:00:00', 50, 1, 'Description', 0);

-- --------------------------------------------------------

--
-- Table structure for table `session_type`
--

CREATE TABLE `session_type` (
  `t_id` int(1) NOT NULL,
  `t_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(5) NOT NULL,
  `u_name` varchar(30) NOT NULL,
  `u_first` varchar(30) NOT NULL,
  `u_last` varchar(30) NOT NULL,
  `u_pass` varchar(255) NOT NULL,
  `u_salt` varchar(3) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `login_ip` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_first`, `u_last`, `u_pass`, `u_salt`, `u_email`, `login_ip`) VALUES
(1, 'admin', 'admin', 'admin', '167f20a7444b473854718db5078554ae04d5c50f4e996f26a867b54a5fbe7568', 'adf', 'rviglione@alizeti.ca', '::1'),
(42, 'robertoviglione', 'Roberto', 'Viglione', '82bc3ddb331512b53a49eca31bb3f8395f181831c06070fe294065198452dec3', '985', 'berto.viglione@gmail.com', '::1'),
(50, 'robrob', 'Roberto', 'Viglione', 'fc6f8d0309e5029de1d335fc86a00c152404e7617efd5e437f9b1e48202e88ab', 'f4b', 'r@r.com', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_availabilities`
--

CREATE TABLE `weekly_availabilities` (
  `a_id` int(3) NOT NULL,
  `a_startday` enum('Monday','Tuesday','Wednesday','Thursday','Firday','Saturday','Sunday') NOT NULL,
  `a_endday` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `a_starttime` time NOT NULL,
  `a_endtime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weekly_availabilities`
--

INSERT INTO `weekly_availabilities` (`a_id`, `a_startday`, `a_endday`, `a_starttime`, `a_endtime`) VALUES
(1, 'Monday', 'Saturday', '09:00:00', '21:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `weekly_availabilities`
--
ALTER TABLE `weekly_availabilities`
  ADD PRIMARY KEY (`a_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `s_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `weekly_availabilities`
--
ALTER TABLE `weekly_availabilities`
  MODIFY `a_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
