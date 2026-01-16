<?php
// Le routeur gère GET et POST pour chaque page.
use App\Controllers\AuthController;
use App\Controllers\CoachController;
use App\Controllers\SportifController;
use Core\Middleware\AuthMiddleware;

// Auth
$router->get('\login', [AuthController::class, 'login']);
$router->post('../login', [AuthController::class, 'login']);

$router->get('register', [AuthController::class, 'register']);
$router->post('register', [AuthController::class, 'register']);

// Dashboard Coach (protégé)
$router->get('/coach/dashbord', function () {
    AuthMiddleware::role('coach');
    (new CoachController())->dashboard();
});

// Dashboard Sportif (protégé)
$router->get('/sportif/dashbord', function () {
    AuthMiddleware::role('sportif');
    (new SportifController())->dashboard();
});

?>
