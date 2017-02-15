<?php

namespace Aideus\Middleware;

use Exception;

class CsrfMiddleware
{

    private $csrfKey;

    private $container;

    public function __construct($container) {
        $this->container = $container;
        $this->csrfKey = $this->container['app']['csrf']['key'];
    }

    public function __invoke($request, $response, $next)
    {

        $this->check($request);

        $response = $next($request, $response);
        // after
        return $response;
    }

    public function check($request)
    {
        $method = $request->getMethod();

        if (!isset($_SESSION[$this->csrfKey])) {
            $_SESSION[$this->csrfKey] = $this->container->hash->generateHash(
                $this->container->random->generateString(128)
            );
        }
        $token = $_SESSION[$this->csrfKey];

        if (in_array($method, ['POST', 'PUT', 'DELETE'])) {
            $submToken = $request->getParsedBody()[$this->csrfKey] ?: '';

            if (!$this->container->hash->hashCheck($token, $submToken)) {
                throw new Exception('CSRF Error');
            }
        }

        $this->container->view['csrf_key'] = $this->csrfKey;
        $this->container->view['csrf_token'] = $token;

    }
}
