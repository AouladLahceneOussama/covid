<?php

$envFilePath = dirname(__DIR__) . '/.env';

if (file_exists($envFilePath)) {
    $envContent = file_get_contents($envFilePath);
    $envRows = explode("\n", $envContent);

    foreach ($envRows as $row) {
        if (empty($row) || substr($row, 0, 1) === '#') continue;

        $keyValue = explode('=', $row);
        if (isset($keyValue[0])) {
            $_ENV[trim($keyValue[0])] = trim($keyValue[1] ?? "");
        }
    }
}
