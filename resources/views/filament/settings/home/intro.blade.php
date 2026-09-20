<x-filament::section>
    <x-slot name="heading">
        <span class="flex items-center gap-2">
            <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
            Intro & Identitas Perusahaan
        </span>
    </x-slot>
    <x-slot name="description">
        Tagline besar, teks pengantar, dan foto yang tampil di section "Tentang Kami" pada halaman Home.
    </x-slot>

    <div class="space-y-6">

        {{-- 1. TAGLINE --}}
        <div>
            <p class="text-[11px] font-medium uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">
                Tagline Besar
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Baris 1
                        <span class="text-xs text-gray-400 font-normal ml-1">— warna hitam/putih</span>
                    </label>
                    <input type="text" wire:model="home_intro_tagline_line1" placeholder="Satu Group,"
                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Baris 2
                        <span class="text-xs text-gray-400 font-normal ml-1">— tampil warna emas</span>
                    </label>
                    <input type="text" wire:model="home_intro_tagline_line2" placeholder="Lima Kekuatan"
                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/[0.03] px-5 py-4">
                <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-2">Pratinjau tampilan tagline</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-white leading-snug">
                    {{ $home_intro_tagline_line1 ?: 'Satu Group,' }}
                </p>
                <p class="text-2xl font-semibold text-amber-600 dark:text-amber-400 leading-snug">
                    {{ $home_intro_tagline_line2 ?: 'Lima Kekuatan' }}
                </p>
            </div>
        </div>

        <hr class="border-dashed border-gray-200 dark:border-white/10">

        {{-- 2. PARAGRAF PENGANTAR --}}
        <div>
            <p class="text-[11px] font-medium uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">
                Teks Pengantar Perusahaan
            </p>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Paragraf Pertama
                        <span class="text-xs text-gray-400 font-normal ml-1">— lead / pembuka</span>
                    </label>
                    <textarea wire:model="home_company_intro" rows="3"
                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $home_company_intro }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Paragraf Kedua</label>
                    <textarea wire:model="home_company_intro_sub" rows="3"
                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $home_company_intro_sub }}</textarea>
                </div>

                <div class="w-40">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tahun Berdiri</label>
                    <input type="text" wire:model="home_established_year" placeholder="2010"
                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                </div>
            </div>
        </div>

        <hr class="border-dashed border-gray-200 dark:border-white/10">

                {{-- 3. SLIDE GAMBAR SECTION INTRO --}}
        <div>
            <style>
                .kpm-slide-title { font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: .1em; color: #9ca3af; margin-bottom: 12px }
                .kpm-slide-title small { text-transform: none; letter-spacing: normal; font-weight: 400; margin-left: 4px }
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

            <p class="kpm-slide-title">
                Slide Gambar Section Intro
                <small>— tampil bergantian (carousel) di sisi kanan tagline</small>
            </p>

            <div class="kpm-slide-grid">
                @forelse ($home_intro_images as $i => $img)
                    <div class="kpm-slide-card" wire:key="intro-img-{{ $i }}-{{ md5($img) }}">
                        <div class="kpm-slide-thumb">
                            
                            <img src="{{ $this->imageUrl($img) }}" alt="Slide {{ $i + 1 }}" loading="lazy"
                                decoding="async">
                            <span class="kpm-slide-badge">#{{ $i + 1 }}</span>
                        </div>
                        <x-filament::modal id="delete-intro-slide-{{ $i }}" icon="heroicon-o-exclamation-triangle"
                            icon-color="danger" width="md">

                            <x-slot name="trigger">
                                <button type="button" class="kpm-slide-remove">Hapus</button>
                            </x-slot>

                            <x-slot name="heading">Hapus Slide</x-slot>

                            <x-slot name="description">
                                Apakah Anda yakin ingin menghapus slide gambar ini? Tindakan ini tidak dapat dibatalkan.
                            </x-slot>

                            <x-slot name="footer">
                                <div class="flex items-center justify-end gap-3">
                                    <x-filament::button color="gray" x-on:click="close()">
                                        Batal
                                    </x-filament::button>

                                    <x-filament::button color="danger" wire:click="removeIntroImage({{ $i }})"
                                        x-on:click="close()">
                                        Ya, Hapus
                                    </x-filament::button>
                                </div>
                            </x-slot>

                        </x-filament::modal>
                    </div>
                @empty
                    <div class="kpm-slide-empty">Belum ada slide. Tambahkan gambar di bawah.</div>
                @endforelse
            </div>

            <label class="kpm-slide-upload">
                <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span wire:loading.remove wire:target="home_intro_new_uploads">Tambah Slide (bisa pilih beberapa)</span>
                <span wire:loading wire:target="home_intro_new_uploads">Mengunggah…</span>
                <input type="file" wire:model="home_intro_new_uploads" accept="image/*" multiple
                    style="display:none">
            </label>

            @error('home_intro_new_uploads.*')
                <p style="margin-top:8px;font-size:12px;font-weight:500;color:#dc2626">{{ $message }}</p>
            @enderror

            @if (!empty($home_intro_new_uploads))
                <div class="kpm-slide-grid" style="margin-top:16px">
                    @foreach ($home_intro_new_uploads as $n => $newImg)
                        <div class="kpm-slide-thumb kpm-slide-thumb--new" wire:key="intro-new-{{ $n }}">
                            <img src="{{ $newImg->temporaryUrl() }}" alt="Preview slide baru" loading="lazy"
                                decoding="async">
                            <span class="kpm-slide-badge kpm-slide-badge--new">Baru</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <p class="kpm-slide-hint">Format: JPG / PNG / WebP · Maks. 2 MB per gambar · Rasio 4:3 direkomendasikan</p>
        </div>

    </div>
</x-filament::section>