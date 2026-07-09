<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <a href="/" class="text-xl font-bold text-blue-800">
                    <i class="fas fa-file-alt text-yellow-500"></i> E-Surat Desa Binangun
                </a>
            </div>
            <div class="flex items-center gap-4">
                <a href="/" class="text-gray-700 hover:text-blue-600">Beranda</a>
                <a href="/layanan" class="text-gray-700 hover:text-blue-600">Layanan Surat</a>
                <a href="/kontak" class="text-gray-700 hover:text-blue-600">Kontak</a>
                @auth
                    <a href="/dashboard" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                    </form>
                @else
                    <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Masuk</a>
                    <a href="/register" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>