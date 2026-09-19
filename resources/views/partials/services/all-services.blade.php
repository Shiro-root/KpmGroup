@php
use Illuminate\Support\Facades\Storage;

/*
 * Divisions are loaded from DB ($services) but we keep a static fallback
 * so the page renders even before seeding.
 */
$staticDivisions = [
    'construction' => [
        'title'   => 'KPM Construction',
        'tagline' => 'Konstruksi berkualitas internasional',
        'desc'    => 'Divisi konstruksi KPM mengerjakan proyek infrastruktur energi dan sipil dengan tenaga ahli bersertifikat. Mengedepankan keselamatan, presisi, dan ketepatan waktu dalam setiap pekerjaan.',
        'icon'    => '<svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>',
        'items'   => [
            ['name' => 'Pembuatan Gardu Induk', 'desc' => 'Pembangunan gardu induk tegangan menengah dan tinggi sesuai standar PLN.'],
            ['name' => 'Instalasi Jaringan Listrik', 'desc' => 'Pemasangan jaringan listrik saluran udara dan bawah tanah.'],
            ['name' => 'Maintenance', 'desc' => 'Pemeliharaan berkala infrastruktur kelistrikan untuk menjaga keandalan sistem.'],
            ['name' => 'Konstruksi Sipil', 'desc' => 'Pembangunan gedung, fasilitas, dan infrastruktur pendukung industri.'],
        ],
    ],
    'engineering' => [
        'title'   => 'KPM Engineering',
        'tagline' => 'Rekayasa teknik inovatif',
        'desc'    => 'Tim insinyur profesional KPM Engineering memberikan solusi teknik yang inovatif, dari perencanaan, desain, hingga supervisi teknis proyek industri.',
        'icon'    => '<svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
        'items'   => [
            ['name' => 'Perencanaan Sistem', 'desc' => 'Perancangan sistem mekanikal, elektrikal, dan instrumentasi.'],
            ['name' => 'Desain Teknis', 'desc' => 'Pembuatan gambar teknis, kalkulasi engineering, dan spesifikasi proyek.'],
        ],
    ],
    'rd' => [
        'title'   => 'KPM Research & Development',
        'tagline' => 'Inovasi untuk masa depan',
        'desc'    => 'KPM R&D berfokus pada pengembangan teknologi terapan dan penelitian inovatif yang menjawab tantangan industri energi masa kini.',
        'icon'    => '<svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>',
        'items'   => [
            ['name' => 'Inovasi Teknologi & Energi', 'desc' => 'Penelitian dan pengembangan solusi energi terbarukan.'],
        ],
    ],
    'farm' => [
        'title'   => 'KPM Farm',
        'tagline' => 'Agrikultur berbasis teknologi',
        'desc'    => 'KPM Farm mengintegrasikan pertanian modern dengan teknologi presisi untuk produktivitas lahan yang berkelanjutan.',
        'icon'    => '<svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>',
        'items'   => [
            ['name' => 'Pertanian Presisi', 'desc' => 'Teknologi sensor dan analisis data untuk mengoptimalkan hasil.'],
            ['name' => 'Agribisnis', 'desc' => 'Model bisnis pertanian yang profitabel dan berkelanjutan.'],
        ],
    ],
    'procurement' => [
        'title'   => 'KPM Procurement',
        'tagline' => 'Pengadaan efisien & terpercaya',
        'desc'    => 'KPM Procurement menjamin ketersediaan material dan peralatan proyek dengan harga kompetitif melalui jaringan vendor terverifikasi.',
        'icon'    => '<svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>',
        'items'   => [
            ['name' => 'Pengadaan Barang & Material Proyek', 'desc' => 'Penyediaan material berkualitas sesuai spesifikasi.'],
            ['name' => 'Manajemen Vendor', 'desc' => 'Seleksi dan evaluasi vendor untuk keandalan pasokan.'],
        ],
    ],
];

// Merge DB services over static fallbacks
$dbMap = $services->keyBy('division');
@endphp

<div class="section-pad">
    <div class="container-kpm space-y-5">

        @foreach ($staticDivisions as $divKey => $static)
        @php
            $db      = $dbMap->get($divKey);
            $title   = $db?->name        ?? $static['title'];
            $tagline = $db?->tagline     ?? $static['tagline'];
            $desc    = $db?->short_description ?? $static['desc'];
            $items   = $db?->sub_services ?? $static['items'];
            $icon    = $static['icon'];   // always use static SVG icons
            $logoUrl = $db?->logo ? Storage::url($db->logo) : null;
        @endphp

        <article
            class="border border-gray-100 bg-white
                   hover:border-gold/20 hover:shadow-lg hover:shadow-gold/5
                   transition-all duration-300"
            x-data="{ open: false }"
            data-aos="fade-up"
            data-aos-delay="{{ $loop->index * 60 }}"
            id="division-{{ $divKey }}"
        >
            {{-- Header --}}
            <button
                type="button"
                class="w-full flex items-center justify-between gap-6 px-6 md:px-8 py-6 text-left group"
                @click="open = !open"
                :aria-expanded="open"
            >
                <div class="flex items-center gap-5">
                    {{-- Logo or Icon --}}
                    @if ($logoUrl)
                    <div class="w-14 h-14 flex items-center justify-center flex-shrink-0
                                bg-white border border-gray-100 p-1.5">
                        <img src="{{ $logoUrl }}" alt="{{ $title }} logo"
                             class="w-full h-full object-contain" loading="lazy">
                    </div>
                    @else
                    <div class="w-14 h-14 bg-gold/8 flex items-center justify-center
                                flex-shrink-0 group-hover:bg-gold/15 transition-colors duration-300">
                        {!! $icon !!}
                    </div>
                    @endif

                    <div>
                        <p class="label-mono text-[10px] mb-1">{{ $tagline }}</p>
                        <h2 class="font-display text-xl md:text-2xl font-bold text-charcoal
                                   group-hover:text-gold transition-colors duration-300">
                            {{ $title }}
                        </h2>
                    </div>
                </div>

                <div class="flex-shrink-0 w-8 h-8 border border-gray-200
                            group-hover:border-gold/40 flex items-center justify-center
                            transition-colors duration-300">
                    <svg class="w-4 h-4 text-charcoal-500 transition-transform duration-300"
                         :class="open ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </button>

            {{-- Gold bar --}}
            <div class="h-[2px] bg-gradient-to-r from-gold to-gold/30 transition-all duration-300"
                 :class="open ? 'opacity-100' : 'opacity-0'"
                 aria-hidden="true">
            </div>

            {{-- Body --}}
            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-250"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                style="display:none"
            >
                <div class="px-6 md:px-8 pb-8 pt-5">
                    <div class="grid md:grid-cols-12 gap-8">

                        <div class="md:col-span-4">
                            <p class="body-sm leading-relaxed mb-6">{{ $desc }}</p>

                            @if ($db?->full_description)
                            <div class="prose prose-sm text-charcoal-500 max-w-none mb-6">
                                {!! $db->full_description !!}
                            </div>
                            @endif

                            <a href="{{ route('contact') }}" class="btn-primary text-sm px-5 py-2.5 inline-flex">
                                Konsultasi Divisi Ini
                            </a>
                        </div>

                        <div class="md:col-span-8">
                            @if (count($items ?? []))
                            <div class="grid sm:grid-cols-2 gap-4">
                                @foreach ($items as $item)
                                @php
                                    $itemName = is_array($item) ? ($item['name'] ?? '') : $item;
                                    $itemDesc = is_array($item) ? ($item['description'] ?? $item['desc'] ?? '') : '';
                                @endphp
                                <div class="p-5 bg-gray-50 border border-gray-100
                                            hover:border-gold/25 transition-colors duration-200 group">
                                    <div class="flex items-start gap-3 mb-2">
                                        <div class="w-5 h-5 bg-gold/15 flex items-center justify-center
                                                    flex-shrink-0 mt-0.5 group-hover:bg-gold/25
                                                    transition-colors duration-200">
                                            <span class="w-1.5 h-1.5 bg-gold rounded-full block"></span>
                                        </div>
                                        <h3 class="font-semibold text-charcoal text-sm
                                                    group-hover:text-gold transition-colors duration-200">
                                            {{ $itemName }}
                                        </h3>
                                    </div>
                                    @if ($itemDesc)
                                    <p class="text-charcoal-500 text-xs leading-relaxed pl-8">
                                        {{ $itemDesc }}
                                    </p>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </article>
        @endforeach

    </div>
</div>
