<?php

use Mcdcu\Projects\controllers\inventory_assignment\inventory_assignmentController;

$router->get('/inventory-assignment', [inventory_assignmentController::class, 'index']);
$router->get('/inventory-assignment/create', [inventory_assignmentController::class, 'create']);
$router->post('/inventory-assignment/create', [inventory_assignmentController::class, 'create']);
$router->get('/inventory-assignment/update', [inventory_assignmentController::class, 'update']);
$router->post('/inventory-assignment/update', [inventory_assignmentController::class, 'update']);
$router->post('/inventory-assignment/delete', [inventory_assignmentController::class, 'delete']);
$router->get('/inventory-assignment/search', [inventory_assignmentController::class, 'search']);
