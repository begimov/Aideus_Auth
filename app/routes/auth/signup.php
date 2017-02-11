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

    $validator = $this->validator;

    $validator->validate([
        'email' => [$email, 'required|email'],
        'username' => [$username, 'required|alnumDash|max(20)'],
        'password' => [$password, 'required|min(6)'],
        'password_confirm' => [$passwordConfirm, 'required|matches(password)']
    ]);

    if($validator->passes()) {
        $this->user->create([
          'email' => $email,
          'username' => $username,
          'password' => $this->hash->generatePasswordHash($password)
        ]);

        $this->flash->addMessage('Msg', 'Thank you for signing up.');
        return $res->withStatus(302)->withHeader('Location', '.');
    }

    return $this->view->render($res, 'auth/signup.php', [
        'errors' => $validator->errors(),
        'requestData' => $data
    ]);

})->setName('signup_post');
