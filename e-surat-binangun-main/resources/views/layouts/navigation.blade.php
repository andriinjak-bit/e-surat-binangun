<nav class="bg-[#0B2E4F] border-b border-[#061E33]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="text-xl font-bold text-[#E8A317]">
                    <i class="fas fa-file-alt"></i> E-Surat Desa Binangun
                </a>
            </div>
            
            <!-- Navigation Links -->
            <div class="flex items-center gap-4">
                <a href="/" class="text-gray-300 hover:text-[#E8A317] transition">Beranda</a>
                <a href="/layanan" class="text-gray-300 hover:text-[#E8A317] transition">Layanan Surat</a>
                <a href="/kontak" class="text-gray-300 hover:text-[#E8A317] transition">Kontak</a>
                
                @auth
                    <!-- Dashboard (for all logged-in users) -->
                    <a href="/dashboard" class="text-gray-300 hover:text-[#E8A317] transition">Dashboard</a>
                    
                    <!-- Profile (for all logged-in users) -->
                    <a href="{{ route('profile.index') }}" class="text-gray-300 hover:text-[#E8A317] transition">
                        <i class="fas fa-user"></i> Profil
                    </a>
                    
                    <!-- Admin Panel (only for admins) -->
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-[#E8A317] font-bold hover:text-[#F4C542] transition">Admin Panel</a>
                    @endif
                    
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-red-300 transition">Logout</button>
                    </form>
                @else
                    <!-- Guest buttons -->
                    <a href="/login" class="bg-[#E8A317] text-[#061E33] px-4 py-2 rounded-lg hover:bg-[#F4C542] transition font-bold">Masuk</a>
                    <a href="/register" class="bg-[#1E8449] text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-bold">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>