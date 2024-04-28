<?php

namespace app\services\providers;

class PathService {
    private static string $basePath = 'codecademyre.com';

    public static function getBasePath(): string {
        return self::$basePath;
    }
}
