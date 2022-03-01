-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 01 mars 2022 à 21:40
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.25

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

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `entete` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `corp` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `redacteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `rendezvous_id` int(11) NOT NULL,
  `etat_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recommendation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `utilisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenue` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_heure` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `carte_fidelite`
--

CREATE TABLE `carte_fidelite` (
  `id` int(11) NOT NULL,
  `nb_points` int(11) DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `date_expiration` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom_cat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_cat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numtel` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `livraison_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `nom`, `numtel`, `email`, `livraison_id`) VALUES
(1, 'Chritech', 23556779, 'ah@g.c', NULL),
(2, 'azeazeaze', 12345678, 'azeazeaze@gmail.com', NULL),
(3, 'azeazeaze', 12345678, 'azeazeaze@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `blog_id_id` int(11) DEFAULT NULL,
  `article_id_id` int(11) DEFAULT NULL,
  `utilisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenue` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_heure` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220212091749', '2022-02-12 09:18:06', 173),
('DoctrineMigrations\\Version20220212092033', '2022-02-12 09:20:39', 21),
('DoctrineMigrations\\Version20220212092745', '2022-02-12 09:27:51', 40),
('DoctrineMigrations\\Version20220222170824', '2022-02-22 18:08:28', 617),
('DoctrineMigrations\\Version20220223134355', '2022-02-26 16:00:44', 176),
('DoctrineMigrations\\Version20220223152129', '2022-02-23 16:21:34', 178),
('DoctrineMigrations\\Version20220223153317', '2022-02-26 16:00:45', 7),
('DoctrineMigrations\\Version20220227113444', '2022-02-27 12:34:47', 113);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id` int(11) NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codepostal` int(11) NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datelivraison` date NOT NULL,
  `commande_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `offre` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('standard','silver','gold') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offre_produit`
--

CREATE TABLE `offre_produit` (
  `offre_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `ref_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descri_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_prod` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_unit_ht_prod` double NOT NULL,
  `qte_stock_prod` int(11) DEFAULT NULL,
  `prix_ttc_prod` double NOT NULL,
  `prix_tva_prod` double NOT NULL
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

CREATE TABLE `rendezvous` (
  `id` int(11) NOT NULL,
  `avis_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_rendezvous` date NOT NULL,
  `description_rendezvous` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephonenum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adressrend` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datecreation` date NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
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
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8F91ABF03345E0A3` (`rendezvous_id`);

--
-- Index pour la table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `carte_fidelite`
--
ALTER TABLE `carte_fidelite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6EEAA67D8E54FB25` (`livraison_id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67F068BC8FABDD9F` (`blog_id_id`),
  ADD KEY `IDX_67F068BC8F3EC46` (`article_id_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A60C9F1F82EA2E54` (`commande_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DB021E96F624B39D` (`sender_id`),
  ADD KEY `IDX_DB021E96E92F8F78` (`recipient_id`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offre_produit`
--
ALTER TABLE `offre_produit`
  ADD PRIMARY KEY (`offre_id`,`produit_id`),
  ADD KEY `IDX_857E9F074CC8505A` (`offre_id`),
  ADD KEY `IDX_857E9F07F347EFB` (`produit_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C09A9BA8197E709F` (`avis_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `carte_fidelite`
--
ALTER TABLE `carte_fidelite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `FK_6EEAA67D8E54FB25` FOREIGN KEY (`livraison_id`) REFERENCES `livraison` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC8F3EC46` FOREIGN KEY (`article_id_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_67F068BC8FABDD9F` FOREIGN KEY (`blog_id_id`) REFERENCES `blog` (`id`);

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `FK_A60C9F1F82EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`);

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

--
-- Contraintes pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD CONSTRAINT `FK_C09A9BA8197E709F` FOREIGN KEY (`avis_id`) REFERENCES `avis` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
