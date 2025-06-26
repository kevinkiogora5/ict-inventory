<?php

use Mcdcu\Projects\controllers\User\UserController;

$router->get('/',[UserController::class,'index']);