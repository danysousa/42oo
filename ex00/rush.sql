-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 13, 2014 at 08:26 AM
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
(2, 6, 5),
(3, 11, 10),
(3, 11, 11),
(3, 11, 12),
(3, 11, 13),
(5, 13, 25),
(5, 13, 26),
(5, 13, 27);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `partie`
--

INSERT INTO `partie` (`id`, `pts`, `id_admin`, `id_current_player`, `start`, `max_player`, `name`) VALUES
(6, 500, 2, 2, 0, 4, 'test'),
(7, 500, 2, 2, 0, 4, 'megapartie'),
(9, 500, 2, 2, 0, 4, 'PRout'),
(10, 1000, 3, 3, 0, 4, 'MyGame'),
(11, 1000, 3, 3, 0, 50, 'HE'),
(12, 1000, 4, 4, 0, 99, 'allo'),
(13, 3, 5, 5, 0, 3, 't');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `pwd`, `id_partie`, `score`, `defaite`, `id_vaisseau`) VALUES
(2, 'dsousa', 'c387b89fe8d1f3505d3342fc6bab16a35becc6f41a5e63e92461c516897c0e4c268ca1704707af3939d1577e8d46ff567009e94d19de8033a1b2e3dc8eb6b751', 6, 0, 0, 0),
(3, 'ck', '71b674f6595c5e1420a580620429a1340de0171ae58c588c273593f3a8208c10cb9d73b92ba5a2d1789f8b37b6b7178ccf73ece33d0d76aa0825415e7e011d0d', 11, 0, 0, 12),
(4, 'allo', '0cd5bdffa7f4887e03fed0d2d3e351f9dbcf3a7e8adc1ab0862b1233d9fdb66d7833689f5ada77f86528834b8158084e1a838f4f05eb787a6fe5e6b52fda7575', 12, 0, 0, 0),
(5, 't', 'bb80065713e635fad64b78fa7602d320ee6d029dae9421b4a868b3b1ea26aa0bb21cadd3a726a135719fe82d763b40888456e21f507072d967f048486fdc2cdf', 13, 0, 0, 25);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `vaisseau`
--

INSERT INTO `vaisseau` (`id`, `class`, `posX`, `posY`, `pv`, `portee`, `mobile`, `rot`, `pp_shield`, `pp_gun`, `pp_speed`, `pp_total`, `pp_move`, `has_allocated`, `has_rotated`, `has_shooted`) VALUES
(1, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'SwordOfAbsolution', 0, 0, 4, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'SwordOfAbsolution', 0, 0, 4, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(10, 'HonorableDuty', 0, 15, 5, 'courte', 1, 'south', 0, 45, 0, 0, 54, 1, 1, 0),
(11, 'SwordOfAbsolution', 0, 0, 4, 'courte', 1, 'east', 0, 51, 0, 0, 49, 0, 0, 0),
(12, 'HonorableDuty', 0, -15, 5, 'courte', 1, 'north', 0, 39, 0, 0, 60, 1, 1, 0),
(13, 'SwordOfAbsolution', 0, 0, 4, 'courte', 1, 'north', 0, 67, 0, 0, 32, 0, 0, 0),
(14, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(15, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(16, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(17, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(18, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(19, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(20, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(21, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(22, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(23, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(24, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(25, 'SwordOfAbsolution', 15, 0, 4, 'courte', 1, 'east', 0, 70, 0, 0, 29, 1, 1, 0),
(26, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0),
(27, 'SwordOfAbsolution', 0, 0, 4, 'courte', 1, 'north', 0, 0, 0, 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
