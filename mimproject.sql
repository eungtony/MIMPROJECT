-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 23 Janvier 2017 à 15:04
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `mimproject`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `agences`
--

INSERT INTO `agences` (`id`, `created_at`, `updated_at`, `nom`, `user_id`) VALUES
(1, NULL, '2016-12-05 20:57:08', 'Team Ngocky', 1),
(2, NULL, '2016-11-20 21:51:54', 'Agence 2', 4),
(3, '2016-11-20 20:57:08', '2016-11-20 20:57:08', 'Agence 3', 6),
(4, '2016-11-20 21:06:55', '2016-11-27 17:33:28', 'Agence 4', 10),
(5, '2017-01-22 14:55:31', '2017-01-22 14:55:31', 'Agence 5', 12);

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
-- Structure de la table `devis`
--

CREATE TABLE IF NOT EXISTS `devis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `projet_id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `valide` tinyint(1) NOT NULL,
  `a_valider` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `devis`
--

INSERT INTO `devis` (`id`, `created_at`, `updated_at`, `projet_id`, `agence_id`, `user_id`, `valide`, `a_valider`) VALUES
(1, '2017-01-13 14:07:32', '2017-01-23 07:17:14', 1, 1, 1, 1, 1),
(2, '2017-01-16 19:50:49', '2017-01-18 21:15:28', 3, 1, 1, 0, 0),
(3, '2017-01-18 20:03:58', '2017-01-18 20:03:58', 5, 2, 4, 0, 0),
(4, '2017-01-18 20:22:11', '2017-01-18 20:22:11', 6, 3, 6, 0, 0),
(5, '2017-01-18 20:49:45', '2017-01-18 21:27:20', 7, 4, 10, 1, 1),
(6, '2017-01-22 17:15:15', '2017-01-22 17:37:26', 14, 3, 6, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `devis_taches`
--

CREATE TABLE IF NOT EXISTS `devis_taches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `libelle` text COLLATE utf8_unicode_ci NOT NULL,
  `prix` double(8,2) NOT NULL,
  `devis_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `devis_taches`
--

INSERT INTO `devis_taches` (`id`, `created_at`, `updated_at`, `libelle`, `prix`, `devis_id`, `projet_id`) VALUES
(5, '2017-01-16 19:56:35', '2017-01-16 20:24:49', 'fjrjfr', 12.00, 2, 3),
(6, '2017-01-16 19:57:03', '2017-01-16 19:57:03', 'fjrjfr', 11.00, 2, 3),
(7, '2017-01-16 19:57:23', '2017-01-16 19:57:23', 'fjrjfr', 11.00, 2, 3),
(10, '2017-01-18 20:57:38', '2017-01-18 20:57:38', 'test', 90.00, 5, 7),
(11, '2017-01-19 20:10:30', '2017-01-19 20:10:30', 'test', 10.00, 4, 6),
(12, '2017-01-22 17:15:40', '2017-01-22 17:15:40', 'Test', 1000.00, 6, 14),
(13, '2017-01-22 21:58:03', '2017-01-22 21:58:03', 'tetst', 10.00, 1, 1);

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
-- Structure de la table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `from` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `from`, `date`, `created_at`, `updated_at`) VALUES
(1, 'Reveillon de Noël', 'Troyes Point Zéro vous souhaite à tous un joyeux Noël !', 1, '2016-12-24', '2016-12-16 09:48:39', '2016-12-16 09:48:39'),
(2, 'Nouvel an', 'Troyes Point Zéro vous invite à Fêter le nouvel an !', 1, '2017-01-01', '2016-12-16 11:39:24', '2016-12-16 11:39:24'),
(3, 'Remise des cadeaux', '                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, officia consequatur accusamus rerum dolorem dignissimos reiciendis alias minima consectetur quisquam beatae saepe distinctio', 11, '2016-12-25', '2016-12-17 10:14:28', '2017-01-03 15:50:28');

-- --------------------------------------------------------

--
-- Structure de la table `event_subscribers`
--

CREATE TABLE IF NOT EXISTS `event_subscribers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `heures_taches`
--

CREATE TABLE IF NOT EXISTS `heures_taches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `heures` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `tache_id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `heures_taches`
--

INSERT INTO `heures_taches` (`id`, `created_at`, `updated_at`, `heures`, `description`, `user_id`, `tache_id`, `agence_id`, `projet_id`) VALUES
(1, '2017-01-04 10:14:58', '2017-01-04 10:14:58', 1, 'test', 1, 24, 1, 1),
(2, '2017-01-19 20:13:39', '2017-01-19 20:13:51', 1, 'Un dev', 6, 26, 3, 6);

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
(2, '2016-12-02 15:18:56', '2016-12-13 18:23:37', 'Message 2', '                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi assumenda consequuntur earum exercitationem nihil, obcaecati perferendis quia recusandae saepe. Aliquid assumenda dolorem doloribus eligendi enim illo inventore omnis optio voluptate.\r\n                        \r\n                       ', 1, 1),
(3, '2016-12-02 22:01:01', '2016-12-13 18:23:27', 'Message 1', '                                                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur, consequuntur corporis earum eius error eveniet explicabo fugiat harum ipsa itaque molestiae placeat quam quo sed temporibus totam unde vitae?\r\n                        \r\n                       ', 1, 1),
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
('2016_12_04_190531_create_tresoreries_table', 11),
('2016_12_16_102038_create_event_subscribers_table', 12),
('2017_01_13_134237_create_devis_table', 13),
('2017_01_13_151629_create_devis_taches_table', 14),
('2017_01_21_144008_create_projet_agences_table', 15);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `type` enum('global','team','personal') NOT NULL,
  `to` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `sender`, `type`, `to`, `message`, `created_at`, `updated_at`) VALUES
(3, 1, 'global', 0, 'Test Global !!', '2016-12-05 21:52:48', '2016-12-05 21:52:48'),
(4, 1, 'team', 1, 'Test Equipe !!', '2016-12-05 21:53:07', '2016-12-05 21:53:07'),
(5, 1, 'team', 1, 'Test modal !', '2016-12-13 09:50:56', '2016-12-13 09:50:56'),
(6, 1, 'personal', 1, 'Test modal perso !', '2016-12-13 09:59:34', '2016-12-13 09:59:34'),
(7, 1, 'personal', 3, 'Bnjour', '2017-01-04 11:30:17', '2017-01-04 11:30:17');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `projets`
--

INSERT INTO `projets` (`id`, `created_at`, `updated_at`, `nom`, `commentaire`, `encaisse`, `facturable`, `total_heures`, `heures_faites`, `agence_id`, `etape_id`) VALUES
(1, NULL, '2016-12-04 22:33:39', 'Projet #1', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Description test\r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    ', 55.00, 200.00, 30.00, 10.00, 1, 6),
(2, NULL, '2016-11-22 20:50:09', 'Projet #1', '                                                                                                                                                                                                                                                                                                                                                                        Description #1\r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    ', 100.00, 300.00, 23.00, 2.00, 2, 1),
(3, '2016-11-13 18:35:08', '2016-11-14 20:27:57', 'Projet #2', '                                                                                test description\r\n                                    \r\n                                    ', 0.00, 400.00, 20.00, 0.00, 1, 0),
(4, '2016-11-17 20:42:21', '2016-12-03 20:39:11', 'Projet #3', '                                                                                                                                                                Projet #3\r\n                                    \r\n                                    \r\n                                    \r\n                                    ', 100.00, 200.00, 501.00, 0.00, 1, 1),
(5, '2016-11-17 21:54:55', '2016-11-17 21:54:55', 'Projet #44', 'Projet #44', NULL, NULL, 300.00, NULL, 2, 0),
(6, '2016-11-20 21:07:20', '2017-01-19 20:09:45', 'Projet #1', '                                                                                Projet #1 Description\r\n                                    \r\n                                    ', 10.00, 100.00, 80.00, 0.00, 3, 3),
(7, '2016-11-27 15:07:11', '2016-11-27 17:34:34', 'Projet #13', '                                                                                                                                                                                                                                                                                                                                                                        Projet 13\r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    \r\n                                    ', 0.00, 0.00, 34.00, 0.00, 4, 2),
(8, '2016-12-01 22:33:25', '2016-12-01 22:33:25', 'Projet #131', 'Projet #131', NULL, NULL, 10.00, NULL, 4, 0),
(9, '2017-01-18 20:53:18', '2017-01-18 20:53:18', 'Projet #15', 'Projet #15', NULL, NULL, 130.00, NULL, 4, 0),
(11, '2017-01-19 19:52:39', '2017-01-21 16:20:43', 'Projet #132', 'Projet #132', NULL, NULL, 120.00, NULL, 1, 0),
(12, '2017-01-21 15:15:39', '2017-01-22 14:47:48', 'Projet #130', ' Projet #131\r\n                                            \r\n                                            ', NULL, NULL, 120.00, NULL, 0, 0),
(14, '2017-01-22 17:14:40', '2017-01-22 17:14:40', 'Projet #198', 'Projet #198', NULL, NULL, 100.00, NULL, 3, 0),
(15, '2017-01-22 21:29:21', '2017-01-22 21:29:21', 'Projet #46', 'Projet #46', NULL, NULL, 120.00, NULL, 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `projet_agences`
--

CREATE TABLE IF NOT EXISTS `projet_agences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `projet_id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `nom_agence` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Contenu de la table `projet_agences`
--

INSERT INTO `projet_agences` (`id`, `created_at`, `updated_at`, `projet_id`, `agence_id`, `nom_agence`) VALUES
(11, '2017-01-21 14:46:23', '2017-01-21 14:46:23', 11, 3, 'Agence 3'),
(15, '2017-01-21 15:15:47', '2017-01-21 15:15:47', 12, 3, 'Agence 3'),
(16, '2017-01-21 16:12:58', '2017-01-21 16:12:58', 11, 1, 'Team Ngocky'),
(17, '2017-01-22 18:59:09', '2017-01-22 18:59:09', 12, 1, 'Team Ngocky'),
(18, '2017-01-22 18:59:26', '2017-01-22 18:59:26', 13, 1, 'Team Ngocky'),
(19, '2017-01-22 21:12:36', '2017-01-22 21:12:36', 13, 5, 'Agence 5');

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
-- Structure de la table `tache_commentaires`
--

CREATE TABLE IF NOT EXISTS `tache_commentaires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commentaire` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `travail_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `tache_commentaires`
--

INSERT INTO `tache_commentaires` (`id`, `commentaire`, `created_at`, `updated_at`, `travail_id`, `user_id`, `projet_id`, `agence_id`) VALUES
(1, 'Ceci est un commentaire', NULL, NULL, 28, 4, 2, 2),
(2, 'f,kel,flke', '2016-12-13 12:15:34', '2016-12-13 12:15:34', 28, 4, 2, 2),
(3, 'test', '2016-12-13 14:22:00', '2016-12-13 14:22:00', 28, 4, 2, 2),
(4, 'test', '2016-12-13 14:39:36', '2016-12-13 14:39:36', 28, 4, 2, 2),
(5, '', '2016-12-13 14:43:18', '2016-12-13 14:43:18', 28, 4, 2, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Contenu de la table `travails`
--

INSERT INTO `travails` (`id`, `created_at`, `updated_at`, `date`, `commentaire`, `projet_id`, `agence_id`, `fait`, `titre`, `user_id`, `categorie_id`) VALUES
(21, '2016-11-27 12:48:53', '2016-12-01 21:00:30', '2017-01-26', 'oklm', 3, 1, 0, 'Une tache a faire', 1, 3),
(22, '2016-11-27 15:12:34', '2016-11-27 15:14:33', '2016-12-30', 'test', 7, 4, 0, 'test', 9, 1),
(24, '2016-12-01 22:16:23', '2016-12-04 22:26:16', '2016-12-31', 'Une tache a faire: description', 1, 1, 1, 'Une tache a faire 1', 1, 2),
(25, '2016-12-04 15:53:33', '2016-12-04 22:48:04', '2017-04-21', 'Une autre tache', 1, 1, 0, 'Une autre tache', 1, 3),
(26, '2017-01-19 20:11:13', '2017-01-19 20:16:16', '2017-03-03', '                                                                                                                tache #20\r\n                        \r\n                        \r\n                        \r\n                        ', 6, 3, 1, 'tache #20', 6, 2),
(27, '2017-01-19 20:23:46', '2017-01-19 20:23:56', '2017-03-03', '                            Test\r\n                        ', 6, 3, 0, 'Test', 8, 1),
(28, '2017-01-22 21:53:25', '2017-01-22 21:53:25', '2017-01-31', 'test', 1, 1, 0, 'test', 0, 3),
(29, '2017-01-22 21:53:56', '2017-01-22 21:53:56', '2017-01-30', 'retest', 1, 1, 0, 'retest', 0, 1),
(30, '2017-01-22 21:54:24', '2017-01-22 21:54:24', '2017-01-25', 'reretest', 1, 1, 0, 'reretest', 0, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `tresoreries`
--

INSERT INTO `tresoreries` (`id`, `created_at`, `updated_at`, `libelle`, `montant`, `user_id`) VALUES
(1, '2016-12-04 19:28:09', '2016-12-04 19:28:09', 'test', 20, 5),
(2, '2016-12-04 21:47:13', '2016-12-04 21:47:13', 'testtest', -6, 7),
(3, '2017-01-22 18:45:14', '2017-01-22 18:45:14', 'test', 14, 6);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
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
  `is_valid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `description`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `agence_id`, `poste_id`, `statut_id`, `extension`, `avatar`, `is_valid`) VALUES
(1, 'Tony Eung', '                                \r\n                            Ma nouvelle description !', 'eungtony@outlook.fr', '$2y$10$TWHglceWmSQrjntIOlPzBuVSs7XEoM2kuz.gflotGOpkEgPqDtDeC', 'MjmblnmlId7gDgHD8V1sUdnC0L6jrxb4EmLbOjhdj3q3jctqFoKjdGdgDSrl', '2016-11-12 18:13:09', '2017-01-23 12:58:53', 1, 1, 3, 'jpg', 1, 1),
(2, 'Dev1', '', 'dev1@test.com', '$2y$10$LEpv3B.p.V0R.pqqijOKZuIvh9lpADE/FWgaJt6mDsFI2WY4fnaaG', 'SpBz4p8ibT7V8xvViwlOKBBKG65Z9Kssgg5TFlzxhdNwansys7kweO8iE689', '2016-11-14 20:52:20', '2017-01-22 14:54:09', 2, 3, 4, '', 0, 0),
(3, 'Dev2', '', 'dev2@test.com', '$2y$10$Dj982gKolHMHF3wSLRLzBOzwuICFqGc3GZaXMOTf.dcsRJtxrLmI.', 'ZtEKIcyozIi9GjokzbVpvqOIG0eieWklChKoXJRwJCEwqDlDooC5HnwmdsXk', '2016-11-14 20:56:58', '2017-01-22 14:53:40', 1, 3, 4, '', 0, 0),
(4, 'CDP2', '', 'cdp2@test.com', '$2y$10$Yn/ggKqvuDHRkPXT6.43quKzZc1schRgF5w/cbRmI7b4MLEVIN0UC', 'QBFJIfP1CSOZX6ID1bLXTv4aeyXwTMjV15j5BvON1rIV906eT2pBtf3aqpuh', '2016-11-15 20:00:33', '2017-01-22 21:16:44', 2, 1, 3, '', 0, 0),
(5, 'Supervisor', '                                \r\n                            Je suis un super superviseur !', 'supervisor@test.com', '$2y$10$71C1V/cnBi.E9WDAZMFIkeseIeSuWESl1LAJKnLFWsigPx6zSYUcW', 'rY0MCucvi7XlYnMyx9pj9D9gqJDwy1Ayj2baP2rPYXTctnZysPYNqDgOU7Sf', '2016-11-15 21:47:04', '2017-01-23 08:23:01', 2, 3, 1, '', 0, 0),
(6, 'Bureau1', '', 'bureau1@test.com', '$2y$10$DwBiXFBAnsCz5x/N3P0S/uyWcn9hXo61z8c6YCawHCTlgWjlpQvhq', '4d7A3MUcg9fRy8mWzRoXPvRp4cAR9HUkD8Ha2Wx0kSTYV01swXvjAS9yvL1z', '2016-11-15 21:50:08', '2017-01-22 21:15:05', 3, 1, 2, '', 0, 0),
(7, 'Bureau2', '', 'bureau2@test.com', '$2y$10$gkTml1A65WaUqYi5O0g4TuC2UM8KI44wSs4VvfbaNnK51jd8kVn.q', '7lOknkDN5ihj95rf3QWtHL7sPAgxFCugjklex5FdZIu3Trhm9WOapK8kujER', '2016-11-15 21:51:50', '2017-01-23 07:17:33', 4, 2, 2, '', 0, 0),
(8, 'dev3', '', 'dev3@test.com', '$2y$10$Upc6G238Qj/QbKQtyud4A.cr8yyydzd67xgh0zc86E563ddoSMQfa', 'dIHJndXF31yUcCxLiq8EVVuy8B5nrbjpBbMzcUq9mnIO262ChYE5bY6M96YX', '2016-11-24 20:42:51', '2017-01-21 15:14:39', 3, 2, 4, '', 0, 0),
(9, 'dev4', '', 'dev4@test.com', '$2y$10$oSERMnpxVH4S/Mu1e65rPev9MkYPRkB0YHrCIw9F8lqiwiu/75X/e', 'mlelWvPzqwtqaPCfJZzxW2cz0tSvXblIBsP5ST6lchgGgM0fX4VEWA8dmbtt', '2016-11-24 20:43:47', '2016-12-02 15:21:08', 4, 2, 4, '', 0, 0),
(10, 'CDP4', '', 'cdp4@test.com', '$2y$10$BzqcWhUrbCavR/0N8bAjie9vlsHcYawbwEdE4C8RjhnZBiPiR5hdq', '3DqO7TMoVapa8dSpoAF6NAd4bcBlMwraOcsVJRKVBMTsjgZXBFriwxfHe2Hl', '2016-11-24 20:44:40', '2017-01-22 16:43:23', 4, 1, 3, '', 0, 0),
(11, 'Cédric Noël', '                                \r\n                            Ma description', 'cedric10troyes@gmail.com', '$2y$10$5ScF.UZwGrNZPPysPt2vDOatrKiqKbE5h9VzpwEMEfGUgNxfD1bDq', 'mRT4DrLASa8aSDtWfF2P3AcANhMGVPuoVgFHMk5Upgpl0pAuBLb6gXgh0DXS', '2016-12-17 10:06:28', '2017-01-23 08:36:50', 1, 3, 4, '', 0, 1),
(12, 'CDP5', '', 'cdp5@test.com', '$2y$10$kR74zl2mZCeHelaa/mJB7OkvpXyLrJFbInmR2KsEPZB6eS55xQFaq', 'zSRIsVpBInDvcVnpJBto09kUqrg6FdE67zz0WbLYXgbyOMfR71zdc3TAbaFZ', '2017-01-22 14:55:01', '2017-01-23 12:23:36', 5, 1, 4, '', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
