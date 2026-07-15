<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratComment extends Model
{
    protected $fillable = [
        'surat_id',
        'user_id',
        'message',
        'attachment_path',
        'is_admin',
        'status',
        'read_at',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'read_at' => 'datetime',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getSenderNameAttribute()
    {
        return $this->user->name ?? 'Unknown';
    }

    public function getSenderRoleAttribute()
    {
        return $this->is_admin ? 'Admin' : 'User';
    }

    public function getSenderBadgeAttribute()
    {
        return $this->is_admin ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800';
    }
}