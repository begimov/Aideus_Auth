<?php

use Slim\App;
use Noodlehaus\Config;

session_cache_limiter(false);
session_start();

ini_set('display_errors', 'On');

define('INC_ROOT', dirname(__DIR__));
define('MODE', 'development');

require INC_ROOT . '/vendor/autoload.php';
$settings = require INC_ROOT . '/app/config/' . MODE . '.php';

$app = new App($settings);

print_r($app->getContainer()->get('app')['db']['driver']);
