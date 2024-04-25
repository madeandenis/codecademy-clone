<?php

namespace app\utils;

use app\utils\Session;

class FlashMessage{
    private string $page;
    public function setPageType($page){
        $this->page = $page;
    }
    public function displaySuccessMessage(){
        Session::start(); // resumes session
        if (isset($_SESSION['success_msg'])) {
            echo '<div class="success-container">';
            echo '<li class="success">' . '<span>&#10004;</span>' . $_SESSION['success_msg'] . '</li>';
            echo '</div>';
            unset($_SESSION['success_msg']);
            if(isset($this->page)){
                if($this->page === 'register' || $this->page === 'signup'){
                    header("refresh:1;url=http://codecademyre.com/login");
                }
                else if($this->page === 'login'){
                    header("refresh:1;url=http://codecademyre.com/home");
                }
            }
        }
        // LogoutMessage
        if (isset($_SESSION['success_logout'])) {
            echo '<div class="success-container">';
            echo '<li class="success">' . '<span>&#10004;</span>' . $_SESSION['success_logout'] . '</li>';
            echo '</div>';
            unset($_SESSION['success_logout']);
        }
    }
    public function displayErrorMessage(){
        Session::start();
        if (isset($_SESSION['error_msg'])) {
            echo '<div class="error-container">';
            echo '<li class="error">' . '<span>&times;</span>' . $_SESSION['error_msg'] . '</li>';
            echo '</div>';
            unset($_SESSION['error_msg']);
        }
    }
}
