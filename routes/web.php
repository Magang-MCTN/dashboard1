<?php

use App\Http\Controllers\AdminGeneralController;
use App\Http\Controllers\AdminTimController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengadaanBarangController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/signature', [DashboardController::class, 'signature'])->name('signature')->middleware('auth');
Route::post('/signature/upload', [DashboardController::class, 'store'])->name('signature.store')->middleware('auth');


// Rute untuk memproses unggahan tanda tangan

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => 'admin-tim'], function () {
    // Rute-rute yang hanya dapat diakses oleh admin tim
    Route::get('/admin-tim', [AdminTimController::class, 'index'])->name('admintim');
    Route::get('/admin-tim/detail/{id}', [AdminTimController::class, 'detail'])->name('admin-tim.detail');
    Route::post('/admin-tim/approve/{id}', [AdminTimController::class, 'approveRequest'])->name('approveRequest');
    Route::post('/admin-tim/reject/{id}', [AdminTimController::class, 'rejectRequest'])->name('rejectRequest');

    // ...
});
Route::group(['middleware' => 'admin-general'], function () {
    // Rute-rute yang hanya dapat diakses oleh admin tim
    Route::get('/admin-general', [AdminGeneralController::class, 'index'])->name('admingeneral');
    Route::post('/admin-general/approve/{id}', [AdminGeneralController::class, 'approveRequesta'])->name('admin-general.approve');
    Route::post('/admin-general/reject/{id}', [AdminGeneralController::class, 'rejectRequesta'])->name('admin-general.reject');
    // ...
});
Route::group(['middleware' => 'administrator'], function () {
    // Rute-rute yang hanya dapat diakses oleh admin tim
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    // ...
});
Route::get('/pengajuan-barang', [PengadaanBarangController::class, 'index'])->name('pengajuan-barang')->middleware('auth');
Route::post('/pengajuan-barang', [PengadaanBarangController::class, 'store'])->name('barang')->middleware('auth');
Route::get('/status-pengadaan', [PengadaanBarangController::class, 'status'])->name('status-pengadaan')->middleware('auth');
Route::get('/status-pengadaan/{id}', [PengadaanBarangController::class, 'detail'])->name('detail')->middleware('auth');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk registrasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('registerform');
Route::post('/store', [AuthController::class, 'store'])->name('store');

// Rute untuk logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
