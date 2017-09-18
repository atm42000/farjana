-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2017 at 06:26 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientID` int(4) NOT NULL,
  `modified` datetime NOT NULL,
  `client` varchar(50) COLLATE utf8_bin NOT NULL,
  `address` varchar(50) COLLATE utf8_bin NOT NULL,
  `city` varchar(25) COLLATE utf8_bin NOT NULL,
  `state` varchar(2) COLLATE utf8_bin NOT NULL,
  `zip` varchar(10) COLLATE utf8_bin NOT NULL,
  `phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `web` varchar(50) COLLATE utf8_bin NOT NULL,
  `employeeID` int(4) NOT NULL,
  `notes` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientID`, `modified`, `client`, `address`, `city`, `state`, `zip`, `phone`, `web`, `employeeID`, `notes`) VALUES
(1, '2017-09-16 23:31:04', 'Apple', '1 Infinite Loop', 'Cupertino', 'CA', '95014', '408-996â€“1010', 'www.apple.com', 0, 'iPhone, iPad'),
(2, '2017-09-16 23:18:18', 'Comcast', '', '', '', '', '', 'www.comcast.net', 0, ''),
(3, '2017-09-16 23:22:45', 'Palo Alto Networks', '', 'Santa Clara', 'CA', '', '', 'www.paloaltonetworks.com', 0, ''),
(4, '2017-09-16 00:01:20', 'Verizon', '', '', '', '', '', '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
