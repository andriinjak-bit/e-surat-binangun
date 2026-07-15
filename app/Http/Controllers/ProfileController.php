<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:users,nik,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'pekerjaan' => 'nullable|string|max:255',
            'agama' => 'nullable|string|max:50',
            'pendidikan' => 'nullable|string|max:100',
            'status_perkawinan' => 'nullable|string|max:50',
            'shdk' => 'nullable|string|max:50',
            'no_kk' => 'nullable|string|max:20',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'alamat' => 'nullable|string',
            'dusun' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['profile_picture', 'signature', 'ktp', 'kk']);

        // Helper function to save files
        $saveFile = function($file, $directory, $oldPath = null) {
            // Create directory if it doesn't exist
            if (!Storage::exists('public/' . $directory)) {
                Storage::makeDirectory('public/' . $directory);
            }
            
            // Delete old file if exists
            if ($oldPath && Storage::exists('public/' . $directory . '/' . $oldPath)) {
                Storage::delete('public/' . $directory . '/' . $oldPath);
            }
            
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/' . $directory, $filename);
            return $filename;
        };

        // Handle profile picture
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $saveFile(
                $request->file('profile_picture'), 
                'profile', 
                $user->profile_picture
            );
        }

        // Handle signature
        if ($request->hasFile('signature')) {
            $data['signature_path'] = $saveFile(
                $request->file('signature'), 
                'signatures', 
                $user->signature_path
            );
        }

        // Handle KTP
        if ($request->hasFile('ktp')) {
            $data['ktp_path'] = $saveFile(
                $request->file('ktp'), 
                'ktp', 
                $user->ktp_path
            );
        }

        // Handle KK
        if ($request->hasFile('kk')) {
            $data['kk_path'] = $saveFile(
                $request->file('kk'), 
                'kk', 
                $user->kk_path
            );
        }

        $user->update($data);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}