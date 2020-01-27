<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Controllers\HandlerFactory;
use Controllers\SalesLoft\PeopleController;

require __DIR__ . '/../bootstrap.php';

$app = AppFactory::create();

/**
 * ===============================
 * Routes and actions declarations
 * ===============================
 */
$app->get('/', HandlerFactory::create(PeopleController::class));
$app->group('/people', function(RouteCollectorProxy $group) {
    $group->get('', HandlerFactory::create(PeopleController::class, 'get'));
    $group->get('/frequency', HandlerFactory::create(PeopleController::class, 'frequency'));
    $group->get('/duplicates', HandlerFactory::create(PeopleController::class, 'duplicates'));
    $group->get('/get', HandlerFactory::create(PeopleController::class, 'getPeople'));
});

/**
 * ===================
 * Run the application
 * ===================
 */
$app->run();