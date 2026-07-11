<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Contracts\Queue\ShouldQueue;

class PendudukImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Hindari error jika NIK kosong
        if (!isset($row['nik'])) {
            return null;
        }

        return new Penduduk([
            'no_kk' => $row['no_kk'] ?? '',
            'nik' => $row['nik'],
            'nama' => $row['nama'] ?? '',
            'usia' => $row['usia'] ?? 0,
            'jenis_kelamin' => $row['jenis_kelamin'] ?? 'Laki-laki',
            'tempat_tanggal_lahir' => $row['tempat_tanggal_lahir'] ?? '',
            'pekerjaan' => $row['pekerjaan'] ?? '',
            'agama' => $row['agama'] ?? '',
            'pendidikan' => $row['pendidikan'] ?? '',
            'status' => $row['status'] ?? '',
            'shdk' => $row['shdk'] ?? '',
            'alamat' => $row['alamat'] ?? '',
            'rt' => $row['rt'] ?? '',
            'rw' => $row['rw'] ?? '',
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
