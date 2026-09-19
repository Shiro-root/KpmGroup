<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\View\View;

class ServicesController extends Controller
{
    public function index(): View
    {
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $settings = [
            'page_title'    => SiteSetting::get('services_page_title',    'Layanan & <span class="text-accent">Divisi</span>'),
            'page_subtitle' => SiteSetting::get('services_page_subtitle', 'Lima divisi terintegrasi yang siap memberikan solusi menyeluruh.'),
            'cta_title'     => SiteSetting::get('services_cta_title',     'Diskusikan Kebutuhan Proyek Anda'),
            'cta_subtitle'  => SiteSetting::get('services_cta_subtitle',  'Hubungi tim KPM Group dan dapatkan konsultasi awal tanpa biaya.'),
        ];

        return view('pages.services', compact('services', 'settings'));
    }
}
