<script setup>
import { ref, watch } from 'vue';
import { router, Link, useForm } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';

const props = defineProps({
    penduduks: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const filterRt = ref(props.filters?.rt || '');
const filterRw = ref(props.filters?.rw || '');
const filterUsia = ref(props.filters?.usia || '');

const performSearch = debounce(() => {
    router.get(
        route('penduduk.index'),
        {
            search: search.value,
            rt: filterRt.value,
            rw: filterRw.value,
            usia: filterUsia.value,
        },
        { preserveState: true, replace: true }
    );
}, 300);

watch([search, filterRt, filterRw, filterUsia], performSearch);

const form = useForm({
    file: null,
});

const submitImport = () => {
    form.post(route('penduduk.import'), {
        preserveScroll: true,
        onSuccess: () => {
            alert('Proses import sedang berjalan di background.');
            form.reset('file');
        },
    });
};
</script>

<template>
    <div class="p-6 text-gray-900 bg-white rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Data Sipil (Penduduk)</h2>
            <div class="flex gap-2">
                <Link :href="route('penduduk.create')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Tambah Data
                </Link>
            </div>
        </div>

        <div class="mb-6 p-4 border rounded bg-gray-50 flex gap-4 items-end flex-wrap">
            <div>
                <label class="block text-sm font-medium mb-1">Cari (Nama/NIK)</label>
                <input v-model="search" type="text" class="border rounded px-3 py-2 w-full" placeholder="Ketik kata kunci...">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Filter RT</label>
                <input v-model="filterRt" type="text" class="border rounded px-3 py-2 w-full" placeholder="Misal: 01">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Filter RW</label>
                <input v-model="filterRw" type="text" class="border rounded px-3 py-2 w-full" placeholder="Misal: 02">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Filter Usia</label>
                <input v-model="filterUsia" type="number" class="border rounded px-3 py-2 w-full" placeholder="Misal: 30">
            </div>
            
            <div class="ml-auto flex items-center gap-2 border-l pl-4">
                <form @submit.prevent="submitImport" class="flex gap-2 items-center">
                    <input type="file" @change="e => form.file = e.target.files[0]" class="text-sm">
                    <button type="submit" :disabled="form.processing" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 disabled:opacity-50">
                        Import CSV
                    </button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-2 px-4">No KK</th>
                        <th class="py-2 px-4">NIK</th>
                        <th class="py-2 px-4">Nama</th>
                        <th class="py-2 px-4">Usia</th>
                        <th class="py-2 px-4">JK</th>
                        <th class="py-2 px-4">RT/RW</th>
                        <th class="py-2 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in penduduks.data" :key="item.id" class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ item.no_kk }}</td>
                        <td class="py-2 px-4">{{ item.nik }}</td>
                        <td class="py-2 px-4">{{ item.nama }}</td>
                        <td class="py-2 px-4">{{ item.usia }}</td>
                        <td class="py-2 px-4">{{ item.jenis_kelamin }}</td>
                        <td class="py-2 px-4">{{ item.rt }} / {{ item.rw }}</td>
                        <td class="py-2 px-4 text-center">
                            <Link :href="route('penduduk.edit', item.id)" class="text-blue-600 hover:underline mr-2">Edit</Link>
                            <Link :href="route('penduduk.destroy', item.id)" method="delete" as="button" class="text-red-600 hover:underline">Hapus</Link>
                        </td>
                    </tr>
                    <tr v-if="penduduks.data.length === 0">
                        <td colspan="7" class="py-4 text-center text-gray-500">Data tidak ditemukan.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex justify-between items-center" v-if="penduduks.links">
            <div class="text-sm text-gray-500">
                Menampilkan {{ penduduks.from }} - {{ penduduks.to }} dari {{ penduduks.total }} data
            </div>
            <div class="flex gap-1">
                <template v-for="(link, k) in penduduks.links" :key="k">
                    <Link 
                        v-if="link.url"
                        :href="link.url" 
                        v-html="link.label"
                        class="px-3 py-1 border rounded hover:bg-gray-100"
                        :class="{'bg-blue-600 text-white hover:bg-blue-700': link.active}"
                    />
                    <span v-else v-html="link.label" class="px-3 py-1 border rounded text-gray-400"></span>
                </template>
            </div>
        </div>
    </div>
</template>
