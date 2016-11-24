-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 24 Novembre 2016 à 21:33
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `dashboardmim`
--

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `agences`
--

CREATE TABLE IF NOT EXISTS `agences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `agences`
--

INSERT INTO `agences` (`id`, `created_at`, `updated_at`, `nom`, `user_id`) VALUES
(1, NULL, '2016-11-18 19:53:31', 'Agence1', 1),
(2, NULL, '2016-11-20 21:51:54', 'Agence 2', 4),
(3, '2016-11-20 20:57:08', '2016-11-20 20:57:08', 'Agence 3', 6),
(4, '2016-11-20 21:06:55', '2016-11-20 21:06:55', 'Agence 4', 7);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `titre`) VALUES
(1, NULL, NULL, 'Intégration'),
(2, NULL, NULL, 'Développement'),
(3, NULL, NULL, 'Gestion de projet');

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `montant` double(8,2) NOT NULL,
  `date` date NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `etapes`
--

CREATE TABLE IF NOT EXISTS `etapes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etape` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `etapes`
--

INSERT INTO `etapes` (`id`, `created_at`, `updated_at`, `etape`) VALUES
(1, NULL, NULL, 'Contact commercial avec le client'),
(2, NULL, NULL, 'Contact de travail avec le client avant signature (réalisation du cahier des charges)'),
(3, NULL, NULL, 'Contact de travail avec le client (validation définitive du cahier des charges)'),
(4, NULL, NULL, 'Annulation du projet (avant signature du contrat)'),
(5, NULL, NULL, 'Signature du contrat avec le client'),
(6, NULL, NULL, 'Facturation du premier tier'),
(7, NULL, NULL, 'Contact avec le client (mise au point au cours du projet)'),
(8, NULL, NULL, 'Livraison du produit'),
(9, NULL, NULL, 'Debug & travail complémentaire'),
(10, NULL, NULL, 'Date limite du recettage pour le client'),
(11, NULL, NULL, 'Annulation du projet'),
(12, NULL, NULL, 'Encaissement du premier tier'),
(13, NULL, NULL, 'Facturation dernier 2/3'),
(14, NULL, NULL, 'Encaissement du dernier 2/3'),
(15, NULL, NULL, 'Fin du projet');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agence_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `projet_id` int(11) DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_11_12_191842_create_agences_table', 2),
('2016_11_12_191929_create_projets_table', 3),
('2016_11_12_191955_create_travails_table', 3),
('2016_11_12_192005_create_actions_table', 3),
('2016_11_12_192026_create_comptes_table', 3),
('2016_11_12_223321_create_postes_table', 4),
('2016_11_14_211608_create_statuts_table', 5),
('2016_11_19_190431_create_files_table', 6),
('2016_11_19_225501_create_etapes_table', 7),
('2016_11_23_182553_create_categories_table', 8);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `postes`
--

CREATE TABLE IF NOT EXISTS `postes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `postes`
--

INSERT INTO `postes` (`id`, `created_at`, `updated_at`, `nom`) VALUES
(1, NULL, NULL, 'Chef de Projet'),
(2, NULL, NULL, 'Intégrateur'),
(3, NULL, NULL, 'Développeur');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE IF NOT EXISTS `projets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commentaire` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `encaisse` double(8,2) DEFAULT NULL,
  `facturable` double(8,2) DEFAULT NULL,
  `total_heures` double(8,2) DEFAULT NULL,
  `heures_faites` double(8,2) DEFAULT NULL,
  `agence_id` int(11) NOT NULL,
  `etape_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `projets`
--

INSERT INTO `projets` (`id`, `created_at`, `updated_at`, `nom`, `commentaire`, `encaisse`, `facturable`, `total_heures`, `heures_faites`, `agence_id`, `etape_id`) VALUES
(1, NULL, '2016-11-23 21:07:55', 'Projet #1', '                                                                                                                                                                                                                                                Description test\r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    ', 0.00, 200.00, 30.00, 10.00, 1, 1),
(2, NULL, '2016-11-22 20:50:09', 'Projet #1', '                                                                                                                                                                                                                                                                                                                                                                        Description #1\r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    ', 100.00, 300.00, 23.00, 2.00, 2, 1),
(3, '2016-11-13 18:35:08', '2016-11-14 20:27:57', 'Projet #2', '                                                                                test description\r\n                                    \r\n                                    ', 0.00, 400.00, 20.00, 0.00, 1, 0),
(4, '2016-11-17 20:42:21', '2016-11-17 21:36:35', 'Projet #3', '                                                                                Projet #3\r\n                                    \r\n                                    ', 0.00, 0.00, 501.00, 0.00, 1, 0),
(5, '2016-11-17 21:54:55', '2016-11-17 21:54:55', 'Projet #44', 'Projet #44', NULL, NULL, 300.00, NULL, 2, 0),
(6, '2016-11-20 21:07:20', '2016-11-20 21:07:52', 'Projet #1', '                                        Projet #1\r\n                                    ', 0.00, 0.00, 100.00, 0.00, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `statuts`
--

CREATE TABLE IF NOT EXISTS `statuts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `statuts`
--

INSERT INTO `statuts` (`id`, `created_at`, `updated_at`, `titre`) VALUES
(1, NULL, NULL, 'CA'),
(2, NULL, NULL, 'Bureau'),
(3, NULL, NULL, 'Chef de projet'),
(4, NULL, NULL, 'Membre');

-- --------------------------------------------------------

--
-- Structure de la table `travails`
--

CREATE TABLE IF NOT EXISTS `travails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date NOT NULL,
  `commentaire` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `projet_id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `fait` tinyint(1) NOT NULL,
  `titre` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Contenu de la table `travails`
--

INSERT INTO `travails` (`id`, `created_at`, `updated_at`, `date`, `commentaire`, `projet_id`, `agence_id`, `fait`, `titre`, `user_id`, `categorie_id`) VALUES
(20, '2016-11-23 19:48:05', '2016-11-23 20:32:20', '2016-11-30', 'test', 1, 1, 0, 'tache #23', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agence_id` int(11) DEFAULT NULL,
  `poste_id` int(11) NOT NULL,
  `statut_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `agence_id`, `poste_id`, `statut_id`) VALUES
(1, 'CDP1', 'eungtony@outlook.fr', '$2y$10$IR/AqG03f3U63MlAwZ37SOiZ/y35grPewZai6cExLLZJAr76twSea', 'iBL9CfM0dg6BNtZQPftiUMaEbSNo7df0Vyyj430ozB45FG0wk6b9zKiurIMg', '2016-11-12 18:13:09', '2016-11-22 20:20:18', 1, 1, 3),
(2, 'Dev1', 'test@test.com', '$2y$10$g3UMwvKlOp7GFa4tC6N/7OPxhrMj4THAYbSbDP6q1td74E233jjYu', 'UVYOqiic0Jt7oLxjaenX1AEiOjmJPSKjVOyotjPaNjBaNGcyKPAqVkDYZDCc', '2016-11-14 20:52:20', '2016-11-21 20:47:17', 2, 3, 4),
(3, 'Dev2', 'test2@test.com', '$2y$10$Dj982gKolHMHF3wSLRLzBOzwuICFqGc3GZaXMOTf.dcsRJtxrLmI.', 'LdxmWRAmxH9WSLxyzPUau4XhLG31I1RAx70No2lh8hmgiLVMhDS7uuG87G03', '2016-11-14 20:56:58', '2016-11-22 20:31:52', 1, 3, 4),
(4, 'CDP2', 'test3@test.com', '$2y$10$Yn/ggKqvuDHRkPXT6.43quKzZc1schRgF5w/cbRmI7b4MLEVIN0UC', 'bAshmFekeL2ulsJeRjMEqQGy7gcAbLLOwLzMPvcaQHMktjxvLFF3IzMeiTez', '2016-11-15 20:00:33', '2016-11-20 22:14:57', 2, 1, 3),
(5, 'Supervisor', 'supervisor@test.com', '$2y$10$71C1V/cnBi.E9WDAZMFIkeseIeSuWESl1LAJKnLFWsigPx6zSYUcW', 'xoHDSyrEoqPHMItfWFpgyKRASqzkbTdpNt9vpbc7vTc36fByOcZtDz1r8JyE', '2016-11-15 21:47:04', '2016-11-22 20:00:16', 2, 3, 1),
(6, 'Bureau1', 'bureau1@test.com', '$2y$10$AW45UEiwqCWCBcjve2qNBOBW4VkQB7FfpZ5ena7P7Cdu/d0PXz1.W', 'uGqUAid9JqLshXGjesXLA4WZV1hJ7A7xXw2sJIXpAFRp0ae7brq4upT8WnYM', '2016-11-15 21:50:08', '2016-11-20 21:50:59', 1, 1, 2),
(7, 'Bureau2', 'bureau2@test.com', '$2y$10$gkTml1A65WaUqYi5O0g4TuC2UM8KI44wSs4VvfbaNnK51jd8kVn.q', 'DTeVHFuBhHfQY5FAeixryIQSwKxl1XdOeaP4TnU92gpMBJ95X46UPsZaXpnD', '2016-11-15 21:51:50', '2016-11-15 21:52:26', 2, 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
