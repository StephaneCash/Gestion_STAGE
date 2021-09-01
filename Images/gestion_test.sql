-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 28 Juillet 2021 à 22:21
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gestion_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE IF NOT EXISTS `filiere` (
  `idfil` int(4) NOT NULL AUTO_INCREMENT,
  `nomfil` varchar(100) DEFAULT NULL,
  `niveau` varchar(80) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `filiere`
--

INSERT INTO `filiere` (`idfil`, `nomfil`, `niveau`, `section`) VALUES
(1, 'Informatique industrielle et RÃ©seaux', 'Graduat', 'Informatique'),
(2, 'Informatique de gestionDDFFDF', 'Graduat', 'Informatique'),
(3, 'Electrotechnique', 'Graduat', 'Electricite'),
(4, 'Electronique', 'Graduat', 'Electrcite'),
(6, 'Construction metallique et navale', 'Graduat', 'Mecanique'),
(7, 'Mecanique agricole et automobile', 'Graduat', 'Mecanique'),
(8, 'Informatique industrielle', 'Graduat', 'Informatique'),
(9, 'Telecommunication', 'Licence', 'Electricite'),
(10, 'Electroenergetique', 'Licence', 'Electricite'),
(11, 'Mecanique Appli', 'Licence', 'Mecanique'),
(12, 'Mecanique Pro ', 'Licence', 'Mecanique');

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

CREATE TABLE IF NOT EXISTS `inscrit` (
  `idInscrit` int(4) NOT NULL AUTO_INCREMENT,
  `nomInscrit` varchar(100) DEFAULT NULL,
  `postnomInscrit` varchar(255) DEFAULT NULL,
  `sexe` varchar(5) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `idfil` int(4) DEFAULT NULL,
  PRIMARY KEY (`idInscrit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `inscrit`
--

INSERT INTO `inscrit` (`idInscrit`, `nomInscrit`, `postnomInscrit`, `sexe`, `photo`, `idfil`) VALUES
(7, 'SADO', 'Grace', 'M', '13335977_762796470524651_7219323283674210427_n.jpg', 8),
(8, 'BANGO', 'Guelord', 'M', 'guelord.JPG', 8),
(9, 'KAKESA', 'Mira', 'F', 'aladin.JPG', 1),
(10, 'KASONGO', 'Divine', 'F', 'divine.JPG', 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `etat` int(1) DEFAULT NULL,
  `Pwd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `email`, `role`, `etat`, `Pwd`) VALUES
(1, 'admin', 'kikonistephane@gmail.com', 'Admin', 1, '1234');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
