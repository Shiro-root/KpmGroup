<form wire:submit.prevent="saveHome" class="space-y-6 pb-20">

    @include('filament.settings.home.stats')
    @include('filament.settings.home.intro')
    @include('filament.settings.home.divisions')
    @include('filament.settings.home.whyus-images')
    @include('filament.settings.home.whyus-text')
    @include('filament.settings.home.cta')

    @include('filament.settings.save-bar', ['label' => 'Simpan Halaman Home'])

</form>
