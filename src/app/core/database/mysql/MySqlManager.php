<?php

namespace app\core\database\mysql;

use PDO;

class MySqlManager {
    private static ?PDO $pdo = null;
    private static string $host;
    private static string $username;
    private static string $password;

    public static function initializeConfig(): void {
        $configFilePath = realpath(__DIR__ . '/../../../../../config/mysql.env');
        self::$host = $configFilePath["DB_HOST"];
        self::$username = $configFilePath["DB_USERNAME"];
        self::$password = $configFilePath["DB_PASSWORD"];
    }

    public static function getConnection(): PDO {
        if (self::$pdo === null) {
            self::initializeConfig();
            $dsn = "mysql:host=" . self::$host . ";charset=utf8mb4";
            self::$pdo = new PDO($dsn, self::$username, self::$password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$pdo;
    }
}