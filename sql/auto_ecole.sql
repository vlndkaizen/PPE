-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 19 fév. 2026 à 14:36
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `auto_ecole`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidats`
--

DROP TABLE IF EXISTS `candidats`;
CREATE TABLE IF NOT EXISTS `candidats` (
  `idcandidat` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `est_etudiant` tinyint(1) DEFAULT '0',
  `nom_ecole` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_prevue_code` date DEFAULT NULL,
  `date_prevue_permis` date DEFAULT NULL,
  `premier_connexion` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcandidat`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `candidats`
--

INSERT INTO `candidats` (`idcandidat`, `nom`, `prenom`, `email`, `mdp`, `tel`, `adresse`, `est_etudiant`, `nom_ecole`, `date_prevue_code`, `date_prevue_permis`) VALUES
(1, 'leplusbo', 'bachirGoat', 'goat@gmail.com', '$2y$10$U68SM.OZnQFL0fczEBfgq.5qtnLBSkawxREHyDAiLe0unhLu8J8mS', '23455644', 'paris', 1, 'iris', '2026-02-27', '2026-03-20'),
(7, 'legoat', 'legoat', 'dupont@castellane.fr', '$2y$10$WRx1FnDwPycQS1FCXztxNeCAcA6aXsP0cf4QXar2VpLuCvgRPE1f2', '345676543', 'paris la france ', 1, '', NULL, NULL),
(3, 'Benadjila', 'Maria', 'maria@gmail.com', '$2y$10$VpOLpFFCyTVVn11qX9UBIulHCHEBxsI.V4lpOMvf1xyoRl1nInPuK', '5654567', 'paris', 1, 'iris', NULL, NULL),
(4, 'Haroun', 'Djihane', 'Haroun@gmail.com', '$2y$10$DWzJf3.ZOrEVDYWAaubPSuhAQhvnvJaOi9UpNJ1UFX8LjZfFYisSW', '78086789', 'paris', 1, 'iris', NULL, NULL),
(5, 'Drame', 'Youma', 'drame@gmail.com', '$2y$10$oqnC0hp34j.aGXzONvm61OmHigBOIQH7CPuGsiyhVBZvSZ2b753aG', '6789778', 'paris', 1, 'iris', NULL, NULL),
(6, 'Aboghe', 'Rayna', 'aboghe@gmail.com', '$2y$10$qbWSCpEuCggHKcx7IgdtCO2Yfl5swr6HDZVYI2YOYH2Mo7u9dtqG.', '567345678', 'paris', 1, 'iris', NULL, NULL),
(8, 'lagoat', 'lagoat', 'lagoat@gmail.com', '$2y$10$UICUcJ5U8deeSmkh8gim1u8MGa/Rno7x9KS0NKLMtGswvgBzE1eC6', '753464374', 'paris la france ', 1, '', NULL, NULL),
(9, '1234', '11233', '11111@Gmail', '$2y$10$8/RXWvP8TNl9oupj9WAHlenW2mTagIdJLVuz0agUJuueC0oSfzH02', 'zeffefezec', '&éed  zz', 1, 'edzecaeéee&1133', NULL, NULL),
(10, 'bsb', 'bsb', 'bsb@gmail.com', '$2y$10$1grZVCl6PhApgzjKxsLf2evLciI78FU2SZExnxPgTJeSXAP5o0QlG', '1234567891', 'paris', 1, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `idcours` int NOT NULL AUTO_INCREMENT,
  `date_cours` date DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `statut` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'À venir',
  `idvehicule` int NOT NULL,
  `idmoniteur` int NOT NULL,
  `idcandidat` int NOT NULL,
  PRIMARY KEY (`idcours`),
  KEY `fk_v` (`idvehicule`),
  KEY `fk_m` (`idmoniteur`),
  KEY `fk_c` (`idcandidat`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`idcours`, `date_cours`, `heure_debut`, `heure_fin`, `statut`, `idvehicule`, `idmoniteur`, `idcandidat`) VALUES
(1, '2026-02-13', '07:50:00', '08:50:00', 'À venir', 7, 4, 3),
(2, '2026-02-11', '09:00:00', '10:00:00', 'Effectué', 7, 4, 3),
(3, '2026-02-15', '11:00:00', '12:00:00', 'À venir', 12, 1, 2),
(4, '2026-02-10', '13:00:00', '14:00:00', 'Effectué', 16, 1, 2),
(5, '2026-02-26', '11:00:00', '12:00:00', 'À venir', 2, 3, 1),
(6, '2026-02-03', '17:00:00', '18:00:00', 'Effectué', 14, 3, 1),
(7, '2026-02-19', '10:50:00', '11:50:00', 'À venir', 10, 2, 4),
(8, '2026-02-04', '12:00:00', '13:00:00', 'Effectué', 12, 2, 4),
(9, '2026-02-05', '14:30:00', '15:30:00', 'Effectué', 13, 3, 5),
(10, '2026-02-28', '08:55:00', '09:55:00', 'À venir', 2, 2, 5),
(11, '2026-03-05', '09:45:00', '10:45:00', 'À venir', 2, 3, 2),
(12, '2026-03-25', '12:00:00', '13:30:00', 'À venir', 14, 4, 2),
(13, '2026-02-08', '08:00:00', '09:00:00', 'Effectué', 2, 2, 6),
(14, '2026-02-28', '10:00:00', '11:00:00', 'À venir', 4, 2, 6),
(15, '2026-03-20', '15:00:00', '16:00:00', 'À venir', 16, 4, 1),
(16, '2026-02-20', '17:45:00', '18:45:00', 'À venir', 2, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `moniteur`
--

DROP TABLE IF EXISTS `moniteur`;
CREATE TABLE IF NOT EXISTS `moniteur` (
  `idmoniteur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` int DEFAULT NULL,
  `type_permis` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idmoniteur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `moniteur`
--

INSERT INTO `moniteur` (`idmoniteur`, `nom`, `prenom`, `email`, `mdp`, `tel`, `adresse`, `experience`, `type_permis`) VALUES
(1, 'Benahmed', 'Okacha', 'benahmed@castellane.fr', '$2y$10$YdqyMIVZ8IrZKkU4Mya9uOZx5/UBWygLG.6C42aQoFf0KPeAqHDN6', '78967567', 'paris', 10, 'B'),
(2, 'Dupont', 'Jean', 'dupont@castellane.fr', '$2y$10$26g53Q7WInSdqC0B1vOLI.tB0COLdURAMEc8aAX4CW.7nLb17pbna', '65456542', 'paris', 4, 'B+A'),
(3, 'Dubois', 'Marie', 'dubois@castellane.fr', '$2y$10$vzUAGS6i/3t.fBZk7zWoxeJ9wWOhKBfQgfEPl1H4V2w2Q8Ol/lGWS', '6789765678', 'paris', 7, 'B'),
(4, 'Martin', 'Sophie', 'martin@castellane.fr', '$2y$10$gIur73MsFFdWROnBWuKEUu6FSA89aas.cOY3h4o3/s1ViTeNUmib6', '6789678', 'paris', 8, 'A');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`iduser`, `nom`, `prenom`, `email`, `mdp`, `role`) VALUES
(1, 'Lejars', 'Murielle', 'admin@castellane.fr', '123', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `idvehicule` int NOT NULL AUTO_INCREMENT,
  `marque` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modele` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `immatriculation` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Disponible',
  PRIMARY KEY (`idvehicule`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`idvehicule`, `marque`, `modele`, `immatriculation`, `image`, `etat`) VALUES
(1, 'Seat', 'leon', 'CC-456-DK', 'veh_698d497022e9b9.80690019.jpg', 'Disponible'),
(2, 'Seat', 'ibiza', 'PC-786-EF', 'veh_698d497c645732.88364249.jpg', 'Disponible'),
(3, 'Peugeot', '208', 'CC-456-DD', 'veh_698d49acc48336.04340770.jpg', 'En réparation'),
(4, 'Renault', 'megane', 'CC-456-YU', 'veh_698d49ce2dc391.97557048.jpg', 'Disponible'),
(5, 'Nissan', 'Micra', '	AD-489-DL', 'veh_698d49eb32aaa9.50188729.jpg', 'Disponible'),
(6, 'Citroen ', 'C3', 'VB-695-FU', 'veh_698d4a0f3a22c8.85627882.jpg', 'Disponible'),
(7, 'BMW', 'série 1', 'PC-490-JI', 'veh_698d4aaaed5843.55517181.jpg', 'Disponible'),
(8, 'Dacia', 'Duster', 'EC-332-OL', 'veh_698d4ad93e1bb6.92559462.jpg', 'Disponible'),
(9, 'Audi', 'TT', 'LK-790-YT', 'veh_698d4afbcc6775.02741508.jpg', 'Indisponible'),
(10, 'Volkswagen', 'golf', 'NH-480-HH', 'veh_698d4b1ca104b3.17771375.jpg', 'Disponible'),
(11, 'Chevrolet', 'onix', 'UC-461-JH', 'veh_698d4b576c9568.45850727.jpg', 'Disponible'),
(12, 'Volkswagen', 'polo', 'MC-990-TI', 'veh_698d4b7f0608e9.37366082.jpg', 'Disponible'),
(13, 'Kia', 'sportage', 'LK-390-FD', 'veh_698d4bb17bffd6.93315154.jpg', 'Disponible'),
(14, 'Renault', 'clio', 'AC-460-VG', 'veh_698d4bf883e162.10652629.jpg', 'Disponible'),
(15, 'Dacia', 'sandero', 'PP-790-EZ', 'veh_698d4c2f015b71.05696627.jpg', 'Disponible'),
(16, 'Audi', 'S3', 'MU-466-DI', 'veh_698d4d241b6eb7.27327554.jpg', 'Disponible');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
