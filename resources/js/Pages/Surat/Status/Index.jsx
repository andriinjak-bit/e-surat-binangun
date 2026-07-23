import React, { useState } from 'react';
import { Head, Link, usePage, router } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import { FileText, Clock, CheckCircle, XCircle, Search, Filter, Download, Eye, Plus, ChevronLeft, ChevronRight } from 'lucide-react';

export default function Index({ suratRequests, stats, filters }) {
    const [search, setSearch] = useState(filters?.search || '');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get(route('surat.status.index'), { search }, { preserveState: true, replace: true });
    };

    const getStatusBadge = (status) => {
        switch (status) {
            case 'pending':
            case 'diproses':
                return (
                    <div className="inline-flex items-center gap-1.5 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                        <div className="w-1.5 h-1.5 bg-yellow-500 rounded-full"></div>
                        Diproses
                    </div>
                );
            case 'selesai':
                return (
                    <div className="inline-flex items-center gap-1.5 px-3 py-1 bg-[#d2dcbc]/50 text-[#2b3a20] rounded-full text-xs font-semibold">
                        <div className="w-1.5 h-1.5 bg-[#4a6b52] rounded-full"></div>
                        Selesai / Diterima
                    </div>
                );
            case 'ditolak':
                return (
                    <div className="inline-flex items-center gap-1.5 px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                        <div className="w-1.5 h-1.5 bg-red-500 rounded-full"></div>
                        Butuh Revisi
                    </div>
                );
            default:
                return (
                    <div className="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">
                        <div className="w-1.5 h-1.5 bg-gray-500 rounded-full"></div>
                        {status}
                    </div>
                );
        }
    };

    const formatId = (id) => {
        return `#REG-BNG-${new Date().getFullYear()}-${String(id).padStart(3, '0')}`;
    };

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    };

    return (
        <div className="min-h-screen bg-[#fcf8f0] flex flex-col font-sans selection:bg-[#4a6b52] selection:text-white">
            <Head title="Cek Status Pengajuan" />
            <Navbar variant="civil" />

            <main className="flex-grow max-w-7xl w-full mx-auto px-4 md:px-8 lg:px-20 py-10 md:py-16">
                
                {/* Header Section */}
                <div className="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
                    <div>
                        <h1 className="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Status Pengajuan Saya</h1>
                        <p className="text-gray-600 text-sm md:text-base">Pantau perkembangan surat administratif Anda secara real-time.</p>
                    </div>
                    <Link 
                        href="/layanan" 
                        className="bg-[#2b3a20] hover:bg-[#1a2413] text-white px-5 py-2.5 rounded-lg flex items-center gap-2 font-medium text-sm transition shadow-sm"
                    >
                        <Plus size={18} />
                        Ajukan Surat Baru
                    </Link>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    {/* Card 1 */}
                    <div className="bg-[#f2f1e9] border border-[#e4e6de] rounded-2xl p-6 relative overflow-hidden">
                        <div className="flex justify-between items-start mb-6">
                            <div className="bg-white p-2 rounded-lg shadow-sm text-gray-700">
                                <FileText size={20} />
                            </div>
                            <span className="text-[10px] font-bold text-gray-500 tracking-wider">TOTAL</span>
                        </div>
                        <div className="flex items-end gap-2">
                            <span className="text-4xl font-light text-gray-900 leading-none">{String(stats.semua).padStart(2, '0')}</span>
                            <span className="text-sm font-medium text-gray-600 mb-1">Permohonan</span>
                        </div>
                        <div className="absolute bottom-0 left-6 right-6 h-1 bg-gray-300 rounded-t-md"></div>
                    </div>

                    {/* Card 2 */}
                    <div className="bg-[#f8f5e6] border border-[#e4e6de] rounded-2xl p-6 relative overflow-hidden">
                        <div className="flex justify-between items-start mb-6">
                            <div className="bg-white p-2 rounded-lg shadow-sm text-[#d97706]">
                                <Clock size={20} />
                            </div>
                            <span className="text-[10px] font-bold text-gray-500 tracking-wider">PROSES</span>
                        </div>
                        <div className="flex items-end gap-2">
                            <span className="text-4xl font-light text-[#d97706] leading-none">{String(stats.pending + stats.diproses).padStart(2, '0')}</span>
                            <span className="text-sm font-medium text-gray-600 mb-1">Verifikasi</span>
                        </div>
                        <div className="absolute bottom-0 left-6 right-6 h-1 bg-[#d97706] rounded-t-md"></div>
                    </div>

                    {/* Card 3 */}
                    <div className="bg-[#eff5eb] border border-[#d2dcbc] rounded-2xl p-6 relative overflow-hidden">
                        <div className="flex justify-between items-start mb-6">
                            <div className="bg-white p-2 rounded-lg shadow-sm text-[#4a6b52]">
                                <CheckCircle size={20} />
                            </div>
                            <span className="text-[10px] font-bold text-gray-500 tracking-wider">SELESAI</span>
                        </div>
                        <div className="flex items-end gap-2">
                            <span className="text-4xl font-light text-[#4a6b52] leading-none">{String(stats.selesai).padStart(2, '0')}</span>
                            <span className="text-sm font-medium text-gray-600 mb-1">Siap Diambil</span>
                        </div>
                        <div className="absolute bottom-0 left-6 right-6 h-1 bg-[#4a6b52] rounded-t-md"></div>
                    </div>

                    {/* Card 4 */}
                    <div className="bg-[#fdf0ef] border border-[#f5c6cb] rounded-2xl p-6 relative overflow-hidden">
                        <div className="flex justify-between items-start mb-6">
                            <div className="bg-white p-2 rounded-lg shadow-sm text-red-600">
                                <XCircle size={20} />
                            </div>
                            <span className="text-[10px] font-bold text-gray-500 tracking-wider">DITOLAK</span>
                        </div>
                        <div className="flex items-end gap-2">
                            <span className="text-4xl font-light text-red-600 leading-none">{String(stats.ditolak).padStart(2, '0')}</span>
                            <span className="text-sm font-medium text-gray-600 mb-1">Butuh Revisi</span>
                        </div>
                        <div className="absolute bottom-0 left-6 right-6 h-1 bg-red-600 rounded-t-md"></div>
                    </div>
                </div>

                {/* Filters */}
                <div className="flex flex-col lg:flex-row justify-between items-center gap-4 mb-6 bg-white p-3 rounded-xl border border-gray-200 shadow-sm">
                    <form onSubmit={handleSearch} className="relative w-full lg:w-2/3">
                        <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <Search size={18} className="text-gray-400" />
                        </div>
                        <input
                            type="text"
                            placeholder="Cari No. Registrasi, Jenis Surat, atau Status..."
                            className="block w-full pl-10 pr-3 py-2.5 bg-gray-50 border-0 text-sm text-gray-900 rounded-lg focus:ring-0"
                            value={search}
                            onChange={(e) => setSearch(e.target.value)}
                        />
                    </form>
                    
                    <div className="flex gap-3 w-full lg:w-auto">
                        <button className="flex-1 lg:flex-none flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            <Filter size={16} />
                            Filter Lanjut
                        </button>
                        <button className="flex-1 lg:flex-none flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            <Download size={16} />
                            Ekspor Data
                        </button>
                    </div>
                </div>

                {/* Table */}
                <div className="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm whitespace-nowrap">
                            <thead className="bg-gray-50/50 text-gray-500 text-[11px] font-bold uppercase tracking-wider border-b border-gray-200">
                                <tr>
                                    <th className="px-6 py-4">No. Registrasi</th>
                                    <th className="px-6 py-4">Jenis Pelayanan Surat</th>
                                    <th className="px-6 py-4">Tanggal Pengajuan</th>
                                    <th className="px-6 py-4">Status Saat Ini</th>
                                    <th className="px-6 py-4 text-center">Lihat Detail</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-100 text-gray-700">
                                {suratRequests.data.length > 0 ? (
                                    suratRequests.data.map((request) => (
                                        <tr key={request.id} className="hover:bg-gray-50/50 transition">
                                            <td className="px-6 py-4 font-medium text-gray-900">
                                                {formatId(request.id)}
                                            </td>
                                            <td className="px-6 py-4">
                                                {request.template?.judul || 'Template tidak ditemukan'}
                                            </td>
                                            <td className="px-6 py-4 text-gray-500">
                                                {formatDate(request.created_at)}
                                            </td>
                                            <td className="px-6 py-4">
                                                {getStatusBadge(request.status)}
                                            </td>
                                            <td className="px-6 py-4 text-center">
                                                <Link 
                                                    href={route('surat.status.detail', { id: request.id })}
                                                    className="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-700 hover:text-[#4a6b52] transition"
                                                >
                                                    Detail <Eye size={16} />
                                                </Link>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="5" className="px-6 py-12 text-center text-gray-500">
                                            Belum ada data pengajuan surat.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {suratRequests.last_page > 1 && (
                    <div className="flex items-center justify-between mt-6 px-2">
                        <div className="text-xs text-gray-500 font-medium">
                            Menampilkan <span className="text-gray-900">{suratRequests.from} - {suratRequests.to}</span> dari <span className="text-gray-900">{suratRequests.total}</span> pengajuan
                        </div>
                        <div className="flex items-center gap-2">
                            {suratRequests.links.map((link, index) => {
                                // Skip Next/Prev labels, use icons instead
                                if (link.label.includes('Previous')) {
                                    return (
                                        <Link 
                                            key={index} 
                                            href={link.url || '#'} 
                                            className={`w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 ${!link.url ? 'text-gray-300 cursor-not-allowed' : 'text-gray-600 hover:bg-gray-50'} transition`}
                                            preserveScroll
                                        >
                                            <ChevronLeft size={16} />
                                        </Link>
                                    );
                                }
                                if (link.label.includes('Next')) {
                                    return (
                                        <Link 
                                            key={index} 
                                            href={link.url || '#'} 
                                            className={`w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 ${!link.url ? 'text-gray-300 cursor-not-allowed' : 'text-gray-600 hover:bg-gray-50'} transition`}
                                            preserveScroll
                                        >
                                            <ChevronRight size={16} />
                                        </Link>
                                    );
                                }
                                
                                return (
                                    <Link 
                                        key={index}
                                        href={link.url || '#'}
                                        className={`w-8 h-8 flex items-center justify-center rounded-lg text-sm font-medium transition ${link.active ? 'bg-[#2b3a20] text-white border-transparent' : 'border border-gray-200 text-gray-600 hover:bg-gray-50'}`}
                                        preserveScroll
                                    >
                                        <span dangerouslySetInnerHTML={{ __html: link.label }}></span>
                                    </Link>
                                );
                            })}
                        </div>
                    </div>
                )}
            </main>

            <Footer />
        </div>
    );
}
