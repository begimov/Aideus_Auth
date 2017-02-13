<?php

namespace Aideus\Validation;

use Violin\Violin;
use Aideus\User\User;

class Validator extends Violin
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->addFieldMessages([
            'email' => [
                'uniqueEmail' => 'This e-mail is already taken.'
            ],
            'username' => [
              'uniqueUsername' => 'This username is already taken.'
            ]
        ]);
    }

    public function validate_uniqueEmail($value, $input, $args)
    {
        $user = $this->user->where('email', $value);

        return ! (bool) $user->count();
    }

    public function validate_uniqueUsername($value, $input, $args)
    {
        $user = $this->user->where('username', $value);

        return ! (bool) $user->count();
    }
}
