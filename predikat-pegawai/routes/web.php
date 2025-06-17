<?php

use App\Http\Controllers\PredikatController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PredikatController::class, 'index']);
Route::get('/get_pegawai', [PredikatController::class, 'get_pegawai'])->name('get_pegawai');
Route::post('/edit_pegawai', [PredikatController::class, 'edit_pegawai'])->name('edit_pegawai');
Route::get('/pegawai/show/{id}', [PredikatController::class, 'show'])->name('pegawai_show');
Route::post('/input_kinerja', [PredikatController::class, 'input']);