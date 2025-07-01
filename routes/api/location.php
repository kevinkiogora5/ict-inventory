<?php
use Mcdcu\Projects\controllers\location\locationController;
$router->get('/locations', [locationController::class, 'index']);
$router->get('/locations/create', [locationController::class, 'create']);
$router->post('/locations/create', [locationController::class, 'create']);
$router->get('/locations/update', [locationController::class, 'update']);
$router->post('/locations/update', [locationController::class, 'update']);
$router->post('/locations/delete', [locationController::class, 'delete']);
$router->get('/locations/search', [locationController::class, 'search']);

