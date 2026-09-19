<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'type'];

    protected $casts = [
        'value' => 'string',
    ];

    /** Memo per-request agar tidak menyentuh cache store berulang kali. */
    protected static ?array $memo = null;

    protected static function booted(): void
    {
        // Seeder / updateOrCreate langsung tetap membersihkan cache.
        static::saved(fn () => static::flush());
        static::deleted(fn () => static::flush());
    }

    /**
     * Semua setting (key => value) dalam 1 query, lalu di-cache.
     */
    public static function allCached(): array
    {
        if (static::$memo !== null) {
            return static::$memo;
        }

        try {
            return static::$memo = Cache::rememberForever('site_settings.all', function () {
                return static::query()->pluck('value', 'key')->all();
            });
        } catch (\Exception $e) {
            // Tabel belum ada / DB belum siap — jangan cache kegagalan.
            return [];
        }
    }

    /**
     * Get a setting value by key with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $value = static::allCached()[$key] ?? null;

        return $value ?? $default;
    }

    /**
     * Set a setting value and clear its cache.
     */
    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): void
    {
        static::setMany([$key => $value], $group, $type);
    }

    /**
     * Simpan banyak setting sekaligus (1 query upsert).
     */
    public static function setMany(array $values, string $group = 'general', string $type = 'text'): void
    {
        if (empty($values)) {
            return;
        }

        try {
            $now  = now();
            $rows = [];

            foreach ($values as $key => $value) {
                $rows[] = [
                    'key'        => $key,
                    'value'      => (string) ($value ?? ''),
                    'group'      => $group,
                    'type'       => $type,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            static::upsert($rows, ['key'], ['value', 'group', 'type', 'updated_at']);
            static::flush();
        } catch (\Exception $e) {
            // Silently fail if table doesn't exist yet
        }
    }

    public static function flush(): void
    {
        static::$memo = null;
        Cache::forget('site_settings.all');
    }
}