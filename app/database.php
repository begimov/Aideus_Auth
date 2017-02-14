<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$getConfig = function ($name) use ($container) {
    return $container['app']['db'][$name];
};

$configParams = [
  'driver',
  'host',
  'database',
  'username',
  'password',
  'charset',
  'collation',
  'prefix'
];

foreach ($configParams as $value) {
  $configConnection[$value] = $getConfig($value);
}

$capsule->addConnection($configConnection);

$capsule->bootELoquent();
