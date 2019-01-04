-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 06, 2018 at 08:31 PM
-- Server version: 5.7.19
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
-- Database: `musicbuydb`
--

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
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordertbl`
--

INSERT INTO `ordertbl` (`ord_id`, `ord_cust_id`, `ord_music_id`, `ord_date_added`, `ord_price`) VALUES
(66, 1, 6, '2018-04-14', '0.99'),
(67, 1, 2, '2018-04-14', '0.99'),
(68, 1, 1, '2018-04-14', '0.99'),
(74, 1, 8, '2018-04-14', '1.22'),
(75, 1, 24, '2018-04-14', '1.22'),
(76, 1, 12, '2018-04-14', '1.34'),
(104, 18, 25, '2018-04-15', '1.22'),
(103, 18, 1, '2018-04-15', '0.99'),
(102, 18, 8, '2018-04-15', '1.22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
