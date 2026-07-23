import React, { useState } from 'react';
import { Head, usePage, useForm, Link } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import TiptapEditor from '@/Components/TiptapEditor';
import { CheckCircle2, FileText, ArrowLeft, ArrowRight, Send } from 'lucide-react';

export default function Create({ template }) {
    const { auth } = usePage().props;
    const user = auth?.user;
    const penduduk = user?.penduduk;

    const [step, setStep] = useState(1);
    const [previewHtml, setPreviewHtml] = useState('');

    const initialData = {};
    if (template.variables) {
        template.variables.forEach(v => {
            let defaultValue = '';

            const name = v.name.toLowerCase();
            if (penduduk) {
                if (name === 'nik' || name.includes('nik')) defaultValue = penduduk.nik || '';
                if (name === 'nama' || name.includes('nama_lengkap')) defaultValue = penduduk.nama || user.name || '';
                if (name === 'alamat' || name.includes('alamat')) defaultValue = penduduk.alamat || '';
                if (name === 'jenis_kelamin') defaultValue = penduduk.jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan';
                if (name === 'umur' && penduduk.tanggal_lahir) {
                    const dob = new Date(penduduk.tanggal_lahir);
                    const ageDifMs = Date.now() - dob.getTime();
                    const ageDate = new Date(ageDifMs);
                    defaultValue = Math.abs(ageDate.getUTCFullYear() - 1970).toString() + ' Tahun';
                }
            } else if (user) {
                if (name === 'nama' || name.includes('nama_lengkap')) defaultValue = user.name || '';
            }

            initialData[v.name] = defaultValue;
        });
    }

    const { data, setData, post, processing, errors, transform } = useForm({
        form_data: initialData
    });

    const handleChange = (name, value) => {
        setData('form_data', {
            ...data.form_data,
            [name]: value
        });
    };

    const handleNext = (e) => {
        e.preventDefault();

        let html = template.body || '';

        if (template.variables) {
            template.variables.forEach(v => {
                const val = data.form_data[v.name] || '';
                const regex = new RegExp(`\\{\\{\\s*${v.name}\\s*\\}\\}`, 'gi');
                html = html.replace(regex, val);
            });
        }

        setPreviewHtml(html);
        setStep(2);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        transform((data) => ({
            ...data,
            form_data: {
                ...data.form_data,
                _custom_html: previewHtml
            }
        }));
        post(`/surat/request/template/${template.id}`);
    };

    const kopSurat = `<div style="border-bottom: 3px solid black; margin-bottom: 1px; padding-bottom: 10px;">
        <div style="border-bottom: 1px solid black; padding-bottom: 1px; display: flex; align-items: center;">
            <img src="/logo.webp" style="width: 80px; height: auto; margin-right: 20px;" alt="Logo" />
            <div style="text-align: center; flex: 1; padding-right: 80px;">
                <h3 style="margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase;">PEMERINTAH KABUPATEN BLITAR</h3>
                <h3 style="margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase;">KECAMATAN BINANGUN</h3>
                <h2 style="margin: 0; font-size: 16pt; font-weight: bold; text-transform: uppercase;">DESA BINANGUN</h2>
                <p style="margin: 0; font-size: 10pt;">Alamat : Jl. Supriyadi No. 15, Telp.(+62) 81217023368 Kode Pos 66193</p>
                <p style="margin: 0; font-size: 10pt;">Email : <u>pemdes.binangun@gmail.com</u> website : binangun-binangun.desa.id</p>
            </div>
        </div>
    </div><br>`;

    return (
        <div className="min-h-screen bg-[#fcf8f0] font-sans selection:bg-[#b3692e] selection:text-white flex flex-col">
            <Head title={`Ajukan ${template.judul}`} />

            <Navbar variant="civil" />

            <main className="max-w-7xl mx-auto px-4 md:px-8 py-10 w-full flex-grow">
                <div className="mb-10">
                    <h1 className="text-3xl font-bold text-gray-900 mb-2">Ajukan Surat Baru</h1>
                    <p className="text-gray-600 text-sm">Permohonan : <strong>{template.judul}</strong></p>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    {/* Sidebar Steps */}
                    <div className="lg:col-span-4 xl:col-span-3">
                        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                            <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider mb-6">TAHAPAN PENGAJUAN</h3>

                            <div className="relative">
                                <div className="absolute left-[15px] top-[30px] bottom-[30px] w-0.5 bg-gray-100 z-0"></div>

                                <div className={`flex items-start gap-4 mb-8 relative z-10 ${step === 1 ? 'opacity-100' : 'opacity-50'}`}>
                                    <div className={`w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shadow-sm transition-colors ${step === 1 ? 'bg-[#b3692e] text-white' : (step > 1 ? 'bg-[#4a6b52] text-white' : 'bg-white border-2 border-gray-200 text-gray-400')}`}>
                                        {step > 1 ? <CheckCircle2 size={16} /> : 1}
                                    </div>
                                    <div className="pt-1">
                                        <h4 className={`text-sm font-bold ${step === 1 ? 'text-gray-900' : 'text-gray-700'}`}>Data Diri</h4>
                                        <p className="text-xs text-gray-500">Informasi pemohon</p>
                                    </div>
                                </div>

                                <div className={`flex items-start gap-4 relative z-10 ${step === 2 ? 'opacity-100' : 'opacity-50'}`}>
                                    <div className={`w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shadow-sm transition-colors ${step === 2 ? 'bg-[#b3692e] text-white' : 'bg-white border-2 border-gray-200 text-gray-400'}`}>
                                        2
                                    </div>
                                    <div className="pt-1">
                                        <h4 className={`text-sm font-bold ${step === 2 ? 'text-gray-900' : 'text-gray-700'}`}>Konfirmasi</h4>
                                        <p className="text-xs text-gray-500">Cek ulang data melalui pratinjau</p>
                                    </div>
                                </div>
                            </div>

                            <div className="mt-10 bg-[#f4f5f0] rounded-xl p-4 border border-[#e4e6de]">
                                <div className="flex items-center gap-2 text-xs font-bold text-[#4a6b52] mb-1">
                                    <FileText size={14} /> Waktu Proses
                                </div>
                                <p className="text-[10px] text-gray-600 leading-relaxed">
                                    Estimasi penyelesaian surat adalah 1-2 hari kerja setelah dokumen diverifikasi.
                                </p>
                            </div>
                        </div>
                    </div>

                    {/* Main Content Area */}
                    <div className="lg:col-span-8 xl:col-span-9 min-w-0">
                        {step === 1 && (
                            <form onSubmit={handleNext}>
                                <div className="text-center mb-8">
                                    <h2 className="text-2xl font-bold text-[#2b3a20] mb-2">{template.judul}</h2>
                                    <p className="text-gray-500 text-sm">Lengkapi formulir di bawah ini untuk mengajukan permohonan surat secara daring.</p>
                                </div>

                                <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        {template.variables && template.variables.map((v, idx) => (
                                            <div key={idx} className={v.type === 'textarea' || (v.type === 'text' && v.name.includes('alasan')) ? 'md:col-span-2' : ''}>
                                                <label className="block text-xs font-bold text-gray-700 mb-2">{v.label}</label>
                                                {v.type === 'textarea' ? (
                                                    <textarea
                                                        value={data.form_data[v.name] || ''}
                                                        onChange={(e) => handleChange(v.name, e.target.value)}
                                                        rows="4"
                                                        className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm text-gray-700 placeholder-gray-400 focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                                        placeholder={`Masukkan ${v.label.toLowerCase()}`}
                                                        required
                                                    ></textarea>
                                                ) : (
                                                    <input
                                                        type={v.type === 'number' ? 'text' : v.type}
                                                        value={data.form_data[v.name] || ''}
                                                        onChange={(e) => handleChange(v.name, e.target.value)}
                                                        className="w-full bg-[#fbfcf9] border border-gray-200 rounded-xl p-3 text-sm text-gray-700 placeholder-gray-400 focus:border-[#4a6b52] focus:ring-1 focus:ring-[#4a6b52]"
                                                        placeholder={`Masukkan ${v.label.toLowerCase()}`}
                                                        required
                                                    />
                                                )}
                                                {errors[`form_data.${v.name}`] && <p className="text-red-500 text-xs mt-1">{errors[`form_data.${v.name}`]}</p>}
                                            </div>
                                        ))}
                                    </div>
                                </div>

                                <div className="mt-6 flex justify-end">
                                    <button
                                        type="submit"
                                        className="bg-[#2b3a20] text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-[#1a2413] transition shadow-sm flex items-center gap-2"
                                    >
                                        Lanjutkan <ArrowRight size={16} />
                                    </button>
                                </div>
                            </form>
                        )}

                        {step === 2 && (
                            <div>
                                <div className="flex items-center justify-between mb-6">
                                    <button
                                        type="button"
                                        onClick={() => setStep(1)}
                                        className="text-gray-500 hover:text-gray-900 text-sm font-semibold flex items-center gap-1 transition"
                                    >
                                        <ArrowLeft size={16} /> Kembali
                                    </button>
                                    <div className="bg-[#faeddc] text-[#b3692e] text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                                        Pratinjau
                                    </div>
                                </div>

                                <div className="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                                    <div className="bg-[#f8f9f2] border-b border-gray-100 px-6 py-4 flex items-center gap-2">
                                        <FileText size={18} className="text-gray-500" />
                                        <h3 className="text-sm font-bold text-gray-800">Pratinjau Surat Resmi</h3>
                                    </div>

                                    <div className="p-4 md:p-8 overflow-y-auto bg-gray-100 flex justify-center">
                                        {/* A4 Size Paper Representation */}
                                        <div className="bg-white p-10 md:p-16 shadow-sm w-full max-w-[21cm] min-h-[29.7cm] border border-gray-200 flex flex-col text-gray-800">
                                            <div dangerouslySetInnerHTML={{ __html: kopSurat }} className="prose prose-sm sm:prose-base prose-td:border-none prose-th:border-none prose-tr:border-none max-w-none text-gray-800" />
                                            <TiptapEditor
                                                value={previewHtml}
                                                onChange={(val) => setPreviewHtml(val)}
                                                readOnly={false}
                                                variant="document"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <form onSubmit={handleSubmit} className="flex justify-end gap-4">
                                    <button
                                        type="button"
                                        onClick={() => setStep(1)}
                                        className="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-bold text-sm hover:bg-gray-50 transition"
                                    >
                                        Perbaiki Data
                                    </button>
                                    <button
                                        type="submit"
                                        disabled={processing}
                                        className="bg-[#2b3a20] text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-[#1a2413] transition shadow-sm flex items-center gap-2 disabled:opacity-50"
                                    >
                                        <Send size={16} /> Ajukan
                                    </button>
                                </form>
                            </div>
                        )}
                    </div>
                </div>
            </main>

            <Footer />
        </div>
    );
}
