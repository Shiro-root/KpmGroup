<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $get = fn(string $key, string $default = '') => SiteSetting::get($key, $default);

        $settings = [
            // ── Hero ──
            'hero_title' => $get('home_hero_title', 'Membangun <span class="text-accent">Solusi</span><br>Energi Masa Depan'),
            'hero_subtitle' => $get('home_hero_subtitle', 'PT. Kurniawan Power Mandiri menghadirkan layanan konstruksi, engineering, dan inovasi yang terintegrasi.'),

            // ── Stats ──
            'stats_exp' => $get('home_stats_exp', '10+'),
            'stats_divisions' => $get('home_stats_divisions', '5'),
            'stats_projects' => $get('home_stats_projects', '50+'),
            'stats_team' => $get('home_stats_team', '100+'),

            // ── Company Intro ──
            'intro' => $get('home_company_intro', ''),
            'intro_sub' => $get('home_company_intro_sub', ''),
            'established_year' => $get('home_established_year', '2010'),

            // ── Tagline & Gambar Section "Tentang Kami" ──
            'intro_tagline_line1' => $get('home_intro_tagline_line1', 'Satu Group,'),
            'intro_tagline_line2' => $get('home_intro_tagline_line2', 'Lima Kekuatan'),
            'intro_images' => (function () use ($get) {
                $raw = $get('home_intro_images', '');
                $images = $raw ? json_decode($raw, true) : [];
                return $images ?: [$get('home_intro_image', 'about-visual.jpg')];
            })(),

            // ── Deskripsi Singkat Per Divisi (Services Overview) ──
            'div_construction_desc' => $get('home_div_construction_desc', 'Layanan konstruksi sipil dan mekanikal dengan standar kualitas internasional untuk infrastruktur industri dan komersial.'),
            'div_engineering_desc' => $get('home_div_engineering_desc', 'Solusi rekayasa teknik inovatif untuk mendukung efisiensi operasional dan keandalan sistem industri modern.'),
            'div_rd_desc' => $get('home_div_rd_desc', 'Inovasi dan riset terapan untuk menciptakan solusi teknologi yang relevan dengan kebutuhan industri energi masa depan.'),
            'div_farm_desc' => $get('home_div_farm_desc', 'Pengembangan agrikultur modern berbasis teknologi untuk mendukung ketahanan pangan dan produktivitas lahan secara berkelanjutan.'),
            'div_procurement_desc' => $get('home_div_procurement_desc', 'Layanan pengadaan barang dan material yang efisien, transparan, dan tepat waktu untuk mendukung kebutuhan operasional proyek.'),

            // ── Why Us — 5 Gambar Grid ──
            'whyus_img_1' => $get('home_whyus_img_1', 'thumb-construction.jpg'),
            'whyus_img_2' => $get('home_whyus_img_2', 'thumb-engineering.jpg'),
            'whyus_img_3' => $get('home_whyus_img_3', 'thumb-rd.jpg'),
            'whyus_img_4' => $get('home_whyus_img_4', 'thumb-farm.jpg'),
            'whyus_img_5' => $get('home_whyus_img_5', 'thumb-procurement.jpg'),

            // ── Why Us — Label Overlay Tiap Gambar ──
            'whyus_label_1' => $get('home_whyus_label_1', 'Construction'),
            'whyus_label_2' => $get('home_whyus_label_2', 'Engineering'),
            'whyus_label_3' => $get('home_whyus_label_3', 'R & D'),
            'whyus_label_4' => $get('home_whyus_label_4', 'Farm'),
            'whyus_label_5' => $get('home_whyus_label_5', 'Procurement'),

            // ── Why Us — Heading & Poin-Poin Kiri ──
            'whyus_title' => $get('home_whyus_title', 'Komitmen Kami'),
            'whyus_subtitle' => $get('home_whyus_subtitle', 'untuk Anda'),
            'whyus_points' => json_decode($get('home_whyus_points', '[]'), true) ?: [
                ['title' => 'Kualitas Terstandar', 'desc' => 'Setiap proyek dikerjakan mengikuti standar teknis dan keselamatan internasional dengan tim bersertifikat.'],
                ['title' => 'Tim Berpengalaman', 'desc' => 'Lebih dari 100 tenaga profesional di bidangnya — insinyur, teknisi, dan manajer proyek berpengalaman.'],
                ['title' => 'Solusi Terintegrasi', 'desc' => 'Lima divisi yang saling mendukung memungkinkan kami memberikan solusi end-to-end dari perencanaan hingga pemeliharaan.'],
                ['title' => 'Tepat Waktu & Transparan', 'desc' => 'Manajemen proyek yang ketat memastikan penyelesaian sesuai jadwal dengan pelaporan berkala yang transparan.'],
            ],

            // ── CTA ──
            'cta_title' => $get('home_cta_title', 'Mulai Proyek Bersama KPM'),
            'cta_subtitle' => $get('home_cta_subtitle', 'Kami siap mewujudkan kebutuhan konstruksi dan engineering Anda.'),
        ];

        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.home', compact('settings', 'services'));
    }
}