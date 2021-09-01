-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 28 Juillet 2021 à 22:20
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gestion_stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE IF NOT EXISTS `entreprise` (
  `idE` int(11) NOT NULL AUTO_INCREMENT,
  `nomE` varchar(255) NOT NULL,
  `adresseE` varchar(255) NOT NULL,
  `typeE` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  PRIMARY KEY (`idE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`idE`, `nomE`, `adresseE`, `typeE`, `ville`) VALUES
(3, 'Vodacom Congo', 'Boulevard 30 juin', 'tÃ©lÃ©com', 'Kinshasa'),
(4, 'Airtel', 'Boulevard 30 juin', 'tÃ©lÃ©com', 'Kinshasa'),
(5, 'ONATRA', 'kk', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE IF NOT EXISTS `filiere` (
  `idF` int(11) NOT NULL AUTO_INCREMENT,
  `nomF` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `niveau` varchar(255) NOT NULL,
  PRIMARY KEY (`idF`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `filiere`
--

INSERT INTO `filiere` (`idF`, `nomF`, `section`, `niveau`) VALUES
(3, 'MÃ©canique Agricole et Automobile', 'MÃ©canique', 'Graduat'),
(5, 'Informatique Industrielle et RÃ©seaux', 'Informatique', 'Graduat'),
(6, 'Informatique de Gestion', 'Informatique', 'Graduat'),
(8, 'Maintenance', 'MÃ©canique', 'Graduat'),
(9, '', 'Graduat', 'Informatique'),
(10, '', 'Graduat', 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE IF NOT EXISTS `stagiaire` (
  `idS` int(11) NOT NULL AUTO_INCREMENT,
  `nomS` varchar(255) NOT NULL,
  `postnomS` varchar(255) NOT NULL,
  `prenomS` varchar(255) NOT NULL,
  `sexeS` varchar(12) NOT NULL,
  `idF` int(11) NOT NULL,
  `idE` int(11) NOT NULL,
  `fiche` varchar(255) NOT NULL,
  PRIMARY KEY (`idS`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `stagiaire`
--

INSERT INTO `stagiaire` (`idS`, `nomS`, `postnomS`, `prenomS`, `sexeS`, `idF`, `idE`, `fiche`) VALUES
(6, 'KabiUi', 'Emma', 'Emmanuel', 'M', 5, 5, '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idU` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `etat` varchar(1) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`idU`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idU`, `username`, `email`, `password`, `etat`, `role`) VALUES
(1, 'Admin', 'EmmanuelSixMille@gmail.com', '1234', '1', 'ADMIN'),
(2, 'entreprise', 'kk', '1111', '1', 'entreprise');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
