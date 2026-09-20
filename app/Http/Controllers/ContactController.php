<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $settings = [
            'whatsapp'          => SiteSetting::get('contact_whatsapp',          '6281234567890'),
            'whatsapp_display'  => SiteSetting::get('contact_whatsapp_display',  '812-3456-7890'),
            'email'             => SiteSetting::get('contact_email',             'info@kpmgroup.co.id'),
            'address'           => SiteSetting::get('contact_address',           "Jl. Contoh No. 123\nBandar Lampung, Lampung 35000"),
            'instagram_url'     => SiteSetting::get('contact_instagram_url',     'https://instagram.com/kpmgroup'),
            'instagram_handle'  => SiteSetting::get('contact_instagram_handle',  'kpmgroup'),
            'tiktok_url'        => SiteSetting::get('contact_tiktok_url',        'https://tiktok.com/@kpmgroup'),
            'tiktok_handle'     => SiteSetting::get('contact_tiktok_handle',     'kpmgroup'),
            'maps_embed_url'    => SiteSetting::get('contact_maps_embed_url',    ''),
            'office_hours'      => SiteSetting::get('contact_office_hours',      'Senin–Sabtu, 08.00–17.00 WIB'),
            'banner_image'       => SiteSetting::get('contact_banner_image', ''),
            ];

        return view('pages.contact', compact('settings'));
    }

    public function send(Request $request): RedirectResponse
    {
        $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        return redirect()->route('contact')
            ->with('success', 'Pesan Anda berhasil terkirim. Tim kami akan menghubungi Anda segera.');
    }
}
