import React, { useState } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import { Info, Bold, Italic, Underline, AlignLeft, AlignCenter, AlignRight, Link2, Image as ImageIcon, CloudUpload, Code, ShieldCheck, Eye } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import TiptapEditor from '@/Components/TiptapEditor';

export default function AdminTemplateSuratEdit({ template }) {
    const { data, setData, put, processing, errors } = useForm({
        judul: template?.judul || '',
        body: template?.body || '',
        variables: template?.variables || []
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        const updateUrl = template?.id ? `/admin/template/${template.id}` : `/admin/template`;
        put(updateUrl);
    };

    const [previewModalOpen, setPreviewModalOpen] = useState(false);
    const kopSurat = `<div style="border-bottom: 3px solid black; margin-bottom: 1px; padding-bottom: 10px;">
        <div style="border-bottom: 1px solid black; padding-bottom: 1px; display: flex; align-items: center;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/94/Lambang_Kabupaten_Blitar.webp" style="width: 80px; height: auto; margin-right: 20px;" alt="Logo" />
            <div style="text-align: center; flex: 1; padding-right: 80px;">
                <h3 style="margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase;">PEMERINTAH KABUPATEN BLITAR</h3>
                <h3 style="margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase;">KECAMATAN BINANGUN</h3>
                <h2 style="margin: 0; font-size: 16pt; font-weight: bold; text-transform: uppercase;">DESA BINANGUN</h2>
                <p style="margin: 0; font-size: 10pt;">Alamat : Jl. Supriyadi No. 15, Telp.(+62) 81217023368 Kode Pos 66193</p>
                <p style="margin: 0; font-size: 10pt;">Email : <u>pemdes.binangun@gmail.com</u> website : binangun-binangun.desa.id</p>
            </div>
        </div>
    </div><br>`;

    return (
        <div className="min-h-screen bg-[#f8f9f2] font-sans text-gray-800 flex flex-col relative">
            <Head title="Edit Template" />

            <Navbar />

            <main className="max-w-5xl mx-auto px-4 md:px-8 py-10 flex-grow w-full">
                <form onSubmit={handleSubmit}>
                {/* Header Section */}
                <div className="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-6">
                    <div>
                        <h1 className="text-3xl font-bold text-[#2b3a20] mb-2">Edit Template</h1>
                        <p className="text-gray-500 text-sm">
                            Edit standardisasi format surat desa.
                        </p>
                    </div>
                    <div className="flex items-center gap-3 w-full md:w-auto">
                        <Link
                            href="/admin/template"
                            className="flex-1 md:flex-none text-center px-6 py-2.5 rounded-full border border-gray-400 text-gray-700 text-sm font-medium hover:bg-gray-50 transition"
                        >
                            Batal
                        </Link>
                        <button type="button" onClick={() => setPreviewModalOpen(true)} className="flex-1 md:flex-none px-6 py-2.5 rounded-full border border-gray-400 text-gray-700 text-sm font-medium hover:bg-gray-50 transition flex items-center gap-2 justify-center">
                            <Eye size={16} /> Preview
                        </button>
                        <button type="submit" disabled={processing} className="flex-1 md:flex-none px-8 py-2.5 rounded-full bg-[#2b3a20] text-white text-sm font-medium hover:bg-[#1f2917] transition shadow-sm">
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
                                value={data.judul}
                                onChange={e => setData('judul', e.target.value)}
                                placeholder="Contoh: Surat Keterangan Usaha"
                                className="w-full bg-[#f4f5f0] border-0 rounded-xl p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20]"
                            />
                            {errors.judul && <div className="text-red-500 text-xs mt-1">{errors.judul}</div>}
                        </div>
                    </div>

                </div>

                {/* Form Section 2: Editor */}
                <div className="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 mb-6">
                    <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                        <label className="block text-sm font-bold text-gray-800">Isi Template</label>
                        <div className="flex items-center gap-2 text-xs text-gray-500 font-medium">
                            <Info size={14} />
                            <span>Tips: Gunakan [placeholder] untuk data dinamis</span>
                        </div>
                    </div>

                        <TiptapEditor
                            value={data.body}
                            onChange={(content) => setData('body', content)}
                        />
                    {errors.body && <div className="text-red-500 text-xs mt-1 -mt-4 mb-6">{errors.body}</div>}
                </div>
                </form>
            </main>

            {/* Modal Preview */}
            {previewModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
                    <div className="bg-white rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] flex flex-col overflow-hidden">
                        <div className="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                            <h2 className="text-xl font-bold text-gray-800">Preview: {data.judul || 'Template'}</h2>
                            <button onClick={() => setPreviewModalOpen(false)} className="text-gray-400 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div className="p-8 overflow-y-auto bg-gray-100 flex justify-center">
                            <div className="bg-white p-10 shadow-sm w-full max-w-[21cm] min-h-[29.7cm] prose prose-sm sm:prose-base prose-td:border-none prose-th:border-none prose-tr:border-none text-gray-800 border border-gray-200"
                                 dangerouslySetInnerHTML={{ __html: kopSurat + data.body }}
                            />
                        </div>
                        <div className="p-4 border-t border-gray-100 bg-white flex justify-end">
                            <button onClick={() => setPreviewModalOpen(false)} className="px-5 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium text-sm transition">Tutup Preview</button>
                        </div>
                    </div>
                </div>
            )}

            <Footer />
        </div>
    );
}
