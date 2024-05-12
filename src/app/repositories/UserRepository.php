<?php

namespace app\repositories;

use app\models\User;
use Exception;
use MongoDB\Collection;

class UserRepository
{
    private ?Collection $collection = null;

    public function __construct(Collection $userCollection)
    {
        $this->collection = $userCollection;
    }

    public function addEnrollment(string $username, int $courseId)
    {
        try {
            // Retrieve user information
            $user = $this->getUserByUsername($username);

            // Convert MongoDB BSONDocument to array for easier manipulation
            if ($user instanceof \MongoDB\Model\BSONDocument) {
                $user = $user->getArrayCopy();
            }

            if (is_array($user)) {
                // Check if user already has an enrollment array
                if (array_key_exists('enrollment_keys', $user)) {
                     // Check if user already enrolled in the course
                    if (in_array($courseId, $user['enrollment_keys']->getArrayCopy())) {
                        return 'You are already enrolled in this course';
                    }
                    $updateInfo = ['$push' => ['enrollment_keys' => $courseId]];
                } else {
                    // If user has no existing enrollments, create a new enrollment array
                    $updateInfo = ['$set' => ['enrollment_keys' => [$courseId]]];
                }

                // Update user's enrollment information in the database
                $updateResult = $this->collection->updateOne(['_id' => $user['_id']], $updateInfo);
                
                // Check if modifications were detected
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


    public function createUser(User $user)
    {
        try {
            $insertResult = $this->collection->insertOne($user->toArray());
            return $insertResult->getInsertedCount() > 0;
        } catch (Exception $e) {
            return false;
        }
    }
    public function getUserByUsername(string $username)
    {
        return $this->collection->findOne(['username' => $username]);
    }
    public function getUserByEmail(string $email)
    {
        return $this->collection->findOne(['email' => $email]);
    }

}