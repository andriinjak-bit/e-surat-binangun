@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-[#0B2E4F] mb-6">Detail Surat</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow">
        <!-- Status -->
        <div class="flex items-center gap-4 mb-6">
            <span class="px-3 py-1 rounded-full text-sm {{ $surat->status_badge }}">
                {{ $surat->status_label }}
            </span>
            @if($surat->verified_at)
                <span class="text-sm text-gray-500">
                    <i class="fas fa-check-circle text-green-500"></i>
                    Diverifikasi: {{ $surat->verified_at->format('d F Y H:i') }}
                </span>
            @endif
        </div>

        <!-- Tracking -->
        <div class="mb-6">
            <h3 class="font-bold text-[#0B2E4F] mb-2">Status Pengajuan</h3>
            <div class="flex items-center gap-2">
                <div class="flex-1">
                    <div class="flex justify-between text-xs text-gray-500">
                        <span>Diajukan</span>
                        <span>Diverifikasi</span>
                        <span>Selesai</span>
                    </div>
                    <div class="w-full bg-gray-200 h-2 rounded-full">
                        <div class="bg-[#E8A317] h-2 rounded-full" style="width: 
                            @if($surat->status == 'pending') 25%
                            @elseif($surat->status == 'diproses') 50%
                            @elseif($surat->status == 'selesai') 100%
                            @elseif($surat->status == 'ditolak') 100%
                            @elseif($surat->status == 'revisi') 25%
                            @endif
                        "></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- ADMIN COMMENT - ADD THIS SECTION -->
        <!-- ========================================== -->
        @if($surat->admin_comment || $surat->admin_note)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg">
                <div class="flex items-start gap-3">
                    <div class="text-blue-500 mt-1">
                        <i class="fas fa-comment-dots text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-blue-800 text-sm">Komentar Admin:</h4>
                        <p class="text-gray-700 mt-1">{{ $surat->admin_comment ?? $surat->admin_note }}</p>
                        @if($surat->reviewed_at)
                            <p class="text-xs text-gray-400 mt-1">
                                <i class="far fa-clock"></i> 
                                {{ $surat->reviewed_at->format('d F Y H:i') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- ========================================== -->
        <!-- REVISION NOTE - If status is revisi -->
        <!-- ========================================== -->
        @if($surat->status == 'revisi' && ($surat->admin_comment || $surat->admin_note))
            <div class="bg-orange-50 border-l-4 border-orange-500 p-4 mb-6 rounded-r-lg">
                <div class="flex items-start gap-3">
                    <div class="text-orange-500 mt-1">
                        <i class="fas fa-edit text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-orange-800 text-sm">Perlu Revisi</h4>
                        <p class="text-gray-700 mt-1">{{ $surat->admin_comment ?? $surat->admin_note }}</p>
                        <a href="{{ route('surat.create') }}" class="mt-2 inline-block bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 text-sm font-bold">
                            <i class="fas fa-pencil-alt"></i> Perbaiki Data
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Data -->
        <div class="grid grid-cols-2 gap-4">
            <div><label class="text-sm text-gray-500">Nama</label><p class="font-medium">{{ $surat->form_data['nama'] ?? '-' }}</p></div>
            <div><label class="text-sm text-gray-500">NIK</label><p class="font-medium">{{ $surat->form_data['nik'] ?? '-' }}</p></div>
            <div><label class="text-sm text-gray-500">Umur</label><p class="font-medium">{{ $surat->form_data['umur'] ?? '-' }}</p></div>
            <div><label class="text-sm text-gray-500">Jenis Kelamin</label><p class="font-medium">{{ $surat->form_data['jenis_kelamin'] ?? '-' }}</p></div>
            <div class="col-span-2"><label class="text-sm text-gray-500">Alamat</label><p class="font-medium">{{ $surat->form_data['alamat'] ?? '-' }}</p></div>
            <div><label class="text-sm text-gray-500">Jenis Usaha</label><p class="font-medium">{{ $surat->form_data['usaha'] ?? '-' }}</p></div>
            <div><label class="text-sm text-gray-500">Lokasi Usaha</label><p class="font-medium">{{ $surat->form_data['lokasi_usaha'] ?? '-' }}</p></div>
            <div class="col-span-2"><label class="text-sm text-gray-500">Keperluan</label><p class="font-medium">{{ $surat->form_data['keperluan'] ?? '-' }}</p></div>
        </div>

        <!-- File Download -->
        @if($surat->file_path)
            <div class="mt-6 p-4 bg-green-50 rounded-lg">
                <p class="text-green-700">
                    <i class="fas fa-check-circle"></i> 
                    Surat sudah selesai. 
                    <a href="{{ asset('storage/' . $surat->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                        <i class="fas fa-download"></i> Download Surat
                    </a>
                </p>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ Auth::user()->is_admin ? route('admin.surat') : route('dashboard') }}" class="text-[#0B2E4F] hover:underline">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
<!-- Comments Section -->
@include('components.surat-comments', ['surat' => $surat])
</div>
@endsection