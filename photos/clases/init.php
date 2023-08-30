<?php

defined('DS') ? null : define('DS' , DIRECTORY_SEPARATOR);
define('SITE_ROOT' , 'D:'.DS.'wamp64'.DS.'www'.DS.'photos');
require_once("clases/config.php");
require_once("clases/database.php");

require_once("clases/obj.php");

require_once("clases/user.php");
require_once("clases/photo.php");

require_once("clases/functions.php");
require_once("clases/session.php");

require_once ("clases/like.php");

?>