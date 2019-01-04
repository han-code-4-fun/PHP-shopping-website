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
(1, 'Good Girl', 'c', 3, 2),
(2, 'Even if it breaks your heart', 'c', 3, 2),
(3, 'Relax', 'p', 3, 6),
(4, 'A woman like you', 'c', 3, 8),
(5, 'What a wonderful World', 'j', 3, 0),
(6, 'Chicken Fried', 'c', 3, 3),
(7, 'Night Fever', 'p', 3, 0),
(8, 'Feeling Good', 'j', 3, 2),
(9, 'Physical', 'p', 3, 0),
(10, 'Just a kiss', 'c', 3, 0),
(11, 'Hard to love', 'c', 3, 0),
(12, 'Take on me', 'p', 3, 0),
(13, 'Waterfalls', 'p', 3, 6),
(14, 'Bette Davies Eyes', 'p', 3, 4),
(15, 'Billy Jean', 'p', 3, 0),
(16, 'Say Say Say', 'p', 3, 0),
(17, 'These are days', 'j', 3, 0),
(18, 'Jump', 'p', 3, 0),
(19, 'Green Onions', 'j', 3, 0),
(20, 'Every breath you take', 'p', 3, 2),
(21, 'Ebony and Ivory', 'p', 3, 0),
(22, 'Like a virgin', 'p', 3, 0),
(23, 'I put a spell on you', 'j', 3, 0),
(24, 'That Man', 'j', 3, 0),
(25, 'So What', 'j', 3, 1),
(26, 'You light my life', 'p', 3, 9),
(27, 'Da Ta think I\'m sexy', 'p', 3, 1),
(28, 'American Pie', 'p', 3, 6),
(29, 'I\'ll be there', 'p', 3, 1),
(30, 'My Sharona', 'p', 3, 1),
(31, 'Got my country on', 'c', 3, 21);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
