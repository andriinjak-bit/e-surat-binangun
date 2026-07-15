@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow mt-16">
    <h2 class="text-2xl font-bold text-center text-blue-900">Daftar Akun</h2>
    
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mt-4">
            {{ $errors->first() }}
        </div>
    @endif
    
    <form method="POST" action="{{ route('register') }}" class="mt-6">
        @csrf
        
        <div class="mb-4">
            <label class="block font-bold">Nama Lengkap</label>
            <input type="text" name="name" class="w-full p-2 border rounded" required>
        </div>
        
        <div class="mb-4">
            <label class="block font-bold">NIK (Nomor Induk Kependudukan)</label>
            <input type="text" name="nik" class="w-full p-2 border rounded" required placeholder="16 digit sesuai KTP">
            <small class="text-gray-500 text-sm">Contoh: 1234567890123456</small>
        </div>
        
        <div class="mb-4">
            <label class="block font-bold">Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded" required>
        </div>
        
        <div class="mb-4">
            <label class="block font-bold">Password</label>
            <input type="password" name="password" class="w-full p-2 border rounded" required>
        </div>
        
        <div class="mb-4">
            <label class="block font-bold">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full p-2 border rounded" required>
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Daftar Sekarang</button>
    </form>
    <p class="text-center mt-4 text-sm">Sudah punya akun? <a href="/login" class="text-blue-600">Login</a></p>
</div>
<div class="text-center">
        <div class="mt-8 text-center"></div>
<a href="{{ route('beranda') }}" class="text-blue-600 hover:underline">
    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
</a>
    </div>
</div>
@endsection