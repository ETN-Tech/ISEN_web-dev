-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 16 oct. 2020 à 10:22
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
-- Structure de la table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `last_connexion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `name`, `surname`, `email`, `last_connexion`) VALUES
(1, 'etienne', '$2y$10$VH5ROH2/JncL7McIlUJX9ewqbrSjF4q6hOrXY7SjdQBVlkOFtxpTy', 'S', 'Etienne', 'etienne.schelfhout.pro@gmail.com', '2020-10-09 14:54:57');

-- --------------------------------------------------------

--
-- Structure de la table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `label`, `description`, `img_url`) VALUES
(1, 'animals', 'Animals', 'How much do you know about the animal kingdom ?', 'https://cdn.images.express.co.uk/img/dynamic/128/590x/africa-animals-677711.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `quizz_questions`
--

CREATE TABLE `quizz_questions` (
  `id` int(11) NOT NULL,
  `quizz_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `tips` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quizz_questions`
--

INSERT INTO `quizz_questions` (`id`, `quizz_id`, `type`, `question`, `tips`) VALUES
(1, 1, 'radio', 'What’s the first thing a caterpillar usually eats after it’s born?', NULL),
(2, 1, 'input', 'How many pounds does the trumpeter swan—North America’s largest waterfowl—weighs ?', 'Enter a round number'),
(3, 1, 'checkbox', 'Which of the following animals are noctural ?', NULL),
(4, 1, 'input', 'What is a baby rabbit called?', NULL),
(5, 1, 'radio', 'An ant says, “Danger ahead!” by doing what?', '');

-- --------------------------------------------------------

--
-- Structure de la table `quizz_questions_input`
--

CREATE TABLE `quizz_questions_input` (
  `id` int(11) NOT NULL,
  `quizz_question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quizz_questions_input`
--

INSERT INTO `quizz_questions_input` (`id`, `quizz_question_id`, `answer`) VALUES
(1, 2, '30'),
(2, 4, 'Kit');

-- --------------------------------------------------------

--
-- Structure de la table `quizz_questions_radio_checkbox`
--

CREATE TABLE `quizz_questions_radio_checkbox` (
  `id` int(11) NOT NULL,
  `quizz_question_id` int(11) NOT NULL,
  `proposition` varchar(255) NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quizz_questions_radio_checkbox`
--

INSERT INTO `quizz_questions_radio_checkbox` (`id`, `quizz_question_id`, `proposition`, `is_correct`) VALUES
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
(12, 5, 'Oozing chemicals', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `quizz_questions`
--
ALTER TABLE `quizz_questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `quizz_id` (`quizz_id`);

--
-- Index pour la table `quizz_questions_input`
--
ALTER TABLE `quizz_questions_input`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `quizz_question_id` (`quizz_question_id`);

--
-- Index pour la table `quizz_questions_radio_checkbox`
--
ALTER TABLE `quizz_questions_radio_checkbox`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `quizz_question_id` (`quizz_question_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `quizz_questions`
--
ALTER TABLE `quizz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `quizz_questions_input`
--
ALTER TABLE `quizz_questions_input`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `quizz_questions_radio_checkbox`
--
ALTER TABLE `quizz_questions_radio_checkbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `quizz_questions`
--
ALTER TABLE `quizz_questions`
  ADD CONSTRAINT `foreign_quizz_question` FOREIGN KEY (`quizz_id`) REFERENCES `quizzes` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `quizz_questions_input`
--
ALTER TABLE `quizz_questions_input`
  ADD CONSTRAINT `foreign_quizz_question_input` FOREIGN KEY (`quizz_question_id`) REFERENCES `quizz_questions` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `quizz_questions_radio_checkbox`
--
ALTER TABLE `quizz_questions_radio_checkbox`
  ADD CONSTRAINT `foreign_quizz_question_radio_checkbox` FOREIGN KEY (`quizz_question_id`) REFERENCES `quizz_questions` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
