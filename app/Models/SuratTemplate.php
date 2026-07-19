<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTemplate extends Model
{
    /** @use HasFactory<\Database\Factories\SuratTemplateFactory> */
    protected $fillable = [
        'judul',
        'body',
        'variables',
    ];

    protected $casts = [
        'variables' => 'array',
    ];

    public function requests()
    {
        return $this->hasMany(SuratRequest::class);
    }
}