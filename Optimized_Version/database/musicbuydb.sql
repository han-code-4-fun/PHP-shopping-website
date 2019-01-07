-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 07, 2019 at 03:43 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicbuydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customertbl`
--

DROP TABLE IF EXISTS `customertbl`;
CREATE TABLE IF NOT EXISTS `customertbl` (
  `cust_id` int(5) NOT NULL AUTO_INCREMENT,
  `cust_fname` varchar(20) NOT NULL,
  `cust_lname` varchar(20) NOT NULL,
  `cust_email` varchar(20) NOT NULL,
  `cust_passw` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customertbl`
--

INSERT INTO `customertbl` (`cust_id`, `cust_fname`, `cust_lname`, `cust_email`, `cust_passw`) VALUES
(51, 'h', 'z', 'zh@gmail.com', '$2y$10$ydbQpgiWjG8qULmx2m4yf.GxgvLNg94qlvofEN8j3PrGDhcEGx3Cm'),
(52, 'han', 'zhou', 'zh', '$2y$10$r9CWMW8zMDUoQT3sXrQfleUqXTXi/V/Ke5Xl29xh0fMdkeonBlWzO'),
(53, 'h', 'h', 'h', 'z123456');

-- --------------------------------------------------------

--
-- Table structure for table `musictbl`
--

DROP TABLE IF EXISTS `musictbl`;
CREATE TABLE IF NOT EXISTS `musictbl` (
  `music_id` int(7) NOT NULL AUTO_INCREMENT,
  `music_title` varchar(50) NOT NULL,
  `music_type` enum('c','j','p') NOT NULL,
  `music_duration` int(4) DEFAULT '3',
  `music_no_times` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`music_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `musictbl`
--

INSERT INTO `musictbl` (`music_id`, `music_title`, `music_type`, `music_duration`, `music_no_times`) VALUES
(1, 'Good Girl', 'c', 3, 3),
(2, 'Even if it breaks your heart', 'c', 3, 2),
(3, 'Relax', 'p', 3, 6),
(4, 'A woman like you', 'c', 3, 10),
(5, 'What a wonderful World', 'j', 3, 2),
(6, 'Chicken Fried', 'c', 3, 3),
(7, 'Night Fever', 'p', 3, 0),
(8, 'Feeling Good', 'j', 3, 2),
(9, 'Physical', 'p', 3, 0),
(10, 'Just a kiss', 'c', 3, 2),
(11, 'Hard to love', 'c', 3, 0),
(12, 'Take on me', 'p', 3, 0),
(13, 'Waterfalls', 'p', 3, 8),
(14, 'Bette Davies Eyes', 'p', 3, 4),
(15, 'Billy Jean', 'p', 3, 0),
(16, 'Say Say Say', 'p', 3, 0),
(17, 'These are days', 'j', 3, 2),
(18, 'Jump', 'p', 3, 0),
(19, 'Green Onions', 'j', 3, 1),
(20, 'Every breath you take', 'p', 3, 2),
(21, 'Ebony and Ivory', 'p', 3, 0),
(22, 'Like a virgin', 'p', 3, 0),
(23, 'I put a spell on you', 'j', 3, 0),
(24, 'That Man', 'j', 3, 1),
(25, 'So What', 'j', 3, 1),
(26, 'You light my life', 'p', 3, 10),
(27, 'Da Ta think I\'m sexy', 'p', 3, 1),
(28, 'American Pie', 'p', 3, 8),
(29, 'I\'ll be there', 'p', 3, 1),
(30, 'My Sharona', 'p', 3, 1),
(31, 'Got my country on', 'c', 3, 21);

-- --------------------------------------------------------

--
-- Table structure for table `music_data`
--

DROP TABLE IF EXISTS `music_data`;
CREATE TABLE IF NOT EXISTS `music_data` (
  `m_id` int(2) NOT NULL AUTO_INCREMENT,
  `m_type` char(1) NOT NULL,
  `m_price` decimal(5,2) NOT NULL,
  `m_icon` varchar(25) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music_data`
--

INSERT INTO `music_data` (`m_id`, `m_type`, `m_price`, `m_icon`) VALUES
(1, 'p', '1.34', 'image/popImg.jpg'),
(2, 'c', '0.99', 'image/countryImg.jpg'),
(3, 'j', '1.22', 'image/jazzImg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ordertbl`
--

DROP TABLE IF EXISTS `ordertbl`;
CREATE TABLE IF NOT EXISTS `ordertbl` (
  `ord_id` int(5) NOT NULL AUTO_INCREMENT,
  `ord_cust_id` int(5) NOT NULL,
  `ord_music_id` int(7) NOT NULL,
  `ord_date_added` date NOT NULL,
  `ord_price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`ord_id`)
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordertbl`
--

INSERT INTO `ordertbl` (`ord_id`, `ord_cust_id`, `ord_music_id`, `ord_date_added`, `ord_price`) VALUES
(66, 1, 6, '2018-04-14', '0.99'),
(67, 1, 2, '2018-04-14', '0.99'),
(68, 1, 1, '2018-04-14', '0.99'),
(114, 0, 5, '2019-01-06', '1.22'),
(113, 0, 4, '2019-01-06', '0.99'),
(137, 51, 10, '2019-01-07', '0.99'),
(136, 51, 22, '2019-01-07', '1.34'),
(74, 1, 8, '2018-04-14', '1.22'),
(75, 1, 24, '2018-04-14', '1.22'),
(76, 1, 12, '2018-04-14', '1.34'),
(108, 19, 15, '2018-09-23', '1.34'),
(107, 19, 14, '2018-09-23', '1.34'),
(106, 19, 28, '2018-09-23', '1.34'),
(105, 19, 4, '2018-09-23', '0.99'),
(104, 18, 25, '2018-04-15', '1.22'),
(103, 18, 1, '2018-04-15', '0.99'),
(102, 18, 8, '2018-04-15', '1.22'),
(115, 0, 26, '2019-01-06', '1.34'),
(123, 0, 17, '2019-01-06', '1.22'),
(122, 0, 24, '2019-01-06', '1.22'),
(135, 0, 15, '2019-01-06', '1.34'),
(134, 0, 8, '2019-01-06', '1.22'),
(133, 51, 27, '2019-01-06', '1.34'),
(132, 51, 15, '2019-01-06', '1.34'),
(129, 0, 10, '2019-01-06', '0.99'),
(131, 51, 14, '2019-01-06', '1.34');

DELIMITER $$
--
-- Events
--
DROP EVENT `expire`$$
CREATE DEFINER=`root`@`localhost` EVENT `expire` ON SCHEDULE EVERY 1 MINUTE STARTS '2018-04-14 00:42:41' ON COMPLETION NOT PRESERVE ENABLE DO delete from ordertbl where timestampdiff(minute, ord_date_added, now()) > 10$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
