<x-filament-panels::page>

    <style>
        .kpm-slide-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 180px)); gap: 12px; margin-bottom: 16px }
        .kpm-slide-card { display: flex; flex-direction: column; gap: 6px }
        .kpm-slide-thumb { position: relative; width: 100%; aspect-ratio: 4/3; border-radius: 8px; overflow: hidden; border: 1px solid #e5e7eb; background: #f3f4f6 }
        .kpm-slide-thumb--new { border: 2px solid #fbbf24 }
        .kpm-slide-thumb img { width: 100%; height: 100%; object-fit: cover; display: block }
        .kpm-slide-badge { position: absolute; top: 6px; left: 6px; font: 10px monospace; background: rgba(0,0,0,.6); color: #fff; padding: 2px 6px; border-radius: 4px }
        .kpm-slide-badge--new { background: #f59e0b }
        .kpm-slide-remove { width: 100%; padding: 4px 8px; font-size: 12px; color: #dc2626; background: transparent; border: 1px solid #fecaca; border-radius: 6px; cursor: pointer }
        .kpm-slide-remove:hover { background: #fef2f2 }
        .kpm-slide-empty { grid-column: 1/-1; text-align: center; padding: 32px 0; font-size: 14px; color: #9ca3af; border: 1px dashed #e5e7eb; border-radius: 8px }
        .kpm-slide-upload { display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; font-size: 14px; font-weight: 500; color: #d97706; border: 1px dashed #fbbf24; border-radius: 8px; cursor: pointer }
        .kpm-slide-upload:hover { background: #fffbeb }
        .kpm-slide-hint { font-size: 12px; color: #9ca3af; margin-top: 8px }
        .kpm-slide-thumb--error { border: 2px solid #ef4444 }
        .kpm-slide-badge--error { background: #dc2626 }
        .kpm-slide-x { position: absolute; top: 6px; right: 6px; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; border-radius: 9999px; background: rgba(0,0,0,.65); color: #fff; border: 0; cursor: pointer; transition: background .15s, transform .15s }
        .kpm-slide-x:hover { background: #dc2626; transform: scale(1.1) }
        .kpm-slide-size { position: absolute; bottom: 6px; left: 6px; font: 10px monospace; background: rgba(0,0,0,.6); color: #fff; padding: 2px 6px; border-radius: 4px }
        .kpm-slide-size--error { background: #dc2626 }
        .kpm-modal-preview { margin-top: 4px; border-radius: 8px; overflow: hidden; border: 1px solid #e5e7eb; aspect-ratio: 16/6; background: #f3f4f6 }
        .kpm-modal-preview img { width: 100%; height: 100%; object-fit: cover; display: block }
        .dark .kpm-modal-preview { border-color: rgba(255,255,255,.1); background: rgba(255,255,255,.05) }
        .kpm-upload-bar { height: 4px; border-radius: 4px; background: #fde68a; overflow: hidden; margin-top: 10px; max-width: 320px }
        .kpm-upload-bar > div { height: 100%; background: #f59e0b; transition: width .15s }
        .dark .kpm-slide-thumb { border-color: rgba(255,255,255,.1); background: rgba(255,255,255,.05) }
        .dark .kpm-slide-thumb--new { border-color: #f59e0b }
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

            {{-- Slide yang sudah tersimpan --}}
            <div class="kpm-slide-grid">
                @forelse ($home_hero_images as $i => $img)
                    <div class="kpm-slide-card" wire:key="hero-img-{{ $i }}-{{ md5($img) }}">
                        <div class="kpm-slide-thumb">
                            <img src="{{ $this->imageUrl($img) }}" alt="Slide {{ $i + 1 }}" loading="lazy">
                            <span class="kpm-slide-badge">#{{ $i + 1 }}</span>
                        </div>
                        <x-filament::modal id="delete-hero-slide-{{ $i }}"
                            icon="heroicon-o-exclamation-triangle" icon-color="danger" width="md"
                            alignment="center">

                            <x-slot name="trigger">
                                <button type="button" class="kpm-slide-remove">Hapus</button>
                            </x-slot>

                            <x-slot name="heading">Hapus Slide Hero #{{ $i + 1 }}?</x-slot>

                            <x-slot name="description">
                                Gambar akan dihapus permanen dari server dan hilang dari slider Beranda.
                                Tindakan ini tidak dapat dibatalkan.
                            </x-slot>

                            <div class="kpm-modal-preview">
                                <img src="{{ $this->imageUrl($img) }}" alt="Slide {{ $i + 1 }}">
                            </div>

                            <x-slot name="footer">
                                <div class="flex items-center justify-end gap-3">
                                    <x-filament::button color="gray" x-on:click="close()">
                                        Batal
                                    </x-filament::button>

                                    <x-filament::button color="danger"
                                        wire:click="removeHeroImage({{ $i }})" x-on:click="close()">
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

            {{-- Upload + progress + pesan error (event dari Livewire naik ke wrapper ini) --}}
            <div
                x-data="{ uploading: false, progress: 0, failed: false }"
                x-on:livewire-upload-start="uploading = true; failed = false; progress = 0"
                x-on:livewire-upload-finish="uploading = false"
                x-on:livewire-upload-error="uploading = false; failed = true"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
            >
                <label class="kpm-slide-upload">
                    <span x-show="!uploading">+ Tambah Slide (bisa pilih beberapa)</span>
                    <span x-show="uploading" style="display:none">Mengunggah… <span x-text="progress"></span>%</span>
                    <input type="file" wire:model="home_hero_new_uploads" accept="image/*" multiple style="display:none">
                </label>

                <div class="kpm-upload-bar" x-show="uploading" style="display:none">
                    <div :style="`width:${progress}%`"></div>
                </div>

                <p x-show="failed" style="display:none; margin-top:8px; font-size:12px; font-weight:500; color:#dc2626">
                    Upload gagal. File kemungkinan terlalu besar untuk batas server (upload_max_filesize / post_max_size)
                    atau koneksi terputus. Kompres gambar lalu coba lagi.
                </p>
            </div>

            @error('home_hero_new_uploads')
                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
            @enderror
            @error('home_hero_new_uploads.*')
                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
            @enderror

            {{-- Preview slide baru (belum tersimpan) --}}
            @if (!empty($home_hero_new_uploads))
                <div class="kpm-slide-grid" style="margin-top:16px">
                    @foreach ($home_hero_new_uploads as $n => $newImg)
                        @php
                            $sizeMb = $newImg->getSize() / 1048576;
                            $tooBig = $sizeMb > 2;
                        @endphp
                        <div class="kpm-slide-thumb kpm-slide-thumb--new {{ $tooBig ? 'kpm-slide-thumb--error' : '' }}"
                            wire:key="hero-new-{{ $n }}-{{ md5($newImg->getFilename()) }}">
                            <img src="{{ $newImg->temporaryUrl() }}" alt="Preview slide baru" loading="lazy">

                            <span class="kpm-slide-badge {{ $tooBig ? 'kpm-slide-badge--error' : 'kpm-slide-badge--new' }}">
                                {{ $tooBig ? 'Terlalu besar' : 'Baru' }}
                            </span>

                            <button type="button" wire:click="removeNewHeroUpload({{ $n }})"
                                class="kpm-slide-x" title="Batalkan gambar ini" aria-label="Batalkan gambar ini">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <span class="kpm-slide-size {{ $tooBig ? 'kpm-slide-size--error' : '' }}">
                                {{ number_format($sizeMb, 2) }} MB
                            </span>
                        </div>
                    @endforeach
                </div>
                <p class="kpm-slide-hint" style="color:#16a34a">
                    {{ count($home_hero_new_uploads) }} gambar dipilih — klik Simpan untuk menerapkan.
                </p>
            @endif
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