<?php

use Mcdcu\Projects\controllers\Inventory\InventoryCategoriesController;

$router->get('/categories', [InventoryCategoriesController::class, 'index']);
$router->get('/inventory-categories/create', [InventoryCategoriesController::class, 'create']);
$router->post('/inventory-categories/create', [InventoryCategoriesController::class, 'create']);
$router->get('/inventory-categories/update', [InventoryCategoriesController::class, 'update']);
$router->post('/inventory-categories/update', [InventoryCategoriesController::class, 'update']);
$router->post('/inventory-categories/delete', [InventoryCategoriesController::class, 'delete']);
$router->get('/inventory-categories/search', [InventoryCategoriesController::class, 'search']);