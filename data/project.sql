-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 05 Août 2014 à 08:42
-- Version du serveur: 5.5.37
-- Version de PHP: 5.4.4-14+deb7u10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `project`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) NOT NULL,
  `article_content` text NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`article_id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`article_id`, `article_title`, `article_content`, `categorie_id`, `author_id`) VALUES
(5, 'test save', 'sdfgsdfg', 1, NULL),
(6, 'test save', 'sdfgsdfg', 1, NULL),
(7, 'test save', 'sdfgsdfg', 1, NULL),
(9, 'test save', 'sdfgsdfg', 1, 1),
(10, 'test save', 'sdfgsdfg', 1, 1),
(11, 'test save', 'sdfgsdfg', 1, 1),
(12, 'test save', 'sdfgsdfg', 1, 1),
(13, 'test save', 'sdfgsdfg', 1, 1),
(14, 'test save', 'sdfgsdfg', 1, 1),
(15, 'test save', 'sdfgsdfg', 1, 1),
(16, 'test save', 'sdfgsdfg', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(255) NOT NULL,
  `author_email` varchar(255) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `author_email`) VALUES
(1, 'Test', 'test@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_name` varchar(255) NOT NULL,
  `categorie_parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`categorie_id`),
  KEY `categorie_parent_id` (`categorie_parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `categorie_name`, `categorie_parent_id`) VALUES
(1, 'Test', NULL),
(2, 'Test', NULL),
(3, 'Lorem', NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`categorie_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_ibfk_1` FOREIGN KEY (`categorie_parent_id`) REFERENCES `categorie` (`categorie_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
