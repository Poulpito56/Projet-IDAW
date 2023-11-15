-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 15 nov. 2023 à 14:41
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `imangermieux`
--

-- --------------------------------------------------------

--
-- Structure de la table `aliment`
--

DROP TABLE IF EXISTS `aliment`;
CREATE TABLE IF NOT EXISTS `aliment` (
  `ID_ALIMENT` bigint NOT NULL AUTO_INCREMENT,
  `ID_REGIME` int DEFAULT NULL,
  `NOM` char(63) COLLATE utf8mb4_general_ci NOT NULL,
  `IMAGE_URL` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TYPE` smallint DEFAULT NULL,
  `GLUCIDE` decimal(7,3) DEFAULT NULL,
  `ENERGIE` decimal(7,3) DEFAULT NULL,
  `GRAS` decimal(7,3) DEFAULT NULL,
  `FIBRE` decimal(7,3) DEFAULT NULL,
  `PROTEINE` decimal(7,3) DEFAULT NULL,
  `SEL` decimal(7,3) DEFAULT NULL,
  `GRAISSES_SATUREES` decimal(7,3) DEFAULT NULL,
  `SUCRE` decimal(7,3) DEFAULT NULL,
  `BICARBONATE` decimal(7,3) DEFAULT NULL,
  `CALCIUM` decimal(7,3) DEFAULT NULL,
  `CHLORURE` decimal(7,3) DEFAULT NULL,
  `FLUOR` decimal(7,3) DEFAULT NULL,
  `MAGNESIUM` decimal(7,3) DEFAULT NULL,
  `NITRATE` decimal(7,3) DEFAULT NULL,
  `POTASSIUM` decimal(7,3) DEFAULT NULL,
  `SILICE` decimal(7,3) DEFAULT NULL,
  `SODIUM` decimal(7,3) DEFAULT NULL,
  `SULFATE` decimal(7,3) DEFAULT NULL,
  PRIMARY KEY (`ID_ALIMENT`),
  KEY `FK_RESPECTER` (`ID_REGIME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `consommer`
--

DROP TABLE IF EXISTS `consommer`;
CREATE TABLE IF NOT EXISTS `consommer` (
  `ID_CONSOMMATION` int NOT NULL AUTO_INCREMENT,
  `LOGIN` char(63) COLLATE utf8mb4_general_ci NOT NULL,
  `ID_ALIMENT` bigint DEFAULT NULL,
  `QUANTITE` decimal(15,2) DEFAULT NULL,
  `DATE_CONSOMMATION` date DEFAULT NULL,
  PRIMARY KEY (`ID_CONSOMMATION`),
  KEY `FK_CONSOMMER` (`LOGIN`),
  KEY `FK_CONSOMMER2` (`ID_ALIMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `ID_ALIMENT` bigint NOT NULL,
  `ALI_ID_ALIMENT` bigint NOT NULL,
  `POIDS` smallint NOT NULL,
  PRIMARY KEY (`ID_ALIMENT`,`ALI_ID_ALIMENT`),
  KEY `FK_CONTENIR2` (`ALI_ID_ALIMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `LOGIN` char(63) COLLATE utf8mb4_general_ci NOT NULL,
  `ID_REGIME` int DEFAULT NULL,
  `PASSWORD` char(63) COLLATE utf8mb4_general_ci NOT NULL,
  `SEXE` smallint DEFAULT NULL,
  `ADMIN` tinyint(1) NOT NULL,
  `MAIL` char(63) COLLATE utf8mb4_general_ci NOT NULL,
  `AGE` smallint DEFAULT NULL,
  `SPORT` smallint DEFAULT NULL,
  PRIMARY KEY (`LOGIN`),
  KEY `FK_SUIVRE` (`ID_REGIME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `regime_alimentaire`
--

DROP TABLE IF EXISTS `regime_alimentaire`;
CREATE TABLE IF NOT EXISTS `regime_alimentaire` (
  `ID_REGIME` int NOT NULL,
  `VEGETARIEN` tinyint(1) DEFAULT NULL,
  `VEGAN` tinyint(1) DEFAULT NULL,
  `PESCETARIEN` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_REGIME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aliment`
--
ALTER TABLE `aliment`
  ADD CONSTRAINT `FK_RESPECTER` FOREIGN KEY (`ID_REGIME`) REFERENCES `regime_alimentaire` (`ID_REGIME`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `consommer`
--
ALTER TABLE `consommer`
  ADD CONSTRAINT `FK_CONSOMMER` FOREIGN KEY (`LOGIN`) REFERENCES `personne` (`LOGIN`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CONSOMMER2` FOREIGN KEY (`ID_ALIMENT`) REFERENCES `aliment` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_CONTENIR` FOREIGN KEY (`ID_ALIMENT`) REFERENCES `aliment` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CONTENIR2` FOREIGN KEY (`ALI_ID_ALIMENT`) REFERENCES `aliment` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `FK_SUIVRE` FOREIGN KEY (`ID_REGIME`) REFERENCES `regime_alimentaire` (`ID_REGIME`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
