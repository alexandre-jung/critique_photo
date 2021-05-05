-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 05 mai 2021 à 13:29
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `critique_photo`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_User` int(11) NOT NULL,
  `id_Photo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Comment_Photo0_FK` (`id_Photo`),
  KEY `Comment_User_FK` (`id_User`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `created`, `id_User`, `id_Photo`) VALUES
(15, 'Le meilleur jeu de tous les temps !', '2021-05-05 12:39:23', 16, 35),
(16, 'Superbe !', '2021-05-05 12:39:40', 17, 38),
(17, 'T&#039;as raison, il fait soif...', '2021-05-05 12:40:07', 17, 36);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file` varchar(255) NOT NULL,
  `id_User` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Photo_AK` (`file`),
  KEY `Photo_User_FK` (`id_User`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `title`, `created`, `file`, `id_User`) VALUES
(35, 'Final Fantasy VII', '2021-05-05 12:37:11', 'media/c89d18b5bdb7614ae4d67c51.jpg', 17),
(36, 'Ap&eacute;ro !', '2021-05-05 12:37:36', 'media/642b74c8f61fae83810568b0.jpg', 16),
(37, 'Accompagner l&#039;ap&eacute;ro', '2021-05-05 12:37:53', 'media/13c4e26470c09bd833cebc29.jpg', 16),
(38, 'Paysage de montagne', '2021-05-05 12:38:21', 'media/05ce14732ef222b034433b9a.jpg', 16),
(39, 'La tour Eiffel', '2021-05-05 12:38:53', 'media/af0f91d9636aaa629cd5cbd9.jpg', 16);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `User_AK` (`login`),
  KEY `User_Idx` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `hash`, `pseudo`, `is_admin`) VALUES
(16, 'zippy', '$2y$10$UHs3NpIVKQNo4GcexVdtqeN6jXYJA05vDst2tHZlwKGrKQaQhUYd6', 'Zippy', 0),
(17, 'admin', '$2y$10$dON0hyCqyO8TYWXXKFwfgehaoxeFBA6Y88DpPRR5Kz5LyLI5631/G', 'Administrateur', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `Comment_Photo0_FK` FOREIGN KEY (`id_Photo`) REFERENCES `photo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Comment_User_FK` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `Photo_User_FK` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
