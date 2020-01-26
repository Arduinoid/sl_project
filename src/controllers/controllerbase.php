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
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
        session_start();
    }

    abstract public function defaultAction();
}