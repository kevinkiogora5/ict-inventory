<?php

use Mcdcu\Projects\controllers\Inventory\InventoryItemController;



$router->get('/goods', [InventoryItemController::class, 'index']);
$router->get('/inventory-items/create', [InventoryItemController::class, 'create']);
$router->post('/inventory-items/create', [InventoryItemController::class, 'create']);
$router->get('/inventory-items/update', [InventoryItemController::class, 'update']);
$router->put('/inventory-items/update', [InventoryItemController::class, 'update']);
$router->get('/inventory-items/delete', [InventoryItemController::class, 'delete']);
$router->get('/inventory-items/search', [InventoryItemController::class, 'search']);
