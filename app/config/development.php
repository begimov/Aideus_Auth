<?php

return [
  'settings' => [
        'displayErrorDetails' => true,
    ],
  'app' => [
    'url' => 'http://localhost:8000',
    'hash' => [
      'algo' => PASSWORD_BCRYPT,
      'cost' => 10
    ],
    'db' => [
      'driver' => 'mysql',
      'host' => '127.0.0.1',
      'name' => 'aideuscom',
      'username' => 'aideus',
      'password' => 'xyzAxyz',
      'charset' => 'utf8',
      'collation' => 'utf8_general_ci',
      'prefix' => ''
    ],
    'auth' => [
      'session' => 'user_id',
      'remember' => 'user_r'
    ],
    'mail' => [
      'smtp_auth' => true,
      'smtp_secure' => 'tls',
      'host' => 'smtp.gmail.com',
      'username' => 'aideus@aideus.com',
      'password' => 'xyzAxyz0101',
      'port' => 587,
      'html' => true
    ],
    'twig' => [
      'debug' => true
    ],
    'csrf' => [
      'session' => 'csrf_token'
    ]
  ]
];
