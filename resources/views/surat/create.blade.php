@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-[#0B2E4F] mb-6">Ajukan Surat</h1>

    @if(session('info'))
        <div class="bg-orange-100 text-orange-700 p-4 rounded-lg mb-6">
            {{ session('info') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow">
        <form action="{{ route('surat.store') }}" method="POST" id="suratForm">
            @csrf

<!-- JENIS SURAT - DROPDOWN -->
<div class="mb-6">
    <label class="block font-bold text-gray-700 text-sm mb-1">Pilih Jenis Surat *</label>
    <select name="jenis_surat" id="jenis_surat" class="w-full p-2 border rounded" required onchange="toggleForm()">
        <option value="">-- Pilih Jenis Surat --</option>
        <option value="usaha" {{ old('jenis_surat') == 'usaha' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
        <option value="domisili" {{ old('jenis_surat') == 'domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
        <option value="ktp_kk" {{ old('jenis_surat') == 'ktp_kk' ? 'selected' : '' }}>Surat Pengantar KTP/KK</option>
        <option value="tidak_mampu" {{ old('jenis_surat') == 'tidak_mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu</option>
        <option value="tanah" {{ old('jenis_surat') == 'tanah' ? 'selected' : '' }}>Surat Keterangan Tanah</option>
        <option value="barang" {{ old('jenis_surat') == 'barang' ? 'selected' : '' }}>Surat Keterangan Kepemilikan Barang</option>
        <option value="kehilangan" {{ old('jenis_surat') == 'kehilangan' ? 'selected' : '' }}>Surat Pengantar Kehilangan</option>
        <option value="kematian" {{ old('jenis_surat') == 'kematian' ? 'selected' : '' }}>Surat Keterangan Kematian</option>
        <option value="skck" {{ old('jenis_surat') == 'skck' ? 'selected' : '' }}>Surat Pengantar SKCK</option>
    </select>
</div>


<!-- SURAT USAHA FORM -->
<div id="form-usaha" class="surat-form" style="display: none;">
    <h3 class="font-bold text-[#0B2E4F] mb-4">Form Surat Keterangan Usaha</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Nama Lengkap *</label>
            <input type="text" name="nama" value="{{ old('nama', $user->name ?? '') }}" class="w-full p-2 border rounded" placeholder="Masukkan nama lengkap">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">NIK *</label>
            <input type="text" name="nik" value="{{ old('nik', $user->nik ?? '') }}" class="w-full p-2 border rounded" placeholder="Masukkan NIK 16 digit">
        </div>
        <!-- Umur -->
<!-- Umur -->
<div>
    <label class="block font-bold text-gray-700 text-sm mb-1">Umur *</label>
    <input type="text" name="umur" 
           value="{{ old('umur', isset($user->tanggal_lahir) ? \Carbon\Carbon::parse($user->tanggal_lahir)->age . ' Tahun' : '') }}" 
           class="w-full p-2 border rounded" 
           placeholder="Contoh: 60 Tahun">
</div>

<!-- Jenis Kelamin -->
<div>
    <label class="block font-bold text-gray-700 text-sm mb-1">Jenis Kelamin *</label>
    <select name="jenis_kelamin" class="w-full p-2 border rounded">
        <option value="">Pilih</option>
        <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
        <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
    </select>
</div>


        <div class="md:col-span-2">
            <label class="block font-bold text-gray-700 text-sm mb-1">Alamat *</label>
            <textarea name="alamat" rows="2" class="w-full p-2 border rounded" placeholder="Contoh: Dusun Kaliwungu RT. 001 RW. 001 Desa Binangun">{{ old('alamat', $user->alamat ?? '') }}</textarea>
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Jenis Usaha *</label>
            <input type="text" name="usaha" value="{{ old('usaha') }}" class="w-full p-2 border rounded" placeholder="Contoh: Ternak Sapi">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Lokasi Usaha *</label>
            <input type="text" name="lokasi_usaha" value="{{ old('lokasi_usaha') }}" class="w-full p-2 border rounded" placeholder="Contoh: Dusun Kaliwungu RT. 001 RW. 001">
        </div>
        <div class="md:col-span-2">
            <label class="block font-bold text-gray-700 text-sm mb-1">Keperluan / Tujuan *</label>
            <input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full p-2 border rounded" placeholder="Contoh: Persyaratan kredit di Bank BRI">
        </div>
    </div>
</div>

            <!-- SURAT DOMISILI FORM -->
            <div id="form-domisili" class="surat-form" style="display: none;">
                <h3 class="font-bold text-[#0B2E4F] mb-4">Form Surat Keterangan Domisili</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Nama Lengkap *</label><input type="text" name="nama" value="{{ old('nama', Auth::user()->name) }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">NIK *</label><input type="text" name="nik" value="{{ old('nik', Auth::user()->nik) }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Tempat, Tanggal Lahir *</label><input type="text" name="ttl" value="{{ old('ttl') }}" class="w-full p-2 border rounded" placeholder="Blitar, 1 Januari 1980"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" class="w-full p-2 border rounded">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Agama *</label><input type="text" name="agama" value="{{ old('agama') }}" class="w-full p-2 border rounded" placeholder="Islam/Kristen/dll"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Pekerjaan *</label><input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" class="w-full p-2 border rounded" placeholder="Petani/PNS/dll"></div>
                    <div class="md:col-span-2"><label class="block font-bold text-gray-700 text-sm mb-1">Alamat Lengkap *</label><textarea name="alamat" rows="2" class="w-full p-2 border rounded" placeholder="Alamat lengkap">{{ old('alamat', Auth::user()->alamat) }}</textarea></div>
                    <div class="md:col-span-2"><label class="block font-bold text-gray-700 text-sm mb-1">Keperluan *</label><input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full p-2 border rounded" placeholder="Untuk keperluan administrasi"></div>
                </div>
            </div>

            <!-- SURAT KTP/KK FORM -->
            <div id="form-ktp_kk" class="surat-form" style="display: none;">
                <h3 class="font-bold text-[#0B2E4F] mb-4">Form Surat Pengantar KTP/KK</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Nama Lengkap *</label><input type="text" name="nama" value="{{ old('nama', Auth::user()->name) }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">NIK *</label><input type="text" name="nik" value="{{ old('nik', Auth::user()->nik) }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Tempat, Tanggal Lahir *</label><input type="text" name="ttl" value="{{ old('ttl') }}" class="w-full p-2 border rounded" placeholder="Blitar, 1 Januari 1980"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" class="w-full p-2 border rounded">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="md:col-span-2"><label class="block font-bold text-gray-700 text-sm mb-1">Alamat *</label><textarea name="alamat" rows="2" class="w-full p-2 border rounded" placeholder="Alamat lengkap">{{ old('alamat', Auth::user()->alamat) }}</textarea></div>
                    <div class="md:col-span-2"><label class="block font-bold text-gray-700 text-sm mb-1">Keperluan *</label><input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full p-2 border rounded" placeholder="Untuk pengurusan KTP/KK"></div>
                </div>
            </div>

            <!-- SURAT TIDAK MAMPU FORM -->
            <div id="form-tidak_mampu" class="surat-form" style="display: none;">
                <h3 class="font-bold text-[#0B2E4F] mb-4">Form Surat Keterangan Tidak Mampu</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Nama Lengkap *</label><input type="text" name="nama" value="{{ old('nama', Auth::user()->name) }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">NIK *</label><input type="text" name="nik" value="{{ old('nik', Auth::user()->nik) }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Tempat, Tanggal Lahir *</label><input type="text" name="ttl" value="{{ old('ttl') }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" class="w-full p-2 border rounded">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Pekerjaan *</label><input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" class="w-full p-2 border rounded"></div>
                    <div class="md:col-span-2"><label class="block font-bold text-gray-700 text-sm mb-1">Alamat *</label><textarea name="alamat" rows="2" class="w-full p-2 border rounded">{{ old('alamat', Auth::user()->alamat) }}</textarea></div>
                    <div class="md:col-span-2"><label class="block font-bold text-gray-700 text-sm mb-1">Keperluan *</label><input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full p-2 border rounded" placeholder="Untuk bantuan sosial/beasiswa"></div>
                </div>
            </div>

            <!-- SURAT TANAH FORM -->
            <div id="form-tanah" class="surat-form" style="display: none;">
                <h3 class="font-bold text-[#0B2E4F] mb-4">Form Surat Keterangan Tanah</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Nama Pemilik *</label><input type="text" name="nama" value="{{ old('nama', Auth::user()->name) }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">NIK *</label><input type="text" name="nik" value="{{ old('nik', Auth::user()->nik) }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Luas Tanah *</label><input type="text" name="luas" value="{{ old('luas') }}" class="w-full p-2 border rounded" placeholder="Contoh: 3.670 M2"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Nomor Sertifikat *</label><input type="text" name="sertifikat" value="{{ old('sertifikat') }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Lokasi Tanah *</label><input type="text" name="lokasi_tanah" value="{{ old('lokasi_tanah') }}" class="w-full p-2 border rounded"></div>
                    <div class="md:col-span-2"><label class="block font-bold text-gray-700 text-sm mb-1">Alamat Pemilik *</label><textarea name="alamat" rows="2" class="w-full p-2 border rounded">{{ old('alamat', Auth::user()->alamat) }}</textarea></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Batas Utara *</label><input type="text" name="batas_utara" value="{{ old('batas_utara') }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Batas Selatan *</label><input type="text" name="batas_selatan" value="{{ old('batas_selatan') }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Batas Timur *</label><input type="text" name="batas_timur" value="{{ old('batas_timur') }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Batas Barat *</label><input type="text" name="batas_barat" value="{{ old('batas_barat') }}" class="w-full p-2 border rounded"></div>
                    <div class="md:col-span-2"><label class="block font-bold text-gray-700 text-sm mb-1">Keperluan *</label><input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full p-2 border rounded"></div>
                </div>
            </div>

            <!-- SURAT BARANG FORM -->
            <div id="form-barang" class="surat-form" style="display: none;">
                <h3 class="font-bold text-[#0B2E4F] mb-4">Form Surat Keterangan Kepemilikan Barang</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Nama Pemilik *</label><input type="text" name="nama" value="{{ old('nama', Auth::user()->name) }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">NIK *</label><input type="text" name="nik" value="{{ old('nik', Auth::user()->nik) }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Umur *</label><input type="text" name="umur" value="{{ old('umur') }}" class="w-full p-2 border rounded"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" class="w-full p-2 border rounded">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Jenis Barang *</label><input type="text" name="jenis_barang" value="{{ old('jenis_barang') }}" class="w-full p-2 border rounded" placeholder="Contoh: Sepeda Motor Honda Beat 2012"></div>
                    <div><label class="block font-bold text-gray-700 text-sm mb-1">Nomor Polisi *</label><input type="text" name="no_polisi" value="{{ old('no_polisi') }}" class="w-full p-2 border rounded"></div>
                    <div class="md:col-span-2"><label class="block font-bold text-gray-700 text-sm mb-1">Alamat *</label><textarea name="alamat" rows="2" class="w-full p-2 border rounded">{{ old('alamat', Auth::user()->alamat) }}</textarea></div>
                    <div class="md:col-span-2"><label class="block font-bold text-gray-700 text-sm mb-1">Keperluan *</label><input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full p-2 border rounded"></div>
                </div>
            </div>

            <!-- SURAT KEHILANGAN FORM -->
<div id="form-kehilangan" class="surat-form" style="display: none;">
    <h3 class="font-bold text-[#0B2E4F] mb-4">Form Surat Pengantar Kehilangan</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Nama Lengkap *</label>
            <input type="text" name="nama" value="{{ old('nama', $user->name ?? '') }}" class="w-full p-2 border rounded" placeholder="Masukkan nama lengkap">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">NIK *</label>
            <input type="text" name="nik" value="{{ old('nik', $user->nik ?? '') }}" class="w-full p-2 border rounded" placeholder="Masukkan NIK 16 digit">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Tempat, Tanggal Lahir *</label>
            <input type="text" name="ttl" value="{{ old('ttl', ($user->tempat_lahir ?? '') . ', ' . (isset($user->tanggal_lahir) ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d-m-Y') : '')) }}" class="w-full p-2 border rounded" placeholder="Blitar, 25-12-1979">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Jenis Kelamin *</label>
            <select name="jenis_kelamin" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Status *</label>
            <select name="status_perkawinan" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Kawin" {{ old('status_perkawinan', $user->status_perkawinan ?? '') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                <option value="Belum Kawin" {{ old('status_perkawinan', $user->status_perkawinan ?? '') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                <option value="Cerai" {{ old('status_perkawinan', $user->status_perkawinan ?? '') == 'Cerai' ? 'selected' : '' }}>Cerai</option>
            </select>
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Pekerjaan *</label>
            <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan ?? '') }}" class="w-full p-2 border rounded" placeholder="Karyawan Swasta">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Agama *</label>
            <select name="agama" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Islam" {{ old('agama', $user->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama', $user->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama', $user->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('agama', $user->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('agama', $user->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('agama', $user->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block font-bold text-gray-700 text-sm mb-1">Alamat Lengkap *</label>
            <textarea name="alamat" rows="2" class="w-full p-2 border rounded" placeholder="RT.003 RW.001 Dusun Sambirejo Desa Binangun Kecamatan Binangun Kabupaten Blitar">{{ old('alamat', $user->alamat ?? '') }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="block font-bold text-gray-700 text-sm mb-1">Dokumen yang Hilang / Keperluan *</label>
            <input type="text" name="dokumen_hilang" value="{{ old('dokumen_hilang') }}" class="w-full p-2 border rounded" placeholder="Contoh: KK dengan No. 3505161908061155">
        </div>
        <div class="md:col-span-2">
            <label class="block font-bold text-gray-700 text-sm mb-1">Tujuan / Keperluan *</label>
            <input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full p-2 border rounded" placeholder="Contoh: Pengantar kehilangan KK di Polsek Binangun">
        </div>
    </div>
</div>




<!-- SURAT TIDAK MAMPU FORM (SKTM) -->
<div id="form-tidak_mampu" class="surat-form" style="display: none;">
    <h3 class="font-bold text-[#0B2E4F] mb-4">Form Surat Keterangan Tidak Mampu (SKTM)</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Nama Lengkap *</label>
            <input type="text" name="nama" value="{{ old('nama', $user->name ?? '') }}" class="w-full p-2 border rounded" placeholder="Masukkan nama lengkap">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">NIK *</label>
            <input type="text" name="nik" value="{{ old('nik', $user->nik ?? '') }}" class="w-full p-2 border rounded" placeholder="Masukkan NIK 16 digit">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Tempat & Tanggal Lahir *</label>
            <input type="text" name="ttl" value="{{ old('ttl', ($user->tempat_lahir ?? '') . ', ' . (isset($user->tanggal_lahir) ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d-m-Y') : '')) }}" class="w-full p-2 border rounded" placeholder="Blitar, 02-01-1967">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Jenis Kelamin *</label>
            <select name="jenis_kelamin" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Pekerjaan *</label>
            <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan ?? '') }}" class="w-full p-2 border rounded" placeholder="Petani/Swasta">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Agama *</label>
            <select name="agama" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Islam" {{ old('agama', $user->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama', $user->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama', $user->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('agama', $user->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('agama', $user->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('agama', $user->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block font-bold text-gray-700 text-sm mb-1">Alamat Lengkap *</label>
            <textarea name="alamat" rows="2" class="w-full p-2 border rounded" placeholder="RT. 004 RW. 001 Dusun Selok Desa Binangun Kecamatan Binangun Kabupaten Blitar">{{ old('alamat', $user->alamat ?? '') }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="block font-bold text-gray-700 text-sm mb-1">Keperluan / Tujuan *</label>
            <input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full p-2 border rounded" placeholder="Contoh: Pembiayaan Kesehatan Masyarakat Miskin di RSUD">
        </div>
        <div class="md:col-span-2">
            <label class="block font-bold text-gray-700 text-sm mb-1">Keterangan Tambahan (Opsional)</label>
            <textarea name="keterangan_tambahan" rows="2" class="w-full p-2 border rounded" placeholder="Keterangan tambahan jika ada...">{{ old('keterangan_tambahan') }}</textarea>
        </div>
    </div>
</div>

<!-- SURAT KEMATIAN FORM -->
<div id="form-kematian" class="surat-form" style="display: none;">
    <h3 class="font-bold text-[#0B2E4F] mb-4">Form Surat Keterangan Kematian</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Nama Almarhum/Almarhumah *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full p-2 border rounded" placeholder="Masukkan nama almarhum/almarhumah">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Jenis Kelamin *</label>
            <select name="jenis_kelamin" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">NIK (Nomor Induk Kependudukan)</label>
            <input type="text" name="nik" value="{{ old('nik') }}" class="w-full p-2 border rounded" placeholder="Masukkan NIK 16 digit">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Tempat & Tanggal Lahir *</label>
            <input type="text" name="ttl" value="{{ old('ttl') }}" class="w-full p-2 border rounded" placeholder="Blitar, 08-02-1927">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Umur (Saat Meninggal) *</label>
            <input type="text" name="umur" value="{{ old('umur') }}" class="w-full p-2 border rounded" placeholder="Contoh: 78 Tahun">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Alamat Terakhir *</label>
            <input type="text" name="alamat" value="{{ old('alamat') }}" class="w-full p-2 border rounded" placeholder="Dsn. Binangun RT.03 RW.02 Desa Binangun Kec. Binangun">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Hari Meninggal *</label>
            <select name="hari_meninggal" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Senin" {{ old('hari_meninggal') == 'Senin' ? 'selected' : '' }}>Senin</option>
                <option value="Selasa" {{ old('hari_meninggal') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                <option value="Rabu" {{ old('hari_meninggal') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                <option value="Kamis" {{ old('hari_meninggal') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                <option value="Jumat" {{ old('hari_meninggal') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                <option value="Sabtu" {{ old('hari_meninggal') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                <option value="Minggu" {{ old('hari_meninggal') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
            </select>
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Tanggal Meninggal *</label>
            <input type="date" name="tanggal_meninggal" value="{{ old('tanggal_meninggal') }}" class="w-full p-2 border rounded">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Tempat Meninggal *</label>
            <input type="text" name="tempat_meninggal" value="{{ old('tempat_meninggal') }}" class="w-full p-2 border rounded" placeholder="Desa Binangun/ Kab. Blitar">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Tempat Pemakaman *</label>
            <input type="text" name="tempat_pemakaman" value="{{ old('tempat_pemakaman') }}" class="w-full p-2 border rounded" placeholder="TPU Binangun">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Sebab Meninggal *</label>
            <select name="sebab_meninggal" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Sakit Biasa" {{ old('sebab_meninggal') == 'Sakit Biasa' ? 'selected' : '' }}>Sakit Biasa</option>
                <option value="Sakit Berat" {{ old('sebab_meninggal') == 'Sakit Berat' ? 'selected' : '' }}>Sakit Berat</option>
                <option value="Kecelakaan" {{ old('sebab_meninggal') == 'Kecelakaan' ? 'selected' : '' }}>Kecelakaan</option>
                <option value="Bencana Alam" {{ old('sebab_meninggal') == 'Bencana Alam' ? 'selected' : '' }}>Bencana Alam</option>
                <option value="Lainnya" {{ old('sebab_meninggal') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Nama Pelapor *</label>
            <input type="text" name="pelapor" value="{{ old('pelapor', $user->name ?? '') }}" class="w-full p-2 border rounded" placeholder="Nama orang yang melaporkan">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Hubungan Pelapor dengan Almarhum *</label>
            <select name="hubungan_pelapor" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Anak" {{ old('hubungan_pelapor') == 'Anak' ? 'selected' : '' }}>Anak</option>
                <option value="Cucu" {{ old('hubungan_pelapor') == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                <option value="Istri/Suami" {{ old('hubungan_pelapor') == 'Istri/Suami' ? 'selected' : '' }}>Istri/Suami</option>
                <option value="Keluarga" {{ old('hubungan_pelapor') == 'Keluarga' ? 'selected' : '' }}>Keluarga</option>
                <option value="Tetangga" {{ old('hubungan_pelapor') == 'Tetangga' ? 'selected' : '' }}>Tetangga</option>
                <option value="Lainnya" {{ old('hubungan_pelapor') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block font-bold text-gray-700 text-sm mb-1">Keperluan / Tujuan *</label>
            <input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full p-2 border rounded" placeholder="Contoh: Persyaratan Waqaf / Administrasi Kependudukan">
        </div>
    </div>
</div>


<!-- SURAT SKCK FORM -->
<div id="form-skck" class="surat-form" style="display: none;">
    <h3 class="font-bold text-[#0B2E4F] mb-4">Form Surat Pengantar SKCK</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Nama Lengkap *</label>
            <input type="text" name="nama" value="{{ old('nama', $user->name ?? '') }}" class="w-full p-2 border rounded" placeholder="Masukkan nama lengkap">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">NIK *</label>
            <input type="text" name="nik" value="{{ old('nik', $user->nik ?? '') }}" class="w-full p-2 border rounded" placeholder="Masukkan NIK 16 digit">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Tempat & Tanggal Lahir *</label>
            <input type="text" name="ttl" value="{{ old('ttl', ($user->tempat_lahir ?? '') . ', ' . (isset($user->tanggal_lahir) ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d-m-Y') : '')) }}" class="w-full p-2 border rounded" placeholder="Blitar, 21-08-1988">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Jenis Kelamin *</label>
            <select name="jenis_kelamin" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Warga Negara *</label>
            <input type="text" name="warga_negara" value="{{ old('warga_negara', 'Indonesia') }}" class="w-full p-2 border rounded" placeholder="Indonesia">
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Agama *</label>
            <select name="agama" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Islam" {{ old('agama', $user->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama', $user->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama', $user->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('agama', $user->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('agama', $user->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('agama', $user->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Status Perkawinan *</label>
            <select name="status_perkawinan" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="Kawin" {{ old('status_perkawinan', $user->status_perkawinan ?? '') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                <option value="Belum Kawin" {{ old('status_perkawinan', $user->status_perkawinan ?? '') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                <option value="Cerai" {{ old('status_perkawinan', $user->status_perkawinan ?? '') == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                <option value="Cerai Tercatat" {{ old('status_perkawinan') == 'Cerai Tercatat' ? 'selected' : '' }}>Cerai Tercatat</option>
            </select>
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Pendidikan Terakhir *</label>
            <select name="pendidikan" class="w-full p-2 border rounded">
                <option value="">Pilih</option>
                <option value="SD" {{ old('pendidikan', $user->pendidikan ?? '') == 'SD' ? 'selected' : '' }}>SD</option>
                <option value="SMP" {{ old('pendidikan', $user->pendidikan ?? '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                <option value="SMA" {{ old('pendidikan', $user->pendidikan ?? '') == 'SMA' ? 'selected' : '' }}>SMA</option>
                <option value="D3" {{ old('pendidikan', $user->pendidikan ?? '') == 'D3' ? 'selected' : '' }}>D3</option>
                <option value="S1" {{ old('pendidikan', $user->pendidikan ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
                <option value="S2" {{ old('pendidikan', $user->pendidikan ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
            </select>
        </div>
        <div>
            <label class="block font-bold text-gray-700 text-sm mb-1">Pekerjaan *</label>
            <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan ?? '') }}" class="w-full p-2 border rounded" placeholder="Karyawan Swasta">
        </div>
        <div class="md:col-span-2">
            <label class="block font-bold text-gray-700 text-sm mb-1">Alamat Lengkap (Tempat Tinggal) *</label>
            <textarea name="alamat" rows="2" class="w-full p-2 border rounded" placeholder="Dusun Binangun RT. 001 RW. 003 Desa Binangun Kecamatan Binangun Kab. Blitar">{{ old('alamat', $user->alamat ?? '') }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="block font-bold text-gray-700 text-sm mb-1">Keperluan *</label>
            <input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full p-2 border rounded" placeholder="Contoh: Persyaratan Melamar Pekerjaan di SPPG Kec. Binangun">
        </div>
    </div>
</div>

            <!-- SUBMIT BUTTONS -->
            <div class="mt-6 flex flex-wrap gap-4">
                <button type="submit" name="action" value="preview" class="px-6 py-2 bg-[#E8A317] text-[#061E33] rounded hover:bg-[#F4C542] font-bold">
                    <i class="fas fa-eye"></i> Lihat Pratinjau
                </button>
                
                <button type="submit" name="action" value="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 font-bold">
                    <i class="fas fa-paper-plane"></i> Kirim Langsung
                </button>
                
                <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
function toggleForm() {
    var jenis = document.getElementById('jenis_surat').value;
    var forms = document.getElementsByClassName('surat-form');
    
    // Hide all forms and disable their fields
    for (var i = 0; i < forms.length; i++) {
        forms[i].style.display = 'none';
        // Disable all inputs in hidden forms
        var inputs = forms[i].getElementsByTagName('input');
        for (var j = 0; j < inputs.length; j++) {
            inputs[j].disabled = true;
        }
        var selects = forms[i].getElementsByTagName('select');
        for (var j = 0; j < selects.length; j++) {
            selects[j].disabled = true;
        }
        var textareas = forms[i].getElementsByTagName('textarea');
        for (var j = 0; j < textareas.length; j++) {
            textareas[j].disabled = true;
        }
    }
    
    // Show selected form and enable its fields
    if (jenis) {
        var selectedForm = document.getElementById('form-' + jenis);
        if (selectedForm) {
            selectedForm.style.display = 'block';
            // Enable all inputs in visible form
            var inputs = selectedForm.getElementsByTagName('input');
            for (var j = 0; j < inputs.length; j++) {
                inputs[j].disabled = false;
            }
            var selects = selectedForm.getElementsByTagName('select');
            for (var j = 0; j < selects.length; j++) {
                selects[j].disabled = false;
            }
            var textareas = selectedForm.getElementsByTagName('textarea');
            for (var j = 0; j < textareas.length; j++) {
                textareas[j].disabled = false;
            }
        }
    }
}

// Run on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleForm();
});

// Also run when dropdown changes
document.getElementById('jenis_surat').addEventListener('change', function() {
    toggleForm();
});
</script>
@endsection

<!-- DEBUG: Check user data -->
<!-- @if(isset($user))
    <div style="background: #e8f5e9; padding: 10px; border: 1px solid green; margin-bottom: 10px;">
        <p><strong>User Data Available:</strong></p>
        <p>Name: {{ $user->name }}</p>
        <p>Birth Date: {{ $user->tanggal_lahir ?? 'NULL' }}</p>
        <p>Age: {{ isset($user->tanggal_lahir) ? \Carbon\Carbon::parse($user->tanggal_lahir)->age . ' Tahun' : 'N/A' }}</p>
        <p>Gender: {{ $user->jenis_kelamin ?? 'NULL' }}</p>
    </div>
@else
    <div style="background: #ffebee; padding: 10px; border: 1px solid red; margin-bottom: 10px;">
        <p><strong>ERROR: NO USER DATA!</strong></p>
    </div>
@endif -->