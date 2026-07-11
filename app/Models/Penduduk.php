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
}
