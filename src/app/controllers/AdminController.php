<?php

namespace app\controllers;

class AdminController extends Controller{
    public function adminPanel(){
        $this->renderAdmin('panel');
    } 
    
    public function adminCrud(){
        $this->renderAdmin('crud');
    }

    public function adminSearch(){
        $this->renderAdmin('search');
    }
    public function adminQuery(){
        $this->renderAdmin('query');
    }
}