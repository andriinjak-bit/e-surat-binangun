@extends('layouts.app')

@section('content')
<div class="relative bg-gradient-to-r from-blue-900 to-blue-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold">Urus Surat Desa Tanpa Perlu Antre di Kantor</h1>
        <p class="text-xl mt-4 text-blue-100">Ajukan surat keterangan, surat pengantar, dan dokumen desa lainnya langsung dari rumah.</p>
        
        @guest
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-yellow-500 text-blue-900 px-8 py-3 rounded-lg font-bold hover:bg-yellow-400">Daftar Akun Baru</a>
                <a href="{{ route('login') }}" class="bg-white text-blue-900 px-8 py-3 rounded-lg font-bold hover:bg-gray-100">Sudah Punya Akun</a>
            </div>
        @endguest

        @auth
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="{{ route('dashboard') }}" class="bg-green-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-green-600">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <!-- <a href="{{ route('logout') }}" class="bg-red-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-red-600"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a> -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        @endauth
    </div>
</div>

<!-- Cara Mengajukan Surat -->
<div class="max-w-7xl mx-auto px-4 py-16">
    <h2 class="text-3xl font-bold text-center text-blue-900">Cara Mengajukan Surat</h2>
    <p class="text-center text-gray-600 mb-12">Hanya 3 langkah sederhana, bisa dilakukan sendiri dari HP</p>
    <div class="grid md:grid-cols-3 gap-8">
        <div class="text-center bg-white p-6 rounded-xl shadow">
            <div class="bg-yellow-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto text-2xl font-bold text-blue-900">1</div>
            <h3 class="text-xl font-bold mt-4 text-blue-800">Daftar Akun</h3>
            <p class="text-gray-600 mt-2">Isi nama, NIK, dan alamat sekali saja untuk membuat akun.</p>
        </div>
        <div class="text-center bg-white p-6 rounded-xl shadow">
            <div class="bg-yellow-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto text-2xl font-bold text-blue-900">2</div>
            <h3 class="text-xl font-bold mt-4 text-blue-800">Pilih Jenis Surat</h3>
            <p class="text-gray-600 mt-2">Pilih surat yang dibutuhkan, lalu isi formulir singkat.</p>
        </div>
        <div class="text-center bg-white p-6 rounded-xl shadow">
            <div class="bg-yellow-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto text-2xl font-bold text-blue-900">3</div>
            <h3 class="text-xl font-bold mt-4 text-blue-800">Surat Siap Diambil</h3>
            <p class="text-gray-600 mt-2">Petugas desa memproses, lalu Anda akan dihubungi saat surat siap.</p>
        </div>
    </div>
</div>

<!-- Layanan Surat -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-blue-900">Layanan Surat yang Tersedia</h2>
        <p class="text-center text-gray-600 mb-12">Pilih sesuai kebutuhan Anda</p>
        <div class="grid md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow text-center hover:shadow-lg transition">
                <i class="fas fa-home text-4xl text-blue-800"></i>
                <h4 class="font-bold mt-3">Surat Keterangan Domisili</h4>
                <p class="text-sm text-gray-600">Untuk keperluan administrasi tempat tinggal.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow text-center hover:shadow-lg transition">
                <i class="fas fa-id-card text-4xl text-blue-800"></i>
                <h4 class="font-bold mt-3">Surat Pengantar KTP/KK</h4>
                <p class="text-sm text-gray-600">Pengantar untuk pengurusan KTP atau Kartu Keluarga.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow text-center hover:shadow-lg transition">
                <i class="fas fa-store text-4xl text-blue-800"></i>
                <h4 class="font-bold mt-3">Surat Keterangan Usaha</h4>
                <p class="text-sm text-gray-600">Untuk keperluan usaha, pinjaman, atau bantuan modal.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow text-center hover:shadow-lg transition">
                <i class="fas fa-hand-holding-heart text-4xl text-blue-800"></i>
                <h4 class="font-bold mt-3">Surat Keterangan Tidak Mampu</h4>
                <p class="text-sm text-gray-600">Untuk keperluan bantuan sosial dan beasiswa.</p>
            </div>
        </div>
    </div>
</div>
@endsection