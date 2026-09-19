<x-layouts.app
    seoTitle="Beranda"
    seoDescription="PT. Kurniawan Power Mandiri (KPM Group) — Solusi terpadu konstruksi, engineering, riset, agrikultur, dan pengadaan untuk industri Indonesia."
>

    {{-- HERO --}}
    <x-hero
        :title="$settings['hero_title']"
        :subtitle="$settings['hero_subtitle']"
        :cta="true"
        size="full"
        bgImage="images/hero-bg.jpg"
    />

    {{-- STATS BAR --}}
    <div class="stats-bar" data-aos="fade-up" data-aos-offset="0">
        <div class="container-kpm">
            <div class="stats-bar__grid">
                @foreach ([
                    ['number' => $settings['stats_exp'],       'label' => 'Tahun Pengalaman'],
                    ['number' => $settings['stats_divisions'],  'label' => 'Divisi Bisnis'],
                    ['number' => $settings['stats_projects'],   'label' => 'Proyek Selesai'],
                    ['number' => $settings['stats_team'],       'label' => 'Tim Profesional'],
                ] as $stat)
                <div class="stat-card">
                    <div class="stat-card__number">{{ $stat['number'] }}</div>
                    <div class="stat-card__label">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- COMPANY INTRO --}}
    @include('partials.home.company-intro', ['settings' => $settings])

    {{-- SERVICES OVERVIEW --}}
    @include('partials.home.services-overview', ['services' => $services])

    {{-- WHY US --}}
    @include('partials.home.why-us')

    {{-- CTA --}}
    <x-cta-section
        :title="$settings['cta_title']"
        :subtitle="$settings['cta_subtitle']"
    />

</x-layouts.app>
