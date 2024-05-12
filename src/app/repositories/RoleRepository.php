<?php

namespace app\repositories;

use MongoDB\Collection;
use MongoDB\BSON\ObjectId;

class RoleRepository
{
    private ?Collection $collection = null;

    public function __construct(Collection $roleCollection)
    {
        $this->collection = $roleCollection;
    }

    // Extract Methods
    public function extract_roleIDs_from_rolesArray($rolesArray)
    {
        $extractedRoleIDs = [];
        foreach ($rolesArray as $role) {
            if ($role['$id']) {
                $extractedRoleIDs[] = (string) $role['$id'];
            }
        }
        return $extractedRoleIDs;
    }

    // Conversion Methods
    public function convert_roleIDs_to_roleNames($roleIDs)
    {
        $convertedRoleNames = [];
        foreach ($roleIDs as $roleID) {
            $filter = ['_id' => new ObjectId($roleID)];
            $roleName = $this->collection->findOne($filter)['name'];
            if ($roleName) {
                $convertedRoleNames[] = $roleName;
            }
        }
        return $convertedRoleNames;
    }


    private function convert_roleName_to_DBRef(string $roleName)
    {
        $filter = ['name' => $roleName];
        return $this->collection->findOne($filter)['_id'];
    }
    public function convert_roleNames_to_DBRef(array $roleNames)
    {
        $DBRefs = [];

        foreach ($roleNames as $roleName) {
            $dbRef = [
                '$ref' => $this->collection->getCollectionName(),
                '$id' => $this->convert_roleName_to_DBRef($roleName)
            ];
            $DBRefs[] = $dbRef;
        }

        return $DBRefs;
    }

}