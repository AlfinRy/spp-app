<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardSiswaController;
use App\Http\Controllers\DashboardPetugasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', [HomeController::class, 'index']);

// Auth::routes();

// Route::redirect('/', 'login');

Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('checkUser');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['checkLogin'])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'index']);
    // Dashboard Petugas
    Route::get('/dashboard-petugas', [DashboardPetugasController::class, 'index']);
    // Dashboard Petugas
    Route::get('/dashboard-siswa', [DashboardSiswaController::class, 'index']);

    // Siswa Admin
    Route::get('/table-siswa', [SiswaController::class, 'index']);
    Route::post('/table-siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::put('/table-siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/table-siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.delete');

    // Petugas Admin
    Route::get('/table-petugas', [PetugasController::class, 'index']);
    Route::post('/table-petugas', [PetugasController::class, 'store'])->name('petugas.store');
    Route::put('/table-petugas/{id}', [PetugasController::class, 'update'])->name('petugas.update');
    Route::delete('/table-petugas/{id}', [PetugasController::class, 'destroy'])->name('petugas.delete');

    // Kelas Admin
    Route::get('/table-kelas', [KelasController::class, 'index']);
    Route::post('/table-kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::put('/table-kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/table-kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.delete');

    // Jurusan Admin
    Route::get('/table-jurusan', [JurusanController::class, 'index']);
    Route::post('/table-jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::put('/table-jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/table-jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.delete');

    // Spp Admin
    Route::get('/table-spp', [SppController::class, 'index']);
    // Route::get('/spp-pdf', [PdfController::class, 'sppPdf'])->name('spp.pdf');
    Route::get('/spp-pdf', [PdfController::class, 'sppPdf'])->name('spp.pdf');
    Route::post('/table-spp', [SppController::class, 'store'])->name('spp.store');
    Route::post('/table-spp/{id}', [SppController::class, 'bayarSpp'])->name('spp.bayar');
    Route::put('/table-spp/{id}', [SppController::class, 'update'])->name('spp.update');
    Route::delete('/table-spp/{id}', [SppController::class, 'destroy'])->name('spp.delete');
});

Route::get('/table', [SiswaController::class, 'example']);
