@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-[#0B2E4F] mb-6">Edit Profil</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- NIK (Read Only for profile editing usually) -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">NIK</label>
                    <input type="text" value="{{ $user->nik }}" class="w-full p-2 border rounded bg-gray-100" readonly disabled>
                </div>

                <!-- Name -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Nama Lengkap *</label>
                    <input type="text" name="nama" value="{{ old('nama', $penduduk->nama) }}" class="w-full p-2 border rounded" required>
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" class="w-full p-2 border rounded" placeholder="Blitar">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" 
                        value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir ? \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('Y-m-d') : '') }}" 
                        class="w-full p-2 border rounded">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full p-2 border rounded">
                        <option value="">Pilih</option>
                        <option value="1" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == '1' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="2" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == '2' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- No KK -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">No. KK</label>
                    <input type="text" name="no_kk" value="{{ old('no_kk', $penduduk->no_kk) }}" class="w-full p-2 border rounded" placeholder="Nomor Kartu Keluarga">
                </div>

                <!-- RT -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">RT</label>
                    <input type="text" name="rt" value="{{ old('rt', $penduduk->rt) }}" class="w-full p-2 border rounded" placeholder="01">
                </div>

                <!-- RW -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">RW</label>
                    <input type="text" name="rw" value="{{ old('rw', $penduduk->rw) }}" class="w-full p-2 border rounded" placeholder="01">
                </div>

                <!-- Dusun -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Dusun</label>
                    <input type="text" name="dusun" value="{{ old('dusun', $penduduk->dusun) }}" class="w-full p-2 border rounded" placeholder="Krajan">
                </div>

                <!-- Pekerjaan -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Pekerjaan</label>
                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}" class="w-full p-2 border rounded" placeholder="Petani, PNS, Wiraswasta">
                </div>

                <!-- Agama -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Agama</label>
                    <select name="agama" class="w-full p-2 border rounded">
                        <option value="">Pilih</option>
                        <option value="Islam" {{ old('agama', $penduduk->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ old('agama', $penduduk->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ old('agama', $penduduk->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('agama', $penduduk->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ old('agama', $penduduk->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ old('agama', $penduduk->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>

                <!-- Pendidikan -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Pendidikan</label>
                    <select name="pendidikan" class="w-full p-2 border rounded">
                        <option value="">Pilih</option>
                        <option value="SD" {{ old('pendidikan', $penduduk->pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ old('pendidikan', $penduduk->pendidikan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ old('pendidikan', $penduduk->pendidikan) == 'SMA' ? 'selected' : '' }}>SMA</option>
                        <option value="D3" {{ old('pendidikan', $penduduk->pendidikan) == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="S1" {{ old('pendidikan', $penduduk->pendidikan) == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ old('pendidikan', $penduduk->pendidikan) == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ old('pendidikan', $penduduk->pendidikan) == 'S3' ? 'selected' : '' }}>S3</option>
                    </select>
                </div>

                <!-- Status Perkawinan -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Status Perkawinan</label>
                    <select name="status_pernikahan" class="w-full p-2 border rounded">
                        <option value="">Pilih</option>
                        <option value="Belum Kawin" {{ old('status_pernikahan', $penduduk->status_pernikahan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Kawin" {{ old('status_pernikahan', $penduduk->status_pernikahan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                        <option value="Cerai Hidup" {{ old('status_pernikahan', $penduduk->status_pernikahan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="Cerai Mati" {{ old('status_pernikahan', $penduduk->status_pernikahan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                    </select>
                </div>

                <!-- SHDK -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">SHDK</label>
                    <select name="shdk" class="w-full p-2 border rounded">
                        <option value="">Pilih</option>
                        <option value="Kepala Keluarga" {{ old('shdk', $penduduk->shdk) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                        <option value="Istri" {{ old('shdk', $penduduk->shdk) == 'Istri' ? 'selected' : '' }}>Istri</option>
                        <option value="Anak" {{ old('shdk', $penduduk->shdk) == 'Anak' ? 'selected' : '' }}>Anak</option>
                        <option value="Cucu" {{ old('shdk', $penduduk->shdk) == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                        <option value="Lainnya" {{ old('shdk', $penduduk->shdk) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label class="block font-bold text-gray-700 text-sm mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full p-2 border rounded" placeholder="Alamat lengkap">{{ old('alamat', $penduduk->alamat) }}</textarea>
                </div>
            </div>

            <!-- KTP Upload -->
            <div class="md:col-span-2 mt-6">
                <label class="block font-bold text-gray-700 mb-2">Upload Scan KTP</label>
                <div class="flex items-center gap-6">
                    <div class="w-32 h-20 bg-gray-200 flex items-center justify-center overflow-hidden border">
                        @if($penduduk->ktp_path)
                            <img src="{{ asset('storage/ktp/' . $penduduk->ktp_path) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-xs text-gray-400">Belum upload KTP</span>
                        @endif
                    </div>
                    <div>
                        <input type="file" name="ktp" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#0B2E4F] file:text-white hover:file:bg-[#1B4A7A]">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (max 2MB)</p>
                    </div>
                </div>
            </div>

            <!-- KK Upload -->
            <div class="md:col-span-2 mt-4">
                <label class="block font-bold text-gray-700 mb-2">Upload Scan Kartu Keluarga (KK)</label>
                <div class="flex items-center gap-6">
                    <div class="w-32 h-20 bg-gray-200 flex items-center justify-center overflow-hidden border">
                        @if($penduduk->kk_path)
                            <img src="{{ asset('storage/kk/' . $penduduk->kk_path) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-xs text-gray-400">Belum upload KK</span>
                        @endif
                    </div>
                    <div>
                        <input type="file" name="kk" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#0B2E4F] file:text-white hover:file:bg-[#1B4A7A]">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (max 2MB)</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex gap-4">
                <button type="submit" class="px-6 py-2 bg-[#E8A317] text-[#061E33] rounded hover:bg-[#F4C542] font-bold">Simpan Perubahan</button>
                <a href="{{ route('profile.index') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection