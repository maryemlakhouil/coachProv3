<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$router = new Router();
require_once __DIR__ . '/../routes/web.php';

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>