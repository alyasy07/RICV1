<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SimplePasswordResetController;
use App\Http\Controllers\SimplePasswordChangeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\ManageProfileController;
use App\Http\Controllers\Admin\GeranPenyelidikanController;
use App\Http\Controllers\Admin\GeranPadananController;
use App\Http\Controllers\Admin\GeranIndustriController;
use App\Http\Controllers\Admin\PerundinganController;
use App\Http\Controllers\Admin\KajianKesController;
use App\Http\Controllers\Admin\MoaMouController;
use App\Http\Controllers\Admin\PenerbitanPenulisanController;
use App\Http\Controllers\Admin\GlobalAntarabangsaController;
use App\Http\Controllers\Admin\InovasiPengkomersilanController;
use App\Http\Controllers\Admin\PenyelidikanKeusahawananController;
use App\Http\Controllers\Admin\PengarahController;


// Welcome page route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Test chart routes
Route::get('/test-chart', function () {
    return view('Admin.test_chart');
})->name('test.chart');

Route::get('/test-dashboard', [App\Http\Controllers\Admin\TestChartController::class, 'showTestDashboard'])->name('test.dashboard');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Simple Password Reset Routes
Route::get('/forgot-password', [SimplePasswordResetController::class, 'showForgotForm'])
    ->name('password.request');
Route::post('/forgot-password', [SimplePasswordResetController::class, 'sendResetLink'])
    ->name('simple.password.email');
Route::get('/reset-password/{token}', [SimplePasswordResetController::class, 'showResetForm'])
    ->name('simple.password.reset');
Route::post('/reset-password', [SimplePasswordResetController::class, 'resetPassword'])
    ->name('simple.password.update');

// Simple Password Change Routes (single page)
Route::get('/change-password', [SimplePasswordChangeController::class, 'showChangeForm'])
    ->name('simple.password.change.form');
Route::post('/change-password', [SimplePasswordChangeController::class, 'changePassword'])
    ->name('simple.password.change');

// Fallback route for /home and /dashboard - redirect to admin dashboard
Route::get('/home', function () {
    return auth()->check() ? redirect()->route('admin.dashboard') : redirect()->route('login');
})->middleware('auth');

Route::get('/dashboard', function () {
    return auth()->check() ? redirect()->route('admin.dashboard') : redirect()->route('login');
})->middleware('auth');

// Admin routes - Admin only system
Route::prefix('admin')
     ->name('admin.')
     ->middleware('auth')
     ->group(function () {
         // Dashboard
         Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

         // Profile Management Routes
         Route::get('manage-profile', [ManageProfileController::class, 'index'])->name('manageProfile');
         Route::put('manage-profile', [ManageProfileController::class, 'update'])->name('updateProfile');

         // Geran Penyelidikan Routes
         Route::get('geran-penyelidikan', [GeranPenyelidikanController::class, 'index'])->name('geranpenyelidikan');
         Route::get('geran-penyelidikan/data', [GeranPenyelidikanController::class, 'getData'])->name('geranpenyelidikan.data');
         Route::post('geran-penyelidikan', [GeranPenyelidikanController::class, 'store'])->name('geranpenyelidikan.store');
         Route::get('geran-penyelidikan/{id}/edit', [GeranPenyelidikanController::class, 'edit'])->name('geranpenyelidikan.edit');
         Route::put('geran-penyelidikan/{id}', [GeranPenyelidikanController::class, 'update'])->name('geranpenyelidikan.update');
         Route::delete('geran-penyelidikan/{id}', [GeranPenyelidikanController::class, 'destroy'])->name('geranpenyelidikan.destroy');

         // Geran Padanan Routes
         Route::get('geran-padanan', [GeranPadananController::class, 'index'])->name('geranpadanan');
         Route::get('geran-padanan/data', [GeranPadananController::class, 'getData'])->name('geranpadanan.data');
         Route::post('geran-padanan', [GeranPadananController::class, 'store'])->name('geranpadanan.store');
         Route::get('geran-padanan/{id}/edit', [GeranPadananController::class, 'edit'])->name('geranpadanan.edit');
         Route::put('geran-padanan/{id}', [GeranPadananController::class, 'update'])->name('geranpadanan.update');
         Route::delete('geran-padanan/{id}', [GeranPadananController::class, 'destroy'])->name('geranpadanan.destroy');

         // Geran Industri Routes
         Route::get('geran-industri', [GeranIndustriController::class, 'index'])->name('granindustri');
         Route::get('geran-industri/data', [GeranIndustriController::class, 'getData'])->name('granindustri.data');
         Route::post('geran-industri', [GeranIndustriController::class, 'store'])->name('granindustri.store');
         Route::get('geran-industri/{id}/edit', [GeranIndustriController::class, 'edit'])->name('granindustri.edit');
         Route::put('geran-industri/{id}', [GeranIndustriController::class, 'update'])->name('granindustri.update');
         Route::delete('geran-industri/{id}', [GeranIndustriController::class, 'destroy'])->name('granindustri.destroy');

         // Perundingan Routes
         Route::get('perundingan', [PerundinganController::class, 'index'])->name('perundingan');
         Route::get('perundingan/data', [PerundinganController::class, 'getData'])->name('perundingan.data');
         Route::post('perundingan', [PerundinganController::class, 'store'])->name('perundingan.store');
         Route::get('perundingan/{id}/edit', [PerundinganController::class, 'edit'])->name('perundingan.edit');
         Route::put('perundingan/{id}', [PerundinganController::class, 'update'])->name('perundingan.update');
         Route::delete('perundingan/{id}', [PerundinganController::class, 'destroy'])->name('perundingan.destroy');

         // Kajian Kes Routes
         Route::get('kajian-kes', [KajianKesController::class, 'index'])->name('kajiankes');
         Route::get('kajian-kes/data', [KajianKesController::class, 'getData'])->name('kajiankes.data');
         Route::post('kajian-kes', [KajianKesController::class, 'store'])->name('kajiankes.store');
         Route::get('kajian-kes/{id}/edit', [KajianKesController::class, 'edit'])->name('kajiankes.edit');
         Route::put('kajian-kes/{id}', [KajianKesController::class, 'update'])->name('kajiankes.update');
         Route::delete('kajian-kes/{id}', [KajianKesController::class, 'destroy'])->name('kajiankes.destroy');

         // MoA/MoU Routes
         Route::get('moa-mou', [MoaMouController::class, 'index'])->name('moamou');
         Route::get('moa-mou/data', [MoaMouController::class, 'getData'])->name('moamou.data');
         Route::post('moa-mou', [MoaMouController::class, 'store'])->name('moamou.store');
         Route::get('moa-mou/{id}/edit', [MoaMouController::class, 'edit'])->name('moamou.edit');
         Route::put('moa-mou/{id}', [MoaMouController::class, 'update'])->name('moamou.update');
         Route::delete('moa-mou/{id}', [MoaMouController::class, 'destroy'])->name('moamou.destroy');

         // Penerbitan dan Penulisan Kreatif Routes
         Route::get('penerbitan-penulisan', [PenerbitanPenulisanController::class, 'index'])->name('penerbitanpenulisan');
         Route::get('penerbitan-penulisan/data', [PenerbitanPenulisanController::class, 'getData'])->name('penerbitanpenulisan.data');
         Route::post('penerbitan-penulisan', [PenerbitanPenulisanController::class, 'store'])->name('penerbitanpenulisan.store');
         Route::get('penerbitan-penulisan/{id}/edit', [PenerbitanPenulisanController::class, 'edit'])->name('penerbitanpenulisan.edit');
         Route::put('penerbitan-penulisan/{id}', [PenerbitanPenulisanController::class, 'update'])->name('penerbitanpenulisan.update');
         Route::delete('penerbitan-penulisan/{id}', [PenerbitanPenulisanController::class, 'destroy'])->name('penerbitanpenulisan.destroy');
         
         // Global dan Pengantarabangsaan Routes
         Route::get('global-antarabangsa', [GlobalAntarabangsaController::class, 'index'])->name('globalantarabangsa');
         Route::get('global-antarabangsa/data', [GlobalAntarabangsaController::class, 'getData'])->name('globalantarabangsa.data');
         Route::post('global-antarabangsa', [GlobalAntarabangsaController::class, 'store'])->name('globalantarabangsa.store');
         Route::get('global-antarabangsa/{id}/edit', [GlobalAntarabangsaController::class, 'edit'])->name('globalantarabangsa.edit');
         Route::put('global-antarabangsa/{id}', [GlobalAntarabangsaController::class, 'update'])->name('globalantarabangsa.update');
         Route::delete('global-antarabangsa/{id}', [GlobalAntarabangsaController::class, 'destroy'])->name('globalantarabangsa.destroy');
         
         // Inovasi dan Pengkomersilan Routes
         Route::get('inovasi-pengkomersilan', [InovasiPengkomersilanController::class, 'index'])->name('inovasipengkomersilan');
         Route::get('inovasi-pengkomersilan/data', [InovasiPengkomersilanController::class, 'getData'])->name('inovasipengkomersilan.data');
         Route::post('inovasi-pengkomersilan', [InovasiPengkomersilanController::class, 'store'])->name('inovasipengkomersilan.store');
         Route::get('inovasi-pengkomersilan/edit/{id}', [InovasiPengkomersilanController::class, 'edit'])->name('inovasipengkomersilan.edit');
         Route::post('inovasi-pengkomersilan/update/{id}', [InovasiPengkomersilanController::class, 'update'])->name('inovasipengkomersilan.update');
         Route::post('inovasi-pengkomersilan/delete/{id}', [InovasiPengkomersilanController::class, 'destroy'])->name('inovasipengkomersilan.destroy');

         // Penyelidikan dan Keusahawanan Routes
         Route::get('penyelidikan-keusahawanan', [PenyelidikanKeusahawananController::class, 'index'])->name('penyelidikankeusahawanan');
         Route::get('penyelidikan-keusahawanan/data', [PenyelidikanKeusahawananController::class, 'getData'])->name('penyelidikankeusahawanan.data');
         Route::post('penyelidikan-keusahawanan', [PenyelidikanKeusahawananController::class, 'store'])->name('penyelidikankeusahawanan.store');
         Route::get('penyelidikan-keusahawanan/edit/{id}', [PenyelidikanKeusahawananController::class, 'edit'])->name('penyelidikankeusahawanan.edit');
         Route::post('penyelidikan-keusahawanan/update/{id}', [PenyelidikanKeusahawananController::class, 'update'])->name('penyelidikankeusahawanan.update');
         Route::post('penyelidikan-keusahawanan/delete/{id}', [PenyelidikanKeusahawananController::class, 'destroy'])->name('penyelidikankeusahawanan.destroy');

         // Pengarah Routes
         Route::get('pengarah', [PengarahController::class, 'index'])->name('pengarah');
         Route::get('pengarah/data', [PengarahController::class, 'getData'])->name('pengarah.data');
         Route::post('pengarah', [PengarahController::class, 'store'])->name('pengarah.store');
         Route::get('pengarah/edit/{id}', [PengarahController::class, 'edit'])->name('pengarah.edit');
         Route::post('pengarah/update/{id}', [PengarahController::class, 'update'])->name('pengarah.update');
         Route::post('pengarah/delete/{id}', [PengarahController::class, 'destroy'])->name('pengarah.destroy');

         // User Management Routes
         Route::get('manage-users', [ManageUserController::class, 'index'])->name('manageUser');
         Route::post('users/store', [ManageUserController::class, 'store'])->name('users.store');
         Route::put('users/{user}/update', [ManageUserController::class, 'update'])->name('users.update');
         Route::delete('users/{user}', [ManageUserController::class, 'destroy'])->name('users.destroy');
     });