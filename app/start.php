<?php

use Slim\App;
use Noodlehaus\Config;
use Aideus\Middleware\PreCheckMiddleware;
use Aideus\Middleware\CsrfMiddleware;

session_cache_limiter(false);
session_start();

date_default_timezone_set('Europe/Moscow');

define('INC_ROOT', dirname(__DIR__));
require INC_ROOT . '/vendor/autoload.php';

define('MODE', 'production'); //TODO mode change

$settings = require INC_ROOT . '/app/config/' . MODE . '.php';

ini_set('display_errors', $settings['settings']['display_errors']);

$app = new App($settings);

$container = $app->getContainer();

require 'database.php';
require 'filters.php';
require 'routes.php';

$app->add(new PreCheckMiddleware($container));
$app->add(new CsrfMiddleware($container));

$services = require 'services.php';

foreach ($services as $key => $value) {
    $container[$key] = $value;
}
