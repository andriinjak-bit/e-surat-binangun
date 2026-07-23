import React from 'react';
import { Link } from '@inertiajs/react';
import { FileText, Store, HandCoins, ShieldAlert, FileMinus, FileSearch } from 'lucide-react';

export default function SuratCard({ template }) {
    let icon = <FileText size={20} />;
    let iconBg = 'bg-gray-100';
    let iconColor = 'text-gray-700';

    const judul = template.judul.toLowerCase();

    if (judul.includes('usaha')) {
        icon = <Store size={20} />;
        iconBg = 'bg-[#e2f0d9]';
        iconColor = 'text-[#4a6b52]';
    } else if (judul.includes('mampu')) {
        icon = <HandCoins size={20} />;
        iconBg = 'bg-[#faeddc]';
        iconColor = 'text-[#b3692e]';
    } else if (judul.includes('skck')) {
        icon = <ShieldAlert size={20} />;
        iconBg = 'bg-gray-100';
        iconColor = 'text-gray-700';
    } else if (judul.includes('kematian')) {
        icon = <FileMinus size={20} />;
        iconBg = 'bg-red-50';
        iconColor = 'text-red-500';
    } else if (judul.includes('kehilangan')) {
        icon = <FileSearch size={20} />;
        iconBg = 'bg-blue-50';
        iconColor = 'text-blue-500';
    }

    return (
        <div className="bg-white rounded-2xl p-6 flex flex-col justify-between shadow-md border border-gray-200 hover:shadow-xl hover:border-[#b3692e]/30 hover:-translate-y-1.5 transition-all duration-300 ease-in-out h-full group">
            <div>
                <div className={`${iconBg} w-10 h-10 rounded-lg flex items-center justify-center ${iconColor} mb-4`}>
                    {icon}
                </div>
                <h3 className="text-lg font-bold text-gray-900 mb-2">{template.judul}</h3>

                <p className="text-gray-600 text-xs mb-4 leading-relaxed line-clamp-3">
                    Layanan pengajuan {template.judul} secara daring. Pastikan Anda melengkapi persyaratan yang dibutuhkan.
                </p>

                <ul className="text-xs text-gray-600 space-y-2 mb-6">
                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KTP</li>
                    <li className="flex items-center gap-2"><i className="fas fa-check-circle text-green-600"></i> Fotokopi KK</li>
                </ul>
            </div>

            <Link
                href={`/surat/request/template/${template.id}`}
                className="w-full block text-center bg-[#2b3a20] text-white font-semibold py-2.5 rounded-lg hover:bg-[#1a2413] transition text-sm mt-auto"
            >
                Ajukan Sekarang
            </Link>
        </div>
    );
}
