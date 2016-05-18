<?php
define("ENVIRONMENT","dev"); // "dev" "testing" "production"
define("RUN_MODE","cli"); // 访问模式仅限cli模式
define('__WEBROOT__',__DIR__);
define('__FRAMEWORK_PATH__','/var/www/html/wl_framework');
define("__APP_ROOT_PATH__", dirname(__WEBROOT__));

$pathParts = pathinfo(__FILE__);define("__PROJECT_NAME__", strtolower($pathParts['filename']));
require_once __FRAMEWORK_PATH__ . DIRECTORY_SEPARATOR  . "init.php";

