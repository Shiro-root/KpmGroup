{{-- partials/home/company-intro.blade.php --}}

<section class="section-pad" aria-labelledby="intro-heading">
    <div class="container-kpm">
        <div class="grid md:grid-cols-2 gap-14 lg:gap-20 items-center">

            <div>
                <div class="eyebrow" data-aos="fade-right">
                    <div class="eyebrow__line"></div>
                    <span class="label-mono">Tentang Kami</span>
                </div>

                <h2 id="intro-heading" class="heading-section mb-6" data-aos="fade-up">
                    {{ $settings['intro_tagline_line1'] ?? 'Satu Group,' }}<br>
                    <span class="text-accent">{{ $settings['intro_tagline_line2'] ?? 'Lima Kekuatan' }}</span>
                </h2>

                <p class="body-lead mb-4" data-aos="fade-up" data-aos-delay="80">
                    {{ $settings['intro'] ?: 'PT. Kurniawan Power Mandiri (KPM Group) adalah perusahaan multi-divisi yang bergerak di bidang konstruksi, engineering, riset & pengembangan, agrikultur, dan pengadaan barang.' }}
                </p>
                <p class="body-sm mb-9" data-aos="fade-up" data-aos-delay="120">
                    {{ $settings['intro_sub'] ?: 'Dengan pengalaman lebih dari satu dekade, kami hadir sebagai mitra terpercaya bagi berbagai sektor industri di Indonesia.' }}
                </p>

                <a href="{{ route('about') }}"
                   class="btn-ghost arrow-right inline-flex items-center gap-2"
                   data-aos="fade-up" data-aos-delay="160">
                    <span>Profil Lengkap Perusahaan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            @php
                $introImages = $settings['intro_images'] ?? ['about-visual.jpg'];
            @endphp

            <div class="intro-frame"
                 data-aos="fade-left" data-aos-delay="120"
                 x-data="{
                    slides: {{ count($introImages) }},
                    current: 0,
                    next() { this.current = (this.current + 1) % this.slides },
                    prev() { this.current = (this.current - 1 + this.slides) % this.slides }
                 }">

                {{-- Track slide --}}
                <div class="intro-frame__track" :style="`transform: translateX(-${current * 100}%)`">
                    @foreach ($introImages as $img)
                    <div class="intro-frame__slide">
                        <img src="{{ asset('images/' . $img) }}"
                             alt="KPM Group Operations {{ $loop->iteration }}"
                             class="intro-frame__img"
                             loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                    </div>
                    @endforeach
                </div>

                <div class="intro-frame__hover-border"></div>
                <div class="intro-frame__gold-box" aria-hidden="true"></div>
                <div class="intro-frame__border" aria-hidden="true"></div>

                <div class="absolute bottom-0 left-0 right-0
                            bg-gradient-to-t from-charcoal/80 to-transparent p-5 pointer-events-none z-10">
                    <span class="label-mono text-[10px]">
                        Established Since {{ $settings['established_year'] ?? '2010' }}
                    </span>
                </div>

                {{-- Tombol kanan/kiri — cuma tampil kalau slide > 1 --}}
                @if (count($introImages) > 1)
                <button @click="prev()" type="button" aria-label="Slide sebelumnya"
                    class="intro-frame__nav intro-frame__nav--prev">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button @click="next()" type="button" aria-label="Slide berikutnya"
                    class="intro-frame__nav intro-frame__nav--next">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                {{-- Dots indicator --}}
                <div class="intro-frame__dots">
                    <template x-for="i in slides" :key="i">
                        <button type="button"
                            @click="current = i - 1"
                            :class="current === i - 1 ? 'intro-frame__dot intro-frame__dot--active' : 'intro-frame__dot'"
                            :aria-label="`Ke slide ${i}`"></button>
                    </template>
                </div>
                @endif

            </div>

        </div>
    </div>
</section>