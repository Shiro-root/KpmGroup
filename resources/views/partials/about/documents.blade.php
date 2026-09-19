{{-- partials/about/documents.blade.php --}}

<section
    class="section-pad bg-gray-50/70"
    aria-labelledby="docs-heading"
    x-data="{ activeDoc: null }"
>
    <div class="container-kpm">

        <div class="text-center mb-12">
            <div class="flex items-center justify-center gap-3 mb-4" data-aos="fade-down">
                <div class="w-8 h-px bg-gold"></div>
                <span class="label-mono">Legalitas</span>
                <div class="w-8 h-px bg-gold"></div>
            </div>
            <h2 id="docs-heading" class="heading-section" data-aos="fade-up">
                Dokumen Resmi
            </h2>
            <p class="body-sm max-w-md mx-auto mt-3" data-aos="fade-up" data-aos-delay="60">
                KPM Group beroperasi dengan legalitas penuh dan terdokumentasi.
                Klik dokumen untuk melihat pratinjau.
            </p>
        </div>

        {{-- Documents Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @forelse ($documents as $i => $doc)
            <button
                type="button"
                class="doc-card group text-left w-full"
                @click="activeDoc = {{ json_encode([
                    'name'     => $doc->name,
                    'category' => $doc->category_label,
                    'file_url' => Storage::url($doc->file_path),
                    'file_type'=> $doc->file_type,
                    'date'     => $doc->created_at->format('d M Y'),
                ]) }}"
                data-aos="fade-up"
                data-aos-delay="{{ $i * 60 }}"
                aria-label="Lihat dokumen {{ $doc->name }}"
            >
                {{-- File icon --}}
                <div class="relative w-14 h-16 bg-gold/8 group-hover:bg-gold/15
                            flex items-center justify-center mb-5
                            transition-colors duration-300">
                    <svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586
                                 a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="absolute -bottom-1.5 -right-1.5 text-[9px] font-bold
                                 bg-gold text-white px-1.5 py-0.5 uppercase tracking-wide">
                        {{ strtoupper($doc->file_type) }}
                    </span>
                </div>

                <h3 class="font-semibold text-charcoal text-sm mb-1
                            group-hover:text-gold transition-colors duration-300">
                    {{ $doc->name }}
                </h3>
                <p class="text-gray-400 text-xs mb-3">{{ $doc->category_label }}</p>
                <time class="text-gray-300 text-xs font-mono">
                    {{ $doc->created_at->format('d M Y') }}
                </time>

                <div class="mt-4 flex items-center gap-1.5 text-gold text-xs font-medium
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                 -1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat Dokumen
                </div>
            </button>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-400">Dokumen belum tersedia.</p>
            </div>
            @endforelse
        </div>

    </div>

    {{-- ── Lightbox Modal ── --}}
    <div
        x-show="activeDoc"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="modal-backdrop"
        @click.self="activeDoc = null"
        @keydown.escape.window="activeDoc = null"
        role="dialog"
        :aria-modal="!!activeDoc"
        aria-labelledby="doc-modal-title"
        style="display:none"
    >
        <div
            class="modal-box max-w-2xl max-h-[90vh] flex flex-col"
            @click.stop
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
        >
            {{-- Header --}}
            <div class="modal-header flex-shrink-0">
                <div>
                    <p class="label-mono text-[10px] mb-1"
                       x-text="activeDoc?.category"></p>
                    <h3 class="font-display text-xl font-bold text-charcoal"
                        id="doc-modal-title"
                        x-text="activeDoc?.name">
                    </h3>
                </div>
                <button
                    @click="activeDoc = null"
                    class="modal-close"
                    aria-label="Tutup"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Gold divider --}}
            <div class="h-[2px] bg-gold flex-shrink-0"></div>

            {{-- Preview --}}
            <div class="modal-body overflow-auto flex-1">
                <template x-if="activeDoc?.file_type === 'pdf'">
                    <iframe
                        :src="activeDoc?.file_url"
                        class="w-full h-[60vh] border-0"
                        title="Document Preview"
                    ></iframe>
                </template>
                <template x-if="activeDoc?.file_type !== 'pdf'">
                    <img
                        :src="activeDoc?.file_url"
                        :alt="activeDoc?.name"
                        class="w-full h-auto"
                        loading="lazy"
                    >
                </template>
            </div>

            {{-- Footer --}}
            <div class="modal-footer flex-shrink-0">
                <button
                    @click="activeDoc = null"
                    class="btn-outline-dark text-sm px-5 py-2.5"
                >
                    Tutup
                </button>
                <a
                    :href="activeDoc?.file_url"
                    download
                    class="btn-primary text-sm px-5 py-2.5"
                    rel="noopener noreferrer"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
            </div>

        </div>
    </div>

</section>
