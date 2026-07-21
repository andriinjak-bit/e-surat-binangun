import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { User, MapPin } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminPendudukAdd() {
    return (
        <div className="min-h-screen font-sans text-gray-800 bg-[#f8f9f2]">
            <Head title="Tambah Data Penduduk" />

            <Navbar />

            <main className="max-w-7xl mx-auto px-4 md:px-8 py-8 md:py-12 mt-8 md:mt-0">
                {/* Page Header */}
                <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
                    <h1 className="text-2xl font-bold text-[#2b3a20]">Kelola Data Penduduk</h1>
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

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                            <div>
                                <label className="block text-xs font-semibold text-gray-600 mb-2">NIK (Nomor Induk Kependudukan)</label>
                                <input
                                    type="text"
                                    placeholder="Contoh: 3201234567890001"
                                    className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                />
                                <p className="text-[10px] text-gray-400 mt-1.5">Harus berisi tepat 16 digit angka.</p>
                            </div>

                            <div>
                                <label className="block text-xs font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                                <input
                                    type="text"
                                    placeholder="Masukkan nama sesuai KTP"
                                    className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                />
                            </div>

                            <div>
                                <label className="block text-xs font-semibold text-gray-600 mb-2">Tempat Lahir</label>
                                <input
                                    type="text"
                                    placeholder="Kota atau Kabupaten"
                                    className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                />
                            </div>

                            <div>
                                <label className="block text-xs font-semibold text-gray-600 mb-2">Tanggal Lahir</label>
                                <input
                                    type="date"
                                    className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]"
                                />
                            </div>

                            <div>
                                <label className="block text-xs font-semibold text-gray-600 mb-2">Jenis Kelamin</label>
                                <select className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]">
                                    <option value="">Pilih</option>
                                    <option value="1">Laki-Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label className="block text-xs font-semibold text-gray-600 mb-2">Golongan Darah</label>
                                <select className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]">
                                    <option value="">Tidak Tahu</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>

                            <div>
                                <label className="block text-xs font-semibold text-gray-600 mb-2">Agama</label>
                                <select className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>

                            <div>
                                <label className="block text-xs font-semibold text-gray-600 mb-2">Status Perkawinan</label>
                                <select className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]">
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>

                            <div className="md:col-span-2">
                                <label className="block text-xs font-semibold text-gray-600 mb-2">Pekerjaan</label>
                                <input
                                    type="text"
                                    placeholder="Contoh: Petani, Guru, Wiraswasta"
                                    className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                />
                            </div>
                        </div>

                        <hr className="border-gray-100 mb-8" />

                        {/* Section 2: Alamat Domisili */}
                        <div className="flex items-center gap-3 mb-6">
                            <MapPin size={20} className="text-gray-500" />
                            <h2 className="text-md font-bold text-[#2b3a20]">Alamat Domisili</h2>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                            <div className="md:col-span-2">
                                <label className="block text-xs font-semibold text-gray-600 mb-2">Dusun</label>
                                <input
                                    type="text"
                                    placeholder="Nama Dusun"
                                    className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                />
                            </div>
                            <div>
                                <label className="block text-xs font-semibold text-gray-600 mb-2">RT</label>
                                <input
                                    type="text"
                                    placeholder="001"
                                    className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                />
                            </div>
                            <div>
                                <label className="block text-xs font-semibold text-gray-600 mb-2">RW</label>
                                <input
                                    type="text"
                                    placeholder="005"
                                    className="w-full bg-[#f6f7f2] border-0 rounded-lg p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                                />
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
                            <button className="px-6 py-2.5 rounded-lg bg-[#2b3a20] text-white text-sm font-medium hover:bg-[#1f2917] transition shadow-sm">
                                Save Data
                            </button>
                        </div>
                    </div>
                </div>
            </main>

            <Footer />
        </div>
    );
}
