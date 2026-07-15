@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 bg-gray-50">
    <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-lg">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-[#0B2E4F]">Register Admin</h2>
            <p class="text-gray-600 mt-2">Buat akun administrator desa</p>
        </div>
        
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mt-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <form method="POST" action="{{ route('admin.register') }}" class="mt-6">
            @csrf
            
            <div class="mb-3">
                <label class="block font-bold text-gray-700 text-sm">Nama Lengkap</label>
                <input type="text" name="name" class="w-full p-2 border rounded-lg focus:ring-[#E8A317]" value="{{ old('name') }}" required>
            </div>
            
            <div class="mb-3">
                <label class="block font-bold text-gray-700 text-sm">NIK (16 digit)</label>
                <input type="text" name="nik" class="w-full p-2 border rounded-lg focus:ring-[#E8A317]" value="{{ old('nik') }}" required maxlength="16" placeholder="1234567890123456">
            </div>
            
            <div class="mb-3">
                <label class="block font-bold text-gray-700 text-sm">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded-lg focus:ring-[#E8A317]" value="{{ old('email') }}" required>
            </div>
            
            <div class="mb-3">
                <label class="block font-bold text-gray-700 text-sm">No. HP</label>
                <input type="text" name="phone" class="w-full p-2 border rounded-lg focus:ring-[#E8A317]" value="{{ old('phone') }}" placeholder="081234567890">
            </div>
            
            <div class="mb-3">
                <label class="block font-bold text-gray-700 text-sm">Dusun</label>
                <input type="text" name="dusun" class="w-full p-2 border rounded-lg focus:ring-[#E8A317]" value="{{ old('dusun') }}" placeholder="Contoh: Krajan">
            </div>
            
            <div class="mb-3">
                <label class="block font-bold text-gray-700 text-sm">Alamat Lengkap</label>
                <textarea name="alamat" class="w-full p-2 border rounded-lg focus:ring-[#E8A317]" rows="2" placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
            </div>
            
            <div class="mb-3">
                <label class="block font-bold text-gray-700 text-sm">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded-lg focus:ring-[#E8A317]" required minlength="8" placeholder="Minimal 8 karakter">
            </div>
            
            <div class="mb-4">
                <label class="block font-bold text-gray-700 text-sm">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full p-2 border rounded-lg focus:ring-[#E8A317]" required>
            </div>
            
            <button type="submit" class="w-full bg-[#E8A317] text-[#061E33] py-2 rounded-lg hover:bg-[#F4C542] transition font-bold">
                Register Admin
            </button>
        </form>
        
        <p class="text-center mt-4 text-sm">
            Sudah punya akun admin? 
            <a href="{{ route('admin.login') }}" class="text-[#E8A317] font-bold">Login di sini</a>
        </p>
    </div>
</div>
@endsection