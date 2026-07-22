import { Head, Link } from '@inertiajs/react';
import Footer from '@/Components/Footer';
import { FileText } from 'lucide-react'; // Some placeholder icons for services
import Navbar from '@/Components/Navbar';

export default function Welcome() {
    return (
        <div className="min-h-screen bg-[#fcf8f0] font-sans selection:bg-[#b3692e] selection:text-white">
            <Head title="Sistem Administrasi Desa Digital" />

            <Navbar variant='civil' />

            {/* Hero Section */}
            <section id="hero" className="relative bg-[#3F4E1F] text-white overflow-hidden pt-16 pb-24 md:pt-24 md:pb-32 px-4 md:px-8">
                <div className="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12 relative z-10">
                    <div className="flex-1 space-y-6">
                        {/* <div className="inline-flex items-center gap-2 bg-white/10 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide uppercase border border-white/20">
                            <span className="w-2 h-2 rounded-full bg-[#fcf8f0]"></span>
                            Sistem Administrasi Digital Desa
                        </div> */}

                        <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                            Urus Surat Desa <br />
                            <span className="text-[#b3692e]">Tanpa Antre</span>, <br />
                            Cukup dari Rumah
                        </h1>

                        <p className="text-gray-300 text-sm md:text-base max-w-xl leading-relaxed">
                            Ajukan surat keterangan, pantau status prosesnya secara langsung, dan ambil hasilnya tanpa perlu bolak-balik ke kantor desa. Cukup 3 langkah mudah, surat siap diambil.
                        </p>

                        <div className="flex flex-wrap items-center gap-4 pt-4">
                            <Link href="/register" className="bg-[#b3692e] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#995927] transition">
                                Ajukan Surat Sekarang
                            </Link>
                            <Link href="/register" className="bg-transparent border-2 border-white/40 text-white px-6 py-3 rounded-xl font-bold hover:bg-white/10 transition">
                                Daftar Sekarang
                            </Link>
                        </div>

                        <div className="flex items-center gap-10 pt-8 mt-8 border-t border-white/20">
                            <div>
                                <div className="text-2xl font-bold">5+</div>
                                <div className="text-xs text-gray-300">Jenis surat tersedia</div>
                            </div>
                            <div>
                                <div className="text-2xl font-bold">1-2 Hari</div>
                                <div className="text-xs text-gray-300">Estimasi proses</div>
                            </div>
                            <div>
                                <div className="text-2xl font-bold">24/7</div>
                                <div className="text-xs text-gray-300">Pengajuan daring</div>
                            </div>
                        </div>
                    </div>

                    <div className="flex-1 w-full flex justify-center md:justify-end">
                        {/* Placeholder for Hero Image */}
                        <div className="w-full max-w-[540px] h-[640px] rounded-t-[100px] rounded-b-[40px] overflow-hidden relative">
                            {/* <div className="absolute inset-0 flex items-center justify-center text-[#4a6b52] flex-col">
                                <i className="fas fa-image text-5xl mb-4"></i>
                                <span>[Placeholder Foto Desa]</span>

                            </div> */}
                            <img src='/foto-balai.webp' alt='foto balai' className="w-full h-full object-cover" />
                        </div>
                    </div>
                </div>

                {/* Decorative Wave */}
                <div className="absolute bottom-0 left-0 right-0 h-32 bg-[#4a6b52] rounded-t-[100%] transform translate-y-16 scale-150 z-0 blur-3xl opacity-50"></div>
                <div className="absolute bottom-0 left-0 right-0 h-24 bg-[#fcf8f0] rounded-t-[50%] transform translate-y-12 scale-125 z-0"></div>
            </section>

            {/* Services Section */}
            <section id="layanan" className="py-20 px-4 md:px-8 max-w-7xl mx-auto">
                <div className="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                    <div className="max-w-2xl">
                        <h2 className="text-3xl font-bold text-gray-900 mb-4">Layanan Administrasi Populer</h2>
                        <p className="text-gray-600 text-sm leading-relaxed">
                            Akses cepat ke dokumen kependudukan yang paling sering dibutuhkan warga. Kami memproses setiap permintaan dengan transparansi penuh dan kecepatan maksimal.
                        </p>
                    </div>
                    <Link href="#" className="text-gray-800 font-semibold text-sm hover:text-[#b3692e] flex items-center gap-1 transition">
                        Lihat Semua Layanan <i className="fas fa-chevron-right text-xs"></i>
                    </Link>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {/* Card 1 */}
                    <div className="bg-[#f0ece1] rounded-3xl p-8 relative overflow-hidden flex flex-col justify-between h-[320px]">
                        <div className="relative z-10">
                            <div className="bg-[#d2dcbc] w-12 h-12 rounded-xl flex items-center justify-center text-[#2b3a20] mb-6 shadow-sm">
                                <FileText size={20} />
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-3">SKU (Surat Keterangan Usaha)</h3>
                            <p className="text-gray-600 text-sm mb-6 leading-relaxed">
                                Dokumen resmi bagi warga yang memiliki usaha untuk keperluan perbankan, izin lokasi, maupun pengembangan kemitraan bisnis di tingkat wilayah.
                            </p>
                        </div>
                        <Link href="/register" className="bg-[#b3692e] text-white font-bold py-3 px-6 rounded-xl w-max hover:bg-[#995927] transition shadow-md relative z-10 text-sm">
                            Mulai Pengajuan Sekarang
                        </Link>
                        {/* Decorative Icon */}
                        <i className="fas fa-file-invoice-dollar absolute -bottom-10 -right-10 text-9xl text-white/40"></i>
                    </div>

                    {/* Card 2 */}
                    <div className="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm relative overflow-hidden flex flex-col justify-between h-[320px]">
                        <div>
                            <div className="bg-gray-100 w-12 h-12 rounded-xl flex items-center justify-center text-gray-600 mb-6">
                                <i className="fas fa-hand-holding-heart text-xl"></i>
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-3">SKTM</h3>
                            <p className="text-gray-600 text-sm leading-relaxed">
                                Surat Keterangan Tidak Mampu untuk akses bantuan sosial, beasiswa, dan keringanan biaya pendidikan.
                            </p>
                        </div>
                        <Link href="/register" className="text-gray-900 font-bold text-sm hover:text-[#b3692e] flex items-center gap-1">
                            Ajukan SKTM ↗
                        </Link>
                    </div>

                    {/* Card 3 */}
                    <div className="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm relative overflow-hidden flex flex-col justify-between h-[320px]">
                        <div>
                            <div className="bg-gray-100 w-12 h-12 rounded-xl flex items-center justify-center text-gray-600 mb-6">
                                <i className="fas fa-shield-alt text-xl"></i>
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-3">SKCK</h3>
                            <p className="text-gray-600 text-sm leading-relaxed">
                                Dokumen pengantar wajib dari desa bagi warga yang akan melangsungkan pernikahan di KUA setempat.
                            </p>
                        </div>
                        <Link href="/register" className="text-gray-900 font-bold text-sm hover:text-[#b3692e] flex items-center gap-1">
                            Ajukan Domisili ↗
                        </Link>
                    </div>
                </div>
            </section>

            {/* CTA Banner */}
            <section className="px-4 md:px-8 max-w-7xl mx-auto pb-20">
                <div className="bg-[#314a38] rounded-3xl p-10 md:p-16 flex flex-col items-center text-center relative overflow-hidden shadow-xl">
                    <h2 className="text-3xl md:text-4xl font-bold text-white mb-6 relative z-10">Sudah Punya Akun?</h2>
                    <p className="text-gray-300 text-sm md:text-base max-w-2xl mb-10 relative z-10 leading-relaxed">
                        Masuk untuk melihat riwayat surat yang pernah diajukan, unduh salinan digital dokumen Anda, dan perbarui data profil secara mandiri.
                    </p>
                    <Link href="/login" className="bg-white text-[#314a38] font-bold py-3 px-8 rounded-xl hover:bg-gray-100 transition shadow-lg relative z-10">
                        Masuk Sekarang
                    </Link>

                    {/* Background decorations */}
                    <div className="absolute top-0 right-0 w-64 h-64 bg-[#4a6b52] rounded-full filter blur-3xl opacity-30 transform translate-x-1/2 -translate-y-1/2"></div>
                    <div className="absolute bottom-0 left-0 w-64 h-64 bg-[#b3692e] rounded-full filter blur-3xl opacity-20 transform -translate-x-1/2 translate-y-1/2"></div>
                </div>
            </section>

            {/* Why Digital Section */}
            <section className="py-20 px-4 md:px-8 max-w-7xl mx-auto border-t border-gray-200">
                <div className="flex flex-col-reverse md:flex-row items-center gap-16">
                    <div className="flex-1 w-full">
                        {/* Placeholder for Laptop Image */}
                        <div className="w-full h-[400px] rounded-[40px] flex items-center justify-center relative overflow-hidden">
                            <img src="/digitalized.webp" alt='digitalized picture' />
                            <Link href="/register" className="absolute md:bottom-8 bottom-14 left-1/2 transform -translate-x-1/2 bg-[#b3692e] text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:bg-[#995927] transition z-10">
                                Daftar Sekarang
                            </Link>
                        </div>
                    </div>

                    <div className="flex-1">
                        <h2 className="text-3xl md:text-4xl font-bold text-[#b3692e] mb-10">Mengapa Menggunakan <br />Layanan Digital?</h2>

                        <div className="space-y-8">
                            <div className="flex gap-5">
                                <div className="bg-[#b3692e] text-white w-10 h-10 rounded-full flex items-center justify-center font-bold shrink-0 shadow-md">1</div>
                                <div>
                                    <h3 className="text-xl font-bold text-gray-900 mb-2">Data Tersimpan Aman</h3>
                                    <p className="text-gray-600 text-sm leading-relaxed">
                                        Data Anda tersimpan di sistem terenkripsi standar pemerintahan. Tidak perlu mengulang profil setiap kali mengajukan surat baru.
                                    </p>
                                </div>
                            </div>

                            <div className="flex gap-5">
                                <div className="bg-[#b3692e] text-white w-10 h-10 rounded-full flex items-center justify-center font-bold shrink-0 shadow-md">2</div>
                                <div>
                                    <h3 className="text-xl font-bold text-gray-900 mb-2">Pantau Status Real-time</h3>
                                    <p className="text-gray-600 text-sm leading-relaxed">
                                        Dapatkan notifikasi langsung lewat WhatsApp saat surat Anda mulai diproses, disahkan, dan HANYA siap diambil di kantor desa.
                                    </p>
                                </div>
                            </div>

                            <div className="flex gap-5">
                                <div className="bg-[#b3692e] text-white w-10 h-10 rounded-full flex items-center justify-center font-bold shrink-0 shadow-md">3</div>
                                <div>
                                    <h3 className="text-xl font-bold text-gray-900 mb-2">Layanan Tanpa Calo</h3>
                                    <p className="text-gray-600 text-sm leading-relaxed">
                                        Semua proses dilakukan langsung oleh perangkat desa secara transparan tanpa pungutan liar di luar ketentuan resmi pemerintah.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div id="contact">
                <Footer />

            </div>
        </div>
    );
}
