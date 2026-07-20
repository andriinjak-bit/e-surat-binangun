import Logo from '@/Components/Logo';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Login() {
    const { data, setData, post, processing, errors } = useForm({
        nik: '',
        password: '',
    });

    const submit = (e) => {
        e.preventDefault();

        post('/login', {
            forceFormData: true,
            // onError: (err) => {
            //     console.error("Validasi gagal dari Backend:", err);
            // },
            // onSuccess: () => {
            //     console.log("Login Berhasil!");
            // }
        });
    };

    return (
        <div className="min-h-screen flex flex-col md:flex-row font-sans bg-[#1a3821]">
            <Head title="Login" />

            {/* Left Panel - Olive Green */}
            <div className="w-full md:w-5/12 bg-[#314a38] p-8 md:p-12 flex flex-col relative overflow-hidden text-white">
                {/* Content Card */}
                <div className="mb-8 flex justify-start">
                    <Logo />
                </div>
                <div className="bg-[#fcf8f0] rounded-2xl p-8 lg:p-10 shadow-lg relative z-10 text-gray-800 flex-1 flex flex-col justify-center">
                    <h1 className="text-3xl font-bold text-gray-900 mb-4 leading-tight">
                        Selamat Datang<br />Kembali!
                    </h1>

                    <p className="text-[#b3692e] font-medium text-sm leading-relaxed mb-8">
                        Silakan masuk untuk mengakses layanan administrasi kependudukan dan memantau status permohonan surat Anda.
                    </p>

                    <div className="space-y-6">
                        <div className="flex gap-4">
                            <div className="bg-[#b3692e] text-white h-8 w-8 rounded-full flex items-center justify-center font-bold shrink-0 mt-1">1</div>
                            <p className="text-[#b3692e] font-medium text-sm leading-relaxed">
                                Anda bisa memantau status surat, apakah masih diproses atau sudah siap diambil.
                            </p>
                        </div>
                        <div className="flex gap-4">
                            <div className="bg-[#b3692e] text-white h-8 w-8 rounded-full flex items-center justify-center font-bold shrink-0 mt-1">2</div>
                            <p className="text-[#b3692e] font-medium text-sm leading-relaxed">
                                Data Anda tersimpan, jadi tidak perlu mengisi ulang setiap kali mengajukan surat.
                            </p>
                        </div>
                    </div>
                </div>

                {/* Decorative background shapes */}
                <div className="absolute bottom-0 left-0 right-0 h-32 bg-[#263e2c] rounded-t-[100%] transform translate-y-16 scale-150 z-0"></div>
            </div>

            {/* Right Panel - Cream Background */}
            <div className="w-full md:w-7/12 bg-[#fcf8f0] p-4 md:p-8 flex items-center justify-center">
                <div className="bg-white rounded-2xl shadow-xl p-8 md:p-12 w-full max-w-xl">
                    <h2 className="text-2xl font-bold text-gray-900 mb-1">Masuk ke Portal!</h2>
                    <p className="text-gray-500 text-sm mb-8">Gunakan NIK terdaftar untuk masuk.</p>

                    {/* Backend errors fallback for generic errors like 'nik' mismatch */}
                    {errors.nik && !errors.password && (
                        <div className="bg-red-50 text-red-500 text-sm p-3 rounded mb-4">
                            {errors.nik}
                        </div>
                    )}

                    <form onSubmit={submit} className="space-y-5">
                        {/* NIK */}
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">NIK terdaftar</label>
                            <input
                                type="text"
                                className="w-full rounded-lg border-gray-200 bg-[#f9f9f5] text-gray-800 focus:ring-[#b3692e] focus:border-[#b3692e] shadow-sm px-4 py-2.5"
                                placeholder="Contoh: 3502xxxxxxxxxxxx"
                                value={data.nik}
                                onChange={e => setData('nik', e.target.value)}
                            />
                        </div>

                        {/* Password */}
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                            <input
                                type="password"
                                className="w-full rounded-lg border-gray-200 bg-[#f9f9f5] text-gray-800 focus:ring-[#b3692e] focus:border-[#b3692e] shadow-sm px-4 py-2.5"
                                placeholder="Masukkan kata sandi"
                                value={data.password}
                                onChange={e => setData('password', e.target.value)}
                            />
                            {errors.password && <div className="text-red-500 text-xs mt-1">{errors.password}</div>}
                        </div>

                        {/* Submit Button */}
                        <div className="pt-4">
                            <button
                                type="submit"
                                disabled={processing}
                                className="w-full bg-[#b3692e] text-white font-bold py-3 rounded-lg shadow hover:bg-[#995927] transition disabled:opacity-70"
                            >
                                Masuk
                            </button>
                        </div>

                        <div className="text-center mt-6 text-sm text-gray-500">
                            Belum punya akun? <Link href="/register" className="text-[#b3692e] font-semibold hover:underline">Daftar Akun Baru</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}
