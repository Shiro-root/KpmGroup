<x-filament::section>
    <x-slot name="heading">
        <span class="flex items-center gap-2">
            <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
            Hero Section
        </span>
    </x-slot>
    <x-slot name="description">Teks utama yang tampil pertama kali saat website dibuka</x-slot>

    <div class="grid grid-cols-1 gap-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                Judul Hero (HTML diperbolehkan)
                <span class="text-xs text-gray-400 font-normal ml-1">— gunakan &lt;span class="text-accent"&gt;
                    untuk warna emas</span>
            </label>
            <textarea wire:model="home_hero_title" rows="2"
                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500">{{ $home_hero_title }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Subtitle Hero</label>
            <textarea wire:model="home_hero_subtitle" rows="3"
                class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $home_hero_subtitle }}</textarea>
        </div>
    </div>
</x-filament::section>