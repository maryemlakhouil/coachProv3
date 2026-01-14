<?php

use App\Controllers\AuthController;
use App\Controllers\CoachController;

$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'authenticate']);

$router->get('/coaches', [CoachController::class, 'index']);
