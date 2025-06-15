<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogharianController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/log-harian', [LogharianController::class, 'index']);
Route::post('/log-harian', [LogharianController::class, 'create']);