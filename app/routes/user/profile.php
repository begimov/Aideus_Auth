<?php

$app->get('/user/{username}', function($req, $res, $args) {

    $user = $this->user
    ->where('username', $args['username'])
    ->first();

    if (!$user) {
      $notFoundHandler = $this->notFoundHandler;
      $notFoundHandler($req, $res);
    }

    return $this->view->render($res, 'user/profile.php', [
      'user' => $user,
      'username' => $args['username']
    ]);
})->setName('user_profile');
