<?php

namespace Aideus\Middleware;

use Dflydev\FigCookies\FigRequestCookies;

class PreCheckMiddleware
{

    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $next)
    {
        $this->run($request);

        $response = $next($request, $response);

        return $response;
    }

    public function run($request)
    {
      $sessionName = $_SESSION[$this->container['app']['auth']['session']];

        if (isset($sessionName)) {
            $this->container->auth = $this->container->user->where('id', $sessionName)->first();
        }

        $this->checkRememberMe($request);

        $this->container->view['auth'] = $this->container->auth;
        $this->container->view['baseUrl'] = $this->container['app']['url'];
    }

    private function checkRememberMe($request)
    {
      $cookie = FigRequestCookies::get($request, $this->container['app']['auth']['remember'])->getValue();

      //TODO refactor, optimize remove nesting ifs

        if ($cookie && !$this->container->auth) {
            $cookieParams = explode('___', $cookie);

            if (empty(trim($cookie)) || count($cookieParams) !== 2) {
              //TODO if rememberme cookie is empty or not consistent than redirect?
                return;
            } else {
                $id = $cookieParams[0];
                $token = $this->container->hash->generateHash($cookieParams[1]);

                $user = $this->container->user
                    ->where('remember_identifier', $id)
                    ->first();

                if ($user) {
                    if ($this->container->hash->hashCheck($user->remember_token, $token)) {
                        $_SESSION[$this->container['app']['auth']['session']] = $user->id;
                        $this->container->auth = $this->container->user->where('id', $user->id)->first();
                    } else {
                        $user->removeRememberStatus();
                    }
                }
            }
        }
    }
}
