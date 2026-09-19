{{--
    Service Card Component
    @props:
      title       Heading divisi
      description Deskripsi singkat
      icon        Named slot — SVG markup (fallback jika tidak ada logoUrl)
      logoUrl     URL logo dari admin (opsional, override icon)
      tagline     Tagline singkat divisi, mis. "Konstruksi berkualitas internasional"
      delay       AOS animation delay (ms)
    @slot (default) = Konten detail yang tampil di dalam modal (list sub-services, judul saja)
--}}

@props([
    'title'       => '',
    'description' => '',
    'icon'        => '',
    'logoUrl'     => null,
    'tagline'     => null,
    'delay'       => 0,
])

<article
    class="service-card group"
    data-aos="fade-up"
    data-aos-delay="{{ $delay }}"
    x-data="{ open: false }"
    @click="open = true"
    role="button"
    tabindex="0"
    @keydown.enter="open = true"
    aria-label="Detail {{ $title }}"
>
    {{-- Gold gradient bar — slides in on hover --}}
    <div class="service-card__bar" aria-hidden="true"></div>

    <div class="service-card__inner">

        {{-- ── Header: Logo/Icon + Title ── --}}
        <div class="service-card__header">

            @if ($logoUrl)
                <div class="service-card__logo" aria-hidden="true">
                    <img src="{{ $logoUrl }}" alt="{{ $title }} logo" loading="lazy">
                </div>
            @else
                <div class="service-card__icon" aria-hidden="true">
                    {!! $icon !!}
                </div>
            @endif

            <div class="service-card__title-block">
                @if ($tagline)
                    <p class="service-card__tagline">{{ $tagline }}</p>
                @endif
                <h3 class="service-card__title">{{ $title }}</h3>
            </div>

        </div>

        <div class="service-card__divider" aria-hidden="true"></div>

        <p class="service-card__desc">{{ $description }}</p>

        <div class="service-card__cta">
            <span class="service-card__cta-label">Selengkapnya</span>
            <div class="service-card__cta-arrow" aria-hidden="true">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                          d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════════════════
         MODAL — di-teleport langsung ke <body> via Alpine x-teleport.
         Ini FIX untuk bug "modal terjebak di dalam card": .service-card
         punya `transform` (hover:-translate-y) + overflow-hidden, yang
         membuat modal fixed-position ikut terclip. Dengan teleport,
         modal selalu jadi sibling langsung dari <body>, lepas dari
         stacking context card manapun.
    ═══════════════════════════════════════════════════════════ --}}
  <template x-teleport="body">
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="modal-backdrop"
            @click.self="open = false"
            @keydown.escape.window="open = false"
            role="dialog"
            :aria-modal="open"
            aria-labelledby="modal-title-{{ Str::slug($title) }}"
            style="display:none"
        >
            <div
                class="modal-box max-w-3xl"
                @click.stop
                x-transition:enter="transition ease-out duration-250"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
            >
                <div class="modal-box__bar" aria-hidden="true"></div>

                <button @click="open = false" class="modal-close" aria-label="Tutup modal">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <div class="modal-scroll">

                    {{-- ── Header: logo + tagline + title (centered) ── --}}
                    <div class="modal-header">
                        @if ($logoUrl)
                            <div class="modal-header__icon" aria-hidden="true">
                                <img src="{{ $logoUrl }}" alt="{{ $title }} logo" loading="lazy">
                            </div>
                        @else
                            <div class="modal-header__icon" aria-hidden="true">
                                {!! $icon !!}
                            </div>
                        @endif

                        @if ($tagline)
                            <p class="modal-header__tagline">{{ $tagline }}</p>
                        @endif

                        <h2 class="modal-header__title" id="modal-title-{{ Str::slug($title) }}">
                            {{ $title }}
                        </h2>
                    </div>

                    <div class="modal-divider" aria-hidden="true"></div>

                    {{--
                        ── Body: deskripsi+CTA (kiri) / grid spesialisasi (kanan) ──
                        Kalau sub_services KOSONG, jangan render grid 2 kolom — grid
                        item secara default "stretch" jadi kolom kanan yang isinya
                        cuma label+link akan ikut diregangkan setinggi kolom kiri,
                        menyisakan ruang kosong besar (tidak proporsional). Jadi kalau
                        kosong, pakai layout 1 kolom saja dan link "lihat detail"
                        dipindah ke bawah CTA di kolom kiri.
                    --}}
                    <div class="modal-body {{ $slot->isNotEmpty() ? 'modal-body--split' : 'modal-body--single' }}">
                        <div class="modal-body__left {{ $slot->isEmpty() ? 'modal-body__left--center' : '' }}">
                            <p class="modal-body__desc">{{ $description }}</p>
                            <div class="modal-body__cta">
                                <a href="{{ route('contact') }}" class="btn-primary text-sm py-3 {{ $slot->isEmpty() ? 'px-10' : 'w-full justify-center' }}">
                                    Konsultasi Sekarang
                                </a>
                            </div>

                            @if ($slot->isEmpty())
                            <a href="{{ route('services') }}" class="modal-body__more-link modal-body__more-link--center">
                                Lihat detail lengkap di halaman Layanan
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                          d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                            @endif
                        </div>

                        @if ($slot->isNotEmpty())
                        <div class="modal-body__right">
                            <p class="modal-body__right-label">Sub Layanan</p>
                            <div class="modal-spec-grid">
                                {{ $slot }}
                            </div>

                            <a href="{{ route('services') }}" class="modal-body__more-link">
                                Lihat detail lengkap di halaman Layanan
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                          d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </template>

</article>