<?php

namespace app\repositories;

use app\core\database\MongoDBManager;
use MongoDB\Collection;
use MongoDB\Model\BSONArray;
use MongoDB\Model\BSONDocument;
use MongoDB\BSON\ObjectId;

class RoleRepository{
    private ?Collection $collection = null;

    public function __construct(Collection $roleCollection){
        $this->collection = $roleCollection;
    }

    public function findObjectIDbyRoleName(string $roleName){
        return $this->collection->findOne(['name' => $roleName]);
    } 

    public function extractRoleIDs(BSONArray $bsonArray): array
    {
        $roleIDs = [];

        foreach ($bsonArray as $bsonDocument) {
            if ($bsonDocument instanceof BSONDocument) {
                $roleID = $this->extractRoleID($bsonDocument);
                if($roleID){
                    $roleIDs[] = $roleID; 
                }
            }
        }

        return $roleIDs;
    }

    public function extractRoleID(BSONDocument $bsonDocument): ?string
    {
        if (isset($bsonDocument['_id'])) {
            $idField = $bsonDocument['_id'];
            if ($idField instanceof ObjectId) {
                return (string) $idField;
            }
        }

        return null;
    }

    public function convertRoleIDtoRoleName(string $roleID){
        if (class_exists('MongoDB\BSON\ObjectId')) {
            $objectID = new ObjectId($roleID);
            return $this->collection->findOne(['_id' => $objectID])['name'];
        } else {
            return null;
        }
    }

}