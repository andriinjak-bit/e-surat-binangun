import React, { useRef, useState, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Users, Download, UserPlus, Home, Filter, Edit2, Trash2, ChevronLeft, ChevronRight, Loader2, X } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminPenduduk({ penduduks, filters, total_pria, total_wanita }) {
    const fileInputRef = useRef(null);
    const [isImporting, setIsImporting] = useState(false);
    const [showFilter, setShowFilter] = useState(false);
    const [searchQuery, setSearchQuery] = useState(filters?.search || '');
    const [rtFilter, setRtFilter] = useState(filters?.rt || '');
    const [rwFilter, setRwFilter] = useState(filters?.rw || '');
    const [dusunFilter, setdusunFilter] = useState(filters?.dusun || '');

    const applyFilter = (e) => {
        if (e) e.preventDefault();
        router.get('/admin/penduduk', { search: searchQuery, rt: rtFilter, rw: rwFilter, dusun: dusunFilter }, {
            preserveState: true,
            preserveScroll: true
        });
        setShowFilter(false);
    };

    const resetFilter = () => {
        setSearchQuery('');
        setRtFilter('');
        setRwFilter('');
        setdusunFilter('');
        router.get('/admin/penduduk');
        setShowFilter(false);
    };

    useEffect(() => {
        let interval;
        if (isImporting) {
            interval = setInterval(() => {
                fetch('/admin/penduduk/check-import')
                    .then(res => res.json())
                    .then(data => {
                        if (!data.is_importing) {
                            setIsImporting(false);
                            router.reload({ only: ['penduduks'] });
                        }
                    })
                    .catch(() => {
                        setIsImporting(false);
                    });
            }, 2000);
        }
        return () => clearInterval(interval);
    }, [isImporting]);

    const handleImportClick = () => {
        fileInputRef.current.click();
    };

    const handleFileChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            router.post('/admin/penduduk/import', { file: file }, {
                forceFormData: true,
                preserveScroll: true,
                onSuccess: () => {
                    e.target.value = null;
                    setIsImporting(true);
                }
            });
        }
    };

    const handleDelete = (id) => {
        if (confirm('Yakin ingin menghapus data penduduk ini?')) {
            router.delete(`/admin/penduduk/${id}`);
        }
    };
    return (
        <div className="min-h-screen bg-[#f8f9f2] font-sans text-gray-800">
            <Head title="Data Penduduk" />

            {/* Navbar */}
            <Navbar variant='admin' />

            {/* Main Content */}
            <main className="max-w-7xl mx-auto px-4 md:px-8 py-10 mt-8 md:mt-0 flex-grow w-full">
                <div className="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                    <div>
                        <h1 className="text-3xl md:text-4xl font-bold text-[#2b3a20] mb-2">Data Penduduk</h1>
                        <p className="text-gray-600">Kelola informasi sipil warga Desa Binangun</p>
                    </div>
                    <div className="flex items-center gap-3">
                        <input
                            type="file"
                            ref={fileInputRef}
                            className="hidden"
                            accept=".csv, .txt, .xlsx, .xls"
                            onChange={handleFileChange}
                        />
                        <button onClick={handleImportClick} className="flex items-center gap-2 bg-[#2b3a20] hover:bg-[#000] text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                            <Download size={18} />
                            Import Data
                        </button>
                        <Link href="/admin/penduduk/add" className="flex items-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                            <UserPlus size={18} />
                            Tambah Data
                        </Link>
                    </div>
                </div>

                {isImporting && (
                    <div className="bg-blue-50 border border-blue-200 text-blue-800 rounded-lg p-4 mb-6 flex items-center gap-3">
                        <Loader2 className="animate-spin text-blue-600" size={20} />
                        <div>
                            <p className="font-semibold text-sm">Sedang menambahkan data penduduk...</p>
                            <p className="text-xs text-blue-600">Mohon tunggu, halaman akan otomatis memuat ulang setelah selesai.</p>
                        </div>
                    </div>
                )}

                {/* Stats Cards */}
                <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">
                    {/* Card 1 */}
                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 relative">
                        <div className="flex justify-between items-start mb-4">
                            <div className="bg-gray-100 p-2 rounded-full text-gray-600">
                                <Users size={20} />
                            </div>
                            <span className="text-xs font-semibold text-gray-400">Total</span>
                        </div>
                        <div className="text-4xl font-bold text-[#2b3a20] mb-1">{penduduks.total}</div>
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
                        <div className="text-4xl font-bold text-[#2b3a20] mb-1">{total_pria}</div>
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
                        <div className="text-4xl font-bold text-[#2b3a20] mb-1">{total_wanita}</div>
                        <div className="text-xs text-gray-500">Perempuan</div>
                    </div>
                </div>

                {/* Table Section */}
                <div className="bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                    <div className="px-6 py-5 flex items-center justify-between flex-wrap gap-4 border-b border-gray-200">
                        <h2 className="text-xl font-bold text-[#2b3a20]">Daftar Warga</h2>
                        <div className="flex items-center gap-3">
                            <button onClick={() => setShowFilter(!showFilter)} className="flex items-center gap-2 px-3 py-1.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition bg-white shadow-sm">
                                <Filter size={16} />
                                Filter
                            </button>

                            {/* Filter Modal Popup */}
                            {showFilter && (
                                <div className="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 backdrop-blur-sm px-4">
                                    <div className="bg-white rounded-2xl shadow-xl border border-gray-100 w-full max-w-md p-6 relative animate-in fade-in zoom-in duration-200">
                                        <div className="flex justify-between items-center mb-6">
                                            <h3 className="text-lg font-bold text-[#2b3a20] flex items-center gap-2">
                                                <Filter size={20} className="text-[#2b3a20]" />
                                                Filter Data Warga
                                            </h3>
                                            <button onClick={() => setShowFilter(false)} className="text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 p-1.5 rounded-full transition">
                                                <X size={18} />
                                            </button>
                                        </div>
                                        <form onSubmit={applyFilter} className="space-y-5">
                                            <div>
                                                <label className="block text-sm font-semibold text-gray-700 mb-1.5">Pencarian Nama / NIK</label>
                                                <input type="text" value={searchQuery} onChange={e => setSearchQuery(e.target.value)} placeholder="Masukkan nama atau NIK..." className="w-full bg-[#f6f7f2] border-0 rounded-xl p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20] shadow-sm" />
                                            </div>
                                            <div className="flex-1">
                                                <label className="block text-sm font-semibold text-gray-700 mb-1.5">Dusun</label>
                                                <select
                                                    value={dusunFilter}
                                                    onChange={e => setdusunFilter(e.target.value)}
                                                    className="w-full bg-[#f6f7f2] border-0 rounded-xl p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20] shadow-sm appearance-none"
                                                >
                                                    <option value="">Semua Dusun</option>
                                                    <option value="Binangun">Binangun</option>
                                                    <option value="Selok">Selok</option>
                                                    <option value="Tambimaron">Tambimaron</option>
                                                    <option value="Sambirejo">Sambirejo</option>
                                                    <option value="Kaliwungu">Kaliwungu</option>
                                                </select>
                                            </div>
                                            <div className="flex gap-4">
                                                <div className="flex-1">
                                                    <label className="block text-sm font-semibold text-gray-700 mb-1.5">RT</label>
                                                    <input type="text" value={rtFilter} onChange={e => setRtFilter(e.target.value)} placeholder="Contoh: 001" className="w-full bg-[#f6f7f2] border-0 rounded-xl p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20] shadow-sm" />
                                                </div>
                                                <div className="flex-1">
                                                    <label className="block text-sm font-semibold text-gray-700 mb-1.5">RW</label>
                                                    <input type="text" value={rwFilter} onChange={e => setRwFilter(e.target.value)} placeholder="Contoh: 005" className="w-full bg-[#f6f7f2] border-0 rounded-xl p-3.5 text-sm text-gray-700 focus:ring-2 focus:ring-[#2b3a20] shadow-sm" />
                                                </div>
                                            </div>
                                            <div className="flex gap-3 pt-4 border-t border-gray-100">
                                                <button type="button" onClick={resetFilter} className="flex-1 py-3 bg-gray-100 text-gray-700 rounded-xl text-sm font-bold hover:bg-gray-200 transition shadow-sm">Reset Filter</button>
                                                <button type="submit" className="flex-1 py-3 bg-[#2b3a20] text-white rounded-xl text-sm font-bold hover:bg-[#1f2917] transition shadow-sm">Terapkan Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            )}

                            <a
                                href={`/admin/penduduk/export?search=${searchQuery}&rt=${rtFilter}&rw=${rwFilter}&dusun=${dusunFilter}`}
                                className="flex items-center gap-2 px-3 py-1.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition bg-white shadow-sm"
                            >
                                <Download size={16} />
                                Ekspor
                            </a>
                        </div>
                    </div>
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm bg-white whitespace-nowrap bg-white">
                            <thead className="text-gray-400 bg-white text-xs font-bold tracking-wider border-b border-gray-200">
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
                                    <th className="px-6 py-4 font-semibold uppercase sticky right-0 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.05)]">Aksi</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200 bg-white">
                                {penduduks.data.map((row, idx) => (
                                    <tr key={idx} className="hover:bg-gray-50 transition group">
                                        <td className="px-6 py-4 text-gray-600">{row.no_kk}</td>
                                        <td className="px-6 py-4 text-gray-600">{row.nik}</td>
                                        <td className="px-6 py-4">
                                            <span className="font-medium text-gray-800">{row.nama}</span>
                                        </td>
                                        <td className="px-6 py-4 text-gray-600">{row.jenis_kelamin == '1' ? 'Laki-Laki' : 'Perempuan'}</td>
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

                                        <td className="px-6 py-4 sticky right-0 bg-white group-hover:bg-gray-50 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.05)]">
                                            <div className="flex items-center gap-3 text-gray-400">
                                                <a href={`/admin/penduduk/${row.id}/edit`} className="hover:text-gray-700 transition"><Edit2 size={16} /></a>
                                                <button onClick={() => handleDelete(row.id)} className="hover:text-gray-700 transition"><Trash2 size={16} /></button>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    <div className="px-6 py-4 border-t border-gray-200 flex flex-wrap items-center justify-between gap-4">
                        <span className="text-xs text-gray-500 font-medium">Menampilkan {penduduks.from || 0}-{penduduks.to || 0} dari {penduduks.total} warga</span>
                        <div className="flex items-center gap-1">
                            {penduduks.links.map((link, idx) => {
                                let label = link.label
                                    .replace('&laquo; Previous', '«')
                                    .replace('Next &raquo;', '»')
                                    .replace('Previous', '«')
                                    .replace('Next', '»');
                                return (
                                    <Link
                                        key={idx}
                                        href={link.url || '#'}
                                        className={`w-8 h-8 flex items-center justify-center rounded border text-sm shadow-sm transition ${link.active ? 'bg-[#2b3a20] text-white border-transparent' : 'border-gray-300 text-gray-600 hover:bg-gray-50 bg-white'} ${!link.url ? 'opacity-50 cursor-not-allowed' : ''}`}
                                        dangerouslySetInnerHTML={{ __html: label }}
                                    />
                                );
                            })}
                        </div>
                    </div>
                </div>
            </main>

            {/* Footer */}
            <Footer />
        </div>
    );
}
