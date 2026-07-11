@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-blue-900 mb-6">Edit Data Penduduk</h1>

    <div class="bg-white p-6 rounded shadow-sm border">
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penduduk.update', $penduduk->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">No KK</label>
                    <input type="text" name="no_kk" value="{{ old('no_kk', $penduduk->no_kk) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik', $penduduk->nik) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $penduduk->nama) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Usia</label>
                    <input type="number" name="usia" value="{{ old('usia', $penduduk->usia) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="border rounded px-3 py-2 w-full" required>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Tempat, Tanggal Lahir</label>
                    <input type="text" name="tempat_tanggal_lahir" value="{{ old('tempat_tanggal_lahir', $penduduk->tempat_tanggal_lahir) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Pekerjaan</label>
                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Agama</label>
                    <input type="text" name="agama" value="{{ old('agama', $penduduk->agama) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Pendidikan</label>
                    <input type="text" name="pendidikan" value="{{ old('pendidikan', $penduduk->pendidikan) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Status Perkawinan</label>
                    <input type="text" name="status" value="{{ old('status', $penduduk->status) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">SHDK (Status Hub. Dalam Keluarga)</label>
                    <input type="text" name="shdk" value="{{ old('shdk', $penduduk->shdk) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">RT</label>
                    <input type="text" name="rt" value="{{ old('rt', $penduduk->rt) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">RW</label>
                    <input type="text" name="rw" value="{{ old('rw', $penduduk->rw) }}" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Alamat</label>
                    <textarea name="alamat" rows="3" class="border rounded px-3 py-2 w-full" required>{{ old('alamat', $penduduk->alamat) }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex gap-4">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan Perubahan
                </button>
                <a href="{{ route('penduduk.index') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
