import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Users, ClipboardList, CheckCircle, XCircle, Eye, Edit2, LogOut, User, Filter, Download } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function DashboardAdmin({ totalSurat, pendingSurat, diprosesSurat, selesaiSurat, ditolakSurat, totalUsers, totalPenduduk, recentSurat }) {
    return (
        <div className="min-h-screen font-sans text-gray-800 bg-[#f8f9f2]">
            <Head title="Admin Dashboard" />

            {/* Navbar */}
            <Navbar />

            {/* Main Content */}
            <main className="max-w-7xl mx-auto px-4 md:px-8 py-10 mt-8 md:mt-0">
                <div className="mb-8">
                    <h1 className="text-3xl md:text-4xl font-bold text-[#2b3a20] mb-2">Admin Dashboard</h1>
                    <p className="text-gray-600 text-lg">Kelola informasi sipil dan layanan surat warga Desa Binangun.</p>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                    {/* Card 1 */}
                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 relative">
                        <div className="w-max bg-blue-50 p-2 rounded-lg mb-4 text-gray-600">
                            <Users size={20} />
                        </div>
                        <div className="text-xs font-bold text-gray-400 mb-1 tracking-wider">TOTAL PENDUDUK</div>
                        <div className="text-4xl font-bold text-blue-800">{totalPenduduk || 0}</div>
                        <div className="mt-2 bg-blue-100 text-blue-800 text-xs font-bold px-2 py-0.5 rounded w-max">Penduduk terdata</div>
                    </div>

                    {/* Card 2 */}
                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 relative">
                        <div className="bg-yellow-50 w-max p-2 rounded-lg mb-4 text-yellow-600">
                            <ClipboardList size={20} />
                        </div>
                        <div className="text-xs font-bold text-gray-400 mb-1 tracking-wider">PERMOHONAN PENDING</div>
                        <div className="text-4xl font-bold text-[#b4802c]">{pendingSurat || 0}</div>
                        <div className="mt-2 bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-0.5 rounded w-max">Butuh review segera</div>
                    </div>

                    {/* Card 3 */}
                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 relative">
                        <div className="bg-green-50 w-max p-2 rounded-lg mb-4 text-green-600">
                            <CheckCircle size={20} />
                        </div>
                        <div className="text-xs font-bold text-gray-400 mb-1 tracking-wider">SURAT DISETUJUI</div>
                        <div className="text-4xl font-bold text-green-700">{selesaiSurat || 0}</div>
                        <div className="mt-2 bg-green-50 text-green-700 text-xs font-bold px-2 py-0.5 rounded w-max">Total tervalidasi</div>
                    </div>

                    {/* Card 4 */}
                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 relative">
                        <div className="bg-red-50 w-max p-2 rounded-lg mb-4 text-red-500">
                            <XCircle size={20} />
                        </div>
                        <div className="text-xs font-bold text-gray-400 mb-1 tracking-wider">SURAT DITOLAK</div>
                        <div className="text-4xl font-bold text-red-600">{ditolakSurat || 0}</div>
                        <div className="mt-2 bg-red-50 text-red-600 text-xs font-bold px-2 py-0.5 rounded w-max">Revisi diperlukan</div>
                    </div>
                </div>

                {/* Table Section */}
                <div className="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div className="px-6 py-5 border-b border-gray-200 flex items-center justify-between bg-white flex-wrap gap-4">
                        <div>
                            <h2 className="text-xl font-bold text-[#2b3a20]">Aktivitas Terkini</h2>
                            <p className="text-sm text-gray-500">Data pengajuan surat dan administrasi terbaru.</p>
                        </div>

                    </div>
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm whitespace-nowrap">
                            <thead className="bg-[#f8f9f2] border-b border-gray-200 text-gray-500 text-xs font-semibold tracking-wider">
                                <tr>
                                    <th className="px-6 py-4">PEMOHON</th>
                                    <th className="px-6 py-4">NIK</th>
                                    <th className="px-6 py-4">JENIS LAYANAN</th>
                                    <th className="px-6 py-4">TANGGAL</th>
                                    <th className="px-6 py-4">STATUS</th>
                                    <th className="px-6 py-4">AKSI</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-100">
                                {recentSurat && recentSurat.length > 0 ? (
                                    recentSurat.map((row, idx) => {
                                        const dateStr = new Date(row.created_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                                        const statusColor = row.status === 'selesai' ? 'bg-green-100 text-green-700' :
                                            row.status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
                                                row.status === 'ditolak' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700';

                                        return (
                                            <tr key={idx} className="hover:bg-gray-50 transition">
                                                <td className="px-6 py-4 font-medium text-gray-800">{row.user?.penduduk?.nama || row.user?.name || '-'}</td>
                                                <td className="px-6 py-4 text-gray-500">{row.user?.nik || '-'}</td>
                                                <td className="px-6 py-4 text-gray-600">{row.template?.judul || 'Layanan Lainnya'}</td>
                                                <td className="px-6 py-4 text-gray-500">{dateStr}</td>
                                                <td className="px-6 py-4">
                                                    <span className={`text-[10px] font-bold px-2 py-1 rounded-full uppercase ${statusColor}`}>
                                                        {row.status}
                                                    </span>
                                                </td>
                                                <td className="px-6 py-4">
                                                    <div className="flex items-center gap-3 text-gray-400">
                                                        <Link href={`/admin/layanan/detail?id=${row.id}`} className="hover:text-blue-500 transition" title="Lihat Detail">
                                                            <Eye size={18} />
                                                        </Link>
                                                    </div>
                                                </td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan="6" className="px-6 py-8 text-center text-gray-500">
                                            Belum ada aktivitas pengajuan surat.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

            {/* Footer */}
            <Footer />
        </div>
    );
}
