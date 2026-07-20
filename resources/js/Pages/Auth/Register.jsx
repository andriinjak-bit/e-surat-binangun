import Logo from '@/Components/Logo';
import { Head, Link, useForm } from '@inertiajs/react';
import { useRef } from 'react';

export default function Register() {
    const ktpRef = useRef(null);
    const kkRef = useRef(null);

    const { data, setData, post, processing, errors } = useForm({
        name: '',
        nik: '',
        jenis_kelamin: '',
        tempat_lahir: '',
        tanggal_lahir: '',
        alamat: '',
        password: '',
        password_confirmation: '',
        agreement: false,
        ktp: null,
        kk: null,
    });

    const submit = (e) => {
        e.preventDefault();

        post('/register', {
            forceFormData: true,
            onError: (err) => {
                console.error("Validasi gagal dari Backend:", err);
            },
            onSuccess: () => {
                console.log("Registrasi Berhasil!");
            }
        });
    };

    return (
        <div className="min-h-screen flex flex-col md:flex-row font-sans bg-[#1a3821]">
            <Head title="Register" />

            {/* Left Panel - Olive Green */}
            <div className="w-full md:w-5/12 bg-[#314a38] p-8 md:p-12 flex flex-col relative overflow-hidden text-white">
                {/* Content Card */}
                <div className="mb-6 flex justify-start">
                    <Logo />
                </div>
                <div className="bg-[#fcf8f0] rounded-2xl p-8 lg:p-10 shadow-lg relative z-10 text-gray-800 flex-1 flex flex-col justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 mb-6 leading-tight">
                            Kenapa Perlu Daftar<br />Akun?
                        </h1>

                        <div className="space-y-6">
                            <div className="flex gap-4">
                                <div className="bg-[#b3692e] text-white h-8 w-8 rounded-full flex items-center justify-center font-bold shrink-0 mt-1">1</div>
                                <p className="text-[#b3692e] font-medium text-sm leading-relaxed">
                                    Data Anda tersimpan, jadi tidak perlu mengisi ulang setiap kali mengajukan surat.
                                </p>
                            </div>
                            <div className="flex gap-4">
                                <div className="bg-[#b3692e] text-white h-8 w-8 rounded-full flex items-center justify-center font-bold shrink-0 mt-1">2</div>
                                <p className="text-[#b3692e] font-medium text-sm leading-relaxed">
                                    Anda bisa memantau status surat, apakah masih diproses atau sudah siap diambil.
                                </p>
                            </div>
                            <div className="flex gap-4">
                                <div className="bg-[#b3692e] text-white h-8 w-8 rounded-full flex items-center justify-center font-bold shrink-0 mt-1">3</div>
                                <p className="text-[#b3692e] font-medium text-sm leading-relaxed">
                                    Petugas desa bisa menghubungi Anda langsung lewat nomor HP yang terdaftar.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="mt-8">
                        <h2 className="text-2xl font-bold text-gray-900 mb-2">Unggah Dokumen<br />Pendukung</h2>
                        <p className="text-[#b3692e] text-xs flex items-center gap-1 mb-4">
                            <i className="fas fa-info-circle"></i> Format: JPG, PNG, atau PDF (Maks. 2MB)
                        </p>

                        <div className="space-y-4">
                            <div>
                                <input type="file" className="hidden" ref={ktpRef} accept=".jpg,.jpeg,.png,.pdf" onChange={e => setData('ktp', e.target.files[0])} />
                                <div onClick={() => ktpRef.current?.click()} className="border-2 border-dashed border-[#b3692e] bg-[#fcf8f0] rounded-xl p-4 flex items-center justify-between cursor-pointer hover:bg-orange-50 transition">
                                    <div className="flex items-center gap-4">
                                        <div className="bg-[#b3692e] text-white p-2 rounded-lg">
                                            <i className="fas fa-id-card"></i>
                                        </div>
                                        <div>
                                            <div className="font-bold text-[#b3692e] text-sm">Unggah KTP</div>
                                            <div className="text-[#b3692e] text-xs">{data.ktp ? data.ktp.name : "Klik untuk unggah atau seret file"}</div>
                                        </div>
                                    </div>
                                    <i className="fas fa-file-upload text-[#b3692e]"></i>
                                </div>
                                {errors.ktp && <div className="text-red-500 text-xs mt-1">{errors.ktp}</div>}
                            </div>

                            <div>
                                <input type="file" className="hidden" ref={kkRef} accept=".jpg,.jpeg,.png,.pdf" onChange={e => setData('kk', e.target.files[0])} />
                                <div onClick={() => kkRef.current?.click()} className="border-2 border-dashed border-[#b3692e] bg-[#fcf8f0] rounded-xl p-4 flex items-center justify-between cursor-pointer hover:bg-orange-50 transition">
                                    <div className="flex items-center gap-4">
                                        <div className="bg-[#b3692e] text-white p-2 rounded-lg">
                                            <i className="fas fa-users"></i>
                                        </div>
                                        <div>
                                            <div className="font-bold text-[#b3692e] text-sm">Unggah Kartu Keluarga</div>
                                            <div className="text-[#b3692e] text-xs">{data.kk ? data.kk.name : "Klik untuk unggah atau seret file"}</div>
                                        </div>
                                    </div>
                                    <i className="fas fa-file-upload text-[#b3692e]"></i>
                                </div>
                                {errors.kk && <div className="text-red-500 text-xs mt-1">{errors.kk}</div>}
                            </div>
                        </div>
                    </div>
                </div>

                {/* Decorative background shapes */}
                <div className="absolute bottom-0 left-0 right-0 h-32 bg-[#263e2c] rounded-t-[100%] transform translate-y-16 scale-150 z-0"></div>
            </div>

            {/* Right Panel - White */}
            <div className="w-full md:w-7/12 bg-[#fcf8f0] p-4 md:p-8 flex items-center justify-center">
                <div className="bg-white rounded-2xl shadow-xl p-8 md:p-12 w-full max-w-3xl">
                    <h2 className="text-2xl font-bold text-gray-900 mb-1">Registrasi Akun Baru!</h2>
                    <p className="text-gray-500 text-sm mb-8">Isi data di bawah ini dengan benar sesuai KTP!</p>

                    <form onSubmit={submit} className="space-y-5">
                        {/* Nama Lengkap */}
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input
                                type="text"
                                className="w-full rounded-lg border-gray-200 bg-[#f9f9f5] text-gray-800 focus:ring-[#b3692e] focus:border-[#b3692e] shadow-sm px-4 py-2.5"
                                placeholder="Contoh : Andry Ilmy Sukma"
                                value={data.name}
                                onChange={e => setData('name', e.target.value)}
                            />
                            {errors.name && <div className="text-red-500 text-xs mt-1">{errors.name}</div>}
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {/* NIK */}
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">Nomor Induk Kependudukan (NIK)</label>
                                <input
                                    type="text"
                                    className="w-full rounded-lg border-gray-200 bg-[#f9f9f5] text-gray-800 focus:ring-[#b3692e] focus:border-[#b3692e] shadow-sm px-4 py-2.5"
                                    placeholder="16 digit sesuai KTP"
                                    value={data.nik}
                                    onChange={e => setData('nik', e.target.value)}
                                />
                                {errors.nik && <div className="text-red-500 text-xs mt-1">{errors.nik}</div>}
                            </div>

                            {/* Jenis Kelamin */}
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                <select
                                    className="w-full rounded-lg border-gray-200 bg-[#f9f9f5] text-gray-800 focus:ring-[#b3692e] focus:border-[#b3692e] shadow-sm px-4 py-2.5"
                                    value={data.jenis_kelamin}
                                    onChange={e => setData('jenis_kelamin', e.target.value)}
                                >
                                    <option value="" disabled>Pilih Jenis Kelamin</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                                {errors.jenis_kelamin && <div className="text-red-500 text-xs mt-1">{errors.jenis_kelamin}</div>}
                            </div>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {/* Tempat Lahir */}
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                <input
                                    type="text"
                                    className="w-full rounded-lg border-gray-200 bg-[#f9f9f5] text-gray-800 focus:ring-[#b3692e] focus:border-[#b3692e] shadow-sm px-4 py-2.5"
                                    placeholder="Contoh : Blitar"
                                    value={data.tempat_lahir}
                                    onChange={e => setData('tempat_lahir', e.target.value)}
                                />
                                {errors.tempat_lahir && <div className="text-red-500 text-xs mt-1">{errors.tempat_lahir}</div>}
                            </div>

                            {/* Tanggal Lahir */}
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                <input
                                    type="date"
                                    className="w-full rounded-lg border-gray-200 bg-[#f9f9f5] text-gray-800 focus:ring-[#b3692e] focus:border-[#b3692e] shadow-sm px-4 py-2.5"
                                    value={data.tanggal_lahir}
                                    onChange={e => setData('tanggal_lahir', e.target.value)}
                                />
                                {errors.tanggal_lahir && <div className="text-red-500 text-xs mt-1">{errors.tanggal_lahir}</div>}
                            </div>
                        </div>

                        {/* Alamat Lengkap */}
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <input
                                type="text"
                                className="w-full rounded-lg border-gray-200 bg-[#f9f9f5] text-gray-800 focus:ring-[#b3692e] focus:border-[#b3692e] shadow-sm px-4 py-2.5"
                                placeholder="Contoh : Jl. Melati No. 42"
                                value={data.alamat}
                                onChange={e => setData('alamat', e.target.value)}
                            />
                            {errors.alamat && <div className="text-red-500 text-xs mt-1">{errors.alamat}</div>}
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {/* Buat Kata Sandi */}
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">Buat Kata Sandi</label>
                                <input
                                    type="password"
                                    className="w-full rounded-lg border-gray-200 bg-[#f9f9f5] text-gray-800 focus:ring-[#b3692e] focus:border-[#b3692e] shadow-sm px-4 py-2.5"
                                    placeholder="Minimal 8 karakter"
                                    value={data.password}
                                    onChange={e => setData('password', e.target.value)}
                                />
                                {errors.password && <div className="text-red-500 text-xs mt-1">{errors.password}</div>}
                            </div>

                            {/* Ulangi Kata Sandi */}
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">Ulangi Kata sandi</label>
                                <input
                                    type="password"
                                    className="w-full rounded-lg border-gray-200 bg-[#f9f9f5] text-gray-800 focus:ring-[#b3692e] focus:border-[#b3692e] shadow-sm px-4 py-2.5"
                                    placeholder="Ketik ulang kata sandi"
                                    value={data.password_confirmation}
                                    onChange={e => setData('password_confirmation', e.target.value)}
                                />
                                {errors.password_confirmation && <div className="text-red-500 text-xs mt-1">{errors.password_confirmation}</div>}
                            </div>
                        </div>

                        {/* Agreement */}
                        <div className="pt-4 flex items-start gap-3">
                            <input
                                type="checkbox"
                                id="agreement"
                                className="mt-1 rounded border-gray-300 text-[#b3692e] shadow-sm focus:ring-[#b3692e]"
                                checked={data.agreement}
                                onChange={e => setData('agreement', e.target.checked)}
                            />
                            <label htmlFor="agreement" className="text-sm text-gray-500 leading-tight">
                                Saya menyetujui data ini digunakan untuk keperluan administrasi surat menyurat Desa Binangun
                            </label>
                        </div>
                        {errors.agreement && <div className="text-red-500 text-xs mt-0">{errors.agreement}</div>}

                        {/* Submit Button */}
                        <div className="pt-4">
                            <button
                                type="submit"
                                disabled={processing}
                                className="w-full bg-[#b3692e] text-white font-bold py-3 rounded-lg shadow hover:bg-[#995927] transition disabled:opacity-70"
                            >
                                Daftar
                            </button>
                        </div>

                        <div className="text-center mt-6 text-sm text-gray-500">
                            Sudah punya akun? <a href="/login" className="text-[#b3692e] font-semibold hover:underline">Masuk di sini</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}
