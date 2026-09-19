<form wire:submit.prevent="saveServices" class="space-y-6 pb-20">

    <x-filament::section>
        <x-slot name="heading">Header Halaman Services</x-slot>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Judul Halaman (HTML diperbolehkan)
                    <span class="text-xs text-gray-400 font-normal ml-1">— gunakan &lt;span
                        class="text-accent"&gt;</span>
                </label>
                <input type="text" wire:model="services_page_title"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Subtitle Halaman</label>
                <textarea wire:model="services_page_subtitle" rows="2"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $services_page_subtitle }}</textarea>
            </div>
        </div>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">CTA Section Bawah</x-slot>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Judul CTA</label>
                <input type="text" wire:model="services_cta_title"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Subtitle CTA</label>
                <input type="text" wire:model="services_cta_subtitle"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
            </div>
        </div>
    </x-filament::section>

    <div
        class="p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700/30 rounded text-sm text-amber-800 dark:text-amber-300">
        <strong class="block mb-1">ℹ Detail konten setiap divisi</strong>
        Untuk mengubah nama, deskripsi, sub-layanan, dan logo setiap divisi — gunakan menu <strong>Layanan &amp;
            Divisi</strong> di sidebar.
    </div>

    @include('filament.settings.save-bar', ['label' => 'Simpan Halaman Services'])

</form>