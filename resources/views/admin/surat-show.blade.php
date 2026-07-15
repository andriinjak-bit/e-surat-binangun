@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#0B2E4F]">Detail & Review Surat</h1>
        <a href="{{ route('admin.surat') }}" class="text-sm text-gray-500 hover:underline">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- 1. SURAT PREVIEW (THE PAPER VIEW) -->
    <div class="bg-gray-200 p-8 rounded-xl mb-8 shadow-inner overflow-x-auto">
        <div class="flex justify-between items-center mb-4">
            <h4 class="font-bold text-[#0B2E4F] flex items-center gap-2">
                <i class="fas fa-file-alt"></i> Pratinjau Surat (A4 Layout)
            </h4>
            <button onclick="printSurat()" class="px-4 py-2 bg-[#0B2E4F] text-white rounded hover:bg-[#163a5f] font-bold transition">
                <i class="fas fa-print"></i> Cetak Surat untuk TTD
            </button>
        </div>

        <!-- The actual "Paper" container -->
        <div id="printable-surat" class="bg-white mx-auto shadow-2xl p-[2cm] text-black" style="width: 210mm; min-height: 297mm; font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.6;">
            
            <!-- ========================================== -->
            <!-- HEADER WITH LOGO KABUPATEN BLITAR -->
            <!-- ========================================== -->
            <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 4px;">
                <div style="flex: 0 0 100px; text-align: center;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/94/Lambang_Kabupaten_Blitar.webp" 
                         alt="Logo Kabupaten Blitar" 
                         style="width: 85px; height: auto; display: block; margin: 0 auto;">
                </div>
                <div style="flex: 1; text-align: center; padding-right: 100px;">
                    <div style="font-size: 14pt; font-weight: bold; line-height: 1.3; letter-spacing: 0.5px;">
                        PEMERINTAH KABUPATEN BLITAR
                    </div>
                    <div style="font-size: 13pt; font-weight: bold; line-height: 1.3; letter-spacing: 0.5px;">
                        KECAMATAN BINANGUN
                    </div>
                    <div style="font-size: 13pt; font-weight: bold; line-height: 1.3; letter-spacing: 0.5px;">
                        DESA BINANGUN
                    </div>
                </div>
            </div>

            <!-- Address Line -->
            <div style="text-align: center; font-size: 9.5pt; border-bottom: 3px solid #000; padding-bottom: 6px; margin-bottom: 16px; line-height: 1.6;">
                JL. SUPRIYADI NO : 15 Telp. (+62) 81217203368 Kode Pos 66193
                <br>
                Email: pemdes.binangun@gmail.com Website: binangun-binangun.desa.id
            </div>

            <!-- ========================================== -->
            <!-- SURAT TITLE - Dynamic Based on Type -->
            <!-- ========================================== -->
            <div style="text-align: center; margin: 20px 0 16px 0;">
                @if($surat->jenis_surat == 'kehilangan')
                    <div style="font-size: 14pt; font-weight: bold; text-decoration: underline; text-underline-offset: 2px;">
                        SURAT PENGANTAR KEHILANGAN
                    </div>
                @elseif($surat->jenis_surat == 'usaha')
                    <div style="font-size: 14pt; font-weight: bold; text-decoration: underline; text-underline-offset: 2px;">
                        SURAT KETERANGAN USAHA
                    </div>
                @elseif($surat->jenis_surat == 'tidak_mampu')
                    <div style="font-size: 14pt; font-weight: bold; text-decoration: underline; text-underline-offset: 2px;">
                        SURAT KETERANGAN TIDAK MAMPU
                    </div>
                @elseif($surat->jenis_surat == 'kematian')
                    <div style="font-size: 14pt; font-weight: bold; text-decoration: underline; text-underline-offset: 2px;">
                        SURAT KETERANGAN KEMATIAN
                    </div>
                @elseif($surat->jenis_surat == 'skck')
                    <div style="font-size: 14pt; font-weight: bold; text-decoration: underline; text-underline-offset: 2px;">
                        SURAT PENGANTAR SKCK
                    </div>
                @else
                    <div style="font-size: 14pt; font-weight: bold; text-decoration: underline; text-underline-offset: 2px;">
                        SURAT KETERANGAN
                    </div>
                @endif
                <div style="font-size: 12pt; margin-top: 4px;">
                    Nomor : / 409.40.2 / 2026
                </div>
            </div>

            <!-- ========================================== -->
            <!-- BODY CONTENT - Dynamic Based on Type -->
            <!-- ========================================== -->
            @if($surat->jenis_surat == 'kehilangan')
                <!-- SURAT PENGANTAR KEHILANGAN -->
                <div style="margin: 16px 0; text-align: justify;">
                    <p style="text-indent: 36pt; margin-bottom: 12px;">
                        Yang bertanda tangan dibawah ini Kepala Desa Binangun Kec. Binangun Kabupaten Blitar menerangkan dengan sebenarnya bahwa :
                    </p>
                </div>

                <table style="width: 100%; margin: 8px 0 8px 0; border-collapse: collapse;">
                    <tr>
                        <td style="width: 25%; padding: 2px 8px; vertical-align: top;">Nama</td>
                        <td style="width: 2%; padding: 2px 0; vertical-align: top;">:</td>
                        <td style="width: 73%; padding: 2px 8px; vertical-align: top; font-weight: bold;">{{ $surat->form_data['nama'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">NIK</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['nik'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Tempat Tgl. Lahir</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['ttl'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Jenis Kelamin</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['jenis_kelamin'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Status</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['status_perkawinan'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Pekerjaan</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['pekerjaan'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Agama</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['agama'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top; vertical-align: top;">Alamat</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['alamat'] ?? '-' }}</td>
                    </tr>
                </table>

                <div style="margin: 8px 0; text-align: justify;">
                    <p style="margin-bottom: 4px; text-indent: 36pt;">
                        Yang bersangkutan adalah benar warga Desa Binangun dan menurut keterangan yang bersangkutan Telah Kehilangan <strong>{{ $surat->form_data['dokumen_hilang'] ?? 'dokumen' }}</strong>
                    </p>
                    <p style="margin-bottom: 4px; text-indent: 36pt;">
                        Surat Keterangan ini dibuat untuk {{ $surat->form_data['keperluan'] ?? 'pengantar kehilangan' }}.
                    </p>
                </div>

                <div style="margin: 8px 0; text-align: justify;">
                    <p style="margin-top: 8px; text-indent: 36pt;">
                        Demikian surat keterangan ini dibuat untuk menjadikan periksa dan dipergunakan sebagaimana mestinya.
                    </p>
                </div>

            @elseif($surat->jenis_surat == 'usaha')
                <!-- SURAT KETERANGAN USAHA -->
                <div style="margin: 16px 0; text-align: justify;">
                    <p style="text-indent: 36pt; margin-bottom: 12px;">
                        Yang bertanda tangan dibawah ini Kepala Desa Binangun Kecamatan Binangun Kabupaten Blitar, Menerangkan bahwa :
                    </p>
                </div>

                <table style="width: 100%; margin: 8px 0 8px 0; border-collapse: collapse;">
                    <tr>
                        <td style="width: 25%; padding: 2px 8px; vertical-align: top;">Nama</td>
                        <td style="width: 2%; padding: 2px 0; vertical-align: top;">:</td>
                        <td style="width: 73%; padding: 2px 8px; vertical-align: top; font-weight: bold;">{{ $surat->form_data['nama'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">NIK</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['nik'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Umur</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['umur'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Jenis Kelamin</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['jenis_kelamin'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top; vertical-align: top;">Alamat</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['alamat'] ?? '-' }}</td>
                    </tr>
                </table>

                <div style="margin: 8px 0; text-align: justify;">
                    <p style="margin-bottom: 4px; text-indent: 36pt;">
                        Bahwa Menurut Keterangan Yang Bersangkutan Memiliki <strong>Usaha {{ strtoupper($surat->form_data['usaha'] ?? '') }}</strong>
                    </p>
                    <p style="margin-bottom: 4px; text-indent: 36pt;">
                        yang bertempat di <strong>{{ $surat->form_data['lokasi_usaha'] ?? '' }}</strong> Desa Binangun Kec. Binangun Kab. Blitar.
                    </p>
                </div>

                <div style="margin: 8px 0; text-align: justify;">
                    <p style="margin-bottom: 4px; text-indent: 36pt;">
                        Surat keterangan ini buat untuk {{ $surat->form_data['keperluan'] ?? '' }}.
                    </p>
                    <p style="margin-top: 4px; text-indent: 36pt;">
                        Demikian surat keterangan ini harap menjadikan periksa dan dipergunakan sebagaimana mestinya.
                    </p>
                </div>

            @elseif($surat->jenis_surat == 'tidak_mampu')
                <!-- SURAT KETERANGAN TIDAK MAMPU (SKTM) -->
                <div style="margin: 16px 0; text-align: justify;">
                    <p style="text-indent: 36pt; margin-bottom: 12px;">
                        Yang bertanda tangan dibawah ini Kepala Desa Binangun Kecamatan Binangun Kabupaten Blitar menerangkan bahwa :
                    </p>
                </div>

                <table style="width: 100%; margin: 8px 0 8px 0; border-collapse: collapse;">
                    <tr>
                        <td style="width: 25%; padding: 2px 8px; vertical-align: top;">Nama</td>
                        <td style="width: 2%; padding: 2px 0; vertical-align: top;">:</td>
                        <td style="width: 73%; padding: 2px 8px; vertical-align: top; font-weight: bold;">{{ $surat->form_data['nama'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">NIK</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['nik'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Tempat & Tgl Lahir</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['ttl'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Pekerjaan</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['pekerjaan'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Agama</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['agama'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top; vertical-align: top;">Alamat</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['alamat'] ?? '-' }}</td>
                    </tr>
                </table>

                <div style="margin: 8px 0; text-align: justify;">
                    <p style="margin-bottom: 4px; text-indent: 36pt;">
                        Adalah benar-benar masyarakat miskin tidak mampu dan yang belum mempunyai jaminan kesehatan baik yang iurannya dibiayai pemerintah ataupun mandiri, sementara jika dilihat dari kenyataan dan kondisi perekonomian keluarga yang bersangkutan dalam kondisi miskin tidak mampu.
                    </p>
                    <p style="margin-bottom: 4px; text-indent: 36pt;">
                        Surat Keterangan ini dibuat untuk {{ $surat->form_data['keperluan'] ?? 'pembiayaan Kesehatan Masyarakat Miskin' }}.
                    </p>
                </div>

                <div style="margin: 8px 0; text-align: justify;">
                    <p style="margin-top: 8px; text-indent: 36pt;">
                        Demikian surat keterangan ini kami buat sesuai dengan keadaan yang sebenarnya dan dapat dipergunakan sebagaimana mestinya.
                    </p>
                </div>

            @elseif($surat->jenis_surat == 'kematian')
                <!-- SURAT KETERANGAN KEMATIAN -->
                <div style="margin: 16px 0; text-align: justify;">
                    <p style="text-indent: 36pt; margin-bottom: 12px;">
                        Yang bertanda tangan dibawah ini Kepala Desa Binangun Kecamatan Binangun Kabupaten Blitar Menerangkan bahwa :
                    </p>
                </div>

                <table style="width: 100%; margin: 8px 0 8px 0; border-collapse: collapse;">
                    <tr>
                        <td style="width: 25%; padding: 2px 8px; vertical-align: top;">Nama</td>
                        <td style="width: 2%; padding: 2px 0; vertical-align: top;">:</td>
                        <td style="width: 73%; padding: 2px 8px; vertical-align: top; font-weight: bold;">{{ $surat->form_data['nama'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Jenis Kelamin</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['jenis_kelamin'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top; vertical-align: top;">Alamat</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['alamat'] ?? '-' }}</td>
                    </tr>
                </table>

                <div style="margin: 8px 0; text-align: justify;">
                    <p style="margin-bottom: 4px; text-indent: 36pt;">
                        Orang tersebut diatas adalah penduduk Desa Binangun Kecamatan Binangun Kab. Blitar dan menurut keterangan keluarganya orang tersebut telah meninggal dunia.
                    </p>
                    <p style="margin-bottom: 4px; text-indent: 36pt;">
                        Surat keterangan ini dibuat untuk {{ $surat->form_data['keperluan'] ?? 'persyaratan administrasi' }}.
                    </p>
                </div>

                <div style="margin: 8px 0; text-align: justify;">
                    <p style="margin-top: 8px; text-indent: 36pt; font-size: 10pt; color: #555;">
                        Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya dan apabila di kemudian hari ada ketidaksesuaian dengan data atau keterangan yang disampaikan pemohon, maka segala akibat permasalahan hukum yang ada akan menjadi tanggung jawab pemohon sepenuhnya dan tidak akan melibatkan pihak manapun termasuk pejabat yang menandatangani surat keterangan ini.
                    </p>
                </div>

            @elseif($surat->jenis_surat == 'skck')
                <!-- SURAT PENGANTAR SKCK -->
                <div style="margin: 16px 0; text-align: justify;">
                    <p style="text-indent: 36pt; margin-bottom: 12px;">
                        Yang bertanda tangan dibawah ini kami Kepala Desa Binangun menerangkan bahwa :
                    </p>
                </div>

                <table style="width: 100%; margin: 8px 0 8px 0; border-collapse: collapse;">
                    <tr>
                        <td style="width: 30%; padding: 2px 8px; vertical-align: top;">Nama lengkap</td>
                        <td style="width: 2%; padding: 2px 0; vertical-align: top;">:</td>
                        <td style="width: 68%; padding: 2px 8px; vertical-align: top; font-weight: bold;">{{ $surat->form_data['nama'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Tempat dan tanggal lahir</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['ttl'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Jenis Kelamin</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['jenis_kelamin'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Warga Negara</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['warga_negara'] ?? 'Indonesia' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Agama</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['agama'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Status perkawinan</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['status_perkawinan'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Pendidikan terakhir</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['pendidikan'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">Pekerjaan</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['pekerjaan'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top;">NIK</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['nik'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 8px; vertical-align: top; vertical-align: top;">Tempat Tinggal</td>
                        <td style="padding: 2px 0; vertical-align: top;">:</td>
                        <td style="padding: 2px 8px; vertical-align: top;">{{ $surat->form_data['alamat'] ?? '-' }}</td>
                    </tr>
                </table>

                <div style="margin: 8px 0; text-align: justify;">
                    <p style="margin-bottom: 4px; text-indent: 36pt; font-weight: bold; text-decoration: underline;">
                        ADALAH BENAR :
                    </p>
                    <ul style="list-style: none; padding-left: 36pt; margin: 4px 0;">
                        <li style="margin-bottom: 2px;">- Selama menjadi penduduk Desa Binangun berkelakuan baik</li>
                        <li style="margin-bottom: 2px;">- Selalu ta'at / patuh pada peraturan Pemerintah Desa</li>
                    </ul>
                </div>

                <div style="margin: 8px 0; text-align: justify;">
                    <p style="margin-bottom: 4px; text-indent: 36pt;">
                        Surat Keterangan ini diberikan / dikeluarkan untuk keperluan : <strong>{{ $surat->form_data['keperluan'] ?? 'persyaratan administrasi' }}</strong>
                    </p>
                </div>

                <div style="margin: 8px 0; text-align: justify;">
                    <p style="margin-top: 8px; text-indent: 36pt;">
                        Demikian surat keterangan ini untuk menjadikan periksa dan dipergunakan seperlunya.
                    </p>
                </div>

            @else
                <div style="margin: 16px 0; text-align: justify;">
                    <p style="text-indent: 36pt; margin-bottom: 12px;">
                        Silakan pilih jenis surat yang valid.
                    </p>
                </div>
            @endif

            <!-- ========================================== -->
            <!-- SIGNATURE SECTION - Dynamic Based on Type -->
            <!-- ========================================== -->
            @if($surat->jenis_surat == 'skck')
                <div style="text-align: right; margin-top: 48px;">
                    <div style="margin-bottom: 24px;">
                        Binangun, {{ now()->format('d F Y') }}
                    </div>
                    
                    <div style="display: flex; justify-content: flex-end; gap: 80px; margin-top: 20px;">
                        <div style="text-align: center;">
                            <div style="margin-bottom: 4px;">Pemegang Surat</div>
                            <div style="height: 40px;"></div>
                            <div style="font-weight: bold; text-decoration: underline; font-size: 12pt;">
                                {{ $surat->form_data['nama'] ?? '________________' }}
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <div style="margin-bottom: 4px;">Kepala Desa Binangun</div>
                            <div style="height: 40px;"></div>
                            <div style="font-weight: bold; text-decoration: underline; font-size: 12pt;">
                                H. K A D I
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div style="text-align: right; margin-top: 48px;">
                    <div style="margin-bottom: 24px;">
                        Binangun, {{ now()->format('d F Y') }}
                    </div>
                    
                    <div style="margin-bottom: 16px;">
                        <div style="margin-bottom: 4px;">Kepala Desa Binangun</div>
                        
                        <div style="height: 60px; margin: 8px 0;">
                            @if($surat->user && $surat->user->signature_path)
                                <img src="{{ asset('storage/signatures/' . $surat->user->signature_path) }}" 
                                     alt="Tanda Tangan" 
                                     style="height: 60px; display: inline-block; object-fit: contain;">
                            @else
                                <div style="height: 40px;"></div>
                            @endif
                        </div>
                        
                        <div style="font-weight: bold; text-decoration: underline; text-underline-offset: 2px; font-size: 13pt; margin-top: 4px;">
                            H. K A D I
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- 2. ADMIN ACTIONS (LEFT SIDE) -->
        <div class="md:col-span-1 space-y-6">
            <!-- Review Form -->
            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <h4 class="font-bold text-[#0B2E4F] mb-4 border-b pb-2">Review Keputusan</h4>
                <form action="{{ route('admin.surat.review', $surat) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block font-bold text-gray-700 text-sm mb-1">Status</label>
                        <select name="status" class="w-full p-2 border rounded bg-gray-50" required>
                            <option value="diterima" {{ $surat->status == 'diterima' ? 'selected' : '' }}>Terima</option>
                            <option value="ditolak" {{ $surat->status == 'ditolak' ? 'selected' : '' }}>Tolak</option>
                            <option value="revisi" {{ $surat->status == 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold text-gray-700 text-sm mb-1">Komentar</label>
                        <textarea name="admin_comment" class="w-full p-2 border rounded bg-gray-50" rows="3" placeholder="Pesan untuk pemohon...">{{ $surat->admin_comment }}</textarea>
                    </div>
                    <button type="submit" class="w-full py-2 bg-[#E8A317] text-[#061E33] rounded hover:bg-[#F4C542] font-bold shadow-md">
                        Update Status & Review
                    </button>
                </form>
            </div>

            <!-- Upload Final File -->
            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <h4 class="font-bold text-[#0B2E4F] mb-4 border-b pb-2">Upload Surat Final</h4>
                <p class="text-xs text-gray-500 mb-4 italic">*Unggah di sini setelah surat dicetak dan ditandatangani.</p>
                <form action="{{ route('admin.surat.upload', $surat) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="w-full p-2 border rounded mb-4 text-sm" required>
                    <button type="submit" class="w-full py-2 bg-green-600 text-white rounded hover:bg-green-700 font-bold shadow-md">
                        <i class="fas fa-upload"></i> Upload Surat TTD
                    </button>
                </form>
                @if($surat->file_path)
                    <div class="mt-4 p-3 bg-green-50 rounded border border-green-200 text-center">
                        <a href="{{ asset('storage/' . $surat->file_path) }}" target="_blank" class="text-green-700 font-bold hover:underline text-sm">
                            <i class="fas fa-file-pdf"></i> Lihat Surat Final
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- 3. USER DATA & DOCUMENTS (RIGHT SIDE) -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <h4 class="font-bold text-[#0B2E4F] mb-4 border-b pb-2">Data Pemohon</h4>
                <div class="grid grid-cols-2 gap-y-4 text-sm">
                    <div><label class="text-gray-400 block uppercase text-[10px]">Nama Lengkap</label><p class="font-semibold">{{ $surat->form_data['nama'] ?? '-' }}</p></div>
                    <div><label class="text-gray-400 block uppercase text-[10px]">NIK</label><p class="font-semibold">{{ $surat->form_data['nik'] ?? '-' }}</p></div>
                    <div class="col-span-2"><label class="text-gray-400 block uppercase text-[10px]">Alamat</label><p class="font-semibold">{{ $surat->form_data['alamat'] ?? '-' }}</p></div>
                </div>

                <h4 class="font-bold text-[#0B2E4F] mt-8 mb-4 border-b pb-2">Lampiran Dokumen</h4>
                <div class="flex gap-6 overflow-x-auto pb-2">
                    @if($surat->user->ktp_path)
                        <div class="flex-shrink-0">
                            <p class="text-[10px] text-gray-400 uppercase mb-1">KTP</p>
                            <img src="{{ asset('storage/ktp/' . $surat->user->ktp_path) }}" class="h-32 rounded border shadow-sm">
                        </div>
                    @endif
                    @if($surat->user->signature_path)
                        <div class="flex-shrink-0">
                            <p class="text-[10px] text-gray-400 uppercase mb-1">Tanda Tangan</p>
                            <img src="{{ asset('storage/signatures/' . $surat->user->signature_path) }}" class="h-32 rounded border shadow-sm bg-white object-contain">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    @include('components.surat-comments', ['surat' => $surat])

</div>

<!-- Print Script -->
<script>
function printSurat() {
    var printContents = document.getElementById('printable-surat').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = "<html><head><title>Print Surat</title><style>body{padding:0;margin:0;} @page { size: A4; margin: 0; }</style></head><body>" + printContents + "</body></html>";
    
    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload();
}
</script>
@endsection