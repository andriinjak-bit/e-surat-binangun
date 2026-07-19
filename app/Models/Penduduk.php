<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'no_kk',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'dusun',
        'rt',
        'rw',
        'pekerjaan',
        'agama',
        'pendidikan',
        'status_pernikahan',
        'shdk',
        'ktp_path',
        'kk_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }

    public function getUsiaAttribute()
    {
        if ($this->tanggal_lahir) {
            return \Carbon\Carbon::parse($this->tanggal_lahir)->age;
        }
        return 0;
    }
}
