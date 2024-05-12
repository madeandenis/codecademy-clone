<?php

namespace app\controllers;

class UploadController extends Controller{
    public function upload(){
        $this->renderUpload('index');
    }
    public function submitUpload(){
        $this->handleUpload();
    }
}