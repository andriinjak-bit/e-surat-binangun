import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, Filter, PlusCircle, Edit2, Eye, Trash2, ChevronLeft, ChevronRight, Store, HeartHandshake, ShieldCheck, BookUser, FileSearch, Download } from 'lucide-react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

export default function AdminTemplateSurat({ templates, filters }) {
    const displayTemplates = templates?.data || [];
    const [searchQuery, setSearchQuery] = useState(filters?.search || '');
    const [previewModalOpen, setPreviewModalOpen] = useState(false);
    const [previewData, setPreviewData] = useState(null);

    const openPreview = (template) => {
        setPreviewData(template);
        setPreviewModalOpen(true);
    };

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

    const handleDownload = (template) => {
        const element = document.createElement("a");
        const htmlContent = `
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>${template.judul}</title>
<style>
    body { font-family: 'Times New Roman', Times, serif; color: black; padding: 20px; max-width: 21cm; margin: 0 auto; line-height: 1.5; }
    table { border-collapse: collapse; }
    td, th { border: none !important; }
</style>
</head>
<body>
    ${kopSurat}
    ${template.body}
</body>
</html>`;
        const file = new Blob([htmlContent], { type: 'text/html' });
        element.href = URL.createObjectURL(file);
        element.download = `${template.judul || 'template'}.html`;
        document.body.appendChild(element); // Required for this to work in FireFox
        element.click();
        document.body.removeChild(element);
    };

    const handleSearch = (e) => {
        if (e.key === 'Enter') {
            router.get('/admin/template', { search: searchQuery }, { preserveState: true });
        }
    };

    const resetFilter = () => {
        setSearchQuery('');
        router.get('/admin/template');
    };

    const handleDelete = (id) => {
        if (!id) {
            console.error("Error: ID template tidak ditemukan.");
            return;
        }
        if (confirm('Yakin ingin menghapus template ini?')) {
            router.delete(`/admin/template/${id}`);
        }
    };

    return (
        <div className="min-h-screen font-sans text-gray-800 flex flex-col bg-[#f8f9f2]">
            <Head title="Manajemen Template Surat" />

            <Navbar variant='admin' />

            <main className="max-w-7xl mx-auto px-4 md:px-8 py-10 mt-8 md:mt-0 flex-grow w-full">
                {/* Header */}
                <div className="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
                    <div className="max-w-2xl">
                        <h1 className="text-3xl md:text-4xl font-bold text-[#2b3a20] mb-3">Manajemen Template Surat</h1>
                        <p className="text-gray-600 leading-relaxed text-sm md:text-base">
                            Kelola format dan template dokumen layanan administrasi desa untuk mempercepat pelayanan kepada warga Desa Binangun.
                        </p>
                    </div>
                    <Link
                        href="/admin/template/create"
                        className="flex items-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-5 py-2.5 rounded-lg text-sm font-medium transition shadow-sm whitespace-nowrap"
                    >
                        <PlusCircle size={18} />
                        Buat Template Baru
                    </Link>
                </div>

                {/* Filters Area */}
                <div className="flex flex-col lg:flex-row items-center gap-4 mb-6">
                    <div className="w-full lg:flex-1 relative">
                        <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <Search size={18} />
                        </div>
                        <input
                            type="text"
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                            onKeyDown={handleSearch}
                            placeholder="Cari nama template..."
                            className="w-full bg-white border border-gray-200 rounded-xl pl-11 p-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20] outline-none shadow-sm"
                        />
                    </div>
                    <div className="flex items-center gap-4 w-full lg:w-auto">
                        <button onClick={resetFilter} className="flex-1 md:flex-none flex items-center justify-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-5 py-2.5 rounded-lg text-sm font-medium transition shadow-sm">
                            RESET
                        </button>
                    </div>
                </div>

                {/* Table Section */}
                <div className="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm">
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm whitespace-nowrap">
                            <thead className="bg-[#f6f7f2] text-gray-500 text-[10px] font-bold tracking-wider border-b border-gray-200 uppercase">
                                <tr>
                                    <th className="px-6 py-4 rounded-tl-2xl">NAMA TEMPLATE</th>
                                    <th className="px-6 py-4 text-center">TERAKHIR DIPERBARUI</th>
                                    <th className="px-6 py-4 text-center">STATUS</th>
                                    <th className="px-6 py-4 text-center rounded-tr-2xl">AKSI</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-100">
                                {displayTemplates.map((row, idx) => (
                                    <tr key={idx} className="hover:bg-gray-50 transition group">
                                        <td className="px-6 py-5">
                                            <div className="flex items-center gap-4">
                                                <div className="w-10 h-10 rounded-lg bg-[#f0f2e9] text-[#4a5f36] flex items-center justify-center">
                                                    {row.icon || <FileSearch size={20} />}
                                                </div>
                                                <div>
                                                    <span className="font-bold text-gray-800 block text-sm">{row.title || row.judul}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td className="px-6 py-5 text-gray-500 text-center">
                                            {new Date(row.updated_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })}
                                        </td>
                                        <td className="px-6 py-5 text-center">
                                            {row.status === 'Aktif' ? (
                                                <span className="bg-[#dcf4c6] text-[#467b28] text-[10px] font-bold px-3 py-1 rounded-full">Aktif</span>
                                            ) : (
                                                <span className="bg-[#e2e3df] text-[#6d7168] text-[10px] font-bold px-3 py-1 rounded-full">{row.status || 'Draft'}</span>
                                            )}
                                        </td>
                                        <td className="px-6 py-5">
                                            <div className="flex items-center justify-center gap-3">
                                                <button onClick={() => openPreview(row)} className="text-gray-400 hover:text-blue-500 transition" title="Preview">
                                                    <Eye size={16} />
                                                </button>
                                                <button onClick={() => handleDownload(row)} className="text-gray-400 hover:text-green-500 transition" title="Download Template">
                                                    <Download size={16} />
                                                </button>
                                                <Link href={`/admin/template/${row.id}/edit`} className="text-gray-400 hover:text-[#2b3a20] transition">
                                                    <Edit2 size={16} />
                                                </Link>
                                                <button onClick={() => handleDelete(row.id)} className="text-gray-400 hover:text-red-500 transition">
                                                    <Trash2 size={16} />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    {templates?.links && (
                        <div className="px-6 py-5 border-t border-gray-100 flex flex-wrap items-center justify-between gap-4">
                            <span className="text-[11px] font-bold text-gray-400">
                                Menampilkan {templates.from || 0}-{templates.to || 0} dari {templates.total} template
                            </span>
                            <div className="flex items-center gap-1">
                                {templates.links.map((link, idx) => {
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
                    )}
                </div>
            </main>

            {/* Modal Preview */}
            {previewModalOpen && previewData && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
                    <div className="bg-white rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] flex flex-col overflow-hidden">
                        <div className="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                            <h2 className="text-xl font-bold text-gray-800">Preview: {previewData.judul}</h2>
                            <button onClick={() => setPreviewModalOpen(false)} className="text-gray-400 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div className="bg-white p-8 overflow-y-auto bg-gray-100 flex justify-center">
                            {/* Simulasi Kertas A4 */}
                            <div className="bg-white p-10 w-full max-w-[21cm] min-h-[29.7cm] prose prose-sm sm:prose-base prose-td:border-none prose-th:border-none prose-tr:border-none text-gray-800"
                                dangerouslySetInnerHTML={{ __html: kopSurat + previewData.body }}
                            />
                        </div>
                        <div className="p-4 border-t border-gray-100 bg-white flex justify-end gap-3">
                            <button onClick={() => handleDownload(previewData)} className="px-5 py-2 bg-[#2b3a20] text-white rounded-lg hover:bg-[#1f2917] font-medium text-sm transition flex items-center gap-2">
                                <Download size={16} /> Download
                            </button>
                            <button onClick={() => setPreviewModalOpen(false)} className="px-5 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium text-sm transition">Tutup Preview</button>
                        </div>
                    </div>
                </div>
            )}

            <Footer />
        </div>
    );
}
