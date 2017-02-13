<?php

$app->get('/research', function ($req, $res, $args) {
    return $this->view->render($res, 'research/research.php', [
        // 'flash' => $messages['Msg'][0]
    ]);
})->setName('research');
