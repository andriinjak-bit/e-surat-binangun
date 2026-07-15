@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-[#0B2E4F] mb-6">Profil Saya</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="bg-[#0B2E4F] px-6 py-8 text-white">
            <div class="flex items-center gap-6">
                <div class="w-24 h-24 rounded-full bg-[#E8A317] flex items-center justify-center text-3xl font-bold text-[#0B2E4F]">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                    <p class="text-gray-300">{{ $user->nik }}</p>
                    <p class="text-gray-300 text-sm">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-bold text-[#0B2E4F] border-b pb-2 mb-4">Data Diri</h3>
                    <div class="space-y-3">
                        <div><label class="text-sm text-gray-500">Nama Lengkap</label><p class="font-medium">{{ $user->name }}</p></div>
                        <div><label class="text-sm text-gray-500">NIK</label><p class="font-medium">{{ $user->nik }}</p></div>
                        <div><label class="text-sm text-gray-500">Email</label><p class="font-medium">{{ $user->email ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">No. HP</label><p class="font-medium">{{ $user->phone ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Tempat, Tanggal Lahir</label><p class="font-medium">{{ $user->tempat_lahir ? $user->tempat_lahir . ', ' . \Carbon\Carbon::parse($user->tanggal_lahir)->format('d F Y') : '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Jenis Kelamin</label><p class="font-medium">{{ $user->jenis_kelamin ?? '-' }}</p></div>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-[#0B2E4F] border-b pb-2 mb-4">Data Alamat & Sosial</h3>
                    <div class="space-y-3">
                        <div><label class="text-sm text-gray-500">Alamat</label><p class="font-medium">{{ $user->alamat ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Dusun</label><p class="font-medium">{{ $user->dusun ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">RT / RW</label><p class="font-medium">{{ $user->rt ? $user->rt . ' / ' . $user->rw : '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Pekerjaan</label><p class="font-medium">{{ $user->pekerjaan ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Agama</label><p class="font-medium">{{ $user->agama ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Pendidikan</label><p class="font-medium">{{ $user->pendidikan ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Status Perkawinan</label><p class="font-medium">{{ $user->status_perkawinan ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">SHDK</label><p class="font-medium">{{ $user->shdk ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">No. KK</label><p class="font-medium">{{ $user->no_kk ?? '-' }}</p></div>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('profile.edit') }}" class="bg-[#E8A317] text-[#061E33] px-6 py-2 rounded-lg hover:bg-[#F4C542] font-bold">Edit Profil</a>
                <a href="{{ route('dashboard') }}" class="ml-2 text-[#0B2E4F] hover:underline">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection