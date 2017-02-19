<?php

$app->get('/recover', function($req, $res, $args) {

    $messages = $this->flash->getMessages();

    return $this->view->render($res, 'auth/recover.php', [
        'flashError' => $messages['Msg'][0]
    ]);

  })->setName('pass_recover')->add($guestRequired($container));


$app->post('/recover', function($req, $res, $args) {

    $data = $req->getParsedBody();
    $email = $data['email'];

    $validator = $this->validator;

    $validator->validate([
        'email' => [$email, 'required|email']
    ]);

    $router = $this->get('router');

    if($validator->passes()) {

      $user = $this->user
          ->where('email', $email)
          ->first();

        if ($user) {

            $recoverId = $this->random->generateString(128);

            $user->update([
                'recover_hash' => $this->hash->generateHash($recoverId)
            ]);

            $this->mail->send($res, 'mail/auth/recover.php', ['user' => $user, 'recoverId' => $recoverId], function($msg) use ($user) {
                $msg->sendTo($user->email);
                $msg->setSubject('Reset your Aideus password');
            });

            $this->flash->addMessage('Msg', "An e-mail has been sent to {$email} with further instructions.");
            return $res->withStatus(302)->withHeader('Location', $router->pathFor('home'));
        } else {
            $this->flash->addMessage('Msg', 'No account with that email address exists.');
            return $res->withStatus(302)->withHeader('Location', $router->pathFor('pass_recover'));
        }
    }

    return $this->view->render($res, 'auth/recover.php', [
        'errors' => $validator->errors(),
        'requestData' => $data
    ]);

  })->setName('pass_recover_post')->add($guestRequired($container));

  //password reset

$app->get('/recover-reset', function($req, $res, $args) {

    $queryParams = $req->getQueryParams();

    $email = $queryParams['email'];

    $recoverId = $queryParams['recoverId'];

    $hashedId = $this->hash->generateHash($recoverId);

    $user = $this->user
        ->where('email', $email)
        ->first();

    if (!$user || !$user->recover_hash || !$this->hash->hashCheck($user->recover_hash, $hashedId)) {
        $this->flash->addMessage('Msg', 'Reseting password has failed.');
        return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('pass_recover'));
    } else {
        return $this->view->render($res, 'auth/reset.php', [
            'email' => $user->email,
            'recoverId' => $recoverId
        ]);
    }

})->setName('pass_reset')->add($guestRequired($container));


$app->post('/recover-reset', function($req, $res, $args) {

    $queryParams = $req->getQueryParams();

    $email = $queryParams['email'];
    $recoverId = $queryParams['recoverId'];
    $hashedId = $this->hash->generateHash($recoverId);

    $user = $this->user
        ->where('email', $email)
        ->first();

    if (!$user || !$user->recover_hash || !$this->hash->hashCheck($user->recover_hash, $hashedId)) {
        $this->flash->addMessage('Msg', 'Reseting password has failed.');
        return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('pass_recover'));
    }

    $data = $req->getParsedBody();

    $newPassword = $data['new_password'];
    $passwordConfirm = $data['password_confirm'];

    $validator = $this->validator;

    $validator->validate([
        'new_password' => [$newPassword, 'required|min(6)'],
        'password_confirm' => [$passwordConfirm, 'required|matches(new_password)']
    ]);

    if($validator->passes()) {
        $user->update([
            'password' => $this->hash->generatePasswordHash($newPassword),
            'recover_hash' => null
        ]);
        $this->flash->addMessage('Msg', 'Password has been reset successfully.');
        return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('home'));
    }

    return $this->view->render($res, 'auth/reset.php', [
        'errors' => $validator->errors(),
        'email' => $email,
        'recoverId' => $recoverId
    ]);

  })->setName('pass_reset_post')->add($guestRequired($container));
