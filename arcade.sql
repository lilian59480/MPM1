-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `arcade`
--

-- --------------------------------------------------------

--
-- Structure de la table `T_Jeu`
--

CREATE TABLE IF NOT EXISTS `T_Jeu` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `urlimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vider la table avant d'insérer `T_Jeu`
--

TRUNCATE TABLE `T_Jeu`;
--
-- Contenu de la table `T_Jeu`
--

INSERT INTO `T_Jeu` (`id`, `nom`, `description`, `urlimage`) VALUES
(1, 'Space Invaders', 'Un jeu de SpaceInvaders', 'si.gif'),
(2, 'Casse Brique', 'Un jeu de Casse-Brique', 'cb.gif');

-- --------------------------------------------------------

--
-- Structure de la table `T_Score`
--

CREATE TABLE IF NOT EXISTS `T_Score` (
  `id` int(11) NOT NULL,
  `idpseudo` int(11) NOT NULL,
  `idjeu` int(11) NOT NULL,
  `score` int(10) unsigned NOT NULL,
  `datescore` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vider la table avant d'insérer `T_Score`
--

TRUNCATE TABLE `T_Score`;

-- --------------------------------------------------------

--
-- Structure de la table `T_Utilisateur`
--

CREATE TABLE IF NOT EXISTS `T_Utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(16) NOT NULL,
  `motdepasse` varchar(32) NOT NULL,
  `derniereconnexion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vider la table avant d'insérer `T_Utilisateur`
--

TRUNCATE TABLE `T_Utilisateur`;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `T_Jeu`
--
ALTER TABLE `T_Jeu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `T_Score`
--
ALTER TABLE `T_Score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_util` (`idpseudo`),
  ADD KEY `FK_jeu` (`idjeu`);

--
-- Index pour la table `T_Utilisateur`
--
ALTER TABLE `T_Utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `T_Jeu`
--
ALTER TABLE `T_Jeu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `T_Score`
--
ALTER TABLE `T_Score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `T_Utilisateur`
--
ALTER TABLE `T_Utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `T_Score`
--
ALTER TABLE `T_Score`
  ADD CONSTRAINT `FK_jeu` FOREIGN KEY (`idjeu`) REFERENCES `T_Jeu` (`id`),
  ADD CONSTRAINT `FK_util` FOREIGN KEY (`idpseudo`) REFERENCES `T_Utilisateur` (`id`);
