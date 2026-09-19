<form wire:submit.prevent="saveAbout" class="space-y-6 pb-20">

    <x-filament::section>
        <x-slot name="heading">Profil Perusahaan</x-slot>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama Perusahaan</label>
                <input type="text" wire:model="about_company_name"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
            </div>
            @foreach ([
                ['field' => 'about_profile_paragraph1', 'label' => 'Paragraf 1 — Pengantar Perusahaan'],
                ['field' => 'about_profile_paragraph2', 'label' => 'Paragraf 2 — Sejarah & Pertumbuhan'],
                ['field' => 'about_profile_paragraph3', 'label' => 'Paragraf 3 — Kompetensi & Standar'],
            ] as $p)
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ $p['label'] }}</label>
                    <textarea wire:model="{{ $p['field'] }}" rows="3"
                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $this->{$p['field']} }}</textarea>
                </div>
            @endforeach
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Bidang Usaha</label>
                    <input type="text" wire:model="about_business_field"
                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Wilayah Operasi</label>
                    <input type="text" wire:model="about_operation_area"
                        class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                </div>
            </div>
        </div>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">Visi Perusahaan</x-slot>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Pernyataan Visi</label>
            <textarea wire:model="about_vision" rows="4"
                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $about_vision }}</textarea>
        </div>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">Misi Perusahaan</x-slot>
        <x-slot name="description">Isi hingga 5 poin misi. Kosongkan jika tidak ingin menampilkan poin
            tertentu.</x-slot>
        <div class="space-y-3">
            @foreach ([1, 2, 3, 4, 5] as $n)
                <div class="flex items-start gap-3">
                    <span
                        class="flex-shrink-0 w-7 h-7 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 flex items-center justify-center text-xs font-bold rounded-sm mt-1.5">0{{ $n }}</span>
                    <input type="text" wire:model="about_mission_{{ $n }}" placeholder="Poin misi ke-{{ $n }}..."
                        class="flex-1 border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                </div>
            @endforeach
        </div>
    </x-filament::section>

    {{-- ── Milestone ── --}}
    <x-filament::section>
        <x-slot name="heading">
            <span class="flex items-center gap-2">
                <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
                Milestone Perusahaan
            </span>
        </x-slot>
        <x-slot name="description">Timeline perjalanan perusahaan yang tampil di halaman About. Diurutkan otomatis
            berdasarkan tahun saat disimpan.</x-slot>

        <div class="space-y-3">
            @forelse ($milestones as $i => $m)
                <div
                    class="border border-gray-200 dark:border-white/10 rounded-lg p-4 space-y-3 bg-gray-50/50 dark:bg-white/[0.02]">
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-xs font-semibold text-amber-700 dark:text-amber-400">
                            <span
                                class="w-5 h-5 bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center rounded text-[10px] font-bold">
                                {{ $i + 1 }}
                            </span>
                            Milestone #{{ $i + 1 }}
                        </span>
                        <button wire:click="removeMilestone({{ $i }})" type="button"
                            class="flex items-center gap-1 px-2.5 py-1 text-xs text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 border border-red-200 dark:border-red-800/40 rounded transition-colors">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <div>
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">Tahun</label>
                            <input type="text" wire:model="milestones.{{ $i }}.year" placeholder="2010"
                                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                        </div>
                        <div class="md:col-span-3">
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">Judul</label>
                            <input type="text" wire:model="milestones.{{ $i }}.title" placeholder="Pendirian KPM Group"
                                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
                        </div>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider">Deskripsi</label>
                        <textarea wire:model="milestones.{{ $i }}.description" rows="2"
                            placeholder="Ceritakan singkat pencapaian di tahun ini..."
                            class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500"></textarea>
                    </div>
                </div>
            @empty
                <div
                    class="text-center py-10 text-gray-400 dark:text-gray-500 text-sm border border-dashed border-gray-200 dark:border-white/10 rounded-lg">
                    <svg class="w-8 h-8 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Belum ada milestone. Klik tombol di bawah untuk menambah.
                </div>
            @endforelse

            <button wire:click="addMilestone" type="button"
                class="flex items-center gap-2 px-4 py-2 border border-amber-300 dark:border-amber-700/50 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 text-sm font-medium rounded transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Milestone
            </button>
        </div>
    </x-filament::section>

    @include('filament.settings.save-bar', ['label' => 'Simpan Halaman About'])

</form>