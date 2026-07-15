<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // ==========================================
    // REGULAR USER LOGIN
    // ==========================================
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required'
        ]);

        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nik';

        $credentials = [
            $field => $request->login,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // ✅ Redirect admin to admin dashboard
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            
            // ✅ Redirect regular user to user dashboard
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'login' => 'Email/NIK atau password salah.',
        ]);
    }

    // ==========================================
    // REGULAR USER REGISTER
    // ==========================================
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
            'is_admin' => false,
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    // ==========================================
    // ADMIN REGISTER
    // ==========================================
    public function showAdminRegisterForm()
    {
        return view('admin.register');
    }

    public function adminRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:15',
            'dusun' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'phone' => $request->phone,
            'dusun' => $request->dusun,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'is_admin' => true,
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Admin account created successfully!');
    }

    // ==========================================
    // LOGOUT
    // ==========================================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}