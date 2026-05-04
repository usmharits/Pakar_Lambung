<?php
// Trik Sakti: Paksa Vercel & Laravel ngira ini aplikasi API
// Biar kalau ada error, keluarnya teks murni, bukan halaman HTML yang butuh view!
$_SERVER['HTTP_ACCEPT'] = 'application/json';

// Buka pintu utama bawaan Laravel
require __DIR__ . '/../public/index.php';