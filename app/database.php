<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$getConfig = function ($name) use ($app) {
    return $app->getContainer()->get('app')['db'][$name];
};

$capsule->addConnection([
    'driver' => $getConfig('driver'),
    'host' => $getConfig('host'),
    'database' => $getConfig('name'),
    'username' => $getConfig('username'),
    'password' => $getConfig('password'),
    'charset' => $getConfig('charset'),
    'collation' => $getConfig('collation'),
    'prefix' => $getConfig('prefix'),
]);

$capsule->bootELoquent();
