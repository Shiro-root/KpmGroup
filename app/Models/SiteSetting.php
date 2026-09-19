<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'type'];

    protected $casts = [
        'value' => 'string',
    ];

    /**
     * Get a setting value by key with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        try {
            $value = Cache::remember("site_setting_{$key}", 3600, function () use ($key) {
                $row = DB::table('site_settings')->where('key', $key)->first();
                return $row ? $row->value : null;
            });

            return $value ?? $default;
        } catch (\Exception $e) {
            return $default;
        }
    }

    /**
     * Set a setting value and clear its cache.
     */
    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): void
    {
        try {
            static::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group, 'type' => $type]
            );
            Cache::forget("site_setting_{$key}");
        } catch (\Exception $e) {
            // Silently fail if table doesn't exist yet
        }
    }
}
