<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-05-09 20:22:38 --> 1
ERROR - 2019-05-09 20:22:38 --> ID de l'utilisateur : 
ERROR - 2019-05-09 20:22:38 --> 
ERROR - 2019-05-09 20:22:58 --> Missing mandatory post parameter (login).
ERROR - 2019-05-09 20:22:58 --> Bad parameters for method signin. Got GET [login, password] and POST []
ERROR - 2019-05-09 20:23:18 --> 1
ERROR - 2019-05-09 20:23:18 --> ID de l'utilisateur : 
ERROR - 2019-05-09 20:23:18 --> SELECT `id`
FROM `users`
WHERE `login` = '2alheure'
AND `password` = '2alheure'
ERROR - 2019-05-09 20:23:37 --> 1
ERROR - 2019-05-09 20:23:37 --> ID de l'utilisateur : 
ERROR - 2019-05-09 20:23:37 --> 
ERROR - 2019-05-09 20:23:54 --> 1
ERROR - 2019-05-09 20:23:54 --> ID de l'utilisateur : 
ERROR - 2019-05-09 20:23:54 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo` AS `author`
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`role_id` = 2 AND `book_contributors`.`book_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
ORDER BY RAND()
 LIMIT 10
ERROR - 2019-05-09 20:24:02 --> 1
ERROR - 2019-05-09 20:24:02 --> ID de l'utilisateur : 
ERROR - 2019-05-09 20:24:02 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo` AS `author`
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`role_id` = 2 AND `book_contributors`.`book_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
ORDER BY RAND()
 LIMIT 10
ERROR - 2019-05-09 20:26:53 --> 1
ERROR - 2019-05-09 20:26:53 --> ID de l'utilisateur : 
ERROR - 2019-05-09 20:26:53 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo` AS `author`
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`role_id` = 2 AND `book_contributors`.`book_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
ORDER BY RAND()
 LIMIT 10
ERROR - 2019-05-09 20:28:23 --> 1
ERROR - 2019-05-09 20:28:23 --> ID de l'utilisateur : 
ERROR - 2019-05-09 20:28:23 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo` AS `author`
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`role_id` = 2 AND `book_contributors`.`book_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
ORDER BY RAND()
 LIMIT 10
ERROR - 2019-05-09 20:28:50 --> 1
ERROR - 2019-05-09 20:28:50 --> ID de l'utilisateur : 
ERROR - 2019-05-09 20:28:50 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo` AS `author`
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`role_id` = 2 AND `book_contributors`.`book_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
ORDER BY RAND()
 LIMIT 10
