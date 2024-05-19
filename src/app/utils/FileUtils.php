<?php

namespace src\app\utils;

class FileUtils {

    public static function sanitizeFileName($filename) {
        return preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
    }

}
