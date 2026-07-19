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
                    {{ $penduduk && $penduduk->nama ? strtoupper(substr($penduduk->nama, 0, 2)) : 'U' }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold">{{ $penduduk->nama ?? 'Belum ada nama' }}</h2>
                    <p class="text-gray-300">{{ $user->nik }}</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if(!$penduduk)
                <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg mb-6">
                    Data kependudukan Anda belum lengkap. Silakan edit profil untuk melengkapi data.
                </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-bold text-[#0B2E4F] border-b pb-2 mb-4">Data Diri</h3>
                    <div class="space-y-3">
                        <div><label class="text-sm text-gray-500">Nama Lengkap</label><p class="font-medium">{{ $penduduk->nama }}</p></div>
                        <div><label class="text-sm text-gray-500">NIK</label><p class="font-medium">{{ $user->nik }}</p></div>
                        <div><label class="text-sm text-gray-500">Tempat, Tanggal Lahir</label><p class="font-medium">{{ $penduduk->tempat_lahir ? $penduduk->tempat_lahir . ', ' . \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d F Y') : '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Jenis Kelamin</label><p class="font-medium">{{ $penduduk->jenis_kelamin == 1 ? 'Laki-laki' : ($penduduk->jenis_kelamin == 2 ? 'Perempuan' : '-') }}</p></div>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-[#0B2E4F] border-b pb-2 mb-4">Data Alamat & Sosial</h3>
                    <div class="space-y-3">
                        <div><label class="text-sm text-gray-500">Alamat</label><p class="font-medium">{{ $penduduk->alamat ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Dusun</label><p class="font-medium">{{ $penduduk->dusun ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">RT / RW</label><p class="font-medium">{{ $penduduk->rt ? $penduduk->rt . ' / ' . $penduduk->rw : '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Pekerjaan</label><p class="font-medium">{{ $penduduk->pekerjaan ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Agama</label><p class="font-medium">{{ $penduduk->agama ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Pendidikan</label><p class="font-medium">{{ $penduduk->pendidikan ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">Status Perkawinan</label><p class="font-medium">{{ $penduduk->status_pernikahan ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">SHDK</label><p class="font-medium">{{ $penduduk->shdk ?? '-' }}</p></div>
                        <div><label class="text-sm text-gray-500">No. KK</label><p class="font-medium">{{ $penduduk->no_kk ?? '-' }}</p></div>
                    </div>
                </div>
            </div>
            @endif
            <div class="mt-6">
                <a href="{{ route('profile.edit') }}" class="bg-[#E8A317] text-[#061E33] px-6 py-2 rounded-lg hover:bg-[#F4C542] font-bold">Edit Profil</a>
                <a href="{{ route('dashboard') }}" class="ml-2 text-[#0B2E4F] hover:underline">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection