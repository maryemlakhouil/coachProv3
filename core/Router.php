<?php

namespace Core;

class Router
{
    public function dispatch(): void
    {
        // Sans mod_rewrite → ?page=
        $page = $_GET['page'] ?? 'login';

        switch ($page) {

            case 'login':
                require_once BASE_PATH . '/app/Controllers/AuthController.php';
                (new \App\Controllers\AuthController())->login();
                break;

            case 'register':
                require_once BASE_PATH . '/app/Controllers/AuthController.php';
                (new \App\Controllers\AuthController())->register();
                break;

            case 'logout':
                require_once BASE_PATH . '/app/Controllers/AuthController.php';
                (new \App\Controllers\AuthController())->logout();
                break;
            case 'dashbord_coach':
                require_once BASE_PATH . '/app/Controllers/CoachController.php';
                (new \App\Controllers\CoachController())->dashboard();
                break;

            case 'dashbord':
                require_once BASE_PATH . '/app/Controllers/SportifController.php';
                (new \App\Controllers\SportifController())->dashboard();
                break;
            case 'mes_reservations':
                require_once BASE_PATH . '/app/Controllers/SportifController.php';
                (new \App\Controllers\SportifController())->listReservations();
                break;
            case 'seances':
                    require_once BASE_PATH . '/app/Controllers/SportifController.php';
                    (new \App\Controllers\SportifController())->seances();
                    break;
            case 'completer_profile':
                    require_once BASE_PATH . '/app/Controllers/CoachController.php';
                    (new \App\Controllers\CoachController())->completerProfile();
                    break;
            default:
                http_response_code(404);
                echo "404 - Page introuvable";
        }
    }
}
