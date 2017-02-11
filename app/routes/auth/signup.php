<?php

$app->get('/signup', function($req, $res, $args) {
    return $this->view->render($res, 'auth/signup.php');
})->setName('signup');

$app->post('/signup', function($req, $res) {
    $data = $req->getParsedBody();
    $email = $data['email'];
    $username = $data['username'];
    $password = $data['password'];
    $passwordConfirm = $data['password_confirm'];

    $this->user->create([
      'email' => $email,
      'username' => $username,
      'password' => $this->hash->generatePasswordHash($password)
    ]);

    $this->flash->addMessage('Msg', 'Thank you for signing up.');
    return $res->withStatus(302)->withHeader('Location', '.');
})->setName('signup_post');
