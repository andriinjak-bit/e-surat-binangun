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
                    <!-- Profile Link -->
                    <a href="{{ route('profile.index') }}" class="text-gray-300 hover:text-[#E8A317] transition">
                     Profil
                    </a>
                    
                    <!-- Dashboard -->
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-[#E8A317] transition">Dashboard</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-[#E8A317] transition">Dashboard</a>
                    @endif
                    
                    <!-- ========================================== -->
                    <!-- PENDUDUK - Only for Admin -->
                    <!-- ========================================== -->
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.penduduk.index') }}" class="text-gray-300 hover:text-[#E8A317] transition">
                        Penduduk
                        </a>
                        <!-- Activity Logs -->
                        <a href="{{ route('admin.logs') }}" class="text-gray-300 hover:text-[#E8A317] transition">
                        Activity Logs
                        </a>
                    @endif
                    
                    <!-- 🔔 NOTIFICATIONS (Only for Admin) -->
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('notifications.index') }}" class="text-gray-300 hover:text-[#E8A317] transition relative">
                            <i class="fas fa-bell text-xl"></i>
                            <span id="notification-badge" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
                        </a>
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

<!-- Script for Notification Badge -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    @auth
    @if(Auth::user()->is_admin)
    fetchUnreadCount();
    @endif
    @endauth
});

function fetchUnreadCount() {
    fetch('{{ route("notifications.unread-count") }}')
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('notification-badge');
            if (data.count > 0) {
                badge.textContent = data.count > 99 ? '99+' : data.count;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        })
        .catch(error => {
            console.error('Error fetching notifications:', error);
            // Hide badge if error
            const badge = document.getElementById('notification-badge');
            badge.classList.add('hidden');
        });
}

// Refresh notification count every 30 seconds
setInterval(fetchUnreadCount, 30000);
</script>