-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2017 at 08:39 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ktcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `VIN` int(20) NOT NULL,
  `Model` varchar(40) NOT NULL,
  `Year` year(4) NOT NULL,
  `Location` varchar(40) NOT NULL,
  `Daily Rental Fee` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`VIN`, `Model`, `Year`, `Location`, `Daily Rental Fee`) VALUES
(10148977, 'Dodge Grand Caravan', 2012, 'King St', 55),
(11111111, 'Honda Civic', 2016, 'Division St', 60),
(12298765, 'Mercedes Benz', 2011, 'King St', 50),
(12345678, 'Honda Accord', 2010, 'Princess St', 50),
(14165780, 'Toyota Corolla', 2016, 'King St', 55),
(14780922, 'Hyundai Sonata', 2011, 'Princess St', 50),
(44143764, 'Ford F-150', 2014, 'Division St', 70);

-- --------------------------------------------------------

--
-- Table structure for table `car maintenance history`
--

CREATE TABLE `car maintenance history` (
  `VIN` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Odometer Reading` int(7) NOT NULL,
  `Maintenance Type` char(15) NOT NULL,
  `Description` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car maintenance history`
--

INSERT INTO `car maintenance history` (`VIN`, `Date`, `Odometer Reading`, `Maintenance Type`, `Description`) VALUES
('10148977', '2015-10-21', 78000, 'Bumper Repair', 'Scratched, minor dents.'),
('11111111', '2016-09-12', 41997, 'Tires', 'One flat tired (popped), replacement.'),
('12345678', '2016-12-25', 69000, 'Engine', 'Engine repair.');

-- --------------------------------------------------------

--
-- Table structure for table `car rental history`
--

CREATE TABLE `car rental history` (
  `VIN` varchar(40) NOT NULL,
  `Pick-up Odometer Reading` int(7) NOT NULL,
  `Drop-off Odometer Reading` int(7) NOT NULL,
  `Return Status` text NOT NULL,
  `MemberID` int(12) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car rental history`
--

INSERT INTO `car rental history` (`VIN`, `Pick-up Odometer Reading`, `Drop-off Odometer Reading`, `Return Status`, `MemberID`, `Date`) VALUES
('10148977', 77900, 78000, 'Front bumper damaged.', 55667788, '2015-10-14'),
('11111111', 41800, 41991, 'One flat tire.', 11223344, '2016-09-09'),
('11111111', 39000, 40109, 'Stained chairs.', 99887766, '2017-01-12'),
('12345678', 69900, 70000, 'Normal', 11223344, '2016-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `ktcs members`
--

CREATE TABLE `ktcs members` (
  `Name` varchar(20) NOT NULL,
  `Address` varchar(40) NOT NULL,
  `Phone Number` bigint(13) NOT NULL,
  `Email` varchar(36) DEFAULT NULL,
  `DLN` int(10) NOT NULL,
  `Monthly Membership Fee` int(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ktcs members`
--

INSERT INTO `ktcs members` (`Name`, `Address`, `Phone Number`, `Email`, `DLN`, `Monthly Membership Fee`, `username`, `password`) VALUES
('Michael Bay', '99 University Ave', 6130009988, 'explosions@hotmail.com', 990088, 30, 'lovemovies', 'imfamous'),
('Susan Bethesda', '100 Johnson', 1234567890, 'bethesda@gmail.com', 11223344, 30, 'user1', 'hunter2'),
('Gabe Newell', '23 Alfred St', 2147483647, 'sadPanda@gmail.com', 55667788, 30, 'gaben', 'praiseMe'),
('Jeff Kaplan', '420 Division', 9059119090, 'wrestleWJff@gmail.ca', 99887766, 30, 'jeff_kaplan', 'hanzo');

-- --------------------------------------------------------

--
-- Table structure for table `parking location`
--

CREATE TABLE `parking location` (
  `Address` varchar(40) NOT NULL,
  `Number of Spaces` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parking location`
--

INSERT INTO `parking location` (`Address`, `Number of Spaces`) VALUES
('151 Bath Road', 30),
('420 Princess Street', 50),
('47 Division Street', 45),
('54 King Street', 40);

-- --------------------------------------------------------

--
-- Table structure for table `rental comments`
--

CREATE TABLE `rental comments` (
  `MemberID` int(10) NOT NULL,
  `Model` varchar(40) NOT NULL,
  `Rating` int(1) NOT NULL,
  `Comment Text` varchar(400) NOT NULL,
  `VIN` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rental comments`
--

INSERT INTO `rental comments` (`MemberID`, `Model`, `Rating`, `Comment Text`, `VIN`) VALUES
(11223344, 'Honda Accord', 4, 'Good car, lots of space. Good on gas.', 12345678),
(55667788, 'Mercedes Benz', 4, 'Good car.', 12298765),
(99887766, 'Honda Civic', 5, 'Nice!!', 111111111);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Reservation Number` int(10) NOT NULL,
  `MemberID` int(10) NOT NULL,
  `VIN` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Access Code` varchar(20) NOT NULL,
  `Length of Reservation` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Reservation Number`, `MemberID`, `VIN`, `Date`, `Access Code`, `Length of Reservation`) VALUES
(11122233, 11223344, '11111111', '2017-01-13', 'ABXD', 3),
(12345679, 11223344, '12345678', '2017-03-02', 'PSSW', 5),
(23231414, 55667788, '12298765', '2017-01-21', 'HYYOP', 8),
(87654321, 99887766, '11111111', '2016-05-21', 'X4YNZ', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`VIN`);

--
-- Indexes for table `car maintenance history`
--
ALTER TABLE `car maintenance history`
  ADD PRIMARY KEY (`VIN`);

--
-- Indexes for table `car rental history`
--
ALTER TABLE `car rental history`
  ADD PRIMARY KEY (`VIN`,`MemberID`,`Date`);

--
-- Indexes for table `ktcs members`
--
ALTER TABLE `ktcs members`
  ADD PRIMARY KEY (`DLN`);

--
-- Indexes for table `parking location`
--
ALTER TABLE `parking location`
  ADD PRIMARY KEY (`Address`);

--
-- Indexes for table `rental comments`
--
ALTER TABLE `rental comments`
  ADD PRIMARY KEY (`MemberID`,`Model`,`Rating`,`Comment Text`,`VIN`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Reservation Number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
