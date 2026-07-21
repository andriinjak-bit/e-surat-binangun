import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Search, Filter, PlusCircle, Edit2, Eye, Trash2, ChevronLeft, ChevronRight, Store, HeartHandshake, ShieldCheck, BookUser, FileSearch } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminTemplateSurat({ templates }) {
    // For the UI mockup, we will use static data if templates is not provided or empty
    const displayTemplates = templates?.length > 0 ? templates : [
        { id: 1, title: 'Surat Keterangan Usaha (SKU)', category: 'Ekonomi & Bisnis', updated: '12 Okt 2024', status: 'Aktif', icon: <Store size={20} /> },
        { id: 2, title: 'Surat Keterangan Tidak Mampu (SKTM)', category: 'Kesejahteraan Sosial', updated: '08 Okt 2024', status: 'Aktif', icon: <HeartHandshake size={20} /> },
        { id: 3, title: 'Surat Keterangan Catatan Kepolisian (SKCK)', category: 'Kependudukan', updated: '25 Sep 2024', status: 'Aktif', icon: <ShieldCheck size={20} /> },
        { id: 4, title: 'Akta Kematian (Catatan Sipil)', category: 'Catatan Sipil', updated: '15 Sep 2024', status: 'Review', icon: <BookUser size={20} /> },
        { id: 5, title: 'Surat Pengantar Kehilangan', category: 'Keamanan', updated: '01 Sep 2024', status: 'Aktif', icon: <FileSearch size={20} /> },
    ];

    return (
        <div className="min-h-screen font-sans text-gray-800 flex flex-col">
            <Head title="Manajemen Template Surat" />

            <Navbar />

            <main className="max-w-7xl mx-auto px-4 md:px-8 py-10 mt-8 md:mt-0 flex-grow w-full">
                {/* Header */}
                <div className="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
                    <div className="max-w-2xl">
                        <h1 className="text-3xl md:text-4xl font-bold text-[#2b3a20] mb-3">Manajemen Template Surat</h1>
                        <p className="text-gray-600 leading-relaxed text-sm md:text-base">
                            Kelola format dan template dokumen layanan administrasi desa untuk mempercepat pelayanan kepada warga Desa Binangun.
                        </p>
                    </div>
                    <Link
                        href="/admin/template/create"
                        className="flex items-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-5 py-2.5 rounded-lg text-sm font-medium transition shadow-sm whitespace-nowrap"
                    >
                        <PlusCircle size={18} />
                        Buat Template Baru
                    </Link>
                </div>

                {/* Filters Area */}
                <div className="flex flex-col lg:flex-row items-center gap-4 mb-6">
                    <div className="w-full lg:flex-1 relative">
                        <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <Search size={18} />
                        </div>
                        <input
                            type="text"
                            placeholder="Cari nama template, kategori, atau kode surat..."
                            className="w-full bg-white border border-gray-200 rounded-xl pl-11 p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20] outline-none shadow-sm"
                        />
                    </div>
                    <div className="flex items-center gap-4 w-full lg:w-auto">
                        <button className="flex-1 md:flex-none flex items-center justify-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-5 py-2.5 rounded-lg text-sm font-medium transition shadow-sm">
                            RESET
                        </button>
                    </div>
                </div>

                {/* Table Section */}
                <div className="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm">
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm whitespace-nowrap">
                            <thead className="bg-[#f6f7f2] text-gray-500 text-[10px] font-bold tracking-wider border-b border-gray-200 uppercase">
                                <tr>
                                    <th className="px-6 py-4 rounded-tl-2xl">NAMA TEMPLATE</th>
                                    <th className="px-6 py-4 text-center">TERAKHIR DIPERBARUI</th>
                                    <th className="px-6 py-4 text-center">STATUS</th>
                                    <th className="px-6 py-4 text-center rounded-tr-2xl">AKSI</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-100">
                                {displayTemplates.map((row, idx) => (
                                    <tr key={idx} className="hover:bg-gray-50 transition group">
                                        <td className="px-6 py-5">
                                            <div className="flex items-center gap-4">
                                                <div className="w-10 h-10 rounded-lg bg-[#f0f2e9] text-[#4a5f36] flex items-center justify-center">
                                                    {row.icon || <FileSearch size={20} />}
                                                </div>
                                                <div>
                                                    <span className="font-bold text-gray-800 block text-sm">{row.title || row.judul}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td className="px-6 py-5 text-gray-500 text-center">
                                            {row.updated || 'Baru Saja'}
                                        </td>
                                        <td className="px-6 py-5 text-center">
                                            {row.status === 'Aktif' ? (
                                                <span className="bg-[#dcf4c6] text-[#467b28] text-[10px] font-bold px-3 py-1 rounded-full">Aktif</span>
                                            ) : (
                                                <span className="bg-[#e2e3df] text-[#6d7168] text-[10px] font-bold px-3 py-1 rounded-full">{row.status || 'Draft'}</span>
                                            )}
                                        </td>
                                        <td className="px-6 py-5">
                                            <div className="flex items-center justify-center gap-3">
                                                <button className="text-gray-400 hover:text-[#2b3a20] transition">
                                                    <Edit2 size={16} />
                                                </button>
                                                <button className="text-gray-400 hover:text-[#2b3a20] transition">
                                                    <Eye size={16} />
                                                </button>
                                                <button className="text-gray-400 hover:text-red-500 transition">
                                                    <Trash2 size={16} />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    <div className="px-6 py-5 border-t border-gray-100 flex flex-wrap items-center justify-between gap-4">
                        <span className="text-[11px] font-bold text-gray-400">Menampilkan 5 dari 24 template</span>
                        <div className="flex items-center gap-1">
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-400 hover:text-gray-600 hover:bg-gray-50 bg-white transition">
                                <ChevronLeft size={16} />
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded bg-[#2b3a20] text-white font-bold text-xs shadow-sm">
                                1
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-600 hover:bg-gray-50 bg-white text-xs font-bold transition">
                                2
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-600 hover:bg-gray-50 bg-white text-xs font-bold transition">
                                3
                            </button>
                            <button className="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-400 hover:text-gray-600 hover:bg-gray-50 bg-white transition">
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
