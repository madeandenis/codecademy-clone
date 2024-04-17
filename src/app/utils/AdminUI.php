<?php

namespace app\utils;

class AdminUI{
    public static function renderControlPanelLink(){
        if (isset($_COOKIE['jwtToken'])) {
            $tokenManager = new JWTManager();
            $token = $_COOKIE['jwtToken'];
            if($tokenManager->hasAdminRole($token)){
                echo '
                <a href="http://codecademyre.com/admin" class="admin-panel-link">
                    <i class="fas fa-tools"></i>
                    <span>Admin Panel</span>
                </a>';
            }
        }
    }
}