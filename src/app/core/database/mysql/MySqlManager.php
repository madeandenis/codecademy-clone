<?php

namespace app\core\database\mysql;

use PDO;
use PDOException;

class MySqlManager {
    private static ?PDO $pdo = null;
    private static string $host;
    private static string $db_name;
    private static string $username;
    private static string $password;

    public static function initializeConfig(): void {
        $configFilePath = realpath(__DIR__ . '/../../../../../config/mysql.env');
        self::$host = parse_ini_file($configFilePath)["DB_HOST"];
        self::$db_name = parse_ini_file($configFilePath)["DB_NAME"];
        self::$username = parse_ini_file($configFilePath)["DB_USERNAME"];
        self::$password = parse_ini_file($configFilePath)["DB_PASSWORD"];
    }

    // Getters

    public static function getConnection(): PDO {
        if (self::$pdo === null) {
            self::initializeConfig();

            // Data source name
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db_name . ";charset=utf8mb4";
            
            try {
                self::$pdo = new PDO($dsn, self::$username, self::$password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function getHostInfo($pdo) {
        $pdoInfo = $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
        return $pdoInfo;
    }

    public static function getSchemas($pdo){
        $defaultSchemas = array('information_schema', 'mysql', 'performance_schema', 'sys');
        $defaultSchemasString = "'" . implode("', '", $defaultSchemas) . "'";
    
        $selectSchemasQuery = "SELECT SCHEMA_NAME 
                            AS schema_name 
                            FROM information_schema.SCHEMATA
                            WHERE SCHEMA_NAME NOT IN ({$defaultSchemasString})";
    
        $stmt = $pdo->prepare($selectSchemasQuery);
        $stmt->execute();
    
        $schemas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        return $schemas;
    }

    public static function getTables($schema_name, $pdo) {
        $selectTablesQuery = "SELECT table_name 
                              FROM information_schema.tables
                              WHERE table_schema = ?";
        
        $stmt = $pdo->prepare($selectTablesQuery);
        $stmt->execute([$schema_name]);
    
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        return $tables;
    }

    public static function getTableData($schema_name, $table_name, $pdo) {
        $pdo->exec("USE $schema_name");
    
        $selectTableQuery = "SELECT * FROM $table_name";
        $stmt = $pdo->query($selectTableQuery);
    
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $data;
    }

    public static function getAssociativeTables($pdo){
        $associativeTables = [];
        $schemas = self::getSchemas($pdo);
        foreach($schemas as $schema){
            $associativeTables[$schema] = self::getTables($schema,$pdo);
        }
        return $associativeTables;
    }
}