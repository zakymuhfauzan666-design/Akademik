<?php

use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\MataKuliahController;
use Illuminate\Support\Facades\Route;

Route::apiResource('mahasiswa', MahasiswaController::class);
Route::apiResource('matkul', MataKuliahController::class)->only(['index', 'show', 'store']);