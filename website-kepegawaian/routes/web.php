<?php

use App\Http\Controllers\ajaxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogharianController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsKepaladinas;
use Illuminate\Auth\Middleware\Authenticate;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// middleware admin
Route::middleware([
    Authenticate::class,
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/log-saya', [LogharianController::class, 'log_saya'])->name('log-saya');
    Route::post('/input-log-saya', [LogharianController::class, 'store'])->name('input-log-saya');
    Route::get('/get-log-saya', [LogharianController::class, 'get'])->name('get-log-saya');
});
