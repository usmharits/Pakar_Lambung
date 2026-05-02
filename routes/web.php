<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosaController;

Route::get('/', [DiagnosaController::class, 'index']);
Route::post('/diagnosa', [DiagnosaController::class, 'hitung'])->name('diagnosa.hitung');
