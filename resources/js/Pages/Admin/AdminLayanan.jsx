import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Search, Filter, Download, CheckCircle, Clock, Eye, FileText, ChevronLeft, ChevronRight } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminLayanan() {
    return (
        <div className="min-h-screen bg-[#f8f9f2] font-sans text-gray-800 flex flex-col relative">
            <Head title="Kelola Layanan Surat" />

            <Navbar />

            <main className="max-w-7xl mx-auto px-4 md:px-8 py-10 flex-grow w-full">
                {/* Header Section */}
                <div className="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
                    <div className="max-w-2xl">
                        <h1 className="text-3xl md:text-4xl font-bold text-[#2b3a20] mb-3">Kelola Layanan Surat</h1>
                        <p className="text-gray-600 leading-relaxed text-sm md:text-base">
                            Pantau dan proses pengajuan administrasi warga secara real-time. Pastikan verifikasi data sesuai dengan regulasi desa.
                        </p>
                    </div>
                </div>


                {/* Table Container */}
                <div className="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                    {/* Search and Tabs */}
                    <div className="p-4 md:p-6 border-b border-gray-100 flex flex-col lg:flex-row justify-between items-center gap-4 bg-[#fcfcf9]">
                        <div className="w-full lg:w-80 relative">
                            <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <Search size={18} />
                            </div>
                            <input
                                type="text"
                                placeholder="Cari"
                                className="w-full bg-white border border-gray-200 rounded-xl pl-11 p-3 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20] outline-none shadow-sm"
                            />
                        </div>
                        <div className="flex items-center gap-2 overflow-x-auto w-full lg:w-auto pb-1 lg:pb-0 hide-scrollbar">
                            <button className="px-5 py-2.5 rounded-full bg-[#4a5f36] text-white text-xs font-bold whitespace-nowrap shadow-sm">Semua (124)</button>
                            <button className="px-5 py-2.5 rounded-full bg-[#edebe1] text-gray-600 hover:bg-gray-200 text-xs font-bold whitespace-nowrap transition">Pending (8)</button>
                            <button className="px-5 py-2.5 rounded-full bg-[#edebe1] text-gray-600 hover:bg-gray-200 text-xs font-bold whitespace-nowrap transition">Diproses (12)</button>
                            <button className="px-5 py-2.5 rounded-full bg-[#edebe1] text-gray-600 hover:bg-gray-200 text-xs font-bold whitespace-nowrap transition">Selesai (104)</button>
                        </div>
                    </div>

                    {/* Table */}
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm whitespace-nowrap">
                            <thead className="bg-[#eef0e5] text-gray-600 text-[11px] font-bold tracking-wider border-b border-gray-200 uppercase">
                                <tr>
                                    <th className="px-6 py-4">NO. REGISTRASI</th>
                                    <th className="px-6 py-4">NAMA WARGA</th>
                                    <th className="px-6 py-4 text-center">JENIS SURAT</th>
                                    <th className="px-6 py-4 text-center">TANGGAL PENGAJUAN</th>
                                    <th className="px-6 py-4 text-center">STATUS</th>
                                    <th className="px-6 py-4 text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-100">
                                {[
                                    { reg: '#REG-081', name: 'Agus Setiawan', type: 'SKU (Usaha)', date: '24 Juni 2026', status: 'Menunggu Verifikasi', statusColor: 'bg-[#fcebba] text-[#b38515]', actionType: 'proses' },
                                    { reg: '#REG-082', name: 'Rina Marlina', type: 'SKTM', date: '23 Juni 2026', status: 'Menunggu Verifikasi', statusColor: 'bg-[#fcebba] text-[#b38515]', actionType: 'proses' },
                                    { reg: '#REG-079', name: 'Bambang Pamungkas', type: 'SKCK', date: '22 Juni 2026', status: 'Sedang Diproses', statusColor: 'bg-[#d8ddce] text-[#556934]', actionType: 'detail' },
                                ].map((row, idx) => (
                                    <tr key={idx} className="hover:bg-gray-50 transition">
                                        <td className="px-6 py-5 font-bold text-gray-700">{row.reg}</td>
                                        <td className="px-6 py-5 font-bold text-gray-800">{row.name}</td>
                                        <td className="px-6 py-5 text-center">
                                            <span className="bg-[#e4e7d7] text-[#4a5f36] text-[10px] font-bold px-3 py-1.5 rounded-full">{row.type}</span>
                                        </td>
                                        <td className="px-6 py-5 text-gray-500 text-center">{row.date}</td>
                                        <td className="px-6 py-5 text-center">
                                            <div className={`inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-wide ${row.statusColor}`}>
                                                <div className="w-1.5 h-1.5 rounded-full bg-current opacity-70"></div>
                                                {row.status}
                                            </div>
                                        </td>
                                        <td className="px-6 py-5 text-center">
                                            {row.actionType === 'proses' ? (
                                                <button className="inline-flex items-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-4 py-2 rounded-lg text-xs font-bold transition shadow-sm">
                                                    <FileText size={14} />
                                                    Proses
                                                </button>
                                            ) : (
                                                <button className="inline-flex items-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-xs font-bold transition shadow-sm">
                                                    <Eye size={14} />
                                                    Lihat Detail
                                                </button>
                                            )}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    <div className="px-6 py-4 border-t border-gray-100 flex flex-wrap items-center justify-between gap-4">
                        <span className="text-[11px] font-bold text-gray-500">Menampilkan 1-3 dari 124 data</span>
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
