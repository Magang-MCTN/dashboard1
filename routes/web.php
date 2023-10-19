<?php

use App\Http\Controllers\AdminGeneralController;
use App\Http\Controllers\AdminManagerController;
use App\Http\Controllers\AdminTimController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengadaanBarangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Mail;
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
Route::get('/generate-pdf', [DashboardController::class, 'store'])->name('signature.store')->middleware('auth');
Route::get('/generate-pdf', [PengadaanBarangController::class, 'generatePengajuanBarangPdf'])->name('generatepdf')->middleware('auth');
Route::get('/generate-pdf/{id}', [PengadaanBarangController::class, 'generatePdf'])->name('generatepdfid')->middleware('auth');
Route::get('/chart-data', [DashboardController::class, 'getChartData'])->name('getChartData');



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
//administrtor
Route::group(['middleware' => 'administrator'], function () {
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/{id}', [AdminUserController::class, 'detail'])->name('admin.users.detail');
});

Route::middleware(['auth', 'admin.tim.redirect'])->group(function () {
    // Rute-rute yang hanya dapat diakses oleh admin tim setelah login
    Route::get('/admin-tim/detail1/{id}', [AdminTimController::class, 'detail'])->name('persetujuan-barang');
    // Tambahkan rute-rute lain yang hanya dapat diakses oleh admin tim di sini
});


Route::group(['middleware' => 'admin-general'], function () {
    // Rute-rute yang hanya dapat diakses oleh admin tim
    Route::get('/admin-general', [AdminGeneralController::class, 'index'])->name('admingeneral');
    Route::post('/admin-general/approve/{id}', [AdminGeneralController::class, 'approveRequesta'])->name('admin-general.approve');
    Route::post('/admin-general/reject/{id}', [AdminGeneralController::class, 'rejectRequesta'])->name('admin-general.reject');
    Route::get('/admin-general/detail/{id}', [AdminGeneralController::class, 'detail'])->name('admin-general.detail');
    // ...
});
Route::group(['middleware' => 'admin-manager'], function () {
    // Rute-rute yang hanya dapat diakses oleh admin tim
    Route::get('/admin-manager', [AdminManagerController::class, 'index'])->name('adminmanager');
    Route::post('/admin-manager/approve/{id}', [AdminmanagerController::class, 'approveRequestas'])->name('admin-manager.approve');
    Route::post('/admin-manager/reject/{id}', [AdminmanagerController::class, 'rejectRequestas'])->name('admin-manager.reject');
    Route::get('/admin-manager/detail/{id}', [AdminmanagerController::class, 'detail'])->name('admin-manager.detail');
    // ...
});
// Route::group(['middleware' => 'administrator'], function () {
//     // Rute-rute yang hanya dapat diakses oleh admin tim
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin');
//     // ...
// });
Route::get('/pengajuan-barang', [PengadaanBarangController::class, 'index'])->name('pengajuan-barang')->middleware('auth');
Route::post('/pengajuan-barang', [PengadaanBarangController::class, 'store'])->name('barang')->middleware('auth');
Route::get('/status-pengadaan', [PengadaanBarangController::class, 'status'])->name('status-pengadaan')->middleware('auth');
Route::get('/pengadaan', [PengadaanBarangController::class, 'status'])->name('pengadaan.index')->middleware('auth');
Route::get('/status', [PengadaanBarangController::class, 'status'])->name('status')->middleware('auth');
Route::get('/pengajuan/{id}/edit', [PengadaanBarangController::class, 'edit'])->name('edit')->middleware('auth');
Route::get('/pengadaan/hapus/{id}', [PengadaanBarangController::class, 'delete'])->name('pengadaan.delete')->middleware('auth');

// Route::get('/pengajuan/{id}/ajukan-ulang', [PengadaanBarangController::class, 'ajukanUlang'])->name('ajukanUlang')->middleware('auth');
Route::put('/pengajuan/{id}/ajukan-ulang', [PengadaanBarangController::class, 'ajukanUlang'])->name('ajukanUlang')->middleware('auth');

Route::get('/status-pengadaan/{id}', [PengadaanBarangController::class, 'detail'])->name('detail')->middleware('auth');
//Profile
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware('auth');

Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('signatures')->middleware('auth');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk registrasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('registerform');
Route::post('/store', [AuthController::class, 'store'])->name('store');

// Rute untuk logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/redirect', [AuthController::class, 'redirectToProvider']);
Route::get('/google/callback', [AuthController::class, 'handleProviderCallback']);


// tes notif
// Route::get('/notif', function () {
//     $user = \app\User::first();
//     $user->notify(new \App\Notifications\Daftar);
// });
// Route::get('/notif', function () {
//     $user = \App\Models\User::first();
//     $user->notify(new \App\Notifications\Daftar);
// });
