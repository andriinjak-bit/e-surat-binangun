@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-900">Data Sipil (Penduduk)</h1>
        <a href="{{ route('penduduk.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Tambah Data
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 p-4 border rounded bg-gray-50 shadow-sm">
        <form action="{{ route('penduduk.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm font-medium mb-1">Cari (Nama/NIK)</label>
                <input type="text" name="search" value="{{ request('search') }}" class="border rounded px-3 py-2 w-full" placeholder="Ketik kata kunci...">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Filter RT</label>
                <input type="text" name="rt" value="{{ request('rt') }}" class="border rounded px-3 py-2 w-32" placeholder="Misal: 01">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Filter RW</label>
                <input type="text" name="rw" value="{{ request('rw') }}" class="border rounded px-3 py-2 w-32" placeholder="Misal: 02">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Filter Usia</label>
                <input type="number" name="usia" value="{{ request('usia') }}" class="border rounded px-3 py-2 w-32" placeholder="Misal: 30">
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">Filter</button>
                <a href="{{ route('penduduk.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 ml-2">Reset</a>
            </div>
        </form>

        <hr class="my-4">

        <form action="{{ route('penduduk.import') }}" method="POST" enctype="multipart/form-data" class="flex gap-2 items-center">
            @csrf
            <label class="block text-sm font-medium mb-1">Upload CSV:</label>
            <input type="file" name="file" required class="text-sm">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Import CSV
            </button>
        </form>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow-sm border">
        <table class="w-full whitespace-nowrap text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="py-2 px-4">No KK</th>
                    <th class="py-2 px-4">NIK</th>
                    <th class="py-2 px-4">Nama</th>
                    <th class="py-2 px-4">Usia</th>
                    <th class="py-2 px-4">JK</th>
                    <th class="py-2 px-4">RT/RW</th>
                    <th class="py-2 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penduduks as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $item->no_kk }}</td>
                        <td class="py-2 px-4">{{ $item->nik }}</td>
                        <td class="py-2 px-4">{{ $item->nama }}</td>
                        <td class="py-2 px-4">{{ $item->usia }}</td>
                        <td class="py-2 px-4">{{ $item->jenis_kelamin }}</td>
                        <td class="py-2 px-4">{{ $item->rt }} / {{ $item->rw }}</td>
                        <td class="py-2 px-4 text-center">
                            <a href="{{ route('penduduk.edit', $item->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                            <form action="{{ route('penduduk.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-gray-500">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $penduduks->links() }}
    </div>
</div>
@endsection
