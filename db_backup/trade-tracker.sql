-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2016 at 11:41 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trade-tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `ADDRESSID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The unique address ID.',
  `LABEL` varchar(100) NOT NULL COMMENT 'The name of the person or organisation to which the address belongs.',
  `STREET` varchar(100) NOT NULL COMMENT 'The name of the street.',
  `HOUSENUMBER` varchar(10) NOT NULL COMMENT 'The house number (and any optional additions).',
  `POSTALCODE` varchar(6) NOT NULL COMMENT 'The postal code for the address.',
  `CITY` varchar(100) NOT NULL COMMENT 'The city in which the address is located.',
  `COUNTRY` varchar(100) NOT NULL COMMENT 'The country in which the address is located.',
  PRIMARY KEY (`ADDRESSID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='A physical address belonging to a person or organisation.' AUTO_INCREMENT=17 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`ADDRESSID`, `LABEL`, `STREET`, `HOUSENUMBER`, `POSTALCODE`, `CITY`, `COUNTRY`) VALUES
(11, 'Shahbaz', '6c Street, Hor Al Anz, Dubai', '10C', '5800', 'dubai', 'UAE'),
(12, 'Shahbaz', 'New, street', '10C', '5800', 'dubai', 'UAE'),
(13, 'Shahbaz', '6c Street, Hor Al Anz, Dubai', '10C', '5800', 'dubai', 'UAE'),
(14, 'New Lable', 'Hello', '123G', '5600', 'Lahore', 'Pakistan'),
(15, 'SADASD', 'Helloggggggggggggg', '123G', '5600', 'Lahore', 'Pakistan'),
(16, 'SADASD', 'Helloggggggggggggg', '123G', '5600', 'Lahore', 'Pakistan AAA');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
