<?php

use App\Http\Controllers\SuratController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==========================================
// PUBLIC ROUTES (No login required)
// ==========================================

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes (Login, Register, Logout)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Pages
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

Route::get('/beranda', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('welcome');
})->name('beranda');

// ==========================================
// PROTECTED ROUTES (Require Login)
// ==========================================

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{surat}', [SuratController::class, 'show'])->name('surat.show');

    // Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/surat', [SuratController::class, 'index'])->name('admin.surat');
        Route::put('/admin/surat/{surat}', [SuratController::class, 'update'])->name('admin.surat.update');

        // Data Sipil (Penduduk) Routes
        Route::post('/penduduk/import', [\App\Http\Controllers\PendudukController::class, 'import'])->name('penduduk.import');
        Route::resource('penduduk', \App\Http\Controllers\PendudukController::class);
    });
});