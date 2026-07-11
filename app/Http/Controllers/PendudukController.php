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

        if ($request->filled('usia')) {
            $query->where('usia', $request->usia);
        }

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        $penduduks = $query->paginate(15)->withQueryString();

        return view('penduduk.index', [
            'penduduks' => $penduduks,
            'filters' => $request->only(['rt', 'rw', 'usia', 'search']),
        ]);
    }

    public function create()
    {
        return view('penduduk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => 'required|string',
            'nik' => 'required|string|unique:penduduks,nik',
            'nama' => 'required|string',
            'usia' => 'required|integer',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_tanggal_lahir' => 'required|string',
            'pekerjaan' => 'required|string',
            'agama' => 'required|string',
            'pendidikan' => 'required|string',
            'status' => 'required|string',
            'shdk' => 'required|string',
            'alamat' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
        ]);

        \App\Models\Penduduk::create($validated);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function edit(\App\Models\Penduduk $penduduk)
    {
        return view('penduduk.edit', [
            'penduduk' => $penduduk
        ]);
    }

    public function update(Request $request, \App\Models\Penduduk $penduduk)
    {
        $validated = $request->validate([
            'no_kk' => 'required|string',
            'nik' => 'required|string|unique:penduduks,nik,' . $penduduk->id,
            'nama' => 'required|string',
            'usia' => 'required|integer',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_tanggal_lahir' => 'required|string',
            'pekerjaan' => 'required|string',
            'agama' => 'required|string',
            'pendidikan' => 'required|string',
            'status' => 'required|string',
            'shdk' => 'required|string',
            'alamat' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
        ]);

        $penduduk->update($validated);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(\App\Models\Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls'
        ]);

        \Maatwebsite\Excel\Facades\Excel::queueImport(new \App\Imports\PendudukImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data penduduk sedang di-import di background.');
    }
}
