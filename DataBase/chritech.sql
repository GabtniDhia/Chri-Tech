-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 06 mars 2022 à 18:04
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
-- Base de données : `chritech`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entete` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `corp` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `redacteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rendezvous_id` int(11) NOT NULL,
  `etat_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recommendation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8F91ABF03345E0A3` (`rendezvous_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenue` longtext COLLATE utf8mb4_unicode_ci,
  `date_heure` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `carte_fidelite`
--

DROP TABLE IF EXISTS `carte_fidelite`;
CREATE TABLE IF NOT EXISTS `carte_fidelite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nb_points` int(11) DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `date_expiration` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_cat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numtel` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commandel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6EEAA67D838F852F` (`commandel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `nom`, `numtel`, `email`, `commandel_id`) VALUES
(1, 'Chritech', 23556779, 'ah@g.c', NULL),
(7, 'yosraaa', 45321234, 'yaha@h.c', NULL),
(9, 'hamdi', 24354679, 'mimi@gmail.com', NULL),
(10, 'uu', 45678908, 'a@h.c', NULL),
(11, 'uu', 45678908, 'a@h.c', NULL),
(12, 'a', 65432321, 'ah@g.c', NULL),
(14, 'aaaa', 45678765, 'aaa@g.c', NULL),
(15, 'aeee', 76543543, 'aa@g.c', NULL),
(16, 'aaaa', 56432345, 'hhh@g.c', NULL),
(19, 'ghjf', 23456765, 'ss@g.c', NULL),
(20, 'aaaa', 99999999, 'aaaaaaaa@g.c', NULL),
(21, 'aaaa', 23456765, 'a@h.c', NULL),
(22, 'aziz', 24200099, 'AZIZ@MIAL.J', NULL),
(23, 'azizAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 24200099, 'aaaaaaaa@g.c', NULL),
(28, 'vsdfgb', 98765765, 'aa@h.c', NULL),
(29, 'taha', 24242424, 'taha@g.c', NULL),
(30, 'hamdiZGINI', 12121212, 'hah@j.c', NULL),
(31, 'tah', 23232323, 'taha@g.c', NULL),
(32, 'tah', 23232323, 'taha@g.c', NULL),
(33, 'yosra', 12345345, 'aaaaaaaa@g.c', NULL),
(34, 'Achref', 21252871, 'achref@g.c', NULL),
(35, 'yosra', 23456765, 'a@h.c', 15);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id_id` int(11) DEFAULT NULL,
  `article_id_id` int(11) DEFAULT NULL,
  `utilisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenue` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_heure` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BC8FABDD9F` (`blog_id_id`),
  KEY `IDX_67F068BC8F3EC46` (`article_id_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demande_spec`
--

DROP TABLE IF EXISTS `demande_spec`;
CREATE TABLE IF NOT EXISTS `demande_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demandeur_id` int(11) NOT NULL,
  `date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `domaine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cerif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A7AB65EB95A6EE59` (`demandeur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220212091749', '2022-02-12 09:18:06', 173),
('DoctrineMigrations\\Version20220212092033', '2022-02-12 09:20:39', 21),
('DoctrineMigrations\\Version20220212092745', '2022-02-12 09:27:51', 40),
('DoctrineMigrations\\Version20220217191709', '2022-02-17 19:17:14', 158),
('DoctrineMigrations\\Version20220222170824', NULL, NULL),
('DoctrineMigrations\\Version20220222202240', NULL, NULL),
('DoctrineMigrations\\Version20220222203228', NULL, NULL),
('DoctrineMigrations\\Version20220222203528', NULL, NULL),
('DoctrineMigrations\\Version20220222203540', NULL, NULL),
('DoctrineMigrations\\Version20220222203814', NULL, NULL),
('DoctrineMigrations\\Version20220222204532', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codepostal` int(11) NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datelivraison` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id`, `adresse`, `codepostal`, `ville`, `datelivraison`) VALUES
(5, 'Manar2', 7654, 'Tunis', '2026-01-01'),
(6, 'MANARaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 5665, 'tunis', '2027-01-01'),
(7, 'iuhgfd', 1234, 'uygtfrt', '2026-01-01'),
(8, 'aaa', 2345, 'aaa', '2026-01-01'),
(9, 'bardo', 2424, 'bardo', '2023-01-01'),
(10, 'hamdihajem', 1212, 'uygtfrt', '2027-01-01'),
(11, 'MANAR2', 5665, 'tunis', '2025-01-01'),
(12, 'MANAR2', 5665, 'tunis', '2025-01-01'),
(13, 'haua', 5643, 'arsf', '2025-01-01'),
(14, 'Menzah8', 1712, 'Tunis', '2026-01-01'),
(15, 'MANARaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 5665, 'tunis', '2026-01-01');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `is_read` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DB021E96F624B39D` (`sender_id`),
  KEY `IDX_DB021E96E92F8F78` (`recipient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `recipient_id`, `message`, `created_at`, `is_read`) VALUES
(1, 8, 5, 'aZE', '2022-02-22 19:01:25', 0),
(2, 8, 5, 'Waa sadiki famma 50net behin, haja behya aad', '2022-02-22 19:34:58', 1),
(3, 8, 5, 'AzE', '2022-02-22 19:35:06', 1),
(4, 8, 5, 'AZe', '2022-02-22 19:35:39', 1),
(5, 8, 5, 'AZE', '2022-02-22 19:36:13', 0),
(67, 5, 11, 'Ti chbik ?', '2022-03-01 16:09:24', 0),
(68, 5, 11, 'Kartouchhhaa', '2022-03-01 16:09:49', 0),
(69, 5, 11, 'mela le ?', '2022-03-01 16:10:01', 0),
(71, 5, 8, '159', '2022-03-01 16:14:14', 0),
(75, 5, 5, 'eazazeaze', '2022-03-01 16:41:48', 0),
(76, 5, 9, 'Wesh Azmiii ?', '2022-03-01 16:50:31', 0);

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('standard','silver','gold','premium') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offre_produit`
--

DROP TABLE IF EXISTS `offre_produit`;
CREATE TABLE IF NOT EXISTS `offre_produit` (
  `offre_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  PRIMARY KEY (`offre_id`,`produit_id`),
  KEY `IDX_857E9F074CC8505A` (`offre_id`),
  KEY `IDX_857E9F07F347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL,
  `ref_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descri_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_prod` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_unit_ht_prod` double NOT NULL,
  `qte_stock_prod` int(11) DEFAULT NULL,
  `prix_ttc_prod` double NOT NULL,
  `prix_tva_prod` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `ref_prod`, `nom_prod`, `descri_prod`, `image_prod`, `detail_prod`, `prix_unit_ht_prod`, `qte_stock_prod`, `prix_ttc_prod`, `prix_tva_prod`) VALUES
(1, '123', '123', 'aze', '3a52daef43b0065a323bc29ce1100bf5.jpg', 'azeaze', 12, 1, 14, 14);

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

DROP TABLE IF EXISTS `rendezvous`;
CREATE TABLE IF NOT EXISTS `rendezvous` (
  `id` int(11) NOT NULL,
  `avis_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_rendezvous` date NOT NULL,
  `description_rendezvous` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephonenum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adressrend` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C09A9BA8197E709F` (`avis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datecreation` date NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `datecreation`, `is_verified`, `image`) VALUES
(5, 'admin@gmail.com', '[\"ROLE_ADMIN\",\"ROLE_CLIENT\",\"ROLE_SPECIALISTE\"]', '$argon2id$v=19$m=65536,t=4,p=1$bkt1eWhYc05JaG5sa3RNRA$peEcYw9WwQ4HGI4hPyzjC8DSr6VtMesNLF/hMZKK2GI', 'S9onsliii', 'admin admin', '2017-01-01', 0, '0d4bd24e77aae928521a7a9f4196b866.png'),
(8, 'dhia.gabtni@esprit.tn', '[]', '$argon2id$v=19$m=65536,t=4,p=1$R0VIMkJVSXp1Qi9UU0NaZQ$01Dmm6le7CErGeBWIRZ/6fICjsRXx5O0jn1EAKi4QiY', 'Sid Erjel', 'Gabtni', '2022-02-20', 1, 'c4635eb5212177eba1415d4f487eee89.jpg'),
(9, 'Wehed@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$YjQyU1VhQS9wRnVidXJOdQ$d8S90C2j4Kd6UBdyY8n+fU20EzT2tjCHXYHJkjHgrfc', 'Ferchichi', 'mch3li', '2022-02-21', 0, '93975384056437fa81aab29b7f1c85d2.jpg'),
(11, 'smoshy.com@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Z3dyZ2VOT0pONmROWEtlSA$wzvEHRYpPUSGzDTBt3ka9hvJIkm+FN0tjxP0gV0Yaxk', 'Mohsen', 'mch3li', '2022-02-24', 0, '9bc8b535ada7438a16a78f7afa9c52bc.jpg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF03345E0A3` FOREIGN KEY (`rendezvous_id`) REFERENCES `rendezvous` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D838F852F` FOREIGN KEY (`commandel_id`) REFERENCES `livraison` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC8F3EC46` FOREIGN KEY (`article_id_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_67F068BC8FABDD9F` FOREIGN KEY (`blog_id_id`) REFERENCES `blog` (`id`);

--
-- Contraintes pour la table `demande_spec`
--
ALTER TABLE `demande_spec`
  ADD CONSTRAINT `FK_A7AB65EB95A6EE59` FOREIGN KEY (`demandeur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_DB021E96E92F8F78` FOREIGN KEY (`recipient_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_DB021E96F624B39D` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `offre_produit`
--
ALTER TABLE `offre_produit`
  ADD CONSTRAINT `FK_857E9F074CC8505A` FOREIGN KEY (`offre_id`) REFERENCES `offre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_857E9F07F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
