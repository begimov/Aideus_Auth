<?php

$app->get('/signup', function($req, $res, $args) {
    $messages = $this->flash->getMessages();
    return $this->view->render($res, 'auth/signup.php', [
        'flashError' => $messages['Msg'][0]
    ]);
})->setName('signup');

$app->post('/signup', function($req, $res) {

    $templatePath = 'mail/auth/signedup.php';

    $emailSubject = 'Thank you for signing up';

    $formNames = [
        'email',
        'username',
        'password',
        'password_confirm',
        'active',
        'active_hash'
    ];

    $data = $req->getParsedBody();

    $email = $data[$formNames[0]];
    $username = $data[$formNames[1]];
    $password = $data[$formNames[2]];
    $passwordConfirm = $data[$formNames[3]];

    $validator = $this->validator;

    $validator->validate([
        $formNames[0] => [$email, 'required|email|uniqueEmail'],
        $formNames[1] => [$username, 'required|alnumDash|max(20)|uniqueUsername'],
        $formNames[2] => [$password, 'required|min(6)'],
        $formNames[3] => [$passwordConfirm, 'required|matches(password)']
    ]);

    if($validator->passes()) {

        $identifier = $this->random->generateString(128);

        $user = $this->user->create([
          $formNames[0] => $email,
          $formNames[1] => $username,
          $formNames[2] => $this->hash->generatePasswordHash($password),
          $formNames[4] => false,
          $formNames[5] => $this->hash->generateHash($identifier)
        ]);

        $this->mail->send($res, $templatePath, ['user' => $user, 'identifier' => $identifier], function($msg) use ($email, $emailSubject) {
            $msg->sendTo($email);
            $msg->setSubject($emailSubject);
        });

        $this->flash->addMessage('Msg', $emailSubject);
        return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('home'));
    }

    return $this->view->render($res, 'auth/signup.php', [
        'errors' => $validator->errors(),
        'requestData' => $data
    ]);

})->setName('signup_post');
