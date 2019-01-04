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
(1, 'p', '1.34', 'popImg.jpg'),
(2, 'c', '0.99', 'countryImg.jpg'),
(3, 'j', '1.22', 'jazzImg.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
