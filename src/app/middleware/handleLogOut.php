<?php

use app\utils\Session;

// Start session for token reading
Session::start();

if (isset($_COOKIE['jwtToken'])) {
    // Set an invalid jwtToken cookie for browser to automatically delete it
    setcookie('jwtToken', '', time() - 3600, '/');

    // End current session
    Session::end();

    // Start a new session
    Session::start();

    $_SESSION['success_logout'] = 'You have been successfully logged out.';
} else {
    $_SESSION['error_msg'] = 'You are not currently logged in.';
}

exit;
