<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Surat Desa Binangun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-[#0B2E4F] text-white px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <i class="fas fa-file-alt text-[#E8A317] text-xl"></i>
                <span class="font-bold text-lg">E-Surat Desa Binangun</span>
                <span class="bg-[#E8A317] text-[#0B2E4F] text-xs px-2 py-1 rounded ml-2 font-bold">ADMIN</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-300">Halo, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('admin.simple.logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <h1 class="text-2xl font-bold text-[#0B2E4F] mb-6">Dashboard Admin</h1>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow">
                <div class="flex items-center gap-4">
                    <div class="bg-[#E8A317]/20 p-3 rounded-lg">
                        <i class="fas fa-users text-2xl text-[#E8A317]"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Users</p>
                        <p class="text-2xl font-bold text-[#0B2E4F]">{{ $totalUsers ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i class="fas fa-file-alt text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Surat</p>
                        <p class="text-2xl font-bold text-[#0B2E4F]">{{ $totalSurat ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <div class="flex items-center gap-4">
                    <div class="bg-yellow-100 p-3 rounded-lg">
                        <i class="fas fa-hourglass-half text-2xl text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Pending</p>
                        <p class="text-2xl font-bold text-[#0B2E4F]">{{ $pendingSurat ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <div class="flex items-center gap-4">
                    <div class="bg-green-100 p-3 rounded-lg">
                        <i class="fas fa-check-circle text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Selesai</p>
                        <p class="text-2xl font-bold text-[#0B2E4F]">{{ $selesaiSurat ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="#" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition group">
                <div class="flex items-center gap-4">
                    <div class="bg-[#0B2E4F] p-4 rounded-lg group-hover:bg-[#E8A317] transition">
                        <i class="fas fa-file-alt text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-[#0B2E4F]">Kelola Surat</h3>
                        <p class="text-sm text-gray-500">Lihat dan update status surat</p>
                    </div>
                </div>
            </a>

            <a href="#" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition group">
                <div class="flex items-center gap-4">
                    <div class="bg-[#0B2E4F] p-4 rounded-lg group-hover:bg-[#E8A317] transition">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-[#0B2E4F]">Kelola Users</h3>
                        <p class="text-sm text-gray-500">Manajemen pengguna</p>
                    </div>
                </div>
            </a>

            <a href="#" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition group">
                <div class="flex items-center gap-4">
                    <div class="bg-[#0B2E4F] p-4 rounded-lg group-hover:bg-[#E8A317] transition">
                        <i class="fas fa-id-card text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-[#0B2E4F]">Data Penduduk</h3>
                        <p class="text-sm text-gray-500">Kelola data warga</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</body>
</html>