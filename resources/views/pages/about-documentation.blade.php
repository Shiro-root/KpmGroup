<x-layouts.app
    :seoTitle="'Dokumentasi ' . $divisionLabel . ' — KPM Group'"
    :seoDescription="'Foto kegiatan dan dokumentasi ' . $divisionLabel . ' — PT. Kurniawan Power Mandiri'"
>

    <x-page-banner
    :title="'Dokumentasi <span class=\'text-accent\'>' . $divisionLabel . '</span>'"
    subtitle="Foto kegiatan dan portofolio divisi KPM Group."
/>
    <section
        class="section-pad bg-white"
        aria-labelledby="divdoc-page-heading"
        x-data="{
            lb: { open: false, photos: [], current: 0, title: '' },
            openLightbox(photos, index, title) {
                this.lb.photos  = photos;
                this.lb.current = index;
                this.lb.title   = title;
                this.lb.open    = true;
                document.body.style.overflow = 'hidden';
            },
            closeLightbox() {
                this.lb.open = false;
                document.body.style.overflow = '';
            },
            lbPrev() {
                this.lb.current = (this.lb.current - 1 + this.lb.photos.length) % this.lb.photos.length;
            },
            lbNext() {
                this.lb.current = (this.lb.current + 1) % this.lb.photos.length;
            },
        }"
        @keydown.escape.window="lb.open && closeLightbox()"
        @keydown.arrow-left.window="lb.open && lbPrev()"
        @keydown.arrow-right.window="lb.open && lbNext()"
    >
        <div class="container-kpm">

            {{-- ── Navigasi Divisi ── --}}
            @php
                $allDivisions = [
                    'construction' => 'KPM Construction',
                    'engineering'  => 'KPM Engineering',
                    'rd'           => 'KPM R & D',
                    'farm'         => 'KPM Farm',
                    'procurement'  => 'KPM Procurement',
                ];
                $activeDivisions = \App\Models\DivisionDocument::where('is_public', true)
                    ->distinct()
                    ->pluck('division')
                    ->toArray();
            @endphp

            <div class="flex flex-wrap gap-2 mb-10" data-aos="fade-up">
                @foreach($allDivisions as $key => $label)
                    @if(in_array($key, $activeDivisions))
                    <a
                        href="{{ route('about.documentation', $key) }}"
                        class="px-4 py-2 text-xs font-medium border transition-colors duration-150
                               {{ $key === $division
                                   ? 'border-gold bg-gold text-white'
                                   : 'border-gray-200 text-gray-500 hover:border-gold hover:text-gold' }}"
                    >
                        {{ $label }}
                    </a>
                    @endif
                @endforeach
            </div>

            {{-- ── Section heading ── --}}
            <div class="text-center mb-12">
                <div class="flex items-center justify-center gap-3 mb-4" data-aos="fade-down">
                    <div class="w-8 h-px bg-gold"></div>
                    <span class="label-mono">{{ $divisionLabel }}</span>
                    <div class="w-8 h-px bg-gold"></div>
                </div>
                <h2 id="divdoc-page-heading" class="heading-section" data-aos="fade-up">
                    Foto Kegiatan
                </h2>
                <p class="body-sm max-w-md mx-auto mt-3" data-aos="fade-up" data-aos-delay="60">
                    {{ $entries->count() }} kegiatan &middot;
                    {{ $entries->sum(fn($e) => count($e->photo_urls)) }} foto dokumentasi
                </p>
            </div>

            @if($entries->isEmpty())
                <div class="text-center py-16 text-gray-400">
                    <svg class="w-14 h-14 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586
                                 a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6
                                 a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="body-sm">Belum ada dokumentasi untuk divisi ini.</p>
                </div>
            @else

                @foreach($entries as $entry)
                @php $photos = $entry->photo_urls; @endphp

                <div class="mb-14 last:mb-0" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">

                    <div class="flex items-start justify-between mb-5 gap-4 pb-4 border-b border-gray-100">
                        <div>
                            <h3 class="font-display text-xl font-semibold text-charcoal">
                                {{ $entry->name }}
                            </h3>
                            @if($entry->description)
                            <p class="body-sm text-gray-500 mt-1">{{ $entry->description }}</p>
                            @endif
                        </div>
                        <span class="label-mono text-gray-400 text-[10px] whitespace-nowrap mt-1">
                            {{ count($photos) }} foto
                        </span>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                        @foreach($photos as $idx => $url)
                        <button
                            type="button"
                            @click="openLightbox({{ Js::from($photos) }}, {{ $idx }}, '{{ addslashes($entry->name) }}')"
                            class="group relative overflow-hidden bg-gray-100 aspect-square
                                   focus:outline-none focus:ring-2 focus:ring-gold/40"
                            aria-label="Foto {{ $idx + 1 }} – {{ $entry->name }}"
                        >
                            <img src="{{ $url }}" alt="Foto kegiatan {{ $idx + 1 }}"
                                 class="absolute inset-0 w-full h-full object-cover
                                        transition-transform duration-500 group-hover:scale-110"
                                 loading="lazy"/>
                            <div class="absolute inset-0 bg-black/35 opacity-0
                                        group-hover:opacity-100 transition-opacity duration-200
                                        flex items-center justify-center pointer-events-none">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 h-[2px] bg-gold
                                        scale-x-0 group-hover:scale-x-100
                                        transition-transform duration-300 origin-left"></div>
                        </button>
                        @endforeach
                    </div>

                </div>
                @endforeach

            @endif

            <div class="mt-12 pt-8 border-t border-gray-100" data-aos="fade-up">
                <a href="{{ route('about') }}"
                   class="inline-flex items-center gap-2 text-sm text-gray-400
                          hover:text-gold transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Tentang Kami
                </a>
            </div>

        </div>

        {{-- ════════════════════════════════════════════════
             LIGHTBOX (MODERN UI/UX)
        ════════════════════════════════════════════════ --}}
        <div
            x-cloak
            x-show="lb.open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 backdrop-blur-none"
            x-transition:enter-end="opacity-100 backdrop-blur-xl"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 backdrop-blur-xl"
            x-transition:leave-end="opacity-0 backdrop-blur-none"
            class="fixed inset-0 z-[999] flex flex-col bg-black/90 backdrop-blur-xl"
            style="display:none"
        >
            {{-- Top Bar / Header --}}
            <div class="flex-shrink-0 flex items-center justify-between px-6 py-4 bg-gradient-to-b from-black/60 to-transparent z-10">
                <div class="flex items-center gap-4">
                    <div class="px-3 py-1 bg-white/10 rounded-full backdrop-blur-md border border-white/10">
                        <span class="font-mono text-xs text-white">
                            <span x-text="lb.current + 1" class="font-bold text-gold"></span>
                            <span class="mx-1 text-white/40">of</span>
                            <span x-text="lb.photos.length" class="text-white/80"></span>
                        </span>
                    </div>
                    <span class="hidden sm:block w-1 h-1 rounded-full bg-white/30"></span>
                    <span class="text-white/90 text-sm font-medium tracking-wide truncate max-w-[200px] sm:max-w-md drop-shadow-md" x-text="lb.title"></span>
                </div>
                
                <button
                    @click="closeLightbox()"
                    class="group flex items-center justify-center w-10 h-10 rounded-full bg-white/5 hover:bg-red-500/20 border border-transparent hover:border-red-500/50 text-white/60 hover:text-red-400 transition-all duration-200"
                    aria-label="Tutup"
                >
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Main Stage Area --}}
            <div class="flex-1 relative flex items-center justify-center min-h-0 overflow-hidden px-4 sm:px-16" @click.self="closeLightbox()">
                
                {{-- Tombol Prev --}}
                <button
                    @click="lbPrev()"
                    x-show="lb.photos.length > 1"
                    class="absolute left-4 sm:left-8 z-10 flex items-center justify-center w-12 h-12 rounded-full bg-black/40 hover:bg-gold border border-white/10 hover:border-gold text-white/70 hover:text-white backdrop-blur-md transition-all duration-200 hover:scale-110 shadow-lg"
                    aria-label="Sebelumnya"
                >
                    <svg class="w-6 h-6 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                {{-- Gambar --}}
                <div class="w-full h-full flex items-center justify-center py-4" @click.self="closeLightbox()">
                    <template x-if="lb.photos.length > 0">
                        <img
                            :src="lb.photos[lb.current]"
                            :alt="lb.title"
                            class="max-w-full max-h-full object-contain select-none rounded-lg drop-shadow-2xl ring-1 ring-white/10"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        />
                    </template>
                </div>

                {{-- Tombol Next --}}
                <button
                    @click="lbNext()"
                    x-show="lb.photos.length > 1"
                    class="absolute right-4 sm:right-8 z-10 flex items-center justify-center w-12 h-12 rounded-full bg-black/40 hover:bg-gold border border-white/10 hover:border-gold text-white/70 hover:text-white backdrop-blur-md transition-all duration-200 hover:scale-110 shadow-lg"
                    aria-label="Berikutnya"
                >
                    <svg class="w-6 h-6 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            {{-- Thumbnail Strip (Bottom) --}}
            <div
                class="flex-shrink-0 bg-gradient-to-t from-black/80 to-transparent py-6 px-4 overflow-x-auto"
                x-show="lb.photos.length > 1"
            >
                <div class="flex gap-3 w-max mx-auto px-4">
                    <template x-for="(p, i) in lb.photos" :key="i">
                        <button
                            @click="lb.current = i"
                            :class="lb.current === i
                                ? 'ring-2 ring-gold scale-110 z-10 shadow-[0_0_15px_rgba(212,175,55,0.5)]'
                                : 'opacity-40 hover:opacity-100 hover:scale-105'"
                            class="w-16 h-16 sm:w-20 sm:h-20 flex-shrink-0 overflow-hidden rounded-md transition-all duration-300 ease-out cursor-pointer"
                        >
                            <img :src="p" class="w-full h-full object-cover" alt="Thumbnail"/>
                        </button>
                    </template>
                </div>
            </div>
        </div>

    </section>

    <x-cta-section />

</x-layouts.app>