import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, Filter, Download, CheckCircle, Clock, Eye, FileText, ChevronLeft, ChevronRight } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminLayanan({ suratRequests, filters, stats }) {
    const [searchQuery, setSearchQuery] = useState(filters?.search || '');
    const currentStatus = filters?.status || 'semua';

    const handleSearch = (e) => {
        if (e.key === 'Enter') {
            router.get('/admin/layanan', { search: searchQuery, status: currentStatus }, { preserveState: true });
        }
    };

    const handleTabChange = (newStatus) => {
        router.get('/admin/layanan', { search: searchQuery, status: newStatus }, { preserveState: true });
    };

    const getStatusStyle = (status) => {
        switch (status) {
            case 'pending':
                return { text: 'Menunggu Verifikasi', class: 'bg-amber-100 text-amber-700' };
            case 'diproses':
                return { text: 'Sedang Diproses', class: 'bg-blue-100 text-blue-700' };
            case 'ditolak':
                return { text: 'Ditolak', class: 'bg-red-100 text-red-700' };
            case 'selesai':
                return { text: 'Selesai', class: 'bg-green-100 text-green-700' };
            default:
                return { text: status, class: 'bg-gray-100 text-gray-700' };
        }
    };
    return (
        <div className="min-h-screen bg-[#f8f9f2] font-sans text-gray-800 flex flex-col relative">
            <Head title="Kelola Layanan Surat" />

            <Navbar variant='admin' />

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
                <div className="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm">
                    {/* Search and Tabs */}
                    <div className="p-4 md:p-6 border-b border-gray-200 flex flex-col lg:flex-row justify-between items-center gap-4 ">
                        <div className="w-full lg:w-80 relative">
                            <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <Search size={18} />
                            </div>
                            <input
                                type="text"
                                placeholder="Cari pemohon atau NIK (Tekan Enter)"
                                value={searchQuery}
                                onChange={(e) => setSearchQuery(e.target.value)}
                                onKeyDown={handleSearch}
                                className="w-full bg-white border border-gray-200 rounded-xl pl-11 p-3 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20] outline-none shadow-sm"
                            />
                        </div>
                        <div className="flex items-center gap-2 overflow-x-auto w-full lg:w-auto pb-1 lg:pb-0 hide-scrollbar">
                            <button onClick={() => handleTabChange('semua')} className={`px-5 py-2.5 rounded-full text-xs font-bold whitespace-nowrap transition ${currentStatus === 'semua' ? 'bg-[#4a5f36] text-white shadow-sm' : 'bg-[#edebe1] text-gray-600 hover:bg-gray-200'}`}>Semua ({stats?.semua || 0})</button>
                            <button onClick={() => handleTabChange('pending')} className={`px-5 py-2.5 rounded-full text-xs font-bold whitespace-nowrap transition ${currentStatus === 'pending' ? 'bg-[#4a5f36] text-white shadow-sm' : 'bg-[#edebe1] text-gray-600 hover:bg-gray-200'}`}>Pending ({stats?.pending || 0})</button>
                            <button onClick={() => handleTabChange('diproses')} className={`px-5 py-2.5 rounded-full text-xs font-bold whitespace-nowrap transition ${currentStatus === 'diproses' ? 'bg-[#4a5f36] text-white shadow-sm' : 'bg-[#edebe1] text-gray-600 hover:bg-gray-200'}`}>Diproses ({stats?.diproses || 0})</button>
                            <button onClick={() => handleTabChange('ditolak')} className={`px-5 py-2.5 rounded-full text-xs font-bold whitespace-nowrap transition ${currentStatus === 'ditolak' ? 'bg-[#4a5f36] text-white shadow-sm' : 'bg-[#edebe1] text-gray-600 hover:bg-gray-200'}`}>Ditolak ({stats?.ditolak || 0})</button>
                            <button onClick={() => handleTabChange('selesai')} className={`px-5 py-2.5 rounded-full text-xs font-bold whitespace-nowrap transition ${currentStatus === 'selesai' ? 'bg-[#4a5f36] text-white shadow-sm' : 'bg-[#edebe1] text-gray-600 hover:bg-gray-200'}`}>Selesai ({stats?.selesai || 0})</button>
                        </div>
                    </div>

                    {/* Table */}
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm whitespace-nowrap border border-gray-200">
                            <thead className="bg-[#f6f7f2] text-gray-600 text-[11px] font-bold tracking-wider border-b border-gray-200 uppercase">
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
                                {suratRequests?.data?.length > 0 ? (
                                    suratRequests.data.map((row, idx) => {
                                        const statusStyle = getStatusStyle(row.status);
                                        const dateStr = new Date(row.created_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });

                                        return (
                                            <tr key={idx} className="hover:bg-gray-50 transition">
                                                <td className="px-6 py-5 font-bold text-gray-700">REG-{row.id.toString().padStart(4, '0')}</td>
                                                <td className="px-6 py-5 font-bold text-gray-800">{row.user?.penduduk?.nama || '-'}</td>
                                                <td className="px-6 py-5 text-center">
                                                    <span className="bg-[#e4e7d7] text-[#4a5f36] text-[10px] font-bold px-3 py-1.5 rounded-full">
                                                        {row.template?.judul || 'Layanan'}
                                                    </span>
                                                </td>
                                                <td className="px-6 py-5 text-gray-500 text-center">{dateStr}</td>
                                                <td className="px-6 py-5 text-center">
                                                    <div className={`inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-wide ${statusStyle.class}`}>
                                                        <div className="w-1.5 h-1.5 rounded-full bg-current opacity-70"></div>
                                                        {statusStyle.text}
                                                    </div>
                                                </td>
                                                <td className="px-6 py-5 text-center">
                                                    {row.status === 'diproses' ? (
                                                        <Link href={`/admin/layanan/approval?id=${row.id}`} className="inline-flex items-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-4 py-2 rounded-lg text-xs font-bold transition shadow-sm">
                                                            <FileText size={14} />
                                                            Proses Balasan
                                                        </Link>
                                                    ) : (
                                                        <Link href={`/admin/layanan/detail?id=${row.id}`} className="inline-flex items-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-xs font-bold transition shadow-sm">
                                                            <Eye size={14} />
                                                            Lihat Detail
                                                        </Link>
                                                    )}
                                                </td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan="6" className="px-6 py-8 text-center text-gray-500">
                                            Tidak ada data layanan surat yang ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    <div className="px-6 py-4 border-t border-gray-200 flex flex-wrap items-center justify-between gap-4">
                        <span className="text-[11px] font-bold text-gray-500">
                            Menampilkan {suratRequests?.from || 0}-{suratRequests?.to || 0} dari {suratRequests?.total || 0} data
                        </span>
                        <div className="flex items-center gap-1">
                            {suratRequests?.links?.map((link, idx) => {
                                let label = link.label
                                    .replace('&laquo; Previous', '«')
                                    .replace('Next &raquo;', '»')
                                    .replace('Previous', '«')
                                    .replace('Next', '»');
                                return (
                                    <Link
                                        key={idx}
                                        href={link.url || '#'}
                                        className={`w-8 h-8 flex items-center justify-center rounded border text-sm shadow-sm transition ${link.active ? 'bg-[#2b3a20] text-white border-transparent' : 'border-gray-200 text-gray-600 hover:bg-gray-50 bg-white'} ${!link.url ? 'opacity-50 cursor-not-allowed' : ''}`}
                                        dangerouslySetInnerHTML={{ __html: label }}
                                    />
                                );
                            })}
                        </div>
                    </div>
                </div>
            </main>

            <Footer />
        </div>
    );
}
