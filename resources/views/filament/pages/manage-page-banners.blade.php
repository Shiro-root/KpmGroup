<x-filament-panels::page>

    <style>
        .kpm-slide-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 180px)); gap: 12px; margin-bottom: 16px }
        .kpm-slide-card { display: flex; flex-direction: column; gap: 6px }
        .kpm-slide-thumb { position: relative; width: 100%; aspect-ratio: 4/3; border-radius: 8px; overflow: hidden; border: 1px solid #e5e7eb; background: #f3f4f6 }
        .kpm-slide-thumb img { width: 100%; height: 100%; object-fit: cover; display: block }
        .kpm-slide-badge { position: absolute; top: 6px; left: 6px; font: 10px monospace; background: rgba(0,0,0,.6); color: #fff; padding: 2px 6px; border-radius: 4px }
        .kpm-slide-remove { width: 100%; padding: 4px 8px; font-size: 12px; color: #dc2626; background: transparent; border: 1px solid #fecaca; border-radius: 6px; cursor: pointer }
        .kpm-slide-remove:hover { background: #fef2f2 }
        .kpm-slide-empty { grid-column: 1/-1; text-align: center; padding: 32px 0; font-size: 14px; color: #9ca3af; border: 1px dashed #e5e7eb; border-radius: 8px }
        .kpm-slide-upload { display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; font-size: 14px; font-weight: 500; color: #d97706; border: 1px dashed #fbbf24; border-radius: 8px; cursor: pointer }
        .kpm-slide-upload:hover { background: #fffbeb }
        .dark .kpm-slide-thumb { border-color: rgba(255,255,255,.1); background: rgba(255,255,255,.05) }
        .dark .kpm-slide-empty { border-color: rgba(255,255,255,.1) }
        .dark .kpm-slide-upload { color: #fbbf24; border-color: rgba(251,191,36,.5) }
    </style>

    <form wire:submit.prevent="save" class="space-y-6 pb-20">

        {{-- ══ HERO SLIDER — BERANDA ══ --}}
        <x-filament::section>
            <x-slot name="heading">
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
                    Hero Slider (Beranda)
                </span>
            </x-slot>
            <x-slot name="description">
                Banner utama yang tampil di halaman Home dan bergeser otomatis.
                <strong>Ukuran ideal: 1920 × 700 px</strong> (landscape, rasio ±2.7:1). Format JPG/WebP, maks 2 MB/gambar
                — disarankan kompres ke bawah 300KB agar loading cepat.
            </x-slot>

            <div class="kpm-slide-grid">
                @forelse ($home_hero_images as $i => $img)
                    <div class="kpm-slide-card" wire:key="hero-img-{{ $i }}-{{ md5($img) }}">
                        <div class="kpm-slide-thumb">
                            <img src="{{ $this->imageUrl($img) }}" alt="Slide {{ $i + 1 }}" loading="lazy">
                            <span class="kpm-slide-badge">#{{ $i + 1 }}</span>
                        </div>
                        <button type="button" wire:click="removeHeroImage({{ $i }})"
                            wire:confirm="Hapus slide ini? Tindakan ini tidak dapat dibatalkan."
                            class="kpm-slide-remove">Hapus</button>
                    </div>
                @empty
                    <div class="kpm-slide-empty">Belum ada slide. Website akan memakai gambar default (hero-bg.jpg).</div>
                @endforelse
            </div>

            <label class="kpm-slide-upload">
                <span wire:loading.remove wire:target="home_hero_new_uploads">+ Tambah Slide (bisa pilih beberapa)</span>
                <span wire:loading wire:target="home_hero_new_uploads">Mengunggah…</span>
                <input type="file" wire:model="home_hero_new_uploads" accept="image/*" multiple style="display:none">
            </label>
            @error('home_hero_new_uploads.*')
                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </x-filament::section>

        {{-- ══ BANNER — ABOUT ══ --}}
        <x-filament::section>
            <x-slot name="heading">Banner Halaman "Tentang Kami"</x-slot>
            <x-slot name="description">
                <strong>Ukuran ideal: 1920 × 500 px</strong> (landscape, rasio ±3.8:1). Maks 2 MB.
            </x-slot>
            @include('filament.pages.partials.single-banner-field', [
                'preview' => 'about_banner_preview',
                'current' => 'about_banner_current',
            ])
        </x-filament::section>

        {{-- ══ BANNER — SERVICES ══ --}}
        <x-filament::section>
            <x-slot name="heading">Banner Halaman "Layanan"</x-slot>
            <x-slot name="description"><strong>Ukuran ideal: 1920 × 500 px</strong>. Maks 2 MB.</x-slot>
            @include('filament.pages.partials.single-banner-field', [
                'preview' => 'services_banner_preview',
                'current' => 'services_banner_current',
            ])
        </x-filament::section>

        {{-- ══ BANNER — CONTACT ══ --}}
        <x-filament::section>
            <x-slot name="heading">Banner Halaman "Kontak"</x-slot>
            <x-slot name="description"><strong>Ukuran ideal: 1920 × 500 px</strong>. Maks 2 MB.</x-slot>
            @include('filament.pages.partials.single-banner-field', [
                'preview' => 'contact_banner_preview',
                'current' => 'contact_banner_current',
            ])
        </x-filament::section>

        @include('filament.settings.save-bar', ['label' => 'Simpan Banner & Hero Slider'])
    </form>
</x-filament-panels::page>