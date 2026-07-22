import React from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import { User, MapPin } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminPendudukAdd({ penduduk }) {
    const isEdit = !!penduduk;

    const { data, setData, post, put, processing, errors } = useForm({
        no_kk: penduduk?.no_kk || '',
        nik: penduduk?.nik || '',
        nama: penduduk?.nama || '',
        jenis_kelamin: penduduk?.jenis_kelamin || '',
        tempat_lahir: penduduk?.tempat_lahir || '',
        tanggal_lahir: penduduk?.tanggal_lahir || '',
        pekerjaan: penduduk?.pekerjaan || '',
        agama: penduduk?.agama || '',
        pendidikan: penduduk?.pendidikan || '',
        status_pernikahan: penduduk?.status_pernikahan || '',
        shdk: penduduk?.shdk || '',
        alamat: penduduk?.alamat || '',
        rt: penduduk?.rt || '',
        rw: penduduk?.rw || '',
        dusun: penduduk?.dusun || '',
    });

    const submit = (e) => {
        e.preventDefault();
        if (isEdit) {
            put(`/admin/penduduk/${penduduk.id}`);
        } else {
            post('/admin/penduduk');
        }
    };
    return (
        <div className="min-h-screen font-sans text-gray-800 bg-[#f8f9f2]">
            <Head title={isEdit ? "Edit Data Penduduk" : "Tambah Data Penduduk"} />

            <Navbar variant='admin' />

            <main className="max-w-7xl mx-auto px-4 md:px-8 py-8 md:py-12 mt-8 md:mt-0">
                {/* Page Header */}
                <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
                    <h1 className="text-2xl font-bold text-[#2b3a20]">{isEdit ? "Edit Data Penduduk" : "Tambah Data Penduduk"}</h1>
                </div>

                <div className="flex flex-col lg:flex-row gap-8">
                    {/* Main Form Area */}
                    <div className="flex-1 bg-white rounded-2xl p-6 md:p-10 shadow-sm border border-gray-100">

                        {/* Section 1: Informasi Identitas */}
                        <div className="flex items-start gap-4 mb-8">
                            <div className="bg-gray-100 p-3 rounded-xl text-gray-600">
                                <User size={24} />
                            </div>
                            <div>
                                <h2 className="text-lg font-bold text-[#2b3a20]">Informasi Identitas</h2>
                                <p className="text-sm text-gray-500">Pastikan data sesuai dengan KTP/KK asli.</p>
                            </div>
                        </div>

                        <form onSubmit={submit}>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">No. KK</label>
                                    <input
                                        type="text"
                                        value={data.no_kk}
                                        onChange={e => setData('no_kk', e.target.value)}
                                        placeholder="Nomor Kartu Keluarga"
                                        className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                    />
                                    {errors.no_kk && <div className="text-red-500 text-xs mt-1">{errors.no_kk}</div>}
                                </div>

                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">NIK (Nomor Induk Kependudukan)</label>
                                    <input
                                        type="text"
                                        value={data.nik}
                                        onChange={e => setData('nik', e.target.value)}
                                        placeholder="Contoh: 3201234567890001"
                                        className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                    />
                                    <p className="text-[10px] text-gray-400 mt-1.5">Harus berisi tepat 16 digit angka.</p>
                                    {errors.nik && <div className="text-red-500 text-xs mt-1">{errors.nik}</div>}
                                </div>

                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                                    <input
                                        type="text"
                                        value={data.nama}
                                        onChange={e => setData('nama', e.target.value)}
                                        placeholder="Masukkan nama sesuai KTP"
                                        className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                    />
                                    {errors.nama && <div className="text-red-500 text-xs mt-1">{errors.nama}</div>}
                                </div>

                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">Tempat Lahir</label>
                                    <input
                                        type="text"
                                        value={data.tempat_lahir}
                                        onChange={e => setData('tempat_lahir', e.target.value)}
                                        placeholder="Kota atau Kabupaten"
                                        className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                    />
                                    {errors.tempat_lahir && <div className="text-red-500 text-xs mt-1">{errors.tempat_lahir}</div>}
                                </div>

                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">Tanggal Lahir</label>
                                    <input
                                        type="date"
                                        value={data.tanggal_lahir}
                                        onChange={e => setData('tanggal_lahir', e.target.value)}
                                        className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]"
                                    />
                                    {errors.tanggal_lahir && <div className="text-red-500 text-xs mt-1">{errors.tanggal_lahir}</div>}
                                </div>

                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">Jenis Kelamin</label>
                                    <select value={data.jenis_kelamin} onChange={e => setData('jenis_kelamin', e.target.value)} className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]">
                                        <option value="">Pilih</option>
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                    {errors.jenis_kelamin && <div className="text-red-500 text-xs mt-1">{errors.jenis_kelamin}</div>}
                                </div>

                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">Pendidikan</label>
                                    <input
                                        type="text"
                                        value={data.pendidikan}
                                        onChange={e => setData('pendidikan', e.target.value)}
                                        placeholder="Contoh: SMA, S1"
                                        className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                    />
                                    {errors.pendidikan && <div className="text-red-500 text-xs mt-1">{errors.pendidikan}</div>}
                                </div>

                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">Agama</label>
                                    <select value={data.agama} onChange={e => setData('agama', e.target.value)} className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]">
                                        <option value="">Pilih</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                    {errors.agama && <div className="text-red-500 text-xs mt-1">{errors.agama}</div>}
                                </div>

                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">Status Perkawinan</label>
                                    <select value={data.status_pernikahan} onChange={e => setData('status_pernikahan', e.target.value)} className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]">
                                        <option value="">Pilih</option>
                                        <option value="Belum Kawin">Belum Kawin</option>
                                        <option value="Kawin">Kawin</option>
                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                        <option value="Cerai Mati">Cerai Mati</option>
                                    </select>
                                    {errors.status_pernikahan && <div className="text-red-500 text-xs mt-1">{errors.status_pernikahan}</div>}
                                </div>

                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">SHDK</label>
                                    <input
                                        type="text"
                                        value={data.shdk}
                                        onChange={e => setData('shdk', e.target.value)}
                                        placeholder="Contoh: Kepala Keluarga, Istri, Anak"
                                        className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                    />
                                    {errors.shdk && <div className="text-red-500 text-xs mt-1">{errors.shdk}</div>}
                                </div>

                                <div className="md:col-span-2">
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">Pekerjaan</label>
                                    <input
                                        type="text"
                                        value={data.pekerjaan}
                                        onChange={e => setData('pekerjaan', e.target.value)}
                                        placeholder="Contoh: Petani, Guru, Wiraswasta"
                                        className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                    />
                                    {errors.pekerjaan && <div className="text-red-500 text-xs mt-1">{errors.pekerjaan}</div>}
                                </div>
                            </div>

                            <hr className="border-gray-100 mb-8" />

                            {/* Section 2: Alamat Domisili */}
                            <div className="flex items-center gap-3 mb-6">
                                <MapPin size={20} className="text-gray-500" />
                                <h2 className="text-md font-bold text-[#2b3a20]">Alamat Domisili</h2>
                            </div>

                            <div className="mb-6">
                                <label className="block text-xs font-semibold text-gray-600 mb-2">Alamat Lengkap</label>
                                <input
                                    type="text"
                                    value={data.alamat}
                                    onChange={e => setData('alamat', e.target.value)}
                                    placeholder="Jalan, RT/RW, dsb"
                                    className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                />
                                {errors.alamat && <div className="text-red-500 text-xs mt-1">{errors.alamat}</div>}
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                                <div className="md:col-span-2">
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">Dusun</label>
                                    <input
                                        type="text"
                                        value={data.dusun}
                                        onChange={e => setData('dusun', e.target.value)}
                                        placeholder="Nama Dusun"
                                        className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                    />
                                    {errors.dusun && <div className="text-red-500 text-xs mt-1">{errors.dusun}</div>}
                                </div>
                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">RT</label>
                                    <input
                                        type="text"
                                        value={data.rt}
                                        onChange={e => setData('rt', e.target.value)}
                                        placeholder="001"
                                        className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                    />
                                    {errors.rt && <div className="text-red-500 text-xs mt-1">{errors.rt}</div>}
                                </div>
                                <div>
                                    <label className="block text-xs font-semibold text-gray-600 mb-2">RW</label>
                                    <input
                                        type="text"
                                        value={data.rw}
                                        onChange={e => setData('rw', e.target.value)}
                                        placeholder="005"
                                        className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                    />
                                    {errors.rw && <div className="text-red-500 text-xs mt-1">{errors.rw}</div>}
                                </div>
                            </div>

                            {/* Actions */}
                            <div className="flex justify-end items-center gap-4 pt-4 border-t border-gray-100">
                                <Link
                                    href="/admin/penduduk"
                                    className="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-600 text-sm font-medium hover:bg-gray-50 transition"
                                >
                                    Cancel
                                </Link>
                                <button type="submit" disabled={processing} className="px-6 py-2.5 rounded-lg bg-[#2b3a20] text-white text-sm font-medium hover:bg-[#1f2917] transition shadow-sm disabled:opacity-50">
                                    {isEdit ? "Simpan Perubahan" : "Simpan Data"}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>

            <Footer />
        </div>
    );
}
