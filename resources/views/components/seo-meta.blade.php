{{-- resources/views/components/seo-meta.blade.php --}}
@props([
    'title'       => 'PT. Kurniawan Power Mandiri',
    'description' => 'KPM Group — Solusi terpadu Construction, Engineering, R&D, Farm & Procurement di Indonesia.',
    'image'       => null,
    'type'        => 'website',
])
<title>{{ $title }} | KPM Group</title>
<meta name="description" content="{{ $description }}">
<meta name="robots" content="index, follow">
{{-- Open Graph --}}
<meta property="og:site_name"   content="KPM Group">
<meta property="og:title"       content="{{ $title }} | KPM Group">
<meta property="og:description" content="{{ $description }}">
<meta property="og:type"        content="{{ $type }}">
<meta property="og:url"         content="{{ url()->current() }}">
@if ($image)
<meta property="og:image"       content="{{ Str::startsWith($image, 'http') ? $image : asset('images/' . $image) }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
@endif
{{-- Twitter Card --}}
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="{{ $title }} | KPM Group">
<meta name="twitter:description" content="{{ $description }}">
@if ($image)
<meta name="twitter:image"       content="{{ Str::startsWith($image, 'http') ? $image : asset('images/' . $image) }}">
@endif
<link rel="canonical" href="{{ url()->current() }}">