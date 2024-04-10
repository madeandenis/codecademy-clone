<?php

namespace app\models;
use app\repositories\RoleRepository;
use app\utils\MongoUtils;

class User
{
    protected string $username;
    protected string $email;
    protected string $password;
    protected array $roles;

    public function __construct() {}

    public static function create() {
        return new self;
    }
    
    public function setUsername(string $username){
        $this->username = $username;
        return $this;
    }
    public function setEmail(string $email){
        $this->email = $email;
        return $this;
    }
    public function setPassword(string $password){
        $this->password = $password;
        return $this;
    }
    public function setRoles(array $roles){
        $this->roles = $roles;
        return $this;
    }

    public function getUsername(): string {
        return $this->username;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getPassword(): string {
        return $this->password;
    }
    public function getRoles(): array {
        return $this->roles;
    }

    
    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'roles' => $this->roles,
        ];
    }
}

