<?php

namespace App\Database;

use PDO;
use PDOException;

class Connection
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../../config.php';

            try {
                self::$connection = new PDO(
                    $config['dsn'],
                    $config['username'],
                    $config['password'],
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                die("Database connection error: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
