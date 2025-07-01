<?php
use Mcdcu\Projects\controllers\inventory_categories\inventory_categoriesController;

$router->get('/inventory-categories', [inventory_categoriesController::class, 'index']);
$router->get('/inventory-categories/create', [inventory_categoriesController::class, 'create']);
$router->post('/inventory-categories/create', [inventory_categoriesController::class, 'create']);
$router->get('/inventory-categories/update', [inventory_categoriesController::class, 'update']);
$router->post('/inventory-categories/update', [inventory_categoriesController::class, 'update']);
$router->post('/inventory-categories/delete', [inventory_categoriesController::class, 'delete']);
$router->get('/inventory-categories/search', [inventory_categoriesController::class, 'search']);