<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-05-07 08:48:50 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Base 'test' inconnue C:\wamp\www\book_editor_api_php\system\database\drivers\mysqli\mysqli_driver.php 203
ERROR - 2019-05-07 08:48:50 --> Unable to connect to the database
ERROR - 2019-05-07 08:58:12 --> Unable to get data with user.
ERROR - 2019-05-07 08:58:21 --> Unable to get data with user.
ERROR - 2019-05-07 08:59:06 --> Unable to get data with user.
ERROR - 2019-05-07 08:59:28 --> Unable to get data with user.
ERROR - 2019-05-07 09:00:15 --> Unable to get data with user.
ERROR - 2019-05-07 09:00:29 --> Unable to get data with user.
ERROR - 2019-05-07 09:00:29 --> SELECT `users`.`id`, `users`.`pseudo`, `users`.`image`, GROUP_CONCAT(book_contributors.book_id) Books
FROM `users`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `users`.`id`
WHERE `users`.`id` IS NULL
GROUP BY `book_contributors`.`user_id`
ERROR - 2019-05-07 09:01:51 --> Unable to get data with user.
ERROR - 2019-05-07 09:01:51 --> SELECT `users`.`id`, `users`.`pseudo`, `users`.`image`, GROUP_CONCAT(book_contributors.book_id) Books
FROM `users`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `users`.`id`
WHERE `users`.`id` IS NULL
GROUP BY `book_contributors`.`user_id`
ERROR - 2019-05-07 09:02:02 --> SELECT `users`.`id`, `users`.`pseudo`, `users`.`image`, GROUP_CONCAT(book_contributors.book_id) Books
FROM `users`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `users`.`id`
WHERE `users`.`id` = '3'
GROUP BY `book_contributors`.`user_id`
ERROR - 2019-05-07 09:02:18 --> SELECT `users`.`id`, `users`.`pseudo`, `users`.`image`, GROUP_CONCAT(book_contributors.book_id) Books
FROM `users`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `users`.`id`
WHERE `users`.`id` = '4'
GROUP BY `book_contributors`.`user_id`
ERROR - 2019-05-07 09:04:02 --> SELECT `users`.`id`, `users`.`pseudo`, `users`.`image`, GROUP_CONCAT(DISTINCT book_contributors.book_id) Books
FROM `users`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `users`.`id`
WHERE `users`.`id` = '4'
GROUP BY `book_contributors`.`user_id`
ERROR - 2019-05-07 09:05:11 --> SELECT `users`.`id`, `users`.`pseudo`, `users`.`image`, COUNT(DISTINCT book_contributors.book_id) nbBooks, GROUP_CONCAT(DISTINCT book_contributors.book_id) books
FROM `users`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `users`.`id`
WHERE `users`.`id` = '4'
GROUP BY `book_contributors`.`user_id`
ERROR - 2019-05-07 16:57:58 --> SELECT `users`.`id`, `users`.`pseudo`, `users`.`image`, COUNT(DISTINCT book_contributors.book_id) nbBooks, GROUP_CONCAT(DISTINCT book_contributors.book_id) books
FROM `users`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `users`.`id`
WHERE `users`.`id` = '3'
GROUP BY `book_contributors`.`user_id`
ERROR - 2019-05-07 16:58:13 --> SELECT `users`.`id`, `users`.`pseudo`, `users`.`image`, COUNT(DISTINCT book_contributors.book_id) nbBooks, GROUP_CONCAT(DISTINCT book_contributors.book_id) books
FROM `users`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `users`.`id`
WHERE `users`.`id` = '4'
GROUP BY `book_contributors`.`user_id`
ERROR - 2019-05-07 17:17:02 --> Query error: La table 'book_editor.book_reads' n'existe pas - Invalid query: SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, COUNT(DISTINCT book_reads.user_id) nbReads, GROUP_CONCAT(DISTINCT book_contributors.book_id) books
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_reads` ON `book_reads`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_reads`.`user_id`
ERROR - 2019-05-07 17:17:27 --> Query error: Champ 'users.id' inconnu dans on clause - Invalid query: SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, COUNT(DISTINCT book_readers.user_id) nbReads, GROUP_CONCAT(DISTINCT book_contributors.book_id) books
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:17:56 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, COUNT(DISTINCT book_readers.user_id) nbReads, GROUP_CONCAT(DISTINCT book_contributors.book_id) books
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:18:06 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT book_contributors.book_id) books
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:19:43 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT rev.user_id) note, COUNT(DISTINCT revi.user_id) nbComment
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `reviews` `rev` ON `rev`.`book_id` = `books`.`id`
LEFT JOIN `reviews` `revi` ON `revi`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:20:43 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT reviews.user_id) nbComment, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:23:02 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT reviews.user_id) nbComment, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:23:18 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT reviews.user_id) nbComment, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:24:53 --> Query error: Champ 'user.pseudo' inconnu dans field list - Invalid query: SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `users`.`id`, `user`.`pseudo`, `user`.`image`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT reviews.user_id) nbComment, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:25:01 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `users`.`id`, `users`.`pseudo`, `users`.`image`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT reviews.user_id) nbComment, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:25:19 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `users`.`id` AS `author_id`, `users`.`pseudo`, `users`.`image`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT reviews.user_id) nbComment, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:28:52 --> Query error: Champ 'books.image' inconnu dans field list - Invalid query: SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo`, `users`.`image` AS `author_image`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT reviews.user_id) nbComments, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:29:42 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo`, `users`.`image` AS `author_image`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT reviews.user_id) nbComments, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
ERROR - 2019-05-07 17:30:51 --> SELECT `books`.`id`, `books`.`title`, `books`.`subtitle`, `books`.`image`, `users`.`id` AS `author_id`, `users`.`pseudo`, `users`.`image` AS `author_image`, COUNT(DISTINCT book_readers.user_id) nbReads, COUNT(DISTINCT reviews.user_id) nbComments, AVG(DISTINCT reviews.note) note
FROM `books`
LEFT JOIN `book_contributors` ON `book_contributors`.`user_id` = `books`.`id`
LEFT JOIN `users` ON `book_contributors`.`user_id` = `users`.`id`
LEFT JOIN `reviews` ON `reviews`.`book_id` = `books`.`id`
LEFT JOIN `book_readers` ON `book_readers`.`book_id` = `books`.`id`
WHERE `books`.`id` = '4'
GROUP BY `book_readers`.`user_id`
