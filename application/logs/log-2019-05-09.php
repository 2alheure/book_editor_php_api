<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-05-09 08:39:57 --> Severity: error --> Exception: Too few arguments to function CI_DB_query_builder::where(), 0 passed in C:\wamp\www\book_editor_php_api\application\models\Ajax.php on line 128 and at least 1 expected C:\wamp\www\book_editor_php_api\system\database\DB_query_builder.php 621
ERROR - 2019-05-09 08:40:04 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo` AS `author`, `book_contributors`.`role_id` AS `role`
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`book_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
ERROR - 2019-05-09 08:41:35 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo` AS `author`, `book_contributors`.`role_id` AS `role`
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`book_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
ERROR - 2019-05-09 08:47:52 --> Query error: Erreur de syntaxe près de '.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `au' à la ligne 1 - Invalid query: SELECT `DISTINCT` `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo` AS `author`, `book_contributors`.`role_id` AS `role`
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`book_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
ORDER BY `book_contributors`.`role_id` ASC, `books`.`created_at` DESC
ERROR - 2019-05-09 08:48:58 --> SELECT DISTINCT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo` AS `author`, `book_contributors`.`role_id` AS `role`
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`book_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
ORDER BY `book_contributors`.`role_id` ASC, `books`.`created_at` DESC
ERROR - 2019-05-09 08:49:35 --> SELECT DISTINCT `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo` AS `author`, `book_contributors`.`role_id` AS `role`
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`book_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
ORDER BY `book_contributors`.`role_id` ASC, `books`.`created_at` DESC
ERROR - 2019-05-09 08:49:55 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo` AS `author`, `book_contributors`.`role_id` AS `role`
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`book_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
ORDER BY `book_contributors`.`role_id` ASC, `books`.`created_at` DESC
