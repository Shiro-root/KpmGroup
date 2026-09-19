<form wire:submit.prevent="saveSeo" class="space-y-6 pb-20">

    <x-filament::section>
        <x-slot name="heading">
            <span class="flex items-center gap-2">
                <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
                SEO & Meta Tags
            </span>
        </x-slot>
        <x-slot name="description">
            Judul dan deskripsi yang muncul di hasil pencarian Google dan pratinjau tautan media sosial (Open
            Graph).
        </x-slot>

        <div class="space-y-6">

            {{-- SEO Title --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    SEO Title
                    <span class="text-xs text-gray-400 font-normal ml-1">— ditambah "| KPM Group" secara otomatis</span>
                </label>
                <input type="text" wire:model="seo_title" placeholder="KPM Group"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500">

                <div class="flex items-center justify-between mt-1.5">
                    <p class="text-xs text-gray-400">Idealnya 50–60 karakter</p>
                    <span
                        class="text-xs font-mono
                        {{ strlen($seo_title ?? '') > 60 ? 'text-red-500' : (strlen($seo_title ?? '') >= 50 ? 'text-green-600 dark:text-green-400' : 'text-gray-400') }}">
                        {{ strlen($seo_title ?? '') }} / 60
                    </span>
                </div>

                <div
                    class="mt-3 rounded-lg border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/[0.03] px-4 py-3">
                    <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-2">Pratinjau hasil Google</p>
                    <p class="text-[13px] text-blue-600 dark:text-blue-400 font-medium leading-snug truncate">
                        {{ $seo_title ?: 'KPM Group' }} | KPM Group
                    </p>
                    <p class="text-[11px] text-green-700 dark:text-green-500 mt-0.5">https://kpmgrupofficial.co.id</p>
                    <p class="text-[12px] text-gray-600 dark:text-gray-400 mt-1 line-clamp-2 leading-relaxed">
                        {{ $seo_description ?: 'KPM Group — Solusi terpadu Construction, Engineering, R&D, Farm & Procurement di Indonesia.' }}
                    </p>
                </div>
            </div>

            <hr class="border-dashed border-gray-200 dark:border-white/10">

            {{-- SEO Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">SEO Description</label>
                <textarea wire:model="seo_description" rows="3"
                    placeholder="KPM Group — Solusi terpadu Construction, Engineering, R&D, Farm & Procurement di Indonesia."
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $seo_description }}</textarea>

                <div class="flex items-center justify-between mt-1.5">
                    <p class="text-xs text-gray-400">Idealnya 120–160 karakter</p>
                    <span
                        class="text-xs font-mono
                        {{ strlen($seo_description ?? '') > 160 ? 'text-red-500' : (strlen($seo_description ?? '') >= 120 ? 'text-green-600 dark:text-green-400' : 'text-gray-400') }}">
                        {{ strlen($seo_description ?? '') }} / 160
                    </span>
                </div>
            </div>

            <hr class="border-dashed border-gray-200 dark:border-white/10">

            <div
                class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700/30 rounded text-sm text-blue-800 dark:text-blue-300 space-y-1">
                <strong class="block mb-1">ℹ Catatan</strong>
                <p>Title dan description ini dipakai di <strong>semua halaman</strong> sebagai nilai default global.</p>
                <p>Tag Open Graph (Facebook/WhatsApp preview) dan Twitter Card juga menggunakan nilai yang sama.</p>
            </div>

        </div>
    </x-filament::section>

    @include('filament.settings.save-bar', ['label' => 'Simpan SEO'])

</form>