-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 28 mars 2022 à 13:34
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsbextranet3`
--

-- --------------------------------------------------------

--
-- Structure de la table `archivageconnexion`
--

DROP TABLE IF EXISTS `archivageconnexion`;
CREATE TABLE IF NOT EXISTS `archivageconnexion` (
  `idMedecinArchivage` int NOT NULL,
  `HistoriqueConnexion` datetime NOT NULL,
  `HistoriqueDeconnexion` datetime DEFAULT NULL,
  `DateArchivage` datetime NOT NULL,
  PRIMARY KEY (`idMedecinArchivage`,`HistoriqueConnexion`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `archivageconnexion`
--

INSERT INTO `archivageconnexion` (`idMedecinArchivage`, `HistoriqueConnexion`, `HistoriqueDeconnexion`, `DateArchivage`) VALUES
(20, '2021-11-20 20:40:02', '2021-11-20 20:40:02', '2021-11-20 20:40:34'),
(20, '2021-11-20 20:40:28', NULL, '2021-11-20 20:40:34'),
(21, '2021-11-20 20:42:59', '2021-11-20 20:42:59', '2021-11-20 20:45:49'),
(21, '2021-11-20 20:43:26', NULL, '2021-11-20 20:45:49');

-- --------------------------------------------------------

--
-- Structure de la table `archivagemedecin`
--

DROP TABLE IF EXISTS `archivagemedecin`;
CREATE TABLE IF NOT EXISTS `archivagemedecin` (
  `idArchivage` int NOT NULL,
  `AnneeNaissanceMedecin` year NOT NULL,
  `DateCreationMedecin` datetime NOT NULL,
  `DateArchivageMedecin` datetime NOT NULL,
  PRIMARY KEY (`idArchivage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `archivagemedecin`
--

INSERT INTO `archivagemedecin` (`idArchivage`, `AnneeNaissanceMedecin`, `DateCreationMedecin`, `DateArchivageMedecin`) VALUES
(21, 2001, '2021-11-20 20:42:59', '2021-11-20 20:45:49');

-- --------------------------------------------------------

--
-- Structure de la table `archivageproduit`
--

DROP TABLE IF EXISTS `archivageproduit`;
CREATE TABLE IF NOT EXISTS `archivageproduit` (
  `idMedArchivage` int NOT NULL,
  `idProduitConsulte` int NOT NULL,
  `dateArchivage` datetime NOT NULL,
  PRIMARY KEY (`idMedArchivage`,`idProduitConsulte`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `archivageproduit`
--

INSERT INTO `archivageproduit` (`idMedArchivage`, `idProduitConsulte`, `dateArchivage`) VALUES
(21, 16, '2021-11-20 20:45:49'),
(21, 13, '2021-11-20 20:45:49');

-- --------------------------------------------------------

--
-- Structure de la table `archivagevisio`
--

DROP TABLE IF EXISTS `archivagevisio`;
CREATE TABLE IF NOT EXISTS `archivagevisio` (
  `idMedecinArchivageConsulte` int NOT NULL,
  `idVisioConsulte` int NOT NULL,
  `dateArchivage` datetime NOT NULL,
  PRIMARY KEY (`idVisioConsulte`,`idMedecinArchivageConsulte`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `archivagevisio`
--

INSERT INTO `archivagevisio` (`idMedecinArchivageConsulte`, `idVisioConsulte`, `dateArchivage`) VALUES
(21, 2, '2021-11-20 20:45:49'),
(21, 1, '2021-11-20 20:45:49');

-- --------------------------------------------------------

--
-- Structure de la table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `idGrade` int NOT NULL AUTO_INCREMENT,
  `libelleGrade` varchar(30) NOT NULL,
  PRIMARY KEY (`idGrade`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `grade`
--

INSERT INTO `grade` (`idGrade`, `libelleGrade`) VALUES
(1, 'Administrateur'),
(2, 'Visteur');

-- --------------------------------------------------------

--
-- Structure de la table `historiqueconnexion`
--

DROP TABLE IF EXISTS `historiqueconnexion`;
CREATE TABLE IF NOT EXISTS `historiqueconnexion` (
  `idMedecin` int NOT NULL,
  `dateDebutLog` datetime NOT NULL,
  `dateFinLog` datetime DEFAULT NULL,
  PRIMARY KEY (`idMedecin`,`dateDebutLog`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `historiqueconnexion`
--

INSERT INTO `historiqueconnexion` (`idMedecin`, `dateDebutLog`, `dateFinLog`) VALUES
(23, '2021-11-29 11:20:53', '2021-11-29 11:20:53'),
(24, '2021-11-29 11:55:00', '2021-11-29 11:55:00'),
(25, '2021-11-29 12:02:04', '2021-11-29 12:02:04'),
(26, '2021-12-22 14:23:37', '2021-12-22 14:23:37'),
(26, '2021-12-22 14:24:20', NULL),
(26, '2021-12-22 14:26:39', '2021-12-22 15:04:51'),
(26, '2021-12-22 15:05:41', NULL),
(26, '2021-12-22 16:07:17', '2021-12-22 16:07:23'),
(26, '2021-12-22 18:27:26', NULL),
(29, '2022-03-26 16:21:42', '2022-03-26 16:21:42'),
(30, '2022-03-26 16:28:46', '2022-03-26 16:28:46'),
(31, '2022-03-26 16:36:52', '2022-03-26 16:36:52'),
(32, '2022-03-28 15:25:06', '2022-03-28 15:25:06'),
(32, '2022-03-28 15:28:52', '2022-03-28 15:29:25'),
(33, '2022-03-28 15:31:48', '2022-03-28 15:31:48');

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
CREATE TABLE IF NOT EXISTS `maintenance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bascule` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `maintenance`
--

INSERT INTO `maintenance` (`id`, `bascule`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `dateNaissance` year DEFAULT NULL,
  `motDePasse` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dateCreation` datetime DEFAULT NULL,
  `rpps` varchar(10) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `dateDiplome` date DEFAULT NULL,
  `dateConsentement` date DEFAULT NULL,
  `numGrade` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_GradeMedecin` (`numGrade`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id`, `nom`, `prenom`, `mail`, `dateNaissance`, `motDePasse`, `dateCreation`, `rpps`, `token`, `dateDiplome`, `dateConsentement`, `numGrade`) VALUES
(23, 'dedeede', 'edede', 'clementbo51@gmail.com', NULL, '$2y$10$ndu1zAh2kBLnjG.qweNXI.X', '2021-11-29 11:20:53', NULL, NULL, NULL, '2021-11-29', NULL),
(24, 'dzdzdzdz', 'dzz', 'unmail@gmail.com', NULL, '$2y$10$xtZdmUBf6CLDNDD/1yk4ge/cAxjCG5lwqv.FMRwavw/A0WZ2T5fla', '2021-11-29 11:55:00', NULL, NULL, NULL, '2021-11-29', NULL),
(25, 'dzdzdz', 'zdzdz', 'clementbo52@gmail.com', NULL, '$2y$10$qI7UINcAC8J2EsDWOPIOk.yAD6RAorhJ2MKjRsQKrxwyG.B5Xeydq', '2021-11-29 12:02:04', NULL, NULL, NULL, '2021-11-29', NULL),
(26, 'e', 'e', 'clementbo53@gmail.com', NULL, '$2y$10$Xi1GoPDIQ1r0KFube/ErnOK1tEa/dATYoh9MowRAZtbswNK2LASym', '2021-12-22 14:23:37', NULL, NULL, NULL, '2021-12-22', NULL),
(29, '   e', '    e', 'clementbo0@gmail.com', NULL, '$2y$10$9wZXB63NkV/Pr.AjLmHfWuZE0ZL53Qs6/4GJaM01Z84w9XyZcVbIe', '2022-03-26 16:21:42', NULL, NULL, NULL, '2022-03-26', NULL),
(30, 'e', 'e', 'clementebo50@gmail.com', NULL, '$2y$10$B9EqveeOjfeTqvUuoj5w3uXZU8GaVTuEuTDsD1hhzteqAksZE047C', '2022-03-26 16:28:46', NULL, NULL, NULL, '2022-03-26', NULL),
(31, 'eze', 'ezez', 'clementbeo50@gmail.com', NULL, '$2y$10$knUoz9Pa5K5S8bVIe.K2hOsPfhs73Jj7cOrywZ0.XKyDK7Ck7BfrS', '2022-03-26 16:36:52', NULL, NULL, NULL, '2022-03-26', NULL),
(32, 'ezeze', 'eze', 'e@gmail.com', NULL, '$2y$10$9FH1ZoJch1HTRDNEImSHpedfno465ttPYBm5L8T89wVE4u6otbGPS', '2022-03-28 15:25:06', NULL, NULL, NULL, '2022-03-28', 2),
(33, 'Bollengier', 'Clément', 'clementbo50@gmail.com', NULL, '$2y$10$OQxbBWFcC.PQwU3/5KGHROMwaQQO/DEZkz/45ptKNEJcUnTU0gaa6', '2022-03-28 15:31:48', NULL, NULL, NULL, '2022-03-28', 1);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `medecinactif`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `medecinactif`;
CREATE TABLE IF NOT EXISTS `medecinactif` (
`idMedecin` int
,`MAX(dateDebutLog)` datetime
);

-- --------------------------------------------------------

--
-- Structure de la table `medecinproduit`
--

DROP TABLE IF EXISTS `medecinproduit`;
CREATE TABLE IF NOT EXISTS `medecinproduit` (
  `idMedecin` int NOT NULL,
  `idProduit` int NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  PRIMARY KEY (`idMedecin`,`idProduit`,`Date`,`Heure`),
  KEY `idProduit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medecinproduit`
--

INSERT INTO `medecinproduit` (`idMedecin`, `idProduit`, `Date`, `Heure`) VALUES
(23, 13, '2022-03-24', '21:56:33'),
(24, 13, '2022-03-24', '22:03:16');

-- --------------------------------------------------------

--
-- Structure de la table `medecinvisio`
--

DROP TABLE IF EXISTS `medecinvisio`;
CREATE TABLE IF NOT EXISTS `medecinvisio` (
  `idMedecin` int NOT NULL,
  `idVisio` int NOT NULL,
  `dateInscription` date NOT NULL,
  PRIMARY KEY (`idMedecin`,`idVisio`),
  KEY `idVisio` (`idVisio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  `objectif` mediumtext NOT NULL,
  `information` mediumtext NOT NULL,
  `effetIndesirable` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `objectif`, `information`, `effetIndesirable`) VALUES
(13, 'Doliprane 2.0', 'Objectif', 'Information', 'Effet indésirable'),
(14, 'test', 'Objectif', 'Information', 'Effet indésirable'),
(15, 'test2', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `visioconference`
--

DROP TABLE IF EXISTS `visioconference`;
CREATE TABLE IF NOT EXISTS `visioconference` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomVisio` varchar(100) DEFAULT NULL,
  `objectif` text,
  `url` varchar(100) DEFAULT NULL,
  `dateVisio` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `visioconference`
--

INSERT INTO `visioconference` (`id`, `nomVisio`, `objectif`, `url`, `dateVisio`) VALUES
(1, 'LaFinDuDolipranes', 'supprimer le doliprane', 'https://www.coucoujesuisunurl.com', '2021-11-02'),
(3, 'test', 'test', 'test', '0000-00-00'),
(4, 'exempleVisio', 'Objectif', 'url', '0000-00-00'),
(5, 'FinduMasque', 'Objectif', 'url', '0000-00-00'),
(13, 'Nom de la visioconférence', 'Objectif', 'url', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la vue `medecinactif`
--
DROP TABLE IF EXISTS `medecinactif`;

DROP VIEW IF EXISTS `medecinactif`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `medecinactif`  AS  select `historiqueconnexion`.`idMedecin` AS `idMedecin`,max(`historiqueconnexion`.`dateDebutLog`) AS `MAX(dateDebutLog)` from `historiqueconnexion` group by `historiqueconnexion`.`idMedecin` having ((year(now()) - year(max(`historiqueconnexion`.`dateDebutLog`))) >= 3) ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historiqueconnexion`
--
ALTER TABLE `historiqueconnexion`
  ADD CONSTRAINT `historiqueconnexion_ibfk_1` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD CONSTRAINT `fk_GradeMedecin` FOREIGN KEY (`numGrade`) REFERENCES `grade` (`idGrade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `medecinproduit`
--
ALTER TABLE `medecinproduit`
  ADD CONSTRAINT `medecinproduit_ibfk_1` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medecinproduit_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `medecinvisio`
--
ALTER TABLE `medecinvisio`
  ADD CONSTRAINT `medecinvisio_ibfk_1` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medecinvisio_ibfk_2` FOREIGN KEY (`idVisio`) REFERENCES `visioconference` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Évènements
--
DROP EVENT `supressionMedecin`$$
CREATE DEFINER=`root`@`localhost` EVENT `supressionMedecin` ON SCHEDULE EVERY 1 DAY STARTS '2021-10-15 16:25:38' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
DELETE FROM medecinvisio
WHERE idMedecin IN (SELECT idMedecin FROM medecinactif);
DELETE FROM medecinproduit
WHERE idMedecin IN (SELECT idMedecin FROM medecinactif);
CREATE TABLE Temporaire SELECT * FROM medecinactif; 
DELETE FROM historiqueconnexion 
WHERE idMedecin IN (SELECT idMedecin FROM medecinactif);
DELETE FROM medecin
WHERE id IN (SELECT idMedecin FROM Temporaire);
DROP TABLE Temporaire;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
