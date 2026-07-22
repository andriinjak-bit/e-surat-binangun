<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratRequest extends Model
{
    protected $fillable = [
        'surat_template_id',
        'user_id',
        'status',
        'form_data',
    ];

    protected $casts = [
        'form_data' => 'array',
    ];

    public function template()
    {
        return $this->belongsTo(SuratTemplate::class, 'surat_template_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(SuratComment::class, 'surat_id');
    }
}
