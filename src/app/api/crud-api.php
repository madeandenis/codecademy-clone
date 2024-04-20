<?php

use app\core\database\mysql\MySqlManager;

if(isset($_GET['action'])){
    $action = $_GET['action'];
    if($action == 'getTables' && isset($_GET['schema'])){
        $schema_name = $_GET['schema'];
        echo json_encode(MySqlManager::getTables($schema_name, MySqlManager::getConnection()));
        unset($_GET['schema']);
        unset($_GET['action']);
        exit;
    }
    if($action == 'getTableData' && isset($_GET['schema']) && isset($_GET['table'])){
        $schema_name = $_GET['schema'];
        $table_name = $_GET['table'];
        echo json_encode(MySqlManager::getTableData($schema_name,$table_name,MySqlManager::getConnection()));
        unset($_GET['schema']);
        unset($_GET['table']);
        unset($_GET['action']);
        exit;
    }
    if($action == 'updateDatabase' && isset($_GET['schema']) && isset($_GET['table'])){
        $schema_name = $_GET['schema'];
        $table_name = $_GET['table'];
        unset($_GET['schema']);
        unset($_GET['table']);
        unset($_GET['action']);

        $column_names = array_keys($_GET);
        $column_values = array_values($_GET);

        echo json_encode(MySqlManager::insertData(MySqlManager::getConnection(),$schema_name,$table_name,$column_names,$column_values));
        exit;
    }
}