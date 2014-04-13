-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Dim 13 Avril 2014 à 11:45
-- Version du serveur :  5.5.36
-- Version de PHP :  5.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS rush character set utf8 COLLATE utf8_general_ci;
USE rush;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `pp_shield` int(11) NOT NULL,
  `pp_gun` int(11) NOT NULL,
  `pp_speed` int(11) NOT NULL,
  `pp_total` int(11) NOT NULL,
  `pp_move` int(11) NOT NULL,
  `has_allocated` int(11) NOT NULL,
  `has_rotated` int(11) NOT NULL,
  `has_shooted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
