@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-blue-900">Kelola Surat (Admin)</h1>

    <div class="mt-6 bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">Pemohon</th>
                        <th class="px-6 py-3 text-left">Jenis</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surats as $surat)
                    <tr class="border-b border-gray-100">
                        <td class="px-6 py-4">{{ $surat->user->name }}</td>
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
                            <form action="{{ route('admin.surat.update', $surat) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <select name="status" class="text-xs border rounded p-1">
                                    <option value="pending" {{ $surat->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="diproses" {{ $surat->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $surat->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="ditolak" {{ $surat->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded text-xs">Update</button>
                            </form>
                            <a href="{{ route('surat.show', $surat) }}" class="text-blue-600 ml-2 text-xs">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection