<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HandlerFactory
{
    static public function create($controller, $action=null)
    {
        $action = $action ?? 'default';
        return function (Request $request, Response $response, $args) use ($controller, $action) {
            return (new $controller($request, $response, $args))->{"{$action}Action"}();
        };
    }
}