-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 06 nov. 2020 à 17:46
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `isen_bootstrap`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `last_connexion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `account_answer`
--

CREATE TABLE `account_answer` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `answer`
--

INSERT INTO `answer` (`id`, `question_id`, `answer`, `is_correct`) VALUES
(1, 1, 'Other bugs', 0),
(2, 1, 'Its own eggshell', 1),
(3, 1, 'Grass', 0),
(4, 1, 'Cheerios', 0),
(5, 3, 'Sheep', 0),
(6, 3, 'Skunk', 1),
(7, 3, 'Leopard', 1),
(8, 3, 'Tiger', 1),
(9, 5, 'Squealing', 0),
(10, 5, 'Running toward water', 0),
(11, 5, 'Rolling on its back', 0),
(12, 5, 'Oozing chemicals', 1),
(13, 2, '10', 0),
(14, 2, '30', 1),
(15, 2, '50', 0),
(16, 2, '70', 0),
(17, 4, 'Kit', 1);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `quizz_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `quizz_id`, `type`, `question`) VALUES
(1, 1, 'radio', 'What’s the first thing a caterpillar usually eats after it’s born?'),
(2, 1, 'select', 'How many pounds does the trumpeter swan—North America’s largest waterfowl—weighs ?'),
(3, 1, 'checkbox', 'Which of the following animals are noctural ?'),
(4, 1, 'input', 'What is a baby rabbit called?'),
(5, 1, 'radio', 'An ant says, “Danger ahead!” by doing what?');

-- --------------------------------------------------------

--
-- Structure de la table `quizz`
--

CREATE TABLE `quizz` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quizz`
--

INSERT INTO `quizz` (`id`, `name`, `title`, `description`, `img_url`) VALUES
(1, 'animals', 'Animals', 'How much do you know about the animal kingdom ?', 'https://cdn.images.express.co.uk/img/dynamic/128/590x/africa-animals-677711.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `account_answer`
--
ALTER TABLE `account_answer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `foreign_account` (`account_id`),
  ADD KEY `foreign_answer` (`answer_id`);

--
-- Index pour la table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `quizz_question_id` (`question_id`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `quizz_id` (`quizz_id`);

--
-- Index pour la table `quizz`
--
ALTER TABLE `quizz`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `account_answer`
--
ALTER TABLE `account_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `quizz`
--
ALTER TABLE `quizz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `account_answer`
--
ALTER TABLE `account_answer`
  ADD CONSTRAINT `foreign_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_answer` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`);

--
-- Contraintes pour la table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `foreign_question` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `foreign_quizz` FOREIGN KEY (`quizz_id`) REFERENCES `quizz` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
