<?php

namespace app\controllers;

class PricingController extends Controller{
    public function index(){
        $this->renderPricing('index');
    }
}