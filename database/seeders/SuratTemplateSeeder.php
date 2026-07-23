<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratTemplate;

class SuratTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'judul' => 'Surat Keterangan Usaha',
                'body' => '
<!-- JUDUL SURAT -->
<h3 style="text-align: center; margin-bottom: 2px;"><strong><u>SURAT KETERANGAN USAHA</u></strong></h3>
<p style="text-align: center; margin-top: 0; margin-bottom: 30px;">Nomor: 474.2 / {{nomor_surat}} / 409.06.05 / 2026</p>

<!-- IDENTITAS PEMBUAT SURAT -->
<p style="margin-left: 20px; margin-bottom: 12px;">Yang bertanda tangan dibawah ini Kepala Desa Binangun Kec.Binangun Kabupaten Blitar menerangkan dengan sebenarnya bahwa :</p>
<!-- IDENTITAS PEMOHON -->
<table style="width: 100%; border-collapse: collapse; margin-left: 20px; margin-bottom: 15px;">
    <tbody>
        <tr>
            <td style="width: 25%; padding: 4px 0;">Nama</td>
            <td style="width: 5%; padding: 4px 0;">:</td>
            <td style="padding: 4px 0;"><strong>{{nama_lengkap}}</strong></td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">NIK</td>
            <td>:</td>
            <td>{{nik}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Umur</td>
            <td>:</td>
            <td>{{umur}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Jenis Kelamin</td>
            <td>:</td>
            <td>{{jenis_kelamin}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Alamat</td>
            <td>:</td>
            <td>{{alamat}}</td>
        </tr>
    </tbody>
</table>

<!-- MAKSUD / KEPERLUAN -->
<p style="margin-left: 20px; margin-bottom: 12px;">Bahwa Menurut Keterangan Yang Bersangkutan Memiliki {{usaha}} yang bertempat di {{alamat}}. 
<!-- PENUTUP SURAT -->
<p style="margin-left: 20px; margin-bottom: 45px; text-align: justify;">
    Surat Keterangan ini dibuat untuk {{alasan}}.
</p>
<p style="margin-left: 20px; margin-bottom: 45px; text-align: justify;">
    Demikian surat keterangan ini harap menjadikan periksa dan dipergunakan sebagaimana mestinya.
</p>

<table style="width: 100%; border-collapse: collapse;">
    <tbody>
        <tr>
            <td style="width: 60%;"></td>
            <!-- Kolom konten tanda tangan di kanan sebesar 40% -->
            <td style="width: 40%; text-align: right;">
                <p style="margin-right: 100px;">Binangun, </p>
                <p style="margin: 0; font-weight: bold; text-transform: uppercase;">Kepala Desa Binangun</p>
                <p style="margin-top: 75px; margin-bottom: 0;"><strong><u>H.KADI</u></strong></p>
            </td>
        </tr>
    </tbody>
</table>
',
                'variables' => [
                    ['name' => 'nomor_surat', 'label' => 'Nomor Surat', 'type' => 'text'],
                    ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text'],
                    ['name' => 'nik', 'label' => 'NIK Pemohon', 'type' => 'number'],
                    ['name' => 'umur', 'label' => 'Umur', 'type' => 'number'],
                    ['name' => 'jenis_kelamin', 'label' => 'Jenis Kelamin', 'type' => 'text'],
                    ['name' => 'alamat', 'label' => 'Alamat', 'type' => 'textarea'],
                    ['name' => 'usaha', 'label' => 'Usaha', 'type' => 'text'],
                    ['name' => 'alasan', 'label' => 'Alasan Pembuatan Surat', 'type' => 'text']
                ]
            ],
            [
                'judul' => 'Surat Keterangan Tidak Mampu',
                'body' => '
<!-- JUDUL SURAT -->
<h3 style="text-align: center; margin-bottom: 2px;"><strong><u> SURAT  KETERANGAN TIDAK MAMPU </u></strong></h3>
<p style="text-align: center; margin-top: 0; margin-bottom: 30px;">Nomor: 474.2 / {{nomor_surat}} / 409.06.05 / 2026</p>

<!-- IDENTITAS PEMBUAT SURAT -->
<p style="margin-left: 20px; margin-bottom: 12px;">Yang bertanda tangan dibawah ini Kepala Desa Binangun Kec.Binangun Kabupaten Blitar, Menerangkan dengan sebenarnya bahwa :</p>
<!-- IDENTITAS PEMOHON -->
<table style="width: 100%; border-collapse: collapse; margin-left: 20px; margin-bottom: 15px;">
    <tbody>
        <tr>
            <td style="width: 25%; padding: 4px 0;">Nama</td>
            <td style="width: 5%; padding: 4px 0;">:</td>
            <td style="padding: 4px 0;"><strong>{{nama_lengkap}}</strong></td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">NIK</td>
            <td>:</td>
            <td>{{nik}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Tempat/Tgl Lahir</td>
            <td>:</td>
            <td>{{tgl_lahir}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Pekerjaan</td>
            <td>:</td>
            <td>{{pekerjaan}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Agama</td>
            <td>:</td>
            <td>{{agama}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Alamat</td>
            <td>:</td>
            <td>{{alamat}}</td>
        </tr>
    </tbody>
</table>

<!-- MAKSUD / KEPERLUAN -->
<p style="margin-left: 20px; margin-bottom: 12px;">Adalah benar-benar warga masyarakat dari keluarga miskin/tidak mampu dan belum mempunyai jaminan kesehatan, baik yang iurannya dibiayai oleh pemerintah maupun secara mandiri. Berdasarkan hasil pengamatan serta kondisi perekonomian yang bersangkutan saat ini, memang berada dalam kategori tidak mampu.</p>
<p style="margin-left: 20px; margin-bottom: 12px;">Surat Keterangan ini dibuat dan diberikan untuk keperluan:</p>
<p style="margin-left: 20px; margin-bottom: 12px;">{{tujuan}}</p>
<p style="margin-left: 20px; margin-bottom: 45px; text-align: justify;">
Demikian surat keterangan ini kami buat sesuai dengan keadaan yang sebenarnya dan dapat dipergunakan sebagaimana mestinya.
</p>

<table style="width: 100%; border-collapse: collapse;">
    <tbody>
        <tr>
            <td style="width: 50%; text-align: right; vertical-align: top;">
                <p style="margin-right: 100px;">Binangun, </p>
                <p style="margin: 0; font-weight: bold; text-transform: uppercase;">Kepala Desa Binangun</p>
                <p style="margin-top: 90px; margin-bottom: 0;"><strong><u>H.KADI</u></strong></p>
            </td>
        </tr>
    </tbody>
</table>
',
                'variables' => [
                    ['name' => 'nomor_surat', 'label' => 'Nomor Surat', 'type' => 'text'],
                    ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text'],
                    ['name' => 'nik', 'label' => 'NIK Pemohon', 'type' => 'number'],
                    ['name' => 'tgl_lahir', 'label' => 'Tempat & Tanggal Lahir', 'type' => 'text'],
                    ['name' => 'agama', 'label' => 'Agama', 'type' => 'text'],
                    ['name' => 'pekerjaan', 'label' => 'Pekerjaan', 'type' => 'text'],
                    ['name' => 'alamat', 'label' => 'Alamat', 'type' => 'textarea'],
                    ['name' => 'tujuan', 'label' => 'Tujuan Pengajuan', 'type' => 'textarea'],
                ]
            ],
            [
                'judul' => 'Surat Pengantar SKCK',
                'body' => '
<!-- JUDUL SURAT -->
<h3 style="text-align: center; margin-bottom: 2px;"><strong><u>SURAT PENGANTAR SKCK</u></strong></h3>
<p style="text-align: center; margin-top: 0; margin-bottom: 30px;">Nomor: 474.2 / {{nomor_surat}} / 409.06.05 / 2026</p>

<!-- IDENTITAS PEMBUAT SURAT -->
<p style="margin-left: 20px; margin-bottom: 12px;">Yang bertanda tangan dibawah ini Kepala Desa Binangun Kec.Binangun Kabupaten Blitar, Menerangkan dengan sebenarnya bahwa :</p>
<!-- IDENTITAS PEMOHON -->
<table style="width: 100%; border-collapse: collapse; margin-left: 20px; margin-bottom: 15px;">
    <tbody>
        <tr>
            <td style="width: 25%; padding: 4px 0;">Nama Lengkap</td>
            <td style="width: 5%; padding: 4px 0;">:</td>
            <td style="padding: 4px 0;"><strong>{{nama_lengkap}}</strong></td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Tempat/Tgl Lahir</td>
            <td>:</td>
            <td>{{tgl_lahir}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Jenis Kelamin</td>
            <td>:</td>
            <td>{{jenis_kelamin}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Warga Negara</td>
            <td>:</td>
            <td>{{warga_negara}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Agama</td>
            <td>:</td>
            <td>{{agama}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Status Perkawinan</td>
            <td>:</td>
            <td>{{status_perkawinan}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Pendidikan Terakhir</td>
            <td>:</td>
            <td>{{pendidikan_terakhir}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Pekerjaan</td>
            <td>:</td>
            <td>{{pekerjaan}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">NIK</td>
            <td>:</td>
            <td>{{nik}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Tempat Tinggal</td>
            <td>:</td>
            <td>{{tempat_tinggal}}</td>
        </tr>
    </tbody>
</table>

<!-- MAKSUD / KEPERLUAN -->
<p style="margin-left: 20px; margin-bottom: 12px;"><strong><u>ADALAH BENAR</u></strong></p>
<table style="width: 100%; border-collapse: collapse; margin-left: 20px; margin-bottom: 25px;">
    <tbody>
        <tr>
        <td style="padding: 4px 0; font-weight: bold;">- Selama menjadi penduduk Desa Binangun berkelakuan baik</td>
        </tr>
        <tr>
        <td style="padding: 4px 0; font-weight: bold;">- Selalu taat / patuh pada peraturan Pemerintahan Desa</td>
        </tr>
    </tbody>
</table>
<p style="margin-left: 20px; margin-bottom: 12px;"> Surat keterangan ini diberikan / dikeluarkan untuk keperluan: {{keperluan}} </p>
<!-- PENUTUP SURAT -->
<p style="margin-left: 20px; margin-bottom: 45px; text-align: justify;">
    Demikian Surat Keterangan ini untuk menjadikan periksa dan dipergunakan seperlunya.
</p>

<!-- DOUBLE TANDA TANGAN (PEMOHON DAN KEPALA DESA) -->
<table style="width: 100%; border-collapse: collapse;">
    <tbody>
        <tr>
            <!-- Kolom TTD Pemohon di Kiri -->
            <td style="width: 50%; text-align: left; vertical-align: top;">
                <p style="margin: 0;">&nbsp;</p>
                <p style="margin-left: 60px; font-weight: bold;">Pemegang Surat</p>
                <p>{{tanda_tangan}}</p>
                <p style="margin-top: 20px ; margin-left: 60px; margin-bottom: 0;"><strong>{{nama_lengkap}}</strong></p>
            </td>
            <!-- Kolom TTD Kepala Desa di Kanan -->
            <td style="width: 50%; text-align: right; vertical-align: top;">
                <p style="margin-right: 100px;">Binangun, </p>
                <p style="margin: 0; font-weight: bold; text-transform: uppercase;">Kepala Desa Binangun</p>
                <p style="margin-top: 90px; margin-bottom: 0;"><strong><u>H.KADI</u></strong></p>
            </td>
        </tr>
    </tbody>
</table>
',
                'variables' => [
                    ['name' => 'nomor_surat', 'label' => 'Nomor Surat', 'type' => 'text'],
                    ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text'],
                    ['name' => 'nik', 'label' => 'NIK Pemohon', 'type' => 'number'],
                    ['name' => 'tgl_lahir', 'label' => 'Tempat & Tanggal Lahir', 'type' => 'text'],
                    ['name' => 'jenis_kelamin', 'label' => 'Jenis Kelamin', 'type' => 'text'],
                    ['name' => 'warga_negara', 'label' => 'Warga Negara', 'type' => 'text'],
                    ['name' => 'agama', 'label' => 'Agama', 'type' => 'text'],
                    ['name' => 'status_perkawinan', 'label' => 'Status Perkawinan', 'type' => 'text'],
                    ['name' => 'pendidikan_terakhir', 'label' => 'Pendidikan Terakhir', 'type' => 'text'],
                    ['name' => 'pekerjaan', 'label' => 'Pekerjaan', 'type' => 'text'],
                    ['name' => 'tempat_tinggal', 'label' => 'Tempat Tinggal / Alamat', 'type' => 'textarea'],
                    ['name' => 'keperluan', 'label' => 'Keperluan (Contoh: Melamar Pekerjaan PT. X)', 'type' => 'textarea'],
                    ['name' => 'tanda_tangan', 'label' => 'Tanda Tangan Pemohon', 'type' => 'signature'],
                ]
            ],
            [
                'judul' => 'Surat Keterangan Kematian',
                'body' => '
                    <!-- JUDUL SURAT -->
<h3 style="text-align: center; margin-bottom: 2px;"><strong><u>SURAT KETERANGAN KEMATIAN</u></strong></h3>
<p style="text-align: center; margin-top: 0; margin-bottom: 30px;">Nomor: 474.3 / {{nomor_surat}} / 409.06.05 / 2026</p>

<!-- IDENTITAS PEMBUAT SURAT -->
<p style="margin-left: 20px; margin-bottom: 12px;">Yang bertanda tangan dibawah ini:</p>
<table style="width: 100%; border-collapse: collapse; margin-left: 20px; margin-bottom: 15px;">
    <tbody>
        <tr>
            <td style="width: 25%; padding: 4px 0;">Nama</td>
            <td style="width: 5%; padding: 4px 0;">:</td>
            <td style="padding: 4px 0;"><strong>H. KADI</strong></td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Jabatan</td>
            <td>:</td>
            <td><strong>Kepala Desa Binangun</strong></td>
        </tr>
    </tbody>
</table>

<!-- IDENTITAS YANG MENINGGAL -->
<p style="margin-left: 20px">Dengan ini menerangkan bahwa:</p>
<table style="width: 100%; border-collapse: collapse; margin-left: 20px; margin-bottom: 15px;">
    <tbody>
        <tr>
            <td style="width: 25%; padding: 4px 0;">Nama</td>
            <td style="width: 5%; padding: 4px 0;">:</td>
            <td style="padding: 4px 0;"><strong>{{nama}}</strong></td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">NIK</td>
            <td>:</td>
            <td>{{nik}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Tempat/Tgl Lahir</td>
            <td>:</td>
            <td>{{Tgl_lahir}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Umur</td>
            <td>:</td>
            <td>{{umur}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Jenis Kelamin</td>
            <td>:</td>
            <td>{{jenis_kelamin}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Alamat Terakhir</td>
            <td>:</td>
            <td>{{alamat}}</td>
        </tr>
    </tbody>
</table>

<!-- KETERANGAN KEMATIAN -->
<p style="margin-left: 20px">Telah meninggal dunia pada:</p>
<table style="width: 100%; border-collapse: collapse; margin-left: 20px; margin-bottom: 15px;">
    <tbody>
        <tr>
            <td style="width: 25%; padding: 4px 0;">Hari</td>
            <td style="width: 5%; padding: 4px 0;">:</td>
            <td style="padding: 4px 0;">{{hari_meninggal}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Tanggal</td>
            <td>:</td>
            <td>{{tanggal_meninggal}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Tempat Meninggal</td>
            <td>:</td>
            <td>{{tempat_meninggal}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Tempat Pemakaman</td>
            <td>:</td>
            <td>{{tempat_pemakaman}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Disebabkan karena</td>
            <td>:</td>
            <td>{{penyebab_meninggal}}</td>
        </tr>
    </tbody>
</table>

<!-- KETERANGAN PELAPOR -->
<p style="margin-left: 20px">Surat keterangan ini dibuat atas dasar laporan dari:</p>
<table style="width: 100%; border-collapse: collapse; margin-left: 20px; margin-bottom: 25px;">
    <tbody>
        <tr>
            <td style="width: 25%; padding: 4px 0;">Nama</td>
            <td style="width: 5%; padding: 4px 0;">:</td>
            <td style="padding: 4px 0;">{{nama_pelapor}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Hubungan/Selaku</td>
            <td>:</td>
            <td>{{hubungan}}</td>
        </tr>
    </tbody>
</table>

<!-- PENUTUP SURAT -->
<p style="margin-left: 20px;margin-bottom: 40px; text-indent: 40px; text-align: justify;">
    Demikian Surat Keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
</p>

<!-- TANDA TANGAN -->
<table style="width: 100%; border-collapse: collapse;">
    <tbody>
        <tr>
            <td style="width: 40%; text-align: right;">
                <p style="margin-right: 100px;">Binangun, </p>
                <p style="margin: 0;">Kepala Desa Binangun</p>
                <p style="margin-top: 70px; margin-bottom: 0;"><strong><u>H.KADI</u></strong></p>
            </td>
        </tr>
    </tbody>
</table>

                ',
                'variables' => [
                    ['name' => 'nomor_surat', 'label' => 'Nomor Surat', 'type' => 'text'],
                    ['name' => 'nama', 'label' => 'Nama Almarhum/ah', 'type' => 'text'],
                    ['name' => 'nik', 'label' => 'NIK Almarhum/ah', 'type' => 'number'],
                    ['name' => 'Tgl_lahir', 'label' => 'Hari & Tanggal Lahir', 'type' => 'text'],
                    ['name' => 'umur', 'label' => 'Umur', 'type' => 'number'],
                    ['name' => 'jenis_kelamin', 'label' => 'Jenis Kelamin', 'type' => 'text'],
                    ['name' => 'alamat', 'label' => 'Alamat Terakhir', 'type' => 'textarea'],
                    ['name' => 'hari_meninggal', 'label' => 'Hari Meninggal', 'type' => 'text'],
                    ['name' => 'tanggal_meninggal', 'label' => 'Tanggal Meninggal', 'type' => 'text'],
                    ['name' => 'tempat_meninggal', 'label' => 'Tempat Meninggal (Cth: RSUD/Rumah)', 'type' => 'text'],
                    ['name' => 'tempat_pemakaman', 'label' => 'Tempat Pemakaman', 'type' => 'text'],
                    ['name' => 'penyebab_meninggal', 'label' => 'Penyebab Meninggal', 'type' => 'text'],
                    ['name' => 'nama_pelapor', 'label' => 'Nama Pelapor', 'type' => 'text'],
                    ['name' => 'hubungan', 'label' => 'Hubungan dengan Almarhum/ah', 'type' => 'text']
                ]
            ],
            [
                'judul' => 'Surat Keterangan Pengantar Kehilangan',
                'body' => '
<!-- JUDUL SURAT -->
<h3 style="text-align: center; margin-bottom: 2px;"><strong><u>SURAT KETERANGAN PENGANTAR</u></strong></h3>
<p style="text-align: center; margin-top: 0; margin-bottom: 30px;">Nomor: 474.4 / {{nomor_surat}} / 409.06.05 / 2026</p>

<!-- IDENTITAS PEMBUAT SURAT -->
<p style="margin-left: 20px; margin-bottom: 12px;">Yang bertanda tangan dibawah ini Kepala Desa Binangun Kec.Binangun Kabupaten Blitar, M   enerangkan dengan sebenarnya bahwa :</p>

<!-- IDENTITAS PELAPOR -->
<table style="width: 100%; border-collapse: collapse; margin-left: 20px; margin-bottom: 15px;">
    <tbody>
        <tr>
            <td style="width: 25%; padding: 4px 0;">Nama</td>
            <td style="width: 5%; padding: 4px 0;">:</td>
            <td style="padding: 4px 0;"><strong>{{nama_pelapor}}</strong></td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">NIK</td>
            <td>:</td>
            <td>{{nik_pelapor}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Tempat/Tgl Lahir</td>
            <td>:</td>
            <td>{{tgl_lahir}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Jenis Kelamin</td>
            <td>:</td>
            <td>{{jenis_kelamin}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Status</td>
            <td>:</td>
            <td>{{status}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Pekerjaan</td>
            <td>:</td>
            <td>{{pekerjaan}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Agama</td>
            <td>:</td>
            <td>{{agama}}</td>
        </tr>
        <tr>
            <td style="padding: 4px 0;">Alamat</td>
            <td>:</td>
            <td>{{alamat}}</td>
        </tr>
    </tbody>
</table>

<!-- KETERANGAN KEHILANGAN -->
<p style="margin-left: 20px; margin-bottom: 12px;">Yang bersangkutan adalah benar warga desa binangun dan menurut keterangan yang bersangkutan Telah kehilangan {{benda_hilang}}.</p>
<p style="margin-left: 20px; margin-bottom: 12px;">Surat keterangan ini dibuat untuk pengantar kehilangan {{benda_hilang}} di Polsek Binangun</p>
<!-- PENUTUP SURAT -->
<p style="margin-left: 20px; margin-bottom: 45px; text-indent: 40px; text-align: justify;">
    Demikian surat keterangan ini dibuat untuk menjadikan periksa dan dipergunakan sebagaimana mestinya.
</p>

<!-- TANDA TANGAN -->
<table style="width: 100%; border-collapse: collapse;">
    <tbody>
        <tr>
            <!-- Kolom kosong di kiri sebesar 60% sebagai pendorong -->
            <td style="width: 60%;"></td>
            <!-- Kolom konten tanda tangan di kanan sebesar 40% -->
            <td style="width: 40%; text-align: left;">
                <p style="margin-right: 100px;">Binangun, </p>
                <p style="margin: 0; font-weight: bold; text-transform: uppercase;">Kepala Desa Binangun</p>
                <p style="margin-top: 75px; margin-bottom: 0;"><strong><u>H.KADI</u></strong></p>
            </td>
        </tr>
    </tbody>
</table>
',
                'variables' => [
                    ['name' => 'nomor_surat', 'label' => 'Nomor Surat', 'type' => 'text'],
                    ['name' => 'nama_pelapor', 'label' => 'Nama Pelapor', 'type' => 'text'],
                    ['name' => 'nik_pelapor', 'label' => 'NIK Pelapor', 'type' => 'number'],
                    ['name' => 'tgl_lahir', 'label' => 'Tempat & Tanggal Lahir', 'type' => 'text'],
                    ['name' => 'jenis_kelamin', 'label' => 'Jenis Kelamin', 'type' => 'text'],
                    ['name' => 'status', 'label' => 'Status', 'type' => 'text'],
                    ['name' => 'pekerjaan', 'label' => 'Pekerjaan', 'type' => 'text'],
                    ['name' => 'agama', 'label' => 'Agama', 'type' => 'text'],
                    ['name' => 'alamat', 'label' => 'Alamat Lengkap', 'type' => 'textarea'],
                    ['name' => 'benda_hilang', 'label' => 'Benda / Dokumen yang Hilang', 'type' => 'textarea']
                ]
            ]

        ];

        foreach ($templates as $template) {
            SuratTemplate::create($template);
        }
    }
}
