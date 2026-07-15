@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#0B2E4F]">Manajemen Pengguna</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 font-bold text-sm">Kembali ke Dashboard</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Users Table -->
    <div class="bg-white p-6 rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-bold text-gray-700">Nama</th>
                    <th class="px-4 py-3 text-left font-bold text-gray-700">Email</th>
                    <th class="px-4 py-3 text-left font-bold text-gray-700">NIK</th>
                    <th class="px-4 py-3 text-left font-bold text-gray-700">Role</th>
                    <th class="px-4 py-3 text-left font-bold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-left font-bold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">{{ $user->nik ?? '-' }}</td>
                    <td class="px-4 py-3">
                        @if($user->is_admin)
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-bold">Admin</span>
                        @else
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-bold">User</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        @if($user->is_active)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-bold">Aktif</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-bold">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2 flex-wrap">
                            @if(Auth::user()->id !== $user->id)
                                <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="text-xs px-2 py-1 rounded 
                                        @if($user->is_admin)
                                            bg-yellow-100 text-yellow-800 hover:bg-yellow-200
                                        @else
                                            bg-purple-100 text-purple-800 hover:bg-purple-200
                                        @endif
                                    ">
                                        @if($user->is_admin) Hapus Admin @else Jadikan Admin @endif
                                    </button>
                                </form>

                                <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="text-xs px-2 py-1 rounded 
                                        @if($user->is_active)
                                            bg-orange-100 text-orange-800 hover:bg-orange-200
                                        @else
                                            bg-green-100 text-green-800 hover:bg-green-200
                                        @endif
                                    ">
                                        @if($user->is_active) Nonaktifkan @else Aktifkan @endif
                                    </button>
                                </form>

                                <form action="{{ route('admin.users.delete', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs px-2 py-1 rounded bg-red-100 text-red-800 hover:bg-red-200">
                                        Hapus
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-gray-500 italic">Akun Anda</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">Tidak ada pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
