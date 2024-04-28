<?php

use app\core\database\mysql\MySqlManager;

$requestBody = file_get_contents('php://input');
$params = json_decode($requestBody, true);

if (isset($params['action'])) {
    $action = $params['action'];

    if ($action === 'insertDatabase' || $action === 'updateDatabase' || $action === 'deleteFromDatabase') {
        if (isset($params['schema'], $params['table'])) {
            
            $schema_name = $params['schema'];
            $table_name = $params['table'];
            unset($params['schema'], $params['table'], $params['action']);

            $column_names = array_keys($params);
            $column_values = array_values($params);

            if ($action === 'insertDatabase') {
                echo json_encode(MySqlManager::insertData(MySqlManager::getConnection(), $schema_name, $table_name, $column_names, $column_values));
            } 
            elseif ($action === 'updateDatabase') {
                echo json_encode(MySqlManager::updateData(MySqlManager::getConnection(), $schema_name, $table_name, $column_names, $column_values));
            }
            elseif ($action === 'deleteFromDatabase'){
                $column_name = $params['column'];
                $column_values = $params['column_values'];
                unset($params['column']);
                unset($params['column_values']);
                echo json_encode(MySqlManager::deleteData(MySqlManager::getConnection(), $schema_name, $table_name, $column_name, $column_values));
            }
            exit;
        }
    }
}

echo json_encode(['error' => 'Invalid request or missing parameters']);
