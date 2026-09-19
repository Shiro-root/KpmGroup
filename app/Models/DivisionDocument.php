<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DivisionDocument extends Model
{
    protected $fillable = [
        'division',
        'name',
        'description',
        'file_paths',
        'is_public',
        'sort_order',
    ];

    protected $casts = [
        'is_public'  => 'boolean',
        'sort_order' => 'integer',
        // file_paths TIDAK di-cast di sini — kita handle manual via mutator/accessor
        // karena Filament kadang kirim array, kadang JSON string (saat edit)
    ];

    // ── Mutator: pastikan file_paths selalu tersimpan sebagai JSON string ──────
    // Ini yang mencegah error "Array to string conversion" saat INSERT/UPDATE

    public function setFilePathsAttribute(mixed $value): void
    {
        if (is_array($value)) {
            // Filament FileUpload multiple() → array path → encode ke JSON
            $this->attributes['file_paths'] = json_encode(array_values($value));
            return;
        }

        if (is_string($value)) {
            // Sudah JSON string (misal saat edit record) — validasi dulu
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                // Valid JSON array → simpan apa adanya
                $this->attributes['file_paths'] = $value;
            } else {
                // Plain string (path tunggal) → wrap jadi JSON array
                $this->attributes['file_paths'] = json_encode([$value]);
            }
            return;
        }

        // Null atau tipe lain → simpan array kosong
        $this->attributes['file_paths'] = json_encode([]);
    }

    // ── Accessor: Filament FileUpload butuh array saat load form edit ─────────

    public function getFilePathsAttribute(mixed $value): array
    {
        return $this->parsePaths($value);
    }

    // ── Helper: normalize ke array (handle double-encoded JSON) ───────────────

    private function parsePaths(mixed $raw): array
    {
        if (is_array($raw)) {
            return array_values($raw);
        }

        if (is_string($raw) && $raw !== '') {
            $decoded = $raw;
            $limit   = 3; // handle hingga triple-encoded
            while (is_string($decoded) && $limit-- > 0) {
                $attempt = json_decode($decoded, true);
                if (json_last_error() !== JSON_ERROR_NONE) break;
                $decoded = $attempt;
            }
            return is_array($decoded) ? array_values($decoded) : [];
        }

        return [];
    }

    // ── Labels ────────────────────────────────────────────────────────────────

    public function getDivisionLabelAttribute(): string
    {
        return match ($this->division) {
            'construction' => 'KPM Construction',
            'engineering'  => 'KPM Engineering',
            'rd'           => 'KPM Research & Development',
            'farm'         => 'KPM Farm',
            'procurement'  => 'KPM Procurement',
            default        => ucfirst($this->division),
        };
    }

    // ── Cover (foto pertama) ──────────────────────────────────────────────────

    public function getCoverUrlAttribute(): ?string
    {
        $paths = $this->parsePaths($this->getRawOriginal('file_paths'));
        if (empty($paths)) return null;
        return Storage::disk('public')->url($paths[0]);
    }

    // ── Semua URL foto ────────────────────────────────────────────────────────

    public function getPhotoUrlsAttribute(): array
    {
        return collect($this->parsePaths($this->getRawOriginal('file_paths')))
            ->map(fn ($path) => Storage::disk('public')->url($path))
            ->toArray();
    }

    // ── Jumlah foto ───────────────────────────────────────────────────────────

    public function getPhotoCountAttribute(): int
    {
        return count($this->parsePaths($this->getRawOriginal('file_paths')));
    }

    // ── Scopes ────────────────────────────────────────────────────────────────

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeForDivision($query, string $division)
    {
        return $query->where('division', $division);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }
}