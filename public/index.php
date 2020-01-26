<?php

use Slim\Factory\AppFactory;
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
$app->get('/people', HandlerFactory::create(PeopleController::class, 'get'));
$app->get('/frequency', HandlerFactory::create(PeopleController::class, 'frequency'));
$app->get('/duplicates', HandlerFactory::create(PeopleController::class, 'duplicates'));

/**
 * ===================
 * Run the application
 * ===================
 */
$app->run();