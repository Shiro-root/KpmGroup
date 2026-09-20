<x-layouts.app
    seoTitle="Tentang Kami"
    seoDescription="Profil PT. Kurniawan Power Mandiri — visi, misi, perjalanan perusahaan, dan dokumen legalitas KPM Group."
>
   <x-page-banner
    title="Tentang <span class='text-accent'>KPM Group</span>"
    subtitle="Membangun kepercayaan melalui kualitas, inovasi, dan integritas lebih dari satu dekade."
    :bgImage="$settings['banner_image'] ? 'images/' . $settings['banner_image'] : null"
/>
    @include('partials.about.profile',                ['settings'        => $settings])
    @include('partials.about.vision-mission',         ['settings'        => $settings])
    @include('partials.about.timeline')
    @include('partials.about.division-documentation', ['documentations'  => $documentations])
    @include('partials.about.documents',              ['documents'       => $documents])

    <x-cta-section />
</x-layouts.app>
