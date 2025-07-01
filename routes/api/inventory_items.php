<?php

use Mcdcu\Projects\controllers\inventory_items\InventoryItemsController;

$router->get('/inventory-items', [InventoryItemsController::class, 'index']); // List all items
$router->get('/inventory-items/show', [InventoryItemsController::class, 'show']); // Show one item by ?id=
$router->get('/inventory-items/create', [InventoryItemsController::class, 'create']); // Optional: form page
$router->post('/inventory-items/create', [InventoryItemsController::class, 'store']); // Create item
$router->get('/inventory-items/update', [InventoryItemsController::class, 'update']); // Optional: update page
$router->post('/inventory-items/update', [InventoryItemsController::class, 'update']); // Update item by ?id=
$router->post('/inventory-items/delete', [InventoryItemsController::class, 'delete']); // Delete item by ?id=
$router->get('/inventory-items/search', [InventoryItemsController::class, 'search']); // Search items
