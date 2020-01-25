<?php

namespace Controllers;

class ThingsController extends ControllerBase
{
    public function defaultAction()
    {
        $this->response
             ->getBody()
             ->write('Hello from my new controller!');
        return $this->response;
    }
}