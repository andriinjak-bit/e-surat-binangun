import React from 'react';
import { Head, Link } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import SuratCard from '@/Components/SuratCard';
import { MoreHorizontal } from 'lucide-react';

export default function Layanan({ suratTemplates = [] }) {
    return (
        <div className="min-h-screen bg-[#fcf8f0] font-sans selection:bg-[#b3692e] selection:text-white">
            <Head title="Layanan Surat" />

            <Navbar variant="civil" />

            <main className="max-w-7xl mx-auto px-4 md:px-8 py-12 md:py-20">
                <div className="mb-12">
                    <h1 className="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Layanan Administrasi Surat</h1>
                    <p className="text-gray-600 text-sm md:text-base max-w-3xl">
                        Pilih jenis surat yang Anda butuhkan. Kami menyediakan berbagai layanan surat pengantar dan keterangan secara daring untuk memudahkan keperluan administrasi Anda.
                    </p>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {suratTemplates.map((template) => (
                        <SuratCard key={template.id} template={template} />
                    ))}

                    {/* Lainnya */}
                    <div className="bg-[#4a5a2a] rounded-2xl p-6 flex flex-col justify-between shadow-sm border border-[#5a6a3a] relative overflow-hidden">
                        <div className="relative z-10">
                            <div className="bg-[#3a4a1a] w-10 h-10 rounded-lg flex items-center justify-center text-white mb-4">
                                <MoreHorizontal size={20} />
                            </div>
                            <h3 className="text-lg font-bold text-white mb-2">Layanan Surat Lainnya</h3>
                            <p className="text-gray-300 text-xs mb-4 leading-relaxed line-clamp-4">
                                Tidak menemukan jenis surat yang dicari? Silakan hubungi admin kami untuk informasi dan pengajuan surat / layanan administrasi lainnya.
                            </p>
                        </div>
                        <Link href="#" className="w-full block text-center bg-white text-[#2b3a20] font-bold py-2.5 rounded-lg hover:bg-gray-100 transition text-sm relative z-10 mt-6">
                            Hubungi Kami
                        </Link>
                        {/* Decorative Icon */}
                        <i className="fas fa-envelope-open-text absolute -bottom-10 -right-4 text-9xl text-white/5 z-0"></i>
                    </div>
                </div>
            </main>

            <Footer />
        </div>
    );
}
