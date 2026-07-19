@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#0B2E4F]">Admin Dashboard</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.users') }}" class="bg-[#E8A317] text-[#061E33] px-4 py-2 rounded-lg hover:bg-[#F4C542] font-bold text-sm">Manage Users</a>
            <a href="{{ route('admin.template.index') }}" class="bg-[#0B2E4F] text-white px-4 py-2 rounded-lg hover:bg-[#1B4A7A] font-bold text-sm">Manage Template</a>
        </div>
    </div>
    
    <p class="text-gray-600 mb-6">Selamat datang, <strong>{{ $user->name }}</strong>! Anda login sebagai admin.</p>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Total Surat</p>
            <p class="text-2xl font-bold text-[#0B2E4F]">{{ $totalSurat }}</p>
        </div>
        <div class="bg-yellow-50 p-4 rounded-xl shadow">
            <p class="text-sm text-yellow-600">Pending</p>
            <p class="text-2xl font-bold text-yellow-700">{{ $pendingSurat }}</p>
        </div>
        <div class="bg-blue-50 p-4 rounded-xl shadow">
            <p class="text-sm text-blue-600">Diproses</p>
            <p class="text-2xl font-bold text-blue-700">{{ $diprosesSurat }}</p>
        </div>
        <div class="bg-green-50 p-4 rounded-xl shadow">
            <p class="text-sm text-green-600">Selesai</p>
            <p class="text-2xl font-bold text-green-700">{{ $selesaiSurat }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Total Users</p>
            <p class="text-2xl font-bold text-[#0B2E4F]">{{ $totalUsers }}</p>
        </div>
    </div>
    
    <!-- Recent Surat -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-bold text-[#0B2E4F] mb-4">Pengajuan Surat Terbaru</h3>
        @if($recentSurat->isEmpty())
            <p class="text-gray-500">Belum ada pengajuan surat.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">Pemohon</th>
                            <th class="px-4 py-2 text-left">Jenis</th>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentSurat as $surat)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $surat->user->name ?? 'Unknown' }}</td>
                            <td class="px-4 py-2 capitalize">{{ $surat->template->judul ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $surat->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2">
                                @if($surat->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Pending</span>
                                @elseif($surat->status == 'diproses')
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Diproses</span>
                                @elseif($surat->status == 'selesai')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Selesai</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <a href="#" class="text-blue-600 hover:underline text-xs">Detail (WIP)</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection