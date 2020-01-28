<?php

namespace Controllers\SalesLoft;

use Controllers\ControllerBase;
use stdClass;

class DashBoardController extends ControllerBase
{
    public function defaultAction()
    {
        $context = new stdClass();
        $context->message = 'SalesLoft Project';
        $context->links = [
            ['text' => 'People', 'href' => '/people']
        ];
        $output = $this->loadView('default', $context);
        return $this->writeBody($output);
    }
}