-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 25 avr. 2021 à 23:05
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetsite_html`
--

-- --------------------------------------------------------

--
-- Structure de la table `authentification`
--

CREATE TABLE `authentification` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(20) DEFAULT NULL,
  `mdp` varchar(20) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `mail` varchar(20) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `contrat` varchar(20) NOT NULL,
  `situationFamillial` varchar(20) DEFAULT NULL,
  `adresse` varchar(150) DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `authentification`
--

INSERT INTO `authentification` (`id`, `identifiant`, `mdp`, `nom`, `prenom`, `mail`, `tel`, `contrat`, `situationFamillial`, `adresse`, `age`) VALUES
(1, 'Cédric', 'cedric00', 'chhuon', 'cédric', 'cedric.chhuon@esme.f', '0754253357', 'CDD-3mois', 'Célibataire', '38 rue Molière', 20),
(2, 'Camille', 'Kamomille', 'bayon de noyer', 'camille', 'camille.bayon-de-noy', 'oui', 'CDD-3mois', 'pacsé', '40 rue Molière ', 50),
(3, 'Alexandre', 'patate', 'hoareau', 'alexandre', 'alexandre.hoareau@es', 'non', 'CDD-3mois', 'pacsé', '50 rue Molière ', 3),
(4, '1111', '2222', 'test', '4444', '5555@esme.fr', '6666', 'CDD-7mois', 'marié', '10 rue Molière ', 89),
(5, 'Jean', 'patron', 'Morru', 'Jean', 'morru.jean@hotmail.c', '0523621456', 'patron', 'non', 'mmmm', 18);

-- --------------------------------------------------------

--
-- Structure de la table `congé`
--

CREATE TABLE `congé` (
  `id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `commentaire` varchar(300) DEFAULT NULL,
  `heure` time NOT NULL,
  `personne` int(11) DEFAULT NULL,
  `date_congé` date DEFAULT NULL,
  `durée` varchar(30) DEFAULT NULL,
  `état` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `authentification`
--
ALTER TABLE `authentification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `congé`
--
ALTER TABLE `congé`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personne` (`personne`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `authentification`
--
ALTER TABLE `authentification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `congé`
--
ALTER TABLE `congé`
  ADD CONSTRAINT `congé_ibfk_1` FOREIGN KEY (`personne`) REFERENCES `authentification` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
