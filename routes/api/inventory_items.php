<?php

use Mcdcu\Projects\controllers\inventory_items\InventoryItemsController;

$router->get('/inventory-items', [InventoryItemsController::class, 'index']);
$router->get('/inventory-items/create', [InventoryItemsController::class, 'create']);
$router->post('/inventory-items/create', [InventoryItemsController::class, 'create']);
$router->get('/inventory-items/update', [InventoryItemsController::class, 'update']);
$router->post('/inventory-items/update', [InventoryItemsController::class, 'update']);
$router->get('/inventory-items/delete', [InventoryItemsController::class, 'delete']);
$router->get('/inventory-items/search', [InventoryItemsController::class, 'search']);
