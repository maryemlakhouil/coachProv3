<?php

return [
    'dsn' => 'pgsql:host=localhost;port=5432;dbname=coachsport',
    'user' => 'maryem',
    'password' => 'lakhouil2003'
];
?>

<?php

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $host = 'localhost';
            $port = 5432;
            $dbname = 'coachsport';
            $user = 'maryem';
            $password = 'lakhouil2003';

            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

            try {
                self::$pdo = new PDO($dsn, $user, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Erreur de connexion PostgreSQL : " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
