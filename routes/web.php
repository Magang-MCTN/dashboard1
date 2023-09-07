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
// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => 'admin-tim'], function () {
    // Rute-rute yang hanya dapat diakses oleh admin tim
    Route::get('/admin-tim', [AdminTimController::class, 'index'])->name('admintim');
    Route::get('/admin-tim/approve/{id}', [AdminTimController::class, 'approveRequest'])->name('approveRequest');
    Route::get('/admin-tim/reject/{id}', [AdminTimController::class, 'rejectRequest'])->name('rejectRequest');

    // ...
});
Route::group(['middleware' => 'admin-general'], function () {
    // Rute-rute yang hanya dapat diakses oleh admin tim
    Route::get('/admin-general', [AdminGeneralController::class, 'index'])->name('admingeneral');
    Route::get('/admin-general/approve/{id', [AdminGeneralController::class, 'index'])->name('approvegeneral');
    Route::get('/admin-general/reject/{id}', [AdminGeneralController::class, 'rejectRequest'])->name('rejectgeneral');
    // ...
});
Route::group(['middleware' => 'administrator'], function () {
    // Rute-rute yang hanya dapat diakses oleh admin tim
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    // ...
});
Route::get('/pengajuan-barang', [PengadaanBarangController::class, 'index'])->middleware('auth');
Route::post('/pengajuan-barang', [PengadaanBarangController::class, 'store'])->name('barang')->middleware('auth');
Route::get('/status-pengadaan', [PengadaanBarangController::class, 'status'])->middleware('auth');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk registrasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('registerform');
Route::post('/store', [AuthController::class, 'store'])->name('store');

// Rute untuk logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
