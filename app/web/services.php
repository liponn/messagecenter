<?php
define("ENVIRONMENT","dev"); // "dev" "testing" "production"
define("SESSION_AUTO_START",false); // session not auto start
define('__WEBROOT__',__DIR__);
define('__FRAMEWORK_PATH__','/var/www/html/wl_framework');
define("__APP_ROOT_PATH__", dirname(__WEBROOT__));

$pathParts = pathinfo(__FILE__);define("__PROJECT_NAME__", strtolower($pathParts['filename']));
require_once __FRAMEWORK_PATH__ . DIRECTORY_SEPARATOR  . "init.php";

