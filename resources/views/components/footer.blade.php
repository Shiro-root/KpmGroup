{{-- Footer Component --}}

<footer class="bg-charcoal border-t border-white/5">
    <div class="container-kpm py-16 lg:py-20">

        {{-- ── Main Grid ── --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-12 gap-10 mb-14">

            {{-- Brand block --}}
            <div class="lg:col-span-5">
                <img
                    src="{{ asset('images/kpm-logo-white.png') }}"
                    alt="KPM Group"
                    class="h-10 mb-5"
                    loading="lazy"
                >
                <p class="text-gray-400 text-sm leading-relaxed max-w-xs mb-8">
                    PT. Kurniawan Power Mandiri (KPM Group) — mitra terpercaya untuk
                    solusi konstruksi, engineering, dan inovasi industri Indonesia.
                </p>

                {{-- Social --}}
                <div class="flex items-center gap-3">
                    @foreach ([
                        ['href' => $settings['instagram_url'] ?? '#',                'label' => 'Instagram', 'abbr' => 'IG'],
                        ['href' => $settings['tiktok_url'] ?? '#',                   'label' => 'TikTok',    'abbr' => 'TK'],
                        ['href' => 'https://wa.me/' . ($settings['whatsapp'] ?? ''), 'label' => 'WhatsApp',  'abbr' => 'WA'],
                    ] as $s)
                    <a
                        href="{{ $s['href'] }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="{{ $s['label'] }}"
                        class="w-9 h-9 border border-white/10 flex items-center justify-center
                               text-gray-400 text-xs font-mono font-medium
                               hover:border-gold hover:text-gold
                               transition-all duration-200"
                    >
                        {{ $s['abbr'] }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Spacer --}}
            <div class="hidden lg:block lg:col-span-1"></div>

            {{-- Navigation --}}
            <div class="lg:col-span-3">
                <h4 class="text-white text-xs font-semibold uppercase tracking-[0.18em] mb-5">
                    Navigasi
                </h4>
                <ul class="space-y-3">
                    @foreach ([
                        ['route' => 'home',     'label' => 'Home'],
                        ['route' => 'about',    'label' => 'Tentang Kami'],
                        ['route' => 'services', 'label' => 'Layanan'],
                        ['route' => 'contact',  'label' => 'Kontak'],
                    ] as $link)
                    <li>
                        <a
                            href="{{ route($link['route']) }}"
                            class="text-gray-400 text-sm hover:text-gold
                                   transition-colors duration-200 underline-gold"
                        >
                            {{ $link['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Divisions --}}
            <div class="lg:col-span-3">
                <h4 class="text-white text-xs font-semibold uppercase tracking-[0.18em] mb-5">
                    Divisi KPM
                </h4>
                <ul class="space-y-3">
                    @foreach (['Construction', 'Engineering', 'Research & Development', 'Farm', 'Procurement'] as $div)
                    <li>
                        <span class="text-gray-500 text-sm">KPM {{ $div }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>

        {{-- ── Bottom Bar ── --}}
        <div class="border-t border-white/[0.06] pt-8 flex flex-col sm:flex-row
                    items-center justify-between gap-4">

            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} PT. Kurniawan Power Mandiri. All rights reserved.
            </p>

            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 bg-gold rounded-full animate-pulse-gold"></div>
                <span class="font-mono text-gray-600 text-xs tracking-widest uppercase">
                    KPM Group
                </span>
            </div>

        </div>
    </div>
</footer>