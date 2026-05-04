<?php
// 1. Bypass SEMUA file cache bawaan laptop (Laragon) yang nyangkut
$tmpVars = [
    'APP_SERVICES_CACHE', 
    'APP_PACKAGES_CACHE', 
    'APP_CONFIG_CACHE', 
    'APP_ROUTES_CACHE'
];

foreach ($tmpVars as $var) {
    $_ENV[$var] = '/tmp/' . $var . '.php';
    putenv($var . '=/tmp/' . $var . '.php');
}

// 2. Bikin folder khusus untuk nampung tampilan web (view) di memori Vercel
if (!is_dir('/tmp/views')) {
    mkdir('/tmp/views', 0777, true);
}
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/views';
putenv('VIEW_COMPILED_PATH=/tmp/views');

// 3. Tampilkan error beneran ke layar kalau masih ada yang nge-bug
ini_set('display_errors', '1');
error_reporting(E_ALL);

// 4. Buka pintu utama Laravel
require __DIR__ . '/../public/index.php';