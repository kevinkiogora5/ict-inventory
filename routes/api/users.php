<?php

use Mcdcu\Projects\controllers\department\departmentController;

$router->get('/departments', [departmentController::class, 'index']);
$router->get('/departments/create', [DepartmentController::class, 'create']);
$router->post('/departments/create', [DepartmentController::class, 'create']);
$router->get('/departments/update', [DepartmentController::class, 'update']);
$router->post('/departments/update', [DepartmentController::class, 'update']);
$router->post('/departments/delete', [DepartmentController::class, 'delete']);
$router->get('/departments/search', [DepartmentController::class, 'search']);
