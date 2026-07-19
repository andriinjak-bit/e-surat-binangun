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
                'nik' => '3505' . str_pad(rand(1, 9999), 12, '0', STR_PAD_LEFT),
                'no_kk' => '3505' . str_pad(rand(1, 9999), 12, '0', STR_PAD_LEFT),
                'nama' => 'Warga Sampel ' . $i,
                'jenis_kelamin' => $i % 2 == 0 ? 2 : 1, // 1: Laki-laki, 2: Perempuan
                'tempat_lahir' => 'Blitar',
                'tanggal_lahir' => rand(1950, 2010) . '-01-' . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT),
                'pekerjaan' => 'Petani/Pekebun',
                'agama' => 'Islam',
                'pendidikan' => 'SLTA / Sederajat',
                'status_pernikahan' => 'Belum Kawin',
                'shdk' => 'Anak',
                'alamat' => 'Dusun Binangun RT ' . $rt . ' RW ' . $rw,
                'dusun' => 'Binangun',
                'rt' => $rt,
                'rw' => $rw,
            ]);
        }
    }
}
