<?php

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
    public static function createFromDocument($document){
        $user = self::create();
        
        $user->setUsername($document['username'])
             ->setEmail($document['email'])
             ->setPassword($document['password'])
             ->setRoles($document['roles']);

        return $user;
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

