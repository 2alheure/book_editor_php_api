# Simple CodeIgniter API

This is meant to be the simplest API written in CodeIgniter 3.

## Setup
Download the project or clone it. Then change your DB settings in `application/config/database.php`. Then you can change the URL part, in two files, which are `application/config/config.php` (under `base_url`) and the `.htaccess` file at root directory (on line 3).

## Adding stuff
If you want to add API endpoints, don't go to the routing file. Instead, go into `application/models/AjaxMap.php` and, there, add your endpoint, following the example given. Then create the approppriate function into `application/models/Ajax.php` and you're done.

## CORS
In order to handle CORS requests, a `checkCORS` function is provided into `application/controllers/AjaxController.php`. There you can add as many domains as you wish into the `$external_allowed_origins` as you wish.
