<?php

$app->get('/signin', function($req, $res, $args) {
  $messages = $this->flash->getMessages();
  return $this->view->render($res, 'auth/signin.php', [
    'flashError' => $messages['Msg'][0]
  ]);
})->setName('signin');

$app->post('/signin', function($req, $res, $args) {

    $flashSuccess = 'Signed in successfully.';
    $flashFail = 'Invalid email / username or password.';

    $formNames = [
        'identifier',
        'password'
    ];

    $data = $req->getParsedBody();

    $identifier = $data[$formNames[0]];
    $password = $data[$formNames[1]];

    $validator = $this->validator;

    $validator->validate([
        $formNames[0] => [$identifier, 'required'],
        $formNames[1] => [$password, 'required']
    ]);

    if($validator->passes()) {

        $user = $this->user
            ->where('username', $identifier)
            ->orWhere('email',$identifier)
            ->first();

        $router = $this->get('router');

        if ($user && $this->hash->passwordCheck($password, $user->password)) {

            $_SESSION[$this['app']['auth']['session']] = $user->id;

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

})->setName('signin_post');
