import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Search, Filter, ChevronLeft, ChevronRight } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminLogActivity() {
    return (
        <div className="min-h-screen bg-[#f8f9f2] font-sans text-gray-800 flex flex-col">
            <Head title="Log Aktivitas" />

            <Navbar />

            <main className="max-w-7xl mx-auto px-4 md:px-8 py-10 mt-8 md:mt-0 flex-grow w-full">
                {/* Header */}
                <div className="mb-8 max-w-2xl">
                    <h1 className="text-3xl md:text-4xl font-bold text-[#2b3a20] mb-3">Riwayat Aktivitas Sistem</h1>
                    <p className="text-gray-600 leading-relaxed">
                        Pantau seluruh jejak digital dan log perubahan data oleh tim administrasi desa untuk menjaga integritas data kependudukan.
                    </p>
                </div>

                {/* Filters Area */}
                <div className="bg-white rounded-xl p-4 md:p-6 shadow-sm border border-gray-100 mb-6 flex flex-col md:flex-row items-end gap-4">
                    <div className="w-full md:w-auto">
                        <label className="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">TANGGAL</label>
                        <input
                            type="date"
                            className="w-full md:w-40 bg-[#f6f7f2] border-0 rounded-lg p-2.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]"
                        />
                    </div>

                    <div className="w-full md:w-auto">
                        <label className="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">KATEGORI</label>
                        <select className="w-full md:w-48 bg-[#f6f7f2] border-0 rounded-lg p-2.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]">
                            <option value="">Action</option>
                            <option value="pengajuan">Pengajuan Surat</option>
                            <option value="verifikasi">Verifikasi</option>
                            <option value="update">Update Data</option>
                            <option value="registrasi">Registrasi</option>
                            <option value="login">Login</option>
                        </select>
                    </div>

                    <div className="w-full md:flex-1 relative">
                        <label className="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">CARI DESKRIPSI</label>
                        <div className="relative">
                            <input
                                type="text"
                                placeholder="Misal: Surat Keterangan Domisili..."
                                className="w-full bg-[#f6f7f2] border-0 rounded-lg p-2.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                            />
                        </div>
                    </div>

                    <div className="flex items-center gap-2 w-full md:w-auto mt-4 md:mt-0">
                        <button className="flex-1 md:flex-none flex items-center justify-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-5 py-2.5 rounded-lg text-sm font-medium transition shadow-sm">
                            <Filter size={16} />
                            Filter
                        </button>
                        <button className="flex-1 md:flex-none flex items-center justify-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-5 py-2.5 rounded-lg text-sm font-medium transition shadow-sm">
                            Reset
                        </button>
                    </div>
                </div>

                {/* Table Section */}
                <div className="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm whitespace-nowrap">
                            <thead className="bg-[#eef0e5] text-gray-600 text-[11px] font-bold tracking-wider border-b border-gray-200 uppercase">
                                <tr>
                                    <th className="px-6 py-4">WAKTU</th>
                                    <th className="px-6 py-4">PENGGUNA</th>
                                    <th className="px-6 py-4">ACTION</th>
                                    <th className="px-6 py-4">DESKRIPSI</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-100">
                                {[
                                    { time: '13 Jul 2026, 09:45', name: 'Budi Santoso', role: 'Warga', action: 'PENGAJUAN SURAT', desc: 'Mengajukan Surat Keterangan Usaha untuk UMKM', initColor: 'bg-[#4a5f36]' },
                                    { time: '13 Jul 2026, 09:31', name: 'Admin Utama', role: '', action: 'UPDATE DATA', desc: 'Mengubah alamat domisili warga: Budi Santoso (NIK: 3201...)', initColor: 'bg-[#e4e7d7] text-[#4a5f36]' },
                                    { time: '13 Jul 2026, 09:20', name: 'Admin Utama', role: '', action: 'VERIFIKASI', desc: 'Menyetujui pengajuan SKTM ID: #DESA-098', initColor: 'bg-[#e4e7d7] text-[#4a5f36]' },
                                    { time: '13 Jul 2026, 08:55', name: 'Siti Rahma', role: 'Warga', action: 'REGISTRASI', desc: 'Berhasil melakukan registrasi akun warga baru', initColor: 'bg-[#4a5f36]' },
                                    { time: '12 Jul 2026, 14:15', name: 'Admin Utama', role: '', action: 'LOGIN', desc: 'Sesi admin dimulai dari IP: 192.168.1.45', initColor: 'bg-[#e4e7d7] text-[#4a5f36]' },
                                ].map((row, idx) => (
                                    <tr key={idx} className="hover:bg-gray-50 transition">
                                        <td className="px-6 py-5 text-gray-500 font-medium">{row.time}</td>
                                        <td className="px-6 py-5">
                                            <div className="flex items-center gap-3">
                                                <div>
                                                    <span className="font-bold text-gray-800 block">{row.name} {row.role && <span className="font-normal text-gray-500">({row.role})</span>}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td className="px-3 py-5">
                                            <div className={`inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-wide ${row.actionColor}`}>
                                                {row.action}
                                            </div>
                                        </td>
                                        <td className="px-6 py-5 text-gray-600">
                                            {row.desc}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    <div className="px-6 py-4 border-t border-gray-100 flex flex-wrap items-center justify-between gap-4 bg-[#fcfcf9]">
                        <span className="text-[11px] font-bold text-gray-500">Menampilkan 1-5 dari 48 catatan</span>
                        <div className="flex items-center gap-1">
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-400 hover:text-gray-600 hover:bg-gray-50 bg-white shadow-sm transition">
                                <ChevronLeft size={16} />
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded bg-[#2b3a20] text-white font-bold text-xs shadow-sm">
                                1
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-600 hover:bg-gray-50 bg-white text-xs font-bold shadow-sm transition">
                                2
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-600 hover:bg-gray-50 bg-white text-xs font-bold shadow-sm transition">
                                3
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-400 hover:text-gray-600 hover:bg-gray-50 bg-white shadow-sm transition">
                                <ChevronRight size={16} />
                            </button>
                        </div>
                    </div>
                </div>
            </main>

            <Footer />
        </div>
    );
}
