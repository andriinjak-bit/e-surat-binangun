import React, { useState, useEffect, useRef } from 'react';
import { Head, Link, useForm, router } from '@inertiajs/react';
import { Info, Clock, MessageCircle, Send, ZoomIn, ZoomOut, XCircle, Printer, CheckCircle, ChevronLeft, X, AlertTriangle, MessageSquare, User } from 'lucide-react';
import Navbar from '@/Components/Navbar';

export default function AdminLayananDetail({ suratRequest, htmlOutput }) {
    const [isRejectModalOpen, setIsRejectModalOpen] = useState(false);
    const chatContainerRef = useRef(null);
    const [commentText, setCommentText] = useState('');

    const { data: rejectData, setData: setRejectData, post: postReject, processing: rejectProcessing } = useForm({
        status: 'ditolak',
        alasan: ''
    });

    const [processLoading, setProcessLoading] = useState(false);

    const handleReject = () => {
        postReject(`/admin/layanan/status/${suratRequest.id}`, {
            onSuccess: () => {
                setIsRejectModalOpen(false);
                setRejectData('alasan', '');
            }
        });
    };

    const handleProcess = () => {
        setProcessLoading(true);
        router.post(`/admin/layanan/status/${suratRequest.id}`, { status: 'diproses' }, {
            onFinish: () => setProcessLoading(false)
        });
    };

    const handleSendComment = () => {
        if (!commentText.trim()) return;
        router.post(`/admin/layanan/comment/${suratRequest.id}`, { message: commentText }, {
            preserveScroll: true,
            onSuccess: () => setCommentText('')
        });
    };

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

    const handleDownload = () => {
        const element = document.createElement("a");
        const htmlContent = `
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>${suratRequest.template?.judul || 'Surat'}</title>
<style>
    body { font-family: 'Times New Roman', Times, serif; color: black; padding: 20px; max-width: 21cm; margin: 0 auto; line-height: 1.5; }
    table { border-collapse: collapse; }
    td, th { border: none !important; }
</style>
</head>
<body>
    ${kopSurat}
    ${htmlOutput}
</body>
</html>`;
        const file = new Blob([htmlContent], { type: 'text/html' });
        element.href = URL.createObjectURL(file);
        element.download = `${suratRequest.template?.judul || 'surat'}_${suratRequest.user?.name || 'pemohon'}.html`;
        document.body.appendChild(element); // Required for this to work in FireFox
        element.click();
        document.body.removeChild(element);
    };

    const getStatusStyle = (status) => {
        switch (status) {
            case 'pending': return { text: 'MENUNGGU VERIFIKASI', class: 'bg-amber-100 text-amber-700' };
            case 'diproses': return { text: 'SEDANG DIPROSES', class: 'bg-blue-100 text-blue-700' };
            case 'ditolak': return { text: 'DITOLAK', class: 'bg-red-100 text-red-700' };
            case 'selesai': return { text: 'SELESAI', class: 'bg-green-100 text-green-700' };
            default: return { text: status.toUpperCase(), class: 'bg-gray-100 text-gray-700' };
        }
    };

    const statusBadge = getStatusStyle(suratRequest.status);

    useEffect(() => {
        if (chatContainerRef.current) {
            chatContainerRef.current.scrollTop = chatContainerRef.current.scrollHeight;
        }
    }, [suratRequest.comments]);
    return (
        <div className="min-h-screen bg-[#f8f9f2] font-sans text-gray-800 flex flex-col relative">
            <Head title="Validasi Surat" />

            <Navbar variant='admin' />

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
                                    <p className="font-bold text-gray-800">REG-{suratRequest.id.toString().padStart(4, '0')}</p>
                                </div>
                                <div>
                                    <p className="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">NAMA PEMOHON</p>
                                    <p className="font-bold text-gray-800">{suratRequest.user?.name}</p>
                                </div>
                                <div>
                                    <p className="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">JENIS LAYANAN</p>
                                    <p className="font-bold text-gray-800">{suratRequest.template?.judul}</p>
                                </div>
                                <div>
                                    <p className="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">TANGGAL MASUK</p>
                                    <p className="font-bold text-gray-800">{new Date(suratRequest.created_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</p>
                                </div>

                                <hr className="border-gray-100" />

                                <div>
                                    <p className="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">DOKUMEN PENDUKUNG</p>
                                    <div className="flex gap-2">
                                        {suratRequest.user?.penduduk?.ktp_path ? (
                                            <a
                                                href={`/file/preview?path=${suratRequest.user.penduduk.ktp_path}`}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-lg text-xs font-bold transition"
                                            >
                                                <ZoomIn size={14} />
                                                Preview KTP
                                            </a>
                                        ) : (
                                            <span className="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 text-gray-500 border border-gray-200 rounded-lg text-xs font-bold opacity-50 cursor-not-allowed">
                                                <ZoomIn size={14} />
                                                KTP Kosong
                                            </span>
                                        )}

                                        {suratRequest.user?.penduduk?.kk_path ? (
                                            <a
                                                href={`/file/preview?path=${suratRequest.user.penduduk.kk_path}`}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-lg text-xs font-bold transition"
                                            >
                                                <ZoomIn size={14} />
                                                Preview KK
                                            </a>
                                        ) : (
                                            <span className="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 text-gray-500 border border-gray-200 rounded-lg text-xs font-bold opacity-50 cursor-not-allowed">
                                                <ZoomIn size={14} />
                                                KK Kosong
                                            </span>
                                        )}
                                    </div>
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

                            {/* Chat / Discussion Area */}
                            <div className="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50 flex flex-col gap-4">
                                {suratRequest.status === 'ditolak' && suratRequest.form_data?._alasan_tolak && (
                                    <div className="bg-red-50 border border-red-200 rounded-xl p-4 mb-2">
                                        <h4 className="font-bold text-red-800 text-sm mb-1">Alasan Penolakan:</h4>
                                        <p className="text-red-700 text-sm">{suratRequest.form_data._alasan_tolak}</p>
                                    </div>
                                )}

                                {suratRequest.status === 'selesai' && suratRequest.form_data?._file_balasan && (
                                    <div className="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center justify-between mb-2">
                                        <div>
                                            <h4 className="font-bold text-green-800 text-sm mb-1">Surat Selesai</h4>
                                            <p className="text-green-700 text-sm">Dokumen balasan final telah diunggah.</p>
                                        </div>
                                        <a
                                            href={`/file/preview?path=${suratRequest.form_data._file_balasan}`}
                                            target="_blank"
                                            className="bg-white text-green-700 px-4 py-2 rounded-lg text-sm font-bold shadow-sm border border-green-200 hover:bg-green-100 transition"
                                        >
                                            Lihat / Download
                                        </a>
                                    </div>
                                )}

                                {suratRequest.form_data?._comments?.length > 0 ? (
                                    suratRequest.form_data._comments.map((comment, idx) => (
                                        <div key={idx} className={`flex gap-3 ${comment.user_id === 1 || comment.is_admin ? 'flex-row-reverse' : 'flex-row'}`}>
                                            <div className="w-8 h-8 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                                {comment.avatar ? (
                                                    <img src={comment.avatar} alt="avatar" className="w-full h-full object-cover" />
                                                ) : (
                                                    <User size={16} className="text-gray-500" />
                                                )}
                                            </div>
                                            <div className={`max-w-[85%] ${comment.user_id === 1 || comment.is_admin ? 'items-end' : 'items-start'} flex flex-col`}>
                                                <div className="flex items-baseline gap-2 mb-1 px-1">
                                                    <span className="text-[11px] font-bold text-gray-700">{comment.user_name}</span>
                                                    <span className="text-[10px] text-gray-400">{new Date(comment.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</span>
                                                </div>
                                                <div className={`p-3 rounded-2xl text-sm ${comment.user_id === 1 || comment.is_admin ? 'bg-[#4a5f36] text-white rounded-tr-none' : 'bg-white border border-gray-200 text-gray-700 rounded-tl-none shadow-sm'}`}>
                                                    <p className="leading-relaxed">{comment.message}</p>
                                                </div>
                                            </div>
                                        </div>
                                    ))
                                ) : (
                                    <div className="flex-1 flex flex-col items-center justify-center text-gray-400 h-full">
                                        <MessageSquare size={32} className="mb-2 opacity-50" />
                                        <p className="text-sm">Belum ada catatan atau obrolan</p>
                                    </div>
                                )}
                            </div>

                            {/* Chat Input */}
                            <div className="p-4 bg-white border-t border-gray-100">
                                <div className="relative">
                                    <input
                                        type="text"
                                        placeholder="Ketik pesan..."
                                        value={commentText}
                                        onChange={(e) => setCommentText(e.target.value)}
                                        onKeyDown={(e) => { if (e.key === 'Enter') handleSendComment() }}
                                        className="w-full bg-white border border-gray-300 rounded-full pl-4 pr-10 py-2.5 text-xs text-gray-700 focus:ring-2 focus:ring-[#2b3a20] outline-none"
                                    />
                                    <button onClick={handleSendComment} className="absolute right-2 top-1/2 -translate-y-1/2 w-7 h-7 rounded-full flex items-center justify-center text-gray-500 hover:text-[#2b3a20] transition">
                                        <Send size={14} />
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    {/* Right Document Area */}
                    <div className="flex-1 flex flex-col lg:h-full min-h-[600px] lg:overflow-hidden">
                        {/* Document Viewer */}
                        <div className="bg-white rounded-t-2xl flex-grow overflow-y-auto p-4 md:p-8 flex justify-center border border-gray-200">
                            <div
                                className="bg-white w-full max-w-[21cm] min-h-[29.7cm] p-10 md:p-16 flex flex-col prose prose-sm sm:prose-base prose-td:border-none prose-th:border-none prose-tr:border-none text-gray-800"
                                dangerouslySetInnerHTML={{ __html: kopSurat + htmlOutput }}
                            />
                        </div>

                        {/* Action Bar */}
                        <div className="bg-white border border-gray-200 border-t-0 rounded-b-2xl p-4 md:p-6 flex flex-col md:flex-row items-center justify-between gap-4 shrink-0 shadow-sm">
                            {suratRequest.status === 'pending' && (
                                <button
                                    onClick={() => setIsRejectModalOpen(true)}
                                    className="w-full md:w-auto flex items-center justify-center gap-2 bg-[#be2e2e] hover:bg-[#9d2424] text-white px-6 py-3 rounded-xl text-sm font-bold transition shadow-sm"
                                >
                                    <XCircle size={18} />
                                    Tolak Permohonan
                                </button>
                            )}

                            <div className="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">
                                <button onClick={handleDownload} className="w-full md:w-auto flex items-center justify-center gap-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-6 py-3 rounded-xl text-sm font-bold transition shadow-sm">
                                    <Printer size={18} />
                                    Download / Cetak Surat
                                </button>
                                {suratRequest.status === 'pending' && (
                                    <button disabled={processLoading} onClick={handleProcess} className="w-full md:w-auto flex items-center justify-center gap-2 bg-[#2b3a20] hover:bg-[#1f2917] text-white px-6 py-3 rounded-xl text-sm font-bold transition shadow-sm">
                                        <CheckCircle size={18} />
                                        {processLoading ? 'Memproses...' : 'Lanjutkan Permohonan'}
                                    </button>
                                )}
                                {suratRequest.status === 'diproses' && (
                                    <Link href={`/admin/layanan/approval?id=${suratRequest.id}`} className="w-full md:w-auto flex items-center justify-center gap-2 bg-[#4a5f36] hover:bg-[#3f5231] text-white px-6 py-3 rounded-xl text-sm font-bold transition shadow-sm">
                                        <CheckCircle size={18} />
                                        Proses Balasan
                                    </Link>
                                )}
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
                                    value={rejectData.alasan}
                                    onChange={(e) => setRejectData('alasan', e.target.value)}
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
                                onClick={handleReject}
                                disabled={rejectProcessing}
                                className="px-6 py-2.5 bg-[#be2e2e] hover:bg-[#9d2424] text-white text-sm font-bold rounded-xl shadow-sm transition disabled:opacity-50"
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
