-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 11 mai 2019 à 11:00
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

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
-- Structure de la table `be_bloc_types`
--

DROP TABLE IF EXISTS `be_bloc_types`;
CREATE TABLE IF NOT EXISTS `be_bloc_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `be_bloc_types`
--

INSERT INTO `be_bloc_types` (`id`, `name`) VALUES
(1, 'titre'),
(2, 'paragraphe'),
(3, 'image'),
(4, 'vidéo'),
(5, 'musique'),
(6, 'fichier'),
(7, 'avertissement'),
(8, 'conseil');

-- --------------------------------------------------------

--
-- Structure de la table `be_books`
--

DROP TABLE IF EXISTS `be_books`;
CREATE TABLE IF NOT EXISTS `be_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` text COLLATE utf8_bin,
  `description` text COLLATE utf8_bin,
  `version` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `content` text COLLATE utf8_bin,
  `downloads` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `be_books`
--

INSERT INTO `be_books` (`id`, `title`, `subtitle`, `image`, `description`, `version`, `content`, `downloads`, `created_at`, `updated_at`) VALUES
(1, 'Alice au Pays des Merveilles', NULL, 'https://media.istockphoto.com/illustrations/alices-adventures-in-wonderland-illustration-id185304146', 'Alice s\'ennuie auprès de sa sœur qui lit un livre (« sans images, ni dialogues ») tandis qu\'elle ne fait rien. « À quoi bon un livre sans images, ni dialogues ? », se demande Alice. Mais voilà qu\'un lapin blanc aux yeux roses vêtu d\'une redingote avec une montre à gousset à y ranger passe près d\'elle en courant. Cela ne l\'étonne pas le moins du monde. Pourtant, lorsqu\'elle le voit sortir une montre de sa poche et s\'écrier : « Je suis en retard ! En retard ! En retard ! », elle se dit que décidément ce lapin a quelque chose de spécial. En entrant derrière lui dans son terrier, elle fait une chute presque interminable qui l\'emmène dans un monde aux antipodes du sien. Elle va rencontrer une galerie de personnages retors et se trouver confrontée au paradoxe, à l\'absurde et au bizarre…', NULL, NULL, 0, '2019-05-09 09:46:34', '2019-05-09 09:46:34'),
(2, 'C\'est l\'histoire de ma truie', 'Chapitre I : mon enfance', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', 'test avec une valeur fidhfivhmqsidbvmknsdmoviqsmdoikvbmlqskbvmolkfbnvlkdbsxnvlknfslkhvnmsldknvmilkzd', NULL, NULL, 0, '2019-05-09 09:46:34', '2019-05-09 09:46:34'),
(3, 'C\'est l\'histoire de ma vie', 'Chapitre II : mon adolescence', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', NULL, NULL, NULL, 10, '2019-05-09 09:46:34', '2019-05-09 09:46:34'),
(4, 'C\'est l\'histoire de ma vie', 'Chapitre III : ma vie adulte', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit voluptatum neque dolorem sit, maxime quos! Blanditiis in tempore error, architecto soluta dolorem, dolore aliquam incidunt eaque ab quia maiores quas! Magni odit veniam blanditiis nihil officiis debitis, mollitia nobis voluptatem praesentium architecto neque consectetur. Obcaecati esse vel aliquam voluptatum ad expedita saepe, sit voluptate necessitatibus architecto. Soluta beatae deserunt harum? Ipsum delectus officia repudiandae tempora unde quod ex, cupiditate aut facere ab animi itaque numquam magni, blanditiis, laudantium recusandae quas commodi voluptatem? Ad quidem dicta beatae earum voluptates deleniti! Possimus. Quo esse excepturi ipsum a laudantium ex incidunt dolorem perspiciatis. Quia quisquam ipsam, dolorum tempore reiciendis corporis dolore nobis facere temporibus, deleniti, eum libero. Tempora explicabo qui quo debitis deserunt? Non sapiente odit voluptatibus repudiandae cumque recusandae, nemo corrupti aut aperiam, necessitatibus quisquam alias laboriosam fuga! Placeat sunt qui officia quae culpa libero eveniet? Molestias ullam nihil voluptates labore odio.', NULL, NULL, 5, '2019-05-09 09:46:34', '2019-05-09 09:46:34'),
(5, 'C\'est l\'histoire de ta vie', 'Chapitre I : ton enfance', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', NULL, NULL, NULL, 0, '2019-05-09 09:46:34', '2019-05-09 09:46:34'),
(6, 'C\'est l\'histoire de ta vie', 'Chapitre II : ton adolescence', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', NULL, NULL, NULL, 0, '2019-05-09 09:46:34', '2019-05-09 09:46:34'),
(7, 'C\'est l\'histoire de ta vie', 'Chapitre III : ta vie adulte', 'https://images.leslibraires.ca/books/9782843048067/front/9782843048067_large.jpg', NULL, NULL, NULL, 0, '2019-05-09 09:46:34', '2019-05-09 09:46:34'),
(8, 'Vingt Mille Lieues sous les Mers', 'Les Voyages Extraordinaires', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Vingtmillelieue00vern_orig_0008_1.jpg/630px-Vingtmillelieue00vern_orig_0008_1.jpg', NULL, NULL, NULL, 0, '2019-05-10 18:05:32', '2019-05-10 18:05:32'),
(9, 'L\'Art de la Guerre', NULL, NULL, NULL, NULL, NULL, 0, '2019-05-10 18:05:32', '2019-05-10 18:05:32');

-- --------------------------------------------------------

--
-- Structure de la table `be_book_contributors`
--

DROP TABLE IF EXISTS `be_book_contributors`;
CREATE TABLE IF NOT EXISTS `be_book_contributors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `book_id` (`book_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `be_book_contributors`
--

INSERT INTO `be_book_contributors` (`id`, `book_id`, `user_id`, `role_id`) VALUES
(1, 1, 1, 2),
(2, 2, 4, 2),
(4, 3, 4, 2),
(5, 5, 5, 2),
(6, 6, 5, 2),
(7, 7, 5, 2),
(8, 4, 4, 2),
(9, 9, 1, 2),
(10, 8, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `be_book_readers`
--

DROP TABLE IF EXISTS `be_book_readers`;
CREATE TABLE IF NOT EXISTS `be_book_readers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `be_book_readers`
--

INSERT INTO `be_book_readers` (`id`, `book_id`, `user_id`, `date`) VALUES
(1, 3, 3, '2019-05-08 12:25:00'),
(2, 2, 3, '2019-05-08 12:24:31'),
(3, 4, 3, '2019-05-08 12:26:31'),
(4, 1, 3, '2019-05-08 12:27:31');

-- --------------------------------------------------------

--
-- Structure de la table `be_reviews`
--

DROP TABLE IF EXISTS `be_reviews`;
CREATE TABLE IF NOT EXISTS `be_reviews` (
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
-- Déchargement des données de la table `be_reviews`
--

INSERT INTO `be_reviews` (`id`, `comment`, `note`, `created_at`, `updated_at`, `author_id`, `book_id`, `user_id`) VALUES
(1, 'Une note test', 4.85, '2019-05-07 09:06:26', '2019-05-07 09:06:26', 3, 4, NULL),
(2, 'Un commentaire test', NULL, '2019-05-07 09:06:26', '2019-05-07 09:06:26', 3, NULL, 4),
(3, 'Une autre note test', 2, '2019-05-07 17:22:02', '2019-05-07 17:22:02', 3, 1, NULL),
(4, 'Un autre commentaire de test', NULL, '2019-05-07 17:22:47', '2019-05-07 17:22:47', 3, 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `be_roles`
--

DROP TABLE IF EXISTS `be_roles`;
CREATE TABLE IF NOT EXISTS `be_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `be_roles`
--

INSERT INTO `be_roles` (`id`, `name`) VALUES
(1, 'Administrateur'),
(2, 'Auteur'),
(3, 'Correcteur orthographique'),
(4, 'Traducteur'),
(5, 'Relecteur');

-- --------------------------------------------------------

--
-- Structure de la table `be_users`
--

DROP TABLE IF EXISTS `be_users`;
CREATE TABLE IF NOT EXISTS `be_users` (
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
-- Déchargement des données de la table `be_users`
--

INSERT INTO `be_users` (`id`, `pseudo`, `login`, `password`, `email`, `image`, `created_at`) VALUES
(1, 'Book Editor Classics', 'be_classics', 'gmonufgh\"ç234', 'book_editor.classics@2alheure.fr', 'https://avatars1.githubusercontent.com/u/33897186?s=460&v=4', '2019-05-06 07:44:26'),
(2, 'Book Editor', 'book_editor', 'qsmihg\'\"223', 'book_editor@2alheure.fr', 'https://avatars1.githubusercontent.com/u/33897186?s=460&v=4', '2019-05-06 07:44:26'),
(3, 'machin', 'truc', 'bidule', 'test@test.fr', NULL, '2019-03-28 19:15:00'),
(4, '2alheure', '2alheure', '2alheure', 'contact@2alheure.fr', 'https://cdn.discordapp.com/avatars/185470129193091072/6551a9208529f2fbbdcb3a522ef46160.png?size=512', '2019-05-06 07:44:26'),
(5, '2dtension', '2dtension', '2dtension', 'contact@2dtension.fr', NULL, '2019-05-06 07:44:26');

-- --------------------------------------------------------

--
-- Structure de la table `be_user_subscribers`
--

DROP TABLE IF EXISTS `be_user_subscribers`;
CREATE TABLE IF NOT EXISTS `be_user_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriber_id` (`subscriber_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `be_user_subscribers`
--

INSERT INTO `be_user_subscribers` (`id`, `user_id`, `subscriber_id`) VALUES
(1, 5, 4),
(2, 3, 4);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `be_book_contributors`
--
ALTER TABLE `be_book_contributors`
  ADD CONSTRAINT `be_book_contributors_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `be_books` (`id`),
  ADD CONSTRAINT `be_book_contributors_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `be_roles` (`id`),
  ADD CONSTRAINT `be_book_contributors_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `be_users` (`id`);

--
-- Contraintes pour la table `be_book_readers`
--
ALTER TABLE `be_book_readers`
  ADD CONSTRAINT `be_book_readers_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `be_books` (`id`),
  ADD CONSTRAINT `be_book_readers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `be_users` (`id`);

--
-- Contraintes pour la table `be_reviews`
--
ALTER TABLE `be_reviews`
  ADD CONSTRAINT `be_reviews_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `be_users` (`id`),
  ADD CONSTRAINT `be_reviews_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `be_books` (`id`),
  ADD CONSTRAINT `be_reviews_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `be_users` (`id`);

--
-- Contraintes pour la table `be_user_subscribers`
--
ALTER TABLE `be_user_subscribers`
  ADD CONSTRAINT `be_user_subscribers_ibfk_1` FOREIGN KEY (`subscriber_id`) REFERENCES `be_users` (`id`),
  ADD CONSTRAINT `be_user_subscribers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `be_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
