-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2019 at 01:52 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rfid_tracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE `devices` (
  `device_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `rfid` varchar(50) DEFAULT '',
  `name` varchar(50) DEFAULT '',
  `balance` double DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`device_id`, `location_id`, `rfid`, `name`, `balance`, `created_at`, `updated_at`) VALUES
(1, 2, '0008166538', 'BH 1234 BD', 83860, '2019-10-17 10:59:16', '2019-10-27 06:39:43'),
(2, 2, '0005397421', 'BH 4567 BC', 983860, '2019-10-26 05:02:00', '2019-10-27 06:46:34'),
(6, 3, '0000418278', 'BM 5838 CK', 100280, '2019-10-28 04:39:35', '2019-10-28 12:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `device_log`
--

DROP TABLE IF EXISTS `device_log`;
CREATE TABLE `device_log` (
  `device_log_id` int(11) NOT NULL,
  `device_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_log`
--

INSERT INTO `device_log` (`device_log_id`, `device_id`, `location_id`, `distance`, `price`, `balance`, `datetime`) VALUES
(271, 1, 1, 10.5, 8900, 100000, '2019-10-28 02:49:14'),
(272, 1, 1, 0, 0, -19720, '2019-10-28 10:35:47'),
(273, 2, 1, 0, 0, 1000000, '2019-10-28 10:35:50'),
(274, 2, 2, 5.38, 16140, 983860, '2019-10-27 06:46:34'),
(275, 1, 2, 5.38, 16140, 83860, '2019-10-27 06:39:43'),
(276, 6, 3, 8.24, 24720, 75280, '2019-10-28 12:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `unique_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `latitude` double NOT NULL DEFAULT '0',
  `longitude` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `unique_id`, `name`, `latitude`, `longitude`) VALUES
(1, '3493810227', 'Watch Tower Eddy', 0.474736, 101.4405126),
(2, '3397137144', 'Watch Tower  Tomo', 0.463417, 101.393482),
(3, '1585764841', 'Watch Tower Ferdy', 0.50128, 101.509621),
(4, '950726089', 'Watch Tower Agus', 0.415278, 101.43357);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `content` varchar(1000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `location_id`, `content`) VALUES
(4, 1, 'Welcome to Map Tracking!'),
(5, 2, 'Hai Tomo, terima kasih telah menggunakan layanan kami! ');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL DEFAULT '0',
  `location_from_id` int(11) DEFAULT NULL,
  `location_to_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `device_id`, `location_from_id`, `location_to_id`) VALUES
(7, 1, 1, 3),
(8, 2, 1, 2),
(9, 6, 3, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `device_log`
--
ALTER TABLE `device_log`
  ADD PRIMARY KEY (`device_log_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `device_log`
--
ALTER TABLE `device_log`
  MODIFY `device_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
