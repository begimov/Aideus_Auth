<?php

$app->get('/activate', function($req, $res, $args) {

    $queryParams = $req->getQueryParams();

    $email = $queryParams['email'];

    $identifier = $queryParams['identifier'];

    $hashedId = $this->hash->generateHash($identifier);

    $user = $this->user
        ->where('email', $email)
        ->where('active', false)
        ->first();

    if (!$user || !$this->hash->hashCheck($user->active_hash, $hashedId)) {
        $this->flash->addMessage('Msg', 'Account activation has failed.');
        return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('signup'));
    } else {
        $user->activateAccount();
        $this->flash->addMessage('Msg', 'Your account has been activated.');
        return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('home'));
    }

})->setName('activate');
