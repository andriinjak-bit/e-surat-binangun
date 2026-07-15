@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-blue-900">Halo, {{ Auth::user()->name }}!</h1>
    <p class="text-gray-600">Selamat datang di E-Surat Desa Binangun.</p>

    <!-- nih tombol Ajukan Surat -->
    <div class="mt-6">
        <a href="{{ route('surat.create') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
            <i class="fas fa-plus"></i> Ajukan Surat Baru
        </a>
    </div>

    <!-- nih Daftar Surat -->
    <div class="mt-8 bg-white rounded-xl shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="font-bold text-lg">Riwayat Pengajuan Surat</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">Jenis Surat</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($surats as $surat)
                    <tr class="border-b border-gray-100">
                        <td class="px-6 py-4 capitalize">{{ $surat->jenis_surat }}</td>
                        <td class="px-6 py-4">{{ $surat->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @if($surat->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs">Menunggu</span>
                            @elseif($surat->status == 'diproses')
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs">Diproses</span>
                            @elseif($surat->status == 'selesai')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs">Selesai</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('surat.show', $surat) }}" class="text-blue-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada pengajuan surat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection