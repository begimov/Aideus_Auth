<?php

use Slim\App;
use Noodlehaus\Config;

use Aideus\Middleware\PreCheckMiddleware;

session_cache_limiter(false);
session_start();

ini_set('display_errors', 'On');

date_default_timezone_set('Europe/Moscow');

define('INC_ROOT', dirname(__DIR__));

define('MODE', 'development');

require INC_ROOT . '/vendor/autoload.php';

$settings = require INC_ROOT . '/app/config/' . MODE . '.php';

$app = new App($settings);

require 'database.php';
require 'routes.php';

$container = $app->getContainer();

$app->add(new PreCheckMiddleware($container));

$services = require 'services.php';

foreach ($services as $key => $value) {
    $container[$key] = $value;
}
