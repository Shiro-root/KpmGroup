<x-filament::section>
    <x-slot name="heading">
        <span class="flex items-center gap-2">
            <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
            Penjelasan Singkat Per Divisi (Services Overview)
        </span>
    </x-slot>
    <x-slot name="description">Teks deskripsi ringkas yang muncul di kartu layanan pada halaman Home.</x-slot>

    <div class="space-y-4">
        @foreach ([
            ['field' => 'home_div_construction_desc', 'label' => 'KPM Construction', 'placeholder' => 'Layanan konstruksi sipil dan mekanikal dengan standar kualitas internasional...'],
            ['field' => 'home_div_engineering_desc', 'label' => 'KPM Engineering', 'placeholder' => 'Solusi rekayasa teknik inovatif untuk mendukung efisiensi operasional...'],
            ['field' => 'home_div_rd_desc', 'label' => 'KPM Research & Development', 'placeholder' => 'Inovasi dan riset terapan untuk menciptakan solusi teknologi...'],
            ['field' => 'home_div_farm_desc', 'label' => 'KPM Farm', 'placeholder' => 'Pengembangan agrikultur modern berbasis teknologi...'],
            ['field' => 'home_div_procurement_desc', 'label' => 'KPM Procurement', 'placeholder' => 'Layanan pengadaan barang dan material yang efisien, transparan...'],
        ] as $div)
            <div
                class="border border-gray-100 dark:border-white/10 rounded-lg p-4 space-y-2 bg-gray-50/40 dark:bg-white/[0.02]">
                <label
                    class="block text-sm font-semibold text-gray-700 dark:text-gray-200">{{ $div['label'] }}</label>
                <textarea wire:model="{{ $div['field'] }}" rows="2" placeholder="{{ $div['placeholder'] }}"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $this->{$div['field']} }}</textarea>
            </div>
        @endforeach
    </div>
</x-filament::section>