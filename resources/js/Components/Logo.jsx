export default function Logo() {
    return (
        <div className="bg-white rounded-full px-4 py-2 inline-flex items-center gap-2 mb-10 w-max shadow-md relative z-10">
            <img src="/logo.webp" alt="Logo Desa" className="h-8 w-8 object-contain" onError={(e) => { e.target.src = 'https://ui-avatars.com/api/?name=DB&background=random'; }} />
            <div>
                <div className="font-bold text-red-700 leading-tight text-sm">DESA BINANGUN</div>
                <div className="text-gray-600 text-xs tracking-wider">KECAMATAN BINANGUN</div>
            </div>
        </div>
    );
}