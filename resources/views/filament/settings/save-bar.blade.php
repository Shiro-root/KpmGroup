{{-- Dipanggil dengan: @include('filament.settings.save-bar', ['label' => 'Simpan Halaman Home']) --}}
<div class="sticky bottom-0 z-50 flex flex-wrap items-center justify-between gap-3 kpm-save-bar">
    <p class="text-xs text-gray-400 dark:text-gray-500">Perubahan belum disimpan hingga tombol diklik.</p>
    <button type="submit" class="kpm-save-btn flex-shrink-0">
        <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        {{ $label }}
    </button>
</div>