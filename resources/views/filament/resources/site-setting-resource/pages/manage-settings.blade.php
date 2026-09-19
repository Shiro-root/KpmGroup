{{-- resources/views/filament/resources/site-setting-resource/pages/manage-settings.blade.php --}}

<x-filament-panels::page>

    @include('filament.settings.tabs')

    @if ($activeTab === 'home')
        @include('filament.settings.home')
    @endif

    @if ($activeTab === 'about')
        @include('filament.settings.about')
    @endif

    @if ($activeTab === 'services')
        @include('filament.settings.services')
    @endif

    @if ($activeTab === 'contact')
        @include('filament.settings.contact')
    @endif

    @if ($activeTab === 'seo')
        @include('filament.settings.seo')
    @endif

</x-filament-panels::page>