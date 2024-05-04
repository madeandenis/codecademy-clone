<?php

namespace app\utils;

header('Content-Type: video/mp4');

class StreamVideo {
    public static string $uploadsPath;

    public static function init() {
        self::$uploadsPath = realpath(__DIR__ . '/../uploads') . '/';
    }

    public static function streamVideo($video_src) {
        if (!isset(self::$uploadsPath)) {
            self::init();
        }

        $videoFilePath = self::$uploadsPath . $video_src;
        if (file_exists($videoFilePath)) {
            readfile($videoFilePath);
        } else {
            http_response_code(404);
            echo "Video not found";
        }
    }
}