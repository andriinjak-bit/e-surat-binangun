<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penduduk;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rts = ['01', '02', '03', '04', '05'];
        $rws = ['01', '02'];
        
        for ($i = 1; $i <= 30; $i++) {
            $rt = $rts[array_rand($rts)];
            $rw = $rws[array_rand($rws)];
            
            Penduduk::create([
                'no_kk' => '3505' . str_pad($i, 12, '0', STR_PAD_LEFT),
                'nik' => '3505' . str_pad($i, 12, '0', STR_PAD_LEFT),
                'nama' => 'Warga Sampel ' . $i,
                'jenis_kelamin' => $i % 2 == 0 ? 'Perempuan' : 'Laki-laki',
                'tempat_tanggal_lahir' => 'Blitar, ' . rand(1, 28) . ' Jan ' . rand(1950, 2010),
                'pekerjaan' => 'Petani/Pekebun',
                'agama' => 'Islam',
                'pendidikan' => 'SLTA / Sederajat',
                'status' => 'Belum Kawin',
                'shdk' => 'Anak',
                'alamat' => 'Dusun Binangun RT ' . $rt . ' RW ' . $rw,
                'rt' => $rt,
                'rw' => $rw,
            ]);
        }
    }
}
