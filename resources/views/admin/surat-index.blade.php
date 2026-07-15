@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-[#0B2E4F] mb-6">Kelola Surat</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-bold">No</th>
                    <th class="px-6 py-3 text-left text-sm font-bold">Pemohon</th>
                    <th class="px-6 py-3 text-left text-sm font-bold">Jenis Surat</th>
                    <th class="px-6 py-3 text-left text-sm font-bold">Tanggal</th>
                    <th class="px-6 py-3 text-left text-sm font-bold">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-bold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surats as $surat)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $surat->user->name }}</td>
                    <td class="px-6 py-4">{{ $surat->jenis_surat }}</td>
                    <td class="px-6 py-4">{{ $surat->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs {{ $surat->status_badge }}">
                            {{ $surat->status_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.surat.show', $surat) }}" class="text-blue-600 hover:underline text-sm">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada pengajuan surat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection