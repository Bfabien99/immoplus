-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 13 sep. 2022 à 16:56
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.28

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
  `shower` int(11) DEFAULT NULL,
  `bedroom` int(11) DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `post_date` datetime DEFAULT current_timestamp(),
  `etat` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `property`
--

INSERT INTO `property` (`id`, `title`, `description`, `type`, `address`, `area`, `price`, `shower`, `bedroom`, `picture`, `post_date`, `etat`) VALUES
(1, 'Property 1', 'A beautiful property', 'location', 'Abidjan', '123', '120000', NULL, NULL, NULL, '2022-09-07 19:09:12', 0),
(2, 'Property 2', 'A wonderful Property', 'location', 'Gagnoa', '300', '200000', NULL, NULL, NULL, '2022-09-07 19:09:12', 0),
(4, 'Property 3', 'A wonderful Property', 'vendre', 'Cocody', '500', '723000', NULL, NULL, NULL, '2022-09-07 20:12:41', 0),
(5, 'Property 4', 'A wonderful Property', 'vendre', 'Angré', '250', '140000', NULL, NULL, NULL, '2022-09-07 20:20:53', 0),
(6, 'Property 5', 'A wonderful Property', 'location', 'Abobo', '123', '123000', NULL, NULL, NULL, '2022-09-07 20:59:58', 0),
(7, 'Property 6', 'A wonderful Property', 'location', 'Gagnoa', '300', '200000', NULL, NULL, NULL, '2022-09-07 21:58:47', 0),
(8, 'Property 7', 'A wonderful Property', 'location', 'Gagnoa', '300', '200000', 2, 2, 'https://www.unsplash.com/photos/eWqOgJ-lfiI', '2022-09-10 09:37:52', 0),
(9, 'Property 8', 'A wonderful Property', 'location', 'Agboville', '300', '200000', 2, 2, 'https://www.unsplash.com/photos/eWqOgJ-lfiI', '2022-09-10 09:41:10', 0),
(10, 'Corporate Intranet Manager', 'Sint perspiciatis cumque a beatae ducimus. Magnam consequatur quasi similique quisquam nisi quasi non magnam. Quia quibusdam ex quia.', 'location', '7156 Walsh Branch', '505', '5026', 137, 559, 'https://i.imgur.com/wfCe9Nz.jpg', '2022-09-10 11:03:15', 0),
(11, 'Corporate Identity Assistant', 'Ut dicta quis explicabo et perferendis et. Illum non totam dolore eius sit ut in fugit. Adipisci quae vel error ut dicta in facilis.', 'location', '78103 Florence Key', '440', '5548', 442, 47, 'https://i.imgur.com/b7TUcGw.jpg', '2022-09-10 11:25:19', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'property_ID', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User_ID';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
