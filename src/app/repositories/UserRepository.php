<?php

namespace app\repositories;

use app\models\User;
use Exception;
use MongoDB\Collection;

class UserRepository{
    private ?Collection $collection = null;

    public function __construct(Collection $userCollection){
        $this->collection = $userCollection;
    }

    public function addEnrollment(string $username, int $courseId) {
        try {
            $user = $this->getUserByUsername($username);
    
            if ($user instanceof \MongoDB\Model\BSONDocument) {
                $user = $user->getArrayCopy();
            }
            
            if (is_array($user)) {
                if (array_key_exists('enrollment_keys', $user)) {
                    if (in_array($courseId, $user['enrollment_keys']->getArrayCopy())) {
                        return 'You are already enrolled in this course';
                    }
                    $updateInfo = ['$push' => ['enrollment_keys' => $courseId]];
                } else {
                    $updateInfo = ['$set' => ['enrollment_keys' => [$courseId]]];
                }
    
                $updateResult = $this->collection->updateOne(['_id' => $user['_id']], $updateInfo);
                if ($updateResult->getModifiedCount() > 0) {
                    return 'Enrolled successfully';
                } else {
                    return 'Failed to enroll';
                }
            } else {
                return 'User not found'; 
            }
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    
    
    public function createUser(User $user){
        try{
            $insertResult = $this->collection->insertOne($user->toArray());
            return $insertResult->getInsertedCount() > 0;
        }
        catch (Exception $e){
            return false;
        }
    }
    public function getUserByUsername(string $username){
        return $this->collection->findOne(['username' => $username]);
    }
    public function getUserByEmail(string $email){
        return $this->collection->findOne(['email' => $email]);
    }
    
}