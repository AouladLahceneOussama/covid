<?php

$envFilePath = dirname(__DIR__) . '/.env';

if (file_exists($envFilePath)) {
    $envContent = file_get_contents($envFilePath);
    $envRows = explode("\n", $envContent);

    foreach ($envRows as $row) {
        if (empty($row) || substr($row, 0, 1) === '#') continue;

        [$key, $value] = explode('=', $row);
        if (isset($key) && isset($value)) {
            $_ENV[trim($key)] = trim($value);
        }
    }
}
