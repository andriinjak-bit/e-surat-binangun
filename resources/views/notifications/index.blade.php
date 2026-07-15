@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#0B2E4F]">Notifikasi</h1>
        <div class="flex gap-2">
            <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                @csrf
                <button type="submit" class="bg-[#E8A317] text-[#061E33] px-4 py-2 rounded-lg hover:bg-[#F4C542] font-bold text-sm">
                    <i class="fas fa-check-double"></i> Tandai Semua Dibaca
                </button>
            </form>
            <form action="{{ route('notifications.clear-all') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 font-bold text-sm" onclick="return confirm('Hapus semua notifikasi?')">
                    <i class="fas fa-trash"></i> Hapus Semua
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($notifications->isEmpty())
        <div class="bg-white rounded-xl shadow p-8 text-center text-gray-500">
            <i class="fas fa-bell-slash text-4xl mb-4"></i>
            <p>Tidak ada notifikasi</p>
        </div>
    @else
        <div class="bg-white rounded-xl shadow overflow-hidden">
            @foreach($notifications as $notification)
                <div class="border-b border-gray-100 p-4 hover:bg-gray-50 transition {{ is_null($notification->read_at) ? 'bg-blue-50' : '' }}">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 mt-1">
                            @if(is_null($notification->read_at))
                                <span class="w-2 h-2 bg-blue-500 rounded-full inline-block"></span>
                            @else
                                <span class="w-2 h-2 bg-gray-300 rounded-full inline-block"></span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <h3 class="font-bold text-[#0B2E4F]">{{ $notification->title }}</h3>
                                <span class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 mt-1">{{ $notification->message }}</p>
                            <div class="flex flex-wrap items-center gap-3 mt-2">
                                @if(is_null($notification->read_at))
                                    <form action="{{ route('notifications.mark-read', $notification->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-xs text-blue-600 hover:underline">
                                            <i class="fas fa-check"></i> Tandai Dibaca
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('notifications.delete', $notification->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs text-red-500 hover:underline" onclick="return confirm('Hapus notifikasi ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="text-xs text-gray-400 flex-shrink-0">
                            {{ $notification->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $notifications->links() }}
        </div>
    @endif

    <!-- ========================================== -->
    <!-- KEMBALI BUTTON -->
    <!-- ========================================== -->
    <div class="mt-6 flex items-center gap-4">
        <!-- Option 1: Link style -->
        <a href="{{ route('admin.dashboard') }}" class="text-[#0B2E4F] hover:underline">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        
        <!-- Option 2: Button style (uncomment if you prefer this) -->
        <!-- 
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition font-bold">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        -->
    </div>
</div>
@endsection