<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Penduduk;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $penduduk = $user->penduduk;
        return view('profile.index', compact('user', 'penduduk'));
    }

    public function edit()
    {
        $user = Auth::user();
        $penduduk = $user->penduduk;
        
        // If somehow they don't have penduduk data yet, we can create an empty one or handle it.
        // But registration creates it, so it should exist.
        if (!$penduduk) {
            $penduduk = new Penduduk(['nik' => $user->nik]);
        }
        
        return view('profile.edit', compact('user', 'penduduk'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $penduduk = $user->penduduk;

        $request->validate([
            'nama' => 'required|string|max:255',
            // NIK is fixed to user's NIK, we shouldn't really change NIK from profile if it's foreign key,
            // but if we do, we need to update both. Let's just keep NIK read-only or not updatable here.
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:1,2',
            'pekerjaan' => 'nullable|string|max:255',
            'agama' => 'nullable|string|max:50',
            'pendidikan' => 'nullable|string|max:100',
            'status_pernikahan' => 'nullable|string|max:50',
            'shdk' => 'nullable|string|max:50',
            'no_kk' => 'nullable|string|max:20',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'alamat' => 'nullable|string',
            'dusun' => 'nullable|string|max:255',
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['ktp', 'kk']);

        // Helper function to save files
        $saveFile = function($file, $directory, $oldPath = null) {
            if (!Storage::exists('public/' . $directory)) {
                Storage::makeDirectory('public/' . $directory);
            }
            if ($oldPath && Storage::exists('public/' . $directory . '/' . $oldPath)) {
                Storage::delete('public/' . $directory . '/' . $oldPath);
            }
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/' . $directory, $filename);
            return $filename;
        };

        if ($request->hasFile('ktp')) {
            $data['ktp_path'] = $saveFile(
                $request->file('ktp'), 
                'ktp', 
                $penduduk ? $penduduk->ktp_path : null
            );
        }

        if ($request->hasFile('kk')) {
            $data['kk_path'] = $saveFile(
                $request->file('kk'), 
                'kk', 
                $penduduk ? $penduduk->kk_path : null
            );
        }

        if ($penduduk) {
            $penduduk->update($data);
        } else {
            $data['nik'] = $user->nik;
            Penduduk::create($data);
        }

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}