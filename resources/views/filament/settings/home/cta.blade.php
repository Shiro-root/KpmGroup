<x-filament::section>
    <x-slot name="heading">CTA Section (Bagian "Mulai Proyek" di bawah)</x-slot>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Judul CTA</label>
            <input type="text" wire:model="home_cta_title"
                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Subtitle CTA</label>
            <input type="text" wire:model="home_cta_subtitle"
                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
        </div>
    </div>
</x-filament::section>