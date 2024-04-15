<?php

namespace app\exceptions;

use Exception;

class JWTException extends Exception {
    public const TOKEN_EXPIRED = 'Token expired';
    public const TOKEN_NOT_YET_VALID = 'Token not yet valid';
    public const TOKEN_SIGNATURE_INVALID = 'Token signature invalid';
    public const TOKEN_VALIDATION_FAILED = 'Token validation failed';

}