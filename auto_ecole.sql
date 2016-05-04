-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 05 Mai 2016 à 01:14
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `auto_ecole`
--

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE IF NOT EXISTS `eleve` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `date_insc` date NOT NULL,
  `date_naiss` date NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `password` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `email` varchar(128) NOT NULL,
  `coordonnee` varchar(128) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `eleve`
--

INSERT INTO `eleve` (`id_user`, `date_insc`, `date_naiss`, `nom`, `prenom`, `password`, `email`, `coordonnee`) VALUES
(1, '2015-11-03', '1996-05-25', 'Kikou', 'Robert', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 'Freedou@live.fr', '115 Rue du théatre 75015 Paris'),
(2, '2016-01-07', '1996-05-25', 'Cover', 'Harry', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 'Freeboy-@hotmail.com', '115 rue du ThÃ©Ã¢tre'),
(3, '2016-01-08', '2016-01-01', 'Sami', 'Sami', '1eb0f77975621f26a4f73c83a66a7b3d6effd3c1', 'chouakicxwc@fdsfds.fr', 'Quelque part');

--
-- Déclencheurs `eleve`
--
DROP TRIGGER IF EXISTS `addEleve`;
DELIMITER //
CREATE TRIGGER `addEleve` BEFORE INSERT ON `eleve`
 FOR EACH ROW BEGIN
INSERT INTO user (id_user, email, password, nom, prenom) VALUES (new.id_user, new.email, new.password, new.nom, new.prenom);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `deleteEleve`;
DELIMITER //
CREATE TRIGGER `deleteEleve` BEFORE DELETE ON `eleve`
 FOR EACH ROW BEGIN
DELETE FROM user WHERE eleve=old.id_user;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `updateEleve`;
DELIMITER //
CREATE TRIGGER `updateEleve` BEFORE UPDATE ON `eleve`
 FOR EACH ROW BEGIN
UPDATE user SET id_user=new.id_user, email=new.email, password=new.password, nom=new.nom, prenom=new.prenom WHERE id_user=new.id_user;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `gestionnaire`
--

CREATE TABLE IF NOT EXISTS `gestionnaire` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `password` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `gestionnaire`
--

INSERT INTO `gestionnaire` (`id_user`, `nom`, `prenom`, `password`, `email`) VALUES
(1, 'Martin', 'Corine', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 'joffray.billon@gmail.com'),
(2, 'Martin', 'Corine', 'c2ed538f68791b6010a8e92353b1d9ea5226a843', 'admin@gmail.com');

--
-- Déclencheurs `gestionnaire`
--
DROP TRIGGER IF EXISTS `addGestionnaire`;
DELIMITER //
CREATE TRIGGER `addGestionnaire` BEFORE INSERT ON `gestionnaire`
 FOR EACH ROW BEGIN
INSERT INTO user (id_user, email, password, nom, prenom) VALUES (new.id_user, new.email, new.password, new.nom, new.prenom);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `deleteGestionnaire`;
DELIMITER //
CREATE TRIGGER `deleteGestionnaire` BEFORE DELETE ON `gestionnaire`
 FOR EACH ROW BEGIN
DELETE FROM user WHERE id_user=old.id_user;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `updateGestionnaire`;
DELIMITER //
CREATE TRIGGER `updateGestionnaire` BEFORE UPDATE ON `gestionnaire`
 FOR EACH ROW BEGIN
UPDATE user SET id_user=new.id_user, email=new.email, password=new.password, nom=new.nom, prenom=new.prenom WHERE id_user=new.id_user;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `moniteur`
--

CREATE TABLE IF NOT EXISTS `moniteur` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `qualification` varchar(32) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `password` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `moniteur`
--

INSERT INTO `moniteur` (`id_user`, `qualification`, `nom`, `prenom`, `password`, `email`) VALUES
(1, 'Code de la route', 'Dupond', 'Jean', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 'freeboy-@hotmail.fr'),
(2, 'Permi auto', 'Desfland', 'Bernard', '15c68e2394197eac3c9284f8dd8590ce2f8a65e6', 'bernard.desfland@gmail.com');

--
-- Déclencheurs `moniteur`
--
DROP TRIGGER IF EXISTS `addMoniteur`;
DELIMITER //
CREATE TRIGGER `addMoniteur` BEFORE INSERT ON `moniteur`
 FOR EACH ROW BEGIN
INSERT INTO user (id_user, email, password, nom, prenom) VALUES (new.id_user, new.email, new.password, new.nom, new.prenom);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `deleteMoniteur`;
DELIMITER //
CREATE TRIGGER `deleteMoniteur` BEFORE DELETE ON `moniteur`
 FOR EACH ROW BEGIN
DELETE FROM user WHERE eleve=old.id_user;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `updateMoniteur`;
DELIMITER //
CREATE TRIGGER `updateMoniteur` BEFORE UPDATE ON `moniteur`
 FOR EACH ROW BEGIN
UPDATE user SET id_user=new.id_user, email=new.email, password=new.password, nom=new.nom, prenom=new.prenom WHERE id_user=new.id_user;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE IF NOT EXISTS `planning` (
  `id_user` int(11) DEFAULT NULL,
  `id_moniteur` int(11) DEFAULT NULL,
  `date_heure_debut` datetime DEFAULT NULL,
  `etat` varchar(32) NOT NULL,
  KEY `id_user` (`id_user`),
  KEY `id_moniteur` (`id_moniteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `planning`
--

INSERT INTO `planning` (`id_user`, `id_moniteur`, `date_heure_debut`, `etat`) VALUES
(3, 1, '2016-01-09 12:00:00', 'Prochainement'),
(2, 1, '2016-01-30 14:00:00', 'Prochainement'),
(2, 1, '2016-01-30 15:00:00', 'Prochainement'),
(2, 1, '2016-01-30 12:00:00', 'Prochainement'),
(2, 1, '2016-01-30 11:00:00', 'Prochainement'),
(2, 1, '2016-05-03 09:00:00', 'Prochainement'),
(2, 1, '2016-05-03 10:00:00', 'Prochainement'),
(2, 1, '2016-05-03 11:00:00', 'Prochainement');

--
-- Déclencheurs `planning`
--
DROP TRIGGER IF EXISTS `addplanning`;
DELIMITER //
CREATE TRIGGER `addplanning` BEFORE INSERT ON `planning`
 FOR EACH ROW BEGIN
DECLARE nb int;
SELECT COUNT(*) INTO nb FROM planning WHERE id_user=new.id_user AND id_moniteur=new.id_moniteur AND date_heure_debut=new.date_heure_debut;
IF nb>0
THEN
SIGNAL SQLSTATE '45000';
END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `idT` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `dates` datetime DEFAULT NULL,
  `etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`idT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ticket`
--

INSERT INTO `ticket` (`idT`, `message`, `dates`, `etat`) VALUES
(1, 'Name: Joffray Billon</br></br>Email: joffray.billon@gmail.com</br></br>Message: test', '2016-05-05 00:29:47', 1),
(2, 'Name: Joffray Billon</br></br>Email: joffray.billon@gmail.com</br></br>Message: test etat', '2016-05-05 00:52:23', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `password` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `password`, `email`) VALUES
(1, 'Dupond', 'Jean', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 'freeboy-@hotmail.fr'),
(2, 'Cover', 'Harry', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 'Freeboy-@hotmail.com'),
(3, 'Billon', 'Joffray', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 'joffray.billon@gmail.com'),
(4, 'BILLON', 'Joffray', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 'Freeboy-@hotmail.com'),
(5, 'Sami', 'Sami', '1eb0f77975621f26a4f73c83a66a7b3d6effd3c1', 'chouakicxwc@fdsfds.fr'),
(6, 'Martin', 'Corine', 'c2ed538f68791b6010a8e92353b1d9ea5226a843', 'admin@gmail.com'),
(7, 'Desfland', 'Bernard', '15c68e2394197eac3c9284f8dd8590ce2f8a65e6', 'bernard.desfland@gmail.com');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `planning`
--
ALTER TABLE `planning`
  ADD CONSTRAINT `planning_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `eleve` (`id_user`),
  ADD CONSTRAINT `planning_ibfk_2` FOREIGN KEY (`id_moniteur`) REFERENCES `moniteur` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
