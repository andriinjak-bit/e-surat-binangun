<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $fillable = [
        'no_kk',
        'nik',
        'nama',
        'usia',
        'jenis_kelamin',
        'tempat_tanggal_lahir',
        'pekerjaan',
        'agama',
        'pendidikan',
        'status',
        'shdk',
        'alamat',
        'rt',
        'rw',
    ];

    public function getUsiaAttribute()
    {
        try {
            if (!$this->tempat_tanggal_lahir) return 0;
            
            $parts = explode(', ', $this->tempat_tanggal_lahir);
            if (count($parts) < 2) return 0;

            $dateStr = $parts[1]; // e.g. "10 Jan 1980"
            $months = [
                'Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr', 'Mei' => 'May', 'Jun' => 'Jun',
                'Jul' => 'Jul', 'Agu' => 'Aug', 'Sep' => 'Sep', 'Okt' => 'Oct', 'Nov' => 'Nov', 'Des' => 'Dec',
                'Januari' => 'January', 'Februari' => 'February', 'Maret' => 'March', 'April' => 'April', 
                'Agustus' => 'August', 'September' => 'September', 'Oktober' => 'October', 'November' => 'November', 'Desember' => 'December'
            ];
            
            $dateEn = str_replace(array_keys($months), array_values($months), $dateStr);
            return \Carbon\Carbon::parse($dateEn)->age;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
