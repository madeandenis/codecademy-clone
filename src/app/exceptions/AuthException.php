<?php

namespace app\exceptions;

use Exception;

class AuthException extends Exception {
    public const INVALID_USERNAME = "Invalid username";
    public const INVALID_EMAIL = "Invalid email";
    public const INVALID_PASSWORD = "Invalid password";
    public const EMAIL_TAKEN = "Email already exists";
    public const USERNAME_TAKEN = "Username is taken";
    public const EMPTY_CREDENTIALS = "Please fill out the form";
    public const INCORRECT_IDENTIFIER = "Username/Email is incorrect";
    public const INCORRECT_PASSWORD = "Password is incorrect";

}
