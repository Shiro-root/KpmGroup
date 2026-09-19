<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'division',
        'tagline',
        'short_description',
        'full_description',
        'sub_services',
        'icon_svg',
        'logo',
        'cover_image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'sub_services' => 'array',
    ];

    /*
    |------------------------------------------------------------------
    | Scopes
    |------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /*
    |------------------------------------------------------------------
    | Accessors
    |------------------------------------------------------------------
    */

    public function getLogoUrlAttribute(): string
    {
        if ($this->logo) {
            return \Illuminate\Support\Facades\Storage::url($this->logo);
        }
        return asset('images/kpm-logo.png');
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image
            ? \Illuminate\Support\Facades\Storage::url($this->cover_image)
            : null;
    }
}
