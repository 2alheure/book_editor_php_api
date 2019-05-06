SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS `book_editor`;
CREATE DATABASE `book_editor` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `book_editor`;

CREATE TABLE `blocs` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bloc_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `bloc_params` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `bloc_param_values` (
  `id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `bloc_param_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `version` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `downloads` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `books` (`id`, `title`, `subtitle`, `version`, `downloads`, `created_at`, `updated_at`) VALUES
(1, 'Alice au Pays des Merveilles', NULL, NULL, 0, NULL, NULL),
(2, 'C\'est l\'histoire de ma vie', 'Chapitre I : mon enfance', NULL, 0, NULL, NULL),
(3, 'C\'est l\'histoire de ma vie', 'Chapitre II : mon adolescence', NULL, 0, NULL, NULL),
(4, 'C\'est l\'histoire de ma vie', 'Chapitre III : ma vie adulte', NULL, 0, NULL, NULL),
(5, 'C\'est l\'histoire de ta vie', 'Chapitre I : ton enfance', NULL, 0, NULL, NULL),
(6, 'C\'est l\'histoire de ta vie', 'Chapitre II : ton adolescence', NULL, 0, NULL, NULL),
(7, 'C\'est l\'histoire de ta vie', 'Chapitre III : ta vie adulte', NULL, 0, NULL, NULL);

CREATE TABLE `book_blocs` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `bloc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `book_contributors` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `book_contributors` (`id`, `book_id`, `user_id`, `role_id`) VALUES
(1, 1, 1, 2),
(2, 2, 4, 2),
(3, 2, 4, 2),
(4, 3, 4, 2),
(5, 5, 5, 2),
(6, 6, 5, 2),
(7, 7, 5, 2);

CREATE TABLE `book_readers` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `note` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrateur'),
(2, 'Auteur'),
(3, 'Correcteur orthographique'),
(4, 'Traducteur'),
(5, 'Relecteur');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) COLLATE utf8_bin NOT NULL,
  `login` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` text COLLATE utf8_bin,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`id`, `pseudo`, `login`, `password`, `email`, `image`, `created_at`) VALUES
(1, 'Book Editor Classics', 'be_classics', 'gmonufgh\"ç234', 'book_editor.classics@2alheure.fr', NULL, '2019-05-06 07:44:26'),
(2, 'Book Editor', 'book_editor', 'qsmihg\'\"223', 'book_editor@2alheure.fr', NULL, '2019-05-06 07:44:26'),
(3, 'machin', 'truc', 'bidule', 'test@test.fr', NULL, '2019-03-28 19:15:00'),
(4, '2alheure', '2alheure', '2alheure', 'contact@2alheure.fr', 'https://cdn.discordapp.com/avatars/185470129193091072/6551a9208529f2fbbdcb3a522ef46160.png?size=512', '2019-05-06 07:44:26'),
(5, '2dtension', '2dtension', '2dtension', 'contact@2dtension.fr', NULL, '2019-05-06 07:44:26');

CREATE TABLE `user_subscribers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


ALTER TABLE `blocs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bloc_params`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bloc_param_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bloc_param_id` (`bloc_param_id`);

ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `book_blocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bloc_id` (`bloc_id`),
  ADD KEY `book_id` (`book_id`);

ALTER TABLE `book_contributors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `book_readers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriber_id` (`subscriber_id`),
  ADD KEY `user_id` (`user_id`);


ALTER TABLE `blocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bloc_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bloc_param_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `book_blocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `book_contributors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `book_readers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `bloc_param_values`
  ADD CONSTRAINT `bloc_param_values_ibfk_1` FOREIGN KEY (`bloc_param_id`) REFERENCES `bloc_params` (`id`);

ALTER TABLE `book_blocs`
  ADD CONSTRAINT `book_blocs_ibfk_1` FOREIGN KEY (`bloc_id`) REFERENCES `blocs` (`id`),
  ADD CONSTRAINT `book_blocs_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

ALTER TABLE `book_contributors`
  ADD CONSTRAINT `book_contributors_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `book_contributors_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `book_contributors_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `book_readers`
  ADD CONSTRAINT `book_readers_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `book_readers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `user_subscribers`
  ADD CONSTRAINT `user_subscribers_ibfk_1` FOREIGN KEY (`subscriber_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_subscribers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
