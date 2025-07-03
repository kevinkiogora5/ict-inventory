<?php

use Mcdcu\Projects\controllers\location\locationsController;

$router->get('/location', [locationsController::class, 'index']);
$router->get('/locations/create', [locationsController::class, 'create']);
$router->post('/locations/create', [locationsController::class, 'create']);
$router->get('/locations/update', [locationsController::class, 'update']);
$router->post('/locations/update', [locationsController::class, 'update']);
$router->post('/locations/delete', [locationsController::class, 'delete']);
$router->get('/locations/search', [locationsController::class, 'search']);

