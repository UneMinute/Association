-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 25 oct. 2020 à 13:31
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `association`
--

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `subscriptionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member_type` tinyint(4) NOT NULL DEFAULT '0',
  `position` varchar(30) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `member`
--

INSERT INTO `member` (`id`, `name`, `firstname`, `subscriptionDate`, `member_type`, `position`, `active`) VALUES
(25, 'Martin', 'Rachel', '2018-12-19 13:50:19', 1, 'Présidente', 1),
(26, 'Depuit', 'Lucien', '2019-09-18 10:25:32', 1, 'RH', 1),
(27, 'Delebert', 'Catherine', '2020-10-25 13:55:21', 1, 'Comptable', 1),
(28, 'Trunon-Chapet', 'Thierry', '2019-02-13 08:30:38', 1, 'Comptable', 0),
(29, 'Chasson', 'Arnaud', '2019-11-14 16:31:34', 1, 'Informaticien', 1),
(30, 'Eliard', 'Isabelle', '2018-08-16 18:54:12', 1, 'Attachée de presse', 1),
(31, 'Tchekhov', 'Pierre', '2020-10-13 15:03:49', 1, 'Commercial', 1),
(32, 'Delamarre', 'Sandra', '2020-05-13 10:21:49', 0, NULL, 1),
(33, 'Poinant', 'Valéry', '2018-04-24 17:00:18', 0, NULL, 1),
(34, 'Traoré', 'Ugo', '2019-01-16 18:30:27', 0, NULL, 1),
(35, 'Petitpois', 'André', '2018-11-28 10:54:40', 0, NULL, 1),
(36, 'Smith', 'David', '2018-06-11 13:30:12', 0, NULL, 1),
(37, 'Simon', 'Elisa', '2020-09-01 10:25:31', 0, NULL, 1),
(38, 'Richter', 'Conrad', '2019-05-08 12:29:17', 0, NULL, 1),
(39, 'Williams', 'Eddy', '2018-09-13 18:45:20', 0, NULL, 1),
(40, 'Cho', 'Ian', '2020-10-27 07:49:45', 1, 'Agent d\'accueil', 1),
(41, 'Armand', 'Yann', '2018-11-06 14:19:43', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `membership`
--

DROP TABLE IF EXISTS `membership`;
CREATE TABLE IF NOT EXISTS `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startingDate` date NOT NULL,
  `endingDate` date NOT NULL,
  `memberId` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membership`
--

INSERT INTO `membership` (`id`, `startingDate`, `endingDate`, `memberId`, `active`) VALUES
(28, '2018-12-19', '2019-12-19', 25, 1),
(29, '2019-12-20', '2020-12-20', 25, 1),
(30, '2019-09-18', '2020-09-18', 26, 0),
(31, '2019-09-18', '2020-09-18', 26, 1),
(32, '2020-09-19', '2021-09-19', 26, 1),
(33, '2020-10-25', '2021-10-25', 27, 1),
(34, '2019-11-14', '2020-11-14', 29, 1),
(35, '2018-08-16', '2019-08-16', 30, 1),
(36, '2020-05-14', '2021-05-14', 32, 1),
(37, '2018-05-01', '2019-05-01', 33, 1),
(38, '2019-05-02', '2020-05-02', 33, 1),
(39, '2020-05-03', '2021-05-03', 33, 1),
(40, '2019-01-16', '2020-01-16', 34, 1),
(41, '2019-12-19', '2020-12-19', 35, 0),
(42, '2019-11-29', '2020-11-29', 35, 1),
(43, '2018-06-11', '2019-06-11', 36, 1),
(44, '2020-09-02', '2021-09-02', 37, 1),
(45, '2020-07-31', '2021-07-31', 38, 1),
(46, '2020-03-19', '2021-03-19', 39, 1),
(47, '2018-09-13', '2019-09-13', 39, 1),
(48, '2018-11-28', '2019-11-28', 35, 1),
(49, '2019-05-08', '2020-05-08', 38, 1),
(50, '2020-12-23', '2021-12-23', 40, 1),
(51, '2021-05-15', '2022-05-15', 32, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
