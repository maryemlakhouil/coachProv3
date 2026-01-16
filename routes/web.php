<?php

use App\Controllers\AuthController;
use App\Controllers\CoachController;
use App\Controllers\SportifController;
use Core\Middleware\AuthMiddleware;


$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);

$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);


$router->get('/coach/dashbord', function () {
    AuthMiddleware::role('coach');
    (new CoachController())->dashbord();
});

$router->get('/coach/profile', function () {
    AuthMiddleware::role('coach');
    (new CoachController())->profile();
});

$router->post('/coach/profile', function () {
    AuthMiddleware::role('coach');
    (new CoachController())->profile();
});

$router->get('/coach/reservations', function () {
    AuthMiddleware::role('coach');
    (new CoachController())->reservations();
});


$router->get('/sportif/dashbord', function () {
    AuthMiddleware::role('sportif');
    (new SportifController())->dashbord();
});
