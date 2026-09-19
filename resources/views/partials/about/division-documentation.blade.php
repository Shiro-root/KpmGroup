{{-- partials/about/division-documentation.blade.php --}}

@php
    $divisionMeta = [
        'construction' => ['label' => 'KPM Construction', 'color' => 'text-amber-600'],
        'engineering'  => ['label' => 'KPM Engineering',  'color' => 'text-blue-600'],
        'rd'           => ['label' => 'KPM R & D',        'color' => 'text-green-600'],
        'farm'         => ['label' => 'KPM Farm',         'color' => 'text-emerald-600'],
        'procurement'  => ['label' => 'KPM Procurement',  'color' => 'text-rose-600'],
    ];
@endphp

<section class="section-pad bg-white" aria-labelledby="divdoc-heading">
    <div class="container-kpm">

        {{-- ── Header ── --}}
        <div class="text-center mb-12">
            <div class="flex items-center justify-center gap-3 mb-4" data-aos="fade-down">
                <div class="w-8 h-px bg-gold"></div>
                <span class="label-mono">Dokumentasi</span>
                <div class="w-8 h-px bg-gold"></div>
            </div>
            <h2 id="divdoc-heading" class="heading-section" data-aos="fade-up">
                Foto Kegiatan Divisi
            </h2>
            <p class="body-sm max-w-md mx-auto mt-3" data-aos="fade-up" data-aos-delay="60">
                Pilih divisi untuk melihat dokumentasi kegiatan dan portofolio.
            </p>
        </div>

        {{-- ── Division Cards ── --}}
        @if($documentations->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <svg class="w-14 h-14 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2
                             l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6
                             20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2
                             2v12a2 2 0 002 2z"/>
                </svg>
                <p class="body-sm">Dokumentasi belum tersedia.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($documentations as $divKey => $docs)
                @php
                    $meta         = $divisionMeta[$divKey] ?? ['label' => ucfirst($divKey), 'color' => 'text-gold'];
                    $totalPhotos  = $docs->sum(fn($d) => count($d->photo_urls));
                    $totalEntries = $docs->count();
                    $mosaicUrls   = $docs->flatMap(fn($d) => $d->photo_urls)->take(4)->values();
                @endphp

                {{-- Card — sekarang pakai <a> link ke halaman dedicated --}}
                <a
                    href="{{ route('about.documentation', $divKey) }}"
                    class="group block border border-gray-100 hover:border-gold/40
                           transition-colors duration-200
                           focus:outline-none focus:ring-2 focus:ring-gold/30"
                    data-aos="fade-up"
                    data-aos-delay="{{ $loop->index * 80 }}"
                    aria-label="Lihat dokumentasi {{ $meta['label'] }}"
                >
                    {{-- Mosaic --}}
                    <div class="relative overflow-hidden bg-gray-100 w-full" style="aspect-ratio:16/9">

                        @if($mosaicUrls->count() >= 4)
                            <div class="absolute inset-0 grid grid-cols-2 grid-rows-2 gap-px">
                                @foreach($mosaicUrls as $mUrl)
                                <div class="overflow-hidden">
                                    <img src="{{ $mUrl }}" alt=""
                                         class="w-full h-full object-cover
                                                transition-transform duration-500 group-hover:scale-105"
                                         loading="lazy"/>
                                </div>
                                @endforeach
                            </div>

                        @elseif($mosaicUrls->count() >= 2)
                            <div class="absolute inset-0 flex gap-px">
                                @foreach($mosaicUrls->take(2) as $mUrl)
                                <div class="flex-1 overflow-hidden">
                                    <img src="{{ $mUrl }}" alt=""
                                         class="w-full h-full object-cover
                                                transition-transform duration-500 group-hover:scale-105"
                                         loading="lazy"/>
                                </div>
                                @endforeach
                            </div>

                        @elseif($mosaicUrls->count() === 1)
                            <img src="{{ $mosaicUrls[0] }}" alt=""
                                 class="absolute inset-0 w-full h-full object-cover
                                        transition-transform duration-500 group-hover:scale-105"
                                 loading="lazy"/>

                        @else
                            <div class="absolute inset-0 flex items-center justify-center bg-gray-50">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2
                                             l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6
                                             20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0
                                             00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif

                        {{-- Hover overlay --}}
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100
                                    transition-opacity duration-300 flex items-center justify-center
                                    pointer-events-none">
                            <span class="bg-white text-charcoal text-xs font-medium
                                         px-4 py-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                                             9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat Semua Foto
                            </span>
                        </div>

                        {{-- Gold bottom bar --}}
                        <div class="absolute bottom-0 left-0 right-0 h-[3px] bg-gold
                                    scale-x-0 group-hover:scale-x-100
                                    transition-transform duration-300 origin-left"></div>
                    </div>

                    {{-- Card footer --}}
                    <div class="px-4 py-3 flex items-center justify-between
                                border-t border-gray-100 group-hover:border-gold/20
                                transition-colors duration-200">
                        <div>
                            <h3 class="font-display font-semibold text-charcoal text-[15px]
                                       group-hover:text-gold transition-colors duration-200">
                                {{ $meta['label'] }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-0.5">
                                {{ $totalEntries }} kegiatan &middot; {{ $totalPhotos }} foto
                            </p>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-gold
                                    group-hover:translate-x-1 transition-all duration-200"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
                @endforeach
            </div>
        @endif

    </div>
</section>