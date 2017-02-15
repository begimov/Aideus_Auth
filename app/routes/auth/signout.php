<?php

use Dflydev\FigCookies\FigRequestCookies;
use Dflydev\FigCookies\FigResponseCookies;

$app->get('/signout', function($req, $res, $args) {

    $flashSuccess = 'Signed out successfully.';

    unset($_SESSION[$this['app']['auth']['session']]);

    $cookie = FigRequestCookies::get($req, $this['app']['auth']['remember'])->getValue();

    if ($cookie) {
        $this->auth->removeRememberStatus();
        $res = FigResponseCookies::expire($res, $this['app']['auth']['remember']);
    }

    $this->flash->addMessage('Msg', $flashSuccess);

    return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('home'));

})->setName('signout')->add($authRequired($container));
