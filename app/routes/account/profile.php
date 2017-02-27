<?php

$app->get('/account/profile', function ($req, $res, $args) {
    $messages = $this->flash->getMessages();
    return $this->view->render($res, 'account/profile.php', [
        'flash' => $messages['Msg'][0]
    ]);
})->setName('account_profile')->add($authRequired($container));

$app->get('/account/profile-update', function ($req, $res, $args) {
    return $this->view->render($res, 'account/update.php');
})->setName('update_profile')->add($authRequired($container));

$app->post('/account/profile-update', function ($req, $res, $args) {
    $data = $req->getParsedBody();

    $firstName = $data['first_name'];

    $lastName = $data['last_name'];

    $validator = $this->validator;

    $validator->validate([
        'first_name' => [$firstName, 'alpha|max(50)'],
        'last_name' => [$lastName, 'alpha|max(50)'],
    ]);

    if ($validator->passes()) {
        $user = $this->auth;

        $user->update([
            'first_name' => $firstName,
            'last_name' => $lastName
        ]);

        $this->flash->addMessage('Msg', 'Profile info updated.');
        return $res->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('account_profile'));
    }

    return $this->view->render($res, 'account/update.php', [
        'errors' => $validator->errors()
    ]);
})->setName('update_profile_post')->add($authRequired($container));
