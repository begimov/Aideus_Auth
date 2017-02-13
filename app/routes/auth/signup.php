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
        'email' => [$email, 'required|email|uniqueEmail'],
        'username' => [$username, 'required|alnumDash|max(20)|uniqueUsername'],
        'password' => [$password, 'required|min(6)'],
        'password_confirm' => [$passwordConfirm, 'required|matches(password)']
    ]);

    if($validator->passes()) {
        $user = $this->user->create([
          'email' => $email,
          'username' => $username,
          'password' => $this->hash->generatePasswordHash($password)
        ]);

        $this->mail->send($res, 'mail/auth/signedup.php', ['user' => $user], function($msg) use ($email) {
            $msg->sendTo($email);
            $msg->setSubject('Thank you for signing up');
        });

        $this->flash->addMessage('Msg', 'Thank you for signing up.');
        return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('home'));
    }

    return $this->view->render($res, 'auth/signup.php', [
        'errors' => $validator->errors(),
        'requestData' => $data
    ]);

})->setName('signup_post');
