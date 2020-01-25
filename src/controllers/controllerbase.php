<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * ControllerBase class used to build out handler actions
 */
abstract class ControllerBase
{
    protected $request;
    protected $response;
    protected $args;

    public function __construct(Request $request, Response $response, $args)
    {
        // var_dump($request);
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    abstract public function defaultAction();
}