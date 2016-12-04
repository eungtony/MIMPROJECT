-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 05 Décembre 2016 à 00:57
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
(1, NULL, '2016-12-04 13:06:45', 'Agence1', 1),
(2, NULL, '2016-11-20 21:51:54', 'Agence 2', 4),
(3, '2016-11-20 20:57:08', '2016-11-20 20:57:08', 'Agence 3', 6),
(4, '2016-11-20 21:06:55', '2016-11-27 17:33:28', 'Agence 4', 10);

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
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `titre` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `agence_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `created_at`, `updated_at`, `titre`, `message`, `agence_id`, `user_id`) VALUES
(2, '2016-12-02 15:18:56', '2016-12-02 15:18:56', 'Titre de mon super message', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi assumenda consequuntur earum exercitationem nihil, obcaecati perferendis quia recusandae saepe. Aliquid assumenda dolorem doloribus eligendi enim illo inventore omnis optio voluptate.\r\n                        ', 1, 1),
(3, '2016-12-02 22:01:01', '2016-12-02 22:01:01', 'Un autre super message', '                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur, consequuntur corporis earum eius error eveniet explicabo fugiat harum ipsa itaque molestiae placeat quam quo sed temporibus totam unde vitae?\r\n                        ', 1, 1),
(4, '2016-12-04 19:08:27', '2016-12-04 19:08:27', 'test', 'test', 2, 5);

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
('2016_11_23_182553_create_categories_table', 8),
('2016_12_02_100305_addExtensionAndAvatar', 9),
('2016_12_02_153542_create_messages_table', 10),
('2016_12_04_190531_create_tresoreries_table', 11);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `projets`
--

INSERT INTO `projets` (`id`, `created_at`, `updated_at`, `nom`, `commentaire`, `encaisse`, `facturable`, `total_heures`, `heures_faites`, `agence_id`, `etape_id`) VALUES
(1, NULL, '2016-12-04 22:33:39', 'Projet #1', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Description test\r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    ', 55.00, 200.00, 30.00, 10.00, 1, 6),
(2, NULL, '2016-11-22 20:50:09', 'Projet #1', '                                                                                                                                                                                                                                                                                                                                                                        Description #1\r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    ', 100.00, 300.00, 23.00, 2.00, 2, 1),
(3, '2016-11-13 18:35:08', '2016-11-14 20:27:57', 'Projet #2', '                                                                                test description\r\n                                    \r\n                                    ', 0.00, 400.00, 20.00, 0.00, 1, 0),
(4, '2016-11-17 20:42:21', '2016-12-03 20:39:11', 'Projet #3', '                                                                                                                                                                Projet #3\r\n                                    \r\n                                    \r\n                                    \r\n                                    ', 100.00, 200.00, 501.00, 0.00, 1, 1),
(5, '2016-11-17 21:54:55', '2016-11-17 21:54:55', 'Projet #44', 'Projet #44', NULL, NULL, 300.00, NULL, 2, 0),
(6, '2016-11-20 21:07:20', '2016-11-20 21:07:52', 'Projet #1', '                                        Projet #1\r\n                                    ', 0.00, 0.00, 100.00, 0.00, 3, 1),
(7, '2016-11-27 15:07:11', '2016-11-27 17:34:34', 'Projet #13', '                                                                                                                                                                                                                                                                                                                                                                        Projet 13\r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    ', 0.00, 0.00, 34.00, 0.00, 4, 2),
(8, '2016-12-01 22:33:25', '2016-12-01 22:33:25', 'Projet #131', 'Projet #131', NULL, NULL, 10.00, NULL, 4, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Contenu de la table `travails`
--

INSERT INTO `travails` (`id`, `created_at`, `updated_at`, `date`, `commentaire`, `projet_id`, `agence_id`, `fait`, `titre`, `user_id`, `categorie_id`) VALUES
(21, '2016-11-27 12:48:53', '2016-12-01 21:00:30', '2017-01-26', 'oklm', 3, 1, 0, 'Une tache a faire', 1, 3),
(22, '2016-11-27 15:12:34', '2016-11-27 15:14:33', '2016-12-30', 'test', 7, 4, 0, 'test', 9, 1),
(24, '2016-12-01 22:16:23', '2016-12-04 22:26:16', '2016-12-31', 'Une tache a faire: description', 1, 1, 1, 'Une tache a faire 1', 1, 2),
(25, '2016-12-04 15:53:33', '2016-12-04 22:48:04', '2017-04-21', 'Une autre tache', 1, 1, 0, 'Une autre tache', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tresoreries`
--

CREATE TABLE IF NOT EXISTS `tresoreries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `libelle` text COLLATE utf8_unicode_ci NOT NULL,
  `montant` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `tresoreries`
--

INSERT INTO `tresoreries` (`id`, `created_at`, `updated_at`, `libelle`, `montant`, `user_id`) VALUES
(1, '2016-12-04 19:28:09', '2016-12-04 19:28:09', 'test', 20, 5),
(2, '2016-12-04 21:47:13', '2016-12-04 21:47:13', 'testtest', -6, 7);

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
  `extension` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `agence_id`, `poste_id`, `statut_id`, `extension`, `avatar`) VALUES
(1, 'Tony Eung', 'eungtony@outlook.fr', '$2y$10$TWHglceWmSQrjntIOlPzBuVSs7XEoM2kuz.gflotGOpkEgPqDtDeC', '3OfqzThvbI4bDZnNacToJnkMAKpq4aYKbdkWESQBLLkD0kQTSnLvMSshzf1o', '2016-11-12 18:13:09', '2016-12-04 22:56:15', 1, 1, 3, 'jpg', 1),
(2, 'Dev10', 'test@test.com', '$2y$10$LEpv3B.p.V0R.pqqijOKZuIvh9lpADE/FWgaJt6mDsFI2WY4fnaaG', 'SpBz4p8ibT7V8xvViwlOKBBKG65Z9Kssgg5TFlzxhdNwansys7kweO8iE689', '2016-11-14 20:52:20', '2016-11-29 12:56:58', 2, 3, 4, '', 0),
(3, 'Dev20', 'test2@test.com', '$2y$10$Dj982gKolHMHF3wSLRLzBOzwuICFqGc3GZaXMOTf.dcsRJtxrLmI.', 'NKFTy5b40lDHjPTa3CAkmfjaOgZpmMihahz6nJUHUpycZec2TB0m0N6r8Kug', '2016-11-14 20:56:58', '2016-12-03 21:02:37', 1, 3, 4, 'png', 1),
(4, 'CDP2', 'test3@test.com', '$2y$10$Yn/ggKqvuDHRkPXT6.43quKzZc1schRgF5w/cbRmI7b4MLEVIN0UC', 'bAshmFekeL2ulsJeRjMEqQGy7gcAbLLOwLzMPvcaQHMktjxvLFF3IzMeiTez', '2016-11-15 20:00:33', '2016-11-20 22:14:57', 2, 1, 3, '', 0),
(5, 'Supervisor', 'supervisor@test.com', '$2y$10$71C1V/cnBi.E9WDAZMFIkeseIeSuWESl1LAJKnLFWsigPx6zSYUcW', '4tKdv5MoYzEekAFCx2AoUic1YvYI54UxB75IrxO1xaKMs1sv6Yl9Uczw1ZNq', '2016-11-15 21:47:04', '2016-12-04 22:46:12', 2, 3, 1, '', 0),
(6, 'Bureau1', 'bureau1@test.com', '$2y$10$fns/Kv1Yvsisya18gYTbGe9ScVUNRQgQXO91IEaML7HBNF65h6hBe', '4ZYCLIHzZuc5ErfiBqpdhRjCvhAe8KeqLRkxpq6INzvMWPSRhnLADjtxy8wy', '2016-11-15 21:50:08', '2016-11-28 09:04:44', 3, 1, 2, '', 0),
(7, 'Bureau2', 'bureau2@test.com', '$2y$10$gkTml1A65WaUqYi5O0g4TuC2UM8KI44wSs4VvfbaNnK51jd8kVn.q', 'zmmyAaWEIYs7hZ1adEPuZBsRYMqGkrHfEGrcU63bujS9Jcwy0GqX95hJVrOe', '2016-11-15 21:51:50', '2016-12-04 22:25:50', 4, 2, 2, '', 0),
(8, 'dev3', 'dev3@test.com', '$2y$10$Upc6G238Qj/QbKQtyud4A.cr8yyydzd67xgh0zc86E563ddoSMQfa', 'bGPWd6HetSyUlSjrOPCcdUYIVT1ptjVIbIZJuAcfE9EjN7rMum4XSvVgmg1z', '2016-11-24 20:42:51', '2016-12-01 18:44:03', 3, 2, 4, '', 0),
(9, 'dev4', 'dev4@test.com', '$2y$10$oSERMnpxVH4S/Mu1e65rPev9MkYPRkB0YHrCIw9F8lqiwiu/75X/e', 'mlelWvPzqwtqaPCfJZzxW2cz0tSvXblIBsP5ST6lchgGgM0fX4VEWA8dmbtt', '2016-11-24 20:43:47', '2016-12-02 15:21:08', 4, 2, 4, '', 0),
(10, 'CDP4', 'cdp4@test.com', '$2y$10$BzqcWhUrbCavR/0N8bAjie9vlsHcYawbwEdE4C8RjhnZBiPiR5hdq', 'FEQHD1h5Sal5xDdwmWMfRh5yRoUdr8CQ7Dex6U7acTbdSEtVguCM5vGh3loB', '2016-11-24 20:44:40', '2016-11-27 21:07:27', 4, 1, 3, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
