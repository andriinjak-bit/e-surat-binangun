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

        // Process tempat_tanggal_lahir if it exists
        $tempat_lahir = '';
        $tanggal_lahir = '2000-01-01'; // fallback

        if (isset($row['tempat_tanggal_lahir'])) {
            $parts = explode(',', $row['tempat_tanggal_lahir']);
            if (count($parts) >= 2) {
                $tempat_lahir = trim($parts[0]);
                $dateStr = trim($parts[1]);
                $months = [
                    'Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04', 'Mei' => '05', 'Jun' => '06',
                    'Jul' => '07', 'Agu' => '08', 'Sep' => '09', 'Okt' => '10', 'Nov' => '11', 'Des' => '12',
                    'Januari' => '01', 'Februari' => '02', 'Maret' => '03', 'April' => '04', 
                    'Agustus' => '08', 'September' => '09', 'Oktober' => '10', 'November' => '11', 'Desember' => '12'
                ];
                $dateEn = str_replace(array_keys($months), array_values($months), $dateStr);
                try {
                    $tanggal_lahir = \Carbon\Carbon::parse($dateEn)->format('Y-m-d');
                } catch (\Exception $e) {
                    // Fallback
                }
            } else {
                $tempat_lahir = trim($parts[0]);
            }
        }

        $jenis_kelamin = 1;
        if (isset($row['jenis_kelamin'])) {
            $jk = strtolower(trim($row['jenis_kelamin']));
            if ($jk === 'perempuan' || $jk === 'p') {
                $jenis_kelamin = 2;
            }
        }

        return new Penduduk([
            'no_kk' => $row['no_kk'] ?? '',
            'nik' => $row['nik'],
            'nama' => $row['nama'] ?? '',
            'jenis_kelamin' => $jenis_kelamin,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'pekerjaan' => $row['pekerjaan'] ?? '',
            'agama' => $row['agama'] ?? '',
            'pendidikan' => $row['pendidikan'] ?? '',
            'status_pernikahan' => $row['status'] ?? ($row['status_pernikahan'] ?? ''),
            'shdk' => $row['shdk'] ?? '',
            'alamat' => $row['alamat'] ?? '',
            'dusun' => $row['dusun'] ?? '',
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
