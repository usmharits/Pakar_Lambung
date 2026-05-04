<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

try {
    // Kita coba paksa masuk ke pintunya Laravel
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    // Kalau servernya crash, kita tangkap dan tampilin di layar!
    echo "<h1 style='color:red;'>BOS ADA ERROR NIH:</h1>";
    echo "<p><strong>Pesan:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>File:</strong> " . $e->getFile() . " (Baris: " . $e->getLine() . ")</p>";
    echo "<h3>Detail Trace:</h3>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}