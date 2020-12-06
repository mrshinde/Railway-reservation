-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2020 at 10:58 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railways`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_agent`
--

CREATE TABLE `booking_agent` (
  `agent_id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `credit_card` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_agent`
--

INSERT INTO `booking_agent` (`agent_id`, `name`, `credit_card`, `address`) VALUES
(1, 'Bob', '123456789', 'IIT Ropar');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `name` varchar(30) NOT NULL,
  `pnr` int(20) NOT NULL,
  `coach_type` varchar(10) NOT NULL,
  `berth` int(10) NOT NULL,
  `coach_number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`name`, `pnr`, `coach_type`, `berth`, `coach_number`) VALUES
('Mohit', 1606368671, 'AC', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `released_train`
--

CREATE TABLE `released_train` (
  `uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `noac` int(4) NOT NULL,
  `nosc` int(4) NOT NULL,
  `lac` int(4) NOT NULL DEFAULT 0,
  `lsc` int(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `released_train`
--

INSERT INTO `released_train` (`uid`, `date`, `noac`, `nosc`, `lac`, `lsc`) VALUES
(10000, '2020-11-26', 1, 1, 1, 0),
(12345, '2020-11-27', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `uid` int(5) NOT NULL,
  `pnr` int(20) NOT NULL,
  `date` date NOT NULL,
  `agent_id` int(10) NOT NULL,
  `nop` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`uid`, `pnr`, `date`, `agent_id`, `nop`) VALUES
(12345, 1606368671, '2020-11-27', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trains`
--

CREATE TABLE `trains` (
  `uid` int(5) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trains`
--

INSERT INTO `trains` (`uid`, `origin`, `destination`) VALUES
(10000, 'Delhi', 'Mumbai'),
(12345, 'Mumbai', 'Pune');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_agent`
--
ALTER TABLE `booking_agent`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD KEY `pnr` (`pnr`);

--
-- Indexes for table `released_train`
--
ALTER TABLE `released_train`
  ADD PRIMARY KEY (`uid`,`date`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`pnr`),
  ADD KEY `uid` (`uid`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`uid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`pnr`) REFERENCES `ticket` (`pnr`);

--
-- Constraints for table `released_train`
--
ALTER TABLE `released_train`
  ADD CONSTRAINT `uid` FOREIGN KEY (`uid`) REFERENCES `trains` (`uid`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `trains` (`uid`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`agent_id`) REFERENCES `booking_agent` (`agent_id`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`uid`) REFERENCES `released_train` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
