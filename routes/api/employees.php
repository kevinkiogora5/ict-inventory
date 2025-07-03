<?php 

use Mcdcu\Projects\controllers\employees\employeesController;
use Mcdcu\Projects\controllers\inventory_items\InventoryItemsController;

$router->get('/goods', [InventoryItemsController::class, 'index']);
$router->get('/employees', [employeesController::class, 'index']);
$router->get('/employees/create', [employeesController::class, 'create']);
$router->post('/employees/create', [employeesController::class, 'create']);
$router->get('/employees/update', [employeesController::class, 'update']);
$router->post('/employees/update', [employeesController::class, 'update']);
$router->post('/employees/delete', [employeesController::class, 'delete']);
$router->get('/employees/search', [employeesController::class, 'search']);
