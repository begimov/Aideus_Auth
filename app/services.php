<?php

use Slim\Views\Twig;
use Slim\Flash\Messages;

use Aideus\User\User;
use Aideus\Helpers\Hash;
use Aideus\Validation\Validator;
use Aideus\Mailer\Mailer;

return [
    'user' => $container->factory(function($c) {
        return new User;
    }),

    'auth' => false,

    'flash' => function() {
        return new Messages();
    },

    'hash' => function($c) {
        return new Hash($c);
    },

    'validator' => function($c) {
        return new Validator($c->user);
    },

    'view' => function ($c) {
        $view = new Twig(INC_ROOT . '/app/views', [
          //TODO Cache path set up
            'cache' => false
        ]);
        $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
        $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
        return $view;
    },
    
    'mail' => function($c) {
        $mailer = new PHPMailer(true);

        $mailerSettings = $c['app']['mail'];

        $mailer->isSMTP();
        $mailer->Host = $mailerSettings['host'];
        $mailer->SMTPAuth = $mailerSettings['smtp_auth'];
        $mailer->SMTPSecure = $mailerSettings['smtp_secure'];
        $mailer->Port = $mailerSettings['port'];
        $mailer->Username = $mailerSettings['username'];
        $mailer->Password = $mailerSettings['password'];
        $mailer->isHTML($mailerSettings['html']);
        $mailer->setFrom('aideus@aideus.com', 'Aideus');

        return new Mailer($c->view, $mailer);
    }
];
