<?php

use Carbon\Carbon;
use Dflydev\FigCookies\SetCookie;
use Dflydev\FigCookies\FigResponseCookies;

$app->get('/signin', function($req, $res, $args) {

    $messages = $this->flash->getMessages();

    return $this->view->render($res, 'auth/signin.php', [

      'flashError' => $messages['Msg'][0]

    ]);

  })->setName('signin')->add($guestRequired($container));

$app->post('/signin', function($req, $res, $args) {

    $flashSuccess = 'Signed in successfully.';
    $flashFail = 'Invalid email / username or password.';

    $formNames = [
        'identifier',
        'password',
        'rememberme'
    ];

    $data = $req->getParsedBody();

    $identifier = $data[$formNames[0]];
    $password = $data[$formNames[1]];
    $rememberme = $data[$formNames[2]];

    $validator = $this->validator;

    $validator->validate([
        $formNames[0] => [$identifier, 'required'],
        $formNames[1] => [$password, 'required']
    ]);

    if($validator->passes()) {

        $user = $this->user
            ->where(function ($query) use ($identifier) {
                $query
                  ->where('username', '=', $identifier)
                  ->orWhere('email', '=', $identifier);
            })
            ->where('active', true)
            ->first();

        $router = $this->get('router');

        if ($user && $this->hash->passwordCheck($password, $user->password)) {

            $_SESSION[$this['app']['auth']['session']] = $user->id;

            if ($rememberme === 'on') {

                $remembermeId = $this->random->generateString(128);
                $remembermeToken = $this->random->generateString(128);

                $user->updateRememberStatus(
                    $remembermeId,
                    $this->hash->generateHash($remembermeToken)
                );

                $res = FigResponseCookies::set($res,
                    SetCookie::create($this['app']['auth']['remember'])
                        ->withValue("{$remembermeId}___{$remembermeToken}")
                        ->withExpires(Carbon::parse('+4 week')->timestamp));
            }

            $this->flash->addMessage('Msg', $flashSuccess);

            return $res->withStatus(302)->withHeader('Location', $router->pathFor('home'));

        } else {
            $this->flash->addMessage('Msg', $flashFail);
            return $res->withStatus(302)->withHeader('Location', $router->pathFor('signin'));
        }
    }

    return $this->view->render($res, 'auth/signin.php', [
        'errors' => $validator->errors(),
        'requestData' => $data
    ]);

})->setName('signin_post')->add($guestRequired($container));
