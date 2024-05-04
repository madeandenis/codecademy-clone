<?php

namespace app\controllers;

class ErrorsController extends Controller{
    public function error_404(){
        $this->renderErrors('404');
    }
}