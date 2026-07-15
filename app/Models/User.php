<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nik',
        'email',
        'password',
        'is_admin',
        'is_active',
        'phone',
        'dusun',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'agama',
        'pendidikan',
        'status_perkawinan',
        'shdk',
        'no_kk',
        'rt',
        'rw',
        'profile_picture',
        'signature_path',
        'ktp_path',
        'kk_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
        'tanggal_lahir' => 'date',
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }

    public function isAdmin()
    {
        return $this->is_admin === true;
    }

    public function suratComments()
{
    return $this->hasMany(SuratComment::class);
}
}