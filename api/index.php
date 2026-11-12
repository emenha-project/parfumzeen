<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Setup writable storage directory in /tmp for Vercel Serverless environment
$storagePath = '/tmp/storage';
$directories = [
    $storagePath . '/app/public',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/logs',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

putenv("APP_STORAGE={$storagePath}");
putenv("VIEW_COMPILED_PATH={$storagePath}/framework/views");

// Handle SQLite database in /tmp if using SQLite
$dbConn = getenv('DB_CONNECTION') ?: 'sqlite';
if ($dbConn === 'sqlite') {
    $tmpDb = '/tmp/database.sqlite';
    if (!file_exists($tmpDb) || filesize($tmpDb) === 0) {
        $sourceDb = __DIR__ . '/../database/database.sqlite';
        if (file_exists($sourceDb)) {
            @copy($sourceDb, $tmpDb);
        } else {
            @touch($tmpDb);
        }
    }
    putenv("DB_DATABASE={$tmpDb}");
    $_ENV['DB_DATABASE'] = $tmpDb;
}

// Register autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var \Illuminate\Foundation\Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath($storagePath);

try {
    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>ZEEN PARFUM - Diagnostik Server</h1>";
    echo "<p><strong>Pesan Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
