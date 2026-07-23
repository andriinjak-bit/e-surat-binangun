import React, { useState, useRef } from 'react';
import { Head, Link, useForm, router } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import { User, LogOut, ChevronLeft, Upload, FileText, Image as ImageIcon, Save, AlertCircle } from 'lucide-react';

export default function Edit({ user, penduduk }) {
    const { data, setData, post, processing, errors } = useForm({
        _method: 'PUT', // Inertia needs this for PUT requests with file uploads
        nama: penduduk?.nama || user.name || '',
        tempat_lahir: penduduk?.tempat_lahir || '',
        tanggal_lahir: penduduk?.tanggal_lahir || '',
        jenis_kelamin: penduduk?.jenis_kelamin || '',
        pekerjaan: penduduk?.pekerjaan || '',
        agama: penduduk?.agama || '',
        pendidikan: penduduk?.pendidikan || '',
        status_pernikahan: penduduk?.status_pernikahan || '',
        shdk: penduduk?.shdk || '',
        no_kk: penduduk?.no_kk || '',
        rt: penduduk?.rt || '',
        rw: penduduk?.rw || '',
        alamat: penduduk?.alamat || '',
        dusun: penduduk?.dusun || '',
        ktp: null,
        kk: null,
    });

    const [ktpPreview, setKtpPreview] = useState(penduduk?.ktp_path ? `/storage/ktp/${penduduk.ktp_path}` : null);
    const [kkPreview, setKkPreview] = useState(penduduk?.kk_path ? `/storage/kk/${penduduk.kk_path}` : null);
    
    const ktpInputRef = useRef(null);
    const kkInputRef = useRef(null);

    const handleLogout = (e) => {
        e.preventDefault();
        router.post(route('logout'));
    };

    const handleFileChange = (e, type) => {
        const file = e.target.files[0];
        if (file) {
            setData(type, file);
            const reader = new FileReader();
            reader.onload = (e) => {
                if (type === 'ktp') setKtpPreview(e.target.result);
                if (type === 'kk') setKkPreview(e.target.result);
            };
            reader.readAsDataURL(file);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/profile', {
            preserveScroll: true,
            forceFormData: true, // Needed for file uploads
        });
    };

    return (
        <div className="min-h-screen bg-[#fcf8f0] font-sans selection:bg-[#4a6b52] selection:text-white flex flex-col">
            <Head title="Ubah Profil" />
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
                        <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                            <div>
                                <h1 className="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Ubah Profil</h1>
                                <p className="text-gray-600 text-sm">Perbarui informasi data diri dan dokumen pendukung Anda.</p>
                            </div>
                            <Link 
                                href="/profile" 
                                className="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 font-bold text-sm transition shadow-sm whitespace-nowrap"
                            >
                                <ChevronLeft size={16} />
                                Batal
                            </Link>
                        </div>

                        <form onSubmit={handleSubmit} className="space-y-6">
                            
                            {/* Personal Info Card */}
                            <div className="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100">
                                <h2 className="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                                    <User size={20} className="text-gray-400" />
                                    Data Diri
                                </h2>
                                
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div className="md:col-span-2">
                                        <label className="block text-xs font-bold text-gray-700 mb-2">Nama Lengkap</label>
                                        <input
                                            type="text"
                                            value={data.nama}
                                            onChange={e => setData('nama', e.target.value)}
                                            className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                            placeholder="Masukkan nama lengkap"
                                        />
                                        {errors.nama && <p className="text-red-500 text-xs mt-1">{errors.nama}</p>}
                                    </div>
                                    
                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-2">Tempat Lahir</label>
                                        <input
                                            type="text"
                                            value={data.tempat_lahir}
                                            onChange={e => setData('tempat_lahir', e.target.value)}
                                            className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                            placeholder="Kota kelahiran"
                                        />
                                        {errors.tempat_lahir && <p className="text-red-500 text-xs mt-1">{errors.tempat_lahir}</p>}
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-2">Tanggal Lahir</label>
                                        <input
                                            type="date"
                                            value={data.tanggal_lahir}
                                            onChange={e => setData('tanggal_lahir', e.target.value)}
                                            className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                        />
                                        {errors.tanggal_lahir && <p className="text-red-500 text-xs mt-1">{errors.tanggal_lahir}</p>}
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-2">Jenis Kelamin</label>
                                        <select
                                            value={data.jenis_kelamin}
                                            onChange={e => setData('jenis_kelamin', e.target.value)}
                                            className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                        >
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="1">Laki-laki</option>
                                            <option value="2">Perempuan</option>
                                        </select>
                                        {errors.jenis_kelamin && <p className="text-red-500 text-xs mt-1">{errors.jenis_kelamin}</p>}
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-2">Pekerjaan</label>
                                        <input
                                            type="text"
                                            value={data.pekerjaan}
                                            onChange={e => setData('pekerjaan', e.target.value)}
                                            className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                            placeholder="Pekerjaan saat ini"
                                        />
                                    </div>
                                    
                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-2">Agama</label>
                                        <select
                                            value={data.agama}
                                            onChange={e => setData('agama', e.target.value)}
                                            className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                        >
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-2">Pendidikan</label>
                                        <input
                                            type="text"
                                            value={data.pendidikan}
                                            onChange={e => setData('pendidikan', e.target.value)}
                                            className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                            placeholder="Pendidikan terakhir"
                                        />
                                    </div>
                                    
                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-2">Status Pernikahan</label>
                                        <select
                                            value={data.status_pernikahan}
                                            onChange={e => setData('status_pernikahan', e.target.value)}
                                            className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                        >
                                            <option value="">Pilih Status</option>
                                            <option value="Belum Kawin">Belum Kawin</option>
                                            <option value="Kawin">Kawin</option>
                                            <option value="Cerai Hidup">Cerai Hidup</option>
                                            <option value="Cerai Mati">Cerai Mati</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-2">Nomor KK</label>
                                        <input
                                            type="text"
                                            value={data.no_kk}
                                            onChange={e => setData('no_kk', e.target.value)}
                                            className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                            placeholder="Nomor Kartu Keluarga"
                                        />
                                    </div>
                                    
                                    <div className="md:col-span-2 mt-4 pt-4 border-t border-gray-100">
                                        <h3 className="text-sm font-bold text-gray-800 mb-4">Informasi Alamat</h3>
                                    </div>

                                    <div className="md:col-span-2">
                                        <label className="block text-xs font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                                        <textarea
                                            value={data.alamat}
                                            onChange={e => setData('alamat', e.target.value)}
                                            rows="2"
                                            className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                            placeholder="Nama jalan, perumahan, dll"
                                        ></textarea>
                                    </div>

                                    <div className="grid grid-cols-2 gap-4">
                                        <div>
                                            <label className="block text-xs font-bold text-gray-700 mb-2">Dusun</label>
                                            <input
                                                type="text"
                                                value={data.dusun}
                                                onChange={e => setData('dusun', e.target.value)}
                                                className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                                placeholder="Nama dusun"
                                            />
                                        </div>
                                        <div className="grid grid-cols-2 gap-2">
                                            <div>
                                                <label className="block text-xs font-bold text-gray-700 mb-2">RT</label>
                                                <input
                                                    type="text"
                                                    value={data.rt}
                                                    onChange={e => setData('rt', e.target.value)}
                                                    className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                                    placeholder="001"
                                                />
                                            </div>
                                            <div>
                                                <label className="block text-xs font-bold text-gray-700 mb-2">RW</label>
                                                <input
                                                    type="text"
                                                    value={data.rw}
                                                    onChange={e => setData('rw', e.target.value)}
                                                    className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                                    placeholder="001"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {/* Dokumen Pendukung Form */}
                            <div className="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100">
                                <h2 className="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                                    <FileText size={20} className="text-gray-400" />
                                    Unggah Dokumen Baru
                                </h2>
                                
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    {/* KTP Upload */}
                                    <div>
                                        <label className="block text-sm font-bold text-gray-800 mb-2">Foto KTP</label>
                                        <p className="text-xs text-gray-500 mb-4">Maksimal ukuran file 2MB (JPG, JPEG, PNG)</p>
                                        
                                        <div 
                                            onClick={() => ktpInputRef.current.click()}
                                            className="relative border-2 border-dashed border-gray-300 rounded-xl h-48 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 cursor-pointer transition overflow-hidden group"
                                        >
                                            {ktpPreview ? (
                                                <>
                                                    <img src={ktpPreview} alt="Preview KTP" className="w-full h-full object-cover" />
                                                    <div className="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white">
                                                        <Upload size={24} className="mb-2" />
                                                        <span className="text-xs font-bold">Ganti Foto</span>
                                                    </div>
                                                </>
                                            ) : (
                                                <>
                                                    <ImageIcon size={32} className="text-gray-400 mb-3" />
                                                    <span className="text-sm font-bold text-gray-600">Pilih Foto KTP</span>
                                                </>
                                            )}
                                        </div>
                                        <input 
                                            type="file" 
                                            ref={ktpInputRef} 
                                            onChange={(e) => handleFileChange(e, 'ktp')} 
                                            className="hidden" 
                                            accept="image/jpeg,image/png,image/jpg" 
                                        />
                                        {errors.ktp && <p className="text-red-500 text-xs mt-2 flex items-center gap-1"><AlertCircle size={12}/>{errors.ktp}</p>}
                                    </div>

                                    {/* KK Upload */}
                                    <div>
                                        <label className="block text-sm font-bold text-gray-800 mb-2">Foto Kartu Keluarga</label>
                                        <p className="text-xs text-gray-500 mb-4">Maksimal ukuran file 2MB (JPG, JPEG, PNG)</p>
                                        
                                        <div 
                                            onClick={() => kkInputRef.current.click()}
                                            className="relative border-2 border-dashed border-gray-300 rounded-xl h-48 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 cursor-pointer transition overflow-hidden group"
                                        >
                                            {kkPreview ? (
                                                <>
                                                    <img src={kkPreview} alt="Preview KK" className="w-full h-full object-cover" />
                                                    <div className="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white">
                                                        <Upload size={24} className="mb-2" />
                                                        <span className="text-xs font-bold">Ganti Foto</span>
                                                    </div>
                                                </>
                                            ) : (
                                                <>
                                                    <ImageIcon size={32} className="text-gray-400 mb-3" />
                                                    <span className="text-sm font-bold text-gray-600">Pilih Foto KK</span>
                                                </>
                                            )}
                                        </div>
                                        <input 
                                            type="file" 
                                            ref={kkInputRef} 
                                            onChange={(e) => handleFileChange(e, 'kk')} 
                                            className="hidden" 
                                            accept="image/jpeg,image/png,image/jpg" 
                                        />
                                        {errors.kk && <p className="text-red-500 text-xs mt-2 flex items-center gap-1"><AlertCircle size={12}/>{errors.kk}</p>}
                                    </div>
                                </div>
                            </div>

                            <div className="flex justify-end pt-4">
                                <button
                                    type="submit"
                                    disabled={processing}
                                    className="bg-[#2b3a20] text-white px-8 py-3.5 rounded-xl font-bold text-sm hover:bg-[#1a2413] transition shadow-sm flex items-center gap-2 disabled:opacity-50"
                                >
                                    <Save size={16} />
                                    Simpan Perubahan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </main>
            <Footer />
        </div>
    );
}
