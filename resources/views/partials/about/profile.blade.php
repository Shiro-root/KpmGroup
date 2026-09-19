<section class="section-pad" aria-labelledby="profile-heading">
    <div class="container-kpm">
        <div class="grid md:grid-cols-12 gap-14 items-start">

            <div class="md:col-span-7">
                <div class="eyebrow" data-aos="fade-right">
                    <div class="eyebrow__line"></div>
                    <span class="label-mono">Profil Perusahaan</span>
                </div>

                <h2 id="profile-heading" class="heading-section mb-6" data-aos="fade-up">
                    {{ $settings['company_name'] ?? 'PT. Kurniawan' }}<br>
                    <span class="text-accent">Power Mandiri</span>
                </h2>

                <div class="space-y-4" data-aos="fade-up" data-aos-delay="80">
                    @if($settings['paragraph1'] ?? '')
                    <p class="body-lead">{{ $settings['paragraph1'] }}</p>
                    @else
                    <p class="body-lead">PT. Kurniawan Power Mandiri (KPM Group) merupakan perusahaan nasional
                        yang berkomitmen memberikan solusi industri terpadu di bidang konstruksi, engineering,
                        riset & pengembangan, agrikultur, dan pengadaan barang.</p>
                    @endif

                    @if($settings['paragraph2'] ?? '')
                    <p class="body-sm">{{ $settings['paragraph2'] }}</p>
                    @endif

                    @if($settings['paragraph3'] ?? '')
                    <p class="body-sm">{{ $settings['paragraph3'] }}</p>
                    @endif
                </div>
            </div>

            <div class="md:col-span-5" data-aos="fade-left" data-aos-delay="120">
                <div class="space-y-3">
                    @foreach ([
                        ['label' => 'Nama Perusahaan', 'value' => $settings['company_name'] ?? 'PT. Kurniawan Power Mandiri'],
                        ['label' => 'Bidang Usaha',    'value' => $settings['business_field'] ?? 'Konstruksi, Engineering, R&D, Agrikultur, Procurement'],
                        ['label' => 'Wilayah Operasi', 'value' => $settings['operation_area'] ?? 'Indonesia'],
                        ['label' => 'Status',          'value' => 'Perusahaan Aktif & Beroperasi'],
                    ] as $info)
                    <div class="flex gap-4 p-5 bg-gray-50 border-l-2 border-gold/40
                                hover:border-gold transition-colors duration-300">
                        <div class="min-w-0 flex-1">
                            <span class="label-mono text-[10px] block mb-1">{{ $info['label'] }}</span>
                            <span class="font-semibold text-charcoal text-sm">{{ $info['value'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
