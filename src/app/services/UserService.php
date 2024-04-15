<?php

namespace app\services;

use app\repositories\UserRepository;
use app\repositories\RoleRepository;
use app\models\User;
use app\exceptions\AuthException;

class UserService{
    private UserRepository $userRepository;
    private RoleRepository $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository){
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function registerUser(User $user){
        if(empty($user->getEmail()) || empty($user->getUsername() || empty($user->getPassword()))){
            throw new AuthException(AuthException::EMPTY_CREDENTIALS);
        }
        if($this->userRepository->getUserByUsername($user->getUsername())){
            throw new AuthException(AuthException::USERNAME_TAKEN);
        }
        if($this->userRepository->getUserByEmail($user->getEmail())){
            throw new AuthException(AuthException::EMAIL_TAKEN);
        }
        $hashedPass = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        return $this->userRepository->createUser(
            new User(
                $user->getUsername(),
                $user->getEmail(),
                $hashedPass,
                $this->roleRepository->convert_roleNames_to_DBRef($user->getRoles())
            )
        );
    }
    public function authenticateUser($username_or_email, $password){
        if(empty($username_or_email) && empty($password)){
            throw new AuthException(AuthException::EMPTY_CREDENTIALS);
        }
        $user = $this->userRepository->getUserByUsername($username_or_email);
        // Case username doesn't exist
        if(!$user){
            $user = $this->userRepository->getUserByEmail($username_or_email);
            // Case username/email doesn't exist
            if(!$user){
                throw new AuthException(AuthException::INCORRECT_IDENTIFIER);
            }
        }

        if(!password_verify($password,$user['password'])){
            throw new AuthException(AuthException::INCORRECT_PASSWORD);
        }

        return $user;
    }
    

}