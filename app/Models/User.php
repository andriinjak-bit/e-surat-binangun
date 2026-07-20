<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nik',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['penduduk'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function penduduk()
    {
        return $this->hasOne(Penduduk::class, 'nik', 'nik');
    }

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