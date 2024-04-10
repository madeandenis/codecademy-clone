<?php

namespace app\repositories;

use app\models\User;
use MongoDB\Collection;
use app\core\database\MongoDBManager; 

class UserRepository{
    private ?Collection $collection = null;

    public function __construct(Collection $userCollection){
        $this->collection = $userCollection;
    }

    public function createUser(User $user){
        $insertResult = $this->collection->insertOne($user->toArray());
        return $insertResult->getInsertedCount() > 0;
    }
    public function getUserByUsername(string $username){
        return $this->collection->findOne(['username' => $username]);
    }
    public function getUserByEmail(string $email){
        return $this->collection->findOne(['email' => $email]);
    }
}