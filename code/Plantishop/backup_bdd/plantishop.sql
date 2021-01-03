-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 03 Janvier 2021 à 22:18
-- Version du serveur :  5.7.11
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE `plantishop`;
use `plantishop`;

--
-- Base de données :  `plantishop`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `nom` varchar(500) NOT NULL,
  `prix` double NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id_article`, `type`, `nom`, `prix`, `description`) VALUES
(1, 'Plante', 'Monstera', 17.99, 'Merveilleuse plante d\'intérieur, le monstera est l\'une des plantes d\'intérieur les plus vendues mais aussi l\'une des plus résistantes et donc facile à cultiver.\r\n\r\nElle fait notre bonheur grâce à son grand pouvoir décoratif et son feuillage unique.'),
(2, 'Plante', 'Arbre ombrelle', 39.99, 'L\'Arbre-Parapluie est également appelé "Arbre-Ombrelle" ou "Parasol".\r\n\r\nDans son pays d\'origine, l\'Australie, l\'arbre-parapluie est un arbre de grande taille mais il dépasse rarement les deux mètres en culture.\r\n\r\nL\'arbre-parapluie est une plante très robuste et facile à cultiver tout en demandant quand même de la place.\r\n\r\nAttention la sève de l\'arbre-parapluie est irritante.\r\n\r\nC\'est une plante dépolluante et purificatrice.'),
(3, 'Plante', 'Dracaena', 17.99, 'Le dracaena est la plante verte par excellence. Il tient parfaitement en bac, même pour les plus grands sujets qui peuvent être sortis en été. Dépolluant, le dracaena apporte aux intérieurs une touche d\'exotisme et de couleur.'),
(4, 'Plante', 'Ficus', 9.99, 'Très variés autant dans la forme que dans le feuillage ou les conditions de culture, les ficus sont par contre toujours très décoratifs et très appréciés dans nos intérieurs. Principalement d’origine tropicale, ils apprécient lumière et chaleur, mais à des degrés divers et des apports d’eau généralement assez importants.'),
(5, 'Plante', 'Chrisanthème', 44.99, 'Hormis être installés au cimetière aux alentours de la Toussaint, les chrysanthèmes ont toutes les qualités pour orner un jardin ou un balcon. Leurs couleurs vives et variées, leurs fleurs en forme de marguerite et leur floraison automnale en font de véritables atouts pour le jardinier. Appréciant le soleil, ils demandent peu de soins et fournissent en retour de quoi faire de somptueux bouquets !!'),
(6, 'Plante', 'Palmier nain', 24.99, 'Placé dans le jardin ou sur une terrasse, le palmier nain constitue un arbuste de décoration très appréciable. L\'association avec une plante tropicale est aussi intéressante.'),
(7, 'Graine', 'Cerisier', 4.99, 'Arbre arrondi se couvrant, en fin d\'hiver tout début du printemps, de fleurs en coupe, blanches, sur des rameaux nus en même temps que les feuilles. Il produit de petits fruits rouges ou jaunes, comestibles à l\'aspect de prunes.');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

CREATE TABLE `ligne` (
  `id_commande` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_client` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `adresse_facturation` varchar(200) DEFAULT NULL,
  `adresse_livraison` varchar(200) DEFAULT NULL,
  `num_cb` int(17) DEFAULT NULL,
  `nom_cb` varchar(100) DEFAULT NULL,
  `num_cvv` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_client`, `type`, `username`, `pass`, `mail`, `tel`, `adresse_facturation`, `adresse_livraison`, `num_cb`, `nom_cb`, `num_cvv`) VALUES
(2, 'admin', 'tom', 'pass', 'tom@gmail.com', '06-32-34-55-12', 'adresse facturation', 'adresse livraison', 1234567, 'Nom CB', 123),
(3, 'admin', 'antoine', 'pass', 'antoine@gmail.com', '06-23-43-65-21', NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_client_fk` (`id_client`);

--
-- Index pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD PRIMARY KEY (`id_commande`,`id_article`),
  ADD KEY `fk_id_article` (`id_article`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_client`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `utilisateur` (`id_client`);

--
-- Contraintes pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD CONSTRAINT `fk_id_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `ligne_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
