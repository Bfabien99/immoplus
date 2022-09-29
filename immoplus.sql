-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 29 sep. 2022 à 15:38
-- Version du serveur : 10.4.21-MariaDB
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
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `insert_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `pseudo`, `password`, `insert_date`) VALUES
(1, 'BROU FABIEN', 'admin', '2aefc34200a294a3cc7db81b43a81873', '2022-09-22 12:55:44');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `etat` tinyint(1) DEFAULT 0,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `fullname`, `contact`, `email`, `message`, `etat`, `date`) VALUES
(15, 'Connor Friesen', '588-676-3081', 'your.email+fakedata21087@gmail.com', 'Quas vel atque placeat necessitatibus voluptatum.', 0, '2022-09-29 13:37:10');

-- --------------------------------------------------------

--
-- Structure de la table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL COMMENT 'property_ID',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('location','vendre') NOT NULL,
  `address` text NOT NULL,
  `area` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `shower` int(11) NOT NULL,
  `bedroom` int(11) NOT NULL,
  `picture` text DEFAULT NULL,
  `post_date` datetime DEFAULT current_timestamp(),
  `etat` tinyint(1) DEFAULT 0,
  `view` int(11) DEFAULT 0,
  `_userId` int(11) DEFAULT NULL,
  `raison` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `property`
--

INSERT INTO `property` (`id`, `title`, `description`, `type`, `address`, `area`, `price`, `shower`, `bedroom`, `picture`, `post_date`, `etat`, `view`, `_userId`, `raison`) VALUES
(19, 'Chief Tactics Agent', 'Fugit illo consequatur aut eligendi. Commodi tenetur ullam aperiam similique dolore omnis. Laborum iusto consequatur.', 'location', '602 Destin Cape', '58', '5051', 38, 31, 'https://i.imgur.com/VtCjpCg.jpg', '2022-09-29 11:34:47', 1, 1, 6, 'Reiciendis explicabo omnis.'),
(21, 'Chief Tact', 'Fugit illo consequatur aut eligendi. Commodi tenetur ullam aperiam similique dolore omnis. Laborum iusto consequatur.', 'location', 'Yopougon Maroc, Maroc Canari, Maroc, Côte d\'Ivoire', '1000', '900000', 38, 31, 'https://i.imgur.com/oE1CSH9.jpg', '2022-09-29 11:36:11', 0, 0, 6, 'Reiciendis explicabo omnis.'),
(23, 'Central Accountability Technician', 'At quia fugiat quaerat. Recusandae et eum. Modi velit qui eligendi.', 'vendre', '845 Hal Mission', '256', '5169', 26, 2, 'https://i.imgur.com/8CzBIIE.jpg', '2022-09-29 12:41:00', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'User_ID',
  `gender` enum('m','f') NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `contact` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `insert_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `gender`, `fullname`, `description`, `contact`, `birth`, `email`, `pseudo`, `password`, `insert_date`) VALUES
(6, 'm', 'BROU KOUADIO STEPHANE FABIEN', 'Travailleur, studieux, responsable', '0022553148864', '1999-05-18', 'mytestomailer@gmail.com', 'bfabien99', 'a6bfcd001db037c98cf6463cfa9a38d1', '2022-09-29 10:38:50');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_ibfk_1` (`_userId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'property_ID', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User_ID', AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`_userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
