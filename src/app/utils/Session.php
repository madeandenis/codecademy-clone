<?php

namespace app\utils;

class Session{
    public static function start(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }
    public static function end(){
        if(session_status() === PHP_SESSION_ACTIVE){
            session_unset();    // unset global vars (.. cookies)
            session_destroy();  // destroy session (data sessions)
        }
    }
}