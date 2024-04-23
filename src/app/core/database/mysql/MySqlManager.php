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

    // Credit: https://stackoverflow.com/questions/639531/search-text-in-fields-in-every-table-of-a-mysql-database
    public static function searchData($searchQuery, $pdo) {
        $out = "";
        $total = 0;
        
        try {
            // Retrieve all table names
            $tablesStmt = $pdo->query("SHOW TABLES");
            $tables = $tablesStmt->fetchAll(PDO::FETCH_COLUMN);
            
            // Loop through each table
            foreach ($tables as $table) {
                // Retrieve column names for the current table
                $columnsStmt = $pdo->prepare("SHOW COLUMNS FROM `$table`");
                $columnsStmt->execute();
                $columns = $columnsStmt->fetchAll(PDO::FETCH_COLUMN);
                
                if (!empty($columns)) {
                    $sql_search_fields = [];
                    
                    // Build the WHERE clause for searching in each column
                    foreach ($columns as $column) {
                        $sql_search_fields[] = "`$column` LIKE ?";
                    }
                    
                    // Construct the search query
                    $sql_search = "SELECT * FROM `$table` WHERE " . implode(" OR ", $sql_search_fields);
                    
                    // Prepare and execute the search query
                    $searchStmt = $pdo->prepare($sql_search);
                    
                    // Bind the search parameter (with wildcards) to each column condition
                    $searchParam = '%' . $searchQuery . '%';
                    $params = array_fill(0, count($columns), $searchParam);
                    $searchStmt->execute($params);
                    
                    // Fetch the search results
                    $rows = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
                    $rowCount = count($rows);
                    
                    if ($rowCount > 0) {
                        $out .= "$table: $rowCount\n";
                        $out .= print_r($rows, true) . "\n";
                        $total += $rowCount;
                    }
                }
            }
            
            $out .= "\nTotal results: $total";
        } catch (PDOException $e) {
            $out = ["Error" => $e->getMessage()];
        }
        
        return $out;
    }
    
    
    // Insertion/Update Database 
    public static function insertData($pdo, $schema_name, $table_name, $column_names, $column_values) {
        if (empty($column_names) || empty($column_values)) {
            return [ "Error" => "Column names or values are empty." ];
        }

        $columnsString = implode(', ', $column_names);
        $valuePlaceholders = substr(str_repeat(' ? ,',count($column_names)), 0, -1);
    
        $insertQuery = "INSERT INTO `$schema_name`.`$table_name` ($columnsString) VALUES ($valuePlaceholders)";
    
        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare($insertQuery);
                        
            // Bind value to placeholder
            for ($i = 0; $i < count($column_values); $i++) {
                $stmt->bindValue($i + 1, $column_values[$i]);
            }

            $stmt->execute();

            $rowCount = $stmt->rowCount();

            $pdo->commit();
            
            return [ "Success" => "Data inserted successfully. $rowCount row(s) affected." ];

        } catch (PDOException $e) {
            $pdo->rollBack();

            return [ "Error" => $e->getMessage() ];
        }
    }

    public static function updateData($pdo, $schema_name, $table_name, $column_names, $column_values) {
        if (empty($column_names) || empty($column_values)) {
            return [ "Error" => "Column names or values are empty." ];
        }
    
        // Modify var names for final proj.
        $setClause = '';
        foreach ($column_names as $index => $column_name) {
            $setClause .= "`$column_name` = ?";
            if ($index < count($column_names) - 1) {
                $setClause .= ', ';
            }
        }
    
        $condition_column = $column_names[0];
        $condition_value = $column_values[0];
    
        $updateQuery = "UPDATE `$schema_name`.`$table_name` SET $setClause WHERE `$condition_column` = ?";
    
        try {
            $pdo->beginTransaction();
    
            $stmt = $pdo->prepare($updateQuery);
    
            foreach ($column_values as $index => $value) {
                $stmt->bindValue($index + 1, $value);
            }
    
            $stmt->bindValue(count($column_values) + 1, $condition_value);
    
            $stmt->execute();
    
            $rowCount = $stmt->rowCount();
    
            $pdo->commit();
    
            return [ "Success" => "Data updated successfully. $rowCount row(s) affected." ];
    
        } catch (PDOException $e) {
            $pdo->rollBack();
    
            return [ "Error" => $e->getMessage() ];
        }
    }

    public static function deleteData($pdo, $schema_name, $table_name, $column_name, $column_values) {
        if (empty($column_name) || empty($column_values)) {
            return [ "Error" => "Column name or values are empty." ];
        }
    
        $placeholders = implode(',', array_fill(0, count($column_values), '?'));
    
        $deleteQuery = "DELETE FROM `$schema_name`.`$table_name` WHERE `$column_name` IN ($placeholders)";
    
        try {
            $pdo->beginTransaction();
    
            $stmt = $pdo->prepare($deleteQuery);
    
            // Bind values to placeholders
            foreach ($column_values as $index => $value) {
                $stmt->bindValue($index + 1, $value);
            }
    
            $stmt->execute();
    
            $rowCount = $stmt->rowCount();
    
            $pdo->commit();
    
            return [ "Success" => "Data deleted successfully. $rowCount row(s) affected." ];
    
        } catch (PDOException $e) {
            $pdo->rollBack();
    
            return [ "Error" => $e->getMessage() ];
        }
    }
    
}