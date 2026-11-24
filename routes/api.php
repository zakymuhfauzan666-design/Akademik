<?php

use App\Http\Controllers\Api\MahasiswaController;
use Illuminate\Support\Facades\Route;

// Semua route di file ini otomatis memakai prefix /api (diatur di bootstrap/app.php)
Route::apiResource('mahasiswa', MahasiswaController::class);