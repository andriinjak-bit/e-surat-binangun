@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-[#0B2E4F] mb-6">Pratinjau Surat</h1>

    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
        <p class="text-yellow-700">
            <i class="fas fa-exclamation-triangle"></i> 
            Periksa kembali data di bawah ini. Jika sudah benar, klik <strong>"Kirim Surat"</strong>.
        </p>
    </div>

    <!-- The actual "Paper" container -->
    <div id="printable-surat" class="bg-white mx-auto shadow-2xl p-[2cm] text-black" style="width: 210mm; min-height: 297mm; font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.6;">
        
        <!-- ========================================== -->
        <!-- HEADER WITH LOGO KABUPATEN BLITAR -->
        <!-- ========================================== -->
        <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 4px;">
            <!-- Logo -->
            <div style="flex: 0 0 100px; text-align: center;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/94/Lambang_Kabupaten_Blitar.webp" 
                     alt="Logo Kabupaten Blitar" 
                     style="width: 85px; height: auto; display: block; margin: 0 auto;">
            </div>
            
            <!-- Text -->
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

            <!-- Data Table -->
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

            <!-- Keterangan Hilang -->
            <div style="margin: 8px 0; text-align: justify;">
                <p style="margin-bottom: 4px; text-indent: 36pt;">
                    Yang bersangkutan adalah benar warga Desa Binangun dan menurut keterangan yang bersangkutan Telah Kehilangan <strong>{{ $surat->form_data['dokumen_hilang'] ?? 'dokumen' }}</strong>
                </p>
                <p style="margin-bottom: 4px; text-indent: 36pt;">
                    Surat Keterangan ini dibuat untuk {{ $surat->form_data['keperluan'] ?? 'pengantar kehilangan' }}.
                </p>
            </div>

            <!-- Penutup -->
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

            <!-- Data Table -->
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

            <!-- Business Info -->
            <div style="margin: 8px 0; text-align: justify;">
                <p style="margin-bottom: 4px; text-indent: 36pt;">
                    Bahwa Menurut Keterangan Yang Bersangkutan Memiliki <strong>Usaha {{ strtoupper($surat->form_data['usaha'] ?? '') }}</strong>
                </p>
                <p style="margin-bottom: 4px; text-indent: 36pt;">
                    yang bertempat di <strong>{{ $surat->form_data['lokasi_usaha'] ?? '' }}</strong> Desa Binangun Kec. Binangun Kab. Blitar.
                </p>
            </div>

            <!-- Purpose -->
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

            <!-- Data Table -->
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

            <!-- Keterangan -->
            <div style="margin: 8px 0; text-align: justify;">
                <p style="margin-bottom: 4px; text-indent: 36pt;">
                    Adalah benar-benar masyarakat miskin tidak mampu dan yang belum mempunyai jaminan kesehatan baik yang iurannya dibiayai pemerintah ataupun mandiri, sementara jika dilihat dari kenyataan dan kondisi perekonomian keluarga yang bersangkutan dalam kondisi miskin tidak mampu.
                </p>
                <p style="margin-bottom: 4px; text-indent: 36pt;">
                    Surat Keterangan ini dibuat untuk {{ $surat->form_data['keperluan'] ?? 'pembiayaan Kesehatan Masyarakat Miskin' }}.
                </p>
            </div>

            <!-- Penutup -->
            <div style="margin: 8px 0; text-align: justify;">
                <p style="margin-top: 8px; text-indent: 36pt;">
                    Demikian surat keterangan ini kami buat sesuai dengan keadaan yang sebenarnya dan dapat dipergunakan sebagaimana mestinya.
                </p>
            </div>

            <!-- Keterangan Tambahan -->
            @if(!empty($surat->form_data['keterangan_tambahan']))
                <div style="margin: 8px 0; text-align: justify; font-style: italic;">
                    <p style="text-indent: 36pt; color: #555;">
                        Catatan: {{ $surat->form_data['keterangan_tambahan'] }}
                    </p>
                </div>
            @endif

        @elseif($surat->jenis_surat == 'kematian')
            <!-- SURAT KETERANGAN KEMATIAN -->
            <div style="margin: 16px 0; text-align: justify;">
                <p style="text-indent: 36pt; margin-bottom: 12px;">
                    Yang bertanda tangan dibawah ini Kepala Desa Binangun Kecamatan Binangun Kabupaten Blitar Menerangkan bahwa :
                </p>
            </div>

            <!-- Data Table -->
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

            <!-- Data Table -->
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

            <!-- Keterangan -->
            <div style="margin: 8px 0; text-align: justify;">
                <p style="margin-bottom: 4px; text-indent: 36pt; font-weight: bold; text-decoration: underline;">
                    ADALAH BENAR :
                </p>
                <ul style="list-style: none; padding-left: 36pt; margin: 4px 0;">
                    <li style="margin-bottom: 2px;">- Selama menjadi penduduk Desa Binangun berkelakuan baik</li>
                    <li style="margin-bottom: 2px;">- Selalu ta'at / patuh pada peraturan Pemerintah Desa</li>
                </ul>
            </div>

            <!-- Keperluan -->
            <div style="margin: 8px 0; text-align: justify;">
                <p style="margin-bottom: 4px; text-indent: 36pt;">
                    Surat Keterangan ini diberikan / dikeluarkan untuk keperluan : <strong>{{ $surat->form_data['keperluan'] ?? 'persyaratan administrasi' }}</strong>
                </p>
            </div>

            <!-- Penutup -->
            <div style="margin: 8px 0; text-align: justify;">
                <p style="margin-top: 8px; text-indent: 36pt;">
                    Demikian surat keterangan ini untuk menjadikan periksa dan dipergunakan seperlunya.
                </p>
            </div>

        @else
            <!-- Default/Other Surat Types -->
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
                        @if(isset($user) && $user->signature_path)
                            <img src="{{ asset('storage/signatures/' . $user->signature_path) }}" 
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

    <!-- ========================================== -->
    <!-- SUBMIT BUTTONS -->
    <!-- ========================================== -->
    <div class="mt-6 flex flex-wrap gap-4">
        <form action="{{ route('surat.confirm', $surat) }}" method="POST">
            @csrf
            <button type="submit" class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-bold text-lg">
                <i class="fas fa-check-circle"></i> Kirim Surat
            </button>
        </form>
        
        <form action="{{ route('surat.revisi', $surat) }}" method="POST">
            @csrf
            <button type="submit" class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 font-bold">
                <i class="fas fa-edit"></i> Revisi Data
            </button>
        </form>
        
        <a href="{{ route('surat.create') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-bold">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection