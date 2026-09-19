<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $fillable = [
        'name',
        'file_path',
        'file_type',
        'category',
        'is_public',
        'sort_order',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    // Accessor: category label
    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'akta_notaris' => 'Akta Notaris',
            'sbu'          => 'SBU (Sertifikat Badan Usaha)',
            'npwp'         => 'NPWP',
            'nib'          => 'NIB',
            'siup'         => 'SIUP',
            'tdp'          => 'TDP',
            default        => ucwords(str_replace('_', ' ', $this->category)),
        };
    }

    // Accessor: public URL
    public function getFileUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->latest();
    }
}
