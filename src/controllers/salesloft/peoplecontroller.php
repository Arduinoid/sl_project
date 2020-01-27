<?php

namespace Controllers\SalesLoft;

use Controllers\ControllerBase;
use Models\SalesLoft\People;
use stdClass;

class PeopleController extends ControllerBase
{
    public function defaultAction()
    {
        $context = new stdClass();
        $people = $this->getPeopleModel();
        $context->people = $people->getAll();
        $output = $this->loadView('people', $context);
        return $this->writeBody($output);
    }

    public function frequencyAction()
    {
        $people = $this->getPeopleModel();
        $output = json_encode($people->frequency());
        return $this->writeBody($output);
    }

    public function duplicatesAction()
    {
        $people = $this->getPeopleModel();
        $output = json_encode($people->getPossibleDuplicates());
        return $this->writeBody($output);
    }

    public function getPeopleAction()
    {
        $people = $this->getPeopleModel();
        $output = json_encode($people->getPeople());
        return $this->writeBody($output);
    }

    /**
     * this acts as a simple DI function for getting a fully hydrated model
     * 
     * @return Models\SalesLoft\People
     */
    private function getPeopleModel()
    {
        $config = \Config::load(CONFIGPATH);
        $http = new \Http();
        return new People($http, $config, $_SESSION);
    }
}