-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2013 at 11:03 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ai_studio`
--
CREATE DATABASE IF NOT EXISTS `ai_studio` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ai_studio`;

-- --------------------------------------------------------

--
-- Table structure for table `custom_themes`
--

CREATE TABLE IF NOT EXISTS `custom_themes` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `id` text NOT NULL,
  `name` text NOT NULL,
  `author` text NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `custom_themes`
--

INSERT INTO `custom_themes` (`num`, `id`, `name`, `author`) VALUES
(18, '3d33234631', 'cra', 'bazinga'),
(19, '3a39298375', 'asdasd', 'alex'),
(20, 'df5810678c', 'im', 'bazinga'),
(27, '84b38fb426', 'crap', 'bazinga');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`) VALUES
(1, 'alex', '534b44a19bf18d20b71ecc4eb77c572f', 'Aleksa Ilic', 'aleksa.d.ilic@gmail.com'),
(4, 'bazinga', 'd3517d7d92455b3cf3eb3e774acb4406', 'Sheldon', 'sheldon@cooper.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
