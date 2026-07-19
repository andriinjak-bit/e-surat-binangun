<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\SuratCommentController; // <-- ADD THIS LINE
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==========================================
// PUBLIC ROUTES
// ==========================================

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/register', [AuthController::class, 'showAdminRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'adminRegister']);
    Route::get('/login', function () {
        return view('admin.login');
    })->name('login');
});

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/layanan', function () {
    $templates = \App\Models\SuratTemplate::all();
    return view('layanan', compact('templates'));
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

    // COMMENT ROUTES
    Route::post('/surat/{surat}/comment', [SuratCommentController::class, 'store'])->name('surat.comment.store');
    Route::delete('/comment/{comment}', [SuratCommentController::class, 'destroy'])->name('comment.destroy');
    Route::post('/comment/{comment}/read', [SuratCommentController::class, 'markAsRead'])->name('comment.mark-read');
    
    // PROFILE
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // USER DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ==========================================
    // USER SURAT ROUTES
    // ==========================================
    // Dihapus sesuai permintaan user

    // User Surat Request Routes
    Route::get('/surat/request/template/{template}', [\App\Http\Controllers\SuratRequestController::class, 'create'])->name('surat.request.create');
    Route::post('/surat/request/template/{template}', [\App\Http\Controllers\SuratRequestController::class, 'store'])->name('surat.request.store');
    Route::get('/surat/request/{suratRequest}', [\App\Http\Controllers\SuratRequestController::class, 'show'])->name('surat.request.show');

    // ==========================================
    // ADMIN ROUTES (Require Admin Role)
    // ==========================================

    Route::middleware(['admin'])->group(function () {
        // Admin Dashboard
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
        Route::post('/admin/users/{user}/toggle-admin', [AdminDashboardController::class, 'toggleAdmin'])->name('admin.users.toggle-admin');
        Route::post('/admin/users/{user}/toggle-active', [AdminDashboardController::class, 'toggleActive'])->name('admin.users.toggle-active');
        Route::delete('/admin/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');
        
        // Activity Logs
        Route::get('/admin/logs', [\App\Http\Controllers\ActivityLogController::class, 'index'])->name('admin.logs');


        // Admin Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
        Route::post('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
        Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
        Route::post('/notifications/{notification}/delete', [NotificationController::class, 'delete'])->name('notifications.delete');
        Route::post('/notifications/clear-all', [NotificationController::class, 'clearAll'])->name('notifications.clear-all');

        // Admin Surat Management
        // Dihapus sesuai permintaan user
        
        // Admin Tiptap Surat Template Routes
        Route::resource('template', \App\Http\Controllers\Admin\SuratTemplateController::class)->names('admin.template');

        // DATA SIPIL (PENDUDUK) ROUTES
        Route::get('/admin/penduduk', [PendudukController::class, 'index'])->name('admin.penduduk.index');
        Route::get('/admin/penduduk/create', [PendudukController::class, 'create'])->name('admin.penduduk.create');
        Route::post('/admin/penduduk', [PendudukController::class, 'store'])->name('admin.penduduk.store');
        Route::get('/admin/penduduk/{penduduk}/edit', [PendudukController::class, 'edit'])->name('admin.penduduk.edit');
        Route::put('/admin/penduduk/{penduduk}', [PendudukController::class, 'update'])->name('admin.penduduk.update');
        Route::delete('/admin/penduduk/{penduduk}', [PendudukController::class, 'destroy'])->name('admin.penduduk.destroy');
        Route::post('/admin/penduduk/import', [PendudukController::class, 'import'])->name('admin.penduduk.import');
    });
});