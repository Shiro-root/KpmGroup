<div class="flex items-start gap-4">
    <div style="width:200px;height:105px;" class="relative flex-shrink-0">
        @if ($this->{$preview})
            <img src="{{ $this->{$preview}->temporaryUrl() }}"
                 class="w-full h-full object-cover rounded border-2 border-amber-400">
            <span class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-amber-500 rounded-full flex items-center justify-center">
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </span>
        @elseif ($this->{$current})
            <img src="{{ $this->imageUrl($this->{$current}) }}"
                 class="w-full h-full object-cover rounded border border-gray-200">
        @else
            <div class="w-full h-full rounded border border-dashed border-gray-300 flex items-center justify-center text-xs text-gray-400 text-center px-2">
                Belum ada gambar
            </div>
        @endif
    </div>

    <div class="flex flex-col gap-2">
        <label class="cursor-pointer inline-flex items-center gap-2 px-3 py-1.5 border border-dashed border-amber-300 dark:border-amber-700/50 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 text-xs font-medium rounded transition-colors w-fit">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
            Ganti Gambar
            <input type="file" wire:model="{{ $preview }}" accept="image/*" class="hidden">
        </label>

        @error($preview)
            <span class="text-[11px] text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror

        @if ($this->{$preview})
            <span class="text-[11px] text-green-600 dark:text-green-400">Gambar dipilih — klik Simpan untuk menerapkan</span>
        @endif
    </div>
</div>