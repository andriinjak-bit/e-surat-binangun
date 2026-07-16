@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-blue-900 mb-6">Activity Logs (Riwayat Aktivitas)</h1>

    <div class="mb-6 p-4 border rounded bg-gray-50 shadow-sm">
        <form action="{{ route('admin.logs') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Action (Kategori)</label>
                <select name="action" class="border rounded px-3 py-2 w-full">
                    <option value="">Semua Action</option>
                    @foreach($actions as $act)
                        <option value="{{ $act }}" {{ request('action') == $act ? 'selected' : '' }}>{{ $act }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nama Pengguna</label>
                <input type="text" name="username" value="{{ request('username') }}" class="border rounded px-3 py-2 w-full" placeholder="Cari nama pengguna...">
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filter</button>
                <a href="{{ route('admin.logs') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 ml-2">Reset</a>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow-sm border">
        <table class="w-full whitespace-nowrap text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="py-2 px-4">Waktu</th>
                    <th class="py-2 px-4">Pengguna</th>
                    <th class="py-2 px-4">Action</th>
                    <th class="py-2 px-4">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4 text-sm text-gray-600">{{ $log->created_at->format('d M Y, H:i') }}</td>
                        <td class="py-2 px-4 font-medium">{{ $log->user ? $log->user->name : 'Sistem / Guest' }}</td>
                        <td class="py-2 px-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded bg-gray-200 text-gray-800">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td class="py-2 px-4 text-sm">{{ $log->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Belum ada riwayat aktivitas yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</div>
@endsection
