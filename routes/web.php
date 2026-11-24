<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UjiBladeController;

Route::get('/uji-blade', [UjiBladeController::class, 'index']);

use App\Http\Controllers\AkademikController;

Route::get('/beranda', [AkademikController::class, 'beranda']);
Route::get('/prodi', [AkademikController::class, 'prodi']);
Route::get('/dosen', [AkademikController::class, 'dosen']);


use App\Http\Controllers\MahasiswaController;

Route::get('/mahasiswa/tambah', [MahasiswaController::class, 'create']);
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])
    ->middleware('throttle:pendaftaran');
Route::get('/cek-nim', [MahasiswaController::class, 'cekNim'])
    ->middleware('throttle:cek-nim');


Route::get('/mahasiswa', [AkademikController::class, 'mahasiswa']);
Route::get('/mahasiswa/{mahasiswa}', [AkademikController::class, 'mahasiswaShow']);
Route::get('/mahasiswa/{mahasiswa}/ubah', [MahasiswaController::class, 'edit']);
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy']);

Route::get('/matkul', [AkademikController::class, 'matkul']);
Route::get('/matkul/{matkul}', [AkademikController::class, 'matkulShow']);
Route::get('/peringkat', [AkademikController::class, 'peringkat']);

use App\Http\Controllers\KantinController;

Route::get('/kantin', [KantinController::class, 'index']);
Route::get('/kantin/tentang', [KantinController::class, 'tentang']);
Route::get('/kantin/kosong', [KantinController::class, 'kosong']);

use App\Http\Controllers\LabController;

Route::get('/lab', [LabController::class, 'index']);
Route::get('/lab/{alat}', [LabController::class, 'show']);

use App\Http\Controllers\UkmController;

Route::get('/ukm', [UkmController::class, 'index']);
Route::get('/ukm/{ukm}', [UkmController::class, 'show']);
