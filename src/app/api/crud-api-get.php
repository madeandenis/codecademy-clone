<?php

use app\components\public\CourseSection;
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
    if($action == 'getCourses'){
        $courseSection = new CourseSection(MySqlManager::getConnection());
        echo json_encode($courseSection->getCoursesAsHtml($courseSection->getCourses()));
        exit;
    }
    if($action == 'search'){
        $searchQuery = $_GET['searchQuery'];
        echo json_encode(MySqlManager::searchData($searchQuery));
        unset($_GET['searchQuery']);
        exit;
    }
    if($action == 'fetchProcedures' && isset($_GET['schema'])){
        $schema_name = $_GET['schema'];
        echo json_encode(MySqlManager::getProcedures(MySqlManager::getConnection(),$schema_name));
        unset($_GET['schema']);
        exit;
    }
    if($action == 'fetchFunctions' && isset($_GET['schema'])){
        $schema_name = $_GET['schema'];
        echo json_encode(MySqlManager::getFunctions(MySqlManager::getConnection(),$schema_name));
        unset($_GET['schema']);
        exit;
    }
    if($action == 'query'){
        $query = $_GET['query'];
        echo json_encode(MySqlManager::executeQuery($query, MySqlManager::getConnection()));
        unset($_GET['query']);
        exit;
    }
}

