-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2015 at 05:00 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `www_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` timestamp NOT NULL,
  `end_date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `start_date`, `end_date`) VALUES
(3, 'WWW Технологии Зима 2014/2015', '2014-09-30 21:00:00', '2015-02-26 22:00:00'),
(4, 'WWW Технологии Зима 13/14', '2013-09-30 21:00:00', '2014-02-26 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `student_id`, `task_id`, `date`) VALUES
(3, 3, 1, '2015-02-04 11:40:00'),
(4, 3, 2, '2015-02-03 22:00:00'),
(5, 3, 1, '2015-01-27 22:00:00'),
(6, 3, 1, '2015-01-19 22:00:00'),
(7, 3, 1, '2015-01-12 22:00:00'),
(8, 3, 1, '2015-01-04 22:00:00'),
(9, 4, 2, '2015-02-05 11:05:00'),
(10, 4, 1, '2015-02-05 11:10:00'),
(11, 4, 3, '2015-02-02 22:00:00'),
(12, 4, 2, '2015-01-31 22:00:00'),
(13, 5, 1, '2015-02-05 14:00:00'),
(14, 5, 2, '2015-02-02 22:00:00'),
(15, 5, 3, '2015-02-01 22:00:00'),
(16, 6, 1, '2015-02-03 22:00:00'),
(17, 6, 1, '2015-01-27 22:00:00'),
(18, 6, 1, '2014-12-15 22:00:00'),
(19, 6, 1, '2015-01-31 22:00:00'),
(20, 7, 3, '2015-02-04 22:00:00'),
(21, 8, 3, '2015-02-04 22:00:00'),
(22, 9, 1, '2015-02-04 22:00:00'),
(23, 9, 1, '2015-01-27 22:00:00'),
(24, 9, 1, '2015-01-19 22:00:00'),
(25, 9, 1, '2015-01-11 22:00:00'),
(26, 10, 1, '2015-02-04 22:00:00'),
(27, 10, 1, '2015-01-27 22:00:00'),
(28, 10, 1, '2015-01-19 22:00:00'),
(29, 10, 2, '2015-01-20 22:00:00'),
(30, 11, 3, '2015-02-03 22:00:00'),
(31, 11, 1, '2015-02-04 22:00:00'),
(32, 12, 2, '2015-01-31 22:00:00'),
(33, 13, 3, '2015-01-20 22:00:00'),
(34, 14, 1, '2015-02-03 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `num` int(11) NOT NULL,
  `specialty` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `group` int(1) NOT NULL,
  `points` int(128) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `course_id`, `name`, `num`, `specialty`, `group`, `points`) VALUES
(3, 3, 'Теодор Клисаров', 80733, 'КН', 4, 27),
(4, 3, 'Тестов студент', 80734, 'КН', 5, 14),
(5, 3, 'Тестов студент 2', 80735, 'КН', 5, 12),
(6, 3, 'Тестов студент 3', 80736, 'КН', 4, 20),
(7, 3, 'Тестов студент 4', 80737, 'КН', 4, 5),
(8, 3, 'Тестов студент 5', 80738, 'КН', 5, 5),
(9, 4, 'Тестов студент 6', 40111, 'КН', 1, 20),
(10, 4, 'Тестов студент 7', 40112, 'КН', 1, 17),
(11, 4, 'Тестов студент 8', 40113, 'КН', 1, 10),
(12, 4, 'Тестов студент 9', 40114, 'КН', 2, 2),
(13, 4, 'Тестов студент 10', 40115, 'КН', 2, 5),
(14, 4, 'Тестов студент 11', 40116, 'КН', 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `reward` int(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `reward`) VALUES
(1, 'Присъствие в Лекции', 5),
(2, 'Предаване на домашно', 2),
(3, 'Присъствие на контролно', 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
