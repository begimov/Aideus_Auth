<?php

namespace Aideus\Validation;

use Violin\Violin;
use Aideus\User\User;
use Aideus\Helpers\Hash;

class Validator extends Violin
{
    protected $user;
    protected $hash;
    protected $auth;

    public function __construct(User $user, Hash $hash, $auth = null)
    {
        $this->user = $user;
        $this->hash = $hash;
        $this->auth = $auth;

        $this->addFieldMessages([
            'email' => [
                'uniqueEmail' => 'This e-mail is already taken.'
            ],
            'username' => [
              'uniqueUsername' => 'This username is already taken.'
            ]
        ]);

        $this->addRuleMessages([
            'matchesCurrentPassword' => 'Current password does not match.'
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

    public function validate_matchesCurrentPassword($value, $input, $args)
    {
        if ($this->auth && $this->hash->passwordCheck($value, $this->auth->password)) {
            return true;
        }
        return false;
    }

}
