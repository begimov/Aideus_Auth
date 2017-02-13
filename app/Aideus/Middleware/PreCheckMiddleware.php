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
        // $response->getBody()->write('BEFORE');
        $this->run();
        // $request = $request->withAttribute('foo', 'bar');
        // $foo = $request->getAttribute('foo');
        $response = $next($request, $response);
        // $response->getBody()->write('AFTER');
        return $response;
    }

    public function run()
    {
      $sessionName = $_SESSION[$this->container['app']['auth']['session']];

      $containerAuth = $this->container->auth;

        if (isset($sessionName)) {
            $containerAuth = $this->container->user->where('id', $sessionName)->first();

            $this->container->view['auth'] = $containerAuth;
        }
    }
}