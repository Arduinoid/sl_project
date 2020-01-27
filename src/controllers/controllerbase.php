<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;

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

    protected function writeBody($content)
    {
        $this->response->getBody()->write($content);
        return $this->response;
    }

    protected function loadView($templateName, $context)
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
     * this ensures we handle a request when an action is not provided
     * the router assumes this method exists on a controller
     */
    abstract public function defaultAction();
}