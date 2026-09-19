{{-- partials/home/services-overview.blade.php --}}
{{-- Deskripsi dari $settings (dinamis dari admin)                          --}}
{{-- Logo & Sub-Layanan per divisi dari $services (sudah di-pass dari HomeController) --}}

@php
use Illuminate\Support\Facades\Storage;

/*
 * $services sudah tersedia dari HomeController::index()
 * Service::query()->where('is_active', true)->orderBy('sort_order')->get()
 * Kita key by 'division' agar mudah lookup per divisi.
 */
$dbMap = $services->keyBy('division');

/*
 * Helper kecil: render satu blok "Cakupan Spesialisasi" dari sub_services
 * milik sebuah Service. sub_services disimpan sebagai array of
 * ['name' => ..., 'description' => ...] hasil Repeater Filament.
 * Di sini cukup ditampilkan NAMA-nya saja agar rapi & tidak menumpuk —
 * detail lengkap (description) ada di halaman Layanan.
 */
$specChecklistIcon = '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
@endphp

<section class="section-pad bg-gray-50/70" aria-labelledby="services-heading">
    <div class="container-kpm">

        {{-- ── Header ── --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-3 mb-4" data-aos="fade-down">
                <div class="w-8 h-px bg-gold"></div>
                <span class="label-mono">Layanan Kami</span>
                <div class="w-8 h-px bg-gold"></div>
            </div>
            <h2 id="services-heading" class="heading-section" data-aos="fade-up">
                Divisi Bisnis KPM Group
            </h2>
            <p class="body-sm max-w-xl mx-auto mt-4" data-aos="fade-up" data-aos-delay="80">
                Lima divisi terintegrasi yang saling mendukung untuk memberikan solusi
                menyeluruh bagi kebutuhan industri Anda.
            </p>
        </div>

        {{-- ── Services Grid ── --}}
        <div class="services-grid">

            {{-- ── Construction ── --}}
            @php
                $svc = $dbMap->get('construction');
                $logoUrl = $svc?->logo ? Storage::url($svc->logo) : null;
                $subServices = $svc?->sub_services ?? [];
            @endphp
            <div class="relative h-full z-10 hover:z-50 focus-within:z-50">
                <x-service-card
                    title="KPM Construction"
                    tagline="Konstruksi berkualitas internasional"
                    :description="$settings['div_construction_desc']"
                    :logoUrl="$logoUrl"
                    delay="0"
                >
                    <x-slot name="icon">
                        <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </x-slot>

                    {{-- Konten modal: spesialisasi grid — judul saja, dinamis dari sub_services --}}
                    @foreach ($subServices as $item)
                    <div class="modal-spec-item">
                        <div class="modal-spec-item__icon" aria-hidden="true">
                            {!! $specChecklistIcon !!}
                        </div>
                        <span class="modal-spec-item__text">{{ $item['name'] ?? '' }}</span>
                    </div>
                    @endforeach
                </x-service-card>
            </div>

            {{-- ── Engineering ── --}}
            @php
                $svc = $dbMap->get('engineering');
                $logoUrl = $svc?->logo ? Storage::url($svc->logo) : null;
                $subServices = $svc?->sub_services ?? [];
            @endphp
            <div class="relative h-full z-10 hover:z-50 focus-within:z-50">
                <x-service-card
                    title="KPM Engineering"
                    tagline="Rekayasa teknik inovatif"
                    :description="$settings['div_engineering_desc']"
                    :logoUrl="$logoUrl"
                    delay="80"
                >
                    <x-slot name="icon">
                        <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </x-slot>

                    @foreach ($subServices as $item)
                    <div class="modal-spec-item">
                        <div class="modal-spec-item__icon" aria-hidden="true">
                            {!! $specChecklistIcon !!}
                        </div>
                        <span class="modal-spec-item__text">{{ $item['name'] ?? '' }}</span>
                    </div>
                    @endforeach
                </x-service-card>
            </div>

            {{-- ── R&D ── --}}
            @php
                $svc = $dbMap->get('rd');
                $logoUrl = $svc?->logo ? Storage::url($svc->logo) : null;
                $subServices = $svc?->sub_services ?? [];
            @endphp
            <div class="relative h-full z-10 hover:z-50 focus-within:z-50">
                <x-service-card
                    title="KPM Research & Development"
                    tagline="Inovasi untuk masa depan"
                    :description="$settings['div_rd_desc']"
                    :logoUrl="$logoUrl"
                    delay="160"
                >
                    <x-slot name="icon">
                        <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </x-slot>

                    @foreach ($subServices as $item)
                    <div class="modal-spec-item">
                        <div class="modal-spec-item__icon" aria-hidden="true">
                            {!! $specChecklistIcon !!}
                        </div>
                        <span class="modal-spec-item__text">{{ $item['name'] ?? '' }}</span>
                    </div>
                    @endforeach
                </x-service-card>
            </div>

            {{-- ── Farm ── --}}
            @php
                $svc = $dbMap->get('farm');
                $logoUrl = $svc?->logo ? Storage::url($svc->logo) : null;
                $subServices = $svc?->sub_services ?? [];
            @endphp
            <div class="relative h-full z-10 hover:z-50 focus-within:z-50">
                <x-service-card
                    title="KPM Farm"
                    tagline="Agrikultur berbasis teknologi"
                    :description="$settings['div_farm_desc']"
                    :logoUrl="$logoUrl"
                    delay="240"
                >
                    <x-slot name="icon">
                        <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                        </svg>
                    </x-slot>

                    @foreach ($subServices as $item)
                    <div class="modal-spec-item">
                        <div class="modal-spec-item__icon" aria-hidden="true">
                            {!! $specChecklistIcon !!}
                        </div>
                        <span class="modal-spec-item__text">{{ $item['name'] ?? '' }}</span>
                    </div>
                    @endforeach
                </x-service-card>
            </div>

            {{-- ── Procurement ── --}}
            @php
                $svc = $dbMap->get('procurement');
                $logoUrl = $svc?->logo ? Storage::url($svc->logo) : null;
                $subServices = $svc?->sub_services ?? [];
            @endphp
            <div class="relative h-full z-10 hover:z-50 focus-within:z-50">
                <x-service-card
                    title="KPM Procurement"
                    tagline="Pengadaan efisien & terpercaya"
                    :description="$settings['div_procurement_desc']"
                    :logoUrl="$logoUrl"
                    delay="320"
                >
                    <x-slot name="icon">
                        <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </x-slot>

                    @foreach ($subServices as $item)
                    <div class="modal-spec-item">
                        <div class="modal-spec-item__icon" aria-hidden="true">
                            {!! $specChecklistIcon !!}
                        </div>
                        <span class="modal-spec-item__text">{{ $item['name'] ?? '' }}</span>
                    </div>
                    @endforeach
                </x-service-card>
            </div>

            {{-- ── View All ── --}}
            <div class="relative h-full z-10 hover:z-50 focus-within:z-50">
                <a
                    href="{{ route('services') }}"
                    class="services-empty-card group h-full flex items-center justify-center min-h-[280px]"
                    data-aos="fade-up"
                    data-aos-delay="400"
                    aria-label="Lihat semua layanan"
                >
                    <div class="text-center px-6">
                        <div class="w-14 h-14 border border-gold/25 group-hover:border-gold
                                    group-hover:bg-gold/5 flex items-center justify-center
                                    mx-auto mb-5 transition-all duration-300">
                            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                        <span class="font-display text-lg font-bold text-charcoal
                                     group-hover:text-gold transition-colors duration-300 block mb-1">
                            Semua Layanan
                        </span>
                        <p class="text-xs text-charcoal-400 leading-relaxed">
                            Detail lengkap setiap divisi KPM Group
                        </p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>