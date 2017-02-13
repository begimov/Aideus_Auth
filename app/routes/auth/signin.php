<?php

$app->get('/signin', function($req, $res, $args) {
  $messages = $this->flash->getMessages();
  return $this->view->render($res, 'auth/signin.php', [
    'flashError' => $messages['Msg'][0]
  ]);
})->setName('signin');

$app->post('/signin', function($req, $res, $args) {
    $data = $req->getParsedBody();
    $identifier = $data['identifier'];
    $password = $data['password'];

    $validator = $this->validator;

    $validator->validate([
        'identifier' => [$identifier, 'required'],
        'password' => [$password, 'required']
    ]);

    if($validator->passes()) {
        $user = $this->user
            ->where('username', $identifier)
            ->orWhere('email',$identifier)
            ->first();

        if ($user && $this->hash->passwordCheck($password, $user->password)) {

            $_SESSION[$this->get('app')['auth']['session']] = $user->id;

            $this->flash->addMessage('Msg', 'Signed in successfully.');
            return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('home'));
        } else {
            $this->flash->addMessage('Msg', 'Invalid email / username or password.');
            return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('signin'));
        }
    }

    return $this->view->render($res, 'auth/signin.php', [
        'errors' => $validator->errors(),
        'requestData' => $data
    ]);

})->setName('signin_post');
