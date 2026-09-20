<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DivisionDocument;
use App\Models\SiteSetting;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(): View
    {
        $documents = Document::query()
            ->where('is_public', true)
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $documentations = DivisionDocument::query()
            ->where('is_public', true)
            ->orderBy('sort_order')
            ->latest()
            ->get()
            ->groupBy('division');

        $settings = [
            'company_name'   => SiteSetting::get('about_company_name',       'PT. Kurniawan Power Mandiri'),
            'paragraph1'     => SiteSetting::get('about_profile_paragraph1', ''),
            'paragraph2'     => SiteSetting::get('about_profile_paragraph2', ''),
            'paragraph3'     => SiteSetting::get('about_profile_paragraph3', ''),
            'vision'         => SiteSetting::get('about_vision',             ''),
            'missions'       => array_filter([
                SiteSetting::get('about_mission_1', ''),
                SiteSetting::get('about_mission_2', ''),
                SiteSetting::get('about_mission_3', ''),
                SiteSetting::get('about_mission_4', ''),
                SiteSetting::get('about_mission_5', ''),
            ]),
            'business_field' => SiteSetting::get('about_business_field', 'Konstruksi, Engineering, R&D, Agrikultur, Procurement'),
            'operation_area' => SiteSetting::get('about_operation_area', 'Indonesia'),
            'milestones'     => json_decode(SiteSetting::get('milestones', '[]'), true) ?: [],
            'banner_image'   => SiteSetting::get('about_banner_image', ''),   // ← tambahkan
        ];

        return view('pages.about', compact('documents', 'documentations', 'settings'));
    }

    public function documentation(string $division): View
    {
        $divisionMeta = [
            'construction' => 'KPM Construction',
            'engineering'  => 'KPM Engineering',
            'rd'           => 'KPM R & D',
            'farm'         => 'KPM Farm',
            'procurement'  => 'KPM Procurement',
        ];

        abort_unless(array_key_exists($division, $divisionMeta), 404);

        $entries = DivisionDocument::query()
            ->where('is_public', true)
            ->where('division', $division)
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $divisionLabel = $divisionMeta[$division];

        return view('pages.about-documentation', compact('entries', 'division', 'divisionLabel'));
    }
}