<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Penduduk;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'password' => 'required'
        ]);

        $credentials = [
            'nik' => $request->nik,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            \App\Models\ActivityLog::record('Login', 'Pengguna melakukan login');
            $user = Auth::user();
            if ($user->is_admin) {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'nik' => 'NIK atau password salah.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:users',
            'password' => 'required|min:8|confirmed',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:1,2',
            'alamat' => 'required|string',
            'agreement' => 'accepted',
            'ktp' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'kk' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'name.required' => 'Nama lengkap harus diisi.',
            'nik.required' => 'NIK harus diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'password.required' => 'Kata sandi harus diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'agreement.accepted' => 'Anda harus menyetujui persyaratan.',
            'ktp.required' => 'File KTP wajib diunggah.',
            'ktp.file' => 'KTP harus berupa file.',
            'ktp.mimes' => 'Format KTP harus jpeg, png, jpg, atau pdf.',
            'ktp.max' => 'Ukuran KTP maksimal 2MB.',
            'kk.required' => 'File Kartu Keluarga wajib diunggah.',
            'kk.file' => 'Kartu Keluarga harus berupa file.',
            'kk.mimes' => 'Format Kartu Keluarga harus jpeg, png, jpg, atau pdf.',
            'kk.max' => 'Ukuran Kartu Keluarga maksimal 2MB.',
        ]);

        $ktpPath = null;
        if ($request->hasFile('ktp')) {
            $ktpPath = $request->file('ktp')->store('documents', 'public');
        }

        $kkPath = null;
        if ($request->hasFile('kk')) {
            $kkPath = $request->file('kk')->store('documents', 'public');
        }

        // Create user
        $user = User::create([
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        // Create penduduk or update if exists (if imported without user)
        Penduduk::updateOrCreate(
            ['nik' => $request->nik],
            [
                'nama' => $request->name,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'ktp_path' => $ktpPath,
                'kk_path' => $kkPath,
            ]
        );

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