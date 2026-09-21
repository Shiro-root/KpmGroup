@props([
    'slides'   => [],
    'interval' => 3500,
    'title'    => null,
    'subtitle' => null,
    'cta'      => true,
])

@php $count = count($slides); @endphp

@if ($count)
<section
    class="relative w-full overflow-hidden bg-charcoal-800 mt-[72px] md:mt-20"
    aria-roledescription="carousel"
    aria-label="Banner utama"
    x-data="{
        current: 0,
        total: {{ $count }},
        timer: null,
        touchX: null,
        next()    { this.current = (this.current + 1) % this.total },
        prev()    { this.current = (this.current - 1 + this.total) % this.total },
        go(i)     { this.current = i; this.restart() },
        start()   { if (this.total > 1) { this.timer = setInterval(() => this.next(), {{ (int) $interval }}) } },
        stop()    { clearInterval(this.timer) },
        restart() { this.stop(); this.start() },
        onTouchStart(e) { this.touchX = e.touches[0].clientX },
        onTouchEnd(e) {
            if (this.touchX === null) return;
            const d = e.changedTouches[0].clientX - this.touchX;
            if (Math.abs(d) > 50) { d < 0 ? this.next() : this.prev(); this.restart() }
            this.touchX = null;
        },
    }"
    x-init="start()"
    @mouseenter="stop()"
    @mouseleave="start()"
    @touchstart.passive="onTouchStart($event)"
    @touchend.passive="onTouchEnd($event)"
>
    <h1 class="sr-only">PT. Kurniawan Power Mandiri — KPM Group</h1>

    {{-- Track --}}
    <div class="relative h-[480px] sm:h-[540px] md:h-[600px] lg:h-[680px]">
        <div
            class="flex h-full transition-transform duration-500 ease-in-out"
            :style="`transform: translateX(-${current * 100}%)`"
        >
            @foreach ($slides as $i => $slide)
            <div class="w-full h-full flex-shrink-0 relative">
                <img
                    src="{{ asset('images/' . $slide['image']) }}"
                    alt="{{ $slide['alt'] ?? 'Banner KPM Group ' . ($i + 1) }}"
                    class="w-full h-full object-cover select-none"
                    loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                    draggable="false"
                >
                {{-- Gradient overlay supaya teks tetap terbaca di atas foto apapun --}}
                <div class="absolute inset-0 bg-gradient-to-r
                            from-charcoal/90 via-charcoal/55 to-charcoal/20"
                     aria-hidden="true"></div>
            </div>
            @endforeach
        </div>

        {{-- ── Overlay: Judul, Subjudul, CTA ── --}}
        @if ($title)
        <div class="absolute inset-0 z-[5] flex items-center pointer-events-none">
            <div class="container-kpm w-full">
                <div class="max-w-2xl pointer-events-auto">

                    <div class="eyebrow mb-5" data-aos="fade-right" data-aos-delay="80">
                        <div class="eyebrow__line"></div>
                        <span class="label-mono">PT. Kurniawan Power Mandiri</span>
                    </div>

                    <h2 class="heading-hero mb-5" data-aos="fade-up" data-aos-delay="150">
                        {!! $title !!}
                    </h2>

                    @if ($subtitle)
                    <p class="text-gray-200 text-base md:text-lg leading-relaxed mb-8 max-w-lg"
                       data-aos="fade-up" data-aos-delay="230">
                        {{ $subtitle }}
                    </p>
                    @endif

                    @if ($cta)
                    <div class="flex flex-col sm:flex-row gap-4"
                         data-aos="fade-up" data-aos-delay="310">
                        <a href="{{ route('contact') }}" class="btn-primary">
                            Hubungi Kami
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        </div>
        @endif
    </div>

    @if ($count > 1)
    {{-- Panah kiri --}}
    <button
        type="button"
        @click="prev(); restart()"
        aria-label="Slide sebelumnya"
        class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 z-20
               w-10 h-10 sm:w-12 sm:h-12 rounded-full
               flex items-center justify-center
               bg-black/40 text-white backdrop-blur-sm
               hover:bg-gold transition-colors duration-300"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    {{-- Panah kanan --}}
    <button
        type="button"
        @click="next(); restart()"
        aria-label="Slide berikutnya"
        class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 z-20
               w-10 h-10 sm:w-12 sm:h-12 rounded-full
               flex items-center justify-center
               bg-black/40 text-white backdrop-blur-sm
               hover:bg-gold transition-colors duration-300"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Dots --}}
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
        <template x-for="i in total" :key="i">
            <button
                type="button"
                @click="go(i - 1)"
                :aria-label="`Ke slide ${i}`"
                :class="current === i - 1 ? 'w-8 bg-gold' : 'w-2 bg-white/60 hover:bg-white'"
                class="h-2 rounded-full transition-all duration-300"
            ></button>
        </template>
    </div>
    @endif
</section>
@endif