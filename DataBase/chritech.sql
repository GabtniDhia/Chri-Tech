-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 07 mars 2022 à 17:48
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

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
  `etat_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recommendation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rendezvous_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `etat_service`, `recommendation`, `description_service`, `rendezvous_id`, `date`) VALUES
(27, 'Catastrophique', 'non', 'x', 4, '2022-03-01 12:08:32'),
(28, 'Mauvais', 'non', 'test apres integration', 8, '2022-03-07 11:53:35');

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
  `id_user` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
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

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom_cat`, `type_cat`) VALUES
(2, 'fff', 'Pc portable'),
(4, 'zaezzz', 'Pc bureau Pro'),
(5, 'zaezzzzzzz', 'Pc bureau Pro'),
(6, 'jihiuh', 'Pc portable'),
(7, 'jihiuh', 'Pc portable'),
(8, 'ijjj', 'Pc portable'),
(9, 'asus', 'Pc bureau Pro'),
(10, 'Pc portable pro', 'Pc portable');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numtel` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commandel_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `nom`, `numtel`, `email`, `commandel_id`) VALUES
(1, 'Chritech', 23556779, 'ah@g.c', NULL);

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
-- Structure de la table `demande_spec`
--

CREATE TABLE `demande_spec` (
  `id` int(11) NOT NULL,
  `demandeur_id` int(11) NOT NULL,
  `date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `domaine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cerif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
('DoctrineMigrations\\Version20220216095839', '2022-02-16 10:03:27', 565),
('DoctrineMigrations\\Version20220216103421', '2022-02-16 10:34:35', 370),
('DoctrineMigrations\\Version20220216105820', '2022-02-16 10:58:36', 1148),
('DoctrineMigrations\\Version20220216110006', '2022-02-16 11:00:13', 650),
('DoctrineMigrations\\Version20220223233142', '2022-02-23 23:31:50', 8077),
('DoctrineMigrations\\Version20220224110346', '2022-02-24 11:03:54', 3026),
('DoctrineMigrations\\Version20220226125753', '2022-03-07 12:39:38', 2336),
('DoctrineMigrations\\Version20220301172350', '2022-03-07 12:39:41', 918),
('DoctrineMigrations\\Version20220302194409', NULL, NULL),
('DoctrineMigrations\\Version20220302194428', NULL, NULL),
('DoctrineMigrations\\Version20220304094216', '2022-03-04 09:43:00', 3271),
('DoctrineMigrations\\Version20220304094956', '2022-03-04 09:50:10', 807),
('DoctrineMigrations\\Version20220304095622', '2022-03-04 09:56:32', 2409),
('DoctrineMigrations\\Version20220304101213', '2022-03-04 10:12:40', 7039),
('DoctrineMigrations\\Version20220304112637', '2022-03-04 11:28:38', 2835),
('DoctrineMigrations\\Version20220306133744', '2022-03-06 13:38:01', 7078),
('DoctrineMigrations\\Version20220306143343', '2022-03-06 14:34:18', 366),
('DoctrineMigrations\\Version20220306150242', '2022-03-06 15:02:49', 2471),
('DoctrineMigrations\\Version20220307113928', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id` int(11) NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codepostal` int(11) NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datelivraison` date NOT NULL
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
(1, 1, 1, 'aze', '2022-03-07 12:53:01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('standard','silver','gold','premium') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`id`, `description`, `image`, `type`, `prix`, `points`) VALUES
(2, 'Casque', '028becf66dc56114a0e1860698ea0448.jpg', 'gold', 0, 0),
(3, 'Gaming Chair 700dt', 'f9d7099ba02999b5aec388399e22a5e1.jpg', '', 0, 0),
(4, 'Asus KIT 300dt', '349aa737c5f17cbd5d1c8fc6785c8885.jpg', 'silver', 0, 0),
(5, 'Hello Kitty KIT 200', 'e57f572d42941602177a3e5ff0441843.png', 'silver', 0, 0),
(6, 'League of Legends KIT 250dt', '40bfe34e0fae4449fccc9f9e3d04049d.png', 'gold', 0, 0),
(7, '2 Razer Keyboards 150dt', '9e222477c20ea07be5a6081f12e66a14.jpg', 'gold', 0, 0);

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
  `prix_unit_ht_prod` double NOT NULL,
  `qte_stock_prod` int(11) DEFAULT NULL,
  `image_prod` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_ttc_prod` double NOT NULL,
  `prix_tva_prod` double NOT NULL,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `ref_prod`, `nom_prod`, `descri_prod`, `prix_unit_ht_prod`, `qte_stock_prod`, `image_prod`, `detail_prod`, `prix_ttc_prod`, `prix_tva_prod`, `cat_id`) VALUES
(6, 'A78X-IIKJ', 'Pc Asus Raizen', 'xxxxxxxxxxxxxxxx', 50000, 3, '1947ad85ed58155984993d1b2131fa81.jpg', 'xxxxxxxxxxxxxx', 120.2, 0.22, NULL),
(8, 'XZKI-JJZEK', 'Pc Hp Omen', 'xxxxxx', 1, 2, 'fbef63532b4a8f3b882e89c8a6d5e6b2.jpg', 'xxxxxxx', 1, 1, NULL),
(9, 'ZK-8vvvkz', 'pc', 'ezaieaze', 100000, 2, 'a17462c10d471e4c38db841d882ee03b.png', 'jzjazk', 120.2, 0.2, 10);

-- --------------------------------------------------------

--
-- Structure de la table `recherche`
--

CREATE TABLE `recherche` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `id` int(11) NOT NULL,
  `avis_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_rendezvous` datetime NOT NULL,
  `description_rendezvous` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephonenum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adressrend` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rendezvous`
--

INSERT INTO `rendezvous` (`id`, `avis_id`, `titre`, `service`, `date_rendezvous`, `description_rendezvous`, `telephonenum`, `adressrend`, `client_id`) VALUES
(4, 27, 'Ordinateur Centrale 608-XXL', 'Reparation', '2022-05-15 09:15:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempor ut nisl sit amet tempus. Donec quis pretium lacus. Nunc venenatis pretium quam, ac bibendum dolor ullamcorper ut. Aenean maximus pulvinar erat sit amet vestibulum. Sed aliquam odio null', '00000000', 'test', 0),
(8, 28, 'Alarme CC63ART', 'Installation', '2024-01-01 18:00:00', 'j\'ai acheter l\'alarme X4-xiaomi et je voudrais l\'installer.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempor ut nisl sit amet tempus. Donec quis pretium lacus. Nunc venenatis pretium quam, ac bibendum dolor ullamcorper ut. Aenean maxim', '50000000', 'av Habib bourgiba Residdence les jasmin Bloc A appart 5', 0),
(12, NULL, 'Test-Titre', 'Installation', '2023-01-01 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempor ut nisl sit amet tempus. Donec quis pretium lacus. Nunc venenatis pretium quam, ac bibendum dolor ullamcorper ut. Aenean maximus pulvinar erat sit amet vestibulum. Sed aliquam odio null', '00000000', 'test', 0),
(18, NULL, 'CHH', 'Installation', '2022-03-12 08:12:00', 'bonjour', '12345678', 'AAA', 0),
(19, NULL, 'Test apres integrations', 'Reparation', '2022-03-08 08:00:00', 'test test', '00000000', 'test', 0);

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
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `datecreation`, `is_verified`, `image`) VALUES
(1, 'admin@GMAIL.COM', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$VzV2TXpjR29Cd3M4emRTQQ$+iIix8UZNx/uGiL67cqqAOA76hKroL89rGw6k7bSmxE', 'Adminaaaaaa', 'Adminaaa', '2022-03-07', 0, '40e4d8e018a77ec7c4c9b6b0810f8723.png');

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
  ADD KEY `IDX_6EEAA67D838F852F` (`commandel_id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67F068BC8FABDD9F` (`blog_id_id`),
  ADD KEY `IDX_67F068BC8F3EC46` (`article_id_id`);

--
-- Index pour la table `demande_spec`
--
ALTER TABLE `demande_spec`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A7AB65EB95A6EE59` (`demandeur_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29A5EC27E6ADA943` (`cat_id`);

--
-- Index pour la table `recherche`
--
ALTER TABLE `recherche`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande_spec`
--
ALTER TABLE `demande_spec`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `recherche`
--
ALTER TABLE `recherche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF03345E0A3` FOREIGN KEY (`rendezvous_id`) REFERENCES `rendezvous` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_A7AB65EB95A6EE59` FOREIGN KEY (`demandeur_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION;

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
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC27E6ADA943` FOREIGN KEY (`cat_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD CONSTRAINT `FK_C09A9BA8197E709F` FOREIGN KEY (`avis_id`) REFERENCES `avis` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
