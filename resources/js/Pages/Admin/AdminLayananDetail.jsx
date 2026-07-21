import React, { useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import { Info, Clock, MessageCircle, Send, ZoomIn, ZoomOut, XCircle, Printer, CheckCircle, ChevronLeft, X, AlertTriangle } from 'lucide-react';
import Navbar from '@/Components/Navbar';

export default function AdminLayananDetail() {
    const [isRejectModalOpen, setIsRejectModalOpen] = useState(false);
    return (
        <div className="min-h-screen bg-[#f8f9f2] font-sans text-gray-800 flex flex-col relative">
            <Head title="Validasi Surat" />

            <Navbar />

            <main className="max-w-[1400px] mx-auto px-4 md:px-8 py-8 w-full flex-grow flex flex-col h-full">
                {/* Header */}
                <div className="mb-6 flex items-center gap-4">
                    <Link href="/admin/layanan" className="text-gray-500 hover:text-[#2b3a20] transition">
                        <ChevronLeft size={24} />
                    </Link>
                    <div>
                        <h1 className="text-3xl font-bold text-[#2b3a20] mb-1">Validasi Surat</h1>
                        <p className="text-gray-600 text-sm">
                            Periksa kesesuaian dokumen fisik, data pemohon dan syarat berkaitan. Tentukan tindakan persetujuan di bawah ini.
                        </p>
                    </div>
                </div>

                <div className="flex flex-col lg:flex-row gap-6 lg:h-[calc(100vh-200px)] lg:min-h-[700px]">
                    {/* Left Sidebar */}
                    <div className="w-full lg:w-[280px] flex flex-col gap-6 shrink-0 lg:h-full lg:overflow-y-auto hide-scrollbar">

                        {/* Detail Permohonan Card */}
                        <div className="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                            <div className="flex items-center gap-2 text-gray-700 font-bold mb-6">
                                <Info size={18} />
                                <h2>Detail Permohonan</h2>
                            </div>

                            <div className="space-y-5">
                                <div>
                                    <p className="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">NO. REGISTRASI</p>
                                    <p className="font-bold text-gray-800">REG/2024/09/0142</p>
                                </div>
                                <div>
                                    <p className="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">NAMA PEMOHON</p>
                                    <p className="font-bold text-gray-800">Andry Ilmy Sukma</p>
                                </div>
                                <div>
                                    <p className="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">JENIS LAYANAN</p>
                                    <p className="font-bold text-gray-800">SURAT PENGANTAR SKCK</p>
                                </div>
                                <div>
                                    <p className="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">TANGGAL MASUK</p>
                                    <p className="font-bold text-gray-800">12 September 2026</p>
                                </div>

                                <hr className="border-gray-100" />

                                <div>
                                    <span className="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-wide bg-[#fcebba] text-[#b38515]">
                                        <Clock size={12} />
                                        SEDANG DIPROSES
                                    </span>
                                </div>
                            </div>
                        </div>

                        {/* Riwayat & Diskusi Card */}
                        <div className="bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col flex-grow min-h-[300px]">
                            <div className="p-4 border-b border-gray-100 flex items-center justify-between">
                                <div className="flex items-center gap-2 text-gray-700 font-bold text-sm">
                                    <MessageCircle size={16} />
                                    <h2>Riwayat & Diskusi</h2>
                                </div>
                                <Clock size={14} className="text-gray-400" />
                            </div>

                            <div className="flex-grow p-4 overflow-y-auto flex flex-col gap-4">
                                {/* User Message */}
                                <div className="flex items-start gap-3">
                                    <div className="w-8 h-8 rounded-full bg-[#dcf4c6] text-[#467b28] flex items-center justify-center font-bold text-xs shrink-0">
                                        BW
                                    </div>
                                    <div className="bg-[#f6f7f2] rounded-xl rounded-tl-none p-3 max-w-[85%]">
                                        <p className="text-xs font-bold text-gray-800 mb-1">Bambang Wijaya</p>
                                        <p className="text-xs text-gray-600 mb-1">Halo pak, saya butuh surat ini untuk pengajuan KUR Bank.</p>
                                        <p className="text-[9px] text-gray-400 text-right">09:15 AM</p>
                                    </div>
                                </div>

                                {/* System Message */}
                                <div className="flex justify-center my-1">
                                    <span className="bg-gray-100 text-gray-500 text-[9px] font-bold px-3 py-1 rounded-full">
                                        Berkas diverifikasi oleh Admin
                                    </span>
                                </div>

                                {/* Admin Message */}
                                <div className="flex items-start justify-end gap-3">
                                    <div className="bg-[#2b3a20] rounded-xl rounded-tr-none p-3 max-w-[85%] text-white">
                                        <p className="text-xs font-bold text-gray-200 mb-1">Admin Desa</p>
                                        <p className="text-xs text-gray-100 mb-1">Baik, sedang kami buatkan drafnya. Mohon tunggu sejenak.</p>
                                        <p className="text-[9px] text-[#8e9c80] text-right">09:45 AM</p>
                                    </div>
                                    <div className="w-8 h-8 rounded-full bg-[#2b3a20] text-white flex items-center justify-center font-bold text-xs shrink-0">
                                        AD
                                    </div>
                                </div>
                            </div>

                            {/* Chat Input */}
                            <div className="p-4 border-t border-gray-100">
                                <div className="relative">
                                    <input
                                        type="text"
                                        placeholder="Ketik pesan..."
                                        className="w-full bg-white border border-gray-300 rounded-full pl-4 pr-10 py-2.5 text-xs text-gray-700 focus:ring-2 focus:ring-[#2b3a20] outline-none"
                                    />
                                    <button className="absolute right-2 top-1/2 -translate-y-1/2 w-7 h-7 rounded-full flex items-center justify-center text-gray-500 hover:text-[#2b3a20] transition">
                                        <Send size={14} />
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    {/* Right Document Area */}
                    <div className="flex-1 flex flex-col lg:h-full min-h-[600px] lg:overflow-hidden">
                        {/* Document Viewer */}
                        <div className="bg-[#dcdfd3] rounded-t-2xl flex-grow overflow-y-auto p-4 md:p-8 flex justify-center border border-gray-200">
                            {/* Dummy Document Paper */}
                            <div className="bg-white w-full max-w-[700px] h-max min-h-[900px] shadow-sm p-10 md:p-16 flex flex-col">
                                {/* Kop Surat */}
                                <div className="border-b-[3px] border-black pb-4 mb-8 flex items-center justify-center relative">
                                    {/* Logo Placeholder */}
                                    <div className="absolute left-0">
                                        <div className="w-16 md:w-20 aspect-[3/4] bg-gray-200 flex items-center justify-center text-gray-400 text-xs text-center p-2">
                                            Logo <br /> Kab Blitar
                                        </div>
                                    </div>
                                    <div className="text-center">
                                        <h2 className="text-lg md:text-xl font-bold font-serif leading-tight">PEMERINTAH KABUPATEN BLITAR</h2>
                                        <h2 className="text-lg md:text-xl font-bold font-serif leading-tight">KECAMATAN BINANGUN</h2>
                                        <h1 className="text-xl md:text-2xl font-bold font-serif leading-tight mb-1">DESA BINANGUN</h1>
                                        <p className="text-[10px] md:text-xs">Alamat : Jl. Supriyadi No. 15 Telp. (+62) 81217203368 Kode Pos 66193</p>
                                        <p className="text-[10px] md:text-xs">Email : pemdes.binangun@gmail.com website : binangun-binangun.desa.id</p>
                                    </div>
                                </div>

                                {/* Title */}
                                <div className="text-center mb-8">
                                    <h3 className="text-lg font-bold underline font-serif">SURAT PENGANTAR SKCK</h3>
                                    <p className="text-sm">Nomor: _____ / 409.40.2 / 2026</p>
                                </div>

                                {/* Body */}
                                <div className="text-sm leading-relaxed text-justify space-y-6">
                                    <p>Yang bertanda tangan dibawah ini kami Kepala Desa Binangun menerangkan bahwa :</p>

                                    <table className="w-full ml-4 md:ml-8">
                                        <tbody>
                                            <tr>
                                                <td className="w-48 py-1">Nama lengkap</td>
                                                <td className="w-4 py-1">:</td>
                                                <td className="font-bold py-1">Andry Ilmy Sukma</td>
                                            </tr>
                                            <tr>
                                                <td className="py-1">Tempat dan tanggal lahir</td>
                                                <td className="py-1">:</td>
                                                <td className="py-1">Blitar, 15 Juli 2000</td>
                                            </tr>
                                            <tr>
                                                <td className="py-1">Jenis Kelamin</td>
                                                <td className="py-1">:</td>
                                                <td className="py-1">Laki - Laki</td>
                                            </tr>
                                            <tr>
                                                <td className="py-1">Warga Negara</td>
                                                <td className="py-1">:</td>
                                                <td className="py-1">Indonesia</td>
                                            </tr>
                                            <tr>
                                                <td className="py-1">A g a m a</td>
                                                <td className="py-1">:</td>
                                                <td className="py-1">Islam</td>
                                            </tr>
                                            <tr>
                                                <td className="py-1">Status perkawinan</td>
                                                <td className="py-1">:</td>
                                                <td className="py-1">Belum Kawin</td>
                                            </tr>
                                            <tr>
                                                <td className="py-1">Pendidikan terakhir</td>
                                                <td className="py-1">:</td>
                                                <td className="py-1">S-1</td>
                                            </tr>
                                            <tr>
                                                <td className="py-1">P e k e r j a a n</td>
                                                <td className="py-1">:</td>
                                                <td className="py-1">Wiraswasta</td>
                                            </tr>
                                            <tr>
                                                <td className="py-1">N I K</td>
                                                <td className="py-1">:</td>
                                                <td className="py-1">3302151204850003</td>
                                            </tr>
                                            <tr>
                                                <td className="py-1 align-top">Tempat Tinggal</td>
                                                <td className="py-1 align-top">:</td>
                                                <td className="py-1">Dusun Binangun RT. 001 RW. 003 <br /> Desa Binangun Kecamatan Binangun Kab.Blitar</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div className="pt-2">
                                        <p className="mb-2">ADALAH BENAR :</p>
                                        <ul className="list-disc pl-5 space-y-1">
                                            <li>Selama menjadi penduduk Desa Binangun berkelakuan baik</li>
                                            <li>Selalu ta'at / patuh pada peraturan Pemerintah Desa</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Action Bar */}
                        <div className="bg-white border border-gray-200 border-t-0 rounded-b-2xl p-4 md:p-6 flex flex-col md:flex-row items-center justify-between gap-4 shrink-0 shadow-sm">
                            <button 
                                onClick={() => setIsRejectModalOpen(true)}
                                className="w-full md:w-auto flex items-center justify-center gap-2 bg-[#be2e2e] hover:bg-[#9d2424] text-white px-6 py-3 rounded-xl text-sm font-bold transition shadow-sm"
                            >
                                <XCircle size={18} />
                                Tolak Permohonan
                            </button>

                            <div className="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">
                                <button className="w-full md:w-auto flex items-center justify-center gap-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-6 py-3 rounded-xl text-sm font-bold transition shadow-sm">
                                    <Printer size={18} />
                                    Cetak Surat
                                </button>
                                <button className="w-full md:w-auto flex items-center justify-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-6 py-3 rounded-xl text-sm font-bold transition shadow-sm">
                                    <CheckCircle size={18} />
                                    Lanjutkan Permohonan
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </main>

            {/* Reject Modal */}
            {isRejectModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-sm">
                    <div className="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200">
                        {/* Header */}
                        <div className="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-white">
                            <div className="flex items-center gap-3">
                                <div className="w-10 h-10 rounded-full bg-red-100 text-red-500 flex items-center justify-center">
                                    <AlertTriangle size={20} />
                                </div>
                                <h2 className="text-xl font-bold text-gray-800">Tolak Pengajuan Surat</h2>
                            </div>
                            <button 
                                onClick={() => setIsRejectModalOpen(false)}
                                className="text-gray-400 hover:text-gray-600 transition"
                            >
                                <X size={20} />
                            </button>
                        </div>
                        
                        {/* Body */}
                        <div className="p-6 bg-white">
                            <p className="text-sm text-gray-600 leading-relaxed mb-6">
                                Harap masukkan alasan penolakan secara jelas. Alasan ini akan dikirimkan kepada pemohon melalui notifikasi dan riwayat diskusi.
                            </p>
                            
                            <div className="mb-6">
                                <label className="block text-sm font-bold text-gray-800 mb-2">Alasan Penolakan</label>
                                <textarea 
                                    rows={4}
                                    placeholder="Contoh: Dokumen KTP kurang jelas atau tidak terbaca..."
                                    className="w-full bg-[#f6f7f2] border border-gray-200 rounded-xl p-4 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20] outline-none resize-none"
                                />
                            </div>
                            
                            {/* Alert Box */}
                            <div className="bg-[#fcf0d8] border border-[#f0c169] rounded-xl p-4 flex gap-3">
                                <Info size={16} className="text-[#a67c00] shrink-0 mt-0.5" />
                                <p className="text-xs font-medium text-[#8f6a00] leading-relaxed">
                                    Penolakan ini bersifat final untuk registrasi ini. Pemohon harus mengajukan ulang jika terdapat perbaikan data.
                                </p>
                            </div>
                        </div>
                        
                        {/* Footer */}
                        <div className="px-6 py-5 bg-[#f6f7f2] flex justify-end gap-3 border-t border-gray-100">
                            <button 
                                onClick={() => setIsRejectModalOpen(false)}
                                className="px-6 py-2.5 text-sm font-bold text-gray-700 hover:text-gray-900 hover:bg-gray-200 rounded-xl transition"
                            >
                                Batal
                            </button>
                            <button 
                                onClick={() => setIsRejectModalOpen(false)}
                                className="px-6 py-2.5 bg-[#be2e2e] hover:bg-[#9d2424] text-white text-sm font-bold rounded-xl shadow-sm transition"
                            >
                                Konfirmasi Tolak
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}
