-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Client :  repasdesodsql.mysql.db
-- Généré le :  Dim 02 Novembre 2014 à 19:48
-- Version du serveur :  5.1.73-2+squeeze+build1+1-log
-- Version de PHP :  5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `repasdesodsql`
--

-- --------------------------------------------------------

--
-- Structure de la table `ProfilsNoel`
--

CREATE TABLE IF NOT EXISTS `ProfilsNoel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL DEFAULT '',
  `genre` enum('m','f') NOT NULL DEFAULT 'm',
  `commentaire` text NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `pass` varchar(255) NOT NULL DEFAULT '',
  `offre` int(1) NOT NULL DEFAULT '0',
  `id_profil_recoit` int(1) NOT NULL DEFAULT '0',
  `id_profils_exclus` varchar(255) NOT NULL DEFAULT '0',
  `mail_envoye` int(1) NOT NULL DEFAULT '0',
  `used` int(1) NOT NULL COMMENT 'Indique si un code a ete utilise',
  PRIMARY KEY (`id`),
  KEY `offre` (`offre`),
  KEY `id_profil_recoit` (`id_profil_recoit`),
  KEY `mail_envoye` (`mail_envoye`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `ProfilsNoel`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
