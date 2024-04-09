<?php

namespace app\services\providers;

class PathService {
    public static string $basePath = 'codecademyre.com';

    public static function initializeBasePath(string $basePath) {
        self::$basePath = $basePath;
    }

    public static function getBasePath(): string {
        return self::$basePath;
    }
}
