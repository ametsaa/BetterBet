-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 20 Mai 2016 à 18:53
-- Version du serveur: 5.5.29-0ubuntu0.12.04.2
-- Version de PHP: 5.3.10-1ubuntu3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `rguyon`
--

-- --------------------------------------------------------

--
-- Structure de la table `bet`
--

CREATE TABLE IF NOT EXISTS `bet` (
  `sport` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `team` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `odds` decimal(10,2) NOT NULL,
  `id_bet` int(11) NOT NULL,
  `game` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_game` int(11) NOT NULL,
  `odd_init` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id_bet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `bet`
--

INSERT INTO `bet` (`sport`, `date`, `team`, `odds`, `id_bet`, `game`, `id_game`, `odd_init`) VALUES
('Basket', '2016-06-18', 'Spurs', '1.50', 1, 'Spurs-Lakers', 2, '1.50'),
('Basket', '2016-06-18', 'Lakers', '1.50', 2, 'Spurs-Lakers', 2, '1.50'),
('Basket', '2016-06-18', 'Match Nul', '1.50', 3, 'Spurs-Lakers', 2, '1.50'),
('Rugby', '2016-05-17', 'Stade Toulousin', '1.50', 4, 'Racing-Stade Toulousin', 1, '1.50'),
('Rugby', '2016-05-17', 'Racing', '1.50', 5, 'Racing-Stade Toulousin', 1, '1.50'),
('Rugby', '2016-05-17', 'Match Nul', '1.50', 6, 'Racing-Stade Toulousin', 1, '1.50');

-- --------------------------------------------------------

--
-- Structure de la table `issue_bet`
--

CREATE TABLE IF NOT EXISTS `issue_bet` (
  `id_bet` int(11) NOT NULL,
  `nb_gambler` int(11) NOT NULL,
  `odds` decimal(11,2) NOT NULL,
  `issue` text COLLATE utf8_unicode_ci NOT NULL,
  `result` text COLLATE utf8_unicode_ci NOT NULL,
  `win` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  PRIMARY KEY (`id_bet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `issue_bet`
--

INSERT INTO `issue_bet` (`id_bet`, `nb_gambler`, `odds`, `issue`, `result`, `win`, `id_game`) VALUES
(1, 25, '1.50', 'victoire spurs contre lakers', 'victoire spurs contre lakers', 1, 2),
(2, 25, '1.50', 'victoire lakers contre spurs', 'victoire spurs contre lakers', 0, 2),
(3, 25, '1.50', 'Match nul entre les Spurs et les Lakers', 'victoire spurs contre lakers', 0, 2),
(4, 25, '1.50', 'victoire stade Toulousin contre Racing', 'victoire Racing contre stade Toulousin', 0, 1),
(5, 23, '1.50', 'victoire Racing contre stade Toulousin', 'victoire Racing contre stade Toulousin', 1, 1),
(6, 24, '1.50', 'Match nul entre le Racing et le stade Toulousain', 'victoire Racing contre stade Toulousin', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `link_bet_user`
--

CREATE TABLE IF NOT EXISTS `link_bet_user` (
  `id_user` int(13) NOT NULL,
  `id_bet` int(11) NOT NULL,
  `stake` int(11) NOT NULL,
  `gain` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_game` int(11) NOT NULL,
  `end_bet` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=284 ;

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `money` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `pseudo` (`pseudo`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`id_user`, `first_name`, `last_name`, `pseudo`, `address`, `money`, `email`, `password`) VALUES
(17, 'Bob', 'Eponge', 'Boby', 'dans la mer', 13, 'boby@enseirb-matmeca.fr', '5f379c5d1d746a405378abb262ea68a007612ada');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
