<?php

namespace app\controllers;

use app\utils\JWTManager;

class AdminController extends Controller{
    public function adminPanel(){
        $jwtManager = new JWTManager();

        if(isset($_COOKIE["jwtToken"])){
            if($jwtManager->hasAdminRole($_COOKIE["jwtToken"])){
                $this->renderAdmin('panel');
            }
            else{
                header("Location: http://codecademyre.com:8080/login");
            }    
        }
        else{
            header("Location: http://codecademyre.com:8080/login");
        }
    } 
}