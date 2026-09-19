<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // HOME
            ['key' => 'home_hero_title',        'value' => 'Membangun <span class="text-accent">Solusi</span><br>Energi Masa Depan', 'group' => 'home'],
            ['key' => 'home_hero_subtitle',      'value' => 'PT. Kurniawan Power Mandiri menghadirkan layanan konstruksi, engineering, dan inovasi yang terintegrasi untuk mendukung pertumbuhan industri Indonesia.', 'group' => 'home'],
            ['key' => 'home_company_intro',      'value' => 'PT. Kurniawan Power Mandiri (KPM Group) adalah perusahaan multi-divisi yang bergerak di bidang konstruksi, engineering, riset & pengembangan, agrikultur, dan pengadaan barang.', 'group' => 'home'],
            ['key' => 'home_company_intro_sub',  'value' => 'Dengan pengalaman lebih dari satu dekade, kami hadir sebagai mitra terpercaya bagi berbagai sektor industri di Indonesia — mengutamakan kualitas, keselamatan, dan inovasi dalam setiap proyek yang kami tangani.', 'group' => 'home'],
            ['key' => 'home_stats_exp',          'value' => '10+',  'group' => 'home'],
            ['key' => 'home_stats_divisions',    'value' => '5',    'group' => 'home'],
            ['key' => 'home_stats_projects',     'value' => '50+',  'group' => 'home'],
            ['key' => 'home_stats_team',         'value' => '100+', 'group' => 'home'],
            ['key' => 'home_cta_title',          'value' => 'Mulai Proyek Bersama KPM', 'group' => 'home'],
            ['key' => 'home_cta_subtitle',       'value' => 'Kami siap mewujudkan kebutuhan konstruksi dan engineering Anda dengan standar kualitas tertinggi.', 'group' => 'home'],
            ['key' => 'home_established_year',   'value' => '2010', 'group' => 'home'],

            // ABOUT
            ['key' => 'about_company_name',       'value' => 'PT. Kurniawan Power Mandiri', 'group' => 'about'],
            ['key' => 'about_profile_paragraph1', 'value' => 'PT. Kurniawan Power Mandiri (KPM Group) merupakan perusahaan nasional yang berkomitmen untuk memberikan solusi industri terpadu di bidang konstruksi, engineering, riset & pengembangan, agrikultur, dan pengadaan barang.', 'group' => 'about'],
            ['key' => 'about_profile_paragraph2', 'value' => 'Didirikan dengan semangat untuk memajukan infrastruktur dan industri Indonesia, KPM Group telah tumbuh menjadi grup perusahaan yang dipercaya oleh berbagai klien dari sektor energi, pemerintahan, hingga swasta.', 'group' => 'about'],
            ['key' => 'about_profile_paragraph3', 'value' => 'Melalui lima divisi yang terintegrasi, kami mampu menghadirkan layanan komprehensif — mulai dari perencanaan teknis, konstruksi, hingga pemeliharaan jangka panjang — dengan standar keselamatan dan kualitas yang tidak pernah kami kompromikan.', 'group' => 'about'],
            ['key' => 'about_vision',             'value' => 'Menjadi Grup Perusahaan Terkemuka di Bidang Energi dan Konstruksi yang Berkontribusi pada Pembangunan Nasional yang Berkelanjutan', 'group' => 'about'],
            ['key' => 'about_mission_1',          'value' => 'Memberikan layanan konstruksi dan engineering berkualitas tinggi dengan standar keselamatan internasional.', 'group' => 'about'],
            ['key' => 'about_mission_2',          'value' => 'Mendorong inovasi melalui riset dan pengembangan teknologi terapan yang berdampak nyata.', 'group' => 'about'],
            ['key' => 'about_mission_3',          'value' => 'Membangun kemitraan jangka panjang yang saling menguntungkan dengan klien dan mitra usaha.', 'group' => 'about'],
            ['key' => 'about_mission_4',          'value' => 'Berkontribusi pada pembangunan berkelanjutan, ketahanan energi, dan ketahanan pangan nasional.', 'group' => 'about'],
            ['key' => 'about_mission_5',          'value' => 'Memberdayakan sumber daya manusia Indonesia menjadi tenaga profesional berkompetensi tinggi.', 'group' => 'about'],
            ['key' => 'about_business_field',     'value' => 'Konstruksi, Engineering, R&D, Agrikultur, Procurement', 'group' => 'about'],
            ['key' => 'about_operation_area',     'value' => 'Indonesia', 'group' => 'about'],

            // SERVICES
            ['key' => 'services_page_title',    'value' => 'Layanan & <span class="text-accent">Divisi</span>', 'group' => 'services'],
            ['key' => 'services_page_subtitle', 'value' => 'Lima divisi terintegrasi yang siap memberikan solusi menyeluruh untuk kebutuhan industri Anda.', 'group' => 'services'],
            ['key' => 'services_cta_title',     'value' => 'Diskusikan Kebutuhan Proyek Anda', 'group' => 'services'],
            ['key' => 'services_cta_subtitle',  'value' => 'Hubungi tim KPM Group dan dapatkan konsultasi awal tanpa biaya.', 'group' => 'services'],

            // CONTACT
            ['key' => 'contact_whatsapp',         'value' => '6281234567890', 'group' => 'contact'],
            ['key' => 'contact_whatsapp_display', 'value' => '812-3456-7890', 'group' => 'contact'],
            ['key' => 'contact_email',            'value' => 'info@kpmgroup.co.id', 'group' => 'contact'],
            ['key' => 'contact_address',          'value' => "Jl. Contoh No. 123\nBandar Lampung, Lampung 35000\nIndonesia", 'group' => 'contact'],
            ['key' => 'contact_instagram_url',    'value' => 'https://instagram.com/kpmgroup', 'group' => 'contact'],
            ['key' => 'contact_instagram_handle', 'value' => 'kpmgroup', 'group' => 'contact'],
            ['key' => 'contact_tiktok_url',       'value' => 'https://tiktok.com/@kpmgroup', 'group' => 'contact'],
            ['key' => 'contact_tiktok_handle',    'value' => 'kpmgroup', 'group' => 'contact'],
            ['key' => 'contact_maps_embed_url',   'value' => '', 'group' => 'contact'],
            ['key' => 'contact_office_hours',     'value' => 'Senin–Sabtu, 08.00–17.00 WIB', 'group' => 'contact'],
        ];

        foreach ($defaults as $item) {
            SiteSetting::updateOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value'], 'group' => $item['group'], 'type' => 'text']
            );
        }

        $this->command->info('SiteSettings seeded: ' . count($defaults) . ' records.');
    }
}
