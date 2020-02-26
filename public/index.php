<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Controllers\HandlerFactory;
use Controllers\SalesLoft\DashBoardController;
use Controllers\SalesLoft\PeopleController;
use Controllers\MusicController;

require __DIR__ . '/../bootstrap.php';

$app = AppFactory::create();

/**
 * ===============================
 * Routes and actions declarations
 * ===============================
 */

//  Dashboard or Home routes
$app->get('/', HandlerFactory::create(DashBoardController::class));

// People routes
$app->group('/people', function(RouteCollectorProxy $group) {
    $group->get('', HandlerFactory::create(PeopleController::class));
    $group->get('/frequency', HandlerFactory::create(PeopleController::class, 'frequency'));
    $group->get('/duplicates', HandlerFactory::create(PeopleController::class, 'duplicates'));
    $group->get('/get', HandlerFactory::create(PeopleController::class, 'getPeople'));
    $group->get('/destroy_cache', HandlerFactory::create(PeopleController::class, 'destroyCache'));
});

// Spotify routes
$app->group('/music', function(RouteCollectorProxy $group) {
    $group->get('', HandlerFactory::create(MusicController::class));
});

/**
 * ===================
 * Run the application
 * ===================
 */
$app->run();