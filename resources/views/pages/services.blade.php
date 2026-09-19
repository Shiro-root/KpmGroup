<x-layouts.app
    seoTitle="Layanan"
    seoDescription="Layanan KPM Group: Construction, Engineering, Research & Development, Farm, dan Procurement."
>
    <x-hero
        :title="$settings['page_title']"
        :subtitle="$settings['page_subtitle']"
        :cta="false"
        size="md"
    />

    @include('partials.services.all-services', ['services' => $services])

    <x-cta-section
        :title="$settings['cta_title']"
        :subtitle="$settings['cta_subtitle']"
    />
</x-layouts.app>
