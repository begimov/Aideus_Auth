<?php

$app->get('/settings', function($req, $res, $args) {
    return $this->view->render($res, 'auth/settings/settings.php');
  })->setName('settings')->add($authRequired($container));

  $app->post('/settings', function($req, $res, $args) {

    $emailSubject = 'Your password has been changed successfully.';

    $templatePath = 'mail/auth/settings/passwordchanged.php';

    $formNames = [
        'current_password',
        'new_password',
        'password_confirm'
    ];

    $data = $req->getParsedBody();

    $currentPassword = $data[$formNames[0]];
    $newPassword = $data[$formNames[1]];
    $passwordConfirm = $data[$formNames[2]];

    $validator = $this->validator;

    $validator->validate([
        $formNames[0] => [$currentPassword, 'required|matchesCurrentPassword'],
        $formNames[1] => [$newPassword, 'required|min(6)'],
        $formNames[2] => [$passwordConfirm, 'required|matches(new_password)']
    ]);

    if($validator->passes()) {

        $user = $this->auth;

        $user->update([
            'password' => $this->hash->generatePasswordHash($newPassword)
        ]);

        $this->mail->send($res, $templatePath, [], function($msg) use ($user) {
            $msg->sendTo($user->email);
            $msg->setSubject('Password has been changed');
        });

        $this->flash->addMessage('Msg', $emailSubject);
        return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('home'));
    }

    return $this->view->render($res, 'auth/settings/settings.php', [
        'errors' => $validator->errors()
    ]);

  })->setName('settings_post')->add($authRequired($container));
