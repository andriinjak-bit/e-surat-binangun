<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string', // can be email or NIK
            'password' => 'required'
        ]);

        // Determine if input is email or NIK
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nik';

        $credentials = [
            $field => $request->login,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            \App\Models\ActivityLog::record('Login', 'Pengguna melakukan login');
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'login' => 'Email/NIK atau password salah.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false
        ]);

        // Create notification for all admins about new user registration
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            AdminNotification::create([
                'user_id' => $admin->id,
                'type' => 'user_registered',
                'title' => 'Pengguna Baru Terdaftar',
                'message' => $request->name . ' telah mendaftar sebagai pengguna baru.',
                'related_model' => 'User',
                'related_id' => $user->id,
            ]);
        }

        Auth::login($user);
        \App\Models\ActivityLog::record('Register', 'Pengguna mendaftarkan akun baru');

        return redirect('/dashboard');
    }

    public function logout()
    {
        \App\Models\ActivityLog::record('Logout', 'Pengguna melakukan logout');
        Auth::logout();
        return redirect('/');
    }
}