@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-blue-900">Ajukan Surat</h1>
    
    <form action="{{ route('surat.store') }}" method="POST" class="mt-6 bg-white p-6 rounded-xl shadow">
        @csrf
        
        <div class="mb-4">
            <label class="block font-bold text-gray-700">Jenis Surat</label>
            <select name="jenis_surat" class="w-full mt-1 p-2 border rounded-lg" required>
                <option value="domisili">Surat Keterangan Domisili</option>
                <option value="ktp_kk">Surat Pengantar KTP/KK</option>
                <option value="usaha">Surat Keterangan Usaha</option>
                <option value="tidak_mampu">Surat Keterangan Tidak Mampu</option>
            </select>
        </div>

        <!-- sini nambahkan input sesuai jenis surat (opsional) -->

        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 w-full">
            Kirim Pengajuan
        </button>
    </form>
</div>
@endsection