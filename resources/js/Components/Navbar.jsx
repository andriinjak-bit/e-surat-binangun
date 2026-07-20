import Logo from "./Logo";
import { Link } from '@inertiajs/react';
import { LogOut, User } from 'lucide-react';

export default function Navbar() {
    return (
        <nav className="bg-[#2b3a20] text-white px-4 md:px-8 py-4 flex flex-wrap items-center justify-between shadow-md">
            <div className="flex items-center gap-4 w-full md:w-auto justify-between md:justify-start">
                <div className="flex items-center gap-4">
                    {/* Logo Web */}
                    <img src="/logo.webp" alt="Logo Desa" className="h-10 hidden md:block" />

                    {/* Logo Mobile */}
                    <div className="md:hidden origin-left scale-90 mt-2" style={{ marginBottom: '-40px' }}>
                        <Logo />
                    </div>

                    <span className="bg-[#d2dcbc] text-[#2b3a20] text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap hidden md:inline-block">ADMIN PORTAL</span>
                </div>

                <button className="md:hidden flex items-center gap-2 border border-gray-400 hover:border-white px-3 py-1 rounded-full text-sm transition">
                    <LogOut size={16} />
                </button>
            </div>

            <div className="hidden md:flex items-center gap-8 text-sm text-gray-300">
                <Link href="#" className="hover:text-white transition">Template Surat</Link>
                <Link href="#" className="text-white font-semibold">Data Sipil</Link>
                <Link href="#" className="hover:text-white transition">Layanan Surat</Link>
            </div>

            <div className="hidden md:flex items-center gap-4">
                <div className="flex items-center gap-2">
                    <span className="text-sm">Admin Desa</span>
                    <div className="bg-[#d2dcbc] p-1.5 rounded-full text-[#2b3a20]">
                        <User size={18} />
                    </div>
                </div>
                <button className="flex items-center gap-2 border border-gray-400 hover:border-white px-4 py-1.5 rounded-full text-sm transition">
                    <LogOut size={16} />
                    <span>Keluar</span>
                </button>
            </div>
        </nav>
    )
}