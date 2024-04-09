<?php

namespace app\core\database;

use Exception;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;
use RuntimeException;

class MongoDBManager{
    
    private static ?string $uri = null;
    private static ?Client $client = null;

    public static function initializeConfig(): void {
        $configFilePath = realpath(__DIR__ . '/../../../../config/mongodb.env');
        self::$uri = parse_ini_file($configFilePath)["MONGODB_URI"];
    }
    public static function setUri(string $uri){
        self::$uri = $uri; 
    }
    public static function getClient(): ?Client{
        if(!isset(self::$uri)){
            self::initializeConfig();
        }
        if(self::$client === null){
            try{
                self::$client = new Client(self::$uri);
                // Test Connection
                self::$client->listDatabases();
            } catch (Exception $e){
                return null;
            }
        }
        return self::$client;
    }
    public static function getDatabase(string $databaseName): ?Database{
        try{
            return self::getClient()->selectDatabase($databaseName);
        } catch (Exception $e){
            return null;
        }
    }
    public static function getCollection(string $databaseName, string $collectionName): ?Collection{
        try{
            return self::getDatabase($databaseName)->selectCollection($collectionName);
        } catch (Exception $e){
            return null;
        }
    }

}
