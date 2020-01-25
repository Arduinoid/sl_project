<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use Controllers\HandlerFactory;

require __DIR__ . '/../bootstrap.php';

$app = AppFactory::create();

/**
 * ===============================
 * Routes and actions declarations
 * ===============================
 */
$app->get('/', HandlerFactory::create(\Controllers\SalesLoft\PeopleController::class));
$app->get('/people', HandlerFactory::create(\Controllers\SalesLoft\PeopleController::class, 'get'));
$app->get('/frequency', HandlerFactory::create(\Controllers\SalesLoft\PeopleController::class, 'frequency'));

/**
 * ===================
 * Run the application
 * ===================
 */
$app->run();