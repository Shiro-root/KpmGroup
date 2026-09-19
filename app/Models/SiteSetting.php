<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'type'];

    protected $casts = ['value' => 'string'];

    private const CACHE_KEY = 'site_settings_all';

    /** Semua setting dalam satu query + satu cache entry. */
    public static function allCached(): array
    {
        try {
            return Cache::remember(self::CACHE_KEY, 3600, function () {
                return DB::table('site_settings')->pluck('value', 'key')->all();
            });
        } catch (\Throwable $e) {
            return [];
        }
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return static::allCached()[$key] ?? $default;
    }

    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): void
    {
        static::setMany([$key => $value], $group, $type);
    }

    /** Simpan banyak key sekaligus (1 query upsert). */
    public static function setMany(array $pairs, string $group = 'general', string $type = 'text'): void
    {
        try {
            $now  = now();
            $rows = [];
            foreach ($pairs as $key => $value) {
                $rows[] = [
                    'key'        => $key,
                    'value'      => (string) ($value ?? ''),
                    'group'      => $group,
                    'type'       => $type,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            if ($rows) {
                static::upsert($rows, ['key'], ['value', 'group', 'type', 'updated_at']);
            }
            Cache::forget(self::CACHE_KEY);
        } catch (\Throwable $e) {
            // tabel belum ada
        }
    }
}