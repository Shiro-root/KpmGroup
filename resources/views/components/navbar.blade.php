{{--
    Navbar Component
    - Transparent over hero, solid on scroll
    - Alpine.js for mobile menu + scroll detection
    - Active route detection
--}}

<header
    id="navbar"
    x-data="{
        scrolled: false,
        init() {
            this.scrolled = window.scrollY > 60;
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 60;
            });
        }
    }"
    :class="scrolled ? 'is-solid' : 'is-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
    <div class="container-kpm">
        <nav class="flex items-center justify-between h-[72px] md:h-20">

            {{-- ── Logo ── --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">
                <img
                    src="{{ asset('images/kpm-logo.png') }}"
                    alt="KPM Group"
                    class="h-9 md:h-10 w-auto transition-all duration-300
                           group-hover:opacity-90 group-hover:scale-[1.03]"
                    loading="lazy"
                >
            </a>

            {{-- ── Desktop Menu ── --}}
            <ul class="hidden md:flex items-center gap-9">
                @php
                    $links = [
                        ['route' => 'home',     'label' => 'Home'],
                        ['route' => 'about',    'label' => 'About'],
                        ['route' => 'services', 'label' => 'Services'],
                        ['route' => 'contact',  'label' => 'Contact'],
                    ];
                @endphp

                @foreach ($links as $link)
                <li>
                    <a
                        href="{{ route($link['route']) }}"
                        class="nav-link
                               {{ request()->routeIs($link['route']) ? 'active' : '' }}
                               {{ 'nav-link--' . (request()->routeIs('home') ? 'light' : 'dark') }}"
                        :class="scrolled ? 'nav-link--dark' : 'nav-link--light'"
                    >
                        {{ $link['label'] }}
                    </a>
                </li>
                @endforeach
            </ul>

            {{-- ── CTA Button ── --}}
            <a
                href="{{ route('contact') }}"
                class="hidden md:inline-flex items-center gap-2
                       px-5 py-2.5 bg-gold text-white
                       text-sm font-semibold tracking-wide
                       hover:bg-gold-600 transition-all duration-200
                       hover:shadow-lg hover:shadow-gold/20"
            >
                Hubungi Kami
                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            {{-- ── Hamburger ── --}}
            <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="md:hidden p-2 -mr-2"
                :class="scrolled ? 'text-charcoal' : 'text-white'"
                aria-label="Toggle navigation"
                aria-expanded="false"
                :aria-expanded="mobileMenuOpen"
            >
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </nav>
    </div>

    {{-- ── Mobile Menu ── --}}
    <div
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-white border-t border-gray-100 shadow-xl"
        style="display: none"
    >
        <ul class="container-kpm py-5 flex flex-col gap-1">
            @foreach ($links as $link)
            <li>
                <a
                    href="{{ route($link['route']) }}"
                    @click="mobileMenuOpen = false"
                    class="flex items-center justify-between py-3 px-2
                           text-base font-medium border-b border-gray-50
                           transition-colors duration-200
                           {{ request()->routeIs($link['route']) ? 'text-gold' : 'text-charcoal hover:text-gold' }}"
                >
                    {{ $link['label'] }}
                    @if (request()->routeIs($link['route']))
                    <div class="w-1.5 h-1.5 bg-gold rounded-full"></div>
                    @endif
                </a>
            </li>
            @endforeach

            <li class="pt-4">
                <a
                    href="{{ route('contact') }}"
                    @click="mobileMenuOpen = false"
                    class="block w-full text-center py-3.5
                           bg-gold text-white text-sm font-semibold tracking-wide
                           hover:bg-gold-600 transition-colors"
                >
                    Hubungi Kami
                </a>
            </li>
        </ul>
    </div>

</header>
