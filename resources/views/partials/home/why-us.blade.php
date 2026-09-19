{{-- partials/home/why-us.blade.php --}}
{{-- Why-us section — semua teks & gambar dari $settings (dinamis dari admin) --}}

<section class="section-pad" aria-labelledby="why-heading">
    <div class="container-kpm">

        <div class="why-us-grid">

            {{-- ── Left: Pillars list ── --}}
            <div class="why-us-left">
                <div class="eyebrow" data-aos="fade-right">
                    <div class="eyebrow__line"></div>
                    <span class="label-mono">Mengapa KPM Group</span>
                </div>

                <h2
                    id="why-heading"
                    class="heading-section mb-10"
                    data-aos="fade-up"
                >
                    {{ $settings['whyus_title'] ?? 'Komitmen Kami' }}<br>
                    <span class="text-accent">{{ $settings['whyus_subtitle'] ?? 'untuk Anda' }}</span>
                </h2>

                <dl class="why-us-pillars">
                    @foreach (($settings['whyus_points'] ?? []) as $i => $pillar)
                    <div
                        class="mission-item"
                        data-aos="fade-up"
                        data-aos-delay="{{ $i * 80 }}"
                    >
                        <div class="mission-item__num" aria-hidden="true">
                            <span class="font-mono text-gold text-xs font-bold">
                                {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <div>
                            <dt class="font-semibold text-charcoal mb-1 text-sm md:text-base">
                                {{ $pillar['title'] }}
                            </dt>
                            <dd class="body-sm">{{ $pillar['desc'] }}</dd>
                        </div>
                    </div>
                    @endforeach
                </dl>
            </div>

            {{-- ── Right: Bento grid 5 gambar ── --}}
            @php
            $thumbs = [
                ['label' => $settings['whyus_label_1'] ?? 'Construction', 'img' => 'images/' . ($settings['whyus_img_1'] ?? 'thumb-construction.jpg')],
                ['label' => $settings['whyus_label_2'] ?? 'Engineering',  'img' => 'images/' . ($settings['whyus_img_2'] ?? 'thumb-engineering.jpg')],
                ['label' => $settings['whyus_label_3'] ?? 'R & D',        'img' => 'images/' . ($settings['whyus_img_3'] ?? 'thumb-rd.jpg')],
                ['label' => $settings['whyus_label_4'] ?? 'Farm',         'img' => 'images/' . ($settings['whyus_img_4'] ?? 'thumb-farm.jpg')],
                ['label' => $settings['whyus_label_5'] ?? 'Procurement',  'img' => 'images/' . ($settings['whyus_img_5'] ?? 'thumb-procurement.jpg')],
            ];
            @endphp

            <div class="bento-grid" data-aos="fade-left" data-aos-delay="150">

                {{-- Gambar 1: Construction — besar, span 2 baris kiri --}}
                <div class="bento-cell bento-cell--main">
                    <img
                        src="{{ asset($thumbs[0]['img']) }}"
                        alt="{{ $thumbs[0]['label'] }}"
                        class="bento-img"
                        loading="lazy"
                    >
                    <div class="bento-overlay"></div>
                    <span class="bento-label">{{ $thumbs[0]['label'] }}</span>
                </div>

                {{-- Gambar 2: Engineering — kanan atas --}}
                <div class="bento-cell bento-cell--top-right">
                    <img
                        src="{{ asset($thumbs[1]['img']) }}"
                        alt="{{ $thumbs[1]['label'] }}"
                        class="bento-img"
                        loading="lazy"
                    >
                    <div class="bento-overlay"></div>
                    <span class="bento-label">{{ $thumbs[1]['label'] }}</span>
                </div>

                {{-- Gambar 3: R&D — kanan tengah --}}
                <div class="bento-cell bento-cell--mid-right">
                    <img
                        src="{{ asset($thumbs[2]['img']) }}"
                        alt="{{ $thumbs[2]['label'] }}"
                        class="bento-img"
                        loading="lazy"
                    >
                    <div class="bento-overlay"></div>
                    <span class="bento-label">{{ $thumbs[2]['label'] }}</span>
                </div>

                {{-- Gambar 4: Farm — bawah kiri --}}
                <div class="bento-cell bento-cell--bot-left">
                    <img
                        src="{{ asset($thumbs[3]['img']) }}"
                        alt="{{ $thumbs[3]['label'] }}"
                        class="bento-img"
                        loading="lazy"
                    >
                    <div class="bento-overlay"></div>
                    <span class="bento-label">{{ $thumbs[3]['label'] }}</span>
                </div>

                {{-- Gambar 5: Procurement — bawah kanan --}}
                <div class="bento-cell bento-cell--bot-right">
                    <img
                        src="{{ asset($thumbs[4]['img']) }}"
                        alt="{{ $thumbs[4]['label'] }}"
                        class="bento-img"
                        loading="lazy"
                    >
                    <div class="bento-overlay"></div>
                    <span class="bento-label">{{ $thumbs[4]['label'] }}</span>
                </div>

            </div>

        </div>
    </div>
</section>