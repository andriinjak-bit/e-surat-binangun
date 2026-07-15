<?php

use App\Http\Controllers\SuratController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AdminSimpleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==========================================
// PUBLIC ROUTES (No login required)
// ==========================================

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes (Login, Register, Logout) - Regular Users
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Registration Routes (no auth required)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/register', [AuthController::class, 'showAdminRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'adminRegister']);
    Route::get('/login', function () {
        return view('admin.login');
    })->name('login');
});

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

// Simple Admin Login Routes
Route::get('/admin-login', function () {
    return view('admin.simple-login');
})->name('admin.simple.login.form');

Route::post('/admin-login', [AdminSimpleController::class, 'login'])->name('admin.simple.login');
Route::post('/admin-logout', [AdminSimpleController::class, 'logout'])->name('admin.simple.logout');
Route::get('/admin-dashboard', [AdminSimpleController::class, 'dashboard'])->name('admin.simple.dashboard');

// ==========================================
// PROTECTED ROUTES (Require Login)
// ==========================================

Route::middleware(['auth'])->group(function () {
    
    // ==========================================
    // PROFILE ROUTES
    // ==========================================
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // ==========================================
    // USER DASHBOARD
    // ==========================================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ==========================================
    // SURAT (User)
    // ==========================================
    Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{surat}', [SuratController::class, 'show'])->name('surat.show');

    // ==========================================
    // ADMIN ROUTES (Require Admin Role)
    // ==========================================
    
    Route::middleware(['admin'])->group(function () {
        
        // Admin Dashboard
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Admin User Management
        Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
        Route::post('/admin/users/{user}/toggle-admin', [AdminDashboardController::class, 'toggleAdmin'])->name('admin.users.toggle-admin');
        Route::post('/admin/users/{user}/toggle-active', [AdminDashboardController::class, 'toggleActive'])->name('admin.users.toggle-active');
        Route::delete('/admin/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');

        // Admin Surat Management
        Route::get('/admin/surat', [SuratController::class, 'index'])->name('admin.surat');
        Route::put('/admin/surat/{surat}', [SuratController::class, 'update'])->name('admin.surat.update');

        // DATA SIPIL (PENDUDUK) ROUTES
        Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk.index');
        Route::get('/penduduk/create', [PendudukController::class, 'create'])->name('penduduk.create');
        Route::post('/penduduk', [PendudukController::class, 'store'])->name('penduduk.store');
        Route::get('/penduduk/{penduduk}/edit', [PendudukController::class, 'edit'])->name('penduduk.edit');
        Route::put('/penduduk/{penduduk}', [PendudukController::class, 'update'])->name('penduduk.update');
        Route::delete('/penduduk/{penduduk}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');
        Route::post('/penduduk/import', [PendudukController::class, 'import'])->name('penduduk.import');
    });
});