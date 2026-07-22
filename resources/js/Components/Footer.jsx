import { MapPin, Mail } from 'lucide-react'
export default function Footer() {
    return (
        <footer className="bg-[#2b3a20] text-gray-300 py-12 mt-12">
            <div className="max-w-7xl mx-auto px-4 md:px-8 grid grid-cols-1 md:grid-cols-2 gap-10">
                <div>
                    <div className="mb-4">
                        <img src="/logo.webp" alt="Logo Binangun" className="h-16" />
                    </div>
                    <h3 className="text-2xl font-bold text-white mb-4">Desa Binangun</h3>
                    <p className="text-gray-400 max-w-sm leading-relaxed">
                        Mewujudkan pelayanan desa yang transparan, modern, dan akuntabel untuk kesejahteraan seluruh warga Desa Binangun.
                    </p>
                </div>
                <div className="md:pl-20">
                    <h4 className="text-xl font-bold text-white mb-6">Kontak & Lokasi</h4>
                    <div className="flex items-start gap-4 mb-4">
                        <MapPin className="text-[#aabf82] mt-1 shrink-0" size={20} />
                        <p>Jalan Raya Binangun, Kec. Binangun, Kabupaten Blitar, <br />Jawa Timur 66193</p>
                    </div>
                    <div className="flex items-center gap-4">
                        <Mail className="text-[#aabf82] shrink-0" size={20} />
                        <p>pemdes.binangun@gmail.com</p>
                    </div>
                </div>
            </div>
        </footer>
    )
}