import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Info, Bold, Italic, Underline, AlignLeft, AlignCenter, AlignRight, Link2, Image as ImageIcon, CloudUpload, Code, ShieldCheck, Eye } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminTemplateSuratCreate() {
    return (
        <div className="min-h-screen bg-[#f8f9f2] font-sans text-gray-800 flex flex-col relative">
            <Head title="Tambah Template Baru" />

            <Navbar />

            <main className="max-w-5xl mx-auto px-4 md:px-8 py-10 flex-grow w-full">
                {/* Header Section */}
                <div className="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-6">
                    <div>
                        <h1 className="text-3xl font-bold text-[#2b3a20] mb-2">Tambah Template Baru</h1>
                        <p className="text-gray-500 text-sm">
                            Buat standardisasi format surat desa untuk mempercepat pelayanan publik.
                        </p>
                    </div>
                    <div className="flex items-center gap-3 w-full md:w-auto">
                        <Link
                            href="/admin/template"
                            className="flex-1 md:flex-none text-center px-6 py-2.5 rounded-full border border-gray-400 text-gray-700 text-sm font-medium hover:bg-gray-50 transition"
                        >
                            Batal
                        </Link>
                        <button className="flex-1 md:flex-none px-8 py-2.5 rounded-full bg-[#2b3a20] text-white text-sm font-medium hover:bg-[#1f2917] transition shadow-sm">
                            Simpan
                        </button>
                    </div>
                </div>

                {/* Form Section 1: Basic Info */}
                <div className="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 mb-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label className="block text-xs font-bold text-gray-700 mb-2">Nama Template</label>
                            <input
                                type="text"
                                placeholder="Contoh: Surat Keterangan Usaha"
                                className="w-full bg-[#f4f5f0] border-0 rounded-xl p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                            />
                        </div>
                    </div>

                    <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                        <label className="block text-sm font-bold text-gray-800">Isi Template</label>
                        <div className="flex items-center gap-2 text-xs text-gray-500 font-medium">
                            <Info size={14} />
                            <span>Tips: Gunakan [placeholder] untuk data dinamis</span>
                        </div>
                    </div>

                    <div className="border border-gray-200 rounded-xl overflow-hidden mb-6">
                        {/* Editor Toolbar */}
                        <div className="bg-[#eef0e5] px-4 py-2 flex items-center gap-4 border-b border-gray-200 overflow-x-auto">
                            <div className="flex items-center gap-1">
                                <button className="p-1.5 text-gray-700 hover:bg-gray-200 rounded transition"><Bold size={16} /></button>
                                <button className="p-1.5 text-gray-700 hover:bg-gray-200 rounded transition"><Italic size={16} /></button>
                                <button className="p-1.5 text-gray-700 hover:bg-gray-200 rounded transition"><Underline size={16} /></button>
                            </div>
                            <div className="w-px h-5 bg-gray-300"></div>
                            <div className="flex items-center gap-1">
                                <button className="p-1.5 text-gray-700 hover:bg-gray-200 rounded transition"><AlignLeft size={16} /></button>
                                <button className="p-1.5 text-gray-700 hover:bg-gray-200 rounded transition"><AlignCenter size={16} /></button>
                                <button className="p-1.5 text-gray-700 hover:bg-gray-200 rounded transition"><AlignRight size={16} /></button>
                            </div>
                            <div className="w-px h-5 bg-gray-300"></div>
                            <div className="flex items-center gap-1">
                                <button className="p-1.5 text-gray-700 hover:bg-gray-200 rounded transition"><Link2 size={16} /></button>
                                <button className="p-1.5 text-gray-700 hover:bg-gray-200 rounded transition"><ImageIcon size={16} /></button>
                            </div>
                        </div>
                        {/* Editor Area */}
                        <textarea
                            placeholder="Ketik isi surat di sini. Contoh: PEMERINTAH KABUPATEN BANYUMAS..."
                            rows={12}
                            className="w-full bg-white border-0 p-6 text-sm text-gray-700 placeholder-gray-300 focus:ring-0 resize-y"
                        />
                    </div>
                </div>
            </main>
            <Footer />
        </div>
    );
}
