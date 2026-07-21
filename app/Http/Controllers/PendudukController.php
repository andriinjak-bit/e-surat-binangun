<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Penduduk::query();

        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }
        
        if ($request->filled('rw')) {
            $query->where('rw', $request->rw);
        }

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        $penduduks = $query->paginate(15)->withQueryString();

        return \Inertia\Inertia::render('Admin/AdminPenduduk', [
            'penduduks' => $penduduks,
            'filters' => $request->only(['rt', 'rw', 'search']),
        ]);
    }

    public function create()
    {
        return \Inertia\Inertia::render('Admin/AdminPendudukAdd');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => 'nullable|string',
            'nik' => 'required|string|unique:penduduks,nik',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:1,2',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'nullable|string',
            'agama' => 'nullable|string',
            'pendidikan' => 'nullable|string',
            'status_pernikahan' => 'nullable|string',
            'shdk' => 'nullable|string',
            'alamat' => 'required|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'dusun' => 'nullable|string',
        ]);

        \App\Models\Penduduk::create($validated);
        \App\Models\ActivityLog::record('Create Penduduk', 'Menambahkan penduduk: ' . $validated['nama']);

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function edit(\App\Models\Penduduk $penduduk)
    {
        return view('admin.penduduk.edit', [
            'penduduk' => $penduduk
        ]);
    }

    public function update(Request $request, \App\Models\Penduduk $penduduk)
    {
        $validated = $request->validate([
            'no_kk' => 'nullable|string',
            'nik' => 'required|string|unique:penduduks,nik,' . $penduduk->id,
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:1,2',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'nullable|string',
            'agama' => 'nullable|string',
            'pendidikan' => 'nullable|string',
            'status_pernikahan' => 'nullable|string',
            'shdk' => 'nullable|string',
            'alamat' => 'required|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'dusun' => 'nullable|string',
        ]);

        $penduduk->update($validated);
        \App\Models\ActivityLog::record('Update Penduduk', 'Mengubah data penduduk: ' . $penduduk->nama);

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(\App\Models\Penduduk $penduduk)
    {
        $nama = $penduduk->nama;
        $penduduk->delete();
        \App\Models\ActivityLog::record('Delete Penduduk', 'Menghapus data penduduk: ' . $nama);
        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls'
        ]);

        \Maatwebsite\Excel\Facades\Excel::queueImport(new \App\Imports\PendudukImport, $request->file('file'));
        \App\Models\ActivityLog::record('Import Penduduk', 'Mulai memproses import CSV penduduk di background.');

        return redirect()->back()->with('success', 'Data penduduk sedang di-import di background.');
    }
}
