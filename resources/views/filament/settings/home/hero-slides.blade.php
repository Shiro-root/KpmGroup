<x-filament::section>
    <x-slot name="heading">
        <span class="flex items-center gap-2">
            <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
            Hero Slider (Banner Utama)
        </span>
    </x-slot>
    <x-slot name="description">
        Gambar banner yang tampil paling atas di halaman Home dan bergeser otomatis. Buat gambar banner yang sudah
        berisi teks/desain sendiri.
    </x-slot>

    {{-- Style slide (sama dengan yang dipakai di intro.blade.php; aman jika dobel) --}}
    <style>
        .kpm-slide-title { font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: .1em; color: #9ca3af; margin-bottom: 12px }
        .kpm-slide-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 180px)); gap: 12px; margin-bottom: 16px }
        .kpm-slide-card { display: flex; flex-direction: column; gap: 6px }
        .kpm-slide-thumb { position: relative; width: 100%; aspect-ratio: 4/3; border-radius: 8px; overflow: hidden; border: 1px solid #e5e7eb; background: #f3f4f6 }
        .kpm-slide-thumb--new { border: 2px solid #fbbf24 }
        .kpm-slide-thumb img { width: 100%; height: 100%; object-fit: cover; display: block }
        .kpm-slide-badge { position: absolute; top: 6px; left: 6px; font: 10px monospace; background: rgba(0, 0, 0, .6); color: #fff; padding: 2px 6px; border-radius: 4px }
        .kpm-slide-badge--new { background: #f59e0b }
        .kpm-slide-remove { width: 100%; padding: 4px 8px; font-size: 12px; color: #dc2626; background: transparent; border: 1px solid #fecaca; border-radius: 6px; cursor: pointer; transition: background .15s }
        .kpm-slide-remove:hover { background: #fef2f2 }
        .kpm-slide-empty { grid-column: 1/-1; text-align: center; padding: 32px 0; font-size: 14px; color: #9ca3af; border: 1px dashed #e5e7eb; border-radius: 8px }
        .kpm-slide-upload { display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; font-size: 14px; font-weight: 500; color: #d97706; border: 1px dashed #fbbf24; border-radius: 8px; cursor: pointer; transition: background .15s }
        .kpm-slide-upload:hover { background: #fffbeb }
        .kpm-slide-hint { font-size: 12px; color: #9ca3af; margin-top: 8px }
        .dark .kpm-slide-thumb { border-color: rgba(255, 255, 255, .1); background: rgba(255, 255, 255, .05) }
        .dark .kpm-slide-thumb--new { border-color: #f59e0b }
        .dark .kpm-slide-remove { color: #f87171; border-color: rgba(248, 113, 113, .3) }
        .dark .kpm-slide-remove:hover { background: rgba(248, 113, 113, .1) }
        .dark .kpm-slide-empty { border-color: rgba(255, 255, 255, .1) }
        .dark .kpm-slide-upload { color: #fbbf24; border-color: rgba(251, 191, 36, .5) }
        .dark .kpm-slide-upload:hover { background: rgba(251, 191, 36, .1) }
    </style>

    <div class="kpm-slide-grid">
        @forelse ($home_hero_images as $i => $img)
            <div class="kpm-slide-card" wire:key="hero-img-{{ $i }}-{{ md5($img) }}">
                <div class="kpm-slide-thumb">
                    <img src="{{ $this->imageUrl($img) }}" alt="Slide hero {{ $i + 1 }}" loading="lazy" decoding="async">
                    <span class="kpm-slide-badge">#{{ $i + 1 }}</span>
                </div>

                <x-filament::modal id="delete-hero-slide-{{ $i }}" icon="heroicon-o-exclamation-triangle"
                    icon-color="danger" width="md">

                    <x-slot name="trigger">
                        <button type="button" class="kpm-slide-remove">Hapus</button>
                    </x-slot>

                    <x-slot name="heading">Hapus Slide Hero</x-slot>

                    <x-slot name="description">
                        Apakah Anda yakin ingin menghapus slide ini? Tindakan ini tidak dapat dibatalkan.
                    </x-slot>

                    <x-slot name="footer">
                        <div class="flex items-center justify-end gap-3">
                            <x-filament::button color="gray" x-on:click="close()">
                                Batal
                            </x-filament::button>

                            <x-filament::button color="danger" wire:click="removeHeroImage({{ $i }})"
                                x-on:click="close()">
                                Ya, Hapus
                            </x-filament::button>
                        </div>
                    </x-slot>
                </x-filament::modal>
            </div>
        @empty
            <div class="kpm-slide-empty">Belum ada slide. Website akan memakai gambar default (hero-bg.jpg).</div>
        @endforelse
    </div>

    <label class="kpm-slide-upload">
        <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span wire:loading.remove wire:target="home_hero_new_uploads">Tambah Slide (bisa pilih beberapa)</span>
        <span wire:loading wire:target="home_hero_new_uploads">Mengunggah…</span>
        <input type="file" wire:model="home_hero_new_uploads" accept="image/*" multiple style="display:none">
    </label>

    @error('home_hero_new_uploads.*')
        <p style="margin-top:8px;font-size:12px;font-weight:500;color:#dc2626">{{ $message }}</p>
    @enderror

    @if (!empty($home_hero_new_uploads))
        <div class="kpm-slide-grid" style="margin-top:16px">
            @foreach ($home_hero_new_uploads as $n => $newImg)
                <div class="kpm-slide-thumb kpm-slide-thumb--new" wire:key="hero-new-{{ $n }}">
                    <img src="{{ $newImg->temporaryUrl() }}" alt="Preview slide baru" loading="lazy" decoding="async">
                    <span class="kpm-slide-badge kpm-slide-badge--new">Baru</span>
                </div>
            @endforeach
        </div>
    @endif

    <p class="kpm-slide-hint">
        Format: JPG / PNG / WebP · Maks. 2 MB per gambar · Ukuran ideal sekitar 1920×700 px (lebar, landscape)
    </p>
</x-filament::section>
