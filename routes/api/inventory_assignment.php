<?php

use Mcdcu\Projects\controllers\Inventory\InventoryAssignmentController;

$router->get('/assignment', [InventoryAssignmentController::class, 'index']);
$router->get('/inventory-assignment/create', [InventoryAssignmentController::class, 'create']);
$router->post('/inventory-assignment/create', [InventoryAssignmentController::class, 'create']);
$router->get('/inventory-assignment/update', [InventoryAssignmentController::class, 'update']);
$router->post('/inventory-assignment/update', [InventoryAssignmentController::class, 'update']);
$router->post('/inventory-assignment/delete', [InventoryAssignmentController::class, 'delete']);
$router->get('/inventory-assignment/search', [InventoryAssignmentController::class, 'search']);
