<?php

namespace app\controllers;

class AuthController extends Controller{
    public function login(){
        $this->renderAuth('login');
    }
    public function signup(){
        $this->renderAuth('signup');
    }
    public function submitLogin(){
        $this->handleLogin();
    }
    public function submitSignup(){
        $this->handleRegister();
    }
}