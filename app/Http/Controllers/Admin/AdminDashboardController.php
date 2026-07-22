<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SuratRequest;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Check if user is admin
        if (!$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        // Get statistics
        $totalSurat = SuratRequest::count();
        $pendingSurat = SuratRequest::where('status', 'pending')->count();
        $diprosesSurat = SuratRequest::where('status', 'diproses')->count();
        $selesaiSurat = SuratRequest::where('status', 'selesai')->count();
        $ditolakSurat = SuratRequest::where('status', 'ditolak')->count();
        $totalUsers = User::count();
        $totalPenduduk = \App\Models\Penduduk::count();

        // Get recent surat
        $recentSurat = SuratRequest::with(['user', 'template'])
            ->latest()
            ->take(10)
            ->get();

        // Return the React placeholder for now
        return \Inertia\Inertia::render('Admin/DashboardAdmin', [
            'totalSurat' => $totalSurat,
            'pendingSurat' => $pendingSurat,
            'diprosesSurat' => $diprosesSurat,
            'selesaiSurat' => $selesaiSurat,
            'ditolakSurat' => $ditolakSurat,
            'totalUsers' => $totalUsers,
            'totalPenduduk' => $totalPenduduk,
            'recentSurat' => $recentSurat
        ]);
    }

    /**
     * Show users management page.
     */
    public function users()
    {
        $user = Auth::user();

        // Check if user is admin
        if (!$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $users = User::latest()->paginate(15);

        return view('admin.users', compact('users'));
    }

    /**
     * Toggle admin status for a user.
     */
    public function toggleAdmin(User $user)
    {
        $authUser = Auth::user();

        // Check if user is admin
        if (!$authUser->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        // Prevent toggling own admin status
        if ($user->id === $authUser->id) {
            return redirect()->route('admin.users')
                ->with('error', 'Anda tidak dapat mengubah status admin Anda sendiri.');
        }

        $user->update(['is_admin' => !$user->is_admin]);

        $status = $user->is_admin ? 'admin' : 'user';
        return redirect()->route('admin.users')
            ->with('success', "Status pengguna {$user->name} diubah menjadi {$status}.");
    }

    /**
     * Toggle active status for a user.
     */
    public function toggleActive(User $user)
    {
        $authUser = Auth::user();

        // Check if user is admin
        if (!$authUser->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        // Prevent deactivating own account
        if ($user->id === $authUser->id) {
            return redirect()->route('admin.users')
                ->with('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'aktif' : 'nonaktif';
        return redirect()->route('admin.users')
            ->with('success', "Status akun {$user->name} diubah menjadi {$status}.");
    }

    /**
     * Delete a user.
     */
    public function deleteUser(User $user)
    {
        $authUser = Auth::user();

        // Check if user is admin
        if (!$authUser->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        // Prevent deleting own account
        if ($user->id === $authUser->id) {
            return redirect()->route('admin.users')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', "Pengguna {$userName} berhasil dihapus.");
    }
}
