<form wire:submit.prevent="saveContact" class="space-y-6 pb-20">

    <x-filament::section>
        <x-slot name="heading">WhatsApp</x-slot>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Nomor WhatsApp
                    <span class="text-xs text-gray-400 font-normal ml-1">— format: 628xxx (tanpa +)</span>
                </label>
                <input type="text" wire:model="contact_whatsapp" placeholder="628123456789"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Tampilan Nomor
                    <span class="text-xs text-gray-400 font-normal ml-1">— yang ditampilkan di website</span>
                </label>
                <input type="text" wire:model="contact_whatsapp_display" placeholder="812-3456-7890"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Jam Operasional</label>
                <input type="text" wire:model="contact_office_hours" placeholder="Senin–Sabtu, 08.00–17.00 WIB"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email Perusahaan</label>
                <input type="email" wire:model="contact_email" placeholder="info@kpmgroup.co.id"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
            </div>
        </div>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">Sosial Media</x-slot>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">URL Instagram</label>
                <input type="url" wire:model="contact_instagram_url" placeholder="https://instagram.com/namaakun"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Username Instagram</label>
                <div class="flex items-center border border-gray-300 dark:border-white/20 rounded overflow-hidden">
                    <span class="px-3 py-2 bg-gray-50 dark:bg-white/10 text-gray-400 text-sm">@</span>
                    <input type="text" wire:model="contact_instagram_handle" placeholder="namaakun"
                        class="flex-1 px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 border-0">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">URL TikTok</label>
                <input type="url" wire:model="contact_tiktok_url" placeholder="https://tiktok.com/@namaakun"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Username TikTok</label>
                <div class="flex items-center border border-gray-300 dark:border-white/20 rounded overflow-hidden">
                    <span class="px-3 py-2 bg-gray-50 dark:bg-white/10 text-gray-400 text-sm">@</span>
                    <input type="text" wire:model="contact_tiktok_handle" placeholder="namaakun"
                        class="flex-1 px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 border-0">
                </div>
            </div>
        </div>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">Alamat & Google Maps</x-slot>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Alamat Kantor</label>
                <textarea wire:model="contact_address" rows="3"
                    placeholder="Jl. Nama Jalan No. X&#10;Kota, Provinsi XXXXX"
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $contact_address }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Google Maps Embed URL
                    <span class="text-xs text-gray-400 font-normal ml-1">— dari Share → Embed a map → copy
                        src="..."</span>
                </label>
                <textarea wire:model="contact_maps_embed_url" rows="2"
                    placeholder="https://www.google.com/maps/embed?pb=..."
                    class="w-full border border-gray-300 dark:border-white/20 rounded px-3 py-2 text-sm bg-white dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-amber-500">{{ $contact_maps_embed_url }}</textarea>
            </div>
            @if ($contact_maps_embed_url)
                <div class="rounded overflow-hidden border border-gray-200 dark:border-white/10">
                    <p class="text-xs text-gray-400 px-3 py-2 bg-gray-50 dark:bg-white/5">Preview peta:</p>
                    <iframe src="{{ $contact_maps_embed_url }}" width="100%" height="200" style="border:0;"
                        loading="lazy"></iframe>
                </div>
            @endif
        </div>
    </x-filament::section>

    @include('filament.settings.save-bar', ['label' => 'Simpan Halaman Contact'])

</form>