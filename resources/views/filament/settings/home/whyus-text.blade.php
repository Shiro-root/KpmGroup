<x-filament::section>
    <x-slot name="heading">
        <span class="flex items-center gap-2">
            <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
            "Komitmen Kami" — Teks Kiri & Label Gambar
        </span>
    </x-slot>
    <x-slot name="description">Heading, sub-judul, poin-poin di sisi kiri, dan label overlay di tiap gambar
        grid.</x-slot>

    <div class="space-y-6">

        <div>
            <p class="text-[11px] font-medium uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">
                Judul Section</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Baris Judul <span class="text-xs text-gray-400 font-normal ml-1">— warna hitam/putih</span>
                    </label>
                    <input type="text" wire:model="home_whyus_title" placeholder="Komitmen Kami"
                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Sub-judul <span class="text-xs text-gray-400 font-normal ml-1">— warna emas</span>
                    </label>
                    <input type="text" wire:model="home_whyus_subtitle" placeholder="untuk Anda"
                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                </div>
            </div>
        </div>

        <hr class="border-dashed border-gray-200 dark:border-white/10">

        <div>
            <p class="text-[11px] font-medium uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">
                Poin-Poin Keunggulan</p>
            <div class="space-y-3">
                @foreach ($home_whyus_points as $i => $point)
                    <div
                        class="border border-gray-100 dark:border-white/10 rounded-lg p-4 bg-gray-50/40 dark:bg-white/[0.02]">
                        <div class="flex items-center justify-between mb-3">
                            <span
                                class="text-xs font-semibold text-amber-600 dark:text-amber-400 flex items-center gap-2">
                                <span
                                    class="w-5 h-5 bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center rounded text-[10px] font-bold">{{ $i + 1 }}</span>
                                Poin #{{ $i + 1 }}
                            </span>
                            <button wire:click="removeWhyusPoint({{ $i }})" type="button"
                                class="flex items-center gap-1 px-2.5 py-1 text-xs text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 border border-red-200 dark:border-red-800/40 rounded transition-colors">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div>
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">Judul</label>
                                <input type="text" wire:model="home_whyus_points.{{ $i }}.title"
                                    placeholder="Kualitas Terstandar"
                                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                            </div>
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">Deskripsi</label>
                                <input type="text" wire:model="home_whyus_points.{{ $i }}.desc"
                                    placeholder="Penjelasan singkat..."
                                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                            </div>
                        </div>
                    </div>
                @endforeach

                <button wire:click="addWhyusPoint" type="button"
                    class="flex items-center gap-2 px-4 py-2 border border-amber-300 dark:border-amber-700/50 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 text-sm font-medium rounded transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Poin
                </button>
            </div>
        </div>

        <hr class="border-dashed border-gray-200 dark:border-white/10">

        <div>
            <p class="text-[11px] font-medium uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">
                Label Teks Overlay Gambar
                <span class="normal-case tracking-normal font-normal ml-1">— teks kecil di pojok kiri bawah tiap
                    gambar</span>
            </p>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach ([
                    ['model' => 'home_whyus_label_1', 'label' => 'Gambar 1'],
                    ['model' => 'home_whyus_label_2', 'label' => 'Gambar 2'],
                    ['model' => 'home_whyus_label_3', 'label' => 'Gambar 3'],
                    ['model' => 'home_whyus_label_4', 'label' => 'Gambar 4'],
                    ['model' => 'home_whyus_label_5', 'label' => 'Gambar 5'],
                ] as $lbl)
                    <div>
                        <label
                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">{{ $lbl['label'] }}</label>
                        <input type="text" wire:model="{{ $lbl['model'] }}"
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-filament::section>