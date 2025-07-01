<?php
use Mcdcu\Projects\controllers\returns\ReturnController   ;

$router->get('/returns', [ReturnController::class, 'index']);
$router->get('/returns/create', [ReturnController::class, 'create']);
$router->post('/returns/create', [ReturnController::class, 'create']);
$router->get('/returns/update', [ReturnController::class, 'update']);
$router->post('/returns/update', [ReturnController::class, 'update']);
$router->post('/returns/delete', [ReturnController::class, 'delete']);
$router->get('/returns/search', [ReturnController::class, 'search']);
