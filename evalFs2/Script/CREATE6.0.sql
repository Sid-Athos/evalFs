-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 03 déc. 2018 à 18:23
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `GLANCE`
--
DROP DATABASE IF EXISTS `appsEval`;
CREATE DATABASE IF NOT EXISTS `appsEval` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `appsEval`;


-- --------------------------------------------------------

--
-- Structure de la table `USERS`
--
DROP TABLE IF EXISTS `BACKGROUNDS`;
CREATE TABLE IF NOT EXISTS `BACKGROUNDS` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `backPath` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `BACKGROUNDS` (`ID`, `name`,`backPath`) VALUES
(1,'Glance Default','V/_template/assets/img/header.jpg'),
(2,'Anime Wallpaper','V/_template/assets/img/anime.jpg');



DROP TABLE IF EXISTS `USERS`;
CREATE TABLE IF NOT EXISTS `USERS` (
  `ID` int(11) NOT NULL UNIQUE AUTO_INCREMENT,
  `pseudo` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `avPath` varchar(255) DEFAULT "",
  `lastCo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `backgroundID` tinyint(4) NOT NULL DEFAULT 1,
  `font` tinyint(1) NOT NULL DEFAULT 0,
  `online` tinyint(1) NOT NULL DEFAULT 1,
  `alive` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID`),
  CONSTRAINT FK_back FOREIGN KEY (`backgroundID`)
  REFERENCES BACKGROUNDS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

ALTER TABLE `USERS` ADD CONSTRAINT UNIQUE(`pseudo`);
ALTER TABLE `USERS` ADD CONSTRAINT UNIQUE(`mail`);
ALTER TABLE `USERS` ADD CONSTRAINT UNIQUE(`phone`);

--
-- Déchargement des données de la table `USERS`
--

INSERT INTO `USERS` (`ID`, `pseudo`, `mail`, `password`, `phone`) VALUES
(1, 'Athos', 'sa.bennaceur@gmail.com', 'cd98bf0202ef07e38e87f6bd9445e5e7331e2c78', '0612121212'),
(2, 'Sidou', 'sa.benn90@gmail.com', 'cd98bf0202ef07e38e87f6bd9445e5e7331e2c78', '0610101010');


--
-- Structure de la table `PLATOONS`
--

DROP TABLE IF EXISTS `APPOINTMENTS`;
CREATE TABLE IF NOT EXISTS `APPOINTMENTS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `place` varchar(250) NOT NULL DEFAULT 'Aucun endroit défini',
  `appDay` DATE NOT NULL,
  `appTime` TIME NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `allDay` tinyint(1) NOT NULL DEFAULT 0,
  `reccurent` tinyint(1) NOT NULL DEFAULT 0,
  `userID` int(11) NOT NULL,
  /** `totalActivity` TIME NOT NULL DEFAULT CURRENT_TIMESTAMP(), */
  `online` tinyint(1) NOT NULL DEFAULT 0,
  `alive` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

ALTER TABLE `APPOINTMENTS` ADD CONSTRAINT UNIQUE(`name`);
--
-- Déchargement des données de la table `PLATOONS`
--

-- --------------------------------------------------------


-- --------------------------------------------------------

DROP TABLE IF EXISTS `CATEGORYS`;
CREATE TABLE IF NOT EXISTS `CATEGORYS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;


ALTER TABLE `CATEGORYS` ADD CONSTRAINT UNIQUE(`name`);
--
-- Déchargement des données de la table `CATEGORYS`
--

INSERT INTO `CATEGORYS` (`ID`, `name`) VALUES
(1, 'Professionnel'),
(2, 'Personnel'),
(3, 'Amoureux'),
(4, 'Culture'),
(5, 'Santé'),
(6, 'Administratif'),
(7, 'Relax');

-- --------------------------------------------------------

--
-- Structure de la table `belongs`
--

DROP TABLE IF EXISTS `BELONGS`;
CREATE TABLE IF NOT EXISTS `BELONGS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) NOT NULL,
  `appointmentID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT FK_cat FOREIGN KEY (`categoryID`)
  REFERENCES CATEGORYS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,
  CONSTRAINT FK_plat FOREIGN KEY (`appointmentID`)
  REFERENCES APPOINTMENTS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Structure de la table `MESSAGES`
--

DROP TABLE IF EXISTS `MESSAGES`;
CREATE TABLE IF NOT EXISTS `MESSAGES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(250) NOT NULL,
  `when` datetime NOT NULL,
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


--
-- Structure de la table `SUBSCRIBERS`
--

DROP TABLE IF EXISTS `INVITED`;
CREATE TABLE IF NOT EXISTS `INVITED` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `authorized` tinyint(2) NOT NULL DEFAULT 1,
  `appointmentID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT FK_us FOREIGN KEY (`userID`)
  REFERENCES USERS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,
  CONSTRAINT FK_pl FOREIGN KEY (`appointmentID`)
  REFERENCES APPOINTMENTS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
INSERT INTO APPOINTMENTS(name, place, appDay,userID) 
VALUES(:set1,:set2, (
  CASE appDay 
  WHEN DATE(:set3) > DATE(CURRENT_TIMESTAMP()) 
  THEN :set4 ELSE "" 
  END),:set5)