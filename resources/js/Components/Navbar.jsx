import React, { useState } from 'react';
import Logo from "./Logo";
import { Link } from '@inertiajs/react';
import { LogOut, User, Menu, X } from 'lucide-react';

export default function Navbar() {
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);

    return (
        <nav className="bg-[#2b3a20] text-white px-4 md:px-8 py-4 relative shadow-md">
            <div className="flex flex-wrap items-center justify-between">
                <div className="flex items-center gap-4">
                    <img src="/logo.webp" alt="Logo Desa" className="h-8 md:h-10" />
                    <span className="bg-[#d2dcbc] text-[#2b3a20] text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap hidden md:inline-block">ADMIN PORTAL</span>
                </div>


            {/* Desktop Center Links */}
            {user && (
                <div className="hidden md:flex items-center gap-8 text-sm font-medium">
                    {variant === "civil" ? (
                        <>
                            <Link href="" className="text-[#4a6b52] border-b-2 border-[#4a6b52] pb-1">Beranda</Link>
                            <Link href="" className="hover:text-[#4a6b52] transition">Layanan</Link>
                            {
                                user && <Link href="" className="hover:text-[#4a6b52] transition">Cek Status</Link>
                            }
                        </>
                    ) : (
                        <>
                            <Link href="" className="hover:font-semibold transition">Template Surat</Link>
                            <Link href="" className="hover:font-semibold transition">Data Sipil</Link>
                            <Link href="" className="hover:font-semibold transition">Layanan Surat</Link>
                        </>
                    )}
                </div>
            )}

            {/* Desktop Right Controls */}
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

                {/* Mobile Menu Button */}
                <button
                    onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
                    className="md:hidden flex items-center justify-center p-2 text-gray-300 hover:text-white transition"
                >
                    {isMobileMenuOpen ? <X size={24} /> : <Menu size={24} />}
                </button>

                {/* Desktop Navigation */}
                <div className="hidden md:flex items-center gap-8 text-sm text-gray-300">
                    <Link href="/admin/dashboard" className="hover:text-white transition">Dashboard</Link>
                    <Link href="/admin/template" className="hover:text-white transition">Template Surat</Link>
                    <Link href="/admin/layanan" className="hover:text-white transition">Layanan Surat</Link>
                    <Link href="/admin/penduduk" className="hover:text-white transition">Data Sipil</Link>
                    <Link href="/admin/log-activity" className="hover:text-white transition">Log Activity</Link>
                </div>

                {/* Desktop User Actions */}
                <div className="hidden md:flex items-center gap-4">
                    <div className="flex items-center gap-2">
                        <span className="text-sm">Admin Desa</span>
                        <div className="bg-[#d2dcbc] p-1.5 rounded-full text-[#2b3a20]">
                            <User size={18} />
                        </div>
                    </div>
                    <Link href="/logout" method="post" as="button" className="flex items-center gap-2 border border-gray-400 hover:border-white px-4 py-1.5 rounded-full text-sm transition">
                        <LogOut size={16} />
                        <span>Keluar</span>
                    </Link>
                </div>
            </div>

            {/* Mobile Navigation Dropdown */}
            {
                isMobileMenuOpen && (
                    <div className="md:hidden absolute top-full left-0 right-0 bg-[#2b3a20] border-t border-[#3f5231] shadow-lg z-50 flex flex-col py-2">
                        <Link href="/admin/dashboard" className="px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-[#3f5231] transition">Dashboard</Link>
                        <Link href="/admin/template" className="px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-[#3f5231] transition">Template Surat</Link>
                        <Link href="/admin/layanan" className="px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-[#3f5231] transition">Layanan Surat</Link>
                        <Link href="/admin/penduduk" className="px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-[#3f5231] transition">Data Sipil</Link>
                        <Link href="/admin/log-activity" className="px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-[#3f5231] transition">Log Activity</Link>

            {/* Mobile Menu Dropdown */}
            {isOpen && (
                <div className={`absolute top-full left-0 w-full ${variant === "admin" ? "bg-[#2b3a20] text-white" : "bg-[#fcf8f0] text-gray-700"} shadow-lg border-t border-gray-200/20 md:hidden flex flex-col`}>
                    <div className="flex flex-col p-4 gap-4">
                        {/* Mobile Links */}
                        <div className="flex flex-col gap-4 border-b border-gray-300/30 pb-4">
                            {variant === "civil" ? (
                                <>
                                    <Link href="#hero" className="font-medium text-[#4a6b52]">Beranda</Link>
                                    <Link href="#layanan" className="font-medium hover:text-[#4a6b52] transition">Layanan</Link>
                                    {
                                        user && <Link href="#" className="font-medium hover:text-[#4a6b52] transition">Cek Status</Link>
                                    }
                                </>
                            ) : (
                                <>
                                    <Link href="#" className="font-medium hover:opacity-80 transition">Template Surat</Link>
                                    <Link href="#" className="font-medium hover:opacity-80 transition">Data Sipil</Link>
                                    <Link href="#" className="font-medium hover:opacity-80 transition">Layanan Surat</Link>
                                </>
                            )}
                        </div>
                        
                        <div className="border-t border-[#3f5231] my-2"></div>


                        <div className="px-4 py-3 flex items-center justify-between">
                            <div className="flex items-center gap-2 text-gray-300">
                                <div className="bg-[#d2dcbc] p-1.5 rounded-full text-[#2b3a20]">
                                    <User size={18} />
                                </div>
                                <span className="text-sm">Admin Desa</span>
                            </div>
                            <Link href="/logout" method="post" as="button" className="flex items-center gap-2 border border-gray-400 hover:border-white text-gray-300 hover:text-white px-3 py-1.5 rounded-full text-sm transition">
                                <LogOut size={16} />
                                <span>Keluar</span>
                            </Link>
                        </div>
                    </div>
                )
            }
        </nav >
    );
}