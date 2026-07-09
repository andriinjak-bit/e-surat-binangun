<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    // ini bagian admin lihat semua surat
    public function index()
    {
        $surats = Surat::with('user')->latest()->get();
        return view('admin.surat-index', compact('surats'));
    }

    // ini buat user form pengajuan
    public function create()
    {
        return view('surat.create');
    }

    // ini buat users  simpan pengajuan
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|in:domisili,ktp_kk,usaha,tidak_mampu',
            'data' => 'nullable|array',
        ]);

        $surat = Surat::create([
            'user_id' => Auth::id(),
            'jenis_surat' => $request->jenis_surat,
            'data' => json_encode($request->data),
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Surat berhasil diajukan!');
    }

    // User dan Admin tuk detail surat
    public function show(Surat $surat)
    {
        if (Auth::user()->is_admin || Auth::id() === $surat->user_id) {
            return view('surat.show', compact('surat'));
        }
        abort(403);
    }

    // bagian admin tuk update status
    public function update(Request $request, Surat $surat)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $surat->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.surat')->with('success', 'Status surat diperbarui!');
    }
}