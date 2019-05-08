<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-05-08 08:36:16 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo`, `users`.`image` AS `author_image`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT reviews.user_id) nbComments, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-08 08:42:52 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\wamp\www\book_editor_api_php\system\database\drivers\mysqli\mysqli_driver.php 307
ERROR - 2019-05-08 08:42:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo`, `users`.`image` AS `author_image`, COUNT(DISTINCT book_readers.user_id) nbReads, (SELECT COUNT(DISTINCT book_contributors.book_id) FROM book_contributors GROUP BY user_id) nbBooks, COUNT(DISTINCT reviews.user_id) nbComments, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-08 08:43:55 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo`, `users`.`image` AS `author_image`, COUNT(DISTINCT book_readers.user_id) nbReads, (SELECT COUNT(DISTINCT book_contributors.book_id) FROM book_contributors WHERE user_id = author_id GROUP BY user_id) nbBooks, COUNT(DISTINCT reviews.user_id) nbComments, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-08 08:44:21 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo`, `users`.`image` AS `author_image`, COUNT(DISTINCT book_readers.user_id) nbReads, (SELECT COUNT(DISTINCT book_contributors.book_id) FROM book_contributors WHERE user_id = author_id) nbBooks, COUNT(DISTINCT reviews.user_id) nbComments, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-08 08:45:24 --> Query error: Champ 'author_id' inconnu dans where clause - Invalid query: SELECT COUNT(DISTINCT book_contributors.book_id) FROM book_contributors WHERE user_id = author_id
ERROR - 2019-05-08 08:45:53 --> SELECT COUNT(DISTINCT book_contributors.book_id) FROM book_contributors WHERE user_id = 4
ERROR - 2019-05-08 08:46:25 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_result::get() C:\wamp\www\book_editor_api_php\application\models\Ajax.php 98
ERROR - 2019-05-08 08:46:34 --> Severity: error --> Exception: Cannot use object of type stdClass as array C:\wamp\www\book_editor_api_php\application\models\Ajax.php 98
ERROR - 2019-05-08 08:46:43 --> SELECT COUNT(DISTINCT book_contributors.book_id) a FROM book_contributors WHERE user_id = 4
ERROR - 2019-05-08 08:48:11 --> SELECT COUNT(DISTINCT book_contributors.book_id) a FROM book_contributors WHERE user_id = 4
ERROR - 2019-05-08 08:48:27 --> SELECT COUNT(DISTINCT book_contributors.book_id) a FROM book_contributors WHERE user_id = 4
ERROR - 2019-05-08 08:52:05 --> Severity: error --> Exception: syntax error, unexpected ''nbReads'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' C:\wamp\www\book_editor_api_php\application\models\Ajax.php 98
ERROR - 2019-05-08 08:52:13 --> Severity: Notice --> Undefined index: dl C:\wamp\www\book_editor_api_php\application\models\Ajax.php 101
ERROR - 2019-05-08 08:52:13 --> SELECT COUNT(DISTINCT book_contributors.book_id) a FROM book_contributors WHERE user_id = 4
ERROR - 2019-05-08 08:52:32 --> SELECT COUNT(DISTINCT book_contributors.book_id) a FROM book_contributors WHERE user_id = 4
ERROR - 2019-05-08 08:53:53 --> SELECT `users`.`id`, `users`.`pseudo`, `users`.`image`, COUNT(DISTINCT book_contributors.book_id) nbBooks, GROUP_CONCAT(DISTINCT book_contributors.book_id) books
FROM `users`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `users`.`id`
WHERE `users`.`id` = '4'
GROUP BY `book_contributors`.`user_id`
ERROR - 2019-05-08 08:58:17 --> Severity: Notice --> Undefined index: nbReads C:\wamp\www\book_editor_api_php\application\models\Ajax.php 73
ERROR - 2019-05-08 08:58:17 --> Severity: Notice --> Undefined index: nbComments C:\wamp\www\book_editor_api_php\application\models\Ajax.php 74
ERROR - 2019-05-08 08:58:17 --> Severity: Notice --> Undefined index: downloads C:\wamp\www\book_editor_api_php\application\models\Ajax.php 76
ERROR - 2019-05-08 08:58:17 --> SELECT COUNT(DISTINCT book_contributors.book_id) a FROM book_contributors WHERE user_id = 4
ERROR - 2019-05-08 09:00:26 --> Severity: Notice --> Undefined index: nbReads C:\wamp\www\book_editor_api_php\application\models\Ajax.php 73
ERROR - 2019-05-08 09:00:26 --> Severity: Notice --> Undefined index: downloads C:\wamp\www\book_editor_api_php\application\models\Ajax.php 74
ERROR - 2019-05-08 09:00:26 --> Severity: Notice --> Undefined index: nbComments C:\wamp\www\book_editor_api_php\application\models\Ajax.php 75
ERROR - 2019-05-08 09:00:26 --> SELECT COUNT(DISTINCT book_contributors.book_id) a FROM book_contributors WHERE user_id = 4
