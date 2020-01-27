<?php

namespace Controllers\SalesLoft;

use Controllers\ControllerBase;
use Exception;
use Models\SalesLoft\People;
use stdClass;

class PeopleController extends ControllerBase
{
    public function defaultAction()
    {
        $context = new stdClass();
        $context->message = 'SalesLoft Project';
        $context->links = [
            [
                'text' => 'People',
                'href' => '/people'
            ]
        ];
        $output = $this->loadView('default', $context);
        return $this->writeBody($output);
    }

    public function getAction()
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

    private function writeBody($content)
    {
        $this->response->getBody()->write($content);
        return $this->response;
    }

    private function loadView($templateName, $context)
    {
        $viewPath = APPROOT . '/src/views/' . $templateName . '.php';
        $templatePath = APPROOT . '/src/views/template.php';

        if (!file_exists($viewPath)) {
            throw new Exception("{$templateName} view template does not exist");
        }
        else {
            if (is_object($context) OR is_array($context)) {
                foreach($context as $name => $value) {
                    $$name = $value;
                }
            }

            ob_start();
            require $viewPath;
            $_view = ob_get_clean();
            ob_start();
            require $templatePath;
            $output = ob_get_clean();
            return $output;
        }
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