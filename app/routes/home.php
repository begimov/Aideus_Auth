<?php

$app->get('/', function ($req, $res, $args) {
    $messages = $this->flash->getMessages();
    return $this->view->render($res, 'home.php', [
        'flash' => $messages['Msg'][0]
    ]);
})->setName('home');
