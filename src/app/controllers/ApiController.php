<?php

namespace app\controllers;
use app\components\public\CourseSection;
use app\core\database\mysql\MySqlManager;
use app\utils\StreamVideo;

class ApiController extends Controller{
   
    // GET Methods
    public function getTables(){
        if(isset($_GET['schema'])){
            $schema_name = $_GET['schema'];
            echo json_encode(MySqlManager::getTables($schema_name, MySqlManager::getConnection()));
            unset($_GET['schema']);
        }
    }
    public function getTableData()
    {
        if (isset($_GET['schema']) && isset($_GET['table'])) {
            $schema_name = $_GET['schema'];
            $table_name = $_GET['table'];
            echo json_encode(MySqlManager::getTableData($schema_name, $table_name, MySqlManager::getConnection()));
            unset($_GET['schema']);
            unset($_GET['table']);
            unset($_GET['action']);
            exit;
        }
    }

    public function getCourses()
    {
        $courseSection = new CourseSection(MySqlManager::getConnection());
        echo json_encode($courseSection->getCoursesAsHtml($courseSection->getCourses()));
        exit;
    }

    public function search()
    {
        if (isset($_GET['searchQuery'])) {
            $searchQuery = $_GET['searchQuery'];
            echo json_encode(MySqlManager::searchData($searchQuery));
            unset($_GET['searchQuery']);
            exit;
        }
    }

    public function fetchProcedures()
    {
        if (isset($_GET['schema'])) {
            $schema_name = $_GET['schema'];
            echo json_encode(MySqlManager::getProcedures(MySqlManager::getConnection(), $schema_name));
            unset($_GET['schema']);
            exit;
        }
    }

    public function fetchFunctions()
    {
        if (isset($_GET['schema'])) {
            $schema_name = $_GET['schema'];
            echo json_encode(MySqlManager::getFunctions(MySqlManager::getConnection(), $schema_name));
            unset($_GET['schema']);
            exit;
        }
    }

    public function fetchVideo()
    {
        if (isset($_GET['video_src'])) {
            $video_src = $_GET['video_src'];
            echo json_encode(StreamVideo::streamVideo($video_src));
            unset($_GET['video_src']);
            exit;
        }
    }

    public function query()
    {
        if (isset($_GET['query'])) {
            $query = $_GET['query'];
            echo json_encode(MySqlManager::executeQuery($query, MySqlManager::getConnection()));
            unset($_GET['query']);
            exit;
        }
    }

     // POST Methods
     private function getBodyParams(){
        $requestBody = file_get_contents('php://input');
        $params = json_decode($requestBody, true);
        return $params;
    }
    private function getSchemaName(){
        return $this->getBodyParams()['schema'];
    }
    private function getTableName(){
        return $this->getBodyParams()['table'];
    }
    private function getColumnNames(){
        $params = $this->getBodyParams();
        unset($params['schema'], $params['table']);
        return array_keys($params);
    }
    private function getColumnValues(){
        $params = $this->getBodyParams();
        unset($params['schema'], $params['table']);
        return array_values($params);
    }
    public function insertDatabase(){
        $schema_name = $this->getSchemaName();
        $table_name = $this->getTableName();
        $column_names = $this->getColumnNames();
        $column_values = $this->getColumnValues();
        
        echo json_encode(MySqlManager::insertData(MySqlManager::getConnection(), $schema_name, $table_name, $column_names, $column_values));
    }
    public function updateDatabase(){
        $schema_name = $this->getSchemaName();
        $table_name = $this->getTableName();
        $column_names = $this->getColumnNames();
        $column_values = $this->getColumnValues();

        echo json_encode(MySqlManager::updateData(MySqlManager::getConnection(), $schema_name, $table_name, $column_names, $column_values));
    }
    public function deleteFromDatabase(){
        $schema_name = $this->getSchemaName();
        $table_name = $this->getTableName();
        $params = $this->getBodyParams();
        // $column_name refers to the ID column name && $column_values the IDs
        $column_name = $params['column'];
        $column_values = $params['column_values'];

        echo json_encode(MySqlManager::deleteData(MySqlManager::getConnection(), $schema_name, $table_name, $column_name, $column_values));
    }

}