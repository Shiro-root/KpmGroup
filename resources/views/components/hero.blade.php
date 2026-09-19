{{--
    Hero Component
    @props:
      title    (HTML string, supports <span> for accent)
      subtitle (plain text)
      cta      (bool)   show CTA buttons
      size     (full|md) viewport height
      bgImage  (asset path or null)
--}}

@props([
    'title'    => null,
    'subtitle' => null,
    'cta'      => true,
    'size'     => 'full',
    'bgImage'  => null,
])

@php
    $title    = $title    ?? \App\Models\SiteSetting::get('home_hero_title',    'KPM Group');
    $subtitle = $subtitle ?? \App\Models\SiteSetting::get('home_hero_subtitle', '');

    $heights = [
        'full' => 'min-h-screen',
        'md'   => 'min-h-[55vh] md:min-h-[60vh]',
        'sm'   => 'min-h-[40vh]',
    ];
    $heightClass = $heights[$size] ?? $heights['full'];
@endphp

<section
    class="relative {{ $heightClass }} flex items-center overflow-hidden bg-charcoal"
    aria-label="Hero"
>
    {{-- ── Background Image ── --}}
    @if ($bgImage)
    <div
        class="absolute inset-0 bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset($bgImage) }}')"
        role="img"
        aria-hidden="true"
    ></div>
    @endif

    {{-- ── Industrial Grid Pattern ── --}}
    <div class="absolute inset-0 bg-grid-pattern" aria-hidden="true"></div>

    {{-- ── Gradient Overlay ── --}}
    <div class="absolute inset-0 bg-gradient-to-r
                from-charcoal/96 via-charcoal/82 to-charcoal/50"
         aria-hidden="true">
    </div>

    {{-- ── Gold Left Bar ── --}}
    <div class="gold-bar-left" aria-hidden="true"></div>

    {{-- ── Decorative Corner ── --}}
    <div class="absolute bottom-0 right-0 w-32 h-32
border-l border-t border-gold/10
pointer-events-none"
         aria-hidden="true">
    </div>

    {{-- ── Content ── --}}
    <div class="relative z-10 container-kpm pt-28 pb-20 md:pt-32 md:pb-24">
        <div class="max-w-3xl">

            {{-- Pre-label --}}
            <div class="eyebrow mb-6" data-aos="fade-right" data-aos-delay="80">
                <div class="eyebrow__line"></div>
                <span class="label-mono">PT. Kurniawan Power Mandiri</span>
            </div>

            {{-- Title --}}
            <h1
                class="heading-hero mb-6"
                data-aos="fade-up"
                data-aos-delay="180"
            >
                {!! $title !!}
            </h1>

            {{-- Subtitle --}}
            @if ($subtitle)
            <p
                class="text-gray-300 text-base md:text-lg leading-relaxed mb-10 max-w-lg"
                data-aos="fade-up"
                data-aos-delay="280"
            >
                {{ $subtitle }}
            </p>
            @endif

            {{-- CTA Buttons --}}
            @if ($cta)
            <div
                class="flex flex-col sm:flex-row gap-4"
                data-aos="fade-up"
                data-aos-delay="370"
            >
                <a href="{{ route('contact') }}" class="btn-primary">
                    Hubungi Kami
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('services') }}" class="btn-outline">
                    Layanan Kami
                </a>
            </div>
            @endif

        </div>
    </div>

    {{-- ── Scroll Indicator (full size only) ── --}}
    @if ($size === 'full')
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2
                flex flex-col items-center gap-2 pointer-events-none"
         data-aos="fade-in"
         data-aos-delay="900"
         aria-hidden="true"
    >
        <span class="font-mono text-[10px] text-white/35 tracking-[0.3em] uppercase">Scroll</span>
        <div class="w-px h-12 bg-gradient-to-b from-gold/50 to-transparent animate-pulse-gold"></div>
    </div>
    @endif

</section>
