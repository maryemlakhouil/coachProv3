
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
// Racine du projet
define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/core/Router.php';

$router = new Core\Router();
$router->dispatch();