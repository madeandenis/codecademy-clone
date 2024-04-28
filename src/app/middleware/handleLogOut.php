<?php

use app\utils\Session;

Session::start();

if (isset($_COOKIE['jwtToken'])) {
    setcookie('jwtToken', '', time(), '/'); 

    Session::end();

    Session::start();
    $_SESSION['success_logout'] = 'You have been successfully logged out.';
} else {
    $_SESSION['error_msg'] = 'You are not currently logged in.';
}

exit;
