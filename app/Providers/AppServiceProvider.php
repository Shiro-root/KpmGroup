<?php
namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        
         require_once app_path('helpers.php');
        // Share company config to all views
        View::share('kpm', config('kpm', []));

        if (str_contains(config('app.url'), 'ngrok-free')) {
            URL::forceScheme('https');
        }

        // Share SEO meta ke semua view — pakai composer agar fresh tiap request
        View::composer('*', function ($view) {
            $view->with([
                'seoTitle'       => SiteSetting::get('seo_title', 'KPM Group'),
                'seoDescription' => SiteSetting::get('seo_description', 'KPM Group — Solusi terpadu Construction, Engineering, R&D, Farm & Procurement di Indonesia.'),
                'seoImage'       => SiteSetting::get('seo_og_image', null),
            ]);
        });

        // Share contact/site settings to footer (synced with Filament admin)
        View::composer('components.footer', function ($view) {
            $view->with('settings', [
                'whatsapp'         => SiteSetting::get('contact_whatsapp', '6281234567890'),
                'whatsapp_display' => SiteSetting::get('contact_whatsapp_display', '812-3456-7890'),
                'email'            => SiteSetting::get('contact_email', 'info@kpmgroup.co.id'),
                'address'          => SiteSetting::get('contact_address', "Jl. Contoh No. 123\nBandar Lampung, Lampung 35000"),
                'instagram_url'    => SiteSetting::get('contact_instagram_url', 'https://instagram.com/kpmgroup'),
                'instagram_handle' => SiteSetting::get('contact_instagram_handle', 'kpmgroup'),
                'tiktok_url'       => SiteSetting::get('contact_tiktok_url', 'https://tiktok.com/@kpmgroup'),
                'tiktok_handle'    => SiteSetting::get('contact_tiktok_handle', 'kpmgroup'),
                'maps_embed_url'   => SiteSetting::get('contact_maps_embed_url', ''),
                'office_hours'     => SiteSetting::get('contact_office_hours', 'Senin–Sabtu, 08.00–17.00 WIB'),
            ]);
        });
    }
}