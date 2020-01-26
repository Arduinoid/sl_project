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
        $context->message = 'People end point!';
        $output = $this->loadView('default', $context);
        return $this->writeBody($output);
    }

    public function getAction()
    {
        $context = new stdClass();
        $config = \Config::load(CONFIGPATH);
        $http = new \Http();
        $people = new People($http, $config, $_SESSION);
        $context->people = $people->getAll();
        $output = $this->loadView('people', $context);
        return $this->writeBody($output);
    }

    public function frequencyAction()
    {
        $config = \Config::load(CONFIGPATH);
        $http = new \Http();
        $people = new People($http, $config, $_SESSION);
        $output = json_encode($people->frequency());
        return $this->writeBody($output);
    }

    public function duplicatesAction()
    {
        $config = \Config::load(CONFIGPATH);
        $http = new \Http();
        $people = new People($http, $config, $_SESSION);
        $output = json_encode($people->getPossibleDuplicates());
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
}