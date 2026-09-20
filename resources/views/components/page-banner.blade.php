{{--
    Page Banner Component (untuk About, Services, Contact, dll.)
    @props:
      title     HTML string (boleh pakai <span class='text-accent'>)
      subtitle  teks biasa (opsional)
      bgImage   path gambar dari public/ (opsional). Jika diisi, banner jadi
                gelap dengan gambar di belakang; jika kosong, banner terang & bersih.
--}}

@props([
    'title'    => '',
    'subtitle' => null,
    'bgImage'  => null,
])

<section
    class="relative mt-[72px] md:mt-20 overflow-hidden border-b
           {{ $bgImage ? 'bg-charcoal border-transparent' : 'bg-gray-50/70 border-gray-100' }}"
    aria-label="Banner halaman"
>
    @if ($bgImage)
        <img src="{{ asset($bgImage) }}" alt="" aria-hidden="true"
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-charcoal/70" aria-hidden="true"></div>
    @endif

    <div class="relative container-kpm text-center py-14 md:py-20">
        <h1 class="font-display font-bold leading-tight
                   {{ $bgImage ? 'text-white' : 'text-charcoal' }}"
            style="font-size: clamp(2rem, 4vw, 3rem)"
            data-aos="fade-up">
            {!! $title !!}
        </h1>

        <div class="w-16 h-[3px] bg-gold mx-auto mt-4" aria-hidden="true"></div>

        @if ($subtitle)
        <p class="max-w-xl mx-auto mt-5 text-base md:text-lg leading-relaxed
                  {{ $bgImage ? 'text-gray-200' : 'text-charcoal-500' }}"
           data-aos="fade-up" data-aos-delay="80">
            {{ $subtitle }}
        </p>
        @endif
    </div>
</section>
