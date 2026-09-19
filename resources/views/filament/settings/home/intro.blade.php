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

        {{-- 3. SLIDE GAMBAR (style .kpm-slide-* ada di filament-custom.css) --}}
        <div>
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