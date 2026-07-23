import React from 'react';
import { Head, Link, router } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import { User, LogOut, Edit2, FileText, Camera } from 'lucide-react';

export default function Index({ user, penduduk }) {
    const handleLogout = (e) => {
        e.preventDefault();
        router.post(route('logout'));
    };

    const formatAddress = () => {
        if (!penduduk) return '-';
        const parts = [];
        if (penduduk.alamat) parts.push(penduduk.alamat);
        if (penduduk.rt || penduduk.rw) parts.push(`RT ${penduduk.rt || '-'}/RW ${penduduk.rw || '-'}`);
        if (penduduk.dusun) parts.push(`Dusun ${penduduk.dusun}`);
        parts.push('Desa Binangun, Kec. Binangun');
        return parts.join(', ');
    };

    return (
        <div className="min-h-screen bg-[#fcf8f0] font-sans selection:bg-[#4a6b52] selection:text-white flex flex-col">
            <Head title="Informasi Pribadi" />
            <Navbar variant="civil" />

            <main className="flex-grow w-full max-w-7xl mx-auto px-4 md:px-8 lg:px-20 py-10 md:py-12">
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    {/* Sidebar */}
                    <div className="lg:col-span-3">
                        <div className="sticky top-24">
                            <h3 className="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-4 px-2">Pengaturan Akun</h3>
                            <nav className="flex flex-col gap-2">
                                <Link 
                                    href="/profile" 
                                    className="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#344627] text-white font-medium text-sm transition shadow-sm"
                                >
                                    <User size={18} />
                                    Informasi Pribadi
                                </Link>
                                <button 
                                    onClick={handleLogout}
                                    className="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#c53030] text-white hover:bg-[#9b2c2c] font-medium text-sm transition shadow-sm w-full text-left"
                                >
                                    <LogOut size={18} />
                                    Logout
                                </button>
                            </nav>
                        </div>
                    </div>

                    {/* Main Content */}
                    <div className="lg:col-span-9">
                        <div className="mb-6">
                            <h1 className="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Informasi Pribadi</h1>
                            <p className="text-gray-600 text-sm">Kelola identitas kependudukan dan informasi kontak Anda.</p>
                        </div>

                        <div className="grid grid-cols-1 xl:grid-cols-3 gap-6">
                            
                            {/* Profile Details Card */}
                            <div className="xl:col-span-2 bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 flex flex-col">
                                <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                                    <div className="flex items-center gap-4">
                                        <div className="relative">
                                            <div className="w-20 h-20 rounded-full bg-[#e4e6de] border-4 border-white shadow-sm flex items-center justify-center overflow-hidden">
                                                <User size={36} className="text-gray-400" />
                                            </div>
                                            <div className="absolute bottom-0 right-0 w-7 h-7 bg-[#2b3a20] rounded-full border-2 border-white flex items-center justify-center text-white">
                                                <Camera size={12} />
                                            </div>
                                        </div>
                                        <div>
                                            <h2 className="text-xl font-bold text-gray-900">{user.name}</h2>
                                            <p className="text-sm text-gray-500 mt-1">NIK: {user.nik}</p>
                                        </div>
                                    </div>
                                    <Link 
                                        href="/profile/edit" 
                                        className="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 font-bold text-sm transition shadow-sm whitespace-nowrap"
                                    >
                                        <Edit2 size={14} />
                                        Ubah Profil
                                    </Link>
                                </div>

                                <hr className="border-gray-100 mb-8" />

                                <div className="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-6">
                                    <div>
                                        <h3 className="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat Sesuai KTP</h3>
                                        <p className="text-sm text-gray-800 leading-relaxed font-medium">
                                            {formatAddress()}
                                        </p>
                                    </div>
                                    <div>
                                        <h3 className="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Nomor Telepon</h3>
                                        <p className="text-sm text-gray-800 font-medium">{user.phone || '-'}</p>
                                    </div>
                                    <div>
                                        <h3 className="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Jenis Kelamin</h3>
                                        <p className="text-sm text-gray-800 font-medium">
                                            {penduduk?.jenis_kelamin == 1 ? 'Laki-laki' : (penduduk?.jenis_kelamin == 2 ? 'Perempuan' : '-')}
                                        </p>
                                    </div>
                                    <div>
                                        <h3 className="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Umur</h3>
                                        <p className="text-sm text-gray-800 font-medium">
                                            {penduduk?.usia ? `${penduduk.usia} Tahun` : '-'}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {/* Dokumen Pendukung Card */}
                            <div className="xl:col-span-1 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                                <div className="flex items-center gap-2 mb-6">
                                    <FileText size={20} className="text-gray-700" />
                                    <h2 className="text-lg font-bold text-gray-900">Dokumen Pendukung</h2>
                                </div>

                                <div className="space-y-4">
                                    <div className="relative rounded-xl overflow-hidden border border-gray-200 group bg-gray-50 h-32 flex items-center justify-center">
                                        {penduduk?.ktp_path ? (
                                            <img 
                                                src={`/storage/ktp/${penduduk.ktp_path}`} 
                                                alt="KTP Digital" 
                                                className="w-full h-full object-cover transition duration-300 group-hover:scale-105"
                                            />
                                        ) : (
                                            <span className="text-xs text-gray-400 font-medium">Belum ada KTP</span>
                                        )}
                                        <div className="absolute inset-x-0 bottom-0 bg-black/60 backdrop-blur-sm p-2 text-center">
                                            <span className="text-xs font-bold text-white">KTP Digital</span>
                                        </div>
                                    </div>

                                    <div className="relative rounded-xl overflow-hidden border border-gray-200 group bg-gray-50 h-32 flex items-center justify-center">
                                        {penduduk?.kk_path ? (
                                            <img 
                                                src={`/storage/kk/${penduduk.kk_path}`} 
                                                alt="Kartu Keluarga" 
                                                className="w-full h-full object-cover transition duration-300 group-hover:scale-105"
                                            />
                                        ) : (
                                            <span className="text-xs text-gray-400 font-medium">Belum ada KK</span>
                                        )}
                                        <div className="absolute inset-x-0 bottom-0 bg-black/60 backdrop-blur-sm p-2 text-center">
                                            <span className="text-xs font-bold text-white">Kartu Keluarga</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
            <Footer />
        </div>
    );
}
