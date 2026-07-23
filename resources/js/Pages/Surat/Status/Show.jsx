import React, { useState, useEffect, useRef } from 'react';
import { Head, Link, router, usePage } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import TiptapEditor from '@/Components/TiptapEditor';
import { Info, Clock, MessageCircle, Send, ZoomIn, ZoomOut, ChevronLeft, MessageSquare, User, FileText, Download } from 'lucide-react';

export default function Show({ suratRequest, htmlOutput }) {
    const { auth } = usePage().props;
    const chatContainerRef = useRef(null);
    const [commentText, setCommentText] = useState('');

    const handleSendComment = () => {
        if (!commentText.trim()) return;
        router.post(`/surat/status/comment/${suratRequest.id}`, { message: commentText }, {
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

    const getStatusStyle = (status) => {
        switch (status) {
            case 'pending': return { text: 'MENUNGGU VERIFIKASI', class: 'bg-yellow-100 text-yellow-700 border-yellow-200' };
            case 'diproses': return { text: 'SEDANG DIPROSES', class: 'bg-blue-100 text-blue-700 border-blue-200' };
            case 'ditolak': return { text: 'BUTUH REVISI', class: 'bg-red-100 text-red-700 border-red-200' };
            case 'selesai': return { text: 'SIAP DIAMBIL / SELESAI', class: 'bg-green-100 text-green-700 border-green-200' };
            default: return { text: status.toUpperCase(), class: 'bg-gray-100 text-gray-700 border-gray-200' };
        }
    };

    const statusBadge = getStatusStyle(suratRequest.status);

    useEffect(() => {
        if (chatContainerRef.current) {
            chatContainerRef.current.scrollTop = chatContainerRef.current.scrollHeight;
        }
    }, [suratRequest.form_data?._comments]);

    return (
        <div className="min-h-screen bg-[#fcf8f0] flex flex-col font-sans selection:bg-[#4a6b52] selection:text-white relative">
            <Head title="Detail Pengajuan Surat" />
            <Navbar variant="civil" />

            <main className="flex-grow max-w-7xl w-full mx-auto px-4 md:px-8 lg:px-20 py-10 md:py-12">
                {/* Header */}
                <div className="mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div>
                        <h1 className="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Detail Pengajuan Surat</h1>
                        <p className="text-gray-600 text-sm">Cek detail pengajuan surat Anda</p>
                    </div>
                    <div className="flex items-center gap-3 w-full md:w-auto">
                        <div className={`px-4 py-2 border rounded-full text-xs font-bold ${statusBadge.class}`}>
                            <span className="w-1.5 h-1.5 rounded-full inline-block mr-2 bg-current opacity-75"></span>
                            {statusBadge.text}
                        </div>
                        <Link 
                            href="/surat/status" 
                            className="bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 px-4 py-2 rounded-full flex items-center gap-2 font-medium text-sm transition shadow-sm ml-auto md:ml-0"
                        >
                            <ChevronLeft size={16} />
                            Kembali
                        </Link>
                    </div>
                </div>

                <div className="flex flex-col lg:flex-row gap-8 lg:min-h-[700px]">
                    {/* Left Document Area */}
                    <div className="flex-1 flex flex-col lg:overflow-hidden order-2 lg:order-1">
                        <div className="bg-[#f0f1eb] rounded-2xl flex-grow overflow-y-auto p-4 md:p-8 flex justify-center border border-[#d2dcbc]">
                            <div className="relative w-full max-w-[21cm]">
                                {/* Toolbar */}
                                <div className="absolute top-4 left-4 right-4 flex justify-between items-center z-10 pointer-events-none">
                                    <div className="bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg border border-gray-200 shadow-sm flex items-center gap-2 text-xs font-bold text-gray-700 pointer-events-auto">
                                        <Eye size={14} /> Pratinjau Surat Resmi
                                    </div>
                                    <div className="flex gap-2 pointer-events-auto">
                                        <button className="bg-white/90 backdrop-blur-sm p-1.5 rounded-lg border border-gray-200 shadow-sm text-gray-600 hover:text-gray-900 transition">
                                            <ZoomIn size={16} />
                                        </button>
                                        <button className="bg-white/90 backdrop-blur-sm p-1.5 rounded-lg border border-gray-200 shadow-sm text-gray-600 hover:text-gray-900 transition">
                                            <Printer size={16} />
                                        </button>
                                    </div>
                                </div>

                                <div className="mt-12 bg-white w-full max-w-[21cm] min-h-[29.7cm] shadow-md border border-gray-100 p-10 md:p-16 flex flex-col text-gray-800 mx-auto">
                                    <div dangerouslySetInnerHTML={{ __html: kopSurat }} className="prose prose-sm sm:prose-base prose-td:border-none prose-th:border-none prose-tr:border-none max-w-none text-gray-800" />
                                    <TiptapEditor 
                                        value={htmlOutput} 
                                        readOnly={true} 
                                        variant="document"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Right Sidebar - Chat & Info */}
                    <div className="w-full lg:w-[350px] flex flex-col gap-6 shrink-0 lg:h-full lg:overflow-y-auto hide-scrollbar order-1 lg:order-2">

                        {/* Riwayat & Diskusi Card */}
                        <div className="bg-[#fcf8f0] rounded-2xl flex flex-col flex-grow min-h-[400px]">
                            <div className="pb-4 border-b border-[#e4e6de] flex items-center justify-between">
                                <div className="flex items-center gap-2 text-gray-800 font-bold text-lg">
                                    <MessageSquare size={20} />
                                    <h2>Riwayat & Diskusi</h2>
                                </div>
                            </div>

                            {/* Chat / Discussion Area */}
                            <div className="flex-1 overflow-y-auto py-4 flex flex-col gap-4" ref={chatContainerRef}>
                                {/* Reject Reason Message (if any) */}
                                {suratRequest.status === 'ditolak' && suratRequest.form_data?._alasan_tolak && (
                                    <div className="flex gap-3 flex-row">
                                        <div className="w-8 h-8 rounded-full bg-red-100 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                            <User size={16} className="text-red-600" />
                                        </div>
                                        <div className="max-w-[85%] items-start flex flex-col">
                                            <div className="flex items-baseline gap-2 mb-1 px-1">
                                                <span className="text-[11px] font-bold text-gray-700">Sistem (Admin)</span>
                                            </div>
                                            <div className="p-3 rounded-2xl text-sm bg-red-50 border border-red-200 text-red-800 rounded-tl-none shadow-sm">
                                                <p className="font-bold mb-1">Permohonan Butuh Revisi</p>
                                                <p className="leading-relaxed">{suratRequest.form_data._alasan_tolak}</p>
                                            </div>
                                        </div>
                                    </div>
                                )}

                                {/* Completion / Download Message (if any) */}
                                {suratRequest.status === 'selesai' && suratRequest.form_data?._file_balasan && (
                                    <div className="flex gap-3 flex-row">
                                        <div className="w-8 h-8 rounded-full bg-[#d2dcbc] flex-shrink-0 flex items-center justify-center overflow-hidden">
                                            <User size={16} className="text-[#2b3a20]" />
                                        </div>
                                        <div className="max-w-[85%] items-start flex flex-col">
                                            <div className="flex items-baseline gap-2 mb-1 px-1">
                                                <span className="text-[11px] font-bold text-gray-700">Sistem (Admin)</span>
                                            </div>
                                            <div className="p-4 rounded-2xl text-sm bg-white border border-[#d2dcbc] text-gray-800 rounded-tl-none shadow-sm">
                                                <p className="font-bold mb-2">Permohonan Selesai</p>
                                                <p className="mb-3 text-gray-600 leading-relaxed">Dokumen balasan final telah diterbitkan dan dapat Anda unduh sekarang.</p>
                                                <a
                                                    href={`/file/preview?path=${suratRequest.form_data._file_balasan}`}
                                                    target="_blank"
                                                    className="w-full flex items-center justify-center gap-2 bg-[#2b3a20] hover:bg-[#1a2413] text-white px-4 py-2.5 rounded-lg text-xs font-bold transition shadow-sm"
                                                >
                                                    <Download size={14} />
                                                    Unduh Surat Balasan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                )}

                                {/* Chat Messages */}
                                {suratRequest.form_data?._comments?.length > 0 ? (
                                    suratRequest.form_data._comments.map((comment, idx) => {
                                        const isMyMessage = comment.user_id === auth.user.id && !comment.is_admin;
                                        
                                        return (
                                            <div key={idx} className={`flex gap-3 ${isMyMessage ? 'flex-row-reverse' : 'flex-row'}`}>
                                                <div className="w-8 h-8 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                                    {comment.avatar ? (
                                                        <img src={comment.avatar} alt="avatar" className="w-full h-full object-cover" />
                                                    ) : (
                                                        <User size={16} className="text-gray-500" />
                                                    )}
                                                </div>
                                                <div className={`max-w-[85%] ${isMyMessage ? 'items-end' : 'items-start'} flex flex-col`}>
                                                    <div className="flex items-baseline gap-2 mb-1 px-1">
                                                        <span className="text-[11px] font-bold text-gray-700">{comment.user_name}</span>
                                                        <span className="text-[10px] text-gray-400">{new Date(comment.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</span>
                                                    </div>
                                                    <div className={`p-3 rounded-2xl text-sm shadow-sm ${isMyMessage ? 'bg-[#d2dcbc] text-[#2b3a20] rounded-tr-none border border-[#c4d1a9]' : 'bg-white border border-[#e4e6de] text-gray-700 rounded-tl-none'}`}>
                                                        <p className="leading-relaxed">{comment.message}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        );
                                    })
                                ) : (
                                    // Empty state only if no comments AND not rejected AND not complete
                                    !(suratRequest.status === 'ditolak' && suratRequest.form_data?._alasan_tolak) && 
                                    !(suratRequest.status === 'selesai' && suratRequest.form_data?._file_balasan) && (
                                        <div className="flex-1 flex flex-col items-center justify-center text-gray-400 h-full">
                                            <MessageSquare size={32} className="mb-2 opacity-30" />
                                            <p className="text-sm">Belum ada obrolan</p>
                                        </div>
                                    )
                                )}
                            </div>

                            {/* Chat Input */}
                            <div className="pt-4 mt-auto">
                                <div className="relative">
                                    <input
                                        type="text"
                                        placeholder={suratRequest.status !== 'selesai' ? "Tulis pesan atau pertanyaan Anda di sini..." : "Percakapan ditutup untuk permohonan yang sudah selesai"}
                                        value={commentText}
                                        onChange={(e) => setCommentText(e.target.value)}
                                        onKeyDown={(e) => { if (e.key === 'Enter') handleSendComment() }}
                                        disabled={suratRequest.status === 'selesai'}
                                        className="w-full bg-white border border-[#d2dcbc] rounded-xl pl-4 pr-12 py-3.5 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-[#2b3a20] outline-none shadow-sm disabled:bg-gray-100 disabled:cursor-not-allowed"
                                    />
                                    <button 
                                        onClick={handleSendComment} 
                                        disabled={suratRequest.status === 'selesai' || !commentText.trim()}
                                        className="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-[#2b3a20] rounded-lg flex items-center justify-center text-white hover:bg-[#1a2413] transition shadow-sm disabled:opacity-50 disabled:cursor-not-allowed"
                                    >
                                        <Send size={14} />
                                    </button>
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

// Add an Eye icon mock since it's used but might not be imported if I forgot
const Eye = ({ size = 24, className }) => (
    <svg xmlns="http://www.w3.org/2000/svg" width={size} height={size} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className={className}>
        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
        <circle cx="12" cy="12" r="3"></circle>
    </svg>
);
const Printer = ({ size = 24, className }) => (
    <svg xmlns="http://www.w3.org/2000/svg" width={size} height={size} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className={className}>
        <polyline points="6 9 6 2 18 2 18 9"></polyline>
        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
        <rect x="6" y="14" width="12" height="8"></rect>
    </svg>
);
