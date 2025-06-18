<?php

use App\Http\Controllers\WilayahIndonesiaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/halo', function(){
    dd("Testing API Berhasil");
});

Route::get('/reset-database', [WilayahIndonesiaController::class, 'ResetDatabase']);
Route::get('/provinsi', [WilayahIndonesiaController::class, 'get_provinsi']);
Route::get('/provinsi/{code}', [WilayahIndonesiaController::class, 'detail_provinsi']);
Route::post('/provinsi', [WilayahIndonesiaController::class, 'create_provinsi']);
Route::put('/provinsi/{code}', [WilayahIndonesiaController::class, 'update_provinsi']);
Route::delete('/provinsi/{code}', [WilayahIndonesiaController::class, 'delete_provinsi']);