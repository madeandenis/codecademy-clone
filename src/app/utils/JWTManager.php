<?php

namespace app\utils;

use Exception;
use app\exceptions\JWTException;

use app\models\User;
use app\repositories\RoleRepository;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\SignatureInvalidException;

class JWTManager{
    private string $adminRole = 'ROLE_ADMIN';
    private string $secretKey;
    private int $expDuration;

    public function __construct(){
        $configFilePath = realpath(__DIR__ . '/../../../config/jwt.env');
        $this->secretKey = parse_ini_file($configFilePath)["JWT_KEY"];
        $this->expDuration = parse_ini_file($configFilePath)["JWT_EXP"];
    }

    public function createToken(User $user){
        $payload = [
            'iss' => 'https://codecademyre.com',
            'aud' => 'https://codecademyre.com',
            'iat' => time(),
            'exp' => time() + $this->expDuration,
            'context' => [
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'roles' => $user->getRoles()
            ]
        ];
        return JWT::encode($payload, $this->secretKey, 'HS256');
    }
    public function decodeToken($token){
        return JWT::decode($token, new Key($this->secretKey, 'HS256'));
    }
    public function validateToken($token){
        try{
            return $this->decodeToken($token);
        } catch (ExpiredException $e) {
            throw new JWTException(JWTException::TOKEN_EXPIRED);
        } catch (BeforeValidException $e) {
            throw new JWTException(JWTException::TOKEN_NOT_YET_VALID);
        } catch (SignatureInvalidException $e) {
            throw new JWTException(JWTException::TOKEN_SIGNATURE_INVALID);
        } catch (Exception $e) {
            throw new JWTException(JWTException::TOKEN_VALIDATION_FAILED);
        }
    }
    public function getExpDuration(){
        return $this->expDuration;
    }
    public function getUsername($token){
        try{
            $decodedToken = $this->validateToken($token);
            if(isset($decodedToken->context->username)){
                return $decodedToken->context->username;
            }
        } catch (JWTException $e){
            return null;
        }
        return null;
    }
    public function getUserRoles($token){
        try{
            $decodedToken = $this->validateToken($token);
            if(isset($decodedToken->context->roles)){
                return $decodedToken->context->roles;
            }
        } catch (JWTException $e){
            return null;
        }
        return null;
    }
    public function hasAdminRole($token){
        try{
            $roles = $this->getUserRoles($token);
            if($roles){
                foreach($roles as $role){
                    if($role === $this->adminRole){
                        return true;
                    }
                }
            }
        } catch(JWTException $e){
            return false;
        }
        return false;
    }

}