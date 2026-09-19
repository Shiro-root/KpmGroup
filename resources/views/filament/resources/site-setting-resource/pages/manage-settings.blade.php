{{-- resources/views/filament/resources/site-setting-resource/pages/manage-settings.blade.php --}}

<x-filament-panels::page>

    {{-- ── Tab Nav ── --}}
    <div class="mb-6 border-b border-gray-200 dark:border-white/10">
        <div class="flex overflow-x-auto gap-1 pb-px scrollbar-none">
            @foreach ([
                ['key' => 'home', 'label' => 'Halaman Home', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['key' => 'about', 'label' => 'Halaman About', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['key' => 'services', 'label' => 'Halaman Services', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01'],
                ['key' => 'contact', 'label' => 'Halaman Contact', 'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
                ['key' => 'seo', 'label' => 'SEO & Meta', 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
            ] as $tab)
                <button wire:click="$set('activeTab', '{{ $tab['key'] }}')"
                    class="flex-shrink-0 flex items-center gap-2 px-4 py-2.5 text-sm font-medium border-b-2 transition-all duration-200 whitespace-nowrap
                           {{ $activeTab === $tab['key']
                                ? 'border-amber-500 text-amber-600 dark:text-amber-400'
                                : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-amber-600 hover:border-amber-300' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $tab['icon'] }}" />
                    </svg>
                    <span>{{ $tab['label'] }}</span>
                </button>
            @endforeach
        </div>
    </div>

    {{-- ════════════════════ TAB: HOME ════════════════════ --}}
    @if ($activeTab === 'home')
        <form wire:submit.prevent="saveHome" class="space-y-6 pb-20">

            {{-- ── Hero Section ── --}}
            <x-filament::section>
                <x-slot name="heading">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
                        Hero Section
                    </span>
                </x-slot>
                <x-slot name="description">Teks utama yang tampil pertama kali saat website dibuka</x-slot>

                <div class="grid grid-cols-1 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            Judul Hero (HTML diperbolehkan)
                            <span class="text-xs text-gray-400 font-normal ml-1">— gunakan &lt;span class="text-accent"&gt;
                                untuk warna emas</span>
                        </label>
                        <textarea wire:model="home_hero_title" rows="2"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500">{{ $home_hero_title }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Subtitle
                            Hero</label>
                        <textarea wire:model="home_hero_subtitle" rows="3"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $home_hero_subtitle }}</textarea>
                    </div>
                </div>
            </x-filament::section>

            {{-- ── Stats Bar ── --}}
            <x-filament::section>
                <x-slot name="heading">Stats Bar (Angka di Banner Emas)</x-slot>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ([
                        ['field' => 'home_stats_exp', 'label' => 'Tahun Pengalaman', 'placeholder' => '10+'],
                        ['field' => 'home_stats_divisions', 'label' => 'Divisi Bisnis', 'placeholder' => '5'],
                        ['field' => 'home_stats_projects', 'label' => 'Proyek Selesai', 'placeholder' => '50+'],
                        ['field' => 'home_stats_team', 'label' => 'Tim Profesional', 'placeholder' => '100+'],
                    ] as $stat)
                        <div>
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">{{ $stat['label'] }}</label>
                            <input type="text" wire:model="{{ $stat['field'] }}" placeholder="{{ $stat['placeholder'] }}"
                                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                        </div>
                    @endforeach
                </div>
            </x-filament::section>

            {{-- ── Intro & Identitas Perusahaan ── --}}
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

                        {{-- Live preview tagline --}}
                        <div
                            class="rounded-lg border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/[0.03] px-5 py-4">
                            <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-2">Pratinjau tampilan tagline
                            </p>
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
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Paragraf
                                    Kedua</label>
                                <textarea wire:model="home_company_intro_sub" rows="3"
                                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $home_company_intro_sub }}</textarea>
                            </div>

                            <div class="w-40">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tahun
                                    Berdiri</label>
                                <input type="text" wire:model="home_established_year" placeholder="2010"
                                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                            </div>
                        </div>
                    </div>

                    <hr class="border-dashed border-gray-200 dark:border-white/10">

                    {{-- 3. SLIDE GAMBAR SECTION INTRO (style .kpm-slide-* ada di filament-custom.css) --}}
                    <div>
                        <p class="kpm-slide-title">
                            Slide Gambar Section Intro
                            <small>— tampil bergantian (carousel) di sisi kanan tagline</small>
                        </p>

                        {{-- Gambar tersimpan --}}
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

                                        {{-- 1. Tombol Pemicu Modal --}}
                                        <x-slot name="trigger">
                                            <button type="button" class="kpm-slide-remove">
                                                Hapus
                                            </button>
                                        </x-slot>

                                        {{-- 2. Teks Konten Modal --}}
                                        <x-slot name="heading">
                                            Hapus Slide
                                        </x-slot>

                                        <x-slot name="description">
                                            Apakah Anda yakin ingin menghapus slide gambar ini? Tindakan ini tidak dapat dibatalkan.
                                        </x-slot>

                                        {{-- 3. Tombol Aksi di Bawah --}}
                                        <x-slot name="footer">
                                            <div class="flex items-center justify-end gap-3">
                                                {{-- Tombol Batal --}}
                                                <x-filament::button color="gray" x-on:click="close()">
                                                    Batal
                                                </x-filament::button>

                                                {{-- Tombol Hapus & Eksekusi Livewire --}}
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

                        {{-- Upload --}}
                        <label class="kpm-slide-upload">
                            <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span wire:loading.remove wire:target="home_intro_new_uploads">Tambah Slide (bisa pilih
                                beberapa)</span>
                            <span wire:loading wire:target="home_intro_new_uploads">Mengunggah…</span>
                            <input type="file" wire:model="home_intro_new_uploads" accept="image/*" multiple
                                style="display:none">
                        </label>

                        @error('home_intro_new_uploads.*')
                            <p style="margin-top:8px;font-size:12px;font-weight:500;color:#dc2626">{{ $message }}</p>
                        @enderror

                        {{-- Preview file baru (sebelum Simpan) --}}
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

                        <p class="kpm-slide-hint">Format: JPG / PNG / WebP · Maks. 2 MB per gambar · Rasio 4:3
                            direkomendasikan</p>
                    </div>

                </div>
            </x-filament::section>

            {{-- ── Penjelasan Singkat Per Divisi ── --}}
            <x-filament::section>
                <x-slot name="heading">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
                        Penjelasan Singkat Per Divisi (Services Overview)
                    </span>
                </x-slot>
                <x-slot name="description">Teks deskripsi ringkas yang muncul di kartu layanan pada halaman Home.</x-slot>

                <div class="space-y-4">
                    @foreach ([
                        ['field' => 'home_div_construction_desc', 'label' => 'KPM Construction', 'placeholder' => 'Layanan konstruksi sipil dan mekanikal dengan standar kualitas internasional...'],
                        ['field' => 'home_div_engineering_desc', 'label' => 'KPM Engineering', 'placeholder' => 'Solusi rekayasa teknik inovatif untuk mendukung efisiensi operasional...'],
                        ['field' => 'home_div_rd_desc', 'label' => 'KPM Research & Development', 'placeholder' => 'Inovasi dan riset terapan untuk menciptakan solusi teknologi...'],
                        ['field' => 'home_div_farm_desc', 'label' => 'KPM Farm', 'placeholder' => 'Pengembangan agrikultur modern berbasis teknologi...'],
                        ['field' => 'home_div_procurement_desc', 'label' => 'KPM Procurement', 'placeholder' => 'Layanan pengadaan barang dan material yang efisien, transparan...'],
                    ] as $div)
                        <div
                            class="border border-gray-100 dark:border-white/10 rounded-lg p-4 space-y-2 bg-gray-50/40 dark:bg-white/[0.02]">
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-200">{{ $div['label'] }}</label>
                            <textarea wire:model="{{ $div['field'] }}" rows="2" placeholder="{{ $div['placeholder'] }}"
                                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $this->{$div['field']} }}</textarea>
                        </div>
                    @endforeach
                </div>
            </x-filament::section>

            {{-- ── 5 Gambar Grid "Komitmen Kami" ── --}}
            <x-filament::section>
                <x-slot name="heading">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
                        "Komitmen Kami" — 5 Gambar Grid Kanan
                    </span>
                </x-slot>
                <x-slot name="description">Lima foto divisi dalam grid di sisi kanan section "Mengapa KPM Group".</x-slot>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach ([
                        ['preview_field' => 'home_whyus_img_1_preview', 'current_field' => 'home_whyus_img_1_current', 'label' => 'Gambar 1 — Construction', 'default' => 'thumb-construction.jpg'],
                        ['preview_field' => 'home_whyus_img_2_preview', 'current_field' => 'home_whyus_img_2_current', 'label' => 'Gambar 2 — Engineering', 'default' => 'thumb-engineering.jpg'],
                        ['preview_field' => 'home_whyus_img_3_preview', 'current_field' => 'home_whyus_img_3_current', 'label' => 'Gambar 3 — R & D', 'default' => 'thumb-rd.jpg'],
                        ['preview_field' => 'home_whyus_img_4_preview', 'current_field' => 'home_whyus_img_4_current', 'label' => 'Gambar 4 — Farm', 'default' => 'thumb-farm.jpg'],
                        ['preview_field' => 'home_whyus_img_5_preview', 'current_field' => 'home_whyus_img_5_current', 'label' => 'Gambar 5 — Procurement', 'default' => 'thumb-procurement.jpg'],
                    ] as $img)
                        <div
                            class="border border-gray-200 dark:border-white/10 rounded-lg p-4 bg-gray-50/40 dark:bg-white/[0.02]">
                            <p class="text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider mb-3">
                                {{ $img['label'] }}
                            </p>

                            <div class="flex items-start gap-3 min-w-0">

                                <div class="relative flex-shrink-0" style="width:96px;height:96px;">
                                    @if ($this->{$img['preview_field']})
                                        <img src="{{ $this->{$img['preview_field']}->temporaryUrl() }}"
                                            alt="Preview {{ $img['label'] }}" class="block rounded-lg border-2 border-amber-400"
                                            style="width:96px;height:96px;object-fit:cover;">
                                        <span
                                            class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-amber-500 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                    @else
                                        {{-- imageUrl() menambahkan ?v=timestamp agar browser tidak
                                        menampilkan cache lama setelah gambar diganti --}}
                                        <img src="{{ $this->imageUrl($this->{$img['current_field']} ?? $img['default']) }}"
                                            alt="{{ $img['label'] }}"
                                            class="block rounded-lg border border-gray-200 dark:border-white/10"
                                            style="width:96px;height:96px;object-fit:cover;">
                                    @endif
                                </div>

                                <div class="flex flex-col justify-center gap-2 min-w-0 flex-1">
                                    <label
                                        class="cursor-pointer inline-flex items-center gap-2 px-3 py-1.5 border border-dashed border-amber-300 dark:border-amber-700/50 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 text-xs font-medium rounded transition-colors w-fit">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        Ganti Gambar
                                        <input type="file" wire:model="{{ $img['preview_field'] }}" accept="image/*"
                                            class="hidden">
                                    </label>

                                    @error($img['preview_field'])
                                        <div
                                            class="flex items-start gap-1.5 px-2.5 py-1.5 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700/40 rounded">
                                            <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0 mt-0.5" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span
                                                class="text-[11px] text-red-600 dark:text-red-400 font-medium leading-tight">{{ $message }}</span>
                                        </div>
                                    @enderror

                                    @if ($this->{$img['preview_field']})
                                        <span class="text-[11px] text-green-600 dark:text-green-400 leading-tight">
                                            Gambar dipilih —<br>klik Simpan untuk menerapkan
                                        </span>
                                    @else
                                        <span class="text-[11px] text-gray-400 leading-tight">
                                            JPG / PNG / WebP<br>
                                            <span class="font-medium text-gray-500 dark:text-gray-300">Maks. 2 MB</span>
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </x-filament::section>

            {{-- ── Why Us: Heading & Poin-Poin (teks kiri) ── --}}
            <x-filament::section>
                <x-slot name="heading">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
                        "Komitmen Kami" — Teks Kiri & Label Gambar
                    </span>
                </x-slot>
                <x-slot name="description">Heading, sub-judul, poin-poin di sisi kiri, dan label overlay di tiap gambar
                    grid.</x-slot>

                <div class="space-y-6">

                    <div>
                        <p class="text-[11px] font-medium uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">
                            Judul Section</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    Baris Judul <span class="text-xs text-gray-400 font-normal ml-1">— warna
                                        hitam/putih</span>
                                </label>
                                <input type="text" wire:model="home_whyus_title" placeholder="Komitmen Kami"
                                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    Sub-judul <span class="text-xs text-gray-400 font-normal ml-1">— warna emas</span>
                                </label>
                                <input type="text" wire:model="home_whyus_subtitle" placeholder="untuk Anda"
                                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                            </div>
                        </div>
                    </div>

                    <hr class="border-dashed border-gray-200 dark:border-white/10">

                    <div>
                        <p class="text-[11px] font-medium uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">
                            Poin-Poin Keunggulan</p>
                        <div class="space-y-3">
                            @foreach ($home_whyus_points as $i => $point)
                                <div
                                    class="border border-gray-100 dark:border-white/10 rounded-lg p-4 bg-gray-50/40 dark:bg-white/[0.02]">
                                    <div class="flex items-center justify-between mb-3">
                                        <span
                                            class="text-xs font-semibold text-amber-600 dark:text-amber-400 flex items-center gap-2">
                                            <span
                                                class="w-5 h-5 bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center rounded text-[10px] font-bold">{{ $i + 1 }}</span>
                                            Poin #{{ $i + 1 }}
                                        </span>
                                        <button wire:click="removeWhyusPoint({{ $i }})" type="button"
                                            class="flex items-center gap-1 px-2.5 py-1 text-xs text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 border border-red-200 dark:border-red-800/40 rounded transition-colors">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <div>
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">Judul</label>
                                            <input type="text" wire:model="home_whyus_points.{{ $i }}.title"
                                                placeholder="Kualitas Terstandar"
                                                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">Deskripsi</label>
                                            <input type="text" wire:model="home_whyus_points.{{ $i }}.desc"
                                                placeholder="Penjelasan singkat..."
                                                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <button wire:click="addWhyusPoint" type="button"
                                class="flex items-center gap-2 px-4 py-2 border border-amber-300 dark:border-amber-700/50 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 text-sm font-medium rounded transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Poin
                            </button>
                        </div>
                    </div>

                    <hr class="border-dashed border-gray-200 dark:border-white/10">

                    <div>
                        <p class="text-[11px] font-medium uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">
                            Label Teks Overlay Gambar
                            <span class="normal-case tracking-normal font-normal ml-1">— teks kecil di pojok kiri bawah tiap
                                gambar</span>
                        </p>
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                            @foreach ([
                                ['model' => 'home_whyus_label_1', 'label' => 'Gambar 1'],
                                ['model' => 'home_whyus_label_2', 'label' => 'Gambar 2'],
                                ['model' => 'home_whyus_label_3', 'label' => 'Gambar 3'],
                                ['model' => 'home_whyus_label_4', 'label' => 'Gambar 4'],
                                ['model' => 'home_whyus_label_5', 'label' => 'Gambar 5'],
                            ] as $lbl)
                                <div>
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">{{ $lbl['label'] }}</label>
                                    <input type="text" wire:model="{{ $lbl['model'] }}"
                                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </x-filament::section>

            {{-- ── CTA Section ── --}}
            <x-filament::section>
                <x-slot name="heading">CTA Section (Bagian "Mulai Proyek" di bawah)</x-slot>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Judul CTA</label>
                        <input type="text" wire:model="home_cta_title"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Subtitle
                            CTA</label>
                        <input type="text" wire:model="home_cta_subtitle"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>
            </x-filament::section>

            {{-- ── Sticky Save Bar — HOME ── --}}
            <div class="sticky bottom-0 z-50 flex flex-wrap items-center justify-between gap-3 kpm-save-bar">
                <p class="text-xs text-gray-400 dark:text-gray-500">Perubahan belum disimpan hingga tombol diklik.</p>
                <button type="submit" class="kpm-save-btn flex-shrink-0">
                    <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Halaman Home
                </button>
            </div>

        </form>
    @endif

    {{-- ════════════════════ TAB: ABOUT ════════════════════ --}}
    @if ($activeTab === 'about')
        <form wire:submit.prevent="saveAbout" class="space-y-6 pb-20">

            <x-filament::section>
                <x-slot name="heading">Profil Perusahaan</x-slot>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama
                            Perusahaan</label>
                        <input type="text" wire:model="about_company_name"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                    @foreach ([
                        ['field' => 'about_profile_paragraph1', 'label' => 'Paragraf 1 — Pengantar Perusahaan'],
                        ['field' => 'about_profile_paragraph2', 'label' => 'Paragraf 2 — Sejarah & Pertumbuhan'],
                        ['field' => 'about_profile_paragraph3', 'label' => 'Paragraf 3 — Kompetensi & Standar'],
                    ] as $p)
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ $p['label'] }}</label>
                            <textarea wire:model="{{ $p['field'] }}" rows="3"
                                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $this->{$p['field']} }}</textarea>
                        </div>
                    @endforeach
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Bidang
                                Usaha</label>
                            <input type="text" wire:model="about_business_field"
                                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Wilayah
                                Operasi</label>
                            <input type="text" wire:model="about_operation_area"
                                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                        </div>
                    </div>
                </div>
            </x-filament::section>

            <x-filament::section>
                <x-slot name="heading">Visi Perusahaan</x-slot>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Pernyataan Visi</label>
                    <textarea wire:model="about_vision" rows="4"
                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $about_vision }}</textarea>
                </div>
            </x-filament::section>

            <x-filament::section>
                <x-slot name="heading">Misi Perusahaan</x-slot>
                <x-slot name="description">Isi hingga 5 poin misi. Kosongkan jika tidak ingin menampilkan poin
                    tertentu.</x-slot>
                <div class="space-y-3">
                    @foreach ([1, 2, 3, 4, 5] as $n)
                        <div class="flex items-start gap-3">
                            <span
                                class="flex-shrink-0 w-7 h-7 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 flex items-center justify-center text-xs font-bold rounded-sm mt-1.5">0{{ $n }}</span>
                            <input type="text" wire:model="about_mission_{{ $n }}" placeholder="Poin misi ke-{{ $n }}..."
                                class="flex-1 border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                        </div>
                    @endforeach
                </div>
            </x-filament::section>

            {{-- ── Milestone ── --}}
            <x-filament::section>
                <x-slot name="heading">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
                        Milestone Perusahaan
                    </span>
                </x-slot>
                <x-slot name="description">Timeline perjalanan perusahaan yang tampil di halaman About. Diurutkan otomatis
                    berdasarkan tahun saat disimpan.</x-slot>

                <div class="space-y-3">
                    @forelse ($milestones as $i => $m)
                        <div
                            class="border border-gray-200 dark:border-white/10 rounded-lg p-4 space-y-3 bg-gray-50/50 dark:bg-white/[0.02]">
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-xs font-semibold text-amber-700 dark:text-amber-400">
                                    <span
                                        class="w-5 h-5 bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center rounded text-[10px] font-bold">
                                        {{ $i + 1 }}
                                    </span>
                                    Milestone #{{ $i + 1 }}
                                </span>
                                <button wire:click="removeMilestone({{ $i }})" type="button"
                                    class="flex items-center gap-1 px-2.5 py-1 text-xs text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 border border-red-200 dark:border-red-800/40 rounded transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                <div>
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">Tahun</label>
                                    <input type="text" wire:model="milestones.{{ $i }}.year" placeholder="2010"
                                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                                </div>
                                <div class="md:col-span-3">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">Judul</label>
                                    <input type="text" wire:model="milestones.{{ $i }}.title" placeholder="Pendirian KPM Group"
                                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">Deskripsi</label>
                                <textarea wire:model="milestones.{{ $i }}.description" rows="2"
                                    placeholder="Ceritakan singkat pencapaian di tahun ini..."
                                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500"></textarea>
                            </div>
                        </div>
                    @empty
                        <div
                            class="text-center py-10 text-gray-400 dark:text-gray-500 text-sm border border-dashed border-gray-200 dark:border-white/10 rounded-lg">
                            <svg class="w-8 h-8 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Belum ada milestone. Klik tombol di bawah untuk menambah.
                        </div>
                    @endforelse

                    <button wire:click="addMilestone" type="button"
                        class="flex items-center gap-2 px-4 py-2 border border-amber-300 dark:border-amber-700/50 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 text-sm font-medium rounded transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Milestone
                    </button>
                </div>
            </x-filament::section>

            {{-- ── Sticky Save Bar — ABOUT ── --}}
            <div class="sticky bottom-0 z-50 flex flex-wrap items-center justify-between gap-3 kpm-save-bar">
                <p class="text-xs text-gray-400 dark:text-gray-500">Perubahan belum disimpan hingga tombol diklik.</p>
                <button type="submit" class="kpm-save-btn flex-shrink-0">
                    <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Halaman About
                </button>
            </div>

        </form>
    @endif

    {{-- ════════════════════ TAB: SERVICES ════════════════════ --}}
    @if ($activeTab === 'services')
        <form wire:submit.prevent="saveServices" class="space-y-6 pb-20">

            <x-filament::section>
                <x-slot name="heading">Header Halaman Services</x-slot>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            Judul Halaman (HTML diperbolehkan)
                            <span class="text-xs text-gray-400 font-normal ml-1">— gunakan &lt;span
                                class="text-accent"&gt;</span>
                        </label>
                        <input type="text" wire:model="services_page_title"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Subtitle
                            Halaman</label>
                        <textarea wire:model="services_page_subtitle" rows="2"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $services_page_subtitle }}</textarea>
                    </div>
                </div>
            </x-filament::section>

            <x-filament::section>
                <x-slot name="heading">CTA Section Bawah</x-slot>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Judul CTA</label>
                        <input type="text" wire:model="services_cta_title"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Subtitle
                            CTA</label>
                        <input type="text" wire:model="services_cta_subtitle"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>
            </x-filament::section>

            <div
                class="p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700/30 rounded text-sm text-amber-800 dark:text-amber-300">
                <strong class="block mb-1">ℹ Detail konten setiap divisi</strong>
                Untuk mengubah nama, deskripsi, sub-layanan, dan logo setiap divisi — gunakan menu <strong>Layanan &amp;
                    Divisi</strong> di sidebar.
            </div>

            {{-- ── Sticky Save Bar — SERVICES ── --}}
            <div class="sticky bottom-0 z-50 flex flex-wrap items-center justify-between gap-3 kpm-save-bar">
                <p class="text-xs text-gray-400 dark:text-gray-500">Perubahan belum disimpan hingga tombol diklik.</p>
                <button type="submit" class="kpm-save-btn flex-shrink-0">
                    <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Halaman Services
                </button>
            </div>

        </form>
    @endif

    {{-- ════════════════════ TAB: CONTACT ════════════════════ --}}
    @if ($activeTab === 'contact')
        <form wire:submit.prevent="saveContact" class="space-y-6 pb-20">

            <x-filament::section>
                <x-slot name="heading">WhatsApp</x-slot>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            Nomor WhatsApp
                            <span class="text-xs text-gray-400 font-normal ml-1">— format: 628xxx (tanpa +)</span>
                        </label>
                        <input type="text" wire:model="contact_whatsapp" placeholder="628123456789"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            Tampilan Nomor
                            <span class="text-xs text-gray-400 font-normal ml-1">— yang ditampilkan di website</span>
                        </label>
                        <input type="text" wire:model="contact_whatsapp_display" placeholder="812-3456-7890"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Jam
                            Operasional</label>
                        <input type="text" wire:model="contact_office_hours" placeholder="Senin–Sabtu, 08.00–17.00 WIB"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email
                            Perusahaan</label>
                        <input type="email" wire:model="contact_email" placeholder="info@kpmgroup.co.id"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>
            </x-filament::section>

            <x-filament::section>
                <x-slot name="heading">Sosial Media</x-slot>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">URL
                            Instagram</label>
                        <input type="url" wire:model="contact_instagram_url" placeholder="https://instagram.com/namaakun"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Username
                            Instagram</label>
                        <div class="flex items-center border border-gray-300 dark:border-white/20 rounded overflow-hidden">
                            <span class="px-3 py-2 bg-gray-50 dark:bg-white/10 text-gray-400 text-sm">@</span>
                            <input type="text" wire:model="contact_instagram_handle" placeholder="namaakun"
                                class="flex-1 px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 border-0">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">URL TikTok</label>
                        <input type="url" wire:model="contact_tiktok_url" placeholder="https://tiktok.com/@namaakun"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Username
                            TikTok</label>
                        <div class="flex items-center border border-gray-300 dark:border-white/20 rounded overflow-hidden">
                            <span class="px-3 py-2 bg-gray-50 dark:bg-white/10 text-gray-400 text-sm">@</span>
                            <input type="text" wire:model="contact_tiktok_handle" placeholder="namaakun"
                                class="flex-1 px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 border-0">
                        </div>
                    </div>
                </div>
            </x-filament::section>

            <x-filament::section>
                <x-slot name="heading">Alamat & Google Maps</x-slot>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Alamat
                            Kantor</label>
                        <textarea wire:model="contact_address" rows="3"
                            placeholder="Jl. Nama Jalan No. X&#10;Kota, Provinsi XXXXX"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $contact_address }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            Google Maps Embed URL
                            <span class="text-xs text-gray-400 font-normal ml-1">— dari Share → Embed a map → copy
                                src="..."</span>
                        </label>
                        <textarea wire:model="contact_maps_embed_url" rows="2"
                            placeholder="https://www.google.com/maps/embed?pb=..."
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $contact_maps_embed_url }}</textarea>
                    </div>
                    @if ($contact_maps_embed_url)
                        <div class="rounded overflow-hidden border border-gray-200 dark:border-white/10">
                            <p class="text-xs text-gray-400 px-3 py-2 bg-gray-50 dark:bg-white/5">Preview peta:</p>
                            <iframe src="{{ $contact_maps_embed_url }}" width="100%" height="200" style="border:0;"
                                loading="lazy"></iframe>
                        </div>
                    @endif
                </div>
            </x-filament::section>

            {{-- ── Sticky Save Bar — CONTACT ── --}}
            <div class="sticky bottom-0 z-50 flex flex-wrap items-center justify-between gap-3 kpm-save-bar">
                <p class="text-xs text-gray-400 dark:text-gray-500">Perubahan belum disimpan hingga tombol diklik.</p>
                <button type="submit" class="kpm-save-btn flex-shrink-0">
                    <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Halaman Contact
                </button>
            </div>

        </form>
    @endif

    {{-- ════════════════════ TAB: SEO ════════════════════ --}}
    @if ($activeTab === 'seo')
        <form wire:submit.prevent="saveSeo" class="space-y-6 pb-20">

            <x-filament::section>
                <x-slot name="heading">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
                        SEO & Meta Tags
                    </span>
                </x-slot>
                <x-slot name="description">
                    Judul dan deskripsi yang muncul di hasil pencarian Google dan pratinjau tautan media sosial (Open
                    Graph).
                </x-slot>

                <div class="space-y-6">

                    {{-- SEO Title --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            SEO Title
                            <span class="text-xs text-gray-400 font-normal ml-1">— ditambah "| KPM Group" secara
                                otomatis</span>
                        </label>
                        <input type="text" wire:model="seo_title" placeholder="KPM Group"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500">

                        {{-- Live karakter counter --}}
                        <div class="flex items-center justify-between mt-1.5">
                            <p class="text-xs text-gray-400">Idealnya 50–60 karakter</p>
                            <span
                                class="text-xs font-mono
                                {{ strlen($seo_title ?? '') > 60 ? 'text-red-500' : (strlen($seo_title ?? '') >= 50 ? 'text-green-600 dark:text-green-400' : 'text-gray-400') }}">
                                {{ strlen($seo_title ?? '') }} / 60
                            </span>
                        </div>

                        {{-- Preview Google --}}
                        <div
                            class="mt-3 rounded-lg border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/[0.03] px-4 py-3">
                            <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-2">Pratinjau hasil Google</p>
                            <p class="text-[13px] text-blue-600 dark:text-blue-400 font-medium leading-snug truncate">
                                {{ $seo_title ?: 'KPM Group' }} | KPM Group
                            </p>
                            <p class="text-[11px] text-green-700 dark:text-green-500 mt-0.5">https://kpmgrupofficial.co.id
                            </p>
                            <p class="text-[12px] text-gray-600 dark:text-gray-400 mt-1 line-clamp-2 leading-relaxed">
                                {{ $seo_description ?: 'KPM Group — Solusi terpadu Construction, Engineering, R&D, Farm & Procurement di Indonesia.' }}
                            </p>
                        </div>
                    </div>

                    <hr class="border-dashed border-gray-200 dark:border-white/10">

                    {{-- SEO Description --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            SEO Description
                        </label>
                        <textarea wire:model="seo_description" rows="3"
                            placeholder="KPM Group — Solusi terpadu Construction, Engineering, R&D, Farm & Procurement di Indonesia."
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $seo_description }}</textarea>

                        <div class="flex items-center justify-between mt-1.5">
                            <p class="text-xs text-gray-400">Idealnya 120–160 karakter</p>
                            <span
                                class="text-xs font-mono
                                {{ strlen($seo_description ?? '') > 160 ? 'text-red-500' : (strlen($seo_description ?? '') >= 120 ? 'text-green-600 dark:text-green-400' : 'text-gray-400') }}">
                                {{ strlen($seo_description ?? '') }} / 160
                            </span>
                        </div>
                    </div>

                    <hr class="border-dashed border-gray-200 dark:border-white/10">

                    {{-- Info box --}}
                    <div
                        class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700/30 rounded text-sm text-blue-800 dark:text-blue-300 space-y-1">
                        <strong class="block mb-1">ℹ Catatan</strong>
                        <p>Title dan description ini dipakai di <strong>semua halaman</strong> sebagai nilai default global.
                        </p>
                        <p>Tag Open Graph (Facebook/WhatsApp preview) dan Twitter Card juga menggunakan nilai yang sama.</p>
                    </div>

                </div>
            </x-filament::section>

            {{-- ── Sticky Save Bar — SEO ── --}}
            <div class="sticky bottom-0 z-50 flex flex-wrap items-center justify-between gap-3 kpm-save-bar">
                <p class="text-xs text-gray-400 dark:text-gray-500">Perubahan belum disimpan hingga tombol diklik.</p>
                <button type="submit" class="kpm-save-btn flex-shrink-0">
                    <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan SEO
                </button>
            </div>

        </form>
    @endif

</x-filament-panels::page>