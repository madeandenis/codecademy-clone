<?php

namespace app\controllers;

use app\utils\JWTManager;

class AdminController extends Controller{
    public function adminPanel(){
        $this->renderAdmin('panel');
    } 
    
    public function adminCrud(){
        $this->renderAdmin('crud');
    }
}