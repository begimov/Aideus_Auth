<?php

use Slim\App;
use Slim\Views\Twig;
use Slim\Flash\Messages;

use Noodlehaus\Config;

use Aideus\User\User;
use Aideus\Helpers\Hash;
use Aideus\Validation\Validator;
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

$container['auth'] = false;

$container['user'] = $container->factory(function($c) {
    return new User;
});

$container['flash'] = function() {
  return new Messages();
};

$container['hash'] = function($c) {
  return new Hash($c);
};

$container['validator'] = function($c) {
  return new Validator($c->user);
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
