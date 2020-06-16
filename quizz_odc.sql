-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 16 Juin 2020 à 06:20
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `quizz_odc`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `login` varchar(254) NOT NULL,
  `password` varchar(254) DEFAULT NULL,
  `prenom` varchar(254) DEFAULT NULL,
  `nom` varchar(254) DEFAULT NULL,
  `avatar` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`login`, `password`, `prenom`, `nom`, `avatar`) VALUES
('admin', 'admin', 'Admin', 'System', 'asset/img/Avatar/admin.png'),
('seckdieng', 'seckdieng', 'Ibrahima', 'Dieng', 'asset/img/Avatar/seckdieng.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `login` varchar(254) NOT NULL,
  `password` varchar(254) DEFAULT NULL,
  `prenom` varchar(254) DEFAULT NULL,
  `nom` varchar(254) DEFAULT NULL,
  `avatar` varchar(254) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `statut` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `joueur`
--

INSERT INTO `joueur` (`login`, `password`, `prenom`, `nom`, `avatar`, `score`, `statut`) VALUES
('cr7', 'ballonor', 'Cristiano', 'Ronaldo', 'asset/img/Avatar/cr7.jpg', 170, 'active'),
('joueur', 'joueur', 'Joueur', 'System', 'asset/img/Avatar/joueur.png', 0, 'desactive'),
('lapulga', 'ballonor', 'Lionel', 'Messi', 'asset/img/Avatar/messi.jpg', 40, 'desactive'),
('neymar', 'blesse', 'Neymar', 'Desilva', 'asset/img/Avatar/neymar.jpg', 70, 'active');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `question` varchar(254) DEFAULT NULL,
  `nbre_point` int(11) DEFAULT NULL,
  `type_reponse` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id_question`, `question`, `nbre_point`, `type_reponse`) VALUES
(10, 'Quels sont les langages de programmation ?', 30, 'Choix multiple'),
(11, 'Comment appelle-t-on une personne qui paie des impots ?', 30, 'Choix simple'),
(12, 'Quel est le nom de l\'acteur principal dans la serie Prison Break ?', 30, 'Choix simple'),
(13, 'Quel est le pays le plus peuplÃ© du monde ?', 20, 'Choix simple'),
(14, 'Quelles sont les rÃ©gions du Senegal ?', 10, 'Choix multiple'),
(19, 'Qui a Ã©tÃ© prÃ©sident de la RÃ©publique dans cette Liste ?', 20, 'Choix multiple'),
(20, 'Comment on appelle la femelle du cheval ?', 10, 'Choix simple'),
(21, 'En quelle s\'est jouÃ© la premiÃ¨re coupe du monde de football ?', 30, 'Choix simple'),
(22, 'En quelle annÃ©e le SÃ©nÃ©gal a participÃ© Ã  une coupe du monde ?', 10, 'Choix texte'),
(23, 'En quelle annÃ©e le SÃ©nÃ©gal a perdu sa derniÃ¨re finale de coupe d\'afrique ?', 10, 'Choix texte');

-- --------------------------------------------------------

--
-- Structure de la table `questionajoutee`
--

CREATE TABLE `questionajoutee` (
  `login` varchar(254) NOT NULL,
  `id_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `questionsparjeu`
--

CREATE TABLE `questionsparjeu` (
  `nombre_question` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `questionsparjeu`
--

INSERT INTO `questionsparjeu` (`nombre_question`) VALUES
(6);

-- --------------------------------------------------------

--
-- Structure de la table `questionsrepondues`
--

CREATE TABLE `questionsrepondues` (
  `login` varchar(254) NOT NULL,
  `id_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `questionsrepondues`
--

INSERT INTO `questionsrepondues` (`login`, `id_question`) VALUES
('cr7', 10),
('cr7', 11),
('cr7', 12),
('cr7', 13),
('cr7', 14),
('cr7', 19),
('cr7', 20),
('cr7', 21),
('cr7', 22),
('cr7', 23);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `id_reponse` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `reponse` varchar(254) DEFAULT NULL,
  `statut` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reponses`
--

INSERT INTO `reponses` (`id_reponse`, `id_question`, `reponse`, `statut`) VALUES
(19, 10, 'Pascal', 'faux'),
(20, 10, 'PHP', 'vrai'),
(21, 10, 'R', 'faux'),
(22, 10, 'HTML', 'vrai'),
(23, 11, 'percepteur', 'faux'),
(24, 11, 'fiscaliste', 'faux'),
(25, 11, 'contribuable', 'vrai'),
(26, 12, 'Dominic Purcell', 'faux'),
(27, 12, 'Will Smith', 'faux'),
(28, 12, 'Wentworth Smiller', 'vrai'),
(29, 12, 'David Guntoli', 'faux'),
(30, 13, 'Inde', 'faux'),
(31, 13, 'Chine', 'vrai'),
(32, 13, 'Nigeria', 'faux'),
(33, 14, 'Dakar', 'vrai'),
(34, 14, 'GorÃ©e', 'faux'),
(35, 14, 'Diourbel', 'vrai'),
(36, 14, 'Matam', 'vrai'),
(42, 19, 'Abdoulaye Wade', 'vrai'),
(43, 19, 'Che Guevara', 'faux'),
(44, 19, 'Georges Pompidou', 'vrai'),
(45, 19, 'Mamadou Dia', 'faux'),
(46, 20, 'brebis', 'faux'),
(47, 20, 'jument', 'vrai'),
(48, 20, 'hase', 'faux'),
(49, 21, '1926', 'faux'),
(50, 21, '1930', 'vrai'),
(51, 21, '1934', 'faux'),
(52, 22, '2002', 'vrai'),
(53, 23, '2019', 'vrai');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`);

--
-- Index pour la table `questionajoutee`
--
ALTER TABLE `questionajoutee`
  ADD PRIMARY KEY (`login`,`id_question`),
  ADD KEY `FK_association4` (`id_question`);

--
-- Index pour la table `questionsrepondues`
--
ALTER TABLE `questionsrepondues`
  ADD PRIMARY KEY (`login`,`id_question`),
  ADD KEY `FK_association2` (`id_question`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id_reponse`),
  ADD KEY `FK_association1` (`id_question`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `questionajoutee`
--
ALTER TABLE `questionajoutee`
  ADD CONSTRAINT `FK_association4` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_association5` FOREIGN KEY (`login`) REFERENCES `admin` (`login`) ON DELETE CASCADE;

--
-- Contraintes pour la table `questionsrepondues`
--
ALTER TABLE `questionsrepondues`
  ADD CONSTRAINT `FK_association2` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_association3` FOREIGN KEY (`login`) REFERENCES `joueur` (`login`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `FK_association1` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
