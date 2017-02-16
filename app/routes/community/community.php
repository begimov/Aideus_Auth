<?php

$app->get('/community', function($req, $res, $args) {
    $users = $this->user->where('active', true)->get();

    return $this->view->render($res, 'community/community.php', [
        'users' => $users
    ]);

})->setName('community');
