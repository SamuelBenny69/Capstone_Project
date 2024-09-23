<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\GajiKaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::pattern('id','[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/login', [AuthController::class,'postlogin']);
Route::get('/logout', [AuthController::class,'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::group(['prefix' => 'jabatan'], function () {
        Route::get('/', [JabatanController::class, 'index']);          // menampilkan halaman awal jabatan
        Route::post('/list', [JabatanController::class, 'list']);      // menampilkan data jabatan dalam bentuk json untuk datatables
        Route::get('/create', [JabatanController::class, 'create']);   // menampilkan halaman form tambah jabatan
        Route::post('/', [JabatanController::class, 'store']);         // menyimpan data jabatan baru
        Route::get('/{id}', [JabatanController::class, 'show']);       // menampilkan detail jabatan
        Route::get('/{id}/edit', [JabatanController::class, 'edit']);  // menampilkan halaman form edit jabatan
        Route::put('/{id}', [JabatanController::class, 'update']);     // menyimpan perubahan data jabatan
        Route::delete('/{id}', [JabatanController::class, 'destroy']);
    });

    Route::group(['prefix' => 'karyawan'], function () {
        Route::get('/', [KaryawanController::class, 'index']);          // menampilkan halaman awal karyawan
        Route::post('/list', [KaryawanController::class, 'list']);      // menampilkan data karyawan dalam bentuk json untuk datatables
        Route::get('/create', [KaryawanController::class, 'create']);   // menampilkan halaman form tambah karyawan
        Route::post('/', [KaryawanController::class, 'store']);         // menyimpan data karyawan baru
        Route::get('/{id}', [KaryawanController::class, 'show']);       // menampilkan detail karyawan
        Route::get('/{id}/edit', [KaryawanController::class, 'edit']);  // menampilkan halaman form edit karyawan
        Route::put('/{id}', [KaryawanController::class, 'update']);     // menyimpan perubahan data karyawan
        Route::delete('/{id}', [KaryawanController::class, 'destroy']);
    });

    Route::group(['prefix' => 'gaji'], function () {
        Route::get('/', [GajiController::class, 'index']);          // menampilkan halaman awal karyawan
        Route::post('/list', [GajiController::class, 'list']);      // menampilkan data karyawan dalam bentuk json untuk datatables
        Route::get('/create', [GajiController::class, 'create']);   // menampilkan halaman form tambah karyawan
        Route::post('/', [GajiController::class, 'store']);         // menyimpan data karyawan baru
        Route::get('/{id}', [GajiController::class, 'show']);       // menampilkan detail karyawan
        Route::get('/{id}/edit', [GajiController::class, 'edit']);  // menampilkan halaman form edit karyawan
        Route::put('/{id}', [GajiController::class, 'update']);     // menyimpan perubahan data karyawan
        Route::delete('/{id}', [GajiController::class, 'destroy']);
    });

    Route::group(['prefix' => 'gaji-karyawan'], function () {
        Route::get('/', [GajiKaryawanController::class, 'index']);          // menampilkan halaman awal karyawan
        Route::post('/list', [GajiKaryawanController::class, 'list']);      // menampilkan data karyawan dalam bentuk json untuk datatables
        Route::get('/create', [GajiKaryawanController::class, 'create']);   // menampilkan halaman form tambah karyawan
        Route::post('/', [GajiKaryawanController::class, 'store']);         // menyimpan data karyawan baru
        Route::get('/get-gaji/{karyawanId}', [GajiKaryawanController::class, 'getGaji']);
        Route::get('/{id}', [GajiKaryawanController::class, 'show']);       // menampilkan detail karyawan
        Route::get('/{id}/edit', [GajiKaryawanController::class, 'edit']);  // menampilkan halaman form edit karyawan
        Route::put('/{id}', [GajiKaryawanController::class, 'update']);     // menyimpan perubahan data karyawan
        Route::delete('/{id}', [GajiKaryawanController::class, 'destroy']);
    });

    Route::group(['prefix' => 'absen'], function () {
        Route::get('/', [AbsenController::class, 'index']);
        Route::post('/list', [AbsenController::class, 'list']);
        Route::get('/hadir/{id}', [AbsenController::class, 'hadir']);
        Route::get('/alpha/{id}', [AbsenController::class, 'alpha']);
        Route::get('/sakit/{id}', [AbsenController::class, 'sakit']);
        Route::get('/ijin/{id}', [AbsenController::class, 'ijin']);
    });


    Route::group(['prefix' => 'laporan'], function () {
        Route::get('/', [LaporanController::class, 'index']);
        Route::get('/cetakLaporanGaji', [LaporanController::class, 'laporanGaji']);
        Route::get('/cetakLaporanAbsen', [LaporanController::class, 'laporanAbsens']);
    });
});

