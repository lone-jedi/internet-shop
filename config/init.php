<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/vendor/ishop/core');
define("LIBS", ROOT . '/vendor/ishop/core/libs');
define("CACHE", ROOT . '/tmp/cache');
define("CONF", ROOT . '/config');
define("LAYOUT", 'watches');

// TODO HW HTTPS *
// http://localhost/phpbasic/ishop/public/index.php
$app_path = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";

// http://localhost/phpbasic/ishop/public/
$app_path = preg_replace("#[^/]+$#", '', $app_path);

// http://localhost/phpbasic/ishop
$app_path = str_replace('/public/', '', $app_path);

define("PATH", $app_path);
define("ADMIN", PATH . '/admin');

require_once ROOT . '/vendor/autoload.php';
