<?php
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

ini_set('display_errors', '1');
error_reporting(E_ALL);

try {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';

    // JURUS PAMUNGKAS: Paksa Laravel pakai folder /tmp buat semua storage-nya
    $app->useStoragePath('/tmp');

    $request = Request::capture();
    $app->handleRequest($request);
} catch (\Throwable $e) {
    echo "<h1 style='color:red;'>BOS ADA ERROR NIH:</h1>";
    echo "<p><strong>Pesan:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>File:</strong> " . $e->getFile() . " (Baris: " . $e->getLine() . ")</p>";
    echo "<h3>Detail Trace:</h3>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}