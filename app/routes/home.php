<?php

$app->get('/flash', function ($req, $res, $args) {
    $this->flash->addMessage('Msg', 'This is a message');
    return $res->withStatus(302)->withHeader('Location', '/public/gb');
});

$app->get('/{name}', function ($req, $res, $args) {
    $messages = $this->flash->getMessages();
    return $this->view->render($res, 'home.php', [
        'name' => $args['name'],
        'flash' => $messages['Msg'][0]
    ]);
})->setName('profile'); //TODO route's name for path_for() method
