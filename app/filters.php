<?php

$authCheck = function($authReq, $c) {
    return function ($req, $res, $next) use ($authReq, $c) {
        if ((!$c->auth && $authReq) || ($c->auth && !$authReq)) {
            return $res->withStatus(302)->withHeader('Location', $c->get('router')->pathFor('home'));
        }
        $res = $next($req, $res);
        return $res;
      };
};

$authRequired = function($c) use ($authCheck) {
    return $authCheck(true, $c);
};

$guestRequired = function($c) use ($authCheck) {
    return $authCheck(false, $c);
};
