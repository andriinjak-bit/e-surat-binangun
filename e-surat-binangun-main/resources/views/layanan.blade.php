@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-center text-blue-900 mb-4">Layanan Surat yang Tersedia</h1>
    <p class="text-center text-gray-600 mb-12">Pilih sesuai kebutuhan Anda</p>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- 1. Surat Keterangan Domisili -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-home text-2xl text-blue-800"></i>
            </div>
            <h3 class="text-lg font-bold text-blue-900">Surat Keterangan Domisili</h3>
            <p class="text-sm text-gray-600 mt-2">Untuk keperluan administrasi tempat tinggal.</p>
            <a href="#" class="inline-block mt-4 text-blue-600 hover:underline">Ajukan →</a>
        </div>

        <!-- 2. Surat Pengantar KTP/KK -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-id-card text-2xl text-blue-800"></i>
            </div>
            <h3 class="text-lg font-bold text-blue-900">Surat Pengantar KTP/KK</h3>
            <p class="text-sm text-gray-600 mt-2">Pengantar untuk pengurusan KTP atau Kartu Keluarga.</p>
            <a href="#" class="inline-block mt-4 text-blue-600 hover:underline">Ajukan →</a>
        </div>

        <!-- 3. Surat Keterangan Usaha -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-store text-2xl text-blue-800"></i>
            </div>
            <h3 class="text-lg font-bold text-blue-900">Surat Keterangan Usaha</h3>
            <p class="text-sm text-gray-600 mt-2">Untuk keperluan usaha, pinjaman, atau bantuan modal.</p>
            <a href="#" class="inline-block mt-4 text-blue-600 hover:underline">Ajukan →</a>
        </div>

        <!-- 4. Surat Keterangan Tidak Mampu -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-hand-holding-heart text-2xl text-blue-800"></i>
            </div>
            <h3 class="text-lg font-bold text-blue-900">Surat Keterangan Tidak Mampu</h3>
            <p class="text-sm text-gray-600 mt-2">Untuk keperluan bantuan sosial dan beasiswa.</p>
            <a href="#" class="inline-block mt-4 text-blue-600 hover:underline">Ajukan →</a>
        </div>
    </div>



        <div class="mt-8 text-center"></div>
<a href="{{ route('beranda') }}" class="text-blue-600 hover:underline">
    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
</a>
    </div>
    
</div>
@endsection

