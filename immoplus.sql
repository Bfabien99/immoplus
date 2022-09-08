-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 08 sep. 2022 à 14:23
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immoplus`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL COMMENT 'property_ID',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('location','vendre') NOT NULL,
  `address` text DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `post_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `property`
--

INSERT INTO `property` (`id`, `title`, `description`, `type`, `address`, `area`, `price`, `post_date`) VALUES
(1, 'Property 1', 'A beautiful property', 'location', 'Abidjan', '123', '120000', '2022-09-07 19:09:12'),
(2, 'Property 2', 'A wonderful Property', 'location', 'Gagnoa', '300', '200000', '2022-09-07 19:09:12'),
(4, 'Property 3', 'A wonderful Property', 'vendre', 'Cocody', '500', '723000', '2022-09-07 20:12:41'),
(5, 'Property 4', 'A wonderful Property', 'vendre', 'Angré', '250', '140000', '2022-09-07 20:20:53'),
(6, 'Property 5', 'A wonderful Property', 'location', 'Abobo', '123', '123000', '2022-09-07 20:59:58'),
(7, 'Property 6', 'A wonderful Property', 'location', 'Gagnoa', '300', '200000', '2022-09-07 21:58:47');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'User_ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'property_ID', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User_ID';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
