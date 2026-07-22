import { Head, Link, usePage } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import { FileText, HandCoins, ShieldAlert, FileMinus, FileSignature, MoreHorizontal, Mail, MapPin } from 'lucide-react';

export default function Dashboard({ surats }) {
    const { auth } = usePage().props;

    return (
        <div className="min-h-screen bg-[#fcf8f0] font-sans selection:bg-[#b3692e] selection:text-white">
            <Head title="Dashboard Warga" />

            <Navbar variant="civil" />

            {/* Hero Section */}
            <section className="relative px-4 md:px-8 max-w-7xl mx-auto pt-12 pb-32 md:pt-20 md:pb-40 flex flex-col md:flex-row items-center gap-12">
                <div className="flex-1 space-y-6 relative z-10">
                    <div className="inline-flex items-center gap-2 bg-[#f0ece1] px-4 py-1.5 rounded-full text-xs font-semibold text-[#b3692e] tracking-wide uppercase">
                        Portal Sipil Desa Binangun
                    </div>

                    <h1 className="text-4xl md:text-5xl lg:text-5xl font-bold leading-tight text-gray-900">
                        Layanan Administrasi Surat<br />Desa Digital
                    </h1>

                    <p className="text-gray-600 text-sm md:text-base max-w-xl leading-relaxed">
                        Mewujudkan pelayanan desa yang cepat, transparan, dan akuntabel. Langsung pantau progress Anda tanpa perlu bolak-balik ke kantor balai desa.
                    </p>
                </div>

                <div className="flex-1 w-full flex justify-center md:justify-end relative z-10">
                    <div className="w-full max-w-[400px] aspect-square bg-gradient-to-b from-[#FFDEA3] to-[#BC6C25] rounded-full overflow-hidden shadow-2xl relative">
                        <img src="/letters.webp" alt="Dokumen Ilustrasi" className="w-full h-full object-cover" />
                        {/* <div className="absolute inset-0 flex items-center justify-center text-[#b3692e] flex-col opacity-50">
                            <i className="fas fa-file-alt text-6xl mb-4"></i>
                            <span className="font-semibold">[Placeholder Dokumen]</span>
                        </div> */}
                    </div>
                </div>
            </section>

            {/* Catalog Section */}
            <section className="relative bg-[#3f4e1f] py-24 px-4 md:px-8 mt-[-100px]">
                {/* Decorative Wave */}
                <div className="absolute top-0 left-0 right-0 h-24 bg-[#fcf8f0] rounded-b-[50%] transform -translate-y-1/2 z-0"></div>

                <div className="max-w-7xl mx-auto relative z-10">
                    <div className="mb-12">
                        <h2 className="text-3xl font-bold text-white mb-2">Katalog Layanan Surat</h2>
                        <p className="text-gray-300 text-sm">Pilih jenis surat yang Anda butuhkan sesuai kebutuhan.</p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {/* SKU */}
                        <div className="bg-white rounded-2xl p-6 flex flex-col justify-between shadow-sm">
                            <div>
                                <div className="bg-[#e8efdd] w-10 h-10 rounded-lg flex items-center justify-center text-[#3f4e1f] mb-4">
                                    <FileText size={20} />
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">Surat Keterangan Usaha (SKU)</h3>
                                <p className="text-gray-600 text-xs mb-4 leading-relaxed line-clamp-3">
                                    Bagi warga yang memiliki usaha dan membutuhkan surat pengantar ini sebagai syarat keperluan bank/izin usaha.
                                </p>
                                <ul className="text-xs text-gray-600 space-y-2 mb-6">
                                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KTP</li>
                                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KK</li>
                                </ul>
                            </div>
                            <Link href="#" className="w-full block text-center bg-[#2b3a20] text-white font-semibold py-2.5 rounded-lg hover:bg-[#1a2413] transition text-sm">
                                Ajukan Sekarang
                            </Link>
                        </div>

                        {/* SKTM */}
                        <div className="bg-white rounded-2xl p-6 flex flex-col justify-between shadow-sm">
                            <div>
                                <div className="bg-[#faeddc] w-10 h-10 rounded-lg flex items-center justify-center text-[#b3692e] mb-4">
                                    <HandCoins size={20} />
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">Surat Keterangan Tidak Mampu (SKTM)</h3>
                                <p className="text-gray-600 text-xs mb-4 leading-relaxed line-clamp-3">
                                    Dokumen ini untuk permohonan keringanan biaya pendidikan, kesehatan dan akses bantuan sosial pemerintah.
                                </p>
                                <ul className="text-xs text-gray-600 space-y-2 mb-6">
                                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KTP</li>
                                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KK</li>
                                </ul>
                            </div>
                            <Link href="#" className="w-full block text-center bg-[#2b3a20] text-white font-semibold py-2.5 rounded-lg hover:bg-[#1a2413] transition text-sm">
                                Ajukan Sekarang
                            </Link>
                        </div>

                        {/* SKCK */}
                        <div className="bg-white rounded-2xl p-6 flex flex-col justify-between shadow-sm">
                            <div>
                                <div className="bg-gray-100 w-10 h-10 rounded-lg flex items-center justify-center text-gray-700 mb-4">
                                    <ShieldAlert size={20} />
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">Surat Keterangan Catatan Kepolisian (SKCK)</h3>
                                <p className="text-gray-600 text-xs mb-4 leading-relaxed line-clamp-3">
                                    Pengantar untuk membuat surat SKCK di kepolisian untuk melamar kerja/melanjutkan pendidikan.
                                </p>
                                <ul className="text-xs text-gray-600 space-y-2 mb-6">
                                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KTP</li>
                                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KK</li>
                                </ul>
                            </div>
                            <Link href="#" className="w-full block text-center bg-[#2b3a20] text-white font-semibold py-2.5 rounded-lg hover:bg-[#1a2413] transition text-sm">
                                Ajukan Sekarang
                            </Link>
                        </div>

                        {/* Kematian */}
                        <div className="bg-white rounded-2xl p-6 flex flex-col justify-between shadow-sm">
                            <div>
                                <div className="bg-gray-100 w-10 h-10 rounded-lg flex items-center justify-center text-gray-700 mb-4">
                                    <FileMinus size={20} />
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">Surat Keterangan Kematian (Catatan Sipil)</h3>
                                <p className="text-gray-600 text-xs mb-4 leading-relaxed line-clamp-3">
                                    Surat Pengantar yang dibutuhkan untuk mengurus administrasi kematian untuk diteruskan ke Disdukcapil.
                                </p>
                                <ul className="text-xs text-gray-600 space-y-2 mb-6">
                                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KTP</li>
                                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KK</li>
                                </ul>
                            </div>
                            <Link href="#" className="w-full block text-center bg-[#2b3a20] text-white font-semibold py-2.5 rounded-lg hover:bg-[#1a2413] transition text-sm">
                                Ajukan Sekarang
                            </Link>
                        </div>

                        {/* Kehilangan */}
                        <div className="bg-white rounded-2xl p-6 flex flex-col justify-between shadow-sm">
                            <div>
                                <div className="bg-gray-100 w-10 h-10 rounded-lg flex items-center justify-center text-gray-700 mb-4">
                                    <FileSignature size={20} />
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">Surat Pengantar Kehilangan</h3>
                                <p className="text-gray-600 text-xs mb-4 leading-relaxed line-clamp-3">
                                    Surat Pengantar dari desa yang dibutuhkan untuk pelaporan kehilangan barang berharga di kantor polisi.
                                </p>
                                <ul className="text-xs text-gray-600 space-y-2 mb-6">
                                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KTP</li>
                                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KK</li>
                                </ul>
                            </div>
                            <Link href="#" className="w-full block text-center bg-[#2b3a20] text-white font-semibold py-2.5 rounded-lg hover:bg-[#1a2413] transition text-sm">
                                Ajukan Sekarang
                            </Link>
                        </div>

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
                </div>
            </section>

            {/* 3 Langkah Mudah */}
            <section className="py-24 px-4 md:px-8 max-w-5xl mx-auto text-center relative z-10">
                <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                    3 Langkah Mudah <span className="text-[#b3692e]">Pengajuan</span>
                </h2>
                <p className="text-gray-600 text-sm md:text-base max-w-2xl mx-auto mb-16">
                    Tanpa perlu bolak-balik antre, pengurusan menjadi lebih praktis, cepat, dan transparan.
                </p>

                <div className="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                    {/* Connecting line (Desktop) */}
                    <div className="hidden md:block absolute top-6 left-[16%] right-[16%] h-[2px] border-t-2 border-dashed border-[#b3692e]/40 z-0"></div>

                    {/* Step 1 */}
                    <div className="flex flex-col items-center relative z-10">
                        <div className="w-12 h-12 bg-[#f0d8c0] text-[#b3692e] rounded-full flex items-center justify-center text-xl font-bold mb-6 shadow-sm">
                            1
                        </div>
                        <h3 className="text-lg font-bold text-gray-900 mb-2">Isi Formulir</h3>
                        <p className="text-gray-600 text-xs px-4">
                            Pilih jenis surat dan lengkapi data serta unggah dokumen persyaratan secara digital.
                        </p>
                    </div>

                    {/* Step 2 */}
                    <div className="flex flex-col items-center relative z-10">
                        <div className="w-12 h-12 bg-[#f0d8c0] text-[#b3692e] rounded-full flex items-center justify-center text-xl font-bold mb-6 shadow-sm">
                            2
                        </div>
                        <h3 className="text-lg font-bold text-gray-900 mb-2">Verifikasi Desa</h3>
                        <p className="text-gray-600 text-xs px-4">
                            Perangkat desa memverifikasi dan menyetujui draf dokumen pada waktu kerja.
                        </p>
                    </div>

                    {/* Step 3 */}
                    <div className="flex flex-col items-center relative z-10">
                        <div className="w-12 h-12 bg-[#f0d8c0] text-[#b3692e] rounded-full flex items-center justify-center text-xl font-bold mb-6 shadow-sm">
                            3
                        </div>
                        <h3 className="text-lg font-bold text-gray-900 mb-2">Selesai</h3>
                        <p className="text-gray-600 text-xs px-4">
                            Pantau status dan ambil surat Anda di balai desa, atau unduh salinan digitalnya.
                        </p>
                    </div>
                </div>
            </section>

            {/* Bantuan CTA */}
            <section className="px-4 md:px-8 max-w-5xl mx-auto pb-24">
                <div className="bg-[#26351d] rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center gap-8 shadow-xl">
                    <div className="flex-1 text-white space-y-6">
                        <h2 className="text-3xl md:text-4xl font-bold">Butuh Bantuan<br />Cepat?</h2>
                        <p className="text-gray-300 text-sm max-w-sm leading-relaxed">
                            Tim administrasi siap membantu Anda setiap hari kerja melalui saluran resmi kami di bawah atau kirimkan email ke alamat yang tersedia.
                        </p>
                        {/* <div className="flex flex-wrap gap-4 pt-2">
                            <Link href="#" className="bg-[#fcf8f0] text-[#2b3a20] font-bold py-2.5 px-6 rounded-lg hover:bg-white transition text-sm flex items-center gap-2">
                                <i className="fab fa-whatsapp"></i> Chat WhatsApp Desa
                            </Link>
                            <Link href="#" className="bg-[#b3692e] text-white font-bold py-2.5 px-6 rounded-lg hover:bg-[#995927] transition text-sm flex items-center gap-2">
                                <i className="fas fa-phone-alt"></i> Call Center Desa
                            </Link>
                        </div> */}
                    </div>

                    <div className="w-full md:w-[320px] bg-[#3a4e2d] rounded-2xl p-6 border border-[#4a6b3d]/50 shadow-inner">
                        <div className="flex items-center gap-4 mb-4">
                            <div className="md:w-10 md:h-10 w-16 h-6 bg-white md:rounded-full rounded-xl flex items-center justify-center shadow">
                                <img src="/gmail.webp" alt="Email" className="md:w-6 md:h-6 w-6 h-4 object-contain" />
                            </div>
                            <div className="text-white font-medium text-sm">pemdes.binangun@gmail.com</div>
                        </div>
                        <p className="text-gray-300 text-xs leading-relaxed italic">
                            "Layanan pengaduan dan layanan surat online buka 24 jam."
                        </p>
                    </div>
                </div>
            </section>

            <Footer />
        </div>
    );
}
