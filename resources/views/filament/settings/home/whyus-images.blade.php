<x-filament::section>
    <x-slot name="heading">
        <span class="flex items-center gap-2">
            <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
            "Komitmen Kami" — 5 Gambar Grid Kanan
        </span>
    </x-slot>
    <x-slot name="description">Lima foto divisi dalam grid di sisi kanan section "Mengapa KPM Group".</x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ([
            ['preview_field' => 'home_whyus_img_1_preview', 'current_field' => 'home_whyus_img_1_current', 'label' => 'Gambar 1 — Construction', 'default' => 'thumb-construction.jpg'],
            ['preview_field' => 'home_whyus_img_2_preview', 'current_field' => 'home_whyus_img_2_current', 'label' => 'Gambar 2 — Engineering', 'default' => 'thumb-engineering.jpg'],
            ['preview_field' => 'home_whyus_img_3_preview', 'current_field' => 'home_whyus_img_3_current', 'label' => 'Gambar 3 — R & D', 'default' => 'thumb-rd.jpg'],
            ['preview_field' => 'home_whyus_img_4_preview', 'current_field' => 'home_whyus_img_4_current', 'label' => 'Gambar 4 — Farm', 'default' => 'thumb-farm.jpg'],
            ['preview_field' => 'home_whyus_img_5_preview', 'current_field' => 'home_whyus_img_5_current', 'label' => 'Gambar 5 — Procurement', 'default' => 'thumb-procurement.jpg'],
        ] as $img)
            <div
                class="border border-gray-200 dark:border-white/10 rounded-lg p-4 bg-gray-50/40 dark:bg-white/[0.02]">
                <p class="text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider mb-3">
                    {{ $img['label'] }}
                </p>

                <div class="flex items-start gap-3 min-w-0">

                    <div class="relative flex-shrink-0" style="width:96px;height:96px;">
                        @if ($this->{$img['preview_field']})
                            <img src="{{ $this->{$img['preview_field']}->temporaryUrl() }}"
                                alt="Preview {{ $img['label'] }}" class="block rounded-lg border-2 border-amber-400"
                                style="width:96px;height:96px;object-fit:cover;">
                            <span
                                class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-amber-500 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                        @else
                            {{-- imageUrl() menambahkan ?v=timestamp agar tidak kena cache lama --}}
                            <img src="{{ $this->imageUrl($this->{$img['current_field']} ?? $img['default']) }}"
                                alt="{{ $img['label'] }}"
                                class="block rounded-lg border border-gray-200 dark:border-white/10"
                                style="width:96px;height:96px;object-fit:cover;">
                        @endif
                    </div>

                    <div class="flex flex-col justify-center gap-2 min-w-0 flex-1">
                        <label
                            class="cursor-pointer inline-flex items-center gap-2 px-3 py-1.5 border border-dashed border-amber-300 dark:border-amber-700/50 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 text-xs font-medium rounded transition-colors w-fit">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            Ganti Gambar
                            <input type="file" wire:model="{{ $img['preview_field'] }}" accept="image/*"
                                class="hidden">
                        </label>

                        @error($img['preview_field'])
                            <div
                                class="flex items-start gap-1.5 px-2.5 py-1.5 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700/40 rounded">
                                <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span
                                    class="text-[11px] text-red-600 dark:text-red-400 font-medium leading-tight">{{ $message }}</span>
                            </div>
                        @enderror

                        @if ($this->{$img['preview_field']})
                            <span class="text-[11px] text-green-600 dark:text-green-400 leading-tight">
                                Gambar dipilih —<br>klik Simpan untuk menerapkan
                            </span>
                        @else
                            <span class="text-[11px] text-gray-400 leading-tight">
                                JPG / PNG / WebP<br>
                                <span class="font-medium text-gray-500 dark:text-gray-300">Maks. 2 MB</span>
                            </span>
                        @endif
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</x-filament::section>