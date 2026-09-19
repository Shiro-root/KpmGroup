<section class="section-pad bg-charcoal relative overflow-hidden" aria-labelledby="vm-heading">
    <div class="absolute inset-0 bg-grid-pattern opacity-50" aria-hidden="true"></div>
    <div class="gold-bar-left" aria-hidden="true"></div>

    <div class="relative z-10 container-kpm">

        <div class="text-center mb-14">
            <span class="label-mono" data-aos="fade-down">Arah & Tujuan</span>
            <h2 id="vm-heading"
                class="font-display text-4xl md:text-5xl font-bold text-white mt-4"
                data-aos="fade-up">
                Visi &amp; Misi
            </h2>
        </div>

        <div class="vm-section">

            {{-- VISI --}}
            <div class="relative bg-white/5 border border-white/10
                        hover:border-gold/30 transition-colors duration-300 p-10"
                 data-aos="fade-right">
                <div class="absolute -top-4 left-8">
                    <span class="bg-gold text-white font-mono text-xs font-bold
                                 px-3 py-1 tracking-widest uppercase">Visi</span>
                </div>
                <div class="pt-4">
                    <div class="section-divider mb-6" aria-hidden="true"></div>
                    <p class="font-display text-2xl md:text-3xl font-semibold text-white leading-snug">
                        {{ $settings['vision'] ?? 'Menjadi Grup Perusahaan Terkemuka di Bidang Energi dan Konstruksi yang Berkontribusi pada Pembangunan Nasional yang Berkelanjutan' }}
                    </p>
                </div>
            </div>

            {{-- MISI --}}
            <div data-aos="fade-left" data-aos-delay="80">
                <div class="inline-flex items-center gap-2 mb-8">
                    <span class="bg-gold/10 border border-gold/30 text-gold font-mono
                                 text-xs font-bold px-3 py-1 tracking-widest uppercase">Misi</span>
                </div>

                @php
                    $missions = array_values(array_filter($settings['missions'] ?? []));
                    if (empty($missions)) {
                        $missions = [
                            'Memberikan layanan konstruksi dan engineering berkualitas tinggi dengan standar keselamatan internasional.',
                            'Mendorong inovasi melalui riset dan pengembangan teknologi terapan yang berdampak nyata.',
                            'Membangun kemitraan jangka panjang yang saling menguntungkan dengan klien dan mitra usaha.',
                            'Berkontribusi pada pembangunan berkelanjutan, ketahanan energi, dan ketahanan pangan nasional.',
                        ];
                    }
                @endphp

                <ol class="space-y-5">
                    @foreach ($missions as $i => $misi)
                    <li class="mission-item" data-aos="fade-up" data-aos-delay="{{ 80 + $i * 60 }}">
                        <div class="mission-item__num" aria-hidden="true">
                            <span class="font-mono text-gold text-xs font-bold">
                                {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed">{{ $misi }}</p>
                    </li>
                    @endforeach
                </ol>
            </div>

        </div>
    </div>
</section>
