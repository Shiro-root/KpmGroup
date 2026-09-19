<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">Akses Cepat ke Website</x-slot>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach ([
                ['label' => 'Halaman Home',     'route' => 'home',     'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['label' => 'Halaman About',    'route' => 'about',    'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['label' => 'Halaman Services', 'route' => 'services', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01'],
                ['label' => 'Halaman Contact',  'route' => 'contact',  'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
            ] as $link)
            @php
                try {
                    $url = route($link['route']);
                } catch (\Exception $e) {
                    $url = '/';
                }
            @endphp
            <a href="{{ $url }}" target="_blank"
               class="flex items-center gap-3 px-4 py-3 bg-gray-50 dark:bg-white/5
                      border border-gray-200 dark:border-white/10
                      rounded-lg hover:border-amber-400 dark:hover:border-amber-500
                      hover:bg-amber-50 dark:hover:bg-amber-900/20
                      transition-all duration-200 text-sm font-medium
                      text-gray-700 dark:text-gray-300">
                <svg class="w-4 h-4 text-amber-600 flex-shrink-0"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="1.5" d="{{ $link['icon'] }}"/>
                </svg>
                <span>{{ $link['label'] }}</span>
                <svg class="w-3 h-3 text-gray-400 ml-auto flex-shrink-0"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
