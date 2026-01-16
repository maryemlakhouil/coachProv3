
<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$router = new Router();

/* Charger les routes */
require __DIR__ . '/../app/routes/web.php';

/* Lancer le router */
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
