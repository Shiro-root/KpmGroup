<div class="mb-6 border-b border-gray-200 dark:border-white/10">
    <div class="flex overflow-x-auto gap-1 pb-px scrollbar-none">
        @foreach ([
            ['key' => 'home', 'label' => 'Halaman Home', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ['key' => 'about', 'label' => 'Halaman About', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['key' => 'services', 'label' => 'Halaman Services', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01'],
            ['key' => 'contact', 'label' => 'Halaman Contact', 'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
            ['key' => 'seo', 'label' => 'SEO & Meta', 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
        ] as $tab)
            <button wire:click="$set('activeTab', '{{ $tab['key'] }}')"
                class="flex-shrink-0 flex items-center gap-2 px-4 py-2.5 text-sm font-medium border-b-2 transition-all duration-200 whitespace-nowrap
                       {{ $activeTab === $tab['key']
                            ? 'border-amber-500 text-amber-600 dark:text-amber-400'
                            : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-amber-600 hover:border-amber-300' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $tab['icon'] }}" />
                </svg>
                <span>{{ $tab['label'] }}</span>
            </button>
        @endforeach
    </div>
</div>