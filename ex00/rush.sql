-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 13, 2014 at 06:40 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rush`
--

-- --------------------------------------------------------

--
-- Table structure for table `flotte`
--

CREATE TABLE IF NOT EXISTS `flotte` (
  `id_user` int(11) NOT NULL,
  `id_partie` int(11) NOT NULL,
  `id_vaisseau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flotte`
--

INSERT INTO `flotte` (`id_user`, `id_partie`, `id_vaisseau`) VALUES
(2, 6, 1),
(2, 6, 2),
(2, 6, 3),
(2, 6, 4),
(2, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `partie`
--

CREATE TABLE IF NOT EXISTS `partie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pts` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_current_player` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `max_player` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `partie`
--

INSERT INTO `partie` (`id`, `pts`, `id_admin`, `id_current_player`, `start`, `max_player`, `name`) VALUES
(6, 500, 2, 2, 0, 4, 'test'),
(7, 500, 2, 2, 0, 4, 'megapartie'),
(9, 500, 2, 2, 0, 4, 'PRout');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `id_partie` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `defaite` int(11) NOT NULL,
  `id_vaisseau` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `pwd`, `id_partie`, `score`, `defaite`, `id_vaisseau`) VALUES
(2, 'dsousa', 'c387b89fe8d1f3505d3342fc6bab16a35becc6f41a5e63e92461c516897c0e4c268ca1704707af3939d1577e8d46ff567009e94d19de8033a1b2e3dc8eb6b751', 6, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vaisseau`
--

CREATE TABLE IF NOT EXISTS `vaisseau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  `posX` int(11) NOT NULL,
  `posY` int(11) NOT NULL,
  `pv` int(11) NOT NULL,
  `portee` enum('courte','moyenne','longue') NOT NULL,
  `mobile` int(11) NOT NULL,
  `rot` enum('north','east','south','west') NOT NULL,
  `pp_shield` int(11) NOT NULL,
  `pp_gun` int(11) NOT NULL,
  `pp_speed` int(11) NOT NULL,
  `pp_total` int(11) NOT NULL,
  `pp_move` int(11) NOT NULL,
  `has_allocated` int(11) NOT NULL,
  `has_rotated` int(11) NOT NULL,
  `has_shooted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `vaisseau`
--

INSERT INTO `vaisseau` (`id`, `class`, `posX`, `posY`, `pv`, `portee`, `mobile`, `rot`, `pp_shield`, `pp_gun`, `pp_speed`, `pp_total`, `pp_move`, `has_allocated`, `has_rotated`, `has_shooted`) VALUES
(1, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'SwordOfAbsolution', 0, 0, 4, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'SwordOfAbsolution', 0, 0, 4, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
