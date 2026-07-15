<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Support\Facades\Hash;

class AdminSimpleController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nik';

        $credentials = [
            $field => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                return redirect()->route('admin.simple.dashboard');
            }

            Auth::logout();
            return back()->withErrors(['login' => 'Akun ini bukan admin.']);
        }

        return back()->withErrors(['login' => 'Email/NIK atau password salah.']);
    }

    public function dashboard()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect()->route('admin.simple.login.form');
        }

        $totalUsers = User::count();
        $totalSurat = Surat::count();
        $pendingSurat = Surat::where('status', 'pending')->count();
        $selesaiSurat = Surat::where('status', 'selesai')->count();

        return view('admin.simple-dashboard', compact(
            'totalUsers',
            'totalSurat',
            'pendingSurat',
            'selesaiSurat'
        ));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}