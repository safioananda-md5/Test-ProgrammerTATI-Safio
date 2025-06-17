<?php

use App\Http\Controllers\HelloworldController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HelloworldController::class, 'index']);
Route::post('/function-begin', [HelloworldController::class, 'processing'])->name('function-begin');
