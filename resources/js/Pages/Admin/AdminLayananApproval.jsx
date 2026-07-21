import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { FileUp, Send, User, ShieldCheck } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminLayananApproval() {
    return (
        <div className="min-h-screen bg-[#f8f9f2] font-sans text-gray-800 flex flex-col relative">
            <Head title="Upload Surat Balasan" />

            <Navbar />

            <main className="max-w-5xl mx-auto px-4 md:px-8 py-10 flex-grow w-full">
                {/* Header Section */}
                <div className="mb-8">
                    <h1 className="text-3xl font-bold text-[#2b3a20] mb-2">Upload Surat Balasan</h1>
                    <p className="text-gray-600 text-sm max-w-2xl">
                        Unggah dokumen final yang telah diverifikasi dan disetujui. <br className="hidden md:block"/>
                        Pastikan dokumen sudah melalui tahap penandatanganan basah atau digital maupun stempel desa.
                    </p>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                    {/* Main Form Area */}
                    <div className="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        
                        {/* Applicant Info */}
                        <div className="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div className="flex items-center gap-4">
                                <div className="w-12 h-12 bg-[#e4e7d7] text-[#4a5f36] rounded-full flex items-center justify-center shrink-0">
                                    <User size={20} />
                                </div>
                                <div>
                                    <p className="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">PEMOHON</p>
                                    <p className="font-bold text-gray-800 text-lg">Andry Ilmy Sukma</p>
                                </div>
                            </div>
                            <div className="sm:text-right">
                                <p className="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">NOMOR REGISTRASI</p>
                                <p className="font-bold text-gray-800">REG/2024/09/0142</p>
                            </div>
                        </div>

                        {/* Upload Area */}
                        <div className="p-6 md:p-8">
                            <div className="border-2 border-dashed border-gray-300 bg-[#fbfcf9] rounded-xl p-10 flex flex-col items-center justify-center text-center hover:bg-[#f4f5f0] transition cursor-pointer group">
                                <div className="w-14 h-14 bg-[#e9ebe0] rounded-full flex items-center justify-center text-[#556934] mb-4 group-hover:scale-110 transition-transform">
                                    <FileUp size={24} />
                                </div>
                                <h3 className="text-sm font-bold text-gray-800 mb-1">Klik untuk unggah atau seret file ke sini</h3>
                                <p className="text-xs text-gray-500">Hanya file .PDF yang didukung (Maksimal 5MB)</p>
                            </div>
                        </div>

                        {/* Actions */}
                        <div className="p-6 border-t border-gray-100 bg-[#fbfcf9] flex flex-col sm:flex-row items-center justify-end gap-4">
                            <Link 
                                href="/admin/layanan/detail" 
                                className="w-full sm:w-auto px-8 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-sm font-bold hover:bg-gray-50 transition text-center shadow-sm"
                            >
                                Batal
                            </Link>
                            <button className="w-full sm:w-auto flex items-center justify-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-8 py-3 rounded-xl text-sm font-bold transition shadow-sm">
                                <Send size={16} />
                                Selesaikan & Kirim
                            </button>
                        </div>
                    </div>

                    {/* Info Card Sidebar */}
                    <div className="lg:col-span-1">
                        <div className="bg-[#5c4a11] rounded-2xl p-6 text-[#f9ecd3] shadow-md relative overflow-hidden">
                            {/* Decorative Icon */}
                            <div className="absolute -right-4 -bottom-4 opacity-10">
                                <ShieldCheck size={120} />
                            </div>
                            
                            <div className="flex items-center gap-3 mb-4 relative z-10">
                                <div className="text-[#f9c02d]">
                                    <ShieldCheck size={24} />
                                </div>
                                <h2 className="text-lg font-bold text-[#f2cc60]">Siap Kirim?</h2>
                            </div>
                            
                            <p className="text-sm leading-relaxed relative z-10 text-[#d4c391]">
                                Setelah tombol kirim ditekan, sistem akan otomatis mengirimkan notifikasi ke aplikasi warga dan berkas digital akan tersedia di akun pemohon.
                            </p>
                        </div>
                    </div>
                </div>
            </main>

            <Footer />
        </div>
    );
}
