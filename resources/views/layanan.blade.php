@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-center text-blue-900 mb-4">Layanan Surat yang Tersedia</h1>
    <p class="text-center text-gray-600 mb-12">Pilih sesuai kebutuhan Anda</p>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($templates as $template)
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center flex flex-col justify-between">
            <div>
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-alt text-2xl text-blue-800"></i>
                </div>
                <h3 class="text-lg font-bold text-blue-900">{{ $template->judul }}</h3>
            </div>
            <a href="{{ route('surat.request.create', $template->id) }}" class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Ajukan →</a>
        </div>
        @empty
        <div class="col-span-full text-center py-8">
            <p class="text-gray-500">Belum ada template surat yang tersedia.</p>
        </div>
        @endforelse
    </div>



        <div class="mt-8 text-center"></div>
<a href="{{ route('beranda') }}" class="text-blue-600 hover:underline">
    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
</a>
    </div>
    
</div>
@endsection

