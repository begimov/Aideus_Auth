<?php

use Slim\App;
use Slim\Views\Twig;
use Slim\Flash\Messages;
use Noodlehaus\Config;
use Aideus\User\User;

session_cache_limiter(false);
session_start();

ini_set('display_errors', 'On');

define('INC_ROOT', dirname(__DIR__));
define('MODE', 'development');

require INC_ROOT . '/vendor/autoload.php';
$settings = require INC_ROOT . '/app/config/' . MODE . '.php';

// var_dump($settings);
// echo '<br/><br/>';

$app = new App($settings);

require 'database.php';
require 'routes.php';

$container = $app->getContainer();

$container['user'] = function($container) {
    return new User;
};

$container['flash'] = function() {
  return new Messages();
};

$container['view'] = function ($c) {
    $view = new Twig(INC_ROOT . '/app/views', [
      //TODO Cache path set up
        'cache' => false
    ]);
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
    return $view;
};

// var_dump($container);
