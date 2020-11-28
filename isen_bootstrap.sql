-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 28 nov. 2020 à 13:42
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
CREATE DATABASE IF NOT EXISTS `isen_bootstrap` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `isen_bootstrap`;

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
(17, 4, 'Kit', 1),
(18, 12, '1923', 0),
(19, 12, '1938', 0),
(20, 12, '1917', 0),
(21, 12, '1914', 1),
(22, 13, 'Dallas', 1),
(23, 14, 'Bull Halsey', 0),
(24, 14, 'George Patton', 0),
(25, 14, 'Douglas MacArthur', 1),
(26, 14, 'Omar Bradley', 0),
(27, 15, 'France', 1),
(28, 15, 'Italy', 0),
(29, 15, 'Carthage', 0),
(30, 15, 'England', 1),
(31, 16, 'Magellan', 0),
(32, 16, 'Cook', 0),
(33, 16, 'Marco Polo', 1),
(34, 16, 'Sir Francis Drake', 0);

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
(5, 1, 'radio', 'An ant says, “Danger ahead!” by doing what?'),
(12, 2, 'radio', 'World War I began in which year ? '),
(13, 2, 'input', 'In which city was F. Kennedy assassinated ?'),
(14, 2, 'select', 'Which general famously stated \'I shall return\' ?'),
(15, 2, 'checkbox', 'Between which countries was The Hundred Years War fought ? '),
(16, 2, 'radio', 'Who was the first Western explorer to reach China? ');

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
(1, 'animals', 'Animals', 'How much do you know about the animal kingdom ?', 'https://cdn.images.express.co.uk/img/dynamic/128/590x/africa-animals-677711.jpg'),
(2, 'world-history', 'World History', 'Do you have enough knowledge of world history ? If so, then this quiz is definitely for you !', 'https://cdn.searchenginejournal.com/wp-content/uploads/2017/05/SEJ-PRT-Depositphotos-Featured_Image.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `quizz`
--
ALTER TABLE `quizz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
