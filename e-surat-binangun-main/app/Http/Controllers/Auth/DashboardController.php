<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Stats
        $totalSurat = Surat::count();
        $pendingSurat = Surat::where('status', 'pending')->count();
        $diprosesSurat = Surat::where('status', 'diproses')->count();
        $selesaiSurat = Surat::where('status', 'selesai')->count();
        $totalUsers = User::count();
        $totalAdmin = User::where('is_admin', true)->count();
        
        // Recent surat
        $recentSurat = Surat::with('user')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'user',
            'totalSurat',
            'pendingSurat',
            'diprosesSurat',
            'selesaiSurat',
            'totalUsers',
            'totalAdmin',
            'recentSurat'
        ));
    }

    // Manage users (admin only)
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    // Toggle admin status
    public function toggleAdmin(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot change your own admin status.');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        return back()->with('success', 'User admin status updated.');
    }

    // Toggle user active status
    public function toggleActive(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot deactivate yourself.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'User status updated.');
    }

    // Delete user
    public function deleteUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}