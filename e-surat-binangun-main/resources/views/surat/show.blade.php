@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-blue-900">Detail Surat</h1>
    
    <div class="mt-6 bg-white p-6 rounded-xl shadow">
        <p><strong>Jenis:</strong> {{ ucfirst($surat->jenis_surat) }}</p>
        <p><strong>Tanggal:</strong> {{ $surat->created_at->format('d M Y H:i') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($surat->status) }}</p>
        @if($surat->keterangan)
            <p><strong>Keterangan:</strong> {{ $surat->keterangan }}</p>
        @endif
        <a href="{{ Auth::user()->is_admin ? route('admin.surat') : route('dashboard') }}" class="mt-4 inline-block text-blue-600 hover:underline">Kembali</a>
    </div>
</div>
@endsection