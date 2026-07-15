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
                <!-- Profile Picture -->
                <div class="md:col-span-2">
                    <label class="block font-bold text-gray-700 mb-2">Foto Profil</label>
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/profile/' . $user->profile_picture) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-user text-3xl text-gray-400"></i>
                            @endif
                        </div>
                        <div>
                            <input type="file" name="profile_picture" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#0B2E4F] file:text-white hover:file:bg-[#1B4A7A]">
                            <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (max 2MB)</p>
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 border rounded" required>
                </div>

                <!-- NIK -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">NIK *</label>
                    <input type="text" name="nik" value="{{ old('nik', $user->nik) }}" class="w-full p-2 border rounded" required maxlength="16">
                </div>

                <!-- Email -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-2 border rounded">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">No. HP</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full p-2 border rounded" placeholder="081234567890">
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $user->tempat_lahir) }}" class="w-full p-2 border rounded" placeholder="Blitar">
                </div>

                <!-- Tanggal Lahir - FIXED -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" 
                        value="{{ old('tanggal_lahir', $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : '') }}" 
                        class="w-full p-2 border rounded">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full p-2 border rounded">
                        <option value="">Pilih</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- No KK -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">No. KK</label>
                    <input type="text" name="no_kk" value="{{ old('no_kk', $user->no_kk) }}" class="w-full p-2 border rounded" placeholder="Nomor Kartu Keluarga">
                </div>

                <!-- RT -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">RT</label>
                    <input type="text" name="rt" value="{{ old('rt', $user->rt) }}" class="w-full p-2 border rounded" placeholder="01">
                </div>

                <!-- RW -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">RW</label>
                    <input type="text" name="rw" value="{{ old('rw', $user->rw) }}" class="w-full p-2 border rounded" placeholder="01">
                </div>

                <!-- Dusun -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Dusun</label>
                    <input type="text" name="dusun" value="{{ old('dusun', $user->dusun) }}" class="w-full p-2 border rounded" placeholder="Krajan">
                </div>

                <!-- Pekerjaan -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Pekerjaan</label>
                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan) }}" class="w-full p-2 border rounded" placeholder="Petani, PNS, Wiraswasta">
                </div>

                <!-- Agama -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Agama</label>
                    <select name="agama" class="w-full p-2 border rounded">
                        <option value="">Pilih</option>
                        <option value="Islam" {{ old('agama', $user->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ old('agama', $user->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ old('agama', $user->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('agama', $user->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ old('agama', $user->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ old('agama', $user->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>

                <!-- Pendidikan -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Pendidikan</label>
                    <select name="pendidikan" class="w-full p-2 border rounded">
                        <option value="">Pilih</option>
                        <option value="SD" {{ old('pendidikan', $user->pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ old('pendidikan', $user->pendidikan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ old('pendidikan', $user->pendidikan) == 'SMA' ? 'selected' : '' }}>SMA</option>
                        <option value="D3" {{ old('pendidikan', $user->pendidikan) == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="S1" {{ old('pendidikan', $user->pendidikan) == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ old('pendidikan', $user->pendidikan) == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ old('pendidikan', $user->pendidikan) == 'S3' ? 'selected' : '' }}>S3</option>
                    </select>
                </div>

                <!-- Status Perkawinan -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">Status Perkawinan</label>
                    <select name="status_perkawinan" class="w-full p-2 border rounded">
                        <option value="">Pilih</option>
                        <option value="Belum Kawin" {{ old('status_perkawinan', $user->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Kawin" {{ old('status_perkawinan', $user->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                        <option value="Cerai Hidup" {{ old('status_perkawinan', $user->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="Cerai Mati" {{ old('status_perkawinan', $user->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                    </select>
                </div>

                <!-- SHDK -->
                <div>
                    <label class="block font-bold text-gray-700 text-sm mb-1">SHDK</label>
                    <select name="shdk" class="w-full p-2 border rounded">
                        <option value="">Pilih</option>
                        <option value="Kepala Keluarga" {{ old('shdk', $user->shdk) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                        <option value="Istri" {{ old('shdk', $user->shdk) == 'Istri' ? 'selected' : '' }}>Istri</option>
                        <option value="Anak" {{ old('shdk', $user->shdk) == 'Anak' ? 'selected' : '' }}>Anak</option>
                        <option value="Cucu" {{ old('shdk', $user->shdk) == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                        <option value="Lainnya" {{ old('shdk', $user->shdk) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label class="block font-bold text-gray-700 text-sm mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full p-2 border rounded" placeholder="Alamat lengkap">{{ old('alamat', $user->alamat) }}</textarea>
                </div>
            </div>

                        <!-- Signature -->
            <div class="md:col-span-2 border-t pt-4 mt-4">
                <label class="block font-bold text-gray-700 mb-2">Tanda Tangan Digital</label>
                <div class="flex items-center gap-6">
                    <div class="w-32 h-16 bg-gray-200 flex items-center justify-center overflow-hidden border">
                        @if($user->signature_path)
                            <img src="{{ asset('storage/signatures/' . $user->signature_path) }}" class="w-full h-full object-contain">
                        @else
                            <span class="text-xs text-gray-400">Belum ada tanda tangan</span>
                        @endif
                    </div>
                    <div>
                        <input type="file" name="signature" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#0B2E4F] file:text-white hover:file:bg-[#1B4A7A]">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (max 2MB)</p>
                    </div>
                </div>
            </div>

            <!-- KTP Upload -->
            <div class="md:col-span-2">
                <label class="block font-bold text-gray-700 mb-2">Upload Scan KTP</label>
                <div class="flex items-center gap-6">
                    <div class="w-32 h-20 bg-gray-200 flex items-center justify-center overflow-hidden border">
                        @if($user->ktp_path)
                            <img src="{{ asset('storage/ktp/' . $user->ktp_path) }}" class="w-full h-full object-cover">
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
            <div class="md:col-span-2">
                <label class="block font-bold text-gray-700 mb-2">Upload Scan Kartu Keluarga (KK)</label>
                <div class="flex items-center gap-6">
                    <div class="w-32 h-20 bg-gray-200 flex items-center justify-center overflow-hidden border">
                        @if($user->kk_path)
                            <img src="{{ asset('storage/kk/' . $user->kk_path) }}" class="w-full h-full object-cover">
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