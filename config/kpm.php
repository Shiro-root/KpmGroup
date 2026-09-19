<?php

/*
|--------------------------------------------------------------------------
| KPM Group — Company Configuration
|--------------------------------------------------------------------------
| Edit values here or override them in .env for sensitive data.
*/

return [

    /*
    |------------------------------------------------------------------
    | Contact Info
    |------------------------------------------------------------------
    */

    // WhatsApp number in international format WITHOUT leading +
    // e.g. 6281234567890 (62 = Indonesia code)
    'whatsapp'         => env('KPM_WHATSAPP', '6281234567890'),
    'whatsapp_display' => env('KPM_WHATSAPP_DISPLAY', '812-3456-7890'),

    'email'   => env('KPM_EMAIL', 'info@kpmgroup.co.id'),
    'address' => env('KPM_ADDRESS', "Jl. Contoh No. 123\nBandar Lampung, Lampung 35000\nIndonesia"),

    /*
    |------------------------------------------------------------------
    | Social Media
    |------------------------------------------------------------------
    */

    'social' => [
        'instagram'        => env('KPM_INSTAGRAM_URL', 'https://instagram.com/kpmgroup'),
        'instagram_handle' => env('KPM_INSTAGRAM_HANDLE', 'kpmgroup'),
        'tiktok'           => env('KPM_TIKTOK_URL', 'https://tiktok.com/@kpmgroup'),
        'tiktok_handle'    => env('KPM_TIKTOK_HANDLE', 'kpmgroup'),
    ],

    /*
    |------------------------------------------------------------------
    | Google Maps
    |------------------------------------------------------------------
    */

    'maps_embed_url' => env(
        'KPM_MAPS_EMBED_URL',
        'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127449.59682948258!2d105.15954815!3d-5.38851495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40da2345678901%3A0x1234567890abcdef!2sBandar%20Lampung!5e0!3m2!1sid!2sid!4v1234567890'
    ),

];
