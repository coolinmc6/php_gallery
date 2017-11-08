<?php 


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

// HOME
// define('SITE_ROOT', DS . 'Applications' . DS . "XAMPP" . DS . "htdocs" . DS . "php_gallery");

// WORK
define('SITE_ROOT', DS . 'Applications' . DS . "MAMP" . DS . "htdocs" . DS . "php_gallery");

defined('INCLUDES_PATH') ? null : define("INCLUDES_PATH", SITE_ROOT . DS . 'admin' . DS . 'includes');

require_once('functions.php');
require_once('new_config.php');
require_once("database.php");
require_once("db_object.php");
require_once('user.php');
require_once('photo_class.php');
require_once('comment.php');
require_once('session.php');

// Home path: /Applications/XAMPP/htdocs/php_gallery

 ?>