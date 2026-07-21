import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Users, Download, UserPlus, Home, Filter, Edit2, Trash2, ChevronLeft, ChevronRight } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminPenduduk() {
    return (
        <div className="min-h-screen font-sans text-gray-800">
            <Head title="Data Penduduk" />

            {/* Navbar */}
            <Navbar />

            {/* Main Content */}
            <main className="max-w-7xl mx-auto px-4 md:px-8 py-10 mt-8 md:mt-0 flex-grow w-full">
                <div className="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                    <div>
                        <h1 className="text-3xl md:text-4xl font-bold text-[#2b3a20] mb-2">Data Penduduk</h1>
                        <p className="text-gray-600">Kelola informasi sipil warga Desa Binangun</p>
                    </div>
                    <div className="flex items-center gap-3">
                        <button className="flex items-center gap-2 bg-[#2b3a20] hover:bg-[#000] text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                            <Download size={18} />
                            Import Data
                        </button>
                        <button onClick={() => window.location.href = '/admin/penduduk/add'} className="flex items-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                            <UserPlus size={18} />
                            Tambah Data
                        </button>
                    </div>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                    {/* Card 1 */}
                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 relative">
                        <div className="flex justify-between items-start mb-4">
                            <div className="bg-gray-100 p-2 rounded-full text-gray-600">
                                <Users size={20} />
                            </div>
                            <span className="text-xs font-semibold text-gray-400">Total</span>
                        </div>
                        <div className="text-4xl font-bold text-[#2b3a20] mb-1">4.281</div>
                        <div className="text-xs text-gray-500">Total Penduduk</div>
                    </div>

                    {/* Card 2 */}
                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div className="flex justify-between items-start mb-4">
                            <div className="bg-green-100 p-2 rounded-full text-green-700">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><circle cx="10" cy="14" r="6" /><path d="M14.243 9.757L20 4" /><path d="M15 4h5v5" /></svg>
                            </div>
                            <span className="text-xs font-semibold text-gray-400">Pria</span>
                        </div>
                        <div className="text-4xl font-bold text-[#2b3a20] mb-1">2.140</div>
                        <div className="text-xs text-gray-500">Laki-Laki</div>
                    </div>

                    {/* Card 3 */}
                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div className="flex justify-between items-start mb-4">
                            <div className="bg-orange-100 p-2 rounded-full text-orange-600">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><circle cx="12" cy="10" r="6" /><path d="M12 16v6" /><path d="M9 19h6" /></svg>
                            </div>
                            <span className="text-xs font-semibold text-gray-400">Wanita</span>
                        </div>
                        <div className="text-4xl font-bold text-[#2b3a20] mb-1">2.141</div>
                        <div className="text-xs text-gray-500">Perempuan</div>
                    </div>

                    {/* Card 4 */}
                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div className="flex justify-between items-start mb-4">
                            <div className="bg-gray-100 p-2 rounded-full text-gray-600">
                                <Home size={20} />
                            </div>
                            <span className="text-xs font-semibold text-gray-400">Keluarga</span>
                        </div>
                        <div className="text-4xl font-bold text-[#2b3a20] mb-1">1.104</div>
                        <div className="text-xs text-gray-500">Total KK</div>
                    </div>
                </div>

                {/* Table Section */}
                <div className="bg-[#f8f9f2] rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                    <div className="px-6 py-5 flex items-center justify-between flex-wrap gap-4 border-b border-gray-200">
                        <h2 className="text-xl font-bold text-[#2b3a20]">Daftar Warga</h2>
                        <div className="flex items-center gap-3">
                            <button className="flex items-center gap-2 px-3 py-1.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition bg-white shadow-sm">
                                <Filter size={16} />
                                Filter
                            </button>
                            <button className="flex items-center gap-2 px-3 py-1.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition bg-white shadow-sm">
                                <Download size={16} />
                                Ekspor
                            </button>
                        </div>
                    </div>
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm whitespace-nowrap">
                            <thead className="text-gray-400 text-xs font-bold tracking-wider border-b border-gray-200">
                                <tr>
                                    <th className="px-6 py-4 font-semibold uppercase">No. KK</th>
                                    <th className="px-6 py-4 font-semibold uppercase">NIK</th>
                                    <th className="px-6 py-4 font-semibold uppercase">Nama Lengkap</th>
                                    <th className="px-6 py-4 font-semibold uppercase">Jenis Kelamin</th>
                                    <th className="px-6 py-4 font-semibold uppercase">Tempat Lahir</th>
                                    <th className="px-6 py-4 font-semibold uppercase">Tanggal Lahir</th>
                                    <th className="px-6 py-4 font-semibold uppercase">Pekerjaan</th>
                                    <th className="px-6 py-4 font-semibold uppercase">Agama</th>
                                    <th className="px-6 py-4 font-semibold uppercase">Pendidikan</th>
                                    <th className="px-6 py-4 font-semibold uppercase">Status Pernikahan</th>
                                    <th className="px-6 py-4 font-semibold uppercase">SHDK</th>
                                    <th className="px-6 py-4 font-semibold uppercase">Alamat</th>
                                    <th className="px-6 py-4 font-semibold uppercase">RT</th>
                                    <th className="px-6 py-4 font-semibold uppercase">RW</th>
                                    <th className="px-6 py-4 font-semibold uppercase">Dusun</th>
                                    <th className="px-6 py-4 font-semibold uppercase sticky right-0 bg-[#f8f9f2] z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.05)]">Aksi</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200">
                                {[
                                    { no_kk: '3301021101900001', nik: '3301021405920001', name: 'Ahmad Bakri', jenis_kelamin: 'Laki-laki', tempat_lahir: 'Blitar', tanggal_lahir: '14-05-1992', pekerjaan: 'Petani', agama: 'Islam', pendidikan: 'SMA', status_pernikahan: 'Kawin', shdk: 'Kepala Keluarga', alamat: 'Jl. Merdeka No. 1', rt: '01', rw: '01', dusun: 'Dusun Krajan' },
                                    { no_kk: '3301021101900002', nik: '3301024810880004', name: 'Siti Rahayu', jenis_kelamin: 'Perempuan', tempat_lahir: 'Blitar', tanggal_lahir: '08-10-1988', pekerjaan: 'Wiraswasta', agama: 'Islam', pendidikan: 'D3', status_pernikahan: 'Kawin', shdk: 'Istri', alamat: 'Jl. Merdeka No. 2', rt: '02', rw: '01', dusun: 'Dusun Wetan' },
                                    { no_kk: '3301021101900003', nik: '3301020202950009', name: 'Bambang Pamungkas', jenis_kelamin: 'Laki-laki', tempat_lahir: 'Surabaya', tanggal_lahir: '02-02-1995', pekerjaan: 'Karyawan Swasta', agama: 'Islam', pendidikan: 'S1', status_pernikahan: 'Belum Kawin', shdk: 'Anak', alamat: 'Jl. Sudirman No. 5', rt: '01', rw: '02', dusun: 'Dusun Krajan' },
                                    { no_kk: '3301021101900004', nik: '3301025506990002', name: 'Dewi Lestari', jenis_kelamin: 'Perempuan', tempat_lahir: 'Malang', tanggal_lahir: '15-06-1999', pekerjaan: 'Mahasiswa', agama: 'Islam', pendidikan: 'SMA', status_pernikahan: 'Belum Kawin', shdk: 'Anak', alamat: 'Jl. Diponegoro No. 8', rt: '03', rw: '02', dusun: 'Dusun Kidul' },
                                    { no_kk: '3301021101900005', nik: '3301021212720011', name: 'Eko Kusuma', jenis_kelamin: 'Laki-laki', tempat_lahir: 'Blitar', tanggal_lahir: '12-12-1972', pekerjaan: 'PNS', agama: 'Islam', pendidikan: 'S1', status_pernikahan: 'Kawin', shdk: 'Kepala Keluarga', alamat: 'Jl. Kartini No. 10', rt: '04', rw: '03', dusun: 'Dusun Wetan' },
                                ].map((row, idx) => (
                                    <tr key={idx} className="hover:bg-gray-50 transition group">
                                        <td className="px-6 py-4 text-gray-600">{row.no_kk}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.nik}</td>
                                        <td className="px-6 py-4">
                                            <span className="font-medium text-gray-800">{row.name}</span>
                                        </td>
                                        <td className="px-6 py-4 text-gray-600">{row.jenis_kelamin}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.tempat_lahir}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.tanggal_lahir}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.pekerjaan}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.agama}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.pendidikan}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.status_pernikahan}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.shdk}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.alamat}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.rt}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.rw}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.dusun}</td>

                                        <td className="px-6 py-4 sticky right-0 bg-[#f8f9f2] group-hover:bg-gray-50 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.05)]">
                                            <div className="flex items-center gap-3 text-gray-400">
                                                <button className="hover:text-gray-700 transition"><Edit2 size={16} /></button>
                                                <button className="hover:text-gray-700 transition"><Trash2 size={16} /></button>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    <div className="px-6 py-4 border-t border-gray-200 flex flex-wrap items-center justify-between gap-4">
                        <span className="text-xs text-gray-500 font-medium">Menampilkan 1-5 dari 4.281 warga</span>
                        <div className="flex items-center gap-1">
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-300 text-gray-500 hover:bg-gray-50 bg-white shadow-sm">
                                <ChevronLeft size={16} />
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded bg-[#2b3a20] text-white font-medium text-sm shadow-sm">
                                1
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-300 text-gray-600 hover:bg-gray-50 bg-white text-sm shadow-sm">
                                2
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-300 text-gray-600 hover:bg-gray-50 bg-white text-sm shadow-sm">
                                3
                            </button>
                            <span className="w-8 h-8 flex items-center justify-center text-gray-500 text-sm">...</span>
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-300 text-gray-600 hover:bg-gray-50 bg-white text-sm shadow-sm">
                                857
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-300 text-gray-500 hover:bg-gray-50 bg-white shadow-sm">
                                <ChevronRight size={16} />
                            </button>
                        </div>
                    </div>
                </div>
            </main>

            {/* Footer */}
            <Footer />
        </div>
    );
}
