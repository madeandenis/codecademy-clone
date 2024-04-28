<?php

namespace app\controllers;

class CatalogController extends Controller{
    public function index(){
        $this->renderCatalog('index');
    }
}