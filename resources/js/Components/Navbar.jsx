import Logo from "./Logo";
import { Link, usePage } from '@inertiajs/react';
import { LogOut, User, Menu, X } from 'lucide-react';
import { useState } from 'react';

export default function Navbar({ variant = "civil" }) {
    const { auth } = usePage().props;
    const user = auth?.user;
    const [isOpen, setIsOpen] = useState(false);

    return (
        <nav className={`${variant === "admin" ? "bg-[#2b3a20] text-white" : "bg-[#fcf8f0] text-gray-700"} px-4 md:px-8 lg:px-20 py-4 flex items-center justify-between border-b border-gray-200 shadow-sm sticky top-0 z-50 w-full`}>
            <div className="flex items-center gap-4 w-auto justify-start">
                <div className="flex items-center gap-4">
                    <img src="/logo.webp" alt="Logo Desa" className="h-10 md:hidden" />

                    <div className="hidden md:flex origin-left">
                        <Logo />
                    </div>
                </div>
            </div>

            {user && (
                <div className="hidden md:flex items-center gap-8 text-sm font-medium">
                    {variant === "civil" ? (
                        <>
                            <Link href="/dashboard" className="text-[#4a6b52] border-b-2 border-[#4a6b52] pb-1">Beranda</Link>
                            <Link href="/layanan" className="hover:text-[#4a6b52] transition">Layanan</Link>
                            <Link href="" className="hover:text-[#4a6b52] transition">Cek Status</Link>
                        </>
                    ) : (
                        <>
                            <Link href="/admin/dashboard" className="hover:text-white transition">Dashboard</Link>
                            <Link href="/admin/template" className="hover:text-white transition">Template Surat</Link>
                            <Link href="/admin/layanan" className="hover:text-white transition">Layanan Surat</Link>
                            <Link href="/admin/penduduk" className="hover:text-white transition">Data Sipil</Link>
                            <Link href="/admin/log-activity" className="hover:text-white transition">Log Activity</Link>
                        </>
                    )}
                </div>
            )}

            <div className="items-center gap-4 hidden md:flex">
                {user ? (
                    <>
                        <div className="flex items-center gap-2">
                            <span className="text-sm">
                                {variant === "civil" ? (user.penduduk?.nama || "User") : "Admin Desa"}
                            </span>
                            <div className="bg-[#d2dcbc] p-1.5 rounded-full text-[#2b3a20]">
                                <User size={18} />
                            </div>
                        </div>
                        <Link
                            href="/logout"
                            method="post"
                            as="button"
                            className="flex items-center gap-2 border border-gray-400 hover:border-gray-600 px-4 py-1.5 rounded-full text-sm transition"
                        >
                            <LogOut size={16} />
                            <span>Keluar</span>
                        </Link>
                    </>
                ) : (
                    <>
                        <Link href="/login" className="text-sm font-medium hover:text-[#b3692e] transition">Masuk</Link>
                        <Link href="/register" className="text-sm font-bold bg-[#b3692e] text-white px-5 py-2 rounded-full hover:bg-[#995927] transition">
                            Daftar
                        </Link>
                    </>
                )}
            </div>

            {/* Mobile Hamburger Toggle */}
            <button
                className="md:hidden flex items-center p-2 rounded-lg hover:bg-gray-200/50 transition focus:outline-none"
                onClick={() => setIsOpen(!isOpen)}
            >
                {isOpen ? <X size={24} /> : <Menu size={24} />}
            </button>

            {/* Mobile Menu Dropdown */}
            {isOpen && (
                <div className={`absolute top-full left-0 w-full ${variant === "admin" ? "bg-[#2b3a20] text-white" : "bg-[#fcf8f0] text-gray-700"} shadow-lg border-t border-gray-200/20 md:hidden flex flex-col`}>
                    <div className="flex flex-col p-4 gap-4">
                        {/* Mobile Links */}
                        {
                            user && (
                                <div className="flex flex-col gap-4 border-b border-gray-300/30 pb-4">
                                    {variant === "civil" ? (
                                        <>
                                            <Link href="/dashboard" className="font-medium text-[#4a6b52]">Beranda</Link>
                                            <Link href="/layanan" className="font-medium hover:text-[#4a6b52] transition">Layanan</Link>
                                            <Link href="" className="font-medium hover:text-[#4a6b52] transition">Cek Status</Link>
                                        </>
                                    ) : (
                                        <>
                                            <Link href="/admin/dashboard" className="hover:text-white transition">Dashboard</Link>
                                            <Link href="/admin/template" className="hover:text-white transition">Template Surat</Link>
                                            <Link href="/admin/layanan" className="hover:text-white transition">Layanan Surat</Link>
                                            <Link href="/admin/penduduk" className="hover:text-white transition">Data Sipil</Link>
                                            <Link href="/admin/log-activity" className="hover:text-white transition">Log Activity</Link>
                                        </>
                                    )}
                                </div>
                            )
                        }

                        {/* Mobile Controls */}
                        <div className="flex flex-col gap-4">
                            {user ? (
                                <>
                                    <div className="flex items-center gap-3">
                                        <div className="bg-[#d2dcbc] p-1.5 rounded-full text-[#2b3a20]">
                                            <User size={18} />
                                        </div>
                                        <span className="font-semibold">
                                            {variant === "civil" ? (user.penduduk?.nama || "User") : "Admin Desa"}
                                        </span>
                                    </div>
                                    <Link
                                        href="/logout"
                                        method="post"
                                        as="button"
                                        className="flex items-center justify-center gap-2 border border-gray-400 hover:bg-gray-200/20 px-4 py-2 rounded-lg text-sm transition"
                                    >
                                        <LogOut size={16} />
                                        <span>Keluar</span>
                                    </Link>
                                </>
                            ) : (
                                <div className="flex flex-col gap-3">
                                    <Link href="/login" className="text-center font-medium hover:text-[#b3692e] transition py-2">Masuk</Link>
                                    <Link href="/register" className="text-center font-bold bg-[#b3692e] text-white px-5 py-2.5 rounded-lg hover:bg-[#995927] transition">
                                        Daftar
                                    </Link>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            )}
        </nav>
    )
}