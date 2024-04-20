<?php

namespace app\utils;

use RuntimeException;

class PublicUI {
    public static function renderFooter() {
        $footerPath = realpath(__DIR__ . '/../components/public/footer.php');
        if (is_readable($footerPath)) {
            include $footerPath;
        } else {
            throw new RuntimeException("Footer file not found or inaccessible.");
        }
    }
    public static function renderHeader() {
        $headerPath = realpath(__DIR__ . '/../components/public/header.php');
        if (is_readable($headerPath)) {
            include $headerPath;
        } else {
            throw new RuntimeException("Header file not found or inaccessible.");
        }
    }
}