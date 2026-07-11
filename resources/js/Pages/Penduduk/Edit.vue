<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    penduduk: Object,
});

const form = useForm({
    no_kk: props.penduduk.no_kk,
    nik: props.penduduk.nik,
    nama: props.penduduk.nama,
    usia: props.penduduk.usia,
    jenis_kelamin: props.penduduk.jenis_kelamin,
    tempat_tanggal_lahir: props.penduduk.tempat_tanggal_lahir,
    pekerjaan: props.penduduk.pekerjaan,
    agama: props.penduduk.agama,
    pendidikan: props.penduduk.pendidikan,
    status: props.penduduk.status,
    shdk: props.penduduk.shdk,
    alamat: props.penduduk.alamat,
    rt: props.penduduk.rt,
    rw: props.penduduk.rw,
});

const submit = () => {
    form.put(route('penduduk.update', props.penduduk.id));
};
</script>

<template>
    <div class="p-6 text-gray-900 bg-white rounded-lg shadow-sm max-w-4xl mx-auto">
        <h2 class="text-2xl font-semibold mb-6">Edit Data Penduduk</h2>

        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">No KK</label>
                <input v-model="form.no_kk" type="text" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">NIK</label>
                <input v-model="form.nik" type="text" class="border rounded px-3 py-2 w-full" required>
                <div v-if="form.errors.nik" class="text-red-500 text-sm mt-1">{{ form.errors.nik }}</div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input v-model="form.nama" type="text" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Usia</label>
                <input v-model="form.usia" type="number" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Jenis Kelamin</label>
                <select v-model="form.jenis_kelamin" class="border rounded px-3 py-2 w-full" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tempat, Tanggal Lahir</label>
                <input v-model="form.tempat_tanggal_lahir" type="text" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Pekerjaan</label>
                <input v-model="form.pekerjaan" type="text" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Agama</label>
                <input v-model="form.agama" type="text" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Pendidikan</label>
                <input v-model="form.pendidikan" type="text" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Status Perkawinan</label>
                <input v-model="form.status" type="text" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">SHDK (Status Hub. Dalam Keluarga)</label>
                <input v-model="form.shdk" type="text" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">RT</label>
                <input v-model="form.rt" type="text" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">RW</label>
                <input v-model="form.rw" type="text" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Alamat</label>
                <textarea v-model="form.alamat" rows="3" class="border rounded px-3 py-2 w-full" required></textarea>
            </div>

            <div class="md:col-span-2 flex gap-4 mt-4">
                <button type="submit" :disabled="form.processing" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 disabled:opacity-50">
                    Simpan Perubahan
                </button>
                <Link :href="route('penduduk.index')" class="px-6 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                    Batal
                </Link>
            </div>
        </form>
    </div>
</template>
