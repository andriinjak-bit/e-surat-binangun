@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 bg-gray-50">
    <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-lg">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-[#0B2E4F]">Admin Login</h2>
            <p class="text-gray-600 mt-2">Masuk ke panel admin desa</p>
        </div>
        
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mt-4">
                {{ $errors->first() }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mt-4">
                {{ session('error') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('login.post') }}" class="mt-6">
            @csrf
            <div class="mb-3">
                <label class="block font-bold text-gray-700 text-sm">NIK atau Email</label>
                <input type="text" name="login" class="w-full p-2 border rounded-lg focus:ring-[#E8A317]" required placeholder="Masukkan NIK atau email">
            </div>
            
            <div class="mb-4">
                <label class="block font-bold text-gray-700 text-sm">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded-lg focus:ring-[#E8A317]" required placeholder="Masukkan password">
            </div>
            
            <button type="submit" class="w-full bg-[#0B2E4F] text-white py-2 rounded-lg hover:bg-[#1B4A7A] transition font-bold">
                Login Admin
            </button>
        </form>
        
        <p class="text-center mt-4 text-sm">
            Belum punya akun admin? 
            <a href="{{ route('admin.register') }}" class="text-[#E8A317] font-bold">Register di sini</a>
        </p>
        <p class="text-center mt-2">
            <a href="/" class="text-gray-500 hover:text-gray-700 text-sm">← Kembali ke Beranda</a>
        </p>
    </div>
</div>
@endsection