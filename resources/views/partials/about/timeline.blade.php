{{-- partials/about/timeline.blade.php --}}

@php
    $raw = \App\Models\SiteSetting::get('milestones', null);

    if ($raw === null) {
        // Belum pernah diatur sama sekali dari admin → tampilkan contoh default
        $events = [
            ['year' => '2010', 'title' => 'Pendirian KPM Group',                'description' => 'PT. Kurniawan Power Mandiri didirikan dengan fokus awal pada sektor konstruksi dan kelistrikan di Lampung.'],
            ['year' => '2013', 'title' => 'Ekspansi KPM Engineering',           'description' => 'Pembentukan divisi Engineering untuk memperluas layanan rekayasa teknik dan konsultasi sistem industri.'],
            ['year' => '2016', 'title' => 'Lahirnya KPM Research & Development','description' => 'Divisi R&D dibentuk sebagai respons terhadap kebutuhan inovasi teknologi energi yang semakin meningkat.'],
            ['year' => '2018', 'title' => 'Diversifikasi ke KPM Farm',          'description' => 'Memasuki sektor agrikultur dengan pendekatan pertanian presisi berbasis teknologi modern.'],
            ['year' => '2020', 'title' => 'KPM Procurement Resmi Beroperasi',   'description' => 'Divisi Procurement hadir untuk melengkapi layanan grup dan memastikan rantai pasokan yang efisien.'],
            ['year' => '2024', 'title' => 'Pertumbuhan & Penguatan Kapasitas',  'description' => 'KPM Group terus berkembang dengan lebih dari 100 tim profesional dan portofolio proyek yang semakin luas di seluruh Indonesia.'],
        ];
    } else {
        // Sudah pernah disimpan admin (termasuk sengaja dikosongkan) → pakai apa adanya
        $events = json_decode($raw, true) ?: [];
    }
@endphp

@if (count($events))
<section class="section-pad" aria-labelledby="timeline-heading">
    <div class="container-kpm">

        <div class="text-center mb-14">
            <div class="flex items-center justify-center gap-3 mb-4" data-aos="fade-down">
                <div class="w-8 h-px bg-gold"></div>
                <span class="label-mono">Perjalanan Kami</span>
                <div class="w-8 h-px bg-gold"></div>
            </div>
            <h2 id="timeline-heading" class="heading-section" data-aos="fade-up">
                Milestone KPM Group
            </h2>
        </div>

        <div class="timeline max-w-4xl mx-auto">

            <div class="timeline__spine" aria-hidden="true"></div>

            <div class="space-y-10 md:space-y-12">
                @foreach ($events as $i => $event)
                <div
                    class="relative flex
                           {{ $i % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse' }}
                           flex-col gap-6 md:gap-8 items-start md:items-center"
                    data-aos="{{ $i % 2 === 0 ? 'fade-right' : 'fade-left' }}"
                    data-aos-delay="{{ $i * 60 }}"
                >
                    <div class="md:w-[calc(50%-2.5rem)]">
                        <article class="timeline__card">
                            <span class="timeline__year">{{ $event['year'] ?? '' }}</span>
                            <h3 class="timeline__title">{{ $event['title'] ?? '' }}</h3>
                            <p class="timeline__desc">{{ $event['description'] ?? '' }}</p>
                        </article>
                    </div>

                    <div class="timeline__dot" aria-hidden="true"></div>

                    <div class="hidden md:block md:w-[calc(50%-2.5rem)]"></div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
@endif