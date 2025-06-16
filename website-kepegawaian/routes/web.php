<?php

use App\Http\Controllers\ajaxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogharianController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsKepalabagian;
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
    Route::get('/input-log-saya', function () {
        return redirect('/log-saya');
    });
    Route::post('/input-log-saya', [LogharianController::class, 'store'])->name('input-log-saya');
    Route::get('/get-log-saya', [LogharianController::class, 'get'])->name('get-log-saya');
    Route::get('/log-harian/show/{id}', [LogharianController::class, 'show'])->name('log-harian.show');
    Route::post('/update-log-saya', [LogharianController::class, 'update']);
    Route::get('/get-notifikasi', [NotifikasiController::class, 'getNotif'])->name('get.notifikasi');
});

Route::middleware([
    IsAdmin::class,
])->group(function () {
    Route::get('/admin/log-manajemen', [LogharianController::class, 'log_manajemen'])->name('admin-log-manajemen');
    Route::get('/admin/get-log-pegawai', [LogharianController::class, 'admin_get_log_pegawai'])->name('admin-get-log-pegawai');
    Route::post('/admin/setujui-log-pegawai', [LogharianController::class, 'admin_setujui_log_pegawai'])->name('admin_setuju');
    Route::post('/admin/tolak-log-pegawai', [LogharianController::class, 'admin_tolak_log_pegawai'])->name('admin_tolak');
});

Route::middleware([
    IsKepaladinas::class,
])->group(function () { 
    Route::get('/kepaladinas/log-manajemen', [LogharianController::class, 'log_manajemen'])->name('kepaladinas-log-manajemen');
    Route::get('/kepaladinas/get-log-pegawai', [LogharianController::class, 'get_log_pegawai'])->name('kepaladinas-get-log-pegawai');
    Route::post('/kepaladinas/setujui-log-pegawai', [LogharianController::class, 'setujui_log_pegawai'])->name('kepaladinas_setuju');
    Route::post('/kepaladinas/tolak-log-pegawai', [LogharianController::class, 'tolak_log_pegawai'])->name('kepaladinas_tolak');
});

Route::middleware([
    IsKepalabagian::class,
])->group(function () {
    Route::get('/kepalabagian/log-manajemen', [LogharianController::class, 'log_manajemen'])->name('kepalbagian-log-manajemen');
    Route::get('/kepalabagian/get-log-pegawai', [LogharianController::class, 'kepalabagian_get_log_pegawai'])->name('kepalabagian-get-log-pegawai');
    Route::post('/kepalabagian/setujui-log-pegawai', [LogharianController::class, 'kepalabagian_setujui_log_pegawai'])->name('kepalabagian_setuju');
    Route::post('/kepalabagian/tolak-log-pegawai', [LogharianController::class, 'kepalabagian_tolak_log_pegawai'])->name('kepalabagian_tolak');
});