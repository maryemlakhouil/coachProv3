<?php

class Security
{
    /**
     * Démarrer la session si nécessaire
     */
    public static function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Vérifier si l'utilisateur est connecté
     */
    public static function checkAuth(): void
    {
        self::startSession();

        if (!isset($_SESSION['user_id'])) {
            header('index.php?page=login');
            exit;
        }
    }

    /**
     * Vérifier le rôle utilisateur
     */
    public static function checkRole(string $role): void
    {
        self::startSession();

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
            header('index.php?page=login');
            exit;
        }
    }

    /**
     * Vérifier plusieurs rôles
     */
    public static function requireRole(string $role): void
    {
        if (
            !isset($_SESSION['user_id']) ||
            !isset($_SESSION['role']) ||
            $_SESSION['role'] !== $role
        ) {
            header('Location: index.php?page=login');
            exit;
        }
    }

    /**
     * Protection XSS simple
     */
    public static function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Déconnexion
     */
    public static function logout(): void
    {
        self::startSession();
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
