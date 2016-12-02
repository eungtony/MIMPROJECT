-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 02 Décembre 2016 à 14:30
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
(1, 'CDP1', 'eungtony@outlook.fr', '$2y$10$IR/AqG03f3U63MlAwZ37SOiZ/y35grPewZai6cExLLZJAr76twSea', '7SsJdOU8CfTMHvtY7VHN1AoBqdNXSCZJuVQfZ2j7XueNmHSdvNj8mAO3HBoU', '2016-11-12 18:13:09', '2016-12-02 09:59:36', 1, 1, 3, 'jpg', 1),
(2, 'Dev10', 'test@test.com', '$2y$10$LEpv3B.p.V0R.pqqijOKZuIvh9lpADE/FWgaJt6mDsFI2WY4fnaaG', 'SpBz4p8ibT7V8xvViwlOKBBKG65Z9Kssgg5TFlzxhdNwansys7kweO8iE689', '2016-11-14 20:52:20', '2016-11-29 12:56:58', 2, 3, 4, '', 0),
(3, 'Dev2', 'test2@test.com', '$2y$10$Dj982gKolHMHF3wSLRLzBOzwuICFqGc3GZaXMOTf.dcsRJtxrLmI.', 'R7dsdPwFAyi7ZgQP9P8hdrLVVXX3uTFYWwnZtHBN4J1rWPHTiXawjVfBkoIT', '2016-11-14 20:56:58', '2016-11-30 09:03:47', 1, 3, 4, '', 0),
(4, 'CDP2', 'test3@test.com', '$2y$10$Yn/ggKqvuDHRkPXT6.43quKzZc1schRgF5w/cbRmI7b4MLEVIN0UC', 'bAshmFekeL2ulsJeRjMEqQGy7gcAbLLOwLzMPvcaQHMktjxvLFF3IzMeiTez', '2016-11-15 20:00:33', '2016-11-20 22:14:57', 2, 1, 3, '', 0),
(5, 'Supervisor', 'supervisor@test.com', '$2y$10$71C1V/cnBi.E9WDAZMFIkeseIeSuWESl1LAJKnLFWsigPx6zSYUcW', 'vUScEDwoWLITJfR1RVLqq8E1CjInyEetmhNdpQn1QSJg4oiaolUlwAP42xUU', '2016-11-15 21:47:04', '2016-12-01 22:31:46', 2, 3, 1, '', 0),
(6, 'Bureau1', 'bureau1@test.com', '$2y$10$fns/Kv1Yvsisya18gYTbGe9ScVUNRQgQXO91IEaML7HBNF65h6hBe', '4ZYCLIHzZuc5ErfiBqpdhRjCvhAe8KeqLRkxpq6INzvMWPSRhnLADjtxy8wy', '2016-11-15 21:50:08', '2016-11-28 09:04:44', 3, 1, 2, '', 0),
(7, 'Bureau2', 'bureau2@test.com', '$2y$10$gkTml1A65WaUqYi5O0g4TuC2UM8KI44wSs4VvfbaNnK51jd8kVn.q', 'FPDzkburCMuuf3I3RnpKlECUJqCgcGQVmwrGbBP77PVK7KiA1iEbFYg2tgNN', '2016-11-15 21:51:50', '2016-12-01 22:26:33', 2, 1, 2, '', 0),
(8, 'dev3', 'dev3@test.com', '$2y$10$Upc6G238Qj/QbKQtyud4A.cr8yyydzd67xgh0zc86E563ddoSMQfa', 'bGPWd6HetSyUlSjrOPCcdUYIVT1ptjVIbIZJuAcfE9EjN7rMum4XSvVgmg1z', '2016-11-24 20:42:51', '2016-12-01 18:44:03', 3, 2, 4, '', 0),
(9, 'dev4', 'dev4@test.com', '$2y$10$oSERMnpxVH4S/Mu1e65rPev9MkYPRkB0YHrCIw9F8lqiwiu/75X/e', '2Qi5CaifHehZ6668AGA7N34YBjKdZvHTrSAM6YjoAA2WhBDzK1I43YRgubwb', '2016-11-24 20:43:47', '2016-12-01 22:32:51', 4, 2, 4, '', 0),
(10, 'CDP4', 'cdp4@test.com', '$2y$10$BzqcWhUrbCavR/0N8bAjie9vlsHcYawbwEdE4C8RjhnZBiPiR5hdq', 'FEQHD1h5Sal5xDdwmWMfRh5yRoUdr8CQ7Dex6U7acTbdSEtVguCM5vGh3loB', '2016-11-24 20:44:40', '2016-11-27 21:07:27', 4, 1, 3, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
