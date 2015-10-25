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


--
-- Structure de la table `ProfilsLOLNoel`
--

CREATE TABLE IF NOT EXISTS `ProfilsLOLNoel` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL DEFAULT '',
  `genre` enum('m','f') NOT NULL DEFAULT 'm',
  `commentaire` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ProfilsLOLNoel`
--

INSERT INTO `ProfilsLOLNoel` (`id`, `nom`, `genre`, `commentaire`) VALUES
(1, 'Michel Mercier', 'm', 'Parce qu\\''il a grandement besoin de cadeaux.'),
(2, 'Emile Louis', 'm', 'Il appr&eacute;cierait un nouvel autobus je crois.'),
(3, 'Francis Heaulme', 'm', 'Je crois qu''il recherche l''&eacute;pisode \\''Le routard du crime\\'' de \\''Faites entrer l''accus&eacute;\\'', si t''as le DVD &ccedil;a lui ferait plaisir.'),
(4, 'Michael Jackson', 'm', 'Bonne chance.'),
(5, 'Philippe Augros', 'm', 'D&eacute;merde-toi avec &ccedil;a. '),
(6, 'Kim Jong Un', 'm', 'Il a des go&ucirc;ts plut&ocirc;t difficiles je crois.');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ProfilsLOLNoel`
--
ALTER TABLE `ProfilsLOLNoel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ProfilsLOLNoel`
--
ALTER TABLE `ProfilsLOLNoel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;


CREATE TABLE IF NOT EXISTS `LogsAll` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_profil` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `id_profil_lol` int(11) DEFAULT NULL,
  `get` text,
  `post` text,
  `server` text,
  `cookie` text,
  `session` text,
  PRIMARY KEY (`id`),
  KEY `id_profil` (`id_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
