<?php
// Le routeur gère GET et POST pour chaque page.

use App\Controllers\AuthController;

$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);

$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);

?>
