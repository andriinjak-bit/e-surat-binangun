import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, Filter, ChevronLeft, ChevronRight } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminLogActivity({ logs, actions, filters }) {
    const [date, setDate] = useState(filters?.date || '');
    const [action, setAction] = useState(filters?.action || '');
    const [username, setUsername] = useState(filters?.username || '');

    const handleFilter = () => {
        router.get('/admin/log-activity', { date, action, username }, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    const handleReset = () => {
        setDate('');
        setAction('');
        setUsername('');
        router.get('/admin/log-activity', {}, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    const formatDate = (dateString) => {
        const dateObj = new Date(dateString);
        return dateObj.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        }).replace(/\./g, ':');
    };

    return (
        <div className="min-h-screen bg-[#f8f9f2] font-sans text-gray-800 flex flex-col">
            <Head title="Log Aktivitas" />

            <Navbar variant='admin' />

            <main className="max-w-7xl mx-auto px-4 md:px-8 py-10 mt-8 md:mt-0 flex-grow w-full">
                {/* Header */}
                <div className="mb-8 max-w-2xl">
                    <h1 className="text-3xl md:text-4xl font-bold text-[#2b3a20] mb-3">Riwayat Aktivitas Sistem</h1>
                    <p className="text-gray-600 leading-relaxed">
                        Pantau seluruh jejak pengajuan dan tindakan surat menyurat dari warga dan admin.
                    </p>
                </div>

                {/* Filters Area */}
                <div className="bg-white rounded-xl p-4 md:p-6 shadow-sm border border-gray-300 mb-6 flex flex-col md:flex-row items-end gap-4">
                    <div className="w-full md:w-auto">
                        <label className="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">TANGGAL</label>
                        <input
                            type="date"
                            value={date}
                            onChange={(e) => setDate(e.target.value)}
                            className="w-full md:w-40 bg-[#f6f7f2] border-0 rounded-lg p-2.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]"
                        />
                    </div>

                    <div className="w-full md:w-auto">
                        <label className="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">KATEGORI</label>
                        <select 
                            value={action}
                            onChange={(e) => setAction(e.target.value)}
                            className="w-full md:w-48 bg-[#f6f7f2] border-0 rounded-lg p-2.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20]">
                            <option value="">Semua Aksi</option>
                            {actions && actions.map((act, i) => (
                                <option key={i} value={act}>{act}</option>
                            ))}
                        </select>
                    </div>

                    <div className="w-full md:flex-1 relative">
                        <label className="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">CARI PENGGUNA</label>
                        <div className="relative">
                            <input
                                type="text"
                                value={username}
                                onChange={(e) => setUsername(e.target.value)}
                                placeholder="Cari nama..."
                                className="w-full bg-[#f6f7f2] border-0 rounded-lg p-2.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                            />
                        </div>
                    </div>

                    <div className="flex items-center gap-2 w-full md:w-auto mt-4 md:mt-0">
                        <button 
                            onClick={handleFilter}
                            className="flex-1 md:flex-none flex items-center justify-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-5 py-2.5 rounded-lg text-sm font-medium transition shadow-sm">
                            <Filter size={16} />
                            Filter
                        </button>
                        <button 
                            onClick={handleReset}
                            className="flex-1 md:flex-none flex items-center justify-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition shadow-sm">
                            Reset
                        </button>
                    </div>
                </div>

                {/* Table Section */}
                <div className="bg-white rounded-xl overflow-hidden border border-gray-300 shadow-sm">
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm whitespace-nowrap ">
                            <thead className="bg-[#f6f7f2] text-gray-600 text-[11px] font-bold tracking-wider border-b border-gray-300 uppercase">
                                <tr>
                                    <th className="px-6 py-4">WAKTU</th>
                                    <th className="px-6 py-4">PENGGUNA</th>
                                    <th className="px-6 py-4">ACTION</th>
                                    <th className="px-6 py-4">DESKRIPSI</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-100">
                                {logs && logs.data && logs.data.length > 0 ? logs.data.map((log) => (
                                    <tr key={log.id} className="hover:bg-gray-50 transition">
                                        <td className="px-6 py-5 text-gray-500 font-medium">
                                            {formatDate(log.created_at)}
                                        </td>
                                        <td className="px-6 py-5">
                                            <div className="flex items-center gap-3">
                                                <div>
                                                    <span className="font-bold text-gray-800 block">
                                                        {log.user ? log.user.name : 'Sistem'}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td className="px-3 py-5">
                                            <div className={`inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-wide 
                                                ${log.action === 'PENGAJUAN SURAT' ? 'bg-[#dbe4ff] text-[#1c4ed8]' : 
                                                log.action === 'PROSES SURAT' ? 'bg-[#fef9c3] text-[#ca8a04]' : 
                                                log.action === 'SELESAI SURAT' ? 'bg-[#dcfce7] text-[#15803d]' : 
                                                log.action === 'TOLAK SURAT' ? 'bg-[#fee2e2] text-[#b91c1c]' : 
                                                'bg-[#f1f5f9] text-[#475569]'}`}>
                                                {log.action}
                                            </div>
                                        </td>
                                        <td className="px-6 py-5 text-gray-600">
                                            {log.description}
                                        </td>
                                    </tr>
                                )) : (
                                    <tr>
                                        <td colSpan="4" className="px-6 py-8 text-center text-gray-500">
                                            Belum ada log aktivitas surat.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    {logs && logs.links && logs.links.length > 3 && (
                        <div className="px-6 py-4 border-t border-gray-100 flex flex-wrap items-center justify-between gap-4 bg-[#fcfcf9]">
                            <span className="text-[11px] font-bold text-gray-500">
                                Menampilkan {logs.from || 0}-{logs.to || 0} dari {logs.total || 0} catatan
                            </span>
                            <div className="flex items-center gap-1">
                                {logs.links.map((link, idx) => {
                                    let label = link.label
                                        .replace('&laquo; Previous', '«')
                                        .replace('Next &raquo;', '»')
                                        .replace('Previous', '«')
                                        .replace('Next', '»');
                                    
                                    if (link.url === null) {
                                        return (
                                            <div 
                                                key={idx}
                                                className="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-400 bg-gray-50 text-xs shadow-sm cursor-not-allowed"
                                                dangerouslySetInnerHTML={{ __html: label }}
                                            />
                                        );
                                    }
                                    return (
                                        <Link
                                            key={idx}
                                            href={link.url}
                                            className={`w-8 h-8 flex items-center justify-center rounded border text-xs font-bold shadow-sm transition
                                                ${link.active 
                                                    ? 'bg-[#2b3a20] border-[#2b3a20] text-white' 
                                                    : 'border-gray-200 text-gray-600 hover:bg-gray-50 bg-white'
                                                }`}
                                            dangerouslySetInnerHTML={{ __html: label }}
                                        />
                                    );
                                })}
                            </div>
                        </div>
                    )}
                </div>
            </main>

            <Footer />
        </div>
    );
}
