<?php
namespace Core\Middleware;

class AuthMiddleware {
 
public static function check(): void{

        session_start();
  
        if (!isset($_SESSION['user_id'])) {
            header('Location: /auth/login');
            exit;
        }
    }

    public static function role(string $role): void{
        session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== $role) {
            header('Location: /auth/login');
            exit;
        }
    }
}
