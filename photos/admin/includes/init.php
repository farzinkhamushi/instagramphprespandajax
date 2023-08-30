<?php

defined('DS') ? null : define('DS' , DIRECTORY_SEPARATOR);
define('SITE_ROOT' , 'D:'.DS.'wamp64'.DS.'www'.DS.'photogallery');
require_once("config.php");
require_once("database.php");

require_once("obj.php");

require_once("user.php");
require_once("photo.php");

require_once("functions.php");
require_once("session.php");


?>