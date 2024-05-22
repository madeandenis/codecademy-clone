<?php

namespace app\services\providers;

class EnvService{
    private $envFilePath;
    public function __construct(){
        $this->envFilePath = realpath(__DIR__ . '/../../../../config/.env');
    }
    
    public function get($key) {
        if (!file_exists($this->envFilePath)) {
            throw new \InvalidArgumentException("File not found: $this->envFilePath");
        }

        return parse_ini_file($this->envFilePath)[$key];
    }
}