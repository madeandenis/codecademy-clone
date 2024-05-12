<?php

namespace app\controllers;

class PageErrorController extends Controller{
    public function error(string $error_code){
        $this->renderError($error_code);
    }
}