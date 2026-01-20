<?php

use App\Controllers\AuthController;
use App\Controllers\CoachController;
use App\Controllers\ReservationController;
use App\Controllers\SportifController;

// AUTH
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);

$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);

// DASHBOARDS
$router->get('/coach/dashbord', [CoachController::class, 'dashbord']);
$router->post('/coach/dashbord', [CoachController::class, 'dashbord']);


$router->get('/sportif/dashbord', [SportifController::class, 'dashbord']);
$router->post('/sportif/dashbord', [SportifController::class, 'dashbord']);

// Exemple pour les réservations (à créer plus tard)
$router->get('/sportif/reservations', [SportifController::class, 'reservations']);

// Séances
$router->get('/sportif/seances', [SportifController::class, 'seances']);
$router->post('/sportif/seances', [SportifController::class, 'seances']);

// SPORTIF
$router->post('/reservation/reserver', [ReservationController::class, 'reserver']);
$router->get('/sportif/mes_reservations', [ReservationController::class, 'mesReservations']);
$router->post('/reservation/annuler', [ReservationController::class, 'annuler']);

// COACH
$router->get('/coach/reservations', [ReservationController::class, 'reservationsCoach']);
$router->post('/coach/reservation/statut', [ReservationController::class, 'changerStatut']);
