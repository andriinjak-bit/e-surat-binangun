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
use Inertia\Inertia;

// ==========================================
// PUBLIC ROUTES
// ==========================================

use Illuminate\Support\Facades\Storage;

Route::get('/file/preview', function (Illuminate\Http\Request $request) {
    $path = $request->query('path');
    
    if (!$path) {
        abort(404, 'Path is required');
    }

    // 1. Check standard public disk (storage/app/public)
    if (Storage::disk('public')->exists($path)) {
        return response()->file(Storage::disk('public')->path($path));
    }

    // 2. Check local disk with 'public/ktp' or 'public/kk' prefixes 
    // (Laravel 11 default local disk is storage/app/private)
    if (Storage::disk('local')->exists('public/ktp/' . basename($path))) {
        return response()->file(Storage::disk('local')->path('public/ktp/' . basename($path)));
    }
    if (Storage::disk('local')->exists('public/kk/' . basename($path))) {
        return response()->file(Storage::disk('local')->path('public/kk/' . basename($path)));
    }

    // 3. Check if path starts with 'public/' and try stripping it
    $cleanPath = ltrim($path, '/');
    if (str_starts_with($cleanPath, 'public/')) {
        $cleanPath = substr($cleanPath, 7);
        if (Storage::disk('public')->exists($cleanPath)) {
            return response()->file(Storage::disk('public')->path($cleanPath));
        }
    }
    
    // 4. Try raw path on local disk
    if (Storage::disk('local')->exists($path)) {
        return response()->file(Storage::disk('local')->path($path));
    }
    
    // 5. PHP decodes '+' in URL query strings to spaces. 
    // If the file actually has a '+' in its name, it won't be found.
    // Let's try replacing spaces with '+' as a fallback.
    if (str_contains($path, ' ')) {
        $pathWithPlus = str_replace(' ', '+', $path);
        
        if (Storage::disk('public')->exists($pathWithPlus)) {
            return response()->file(Storage::disk('public')->path($pathWithPlus));
        }
        if (Storage::disk('local')->exists('public/ktp/' . basename($pathWithPlus))) {
            return response()->file(Storage::disk('local')->path('public/ktp/' . basename($pathWithPlus)));
        }
        if (Storage::disk('local')->exists('public/kk/' . basename($pathWithPlus))) {
            return response()->file(Storage::disk('local')->path('public/kk/' . basename($pathWithPlus)));
        }
        $cleanPathPlus = ltrim($pathWithPlus, '/');
        if (str_starts_with($cleanPathPlus, 'public/')) {
            $cleanPathPlus = substr($cleanPathPlus, 7);
            if (Storage::disk('public')->exists($cleanPathPlus)) {
                return response()->file(Storage::disk('public')->path($cleanPathPlus));
            }
        }
        if (Storage::disk('local')->exists($pathWithPlus)) {
            return response()->file(Storage::disk('local')->path($pathWithPlus));
        }
    }
    
    abort(404, 'File not found at path: ' . $path . ' (Full path: ' . Storage::disk('public')->path($path) . ')');
})->name('file.preview');

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['prevent-back-history'])->group(function () {
    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect(Auth::user()->is_admin ? '/admin/dashboard' : '/dashboard');
        }
        return Inertia::render('Auth/Login');
    })->name('login');

    Route::get('/register', function () {
        if (Auth::check()) {
            return redirect(Auth::user()->is_admin ? '/admin/dashboard' : '/dashboard');
        }
        return Inertia::render('Auth/Register');
    })->name('register');
});


Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/register', [AuthController::class, 'showAdminRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'adminRegister']);
    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect(Auth::user()->is_admin ? '/admin/dashboard' : '/dashboard');
        }
        return view('admin.login');
    })->name('login');
});

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/layanan', function () {
    $templates = \App\Models\SuratTemplate::all();
    return \Inertia\Inertia::render('Layanan', [
        'suratTemplates' => $templates
    ]);
})->name('layanan');

Route::get('/beranda', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return Inertia::render('Welcome');
})->name('beranda');

// ==========================================
// PROTECTED ROUTES (Require Login)
// ==========================================

Route::middleware(['auth', 'prevent-back-history'])->group(function () {

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

    // User Surat Status Routes
    Route::get('/surat/status', [\App\Http\Controllers\SuratStatusController::class, 'index'])->name('surat.status.index');
    Route::get('/surat/status/detail', [\App\Http\Controllers\SuratStatusController::class, 'show'])->name('surat.status.detail');
    Route::post('/surat/status/comment/{id}', [\App\Http\Controllers\SuratStatusController::class, 'addComment'])->name('surat.status.comment');

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
        Route::get('/admin/log-activity', [\App\Http\Controllers\ActivityLogController::class, 'index'])->name('admin.logs');


        // Admin Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
        Route::post('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
        Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
        Route::post('/notifications/{notification}/delete', [NotificationController::class, 'delete'])->name('notifications.delete');
        Route::post('/notifications/clear-all', [NotificationController::class, 'clearAll'])->name('notifications.clear-all');

        // Admin Surat Management
        Route::get('/admin/layanan', [\App\Http\Controllers\Admin\AdminLayananController::class, 'index'])->name('admin.layanan');
        Route::get('/admin/layanan/detail', [\App\Http\Controllers\Admin\AdminLayananController::class, 'detail'])->name('admin.layanan.detail');
        Route::get('/admin/layanan/approval', [\App\Http\Controllers\Admin\AdminLayananController::class, 'approval'])->name('admin.layanan.approval');
        Route::post('/admin/layanan/status/{id}', [\App\Http\Controllers\Admin\AdminLayananController::class, 'updateStatus'])->name('admin.layanan.status');
        Route::post('/admin/layanan/upload/{id}', [\App\Http\Controllers\Admin\AdminLayananController::class, 'uploadFinal'])->name('admin.layanan.upload');
        Route::post('/admin/layanan/comment/{id}', [\App\Http\Controllers\Admin\AdminLayananController::class, 'addComment'])->name('admin.layanan.comment');

        // Admin Tiptap Surat Template Routes
        Route::resource('admin/template', \App\Http\Controllers\Admin\SuratTemplateController::class)->names('admin.template');

        // DATA SIPIL (PENDUDUK) ROUTES
        Route::get('/admin/penduduk', [PendudukController::class, 'index'])->name('admin.penduduk.index');
        Route::get('/admin/penduduk/add', [PendudukController::class, 'create'])->name('admin.penduduk.create');
        Route::post('/admin/penduduk', [PendudukController::class, 'store'])->name('admin.penduduk.store');
        Route::get('/admin/penduduk/{penduduk}/edit', [PendudukController::class, 'edit'])->name('admin.penduduk.edit');
        Route::put('/admin/penduduk/{penduduk}', [PendudukController::class, 'update'])->name('admin.penduduk.update');
        Route::delete('/admin/penduduk/{penduduk}', [PendudukController::class, 'destroy'])->name('admin.penduduk.destroy');
        Route::post('/admin/penduduk/import', [PendudukController::class, 'import'])->name('admin.penduduk.import');
        Route::get('/admin/penduduk/check-import', [PendudukController::class, 'checkImport'])->name('admin.penduduk.check-import');
        Route::get('/admin/penduduk/export', [PendudukController::class, 'export'])->name('admin.penduduk.export');
    });
});