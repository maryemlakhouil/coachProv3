<?php
namespace Core;

use PDO;

class Database {

    private static ?PDO $instance = null;

    // Retourne l'instance PDO statique
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../config/database.php';

            self::$instance = new PDO(
                $config['dsn'],
                $config['user'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        }

        return self::$instance;
    }

    // Optionnel : méthode pour obtenir PDO via l'instance de classe
    public function getPDO(): PDO {
        return self::getInstance();
    }
}
