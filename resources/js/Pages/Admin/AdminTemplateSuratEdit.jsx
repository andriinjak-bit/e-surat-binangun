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

    const handleGenerateVariables = () => {
        // Regex to match {{ variable_name }} or {{variable_name}}
        const regex = /\{\{\s*([a-zA-Z0-9_]+)\s*\}\}/g;
        const matches = [...data.body.matchAll(regex)].map(match => match[1]);
        const uniqueMatches = [...new Set(matches)];

        const newVariables = [...data.variables];

        uniqueMatches.forEach(match => {
            if (!newVariables.find(v => v.name === match)) {
                newVariables.push({
                    name: match,
                    label: match.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase()),
                    type: 'text'
                });
            }
        });

        setData('variables', newVariables);
    };

    const handleAddVariable = () => {
        setData('variables', [...data.variables, { name: '', label: '', type: 'text' }]);
    };

    const handleRemoveVariable = (index) => {
        const newVars = [...data.variables];
        newVars.splice(index, 1);
        setData('variables', newVars);
    };

    const handleVariableChange = (index, field, value) => {
        const newVars = [...data.variables];
        newVars[index][field] = value;
        setData('variables', newVars);
    };

    const [previewModalOpen, setPreviewModalOpen] = useState(false);
    const kopSurat = `<div style="border-bottom: 3px solid black; margin-bottom: 1px; padding-bottom: 10px;">
        <div style="border-bottom: 1px solid black; padding-bottom: 1px; display: flex; align-items: center;">
            <img src="/logo.webp" style="width: 80px; height: auto; margin-right: 20px;" alt="Logo" />
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

            <Navbar variant='admin' />

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

                    {/* Form Section 3: Variables Config */}
                    <div className="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 mb-6">
                        <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                            <div>
                                <h3 className="text-lg font-bold text-[#2b3a20]">Konfigurasi Variabel</h3>
                                <p className="text-xs text-gray-500">Daftarkan variabel yang Anda tulis di editor untuk dijadikan form input. Gunakan format <code className="bg-gray-100 px-1 rounded text-red-500">{'{{nama_variabel}}'}</code></p>
                            </div>
                            <button type="button" onClick={handleGenerateVariables} className="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm font-medium hover:bg-blue-100 flex items-center gap-2 border border-blue-200">
                                <Code size={16} /> Generate dari Teks
                            </button>
                        </div>

                        <div className="space-y-4">
                            {data.variables.map((variable, index) => (
                                <div key={index} className="border border-gray-200 p-4 rounded-xl bg-gray-50 relative flex flex-col md:flex-row gap-4">
                                    <button type="button" onClick={() => handleRemoveVariable(index)} className="absolute top-2 right-2 text-red-500 hover:text-red-700 text-xs font-bold p-1">X</button>

                                    <div className="flex-1">
                                        <label className="block text-xs font-bold text-gray-700 mb-1">Nama Variabel (Sesuai di Editor)</label>
                                        <input type="text" value={variable.name} onChange={e => handleVariableChange(index, 'name', e.target.value)} placeholder="Contoh: nama_lengkap" required className="w-full text-sm border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#2b3a20]" />
                                    </div>

                                    <div className="flex-1">
                                        <label className="block text-xs font-bold text-gray-700 mb-1">Label Form (Untuk User)</label>
                                        <input type="text" value={variable.label} onChange={e => handleVariableChange(index, 'label', e.target.value)} placeholder="Contoh: Nama Lengkap" required className="w-full text-sm border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#2b3a20]" />
                                    </div>

                                    <div className="flex-1">
                                        <label className="block text-xs font-bold text-gray-700 mb-1">Tipe Input</label>
                                        <select value={variable.type} onChange={e => handleVariableChange(index, 'type', e.target.value)} className="w-full text-sm border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#2b3a20]">
                                            <option value="text">Teks Pendek</option>
                                            <option value="textarea">Teks Panjang (Paragraf)</option>
                                            <option value="date">Tanggal</option>
                                            <option value="number">Angka</option>
                                            <option value="signature">Tanda Tangan (Signature Pad)</option>
                                        </select>
                                    </div>
                                </div>
                            ))}

                            {data.variables.length === 0 && (
                                <div className="text-center py-8 text-gray-500 text-sm border-2 border-dashed border-gray-200 rounded-xl">
                                    Belum ada variabel. Klik "Generate dari Teks" atau tambah manual.
                                </div>
                            )}
                        </div>

                        <button type="button" onClick={handleAddVariable} className="mt-4 w-full border-2 border-dashed border-gray-300 text-gray-600 py-3 rounded-xl hover:border-[#2b3a20] hover:text-[#2b3a20] transition font-medium text-sm">
                            + Tambah Variabel Manual
                        </button>
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
                        <div className="p-8 overflow-y-auto bg-white flex justify-center">
                            <div className="bg-white p-10 shadow-sm w-full max-w-[21cm] min-h-[29.7cm] prose prose-sm sm:prose-base prose-td:border-none prose-th:border-none prose-tr:border-none text-gray-800 "
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
