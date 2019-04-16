-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 16 avr. 2019 à 06:42
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `symfony_aeroport`
--

-- --------------------------------------------------------

--
-- Structure de la table `arrivals`
--

DROP TABLE IF EXISTS `arrivals`;
CREATE TABLE IF NOT EXISTS `arrivals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `villed_ariver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `arrivals`
--

INSERT INTO `arrivals` (`id`, `villed_ariver`) VALUES
(1, 'Bordeaux - Mérignac (BOD, France)'),
(2, 'Aéroport Bâle-Mulhouse-Fribourg (EAP, France)'),
(3, 'Nantes (NTE, France)'),
(4, 'Toulouse-Blagnac (TLS, France)'),
(5, 'Nice-Côte d\'Azur (NCE, France)'),
(6, 'Paris-Orly (ORY, France)'),
(7, 'Marseille (MRS, France)');

-- --------------------------------------------------------

--
-- Structure de la table `departures`
--

DROP TABLE IF EXISTS `departures`;
CREATE TABLE IF NOT EXISTS `departures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ville_de_depart` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departures`
--

INSERT INTO `departures` (`id`, `ville_de_depart`) VALUES
(1, 'Lyon - Saint-Exupéry (Satolas) (LYS, France)'),
(2, 'Paris - Charles de Gaulle (CDG, France)'),
(3, 'Marseille (MRS, France)'),
(4, 'Paris-Orly (ORY, France)'),
(5, 'Nice-Côte d\'Azur (NCE, France)'),
(6, 'Toulouse-Blagnac (TLS, France)'),
(7, 'Aéroport Bâle-Mulhouse-Fribourg (EAP, France)'),
(8, 'Bordeaux - Mérignac (BOD, France)');

-- --------------------------------------------------------

--
-- Structure de la table `flights`
--

DROP TABLE IF EXISTS `flights`;
CREATE TABLE IF NOT EXISTS `flights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departures_id` int(11) DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flight_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flight_number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `max_place` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `arrivals_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FC74B5EAE651CFD` (`departures_id`),
  KEY `IDX_FC74B5EAE9C84D80` (`arrivals_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `flights`
--

INSERT INTO `flights` (`id`, `departures_id`, `filename`, `flight_name`, `flight_number`, `date`, `created_at`, `max_place`, `price`, `updated_at`, `arrivals_id`) VALUES
(1, 1, '5cb576cde6b6c299116713.png', 'Air France', 'AF4587', '2019-06-11 16:00:00', '2019-04-16 06:31:41', 50, 245, '2019-04-16 06:31:42', 1),
(2, 6, '5cb576ff1d213818771359.png', 'Air France', 'Af5647', '2019-04-30 17:00:00', '2019-04-16 06:32:30', 86, 251, '2019-04-16 06:32:31', 5),
(3, 4, '5cb57736becc1082747019.png', 'EasyJet', 'AJ5796', '2019-05-13 16:16:00', '2019-04-16 06:33:26', 89, 135, '2019-04-16 06:33:26', 3),
(4, 4, '5cb57760a4f4e870134066.png', 'Transvia', 'TR1254', '2018-05-16 17:00:00', '2019-04-16 06:34:08', 47, 125, '2019-04-16 06:34:08', 1),
(5, 1, '5cb5778617c96165153494.png', 'AerLingus', 'A15478', '2019-06-14 18:00:00', '2019-04-16 06:34:45', 78, 124, '2019-04-16 06:34:46', 1);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190415163221', '2019-04-15 16:32:33'),
('20190415165536', '2019-04-15 16:55:50');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` int(11) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `gender`, `address`, `city`, `postal_code`, `phone_number`, `status`, `is_active`, `roles`) VALUES
(54, 'admin', 'admin', 'admin@gmail.com', '$2y$12$/d8PszNkkUXrrgBMST/8KOqRgESLY5vZWUumJfGVczSmrVllhyGW6', 'Monsieur', '55 rue victor hugo', 'paris', 75012, 123456789, 'admin', 1, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(55, 'sagayaraj', 'joseph', 'bjsahay@gmail.com', '$2y$12$TtDDbzx8gV20rnHlIMX5d.UjCacs37fiSY.2uIBG9AUf9lWc3nmt6', 'Monsieur', '11 Allée de l\'arlequin', 'nanterre', 92000, 767144163, 'pilote', 1, 'a:0:{}'),
(57, 'Antoine', 'Moreau', 'Antoine@dbmail.com', '$2y$12$QaKihc5Y4SwMDCpOhJyrbOqfAsSUXYutyR2/sj46k4WkfRzIIFjZm', 'Madame', '99, rue Gabrielle Lamy', 'Lombard', 45812, 21457456, 'pilote', 1, 'a:0:{}'),
(58, 'Antoine', 'Moreau', 'qbruneau@dbmail.com', '$2y$12$JgScUgcUYCI8v4HLaVusY.GwbOWsmfQpaXEvRCo.nG1Llnkf9HGv.', 'Madame', '99, rue Gabrielle Lamy', 'GosselinBourg', 65487, 21458769, 'pilote', 1, 'a:0:{}'),
(59, 'Sophie', 'Guillet', 'susanne.gerard@laposte.net', '$2y$12$kylXAGJJafAPbRBQwVv.Wen.xe0Z3HelNkHIC1PNJB7Ufj9b3ERPC', 'Madame', '8, avenue Roger Gregoire', 'Renard', 75114, 32145796, 'passenger', 1, 'a:0:{}'),
(60, 'Navin', 'JOSEPH', 'coucou@gmail.com', '$2y$12$8u0EFKgvn8YKpkXR38P3Wumq2pij5xdSgqQ1vZju3jfnHGaF2umSe', 'Monsieur', '55 rue victor hugo', 'paris', 75012, 245784512, 'passenger', 1, 'a:0:{}'),
(61, 'Jean', 'Paul', 'coucoul@gmail.com', '$2y$12$8gccHsJdcufcSBL.7ucmK.jorD68gkvu/.cLbMAFSRZgUh830ojf2', 'Monsieur', '11 Allée de l\'arlequin', 'nanterre', 92000, 675845745, 'passenger', 1, 'a:0:{}');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `FK_FC74B5EAE651CFD` FOREIGN KEY (`departures_id`) REFERENCES `departures` (`id`),
  ADD CONSTRAINT `FK_FC74B5EAE9C84D80` FOREIGN KEY (`arrivals_id`) REFERENCES `arrivals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
