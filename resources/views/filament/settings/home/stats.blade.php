<x-filament::section>
    <x-slot name="heading">Stats Bar (Angka di Banner Emas)</x-slot>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ([
            ['field' => 'home_stats_exp', 'label' => 'Tahun Pengalaman', 'placeholder' => '10+'],
            ['field' => 'home_stats_divisions', 'label' => 'Divisi Bisnis', 'placeholder' => '5'],
            ['field' => 'home_stats_projects', 'label' => 'Proyek Selesai', 'placeholder' => '50+'],
            ['field' => 'home_stats_team', 'label' => 'Tim Profesional', 'placeholder' => '100+'],
        ] as $stat)
            <div>
                <label
                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">{{ $stat['label'] }}</label>
                <input type="text" wire:model="{{ $stat['field'] }}" placeholder="{{ $stat['placeholder'] }}"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
            </div>
        @endforeach
    </div>
</x-filament::section>