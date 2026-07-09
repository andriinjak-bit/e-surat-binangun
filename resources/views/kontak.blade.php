@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-center text-blue-900 mb-8">Kontak Kantor Desa Binangun</h1>

    <div class="grid md:grid-cols-2 gap-8">

        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold text-blue-800 mb-4">Informasi Kontak</h2>

            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <i class="fas fa-map-marker-alt text-blue-600 text-xl mt-1"></i>
                    <div>
                        <p class="font-bold">Alamat</p>
                        <p class="text-gray-600">Kantor Desa Binangun<br>Kecamatan Binangun, Kabupaten Blitar</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <i class="fas fa-phone text-blue-600 text-xl mt-1"></i>
                    <div>
                        <p class="font-bold">Telepon</p>
                        <p class="text-gray-600">(0342) 123-4567</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <i class="fab fa-whatsapp text-green-600 text-xl mt-1"></i>
                    <div>
                        <p class="font-bold">WhatsApp</p>
                        <p class="text-gray-600">0812-3456-7890</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <i class="fas fa-envelope text-blue-600 text-xl mt-1"></i>
                    <div>
                        <p class="font-bold">Email</p>
                        <p class="text-gray-600">desa@binangun.go.id</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <i class="fas fa-clock text-blue-600 text-xl mt-1"></i>
                    <div>
                        <p class="font-bold">Jam Layanan</p>
                        <p class="text-gray-600">Senin–Jumat, 08.00–15.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>

<div class="bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-bold text-desa-blue mb-4">Lokasi Kantor Desa</h2>
    

    <div class="h-64 rounded-lg overflow-hidden">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15794.753174116198!2d112.3163377871582!3d-8.234066299999986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78bc27e75d45d9%3A0xdb78f2c2ec27e975!2sBinangun%20Sub-District%20Office%20-%20Blitar!5e0!3m2!1sen!2sid!4v1783514458057!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
    </div>
    
    <p class="text-sm text-gray-500 mt-2">
        <i class="fas fa-info-circle"></i> 
        Anda juga bisa datang langsung ke kantor desa pada jam kerja.
    </p>
</div>

        <div class="mt-8 text-center"></div>
<a href="{{ route('beranda') }}" class="text-blue-600 hover:underline">
    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
</a>
    </div>
</div>
@endsection