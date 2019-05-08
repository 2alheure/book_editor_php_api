-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 08 mai 2019 à 16:49
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `book_editor`
--

-- --------------------------------------------------------

--
-- Structure de la table `blocs`
--

DROP TABLE IF EXISTS `blocs`;
CREATE TABLE IF NOT EXISTS `blocs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bloc_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `bloc_params`
--

DROP TABLE IF EXISTS `bloc_params`;
CREATE TABLE IF NOT EXISTS `bloc_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `bloc_param_values`
--

DROP TABLE IF EXISTS `bloc_param_values`;
CREATE TABLE IF NOT EXISTS `bloc_param_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `bloc_param_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bloc_param_id` (`bloc_param_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` text COLLATE utf8_bin,
  `description` text COLLATE utf8_bin,
  `version` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `downloads` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `subtitle`, `image`, `description`, `version`, `downloads`, `created_at`, `updated_at`) VALUES
(1, 'Alice au Pays des Merveilles', NULL, 'https://media.istockphoto.com/illustrations/alices-adventures-in-wonderland-illustration-id185304146', 'Alice s\'ennuie auprès de sa sœur qui lit un livre (« sans images, ni dialogues ») tandis qu\'elle ne fait rien. « À quoi bon un livre sans images, ni dialogues ? », se demande Alice. Mais voilà qu\'un lapin blanc aux yeux roses vêtu d\'une redingote avec une montre à gousset à y ranger passe près d\'elle en courant. Cela ne l\'étonne pas le moins du monde. Pourtant, lorsqu\'elle le voit sortir une montre de sa poche et s\'écrier : « Je suis en retard ! En retard ! En retard ! », elle se dit que décidément ce lapin a quelque chose de spécial. En entrant derrière lui dans son terrier, elle fait une chute presque interminable qui l\'emmène dans un monde aux antipodes du sien. Elle va rencontrer une galerie de personnages retors et se trouver confrontée au paradoxe, à l\'absurde et au bizarre…', NULL, 0, NULL, NULL),
(2, 'C\'est l\'histoire de ma vie', 'Chapitre I : mon enfance', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', NULL, NULL, 0, NULL, NULL),
(3, 'C\'est l\'histoire de ma vie', 'Chapitre II : mon adolescence', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', NULL, NULL, 10, NULL, NULL),
(4, 'C\'est l\'histoire de ma vie', 'Chapitre III : ma vie adulte', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit voluptatum neque dolorem sit, maxime quos! Blanditiis in tempore error, architecto soluta dolorem, dolore aliquam incidunt eaque ab quia maiores quas! Magni odit veniam blanditiis nihil officiis debitis, mollitia nobis voluptatem praesentium architecto neque consectetur. Obcaecati esse vel aliquam voluptatum ad expedita saepe, sit voluptate necessitatibus architecto. Soluta beatae deserunt harum? Ipsum delectus officia repudiandae tempora unde quod ex, cupiditate aut facere ab animi itaque numquam magni, blanditiis, laudantium recusandae quas commodi voluptatem? Ad quidem dicta beatae earum voluptates deleniti! Possimus. Quo esse excepturi ipsum a laudantium ex incidunt dolorem perspiciatis. Quia quisquam ipsam, dolorum tempore reiciendis corporis dolore nobis facere temporibus, deleniti, eum libero. Tempora explicabo qui quo debitis deserunt? Non sapiente odit voluptatibus repudiandae cumque recusandae, nemo corrupti aut aperiam, necessitatibus quisquam alias laboriosam fuga! Placeat sunt qui officia quae culpa libero eveniet? Molestias ullam nihil voluptates labore odio.', NULL, 5, NULL, NULL),
(5, 'C\'est l\'histoire de ta vie', 'Chapitre I : ton enfance', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', NULL, NULL, 0, NULL, NULL),
(6, 'C\'est l\'histoire de ta vie', 'Chapitre II : ton adolescence', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', NULL, NULL, 0, NULL, NULL),
(7, 'C\'est l\'histoire de ta vie', 'Chapitre III : ta vie adulte', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `book_blocs`
--

DROP TABLE IF EXISTS `book_blocs`;
CREATE TABLE IF NOT EXISTS `book_blocs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `bloc_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bloc_id` (`bloc_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `book_contributors`
--

DROP TABLE IF EXISTS `book_contributors`;
CREATE TABLE IF NOT EXISTS `book_contributors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `book_id` (`book_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `book_contributors`
--

INSERT INTO `book_contributors` (`id`, `book_id`, `user_id`, `role_id`) VALUES
(1, 1, 1, 2),
(2, 2, 4, 2),
(4, 3, 4, 2),
(5, 5, 5, 2),
(6, 6, 5, 2),
(7, 7, 5, 2),
(8, 4, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `book_readers`
--

DROP TABLE IF EXISTS `book_readers`;
CREATE TABLE IF NOT EXISTS `book_readers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `book_readers`
--

INSERT INTO `book_readers` (`id`, `book_id`, `user_id`, `date`) VALUES
(1, 3, 3, '2019-05-08 12:25:00'),
(2, 2, 3, '2019-05-08 12:24:31'),
(3, 4, 3, '2019-05-08 12:26:31'),
(4, 1, 3, '2019-05-08 12:27:31');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `note` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `book_id` (`book_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `comment`, `note`, `created_at`, `updated_at`, `author_id`, `book_id`, `user_id`) VALUES
(1, 'Une note test', 4.85, '2019-05-07 09:06:26', '2019-05-07 09:06:26', 3, 4, NULL),
(2, 'Un commentaire test', NULL, '2019-05-07 09:06:26', '2019-05-07 09:06:26', 3, NULL, 4),
(3, 'Une autre note test', 2, '2019-05-07 17:22:02', '2019-05-07 17:22:02', 3, 1, NULL),
(4, 'Un autre commentaire de test', NULL, '2019-05-07 17:22:47', '2019-05-07 17:22:47', 3, 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrateur'),
(2, 'Auteur'),
(3, 'Correcteur orthographique'),
(4, 'Traducteur'),
(5, 'Relecteur');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) COLLATE utf8_bin NOT NULL,
  `login` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` text COLLATE utf8_bin,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `login`, `password`, `email`, `image`, `created_at`) VALUES
(1, 'Book Editor Classics', 'be_classics', 'gmonufgh\"ç234', 'book_editor.classics@2alheure.fr', 'https://avatars1.githubusercontent.com/u/33897186?s=460&v=4', '2019-05-06 07:44:26'),
(2, 'Book Editor', 'book_editor', 'qsmihg\'\"223', 'book_editor@2alheure.fr', 'https://avatars1.githubusercontent.com/u/33897186?s=460&v=4', '2019-05-06 07:44:26'),
(3, 'machin', 'truc', 'bidule', 'test@test.fr', NULL, '2019-03-28 19:15:00'),
(4, '2alheure', '2alheure', '2alheure', 'contact@2alheure.fr', 'https://cdn.discordapp.com/avatars/185470129193091072/6551a9208529f2fbbdcb3a522ef46160.png?size=512', '2019-05-06 07:44:26'),
(5, '2dtension', '2dtension', '2dtension', 'contact@2dtension.fr', NULL, '2019-05-06 07:44:26');

-- --------------------------------------------------------

--
-- Structure de la table `user_subscribers`
--

DROP TABLE IF EXISTS `user_subscribers`;
CREATE TABLE IF NOT EXISTS `user_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriber_id` (`subscriber_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user_subscribers`
--

INSERT INTO `user_subscribers` (`id`, `user_id`, `subscriber_id`) VALUES
(1, 5, 4),
(2, 3, 4);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bloc_param_values`
--
ALTER TABLE `bloc_param_values`
  ADD CONSTRAINT `bloc_param_values_ibfk_1` FOREIGN KEY (`bloc_param_id`) REFERENCES `bloc_params` (`id`);

--
-- Contraintes pour la table `book_blocs`
--
ALTER TABLE `book_blocs`
  ADD CONSTRAINT `book_blocs_ibfk_1` FOREIGN KEY (`bloc_id`) REFERENCES `blocs` (`id`),
  ADD CONSTRAINT `book_blocs_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Contraintes pour la table `book_contributors`
--
ALTER TABLE `book_contributors`
  ADD CONSTRAINT `book_contributors_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `book_contributors_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `book_contributors_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `book_readers`
--
ALTER TABLE `book_readers`
  ADD CONSTRAINT `book_readers_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `book_readers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `user_subscribers`
--
ALTER TABLE `user_subscribers`
  ADD CONSTRAINT `user_subscribers_ibfk_1` FOREIGN KEY (`subscriber_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_subscribers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
