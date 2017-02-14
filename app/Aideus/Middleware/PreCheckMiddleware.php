<?php

namespace Aideus\Middleware;

class PreCheckMiddleware
{

    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $next)
    {
        $this->run();

        $response = $next($request, $response);

        return $response;
    }

    public function run()
    {
      $sessionName = $_SESSION[$this->container['app']['auth']['session']];

        if (isset($sessionName)) {
            $this->container->auth = $this->container->user->where('id', $sessionName)->first();
        }

        $this->container->view['auth'] = $this->container->auth;
        $this->container->view['baseUrl'] = $this->container['app']['url'];
    }
}
