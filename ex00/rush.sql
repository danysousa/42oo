-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Dim 13 Avril 2014 à 06:00
-- Version du serveur :  5.5.36
-- Version de PHP :  5.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `rush`
--

-- --------------------------------------------------------

--
-- Structure de la table `flotte`
--

CREATE TABLE IF NOT EXISTS `flotte` (
  `id_user` int(11) NOT NULL,
  `id_partie` int(11) NOT NULL,
  `id_vaisseau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `flotte`
--

INSERT INTO `flotte` (`id_user`, `id_partie`, `id_vaisseau`) VALUES
(2, 6, 1),
(2, 6, 2),
(2, 6, 3),
(2, 6, 4),
(2, 6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `partie`
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
-- Contenu de la table `partie`
--

INSERT INTO `partie` (`id`, `pts`, `id_admin`, `id_current_player`, `start`, `max_player`, `name`) VALUES
(6, 500, 2, 2, 0, 4, 'test'),
(7, 500, 2, 2, 0, 4, 'megapartie'),
(9, 500, 2, 2, 0, 4, 'PRout');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `id_partie` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `defaite` int(11) NOT NULL,
  `id_vaisseau` int(11) NOT NULL,
  `pp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `pwd`, `id_partie`, `score`, `defaite`, `id_vaisseau`, `pp`) VALUES
(2, 'dsousa', 'c387b89fe8d1f3505d3342fc6bab16a35becc6f41a5e63e92461c516897c0e4c268ca1704707af3939d1577e8d46ff567009e94d19de8033a1b2e3dc8eb6b751', 6, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `vaisseau`
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `vaisseau`
--

INSERT INTO `vaisseau` (`id`, `class`, `posX`, `posY`, `pv`, `portee`, `mobile`, `rot`) VALUES
(1, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north'),
(2, 'SwordOfAbsolution', 0, 0, 4, 'courte', 1, 'north'),
(3, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north'),
(4, 'HonorableDuty', 0, 0, 5, 'courte', 1, 'north'),
(5, 'SwordOfAbsolution', 0, 0, 4, 'courte', 1, 'north');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
