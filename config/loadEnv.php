<?php
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        throw new RuntimeException("The .env file does not exist at $filePath");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Skip comments
        }

        $keyValue = explode('=', $line, 2);
        if (count($keyValue) === 2) {
            $key = trim($keyValue[0]);
            $value = trim($keyValue[1]);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}
