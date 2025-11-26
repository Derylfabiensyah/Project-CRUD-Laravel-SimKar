<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JadwalKerjaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PenggajianController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('absensi', AbsensiController::class);
Route::resource('departemen', DepartemenController::class)->parameters([
    'departemen' => 'id_departemen'
]);
Route::resource('karyawan', KaryawanController::class)->parameters([
    'karyawan' => 'id_karyawan'
]);
Route::resource('jadwal_kerja', JadwalKerjaController::class);
Route::resource('event', EventController::class);
Route::resource('penggajian', PenggajianController::class);
