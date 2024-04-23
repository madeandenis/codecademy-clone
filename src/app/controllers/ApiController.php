<?php

namespace app\controllers;

class ApiController extends Controller{
    public function getData($action,$queryParams){
        $_GET['action'] = $action;
        if (isset($queryParams['schema'])){
            $_GET['schema'] = $queryParams['schema'];
        }
        if (isset($queryParams['table'])){
            $_GET['table'] = $queryParams['table'];
        }
        require $this->apiPath . '/crud-api-get.php';
    }
    public function setData(){
        require $this->apiPath . '/crud-api-post.php';
    }

}