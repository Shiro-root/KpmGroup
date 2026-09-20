{{-- Dipanggil dengan: @include('filament.settings.save-bar', ['label' => 'Simpan Halaman Home']) --}}

<div class="sticky bottom-0 z-50 flex flex-wrap items-center justify-between gap-3 border-t border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-900 kpm-save-bar">
    <p class="text-xs text-gray-500 dark:text-gray-400">
        Perubahan belum disimpan hingga tombol diklik.
    </p>

    <button
        type="submit"
        class="kpm-save-btn inline-flex items-center gap-2 rounded-lg bg-amber-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm opacity-100 transition hover:bg-amber-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
        style="display: inline-flex !important; visibility: visible !important; opacity: 1 !important; color: #fff !important; background-color: #d97706 !important;"
    >
        <svg
            width="16"
            height="16"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            aria-hidden="true"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 13l4 4L19 7"
            />
        </svg>

        <span>{{ $label }}</span>
    </button>
</div>