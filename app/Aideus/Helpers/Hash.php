<?php

namespace Aideus\Helpers;

class Hash
{
    protected $config;

    public  function __construct($config)
    {
        $this->config = $config;
    }

    public function generatePasswordHash($password)
    {
        $hashConfig = $this->config->app['hash'];

        return password_hash(
            $password,
            $hashConfig['algo'],
            ['cost' => $hashConfig['cost']]
        );
    }

    public function passwordCheck($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function generateHash($input)
    {
        return hash('sha256', $input);
    }

    public function hashCheck($hashSys, $userHash)
    {
        return hash_equals($hashSys, $userHash);
    }
}
