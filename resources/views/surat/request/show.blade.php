@extends('layouts.app')

@section('content')
    <style>
        /* Print specific styles */
        @media print {
            body * {
                visibility: hidden;
            }

            #printable-area,
            #printable-area * {
                visibility: visible;
            }

            #printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 2cm;
                /* Standard letter padding */
                background: white !important;
                box-shadow: none !important;
                font-size: 10pt !important;
            }
        }
    </style>

    <div class="max-w-5xl mx-auto px-4 py-8">
        <div class="mb-6 flex justify-between items-end">
            <div>
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
                <h1 class="text-2xl font-bold text-[#0B2E4F] mt-2">Detail Pengajuan:
                    {{ $suratRequest->template->judul ?? 'Surat' }}</h1>
                <p class="text-gray-600 text-sm mt-1">Dibuat pada {{ $suratRequest->created_at->format('d M Y, H:i') }}</p>
            </div>

            <div>
                <button onclick="window.print()"
                    class="bg-[#1E8449] text-white px-4 py-2 rounded-lg font-bold hover:bg-green-700 shadow flex items-center gap-2">
                    <i class="fas fa-print"></i> Cetak Dokumen
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">&times;</button>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <!-- Sidebar Info -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-5 rounded-xl shadow border border-gray-100">
                    <h3 class="font-bold text-gray-700 mb-3 border-b pb-2">Status Pengajuan</h3>

                    <div class="mb-4">
                        @if($suratRequest->status == 'pending')
                            <div
                                class="inline-flex items-center justify-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg font-bold text-sm w-full">
                                <i class="fas fa-clock mr-2"></i> Menunggu
                            </div>
                        @elseif($suratRequest->status == 'diproses')
                            <div
                                class="inline-flex items-center justify-center px-4 py-2 bg-blue-100 text-blue-800 rounded-lg font-bold text-sm w-full">
                                <i class="fas fa-spinner fa-spin mr-2"></i> Diproses
                            </div>
                        @elseif($suratRequest->status == 'selesai')
                            <div
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-100 text-green-800 rounded-lg font-bold text-sm w-full">
                                <i class="fas fa-check-circle mr-2"></i> Selesai
                            </div>
                        @else
                            <div
                                class="inline-flex items-center justify-center px-4 py-2 bg-red-100 text-red-800 rounded-lg font-bold text-sm w-full">
                                <i class="fas fa-times-circle mr-2"></i> Ditolak
                            </div>
                        @endif
                    </div>

                    <div class="text-xs text-gray-500 space-y-2 mt-4">
                        <p><strong>ID Pengajuan:</strong> #{{ str_pad($suratRequest->id, 5, '0', STR_PAD_LEFT) }}</p>
                        <p><strong>Pemohon:</strong> {{ $suratRequest->user->name ?? '-' }}</p>
                        <p><strong>Template:</strong> {{ $suratRequest->template->judul ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Document Preview -->
            <div class="lg:col-span-3">
                <div
                    class="bg-gray-100 p-4 sm:p-8 rounded-xl shadow-inner overflow-hidden border border-gray-200 flex justify-center">

                    <!-- A4 Paper Styling -->
                    <div id="printable-area" class="bg-white shadow-xl max-w-full overflow-hidden relative"
                        style="width: 21cm; min-height: 29.7cm; padding: .5cm; font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; color: black;">
                        <!-- KOP SURAT OTOMATIS -->
                        <div style="border-bottom: 3px solid black; margin-bottom: 1px; padding-bottom: 10px;">
                            <div
                                style="border-bottom: 1px solid black; padding-bottom: 1px; display: flex; align-items: center;">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/9/94/Lambang_Kabupaten_Blitar.webp"
                                    style="width: 80px; height: auto; margin-right: 20px;" alt="Logo">
                                <!-- Ganti URL logo ini dengan logo desa/kabupaten yang sesuai -->
                                <div style="text-align: center; flex: 1; padding-right: 80px;">
                                    <h3 style="margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase;">
                                        PEMERINTAH KABUPATEN BLITAR</h3>
                                    <h3 style="margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase;">
                                        KECAMATAN BINANGUN</h3>
                                    <h2 style="margin: 0; font-size: 16pt; font-weight: bold; text-transform: uppercase;">
                                        DESA BINANGUN</h2>
                                    <p style="margin: 0; font-size: 10pt;">Alamat : Jl. Supriyadi No. 15, Telp.(+62)
                                        81217023368 Kode Pos 66193</p>
                                    <p style="margin: 0; font-size: 10pt;">Email : <u>pemdes.binangun@gmail.com</u> website
                                        : binangun-binangun.desa.id</p>
                                </div>
                            </div>
                        </div>
                        <br>

                        <!-- ISI SURAT DARI TIPTAP -->
                        {!! $htmlOutput !!}
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection