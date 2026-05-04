<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosaController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [DiagnosaController::class, 'index']);
Route::post('/diagnosa', [DiagnosaController::class, 'hitung'])->name('diagnosa.hitung');

Route::get('/setup-database', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);
        return 'Alhamdulillah, Migrasi & Seeding Sukses!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});