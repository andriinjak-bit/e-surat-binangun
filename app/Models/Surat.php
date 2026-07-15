<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_surat',
        'data',
        'form_data',
        'status',
        'keterangan',
        'admin_note',
        'admin_comment',
        'file_path',
        'verified_at',
        'reviewed_at',
        'accepted_at',
        'rejected_at',
    ];

    protected $casts = [
        'data' => 'array',
        'form_data' => 'array',
        'verified_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'accepted_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
{
    return $this->hasMany(SuratComment::class)->orderBy('created_at', 'asc');
}
    public function getStatusLabelAttribute()
    {
        return [
            'pending' => 'Menunggu Verifikasi',
            'diproses' => 'Sedang Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            'revisi' => 'Perlu Revisi',
            'diterima' => 'Diterima',
        ][$this->status] ?? $this->status;
    }

    public function getStatusBadgeAttribute()
    {
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'diproses' => 'bg-blue-100 text-blue-800',
            'selesai' => 'bg-green-100 text-green-800',
            'ditolak' => 'bg-red-100 text-red-800',
            'revisi' => 'bg-orange-100 text-orange-800',
            'diterima' => 'bg-green-100 text-green-800',
        ];
        
        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }
}